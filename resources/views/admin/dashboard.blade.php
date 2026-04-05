@extends('layouts.admin')

@section('title', 'Dashboard Statistik')

@section('content')
<div class="relative">
    <div class="mb-10 flex justify-between items-start">
        <div>
            <h1 class="text-4xl font-extrabold text-[#111c3a] dark:text-white tracking-tight">Ringkasan Statistik</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Pantau perkembangan pendaftaran santri baru dan aktivitas konten.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.posts.create') }}" class="px-5 py-2.5 bg-emerald-500 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/20">+ Buat Berita</a>
            <a href="{{ route('admin.registrations.index') }}" class="px-5 py-2.5 bg-[#111c3a] dark:bg-slate-800 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-slate-700 transition shadow-lg">+ Kelola PPDB</a>
        </div>
    </div>

    <!-- Health Alerts -->
    @if(!empty($health))
        <div class="mb-8 space-y-3">
            @foreach($health as $h)
                <div @class([
                    'p-4 rounded-3xl flex items-center gap-4 border',
                    'bg-amber-50 border-amber-100 text-amber-700 dark:bg-amber-900/20 dark:border-amber-800 dark:text-amber-400' => $h['type'] == 'warning',
                ])>
                    <span class="text-2xl">⚠️</span>
                    <p class="text-xs font-bold uppercase tracking-wide">{{ $h['message'] }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Stats Grid (Modernized) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Card 1 -->
        <div class="bg-white dark:bg-[#1E293B] p-6 rounded-[32px] shadow-xl shadow-emerald-900/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">👥</div>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30 px-3 py-1 rounded-full">Total</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Pendaftar</p>
            <h3 class="text-3xl font-black text-[#111c3a] dark:text-white mt-1">{{ $stats['total_pendaftar'] }}</h3>
        </div>

        <!-- Card 2 -->
        <div class="bg-white dark:bg-[#1E293B] p-6 rounded-[32px] shadow-xl shadow-amber-900/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">⏳</div>
                <span class="text-[10px] font-black uppercase tracking-widest text-amber-500 bg-amber-50 dark:bg-amber-900/30 px-3 py-1 rounded-full">Menunggu</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Pending</p>
            <h3 class="text-3xl font-black text-[#111c3a] dark:text-white mt-1">{{ $stats['pending'] }}</h3>
        </div>

        <!-- Card 3 -->
        <div class="bg-white dark:bg-[#1E293B] p-6 rounded-[32px] shadow-xl shadow-emerald-900/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">✅</div>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-500 bg-emerald-50 dark:bg-emerald-900/30 px-3 py-1 rounded-full">Diterima</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Lolos Verifikasi</p>
            <h3 class="text-3xl font-black text-[#111c3a] dark:text-white mt-1">{{ $stats['accepted'] }}</h3>
        </div>

        <!-- Card 4 -->
        <div class="bg-white dark:bg-[#1E293B] p-6 rounded-[32px] shadow-xl shadow-indigo-900/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">📰</div>
                <span class="text-[10px] font-black uppercase tracking-widest text-indigo-500 bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1 rounded-full">Konten</span>
            </div>
            <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Total Post</p>
            <h3 class="text-3xl font-black text-[#111c3a] dark:text-white mt-1">{{ $stats['total_berita'] + $stats['total_prestasi'] }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Registration Trends -->
        <div class="lg:col-span-2 bg-white dark:bg-[#1E293B] p-6 rounded-[32px] shadow-xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800">
            <h3 class="text-sm font-black text-[#111c3a] dark:text-white mb-4 uppercase tracking-wider opacity-80">Tren Pendaftaran (6 Bulan)</h3>
            <div class="h-[250px] relative">
                <canvas id="trendsChart"></canvas>
            </div>
        </div>

        <!-- Demographics / Status -->
        <div class="bg-white dark:bg-[#1E293B] p-6 rounded-[32px] shadow-xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800">
            <h3 class="text-sm font-black text-[#111c3a] dark:text-white mb-4 uppercase tracking-wider opacity-80">Status & Gender</h3>
            <div class="grid grid-cols-2 lg:grid-cols-1 gap-4">
                <div class="h-[140px] relative">
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="h-[140px] relative">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        <!-- Recent Registrations (Occupies 3 columns) -->
        <div class="lg:col-span-3 bg-white dark:bg-[#1E293B] rounded-[40px] shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="p-8 border-b border-slate-50 dark:border-slate-800 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-extrabold text-[#111c3a] dark:text-white">Pendaftar Terbaru</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Calon santri yang baru saja mendaftar.</p>
                </div>
                <a href="{{ route('admin.registrations.index') }}" class="px-4 py-2 bg-slate-50 dark:bg-slate-800 text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500 hover:text-white rounded-xl transition-all duration-300">Lihat Semua</a>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($recent_registrations as $reg)
                <div class="p-6 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-black text-lg">
                            {{ substr($reg->full_name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-[#111c3a] dark:text-white">{{ $reg->full_name }}</p>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-widest">{{ $reg->registration_number }} • {{ $reg->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span @class([
                        'px-4 py-1.5 text-[9px] font-black uppercase tracking-widest rounded-xl transition duration-300 shadow-sm',
                        'bg-amber-50 text-amber-600 border border-amber-100' => $reg->status == 'pending',
                        'bg-emerald-50 text-emerald-600 border border-emerald-100' => $reg->status == 'accepted',
                        'bg-slate-50 text-slate-500 border border-slate-100' => !in_array($reg->status, ['pending', 'accepted'])
                    ])>
                        {{ $reg->status }}
                    </span>
                </div>
                @empty
                <div class="p-12 text-center text-slate-400">Belum ada pendaftaran baru.</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Posts (Occupies 2 columns) -->
        <div class="lg:col-span-2 bg-white dark:bg-[#1E293B] rounded-[40px] shadow-2xl shadow-slate-900/5 border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="p-8 border-b border-slate-50 dark:border-slate-800 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-extrabold text-[#111c3a] dark:text-white">Konten Baru</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Berita, pengumuman, dan prestasi.</p>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-slate-50 dark:bg-slate-800 text-[10px] font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400 hover:bg-indigo-500 hover:text-white rounded-xl transition-all duration-300">Kelola</a>
            </div>
            <div class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($recent_posts as $post)
                <div class="p-6 group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                    <div class="flex items-center gap-4 mb-3">
                        @if($post->image_url)
                            <img src="{{ $post->image_url }}" class="w-10 h-10 rounded-xl object-cover shadow-sm">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-lg">📄</div>
                        @endif
                        <div class="flex-1">
                            <p class="font-bold text-[#111c3a] dark:text-white line-clamp-1 text-sm group-hover:text-emerald-500 transition-colors">{{ $post->title }}</p>
                            <p class="text-[9px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-[0.1em] mt-0.5">{{ $post->type }} • {{ $post->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="flex items-center gap-1.5 text-[9px] font-black uppercase tracking-widest text-slate-400 hover:text-emerald-500 transition-colors">
                            Edit Post <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center text-slate-400">Belum ada konten dibuat.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const noDataPlugin = {
            id: 'noData',
            afterDraw: (chart) => {
                const { datasets } = chart.data;
                let hasData = false;
                for (let dataset of datasets) {
                    if (dataset.data.length > 0 && dataset.data.some(v => v > 0)) {
                        hasData = true;
                        break;
                    }
                }
                if (!hasData) {
                    const { ctx, chartArea: { left, top, right, bottom } } = chart;
                    const centerX = (left + right) / 2;
                    const centerY = (top + bottom) / 2;
                    ctx.save();
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.font = 'bold 12px Inter, sans-serif';
                    ctx.fillStyle = '#94a3b8';
                    ctx.fillText('Belum Ada Data', centerX, centerY);
                    ctx.restore();
                }
            }
        };

        // Trends Chart
        const trendsData = {!! json_encode($charts['trends']['data']) !!};
        const trendsCtx = document.getElementById('trendsChart').getContext('2d');
        new Chart(trendsCtx, {
            type: 'line',
            plugins: [noDataPlugin],
            data: {
                labels: {!! json_encode($charts['trends']['labels']) !!},
                datasets: [{
                    label: 'Pendaftaran',
                    data: trendsData,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        suggestedMax: 5,
                        grid: { borderDash: [5, 5], color: '#e2e8f0' } 
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // Status Chart
        const statusData = {!! json_encode(array_values($charts['status'])) !!};
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            plugins: [noDataPlugin],
            data: {
                labels: {!! json_encode(array_keys($charts['status'])) !!},
                datasets: [{
                    data: statusData,
                    backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444'],
                    borderWidth: 0,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { weight: 'bold', size: 10 } } },
                    title: { display: true, text: 'Distribusi Status', font: { weight: 'black', size: 12 } }
                }
            }
        });

        // Gender Chart
        const genderL = {!! $charts['gender']['L'] !!};
        const genderP = {!! $charts['gender']['P'] !!};
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'pie',
            plugins: [noDataPlugin],
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [genderL, genderP],
                    backgroundColor: ['#111c3a', '#ec4899'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 10, font: { weight: 'bold', size: 9 } } },
                    title: { display: true, text: 'Sebaran Jenis Kelamin', font: { weight: 'black', size: 10 } }
                }
            }
        });
    });
</script>
@endsection
