<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Detail Pegawai: ') }} {{ $employee->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap data pegawai dan status kepegawaian</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('employees.index') }}" class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg transition">
                    &larr; Kembali
                </a>
                <a href="{{ route('employees.edit', $employee) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    Edit Data
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Profile Summary Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 pb-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center font-extrabold text-2xl shadow-md">
                            {{ strtoupper(substr($employee->name, 0, 1)) }}
                        </div>
                        <div>
                            <h1 class="text-2xl font-extrabold text-gray-900">{{ $employee->name }}</h1>
                            <p class="text-sm font-medium text-emerald-600 mt-0.5">{{ $employee->position }}</p>
                        </div>
                    </div>
                    <div>
                        @if($employee->department)
                            <a href="{{ route('departments.show', $employee->department) }}" class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                                📁 Departemen {{ $employee->department->name }}
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Grid Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="p-4 bg-gray-50 rounded-xl space-y-1">
                        <span class="text-xs font-semibold uppercase text-gray-400">Gaji Pokok Per Bulan</span>
                        <p class="text-xl font-mono font-bold text-gray-900">
                            Rp {{ number_format($employee->salary, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl space-y-1">
                        <span class="text-xs font-semibold uppercase text-gray-400">Tanggal Mulai Bekerja</span>
                        <p class="text-base font-semibold text-gray-900">
                            {{ $employee->joined_at ? $employee->joined_at->translatedFormat('d F Y') : '-' }}
                            @if($employee->joined_at)
                                <span class="text-xs font-normal text-gray-500 block mt-0.5">
                                    ({{ $employee->joined_at->diffForHumans(['parts' => 2]) }})
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl space-y-1">
                        <span class="text-xs font-semibold uppercase text-gray-400">Terdaftar Pada Sistem</span>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $employee->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl space-y-1">
                        <span class="text-xs font-semibold uppercase text-gray-400">Terakhir Diperbarui</span>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $employee->updated_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai {{ $employee->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 hover:bg-rose-100 font-semibold rounded-lg text-sm transition">
                            Hapus Pegawai Ini
                        </button>
                    </form>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg text-sm transition">
                            Daftar Pegawai
                        </a>
                        <a href="{{ route('employees.edit', $employee) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg text-sm shadow-sm transition">
                            Edit Pegawai
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
