@extends('salary.layout')

@section('title', 'Detail Gaji — '.$salary->month_label)
@section('topbar-title', '📄 Detail Alokasi — '.$salary->month_label)

@push('styles')
<style>
.alloc-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 16px;
    border-bottom: 1px solid rgba(42,42,74,.5);
    transition: background .15s;
}
.alloc-row:last-child { border-bottom: none; }
.alloc-row:hover { background: rgba(124,58,237,.04); }
.alloc-row.is-paid { opacity: .7; }
.alloc-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; flex-shrink: 0;
}
.alloc-info { flex: 1; min-width: 0; }
.alloc-name { font-weight: 700; font-size: .95rem; }
.alloc-type { font-size: .72rem; color: var(--text-3); margin-top: 2px; }
.alloc-amount { font-size: 1.05rem; font-weight: 800; text-align: right; min-width: 120px; }
.toggle-btn {
    width: 36px; height: 36px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    transition: all .2s;
    flex-shrink: 0;
}
.toggle-btn.unpaid { background: rgba(239,68,68,.1); color: #ef4444; border: 1px solid rgba(239,68,68,.2); }
.toggle-btn.paid   { background: rgba(16,185,129,.15); color: #10b981; border: 1px solid rgba(16,185,129,.3); }
.toggle-btn:hover  { transform: scale(1.1); }

.summary-strip {
    display: flex;
    gap: 16px;
    padding: 16px;
    background: var(--bg-panel);
    border-radius: var(--radius);
    margin-bottom: 16px;
    border: 1px solid var(--border);
}
.strip-item { flex: 1; text-align: center; }
.strip-label { font-size: .7rem; color: var(--text-3); }
.strip-value { font-size: 1rem; font-weight: 800; margin-top: 2px; }

.paid-date { font-size: .7rem; color: #34d399; margin-top: 2px; }
</style>
@endpush

@section('content')
<!-- Back Button -->
<div style="margin-bottom:20px">
    <a href="{{ route('salary.index') }}" class="btn btn-ghost btn-sm">← Kembali</a>
    <a href="{{ route('salary.dashboard') }}" class="btn btn-ghost btn-sm" style="margin-left:8px">📊 Dashboard</a>
</div>

<!-- Summary Strip -->
<div class="summary-strip fade-in">
    <div class="strip-item">
        <div class="strip-label">💰 Gaji Diterima</div>
        <div class="strip-value" style="color:#a78bfa">Rp {{ number_format($salary->amount,0,',','.') }}</div>
    </div>
    <div class="strip-item">
        <div class="strip-label">📌 Fixed</div>
        <div class="strip-value" style="color:#f87171">Rp {{ number_format($salary->total_fixed,0,',','.') }}</div>
    </div>
    <div class="strip-item">
        <div class="strip-label">📊 Persentase</div>
        <div class="strip-value" style="color:#22d3ee">Rp {{ number_format($salary->total_percentage,0,',','.') }}</div>
    </div>
    <div class="strip-item">
        <div class="strip-label">🆓 Sisa Bebas</div>
        <div class="strip-value" style="color:#34d399">Rp {{ number_format($salary->remaining,0,',','.') }}</div>
    </div>
</div>

<!-- Stats: Paid / Unpaid -->
<div class="grid-2 fade-in" style="margin-bottom:20px">
    <div class="stat-card" style="--stat-color:#10b981">
        <div class="stat-icon">✅</div>
        <div class="stat-label">Sudah Dibayar</div>
        <div class="stat-value" style="color:#34d399" id="paidCount">
            {{ $salary->allocations->where('is_paid', true)->count() }} pos
        </div>
        <div class="stat-sub">
            Rp <span id="paidAmount">{{ number_format($salary->allocations->where('is_paid',true)->sum('amount_allocated'),0,',','.') }}</span>
        </div>
    </div>
    <div class="stat-card" style="--stat-color:#f59e0b">
        <div class="stat-icon">⏳</div>
        <div class="stat-label">Belum Dibayar</div>
        <div class="stat-value" style="color:#fbbf24" id="unpaidCount">
            {{ $salary->allocations->where('is_paid', false)->count() }} pos
        </div>
        <div class="stat-sub">
            Rp <span id="unpaidAmount">{{ number_format($salary->allocations->where('is_paid',false)->sum('amount_allocated'),0,',','.') }}</span>
        </div>
    </div>
</div>

<!-- Alokasi Detail -->
<div class="card fade-in-2">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px">
        <h3 style="font-size:1rem;font-weight:700">📋 Rincian Alokasi</h3>
        <span style="font-size:.75rem;color:var(--text-3)">Klik tombol untuk toggle lunas/belum</span>
    </div>

    <!-- Fixed Section -->
    <div style="font-size:.7rem;font-weight:700;color:var(--text-3);text-transform:uppercase;
                letter-spacing:.08em;padding:14px 16px 6px">📌 Pengeluaran Tetap</div>

    @foreach($salary->allocations->sortBy('category.priority') as $alloc)
        @if($alloc->category->type === 'fixed')
        <div class="alloc-row {{ $alloc->is_paid ? 'is-paid' : '' }}" id="row-{{ $alloc->id }}">
            <div class="alloc-icon" style="background:{{ $alloc->category->color }}22">
                {{ $alloc->category->icon }}
            </div>
            <div class="alloc-info">
                <div class="alloc-name">{{ $alloc->category->name }}</div>
                <div class="alloc-type">
                    Fixed · Prioritas {{ $alloc->category->priority }}
                    @if($alloc->is_paid && $alloc->paid_at)
                        <span class="paid-date">· Dibayar {{ $alloc->paid_at->format('d M Y') }}</span>
                    @endif
                </div>
            </div>
            <div class="alloc-amount" style="color:{{ $alloc->category->color }}">
                Rp {{ number_format($alloc->amount_allocated,0,',','.') }}
            </div>
            <div>
                <span class="badge {{ $alloc->is_paid ? 'badge-paid' : 'badge-unpaid' }}" id="badge-{{ $alloc->id }}" style="margin-right:8px">
                    {{ $alloc->is_paid ? '✅ Lunas' : '⏳ Belum' }}
                </span>
            </div>
            <button class="toggle-btn {{ $alloc->is_paid ? 'paid' : 'unpaid' }}"
                    id="btn-{{ $alloc->id }}"
                    onclick="togglePaid({{ $alloc->id }}, this)"
                    title="{{ $alloc->is_paid ? 'Tandai belum lunas' : 'Tandai lunas' }}">
                {{ $alloc->is_paid ? '✅' : '○' }}
            </button>
        </div>
        @endif
    @endforeach

    <!-- Percentage Section -->
    <div style="font-size:.7rem;font-weight:700;color:var(--text-3);text-transform:uppercase;
                letter-spacing:.08em;padding:14px 16px 6px;border-top:1px solid var(--border);margin-top:8px">
        📊 Berdasarkan Persentase
    </div>

    @foreach($salary->allocations->sortBy('category.priority') as $alloc)
        @if($alloc->category->type === 'percentage')
        <div class="alloc-row {{ $alloc->is_paid ? 'is-paid' : '' }}" id="row-{{ $alloc->id }}">
            <div class="alloc-icon" style="background:{{ $alloc->category->color }}22">
                {{ $alloc->category->icon }}
            </div>
            <div class="alloc-info">
                <div class="alloc-name">{{ $alloc->category->name }}</div>
                <div class="alloc-type">
                    {{ $alloc->category->value }}% dari sisa · Prioritas {{ $alloc->category->priority }}
                    @if($alloc->is_paid && $alloc->paid_at)
                        <span class="paid-date">· Dibayar {{ $alloc->paid_at->format('d M Y') }}</span>
                    @endif
                </div>
            </div>
            <div class="alloc-amount" style="color:{{ $alloc->category->color }}">
                Rp {{ number_format($alloc->amount_allocated,0,',','.') }}
            </div>
            <div>
                <span class="badge {{ $alloc->is_paid ? 'badge-paid' : 'badge-unpaid' }}" id="badge-{{ $alloc->id }}">
                    {{ $alloc->is_paid ? '✅ Lunas' : '⏳ Belum' }}
                </span>
            </div>
            <button class="toggle-btn {{ $alloc->is_paid ? 'paid' : 'unpaid' }}"
                    id="btn-{{ $alloc->id }}"
                    onclick="togglePaid({{ $alloc->id }}, this)"
                    title="{{ $alloc->is_paid ? 'Tandai belum lunas' : 'Tandai lunas' }}">
                {{ $alloc->is_paid ? '✅' : '○' }}
            </button>
        </div>
        @endif
    @endforeach

    <!-- Sisa Bebas -->
    <div style="padding:16px;margin-top:12px;border-top:2px solid var(--border);
                display:flex;justify-content:space-between;align-items:center;
                background:rgba(16,185,129,.06);border-radius:0 0 var(--radius-lg) var(--radius-lg)">
        <div style="display:flex;align-items:center;gap:10px">
            <span style="font-size:1.5rem">🆓</span>
            <div>
                <div style="font-weight:700">Sisa Bebas</div>
                <div style="font-size:.75rem;color:var(--text-3)">Bisa digunakan sesukamu</div>
            </div>
        </div>
        <div style="font-size:1.3rem;font-weight:800;color:#34d399">
            Rp {{ number_format($salary->remaining,0,',','.') }}
        </div>
    </div>
</div>

@if($salary->notes)
<div class="card card-sm fade-in-3" style="margin-top:16px">
    <div style="font-size:.8rem;color:var(--text-3)">📝 Catatan:</div>
    <div style="margin-top:4px">{{ $salary->notes }}</div>
</div>
@endif
@endsection

@push('scripts')
<script>
const csrfToken  = document.querySelector('meta[name="csrf-token"]').content;
const toggleBase = "{{ url('salary/allocations') }}/";

async function togglePaid(id, btn) {
    btn.disabled = true;
    btn.textContent = '⏳';

    try {
        const res  = await fetch(toggleBase + id + '/toggle-paid', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
        });
        const data = await res.json();

        if (data.success) {
            const row   = document.getElementById('row-' + id);
            const badge = document.getElementById('badge-' + id);

            if (data.is_paid) {
                btn.className   = 'toggle-btn paid';
                btn.textContent = '✅';
                badge.className = 'badge badge-paid';
                badge.textContent = '✅ Lunas';
                row.classList.add('is-paid');
            } else {
                btn.className   = 'toggle-btn unpaid';
                btn.textContent = '○';
                badge.className = 'badge badge-unpaid';
                badge.textContent = '⏳ Belum';
                row.classList.remove('is-paid');
            }
        }
    } catch (e) {
        alert('Gagal mengubah status. Coba lagi.');
        btn.textContent = '?';
    } finally {
        btn.disabled = false;
    }
}
</script>
@endpush
