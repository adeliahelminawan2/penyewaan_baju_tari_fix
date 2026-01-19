@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-[#2B2118] tracking-tight">Data Pelanggan</h1>
                <p class="text-gray-500 font-medium">Daftar pelanggan setia Busana Laras.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text" id="searchPelanggan"
                        class="block w-full sm:w-64 pl-10 pr-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-[#B37428] focus:border-transparent outline-none transition-all shadow-sm"
                        placeholder="Cari nama pelanggan...">
                </div>

                <a href="{{ route('admin.pelanggan.create') }}"
                    class="flex items-center justify-center gap-2 bg-[#2B2118] text-white px-6 py-3 rounded-2xl font-bold hover:bg-[#B37428] transition-all shadow-lg shadow-amber-900/20">
                    <i class="fas fa-user-plus"></i>
                    Tambah Pelanggan
                </a>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse" id="pelangganTable">
                <thead class="bg-[#2B2118] text-white">
                    <tr>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest w-16 text-center">No</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest">Nama Pelanggan</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest">WhatsApp</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest">Alamat</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @foreach ($pelanggans as $index => $p)
                        <tr class="pelanggan-row hover:bg-orange-50/50 transition-all group">
                            <td class="px-6 py-4 text-center text-gray-400 font-bold">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2B2118] nama-pelanggan">
                                {{ $p->nama_pelanggan }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $p->no_hp) }}" target="_blank"
                                    class="flex items-center gap-2 text-green-600 font-bold hover:underline">
                                    <i class="fab fa-whatsapp text-lg"></i> {{ $p->no_hp }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm italic">
                                {{ Str::limit($p->alamat, 45) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.pelanggan.edit', $p->id_pelanggan) }}"
                                        class="w-10 h-10 bg-[#FFD95A]/30 text-[#B37428] rounded-xl flex items-center justify-center hover:bg-[#FFD95A] transition-all shadow-sm"
                                        title="Edit Pelanggan">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.pelanggan.destroy', $p->id_pelanggan) }}" method="POST"
                                        id="delete-form-{{ $p->id_pelanggan }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $p->id_pelanggan }}', '{{ $p->nama_pelanggan }}')"
                                            class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                            title="Hapus Pelanggan">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="noResults" class="hidden py-20 text-center">
                <i class="fas fa-search text-gray-200 text-6xl mb-4"></i>
                <p class="text-gray-400 font-medium">Pelanggan tidak ditemukan.</p>
            </div>

            @if ($pelanggans->isEmpty())
                <div class="py-20 text-center">
                    <i class="fas fa-users text-gray-200 text-6xl mb-4"></i>
                    <p class="text-gray-400 font-medium">Belum ada data pelanggan.</p>
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('searchPelanggan').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.pelanggan-row');
            let hasData = false;

            rows.forEach(row => {
                let nama = row.querySelector('.nama-pelanggan').textContent.toLowerCase();
                if (nama.includes(filter)) {
                    row.style.display = "";
                    hasData = true;
                } else {
                    row.style.display = "none";
                }
            });

            document.getElementById('noResults').style.display = hasData ? "none" : "block";
        });

        // --- SWEETALERT NOTIFIKASI ---
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
        });

        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#2B2118'
            });
        @endif

        // --- KONFIRMASI HAPUS ---
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Pelanggan?',
                text: "Data " + name + " akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#2B2118',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
