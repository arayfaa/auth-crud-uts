<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Edit Data Pegawai') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui profil dan status kepegawaian <strong>{{ $employee->name }}</strong></p>
            </div>
            <a href="{{ route('employees.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-900">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Lengkap Pegawai -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                            Nama Lengkap Pegawai <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-rose-400 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-1">
                            Departemen / Divisi <span class="text-rose-500">*</span>
                        </label>
                        <select name="department_id" id="department_id" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('department_id') border-rose-400 @enderror">
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
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
                        <input type="text" name="position" id="position" value="{{ old('position', $employee->position) }}" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('position') border-rose-400 @enderror">
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
                                <input type="number" step="1000" min="0" name="salary" id="salary" value="{{ old('salary', (int)$employee->salary) }}" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 ps-10 @error('salary') border-rose-400 @enderror">
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
                            <input type="date" name="joined_at" id="joined_at" value="{{ old('joined_at', $employee->joined_at ? $employee->joined_at->format('Y-m-d') : '') }}" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('joined_at') border-rose-400 @enderror">
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
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition">
                            Perbarui Data Pegawai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
