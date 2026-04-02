@extends('salary.layout')

@section('title', 'Input Gaji')
@section('topbar-title', '💵 Input & Riwayat Gaji')

@push('styles')
<style>
.preview-box {
    background: var(--bg-panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    margin-top: 16px;
    display: none;
}
.preview-box.show { display: block; animation: fadeInUp .3s ease; }
.preview-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid rgba(42,42,74,.5);
    font-size: .875rem;
}
.preview-item:last-child { border-bottom: none; }
.preview-item .cat-info { display: flex; align-items: center; gap: 8px; }
.preview-item .cat-amount { font-weight: 700; color: var(--text-1); }
.preview-total {
    display: flex;
    justify-content: space-between;
    padding: 14px 0 4px;
    font-weight: 700;
    font-size: 1rem;
    border-top: 2px solid var(--border);
    margin-top: 8px;
}
.preview-remaining {
    background: rgba(16,185,129,.1);
    border: 1px solid rgba(16,185,129,.2);
    border-radius: 8px;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}
.section-divider {
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: var(--text-3);
    padding: 8px 0 6px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.section-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
}
.spin { animation: spin .8s linear infinite; display: inline-block; }
@keyframes spin { from{transform:rotate(0)} to{transform:rotate(360deg)} }
</style>
@endpush

@section('content')
<div class="grid-2">
    <!-- ─── Form Input ─── -->
    <div class="fade-in">
        <div class="card">
            <h3 style="font-size:1.05rem;font-weight:700;margin-bottom:20px">➕ Input Gaji Baru</h3>
            <form id="salaryForm" action="{{ route('salary.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">💰 Nominal Gaji (Rp)</label>
                    <input type="number" name="amount" id="amountInput" class="form-control"
                           placeholder="Contoh: 5000000" min="1"
                           value="{{ old('amount') }}" required
                           style="font-size:1.1rem;font-weight:700">
                    <div style="font-size:.75rem;color:var(--text-3);margin-top:4px" id="amountLabel"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">📅 Bulan</label>
                    <input type="month" name="month" class="form-control"
                           value="{{ old('month', now()->format('Y-m')) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">📝 Catatan (opsional)</label>
                    <textarea name="notes" class="form-control" rows="2"
                              placeholder="Misal: Bonus, THR, dll">{{ old('notes') }}</textarea>
                </div>

                <!-- Preview -->
                <div style="margin-bottom:16px">
                    <button type="button" id="btnPreview" class="btn btn-ghost" style="width:100%">
                        🔍 Preview Pembagian Gaji
                    </button>
                </div>

                <div class="preview-box" id="previewBox">
                    <div style="font-size:.9rem;font-weight:700;margin-bottom:12px;color:var(--text-2)">
                        📊 Hasil Kalkulasi
                    </div>
                    <div id="previewContent"></div>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;margin-top:16px;justify-content:center">
                    💾 Simpan & Hitung Gaji
                </button>
            </form>
        </div>

        <!-- Info Pos Aktif -->
        <div class="card card-sm" style="margin-top:16px">
            <div style="font-size:.8rem;color:var(--text-2)">
                💡 <strong>Tip:</strong> Atur nominal tiap pos di
                <a href="{{ route('salary.categories.index') }}" style="color:#a78bfa;text-decoration:none">Pos Pengeluaran</a>
                sebelum input gaji agar hasil kalkulasi akurat.
            </div>
        </div>
    </div>

    <!-- ─── Riwayat Gaji ─── -->
    <div class="fade-in-2">
        <div class="card">
            <h3 style="font-size:1.05rem;font-weight:700;margin-bottom:16px">🗂️ Riwayat Gaji</h3>
            @if($salaries->isEmpty())
                <div style="text-align:center;padding:40px 0;color:var(--text-3)">
                    <div style="font-size:2.5rem;margin-bottom:10px">📭</div>
                    <div>Belum ada riwayat gaji</div>
                </div>
            @else
            <div style="display:flex;flex-direction:column;gap:10px">
                @foreach($salaries as $s)
                <div style="background:var(--bg-panel);border:1px solid var(--border);border-radius:10px;padding:14px 16px;display:flex;justify-content:space-between;align-items:center">
                    <div>
                        <div style="font-weight:700;font-size:.95rem">{{ $s->month_label }}</div>
                        <div style="font-size:.8rem;color:var(--text-3);margin-top:2px">
                            Sisa: <span style="color:#34d399">Rp {{ number_format($s->remaining,0,',','.') }}</span>
                        </div>
                    </div>
                    <div style="text-align:right">
                        <div style="font-weight:800;color:#a78bfa">
                            Rp {{ number_format($s->amount,0,',','.') }}
                        </div>
                        <div style="display:flex;gap:6px;margin-top:6px;justify-content:flex-end">
                            <a href="{{ route('salary.detail', $s->id) }}" class="btn btn-ghost btn-sm">Detail</a>
                            <form action="{{ route('salary.destroy', $s->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus data gaji {{ $s->month_label }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $salaries->links() }}
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const previewUrl = "{{ route('salary.preview') }}";
const csrfToken  = document.querySelector('meta[name="csrf-token"]').content;

// Format angka ke Rupiah
function rupiah(n) {
    return 'Rp ' + Math.round(n).toLocaleString('id-ID');
}

// Live label saat ketik nominal
document.getElementById('amountInput').addEventListener('input', function () {
    const val = parseFloat(this.value);
    const lbl = document.getElementById('amountLabel');
    lbl.textContent = val > 0 ? '= ' + rupiah(val) : '';
});

// Preview kalkulasi
document.getElementById('btnPreview').addEventListener('click', async function () {
    const amount = document.getElementById('amountInput').value;
    if (!amount || amount <= 0) {
        alert('Masukkan nominal gaji terlebih dahulu!');
        return;
    }

    this.innerHTML = '<span class="spin">⏳</span> Menghitung...';
    this.disabled = true;

    try {
        const res  = await fetch(previewUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({ amount: parseFloat(amount) })
        });
        const data = await res.json();
        renderPreview(data);
    } catch (e) {
        alert('Gagal mengambil data. Coba lagi.');
    } finally {
        this.innerHTML = '🔍 Preview Pembagian Gaji';
        this.disabled = false;
    }
});

function renderPreview(data) {
    const box = document.getElementById('previewBox');
    const content = document.getElementById('previewContent');
    let html = '';

    // Fixed dahulu
    if (data.fixed_breakdown.length > 0) {
        html += `<div class="section-divider">📌 Pengeluaran Tetap (Fixed)</div>`;
        data.fixed_breakdown.forEach(item => {
            html += `
            <div class="preview-item">
                <div class="cat-info">
                    <span>${item.category_icon}</span>
                    <span>${item.category_name}</span>
                </div>
                <span class="cat-amount" style="color:#f87171">${item.formatted_amount}</span>
            </div>`;
        });
        html += `
        <div class="preview-total">
            <span>Total Fixed</span>
            <span style="color:#f87171">- ${rupiah(data.total_fixed)}</span>
        </div>
        <div style="font-size:.8rem;color:var(--text-3);margin-bottom:12px">
            Sisa setelah fixed: <strong style="color:var(--text-1)">${rupiah(data.remaining_after_fixed)}</strong>
        </div>`;
    }

    // Percentage
    if (data.percentage_breakdown.length > 0) {
        html += `<div class="section-divider" style="margin-top:8px">📊 Berdasarkan Persentase (dari sisa)</div>`;
        data.percentage_breakdown.forEach(item => {
            html += `
            <div class="preview-item">
                <div class="cat-info">
                    <span>${item.category_icon}</span>
                    <span>${item.category_name}</span>
                    <span style="font-size:.72rem;color:var(--text-3)">(${item.value}%)</span>
                </div>
                <span class="cat-amount" style="color:#22d3ee">${item.formatted_amount}</span>
            </div>`;
        });
    }

    // Sisa akhir
    html += `
    <div class="preview-remaining" style="margin-top:16px">
        <div>
            <div style="font-size:.75rem;color:#34d399;margin-bottom:2px">🆓 Sisa Bebas</div>
            <div style="font-size:.7rem;color:var(--text-3)">Uang yang bisa digunakan bebas</div>
        </div>
        <div style="font-size:1.15rem;font-weight:800;color:#34d399">${rupiah(data.final_remaining)}</div>
    </div>`;

    content.innerHTML = html;
    box.classList.add('show');
}
</script>
@endpush
