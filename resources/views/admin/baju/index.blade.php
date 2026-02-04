@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom mb-1">
                Koleksi <span class="text-accent-gold">Busana</span>
            </h1>
            <p class="text-muted small fw-bold tracking-wide mb-0">Kelola stok dan inventaris kostum.</p>
        </div>
        <a href="{{ route('admin.baju.create') }}"
            class="btn btn-dark fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm" style="font-size: 0.75rem; letter-spacing: 1px;">
            <i class="fas fa-plus me-2"></i> Tambah Koleksi
        </a>
    </div>

    <div class="mb-4 position-relative">
        <div class="position-absolute translate-middle-y top-50 start-0 ps-3">
            <i class="fas fa-search text-muted"></i>
        </div>
        <input type="text" id="searchInput"
            class="form-control ps-5 py-3 border-0 shadow-sm rounded-4 fw-bold"
            placeholder="Cari nama busana...">
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div id="success-alert" class="alert alert-success border-0 border-start border-4 border-success shadow-sm rounded-3 d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 p-2 rounded-circle text-success">
                    <i class="fas fa-check"></i>
                </div>
                <p class="mb-0 fw-bold small text-success">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-0 border-start border-4 border-danger shadow-sm rounded-3 d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-danger bg-opacity-10 p-2 rounded-circle text-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p class="mb-0 fw-bold small text-danger">{{ session('error') }}</p>
            </div>
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="bajuTable">
                <thead class="bg-primary-dark text-white">
                    <tr>
                        <th class="p-4 text-uppercase small fw-bold text-center" style="letter-spacing: 1px; width: 100px;">Foto</th>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Nama Busana</th>
                        <th class="p-4 text-uppercase small fw-bold text-center" style="letter-spacing: 1px;">Stok</th>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Harga Sewa</th>
                        <th class="p-4 text-uppercase small fw-bold text-center" style="letter-spacing: 1px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach ($bajus as $b)
                        <tr class="baju-row group">
                            <td class="p-3 text-center">
                                <div class="mx-auto rounded-3 overflow-hidden border border-2 border-white shadow-sm" style="width: 60px; height: 80px;">
                                    <img src="{{ asset('storage/' . $b->foto) }}" class="w-100 h-100 object-fit-cover">
                                </div>
                            </td>
                            <td class="p-3">
                                <div class="fw-black text-dark h5 mb-0 nama-baju">{{ $b->nama_baju }}</div>
                                <div class="text-uppercase text-muted fw-bold" style="font-size: 10px; letter-spacing: 1px;">ID: #{{ $b->id_baju }}</div>
                            </td>
                            <td class="p-3 text-center">
                                <span class="badge {{ $b->stok > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $b->stok > 0 ? 'text-success' : 'text-danger' }} px-3 py-2 rounded-pill fw-bold" style="font-size: 0.75rem;">
                                    {{ $b->stok }} Pcs
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="fw-bold text-accent-gold">Rp {{ number_format($b->harga_sewa, 0, ',', '.') }}</div>
                                <div class="text-uppercase text-muted fw-bold" style="font-size: 10px;">/ Sewa</div>
                            </td>
                            <td class="p-3 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.baju.edit', $b->id_baju) }}"
                                        class="btn btn-warning btn-sm border-0 text-white rounded-3 shadow-sm p-2"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.baju.destroy', $b->id_baju) }}" method="POST"
                                        id="delete-form-{{ $b->id_baju }}" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $b->id_baju }}', '{{ $b->nama_baju }}')"
                                            class="btn btn-danger btn-sm border-0 rounded-3 shadow-sm p-2"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="noResults" class="d-none p-5 text-center">
            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                <i class="fas fa-search text-muted h3 mb-0"></i>
            </div>
            <h4 class="fw-bold text-dark">Tidak ditemukan</h4>
            <p class="text-muted small">Coba kata kunci lain.</p>
        </div>

        @if ($bajus->isEmpty())
            <div class="p-5 text-center">
                <div class="bg-accent-gold bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
                    <i class="fas fa-tshirt text-accent-gold h2 mb-0 opacity-50"></i>
                </div>
                <h3 class="fw-black text-dark mb-2 text-uppercase">Belum Ada Koleksi</h3>
                <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">Mulai tambahkan koleksi busana untuk disewakan kepada pelanggan setia Anda.</p>
                <a href="{{ route('admin.baju.create') }}"
                    class="btn btn-warning fw-bold text-uppercase px-4 py-2 border-0 shadow-sm" style="background-color: var(--accent-gold); color: white;">
                    Tambah Sekarang
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.baju-row');
            let hasData = false;

            rows.forEach(row => {
                let namaBaju = row.querySelector('.nama-baju').textContent.toLowerCase();
                if (namaBaju.includes(filter)) {
                    row.classList.remove('d-none');
                    hasData = true;
                } else {
                    row.classList.add('d-none');
                }
            });

            let noResults = document.getElementById('noResults');
            if (noResults) {
                if (hasData) {
                    noResults.classList.add('d-none');
                } else {
                    noResults.classList.remove('d-none');
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var notif = document.getElementById('success-alert');
            if (notif) {
                setTimeout(function() {
                    notif.style.display = 'none';
                }, 3000);
            }
        });

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Koleksi?',
                text: "Busana " + name + " akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#1f2937',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#fff',
                color: '#2B2118',
                customClass: {
                    popup: 'rounded-5 px-4',
                    confirmButton: 'rounded-3 fw-bold text-uppercase p-2 px-4 shadow-sm',
                    cancelButton: 'rounded-3 fw-bold text-uppercase p-2 px-4 shadow-sm'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
