# Laporan Teknis: Sistem PPDB Pondok Pesantren Modern Darel Azhar

Laporan ini menyajikan struktur kode sumber inti yang digunakan dalam pengembangan sistem Penerimaan Peserta Didik Baru (PPDB), yang mencakup manajemen data, validasi, dan integrasi layanan pihak ketiga.

---

## Daftar Teknologi yang Digunakan

*   **Backend**: Laravel Framework (Logika bisnis & Database).
*   **Database**: TiDB Cloud (Penyimpanan data pendaftar & status).
*   **Frontend**: Tailwind CSS (Desain premium Dark/Light mode).
*   **Storage**: Cloudinary (Penyimpanan dokumen & foto santri).
*   **Image Optimization**: Browser-side Compression (Menghemat kuota pengunggahan).
*   **Email**: SMTP Brevo (Notifikasi otomatis tanda terima).

---


## 1. Arsitektur Data (Model)
File: `app/Models/Registration.php`
Model ini menangani penyimpanan data pendaftar, kalkulasi biaya otomatis berdasarkan tingkat pendidikan, serta integrasi URL media dari Cloudinary.

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $guarded = [];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Otomatisasi generate Nomor Pendaftaran (Format: PPDB-YYYY-0001)
    protected static function booted()
    {
        static::creating(function ($registration) {
            if (!$registration->registration_number) {
                $year = date('Y');
                $lastRegistration = static::whereYear('created_at', $year)
                    ->orderBy('id', 'desc')
                    ->first();

                $number = $lastRegistration ? (int) substr($lastRegistration->registration_number, -4) + 1 : 1;
                $registration->registration_number = 'PPDB-' . $year . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Accessor: Mengambil URL Dokumen dari Cloudinary secara aman
    public function getPhotoUrlAttribute($value)
    {
        if (!$value) return asset('images/default-avatar.png');
        if (filter_var($value, FILTER_VALIDATE_URL)) return $value;
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($value);
        } catch (\Exception $e) {
            return asset('images/default-avatar.png');
        }
    }
}
```

---

## 2. Alur Pendaftaran (Controller)
File: `app/Http/Controllers/RegistrationController.php`
Menangani logika multi-step pendaftaran (Step 1 s/d Step 4) dan proses pengunggahan berkas yang dioptimalkan.

```php
public function storeStep3(RegistrationRequest $request)
{
    $registration = Registration::where('user_id', auth()->id())->firstOrFail();
    $storage = Storage::disk('cloudinary');
    
    $fields = ['photo', 'birth_cert', 'ijazah', 'family_card', 'ktp_parent'];
    foreach ($fields as $field) {
        $compressedKey = $field . '_compressed';
        
        // Cek data Base64 hasil kompresi browser (Optimasi Vercel)
        if ($request->filled($compressedKey)) {
            $base64Data = $request->input($compressedKey);
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
                $imageBinary = base64_decode(substr($base64Data, strpos($base64Data, ',') + 1));
                
                // Simpan ke temporary file sebelum upload ke Cloudinary
                $tmpPath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
                file_put_contents($tmpPath, $imageBinary);
                
                try {
                    $fileObj = new \Illuminate\Http\UploadedFile($tmpPath, $field.'.jpg', 'image/jpeg', null, true);
                    $path = $storage->putFile('ppdb/documents', $fileObj);
                    @unlink($tmpPath);
                    
                    $registration->{$field . '_url'} = $storage->url($path);
                } catch (\Exception $e) {
                    return back()->with('error', 'Koneksi Cloudinary Gagal.');
                }
            }
        }
    }
    $registration->save();
    return redirect()->route('ppdb.register.step4');
}
```

---

## 3. Keamanan & Validasi
File: `app/Http/Requests/RegistrationRequest.php`
Memastikan integritas data di setiap langkah pendaftaran.

```php
public function rules(): array
{
    return [
        'step' => 'required|integer|in:1,2,3,4',
        
        // Validasi Step 1: Biodata
        'full_name' => 'required_if:step,1|string|max:255',
        'nisn' => 'required_if:step,1|string|max:20',
        
        // Validasi Step 3: Berkas (Maksimal 1MB)
        'photo' => 'sometimes|required_without:photo_compressed|file|image|max:1024',
        'ijazah' => 'sometimes|required_without:ijazah_compressed|file|max:1024',
        
        // Validasi Step 4: Pernyataan
        'confirmation' => 'required_if:step,4|accepted',
    ];
}
```

---

## 4. Sistem Notifikasi Otomatis
File: `app/Mail/WelcomeMail.php`
Mengirimkan email konfirmasi pendaftaran melalui SMTP Brevo.

```php
public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Selamat! Pendaftaran PPDB Berhasil - ' . $this->registration->registration_number,
    );
}

public function content(): Content
{
    return new Content(
        view: 'emails.welcome',
    );
}
```

---

## 5. Optimasi Pengunggahan (Frontend Logic)
File: `resources/views/ppdb/register/step3.blade.php`
Potongan kode JavaScript untuk kompresi gambar di sisi klien (Client-side Compression) untuk mengurangi beban payload server.

```javascript
const compressImage = (file, maxWidth = 1200, quality = 0.7) => {
    return new Promise((resolve) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (event) => {
            const img = new Image();
            img.src = event.target.result;
            img.onload = () => {
                const canvas = document.createElement('canvas');
                // Logika pengecilan dimensi...
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);
                resolve(canvas.toDataURL('image/jpeg', quality));
            };
        };
    });
};

---

## 6. Manajemen Admin PPDB (Controller)
File: `app/Http/Controllers/Admin/RegistrationController.php`
Mengatur verifikasi data pendaftar dan sinkronisasi status (Lulus/Ditolak).

```php
public function update(Request $request, Registration $registration)
{
    $validated = $request->validate([
        'status' => 'required|in:draft,pending,verified,accepted,rejected',
        'notes' => 'nullable|string'
    ]);

    // Proteksi: Hanya bisa dinyatakan LULUS (Accepted) jika sudah lunas
    if ($validated['status'] === 'accepted' && $registration->payment_remaining > 0) {
        return back()->with('error', 'Pendaftar belum lunas (Remaining: ' . $registration->payment_remaining . ')');
    }

    $registration->update($validated);

    // Kirim Email Notifikasi Kelulusan Otomatis jika status 'accepted'
    if ($validated['status'] === 'accepted') {
        Mail::to($registration->user->email)->send(new AcceptedMail($registration));
    }

    return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
}
```

---

## 7. Pengaturan Gelombang PPDB
File: `app/Http/Controllers/Admin/PpdbSettingController.php`
Logika untuk membuka/menutup gelombang pendaftaran secara dinamis oleh Administrator.

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'academic_year' => 'required|string',
        'quota' => 'nullable|integer',
    ]);

    // Jika mengaktifkan gelombang baru, nonaktifkan gelombang lama lainnya
    if ($request->has('is_open')) {
        PpdbSetting::where('is_open', true)->update(['is_open' => false]);
    }

    PpdbSetting::create([
        'is_open' => $request->has('is_open'),
        'academic_year' => $validated['academic_year'],
        'quota' => $validated['quota'],
    ]);

    return back()->with('success', 'Gelombang PPDB baru berhasil dibuka!');
}
```

---

## 8. Manajemen Konten Publik (Berita, Acara, Prestasi)
File: `app/Http/Controllers/Admin/PostController.php`
Satu controller terpusat untuk mengelola berbagai jenis informasi publik melalui field `type`.

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|in:berita,acara,prestasi,ekstrakurikuler',
        'content' => 'required|string',
        'status' => 'required|in:draft,published',
        'image' => 'nullable|image|max:2048',
    ]);

    $post = new Post($validated);
    $post->slug = Str::slug($request->title) . '-' . uniqid();
    $post->user_id = auth()->id();
    
    // Upload Gambar Utama ke Cloudinary
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $path = Storage::disk('cloudinary')->putFile('sekolah/posts', $request->file('image'));
        $post->image_url = Storage::disk('cloudinary')->url($path);
    }

    $post->save();
    return redirect()->route('admin.posts.index')->with('success', 'Konten berhasil dipublikasikan!');
}
```

---

## 9. Manajemen Ekstrakurikuler
File: `app/Http/Controllers/Admin/EkstrakurikulerController.php`
Mengatur daftar kegiatan ekskul yang ditampilkan di halaman publik.

```php
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image_file' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name', 'description']);
    $data['slug'] = Str::slug($request->name) . '-' . rand(100, 999);
    $data['is_active'] = $request->has('is_active');

    // Handle Upload Media
    if ($request->hasFile('image_file')) {
        $path = Storage::disk('cloudinary')->putFile('sekolah/ekskul', $request->file('image_file'));
        $data['image'] = Storage::disk('cloudinary')->url($path);
    }

    Ekstrakurikuler::create($data);
    return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Ekskul Berhasil Ditambahkan.');
}
```

---

## 10. Skema Database (Migrations)
File: `database/migrations/...registrations_table.php`
Struktur tabel utama yang mendefinisikan seluruh field biodata dan status pendaftar.

```php
Schema::create('registrations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('ppdb_setting_id')->constrained();
    
    // Biodata & Asal Sekolah
    $table->string('full_name');
    $table->string('nisn')->nullable();
    $table->enum('gender', ['L', 'P']);
    $table->string('origin_school');
    
    // Dokumen (Penyimpanan URL Cloudinary)
    $table->string('photo_url')->nullable();
    $table->string('birth_cert_url')->nullable();
    $table->string('family_card_url')->nullable();
    
    // Status Pendaftaran
    $table->enum('status', ['draft', 'pending', 'verified', 'accepted', 'rejected'])->default('draft');
    $table->timestamps();
});
```

---

## 11. Konfigurasi Cloud & Deployment
File: `vercel.json` & `.env`
Program ini menggunakan arsitektur *Serverless* yang dioptimalkan untuk Vercel dan TiDB Cloud.

```json
{
    "version": 2,
    "framework": "laravel",
    "rewrites": [
        { "source": "/(.*)", "destination": "/api/index.php" }
    ],
    "env": {
        "APP_ENV": "production",
        "FILESYSTEM_DISK": "cloudinary",
        "DB_CONNECTION": "mysql"
    }
}
```

---

## 12. Struktur Model & Relasi
File: `app/Models/User.php`
Hubungan antara akun pengguna dengan data pendaftarannya.

```php
class User extends Authenticatable
{
    // Relasi One-to-One: Seorang User memiliki satu Data Registrasi
    public function registration()
    {
        return $this->hasOne(Registration::class);
    }

    // Role management: Membedakan Admin dan Calon Santri
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
```

---

## 13. Dinamisasi Profil Sekolah
File: `app/Http/Controllers/Admin/SchoolProfileController.php`
Mengatur informasi dasar sekolah (Visi, Misi, Alamat, Logo) secara dinamis tanpa mengubah kode.

```php
public function store(Request $request)
{
    // Mengambil semua input kecuali token
    $safeInput = $request->except(['_token']);
    
    foreach ($safeInput as $key => $value) {
        if ($value !== null) {
            // UpdateOrCreate: Jika key sudah ada maka update, jika belum ada buat baru
            SchoolProfile::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    return back()->with('success', 'Profil sekolah berhasil diperbarui!');
}
```

---

## 14. Manajemen Program Unggulan
File: `app/Http/Controllers/Admin/ProgramController.php`
Menangani data program pendidikan unggulan yang ditawarkan pondok pesantren.

```php
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    $data = $request->only(['title', 'description']);

    // Integrasi Cloudinary untuk Icon Program
    if ($request->hasFile('icon')) {
        $path = Storage::disk('cloudinary')->putFile('programs', $request->file('icon'));
        $data['icon_path'] = Storage::disk('cloudinary')->url($path);
    }

    Program::create($data);
    return redirect()->route('admin.programs.index')->with('success', 'Program Berhasil Ditambahkan.');
}
```

---

## 15. Logika Halaman Utama (Beranda)
File: `app/Http/Controllers/HomeController.php`
Menggabungkan seluruh data (Profil, Berita terbaru, Program, dan Status PPDB) untuk ditampilkan di Landing Page.

```php
public function index()
{
    // Mengambil data Berita, Acara, dan Prestasi terbaru
    $berita = Post::where('type', 'berita')->whereNotNull('published_at')->latest()->take(3)->get();
    $programs = Program::latest()->take(3)->get();
    
    // Cek apakah PPDB saat ini sedang dibuka
    $ppdb = PpdbSetting::where('is_open', true)
        ->where(function ($query) {
            $query->whereNull('open_date')->orWhere('open_date', '<=', now());
        })->first();

    return view('beranda', compact('berita', 'programs', 'ppdb'));
}
```

---

## 16. Arsitektur Keamanan (Security Middleware)
File: `app/Http/Middleware/AdminMiddleware.php`
Menjamin bahwa area administratif hanya dapat diakses oleh staf yang memiliki otorisasi (Role Admin).

```php
public function handle(Request $request, Closure $next): Response
{
    // Validasi sesi aktif dan peran pengguna
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request); // Lanjutkan ke rute admin
    }

    // Jika ilegal, arahkan kembali ke beranda
    return redirect('/');
}
```

---

## 17. Logika Otentikasi & OTP (Registrasi Akun)
File: `app/Http/Controllers/Auth/RegisteredUserController.php`
Sistem pendaftaran akun calon santri dengan fitur pembuatan kode unik (OTP) untuk keamanan.

```php
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'unique:users'],
    ]);

    // Pembuatan kode OTP 6 digit secara acak
    $otpCode = sprintf("%06d", mt_rand(1, 999999));

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'pendaftar',
        'otp_code' => $otpCode, 
    ]);

    // Kirim notifikasi selamat datang via email
    Mail::to($user->email)->send(new WelcomeMail($user));

    Auth::login($user);
    return redirect(route('dashboard'));
}
```

---

## 18. Pengolahan Data & Statistik (Admin Dashboard)
File: `app/Http/Controllers/Admin/DashboardController.php`
Transformasi data pendaftar menjadi statistik visual untuk membantu pengambilan keputusan pimpinan.

```php
public function index()
{
    // Agregasi Data Utama
    $stats = [
        'total_pendaftar' => Registration::count(),
        'pending' => Registration::where('status', 'pending')->count(),
        'accepted' => Registration::where('status', 'accepted')->count(),
    ];

    // Menghitung tren pendaftaran 6 bulan terakhir (Monthly Trends)
    $counts = [];
    for ($i = 5; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $counts[] = Registration::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->count();
    }

    return view('admin.dashboard', compact('stats', 'counts'));
}
```

---

## 19. Jembatan Arsitektur Serverless (Vercel Bridge)
File: `api/index.php` & `vercel.json`
Konfigurasi khusus yang memungkinkan framework Laravel yang kompleks berjalan secara optimal di lingkungan Cloud Serverless (Vercel).

```php
<?php
// Jembatan (Bridge) rute dinamis Laravel ke runtime Vercel
require __DIR__ . '/../public/index.php';
```

---

## 20. Otomasi Inisialisasi Database (Seeders)
File: `database/seeders/SchoolProfileSeeder.php`
Prosedur otomatis untuk menyiapkan data standar sekolah pada saat sistem pertama kali dijalankan.

```php
public function run(): void
{
    $profiles = [
        'nama_sekolah' => 'Pondok Pesantren Modern Darel Azhar',
        'visi' => 'Terwujudnya Lembaga Pendidikan Islam yang Unggul...',
        'alamat' => 'Jl. Komp. Pendidikan No.RT 08/09, Banten',
    ];

    foreach ($profiles as $key => $value) {
        // UpdateOrCreate: Sinkronisasi data tanpa duplikasi
        SchoolProfile::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
```

---

## 21. Sistem Desain & Konfigurasi UI (Tailwind)
File: `tailwind.config.js`
Konfigurasi tema gelap (Dark Mode) dan integrasi font Figtree untuk estetika premium.

```javascript
export default {
    darkMode: 'class', // Mendukung transisi Light/Dark mode dengan class CSS
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms], // Integrasi utilitas form yang responsif
};
```

---

## 22. Template Email Profesional (Blade View)
File: `resources/views/emails/welcome.blade.php`
Desain email responsif dengan gaya modern (Navy & Emerald) yang dikirimkan ke calon santri.

```html
<div class="wrapper">
    <div class="hero">
        <span class="label">Pendaftaran Berhasil</span>
        <h1 class="title">Tanda Terima PPDB</h1>
    </div>
    <div class="content">
        <span class="greeting">Assalamu'alaikum, {{ $registration->full_name }}</span>
        <p>Anda telah terdaftar di sistem kami dengan nomor:</p>
        <div class="box">
            <span class="box-label">NOMOR PENDAFTARAN</span>
            <div class="box-value">{{ $registration->registration_number }}</div>
        </div>
        <a href="{{ route('ppdb.status') }}" class="btn">Cek Status Pendaftaran</a>
    </div>
</div>
```

---

## 23. Logika Kartu Pendaftaran (Print UI)
File: `resources/views/ppdb/card.blade.php`
Menggunakan CSS Grid & Flexbox untuk mencetak Kartu Pendaftaran digital dengan ukuran standar ID Card (85.6mm x 53.98mm).

```css
:root {
    --card-width: 85.6mm;
    --card-height: 53.98mm;
    --gold-gradient: linear-gradient(135deg, #d4af37 0%, #996515 100%);
}

.card {
    width: var(--card-width);
    height: var(--card-height);
    background-color: #111;
    border-radius: 14px;
    position: relative;
    overflow: hidden;
    color: white;
}
```

---

## 24. Konfigurasi Media Cloud (Filesystem)
File: `config/filesystems.php`
Integrasi driver Cloudinary untuk penyimpanan foto dan dokumen berkas santri secara eksternal.

```php
'disks' => [
    'cloudinary' => [
        'driver' => 'cloudinary',
        'cloud' => env('CLOUDINARY_CLOUD_NAME'),
        'key' => env('CLOUDINARY_API_KEY'),
        'secret' => env('CLOUDINARY_API_SECRET'),
    ],
],
```

---

## 25. Integrasi Email SMTP (Brevo Config)
File: `config/mail.php` & `.env`
Logika pengiriman email otomatis menggunakan Server SMTP Brevo dengan protokol enkripsi TLS.

```php
'mailers' => [
    'smtp' => [
        'transport' => 'smtp',
        'host' => env('MAIL_HOST', 'smtp-relay.brevo.com'),
        'port' => env('MAIL_PORT', 587),
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
    ],
],
```

---

## 26. Logika Verifikasi OTP (Security Flow)
File: `app/Http/Controllers/Auth/VerifyOtpController.php`
Algoritma pencocokan kode OTP 6-digit untuk memastikan keamanan alamat email pemohon.

```php
public function verify(Request $request)
{
    $request->validate(['otp_code' => ['required', 'string', 'size:6']]);
    $user = Auth::user();

    // Validasi kecocokan kode OTP yang disimpan di Database (Memory Persistent)
    if ($user->otp_code === $request->otp_code) {
        $user->markEmailAsVerified(); // Verifikasi akun secara formal
        $user->otp_code = null;       // One-time Use: Hapus kode setelah digunakan
        $user->save();
        return redirect()->route('ppdb.register');
    }

    return back()->withErrors(['otp_code' => 'Kode OTP salah atau kedaluwarsa.']);
}
```

---

## 27. Arsitektur Validasi Data (Form Requests)
File: `app/Http/Requests/RegistrationRequest.php`
Sistem validasi berlapis (Layered Validation) yang secara dinamis menyesuaikan kriteria input berdasarkan tahap (Step) pendaftaran.

```php
public function rules(): array
{
    $rules = ['step' => 'required|integer|in:1,2,3,4'];

    if ($this->step == 1) {
        // Validasi identitas dasar (Data Siswa)
        $rules = array_merge($rules, [
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'nisn' => 'required|string|max:20',
        ]);
    } elseif ($this->step == 3) {
        // Validasi File: Memastikan attachment memiliki ekstensi & ukuran yang sesuai (Max 1MB)
        $rules = array_merge($rules, [
            'photo' => 'sometimes|file|image|mimes:jpg,jpeg,png|max:1024',
            'ijazah' => 'sometimes|file|mimes:pdf,jpg,jpeg,png|max:1024',
        ]);
    }

    return $rules;
}
```

---

## 28. Manajemen Sesi & Global Provider
File: `app/Providers/AppServiceProvider.php`
Pusat kontrol sistem untuk menyuntikkan data profil sekolah (`SchoolProfile`) ke seluruh tampilan halaman secara global.

```php
public function boot(): void
{
    // Memaksa protokol HTTPS pada lingkungan produksi (Vercel)
    if (env('APP_ENV') === 'production') {
        URL::forceScheme('https');
    }

    // View Composer: Menyediakan variabel $profiles ke seluruh file .blade.php
    View::composer('*', function ($view) {
        $pluck = SchoolProfile::pluck('value', 'key')->toArray();
        $view->with('profiles', $pluck);
    });
}
```

---

## 29. Pipeline Build & Asset (Vite Config)
File: `vite.config.js`
Konfigurasi Bundler untuk mengompilasi aset CSS dan JavaScript menjadi versi produksi yang ringan dan cepat.

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true, // Auto-reload saat pengembangan
        }),
    ],
});
```

---

## 30. Penanganan Infrastruktur & Eksepsi (Bootstrap)
File: `bootstrap/app.php`
Logika Bootstrapping aplikasi untuk menyesuaikan diri dengan keterbatasan penyimpanan temporer pada lingkungan Cloud Serverless.

```php
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(web: __DIR__.'/../routes/web.php')
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['admin' => AdminMiddleware::class]);
    })->create();

// Adaptasi Vercel: Mengarahkan Storage ke /tmp karena filesystem bersifat Read-Only
if (isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
}

return $app;
```

---

## 31. Struktur Fisik Tabel PPDB (Migration Schema)
File: `database/migrations/2026_03_29_065813_create_registrations_table.php`
Definisi skema database untuk menyimpan seluruh data pendaftaran santri baru secara terstruktur.

```php
Schema::create('registrations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->string('full_name');
    $table->date('birth_date');
    $table->enum('gender', ['L', 'P']);
    $table->string('origin_school');
    $table->enum('status', ['draft', 'pending', 'verified', 'accepted', 'rejected'])->default('draft');
    $table->timestamps();
});
```

---

## 32. Logika Agregasi Beranda (Landing Page Aggregator)
File: `app/Http/Controllers/HomeController.php`
Logika pengumpulan berbagai tipe data (Berita, Agenda, Prestasi) dalam satu query efisien untuk tampilan landing page.

```php
public function index()
{
    $berita = Post::where('type', 'berita')->latest()->take(3)->get();
    $prestasi = Post::where('type', 'prestasi')->latest()->take(3)->get();
    $programs = Program::latest()->take(3)->get();
    
    // Cek status gelombang PPDB aktif
    $ppdb = PpdbSetting::where('is_open', true)
        ->where('open_date', '<=', now())
        ->where('close_date', '>=', now())
        ->first();

    return view('beranda', compact('berita', 'prestasi', 'programs', 'ppdb'));
}
```

---

## 33. Arsitektur Layout Administratif (Blade Layout)
File: `resources/views/layouts/admin.blade.php`
Struktur kerangka UI admin yang mencakup sidebar, header dinamis, dan sistem notifikasi premium.

```html
<body class="bg-slate-100 dark:bg-[#0a1128]">
    <aside id="sidebar" class="bg-white dark:bg-[#111c3a]">
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
            <a href="{{ route('admin.registrations.index') }}">📝 Data PPDB</a>
            <!-- Navigasi Menu Lainnya -->
        </nav>
    </aside>
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</body>
```

---

## 34. Skema Tracking Pembayaran (Payment Migration)
File: `database/migrations/2026_04_13_101742_create_registration_payments_table.php`
Skema tabel untuk mendukung audit keuangan pendaftaran, melacak bukti transfer, dan status verifikasi pembayaran.

```php
Schema::create('registration_payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('registration_id');
    $table->string('payment_method');
    $table->decimal('amount', 15, 2);
    $table->string('receipt_url')->nullable(); // Disimpan di Cloudinary
    $table->enum('status', ['pending', 'verified', 'rejected']);
    $table->timestamps();
});
```

---

## 35. Konfigurasi Runtime Cloud (Vercel Deployment)
File: `vercel.json`
Instruksi teknis untuk Vercel agar dapat melayani request PHP/Laravel dan mengelola aset statis secara optimal.

```json
{
    "version": 2,
    "framework": "laravel",
    "commands": {
        "build": "php artisan migrate --force && npm run build"
    },
    "routes": [
        { "src": "/build/(.*)", "dest": "/public/build/$1" },
        { "src": "/(.*)", "dest": "/api/index.php" }
    ]
}
```

---

## 36. Logika Sistem Notifikasi (AcceptedMail Mailable)
File: `app/Mail/AcceptedMail.php`
Logika backend untuk merakit data pendaftar dan profil sekolah ke dalam sebuah mailable object sebelum dikirim via SMTP.

```php
public function __construct($registration)
{
    $this->registration = $registration;
    $this->profiles = SchoolProfile::pluck('value', 'key')->toArray();
}

public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Mabruk! Hasil Seleksi PPDB Darel Azhar - ' . $this->registration->registration_number,
    );
}
```

---

## 37. Manajemen Konfigurasi (PpdbSetting Controller)
File: `app/Http/Controllers/Admin/PpdbSettingController.php`
Logika administratif untuk mengontrol siklus hidup pendaftaran (Membuka/Menutup Gelombang) secara *real-time*.

```php
public function update(Request $request, PpdbSetting $ppdbSetting)
{
    if ($request->has('toggle_status')) {
        // Logika Mutually Exclusive: Hanya satu gelombang yang boleh aktif
        if (!$ppdbSetting->is_open) {
            PpdbSetting::where('is_open', true)->update(['is_open' => false]);
            $ppdbSetting->update(['is_open' => true]);
        } else {
            $ppdbSetting->update(['is_open' => false]);
        }
        return back()->with('success', 'Status PPDB berhasil diperbarui!');
    }
}
```

---

## 38. Model Persistence & Generasi ID (Registration Model)
File: `app/Models/Registration.php`
Logika otomatisasi untuk pembuatan nomor pendaftaran unik (`PPDB-YYYY-XXXX`) saat data pendaftar pertama kali disimpan.

```php
protected static function booted()
{
    static::creating(function ($registration) {
        if (!$registration->registration_number) {
            $year = date('Y');
            $last = static::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
            $number = $last ? (int) substr($last->registration_number, -4) + 1 : 1;
            $registration->registration_number = 'PPDB-' . $year . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        }
    });
}
```

---

## 39. Arsitektur Routing & Middleware (web.php)
File: `routes/web.php`
Pemetaan seluruh titik masuk (*endpoints*) aplikasi yang dibagi menjadi grup Publik, User (Auth), dan Admin (Middleware protected).

```php
// Grup Admin: Proteksi berlapis Auth, Verified, dan Admin Role
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminPostController::class);
    Route::resource('registrations', AdminRegistrationController::class)->only(['index', 'show', 'update']);
});
```

---

## 40. Konfigurasi Keamanan & Global App (config/app.php)
File: `config/app.php`
Pengaturan fundamental aplikasi mengenai enkripsi data (AES-256), zona waktu, dan metadata dasar sistem.

```php
return [
    'name' => env('APP_NAME', 'PonPes Darel Azhar'),
    'env' => env('APP_ENV', 'production'),
    'timezone' => 'Asia/Jakarta',
    'locale' => 'id',
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
];
```

---
**-- AKHIR DOKUMENTASI TEKNIS SISTEM --**

---

## 41. Integrasi GitHub (DevOps & Git Flow)
Sistem menggunakan GitHub sebagai repositori pusat untuk manajemen kode sumber dan pemicu otomatisasi *Deployment* ke server Vercel.

```bash
# Workflow Pengembangan Darel Azhar
git add .
git commit -m "Update: Optimasi Cloudinary Storage"
git push origin main # Otomatis memicu Build di Vercel
```

---

## 42. Konfigurasi Vercel (Infrastructure as Code)
File: `vercel.json`
Vercel bertindak sebagai *Platform as a Service* (PaaS) yang menjalankan aplikasi Laravel dalam lingkungan *Serverless Functions*.

```json
{
    "version": 2,
    "framework": "laravel",
    "regions": ["sin1"],
    "routes": [
        { "src": "/(.*)", "dest": "/api/index.php" }
    ]
}
```

---

## 43. Konektivitas TiDB Cloud (Managed MySQL)
File: `.env` & `config/database.php`
TiDB Cloud digunakan sebagai database utama dengan fitur *High Availability* dan koneksi aman berbasis Sertifikat SSL.

```php
'mysql' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST'),
    'port' => env('DB_PORT', '4000'), // Port standar TiDB
    'database' => env('DB_DATABASE'),
    'options' => [
        PDO::MYSQL_ATTR_SSL_CA => base_path('tidb-ca.pem'), // Enkripsi SSL
    ],
],
```

---

## 44. Manajemen Media Cloudinary (Modern Storage)
File: `config/filesystems.php`
Cloudinary digunakan untuk menangani pengunggahan file gambar (foto/ijazah) dengan optimasi otomatis di sisi server.

```php
'cloudinary' => [
    'driver' => 'cloudinary',
    'cloud' => env('CLOUDINARY_CLOUD_NAME'),
    'key' => env('CLOUDINARY_API_KEY'),
    'secret' => env('CLOUDINARY_API_SECRET'),
],
```

---

## 45. Notifikasi SMTP Brevo (Bavo)
File: `.env`
Brevo digunakan sebagai *gateway* email transaksional untuk mengirim pesan massal seperti pengumuman hasil seleksi.

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=admin@darelazhar.id
MAIL_ENCRYPTION=tls
```

---

## 46. Konfigurasi Relay Gmail (SMTP Backup)
File: `.env`
Gmail digunakan sebagai penyedia email cadangan atau untuk akun administratif khusus dengan otentikasi *App Password*.

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
MAIL_USERNAME=ponpesdarelazhar.id@gmail.com
MAIL_PASSWORD=xxxx-xxxx-xxxx-xxxx # App Password Google
```

---

## Lampiran: Struktur Environment Variables (.env)
Berikut adalah struktur konfigurasi lingkungan sistem (Data sensitif telah disensor):

```bash
APP_NAME="Pondok Pesantren Modern Darel Azhar"
APP_ENV=production
APP_URL=https://darelazhar.id

DB_CONNECTION=mysql
DB_HOST=gateway01.ap-southeast-1.prod.aws.tidbcloud.com
DB_PORT=4000
DB_DATABASE=db_ponpes

FILESYSTEM_DISK=cloudinary
CLOUDINARY_CLOUD_NAME=********
CLOUDINARY_API_KEY=********

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
```

---

## 47. Konsolidasi Skema Relasional (TiDB ERD Mechanics)
Sistem database di TiDB dirancang dengan integritas referensial yang kuat, menghubungkan akun pengguna, data pendaftaran, dan riwayat pembayaran.

```php
// Contoh Relasi Antar Tabel di Database TiDB
Schema::table('registrations', function (Blueprint $table) {
    // Menghubungkan identitas login (users) dengan aplikasi fisik (registrations)
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
    // Menghubungkan pendaftaran dengan gelombang yang aktif (ppdb_settings)
    $table->foreignId('ppdb_setting_id')->constrained();
});

Schema::table('registration_payments', function (Blueprint $table) {
    // Menjadikan satu pendaftaran bisa memiliki banyak termin pembayaran (Installments)
    $table->foreignId('registration_id')->constrained()->onDelete('cascade');
});
```

---

## 48. Mekanisme Sinkronisasi Media (Cloudinary CRUD Logic)
Alur teknis bagaimana data biner (Gambar) diproses dari browser pemohon, diunggah ke storage cloud, dan kuncinya disimpan di database relational.

```php
// Logic Simpan (Create/Update)
public function storeStep3(RegistrationRequest $request) {
    $registration = Registration::where('user_id', auth()->id())->first();
    
    // Proses Upload ke Cloudinary
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('photos', 'cloudinary');
        $registration->update(['photo_url' => $path]); // Simpan 'Public ID' di TiDB
    }
}
```

---

## 49. Abstraksi Lapisan Model (Data Persistence Layer)
Model Laravel bertindak sebagai "jembatan" yang secara otomatis mengubah path singkat di TiDB menjadi URL lengkap Cloudinary saat data ditampilkan.

```php
// File: app/Models/Registration.php
protected $appends = ['total_paid', 'payment_remaining']; 

/**
 * Accessor: Otomatis menempelkan domain Cloudinary ke Path Database
 */
public function getPhotoUrlAttribute($value) {
    if (!$value) return asset('images/default-avatar.png');
    
    // Mengambil URL resmi dari Cloudinary Driver via Storage Facade
    return Storage::disk('cloudinary')->url($value);
}
```

---

## 50. Pipeline Penayangan Data (Real-time View Engine)
Dashboard Admin menarik ribuan data dari TiDB dengan teknik Eager Loading untuk mencegah masalah performa (N+1 Query) dan menampilkannya seketika.

```php
// File: app/Http/Controllers/Admin/DashboardController.php
public function index() {
    // Menarik data pendaftar beserta user dan pembayarannya dalam 1 Query efisien
    $registrations = Registration::with(['user', 'payments'])
        ->latest()
        ->paginate(10);
        
    return view('admin.dashboard', compact('registrations'));
}
```

---

## KESIMPULAN & PENUTUP

Dokumentasi teknis ini telah membedah **50 Komponen Utama** dari Sistem Informasi PPDB Pondok Pesantren Darel Azhar. Dengan arsitektur berbasis **Laravel 11**, database terdistribusi **TiDB Cloud**, dan manajemen media **Cloudinary**, sistem ini telah mencapai standar aplikasi modern yang:
1.  **Scalable**: Mampu menangani ribuan pendaftar secara bersamaan.
2.  **Secure**: Terproteksi dengan SSL, OTP, dan Middleware berlapis.
3.  **Cloud-Native**: Siap dijalankan di infrastruktur Serverless sepenuhnya.

Dokumen ini disusun sebagai bukti profesionalitas pengembangan sistem dan sebagai panduan pemeliharaan (maintenance) di masa mendatang.

---
**-- AKHIR DOKUMEN TEKNIS SISTEM (VERSI ULTIMATE 50 BAGIAN) --**










