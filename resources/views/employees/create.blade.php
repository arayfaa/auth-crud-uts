<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Tambah Pegawai Baru') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Lengkapi data profil dan penempatan departemen pegawai baru</p>
            </div>
            <a href="{{ route('employees.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-900">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">

                @if($departments->isEmpty())
                    <div class="mb-6 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-amber-500 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <p class="text-sm font-medium text-amber-800">
                                    Belum ada departemen yang terdaftar. Anda harus membuat departemen terlebih dahulu sebelum menambahkan pegawai.
                                </p>
                            </div>
                            <a href="{{ route('departments.create') }}" class="px-3 py-1.5 bg-amber-600 text-white rounded-lg text-xs font-semibold hover:bg-amber-700 whitespace-nowrap">
                                + Tambah Departemen
                            </a>
                        </div>
                    </div>
                @endif

                <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nama Lengkap Pegawai -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                            Nama Lengkap Pegawai <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso, S.Kom" required class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('name') border-rose-400 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-1">
                            Departemen / Divisi <span class="text-rose-500">*</span>
                        </label>
                        <select name="department_id" id="department_id" required class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('department_id') border-rose-400 @enderror">
                            <option value="">-- Pilih Departemen Penempatan --</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label for="position" class="block text-sm font-semibold text-gray-700 mb-1">
                            Jabatan / Posisi <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="position" id="position" value="{{ old('position') }}" placeholder="Contoh: Fullstack Developer, HR Specialist, Staff Akuntansi" required class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('position') border-rose-400 @enderror">
                        @error('position')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grid: Gaji & Tanggal Bergabung -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Gaji -->
                        <div>
                            <label for="salary" class="block text-sm font-semibold text-gray-700 mb-1">
                                Gaji Pokok Bulanan (Rp) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400 text-sm font-bold">
                                    Rp
                                </span>
                                <input type="number" step="1000" min="0" name="salary" id="salary" value="{{ old('salary') }}" placeholder="Contoh: 7500000" required class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 ps-10 @error('salary') border-rose-400 @enderror">
                            </div>
                            @error('salary')
                                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Bergabung -->
                        <div>
                            <label for="joined_at" class="block text-sm font-semibold text-gray-700 mb-1">
                                Tanggal Mulai Bekerja <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" name="joined_at" id="joined_at" value="{{ old('joined_at', date('Y-m-d')) }}" required class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('joined_at') border-rose-400 @enderror">
                            @error('joined_at')
                                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                        <a href="{{ route('employees.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-sm transition">
                            Simpan Data Pegawai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>