<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Detail Departemen: ') }} {{ $department->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap dan daftar pegawai yang bertugas di departemen ini</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('departments.index') }}" class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg transition">
                    &larr; Kembali
                </a>
                <a href="{{ route('departments.edit', $department) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    Edit Departemen
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Department Info Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-gray-100">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </span>
                            <div>
                                <h1 class="text-2xl font-extrabold text-gray-900">{{ $department->name }}</h1>
                                <p class="text-xs text-gray-400 mt-0.5">Dibuat pada {{ $department->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <span class="text-xs text-gray-400 uppercase font-semibold">Total Anggota</span>
                            <p class="text-2xl font-extrabold text-indigo-600">{{ $department->employees->count() }} Pegawai</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Divisi</h4>
                    <p class="text-gray-700 text-sm leading-relaxed bg-gray-50 p-4 rounded-xl">
                        {{ $department->description ?: 'Tidak ada deskripsi tambahan untuk departemen ini.' }}
                    </p>
                </div>
            </div>

            <!-- Employees in this Department -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900 text-base">Daftar Pegawai di {{ $department->name }}</h3>
                        <p class="text-xs text-gray-500">Seluruh staf yang terdaftar dalam departemen ini</p>
                    </div>
                    <a href="{{ route('employees.create') }}" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                        + Tambah Pegawai
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 font-semibold border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3.5">Nama Pegawai</th>
                                <th class="px-6 py-3.5">Jabatan</th>
                                <th class="px-6 py-3.5">Gaji</th>
                                <th class="px-6 py-3.5">Tanggal Bergabung</th>
                                <th class="px-6 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            @forelse($department->employees as $emp)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                                {{ strtoupper(substr($emp->name, 0, 1)) }}
                                            </div>
                                            <span>{{ $emp->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{ $emp->position }}</td>
                                    <td class="px-6 py-4 font-mono text-xs font-semibold text-gray-900">
                                        Rp {{ number_format($emp->salary, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-500">
                                        {{ $emp->joined_at ? $emp->joined_at->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <a href="{{ route('employees.show', $emp) }}" class="text-xs font-medium text-gray-500 hover:text-gray-800 me-3">Detail</a>
                                        <a href="{{ route('employees.edit', $emp) }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-800">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-sm">
                                        Belum ada pegawai yang ditempatkan pada departemen ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
