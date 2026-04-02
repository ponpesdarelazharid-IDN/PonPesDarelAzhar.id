@extends('salary.layout')

@section('title', 'Dashboard Gaji')
@section('topbar-title', '📊 Dashboard Gaji Bulan Ini')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid fade-in">
    <div class="stat-card" style="--stat-color:#7c3aed">
        <div class="stat-icon">💰</div>
        <div class="stat-label">Total Gaji Diterima</div>
        <div class="stat-value" style="color:#a78bfa">
            {{ $salary ? 'Rp '.number_format($stats['total_salary'],0,',','.') : '—' }}
        </div>
        <div class="stat-sub">{{ $salary ? $salary->month_label : 'Belum ada data bulan ini' }}</div>
    </div>
    <div class="stat-card" style="--stat-color:#ef4444">
        <div class="stat-icon">📌</div>
        <div class="stat-label">Total Pengeluaran Tetap</div>
        <div class="stat-value" style="color:#f87171">
            {{ $salary ? 'Rp '.number_format($stats['total_fixed'],0,',','.') : '—' }}
        </div>
        <div class="stat-sub">Dipotong duluan dari gaji</div>
    </div>
    <div class="stat-card" style="--stat-color:#06b6d4">
        <div class="stat-icon">📊</div>
        <div class="stat-label">Alokasi Persentase</div>
        <div class="stat-value" style="color:#22d3ee">
            {{ $salary ? 'Rp '.number_format($stats['total_percentage'],0,',','.') : '—' }}
        </div>
        <div class="stat-sub">Dana darurat + tabungan</div>
    </div>
    <div class="stat-card" style="--stat-color:#10b981">
        <div class="stat-icon">🆓</div>
        <div class="stat-label">Sisa Bebas</div>
        <div class="stat-value" style="color:#34d399">
            {{ $salary ? 'Rp '.number_format($stats['remaining'],0,',','.') : '—' }}
        </div>
        <div class="stat-sub">Setelah semua alokasi</div>
    </div>
    <div class="stat-card" style="--stat-color:#10b981">
        <div class="stat-icon">✅</div>
        <div class="stat-label">Sudah Dibayar</div>
        <div class="stat-value" style="color:#34d399">{{ $stats['paid_count'] }} pos</div>
        <div class="stat-sub">dari {{ $stats['paid_count'] + $stats['unpaid_count'] }} total pos</div>
    </div>
    <div class="stat-card" style="--stat-color:#f59e0b">
        <div class="stat-icon">⏳</div>
        <div class="stat-label">Belum Dibayar</div>
        <div class="stat-value" style="color:#fbbf24">{{ $stats['unpaid_count'] }} pos</div>
        <div class="stat-sub">Segera selesaikan!</div>
    </div>
</div>

@if(!$salary)
<!-- Empty State -->
<div class="card fade-in-2" style="text-align:center;padding:60px 24px">
    <div style="font-size:4rem;margin-bottom:16px">💸</div>
    <h2 style="font-size:1.4rem;font-weight:700;margin-bottom:8px">Belum Ada Data Gaji Bulan Ini</h2>
    <p style="color:var(--text-3);margin-bottom:24px">Input gaji kamu untuk bulan {{ now()->isoformat('MMMM YYYY') }} dan sistem akan otomatis membaginya!</p>
    <a href="{{ route('salary.index') }}" class="btn btn-primary" style="display:inline-flex">
        <span>💵</span> Input Gaji Sekarang
    </a>
</div>
@else
<!-- Chart + Breakdown -->
<div class="grid-2 fade-in-2" style="margin-bottom:24px">
    <!-- Donut Chart -->
    <div class="card">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:20px">🍩 Pembagian Gaji</h3>
        <div style="position:relative;height:260px;display:flex;align-items:center;justify-content:center">
            <canvas id="donutChart"></canvas>
            <div style="position:absolute;text-align:center;pointer-events:none">
                <div style="font-size:.75rem;color:var(--text-3)">Total Dialokasi</div>
                <div style="font-size:1.1rem;font-weight:800;color:var(--text-1)">
                    Rp {{ number_format($stats['total_fixed']+$stats['total_percentage'],0,',','.') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Progress per Pos -->
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
            <h3 style="font-size:1rem;font-weight:700">📋 Detail Per Pos</h3>
            <a href="{{ route('salary.detail', $salary->id) }}" class="btn btn-ghost btn-sm">Lihat Semua →</a>
        </div>
        <div style="display:flex;flex-direction:column;gap:14px">
            @foreach($donutData as $d)
            <div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                    <span style="font-size:.85rem;display:flex;align-items:center;gap:6px">
                        {{ $d['icon'] }} {{ $d['name'] }}
                    </span>
                    <span style="font-size:.82rem;font-weight:600">
                        Rp {{ number_format($d['amount'],0,',','.') }}
                    </span>
                </div>
                <div class="progress">
                    <div class="progress-bar"
                         style="width:{{ $stats['total_salary'] > 0 ? round($d['amount']/$stats['total_salary']*100,1) : 0 }}%;background:{{ $d['color'] }}">
                    </div>
                </div>
                <div style="font-size:.7rem;color:var(--text-3);margin-top:3px;text-align:right">
                    {{ $stats['total_salary'] > 0 ? round($d['amount']/$stats['total_salary']*100,1) : 0 }}% dari gaji
                    @if($d['isPaid'])
                        · <span style="color:#34d399">✅ Lunas</span>
                    @else
                        · <span style="color:#f59e0b">⏳ Belum</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Trend Chart -->
@if(count($chartData) > 1)
<div class="card fade-in-3">
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:20px">📈 Tren Gaji 6 Bulan Terakhir</h3>
    <div style="height:220px">
        <canvas id="trendChart"></canvas>
    </div>
</div>
@endif

@endif

<!-- History -->
<div class="card fade-in-3" style="margin-top:24px">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
        <h3 style="font-size:1rem;font-weight:700">🗂️ Riwayat Gaji</h3>
        <a href="{{ route('salary.index') }}" class="btn btn-primary btn-sm"><span>➕</span> Input Gaji</a>
    </div>
    @if($latestSalaries->isEmpty())
        <p style="color:var(--text-3);text-align:center;padding:24px">Belum ada riwayat gaji.</p>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Gaji Diterima</th>
                    <th>Total Dialokasi</th>
                    <th>Sisa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestSalaries as $s)
                <tr>
                    <td style="font-weight:600;color:var(--text-1)">{{ $s->month_label }}</td>
                    <td style="color:#a78bfa">Rp {{ number_format($s->amount,0,',','.') }}</td>
                    <td>Rp {{ number_format($s->total_fixed+$s->total_percentage,0,',','.') }}</td>
                    <td style="color:#34d399">Rp {{ number_format($s->remaining,0,',','.') }}</td>
                    <td>
                        <a href="{{ route('salary.detail', $s->id) }}" class="btn btn-ghost btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
const donutData = @json($donutData);
const chartData  = @json($chartData);

// Donut Chart
if (donutData.length > 0) {
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: donutData.map(d => d.icon + ' ' + d.name),
            datasets: [{
                data:            donutData.map(d => d.amount),
                backgroundColor: donutData.map(d => d.color + 'cc'),
                borderColor:     donutData.map(d => d.color),
                borderWidth: 2,
                hoverOffset: 8,
            }]
        },
        options: {
            cutout: '70%',
            plugins: { legend: { display: false }, tooltip: {
                callbacks: {
                    label: ctx => ' Rp ' + ctx.parsed.toLocaleString('id-ID')
                }
            }},
            animation: { animateRotate: true, duration: 800 }
        }
    });
}

// Trend Chart
if (chartData.length > 1) {
    new Chart(document.getElementById('trendChart'), {
        type: 'bar',
        data: {
            labels: chartData.map(d => d.month),
            datasets: [
                {
                    label: 'Gaji',
                    data: chartData.map(d => d.amount),
                    backgroundColor: '#7c3aedaa',
                    borderColor: '#7c3aed',
                    borderWidth: 2,
                    borderRadius: 6,
                },
                {
                    label: 'Dialokasi',
                    data: chartData.map(d => d.allocated),
                    backgroundColor: '#06b6d4aa',
                    borderColor: '#06b6d4',
                    borderWidth: 2,
                    borderRadius: 6,
                },
                {
                    label: 'Sisa',
                    data: chartData.map(d => d.remaining),
                    backgroundColor: '#10b98199',
                    borderColor: '#10b981',
                    borderWidth: 2,
                    borderRadius: 6,
                    type: 'line',
                    tension: 0.4,
                    fill: false,
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { labels: { color: '#94a3b8', font: { size: 11 } } },
                tooltip: {
                    callbacks: {
                        label: ctx => ' Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                x: { ticks: { color: '#64748b' }, grid: { color: '#2a2a4a44' } },
                y: { ticks: { color: '#64748b', callback: v => 'Rp '+v.toLocaleString('id-ID') }, grid: { color: '#2a2a4a44' } }
            }
        }
    });
}
</script>
@endpush
