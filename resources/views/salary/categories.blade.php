@extends('salary.layout')

@section('title', 'Pos Pengeluaran')
@section('topbar-title', '📋 Manajemen Pos Pengeluaran')

@push('styles')
<style>
.cat-card {
    background: var(--bg-panel);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: border-color .2s, transform .2s;
    cursor: pointer;
}
.cat-card:hover { border-color: #7c3aed44; transform: translateY(-1px); }
.cat-card.inactive { opacity: .5; }
.cat-dot {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.cat-info { flex: 1; min-width: 0; }
.cat-name { font-weight: 700; font-size: .95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.cat-meta { font-size: .75rem; color: var(--text-3); margin-top: 2px; }
.cat-value { font-weight: 800; font-size: 1rem; white-space: nowrap; }

/* Modal */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.7);
    backdrop-filter: blur(4px);
    z-index: 999;
    align-items: center;
    justify-content: center;
}
.modal-overlay.open { display: flex; animation: fadeInUp .2s ease; }
.modal {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 28px;
    width: 100%;
    max-width: 480px;
    box-shadow: 0 20px 60px rgba(0,0,0,.6);
}
.modal-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
.modal-actions { display: flex; gap: 10px; margin-top: 20px; }
.color-grid { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 6px; }
.color-dot {
    width: 28px; height: 28px; border-radius: 50%; cursor: pointer;
    border: 3px solid transparent; transition: transform .15s;
}
.color-dot:hover, .color-dot.active { transform: scale(1.2); border-color: white; }
</style>
@endpush

@section('content')
<!-- Summary Bar -->
@php
    $totalFixed = $categories->where('type','fixed')->where('is_active',true)->sum('value');
    $totalPct   = $categories->where('type','percentage')->where('is_active',true)->sum('value');
@endphp
<div class="stats-grid fade-in" style="grid-template-columns:repeat(3,1fr);margin-bottom:20px">
    <div class="stat-card" style="--stat-color:#6366f1">
        <div class="stat-icon">📌</div>
        <div class="stat-label">Total Fixed</div>
        <div class="stat-value" style="color:#818cf8">Rp {{ number_format($totalFixed,0,',','.') }}</div>
        <div class="stat-sub">{{ $categories->where('type','fixed')->where('is_active',true)->count() }} kategori aktif</div>
    </div>
    <div class="stat-card" style="--stat-color:#10b981">
        <div class="stat-icon">📊</div>
        <div class="stat-label">Total Persentase</div>
        <div class="stat-value" style="color:#34d399">{{ $totalPct }}%</div>
        <div class="stat-sub">Dari sisa setelah fixed</div>
    </div>
    <div class="stat-card" style="--stat-color:#7c3aed">
        <div class="stat-icon">📋</div>
        <div class="stat-label">Total Pos</div>
        <div class="stat-value" style="color:#a78bfa">{{ $categories->count() }}</div>
        <div class="stat-sub">{{ $categories->where('is_active',true)->count() }} aktif</div>
    </div>
</div>

@if($totalPct > 100)
<div class="alert alert-error fade-in">⚠️ Total persentase melebihi 100% ({{ $totalPct }}%). Harap kurangi nilai persentase!</div>
@endif

<div class="grid-2 fade-in-2">
    <!-- ─── Daftar Kategori ─── -->
    <div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
            <h3 style="font-size:1rem;font-weight:700">Daftar Pos</h3>
            <button class="btn btn-primary btn-sm" onclick="openModal()"><span>➕</span> Tambah Pos</button>
        </div>

        <!-- Fixed Section -->
        <div style="font-size:.75rem;font-weight:700;color:var(--text-3);text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px">
            📌 Pengeluaran Tetap (Fixed)
        </div>
        <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:20px">
            @foreach($categories->where('type','fixed') as $cat)
            <div class="cat-card {{ !$cat->is_active ? 'inactive' : '' }}" onclick="openEditModal({{ $cat->id }})">
                <div class="cat-dot" style="background:{{ $cat->color }}22">
                    <span>{{ $cat->icon }}</span>
                </div>
                <div class="cat-info">
                    <div class="cat-name">{{ $cat->name }}</div>
                    <div class="cat-meta">
                        Prioritas {{ $cat->priority }}
                        @if(!$cat->is_active) · <span style="color:#ef4444">Nonaktif</span>@endif
                    </div>
                </div>
                <div>
                    <div class="cat-value" style="color:{{ $cat->color }}">
                        Rp {{ number_format($cat->value,0,',','.') }}
                    </div>
                    <span class="badge badge-fixed" style="float:right;margin-top:4px">Fixed</span>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Percentage Section -->
        <div style="font-size:.75rem;font-weight:700;color:var(--text-3);text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px">
            📊 Berdasarkan Persentase
        </div>
        <div style="display:flex;flex-direction:column;gap:8px">
            @foreach($categories->where('type','percentage') as $cat)
            <div class="cat-card {{ !$cat->is_active ? 'inactive' : '' }}" onclick="openEditModal({{ $cat->id }})">
                <div class="cat-dot" style="background:{{ $cat->color }}22">
                    <span>{{ $cat->icon }}</span>
                </div>
                <div class="cat-info">
                    <div class="cat-name">{{ $cat->name }}</div>
                    <div class="cat-meta">Prioritas {{ $cat->priority }}
                        @if(!$cat->is_active) · <span style="color:#ef4444">Nonaktif</span>@endif
                    </div>
                </div>
                <div>
                    <div class="cat-value" style="color:{{ $cat->color }}">{{ $cat->value }}%</div>
                    <span class="badge badge-pct" style="float:right;margin-top:4px">%</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ─── Form Tambah ─── -->
    <div class="card fade-in-3" id="addFormCard">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:18px">➕ Tambah Pos Baru</h3>
        <form method="POST" action="{{ route('salary.categories.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Pos</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Sewa Kos" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tipe</label>
                <select name="type" id="typeSelect" class="form-control" onchange="toggleTypeHint(this.value)">
                    <option value="fixed">Fixed (Nominal Tetap)</option>
                    <option value="percentage">Percentage (% dari sisa)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" id="valueLabel">Nominal (Rp)</label>
                <input type="number" name="value" class="form-control" placeholder="0" min="0" step="0.01" required>
                <div style="font-size:.72rem;color:var(--text-3);margin-top:4px" id="typeHint">
                    Diisi nominal tetap yang dipotong setiap bulan.
                </div>
            </div>
            <div class="grid-2" style="gap:12px">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Icon (emoji)</label>
                    <input type="text" name="icon" class="form-control" value="💰" maxlength="5" required>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Prioritas</label>
                    <input type="number" name="priority" class="form-control" value="{{ $categories->max('priority') + 1 }}" min="1" required>
                </div>
            </div>
            <div class="form-group" style="margin-top:14px">
                <label class="form-label">Warna</label>
                <input type="hidden" name="color" id="colorInput" value="#7c3aed">
                <div class="color-grid">
                    @foreach(['#7c3aed','#6366f1','#06b6d4','#10b981','#f59e0b','#ef4444','#ec4899','#f97316','#8b5cf6','#14b8a6','#3b82f6','#22c55e'] as $clr)
                    <div class="color-dot {{ $clr === '#7c3aed' ? 'active' : '' }}"
                         style="background:{{ $clr }}"
                         onclick="selectColor('{{ $clr }}', this)">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi (opsional)</label>
                <textarea name="description" class="form-control" rows="2" placeholder="Keterangan singkat..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                ➕ Tambah Pos
            </button>
        </form>
    </div>
</div>

<!-- ─── Modal Edit ─── -->
<div class="modal-overlay" id="editModal">
    <div class="modal" onclick="event.stopPropagation()">
        <div class="modal-title" id="editModalTitle">✏️ Edit Pos Pengeluaran</div>
        <form id="editForm" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama Pos</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>
            <div class="grid-2" style="gap:12px">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Tipe</label>
                    <select name="type" id="edit_type" class="form-control">
                        <option value="fixed">Fixed</option>
                        <option value="percentage">Percentage</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" id="edit_value_label">Nilai</label>
                    <input type="number" name="value" id="edit_value" class="form-control" min="0" step="0.01" required>
                </div>
            </div>
            <div class="grid-2" style="gap:12px;margin-top:14px">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Icon</label>
                    <input type="text" name="icon" id="edit_icon" class="form-control" maxlength="5" required>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Prioritas</label>
                    <input type="number" name="priority" id="edit_priority" class="form-control" min="1" required>
                </div>
            </div>
            <div class="form-group" style="margin-top:14px">
                <label class="form-label">Warna</label>
                <input type="hidden" name="color" id="edit_colorInput">
                <div class="color-grid" id="edit_colorGrid">
                    @foreach(['#7c3aed','#6366f1','#06b6d4','#10b981','#f59e0b','#ef4444','#ec4899','#f97316','#8b5cf6','#14b8a6','#3b82f6','#22c55e'] as $clr)
                    <div class="color-dot" style="background:{{ $clr }}" data-color="{{ $clr }}"
                         onclick="selectEditColor('{{ $clr }}', this)"></div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer">
                    <input type="checkbox" name="is_active" id="edit_is_active" value="1" style="width:16px;height:16px">
                    Aktif (kosongkan untuk nonaktifkan)
                </label>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">💾 Simpan</button>
                <button type="button" class="btn btn-ghost" onclick="closeModal()">Batal</button>
            </div>
        </form>
        <form id="deleteForm" method="POST" style="margin-top:10px" onsubmit="return confirm('Hapus pos ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center">🗑️ Hapus Pos Ini</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
const categories = @json($categories->keyBy('id'));

function openModal() {
    document.getElementById('addFormCard').scrollIntoView({ behavior: 'smooth' });
    document.getElementById('addFormCard').style.border = '1px solid #7c3aed';
    setTimeout(() => document.getElementById('addFormCard').style.border = '1px solid var(--border)', 1500);
}

function toggleTypeHint(type) {
    document.getElementById('valueLabel').textContent = type === 'fixed' ? 'Nominal (Rp)' : 'Persentase (%)';
    document.getElementById('typeHint').textContent   = type === 'fixed'
        ? 'Diisi nominal tetap yang dipotong setiap bulan.'
        : 'Contoh: 10 untuk 10% dari sisa gaji setelah fixed.';
}

function selectColor(color, el) {
    document.getElementById('colorInput').value = color;
    document.querySelectorAll('.color-dot:not([data-color])').forEach(d => d.classList.remove('active'));
    el.classList.add('active');
}

function selectEditColor(color, el) {
    document.getElementById('edit_colorInput').value = color;
    document.querySelectorAll('#edit_colorGrid .color-dot').forEach(d => d.classList.remove('active'));
    el.classList.add('active');
}

function openEditModal(id) {
    const cat = categories[id];
    if (!cat) return;
    const base = "{{ url('salary/categories') }}/";
    document.getElementById('editModalTitle').textContent = '✏️ Edit: ' + cat.name;
    document.getElementById('editForm').action = base + id;
    document.getElementById('deleteForm').action = base + id;
    document.getElementById('edit_name').value = cat.name;
    document.getElementById('edit_type').value = cat.type;
    document.getElementById('edit_value').value = cat.value;
    document.getElementById('edit_icon').value = cat.icon;
    document.getElementById('edit_priority').value = cat.priority;
    document.getElementById('edit_is_active').checked = cat.is_active == 1;
    document.getElementById('edit_colorInput').value = cat.color;

    // Highlight selected color
    document.querySelectorAll('#edit_colorGrid .color-dot').forEach(d => {
        d.classList.toggle('active', d.dataset.color === cat.color);
    });
    document.getElementById('edit_value_label').textContent = cat.type === 'fixed' ? 'Nominal (Rp)' : 'Persen (%)';
    document.getElementById('editModal').classList.add('open');
}

function closeModal() {
    document.getElementById('editModal').classList.remove('open');
}

document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

document.getElementById('edit_type').addEventListener('change', function() {
    document.getElementById('edit_value_label').textContent = this.value === 'fixed' ? 'Nominal (Rp)' : 'Persen (%)';
});
</script>
@endpush
