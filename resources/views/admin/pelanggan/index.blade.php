@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom mb-1">
                Data <span class="text-accent-gold">Pelanggan</span>
            </h1>
            <p class="text-muted small fw-bold tracking-wide mb-0">Kelola informasi pelanggan dan riwayat sewa.</p>
        </div>
        <a href="{{ route('admin.pelanggan.create') }}"
            class="btn btn-dark fw-bold text-uppercase px-4 py-2 rounded-3 shadow-sm" style="font-size: 0.75rem; letter-spacing: 1px;">
            <i class="fas fa-plus me-2"></i> Tambah Pelanggan
        </a>
    </div>

    <div class="mb-4 position-relative">
        <div class="position-absolute translate-middle-y top-50 start-0 ps-3">
            <i class="fas fa-search text-muted"></i>
        </div>
        <input type="text" id="searchInput"
            class="form-control ps-5 py-3 border-0 shadow-sm rounded-4 fw-bold"
            placeholder="Cari nama atau nomor telepon...">
    </div>

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

    <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="pelangganTable">
                <thead class="bg-primary-dark text-white">
                    <tr>
                        <th class="p-4 text-uppercase small fw-bold text-center" style="letter-spacing: 1px; width: 60px;">No</th>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Info Pelanggan</th>
                        <th class="p-4 text-uppercase small fw-bold" style="letter-spacing: 1px;">Kontak & Alamat</th>
                        <th class="p-4 text-uppercase small fw-bold text-center" style="letter-spacing: 1px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach ($pelanggans as $p)
                        <tr class="pelanggan-row">
                            <td class="p-4 text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                            <td class="p-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-accent-gold bg-opacity-10 text-accent-gold rounded-circle d-flex align-items-center justify-content-center fw-black" style="width: 45px; height: 45px; font-size: 1.2rem;">
                                        {{ strtoupper(substr($p->nama_pelanggan, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-black text-dark h5 mb-0 nama-pelanggan">{{ $p->nama_pelanggan }}</div>
                                        <div class="text-uppercase text-muted fw-bold" style="font-size: 10px; letter-spacing: 1px;">ID: #{{ $p->id_pelanggan }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="fab fa-whatsapp text-success"></i>
                                    <span class="fw-bold text-dark no-telp">{{ $p->no_hp }}</span>
                                </div>
                                <div class="small text-muted text-truncate" style="max-width: 250px;">
                                    <i class="fas fa-map-marker-alt me-1 opacity-50"></i> {{ $p->alamat }}
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.pelanggan.edit', $p->id_pelanggan) }}"
                                        class="btn btn-warning btn-sm border-0 text-white rounded-3 shadow-sm p-2"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pelanggan.destroy', $p->id_pelanggan) }}" method="POST"
                                        id="delete-form-{{ $p->id_pelanggan }}" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $p->id_pelanggan }}', '{{ $p->nama_pelanggan }}')"
                                            class="btn btn-danger btn-sm border-0 rounded-3 shadow-sm p-2"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
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

        @if ($pelanggans->isEmpty())
            <div class="p-5 text-center">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
                    <i class="fas fa-users text-muted h2 mb-0 opacity-25"></i>
                </div>
                <h3 class="fw-black text-dark mb-2 text-uppercase">Belum Ada Pelanggan</h3>
                <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">Daftar pelanggan yang terdaftar akan muncul di sini.</p>
                <a href="{{ route('admin.pelanggan.create') }}"
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
            let rows = document.querySelectorAll('.pelanggan-row');
            let hasData = false;

            rows.forEach(row => {
                let nama = row.querySelector('.nama-pelanggan').textContent.toLowerCase();
                let telp = row.querySelector('.no-telp').textContent.toLowerCase();
                if (nama.includes(filter) || telp.includes(filter)) {
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
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            }
        });

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Pelanggan?',
                text: "Data pelanggan " + name + " akan dihapus permanen.",
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
