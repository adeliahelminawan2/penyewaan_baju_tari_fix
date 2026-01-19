@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-[#2B2118] tracking-tight">Koleksi Busana</h1>
                <p class="text-gray-500 font-medium">Kelola inventaris kostum tari dan baju adat.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text" id="searchInput"
                        class="block w-full sm:w-64 pl-10 pr-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-[#B37428] focus:border-transparent outline-none transition-all shadow-sm"
                        placeholder="Cari nama busana...">
                </div>

                <a href="{{ route('admin.baju.create') }}"
                    class="flex items-center justify-center gap-2 bg-[#2B2118] text-white px-6 py-3 rounded-2xl font-bold hover:bg-[#B37428] transition-all shadow-lg shadow-amber-900/20">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Koleksi
                </a>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse" id="bajuTable">
                <thead>
                    <tr class="bg-[#2B2118] text-white">
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest">Foto</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest">Nama Busana</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-center">Stok</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest">Harga Sewa</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($bajus as $b)
                        <tr class="baju-row hover:bg-amber-50/30 transition-all">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $b->foto) }}"
                                    class="w-16 h-20 object-cover rounded-xl shadow-md border-2 border-white">
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2B2118] nama-baju">{{ $b->nama_baju }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-orange-100 text-[#B37428] px-3 py-1 rounded-full text-xs font-black">
                                    {{ $b->stok }} Pcs
                                </span>
                            </td>
                            <td class="px-6 py-4 font-black text-[#2B2118]">
                                Rp {{ number_format($b->harga_sewa, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.baju.edit', $b->id_baju) }}"
                                        class="w-10 h-10 bg-[#FFD95A]/30 text-[#B37428] rounded-xl flex items-center justify-center hover:bg-[#FFD95A] transition-all shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.baju.destroy', $b->id_baju) }}" method="POST"
                                        id="delete-form-{{ $b->id_baju }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $b->id_baju }}', '{{ $b->nama_baju }}')"
                                            class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <i class="fa fa-trash"></i>
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
                <p class="text-gray-400 font-medium">Baju yang kamu cari tidak ditemukan.</p>
            </div>

            @if ($bajus->isEmpty())
                <div class="py-20 text-center">
                    <i class="fas fa-tshirt text-gray-200 text-6xl mb-4"></i>
                    <p class="text-gray-400 font-medium">Belum ada koleksi baju.</p>
                </div>
            @endif
        </div>
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
                    row.style.display = "";
                    hasData = true;
                } else {
                    row.style.display = "none";
                }
            });

            document.getElementById('noResults').style.display = hasData ? "none" : "block";
        });

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

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Koleksi?',
                text: "Busana " + name + " akan dihapus permanen.",
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
