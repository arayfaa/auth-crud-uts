<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Edit Departemen') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi departemen <strong>{{ $department->name }}</strong></p>
            </div>
            <a href="{{ route('departments.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-900">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <form action="{{ route('departments.update', $department) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Departemen -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                            Nama Departemen <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-rose-400 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">
                            Deskripsi / Keterangan (Opsional)
                        </label>
                        <textarea name="description" id="description" rows="4" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-rose-400 @enderror">{{ old('description', $department->description) }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('departments.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition">
                            Perbarui Departemen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
