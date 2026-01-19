@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-[#2B2118] tracking-tight">Tambah Koleksi Baju</h1>
                <p class="text-gray-500 mt-1 font-medium">Input data busana baru ke dalam galeri.</p>
            </div>
            <div class="w-16 h-1 bg-[#B37428] rounded-full"></div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 overflow-hidden border border-gray-100">
            <div class="bg-[#2B2118] p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <i class="fas fa-crown text-6xl text-[#B37428]"></i>
                </div>
                <h2 class="text-2xl font-bold text-white relative z-10 uppercase tracking-widest">Tambah Koleksi Baru</h2>
                <p class="text-amber-200/60 text-sm italic mt-1 relative z-10 font-medium">
                    "Pastikan data baju sesuai dengan fisik barang"
                </p>
            </div>

            <form action="{{ route('admin.baju.store') }}" method="POST" enctype="multipart/form-data"
                class="p-10 space-y-6">
                @csrf

                <div>
                    <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Nama Baju /
                        Kostum</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#B37428]">
                            <i class="fas fa-tshirt"></i>
                        </span>
                        <input type="text" name="nama_baju"
                            class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                            placeholder="Contoh: Tari Piring" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Harga Sewa
                            (Rp)</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#B37428] font-black">Rp</span>
                            <input type="number" name="harga_sewa"
                                class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                                placeholder="50000" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Jumlah
                            Stok</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#B37428]">
                                <i class="fas fa-boxes"></i>
                            </span>
                            <input type="number" name="stok"
                                class="w-full bg-orange-50/30 border-2 border-gray-100 pl-12 pr-4 py-4 rounded-2xl focus:border-[#B37428] focus:bg-white outline-none transition-all duration-300 font-medium text-[#2B2118]"
                                placeholder="50" required>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[#2B2118] font-bold text-sm uppercase tracking-widest mb-3">Foto Baju</label>
                    <div class="relative group">
                        <div id="drop-area"
                            class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-[#2B2118]/20 border-dashed rounded-[2rem] group-hover:border-[#B37428] group-hover:bg-amber-50/50 transition-all duration-300 cursor-pointer">
                            <div class="space-y-2 text-center">
                                <div id="upload-icon"
                                    class="w-16 h-16 bg-amber-100 text-[#B37428] rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:rotate-12 transition-all duration-300">
                                    <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                </div>

                                <div class="flex flex-col text-sm text-gray-600">
                                    <span class="font-bold text-[#2B2118] text-base">Upload a file</span>
                                    <span class="text-gray-400 mt-1 italic">PNG, JPG, JPEG up to 2MB</span>
                                </div>
                            </div>
                        </div>

                        <input id="file-upload" name="foto" type="file"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" required
                            onchange="previewImage(event)">
                    </div>

                    <div id="preview-wrapper" class="hidden mt-6 text-center">
                        <div class="relative inline-block">
                            <img id="img-preview"
                                class="w-48 h-64 object-cover rounded-3xl border-4 border-white shadow-2xl mx-auto">
                            <div
                                class="absolute -top-2 -right-2 bg-[#B37428] text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 bg-[#2B2118] text-white font-bold py-5 rounded-2xl hover:bg-[#B37428] transition-all duration-300 shadow-xl shadow-amber-900/20 flex items-center justify-center gap-3 group">
                        <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                        Simpan Koleksi
                    </button>
                    <a href="{{ route('admin.baju.index') }}"
                        class="px-10 py-5 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition-all duration-300 text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const output = document.getElementById('img-preview');
            const wrapper = document.getElementById('preview-wrapper');
            const dropArea = document.getElementById('drop-area');

            reader.onload = function() {
                if (reader.readyState === 2) {
                    output.src = reader.result;
                    wrapper.classList.remove('hidden');
                    dropArea.classList.add('border-[#B37428]', 'bg-amber-50/50');
                }
            }

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endsection
