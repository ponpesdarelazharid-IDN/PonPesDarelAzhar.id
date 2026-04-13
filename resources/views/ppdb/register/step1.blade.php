@extends('layouts.app')

@section('title', 'Biodata Santri - PSB')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Progress Stepper (Updated) -->
    <div class="mb-12 flex justify-between items-center relative gap-4">
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-slate-200 dark:bg-slate-800 -z-10 rounded-full"></div>
        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-[12.5%] h-1 bg-emerald-500 -z-10 rounded-full transition-all duration-1000"></div>
        
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-bold shadow-xl shadow-emerald-500/30 scale-110">1</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Biodata</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold">2</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Orang Tua</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold">3</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Berkas</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold">4</div>
            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Finalisasi</span>
        </div>
    </div>

    <!-- Form Card (Updated) -->
    <div class="bg-white dark:bg-dark-card rounded-[32px] p-8 md:p-12 shadow-2xl shadow-emerald-900/10 border border-slate-100 dark:border-slate-800">
        <h2 class="text-3xl font-extrabold text-light-text dark:text-white tracking-tight mb-3">Data Pribadi Santri</h2>
        <p class="text-slate-500 dark:text-slate-400 mb-10 text-sm leading-relaxed">Silakan lengkapi data diri calon santri secara teliti. Data ini akan digunakan sebagai rujukan utama kelulusan.</p>

        <form action="{{ route('ppdb.register.store1') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="step" value="1">

            <!-- Bagian 1: Pilihan Pendidikan -->
            <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-3xl border border-slate-200 dark:border-slate-700/50">
                <h3 class="text-sm font-black text-slate-800 dark:text-slate-200 uppercase tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs">A</span> Pilihan Pendidikan
                </h3>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Daftar Ke Tingkat</label>
                    <div class="relative">
                        <select name="education_level" class="w-full px-6 py-4 rounded-2xl bg-white dark:bg-slate-900 border-none focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white appearance-none shadow-sm cursor-pointer" required>
                            <option value="">Pilih Jenjang...</option>
                            <option value="MTs" {{ old('education_level', $registration->education_level ?? '') == 'MTs' ? 'selected' : '' }}>MTs (Madrasah Tsanawiyah) - Setara SMP</option>
                            <option value="MA" {{ old('education_level', $registration->education_level ?? '') == 'MA' ? 'selected' : '' }}>MA (Madrasah Aliyah) - Setara SMA</option>
                            <option value="SMA" {{ old('education_level', $registration->education_level ?? '') == 'SMA' ? 'selected' : '' }}>SMA (Sekolah Menengah Atas)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-6 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian 2: Data Identitas Resmi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $registration->full_name ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400" required placeholder="Sesuai Akta Kelahiran">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn', $registration->nisn ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400 font-mono" required placeholder="Nomor Induk Siswa Nasional">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">NIK KK</label>
                    <input type="text" name="nik_kk" value="{{ old('nik_kk', $registration->nik_kk ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400 font-mono" required placeholder="NIK di Kartu Keluarga">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nomor Telepon/WA Santri (Wajib WA Aktif)</label>
                    <input type="text" name="student_phone" value="{{ old('student_phone', $registration->student_phone ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400 font-mono" required placeholder="Contoh: 08123456789">
                </div>
            </div>

            <!-- Bagian 3: Tempat Lahir & Gender -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Tempat Lahir</label>
                    <input type="text" name="birth_place" value="{{ old('birth_place', $registration->birth_place ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required placeholder="Kab/Kota Lahir">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Tanggal Lahir</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $registration->birth_date ? $registration->birth_date->format('Y-m-d') : '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white cursor-pointer" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Jenis Gender</label>
                    <select name="gender" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required>
                        <option value="">Pilih...</option>
                        <option value="L" {{ old('gender', $registration->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $registration->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <!-- Bagian 4: Fisik & Personal -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Gol. Darah</label>
                    <select name="blood_type" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required>
                        <option value="O" {{ old('blood_type', $registration->blood_type ?? '') == 'O' ? 'selected' : '' }}>O</option>
                        <option value="A" {{ old('blood_type', $registration->blood_type ?? '') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('blood_type', $registration->blood_type ?? '') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ old('blood_type', $registration->blood_type ?? '') == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="Tidak Tahu" {{ old('blood_type', $registration->blood_type ?? '') == 'Tidak Tahu' ? 'selected' : '' }}>Tidak Tahu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Tinggi (cm)</label>
                    <input type="number" name="height" value="{{ old('height', $registration->height ?? '') }}" min="50" max="250"
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-mono" required placeholder="165">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Berat (kg)</label>
                    <input type="number" name="weight" value="{{ old('weight', $registration->weight ?? '') }}" min="15" max="200"
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-mono" required placeholder="50">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Jml. Saudara</label>
                    <input type="number" name="sibling_count" value="{{ old('sibling_count', $registration->sibling_count ?? '') }}" min="0" max="25"
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-mono" required placeholder="Misal 2">
                </div>
            </div>

            <!-- Cita-Cita -->
            <div>
                <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Cita-Cita</label>
                <input type="text" name="ambition" value="{{ old('ambition', $registration->ambition ?? '') }}" 
                    class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400" required placeholder="cth: Dokter, Guru, Pengusaha">
            </div>

            <!-- Bagian 5: Alamat Domisili -->
            <hr class="border-slate-100 dark:border-slate-800 my-4">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Alamat Rumah Lengkap</label>
                    <textarea name="address" rows="3" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400" required placeholder="Jl. Nama Jalan, No Rumah, RT/RW">{{ old('address', $registration->address ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Kecamatan</label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $registration->kecamatan ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required placeholder="Kecamatan">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Kabupaten/Kota</label>
                    <input type="text" name="kabupaten_kota" value="{{ old('kabupaten_kota', $registration->kabupaten_kota ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required placeholder="Kabupaten / Kota">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Provinsi</label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $registration->provinsi ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required placeholder="Provinsi">
                </div>
            </div>

            <!-- Bagian 6: Asal Sekolah -->
            <hr class="border-slate-100 dark:border-slate-800 my-4">
            <h3 class="text-sm font-black text-slate-800 dark:text-slate-200 uppercase tracking-widest mb-6 flex items-center gap-2">
                <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs">B</span> Informasi Asal Sekolah
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Asal Sekolah (SD/MI)</label>
                    <input type="text" name="origin_school" value="{{ old('origin_school', $registration->origin_school ?? '') }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white" required placeholder="Contoh: SDN 01 Jakarta">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Alamat Asal Sekolah</label>
                    <textarea name="origin_school_address" rows="2" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white placeholder-slate-400" required placeholder="Alamat lengkap sekolah asal">{{ old('origin_school_address', $registration->origin_school_address ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Tahun Lulus</label>
                    <input type="number" name="graduation_year" value="{{ old('graduation_year', $registration->graduation_year ?? date('Y')) }}" 
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-dark-main border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:outline-none transition-all dark:text-white font-mono" required min="2000" max="{{ date('Y')+1 }}">
                </div>
            </div>

            <!-- Pesan Error Dinamis -->
            @if ($errors->any())
                <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl">
                    <ul class="list-disc list-inside text-xs font-bold text-red-600 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="pt-8">
                <button type="submit" class="w-full py-5 rounded-[20px] bg-emerald-500 text-white font-black uppercase tracking-widest text-sm shadow-2xl shadow-emerald-500/30 hover:bg-emerald-600 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                    Simpan & Lanjut ke Data Orang Tua &rarr;
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
