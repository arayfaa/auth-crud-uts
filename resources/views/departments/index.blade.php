<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Data Departemen') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola struktur departemen atau divisi perusahaan</p>
            </div>
            <div>
                <a href="{{ route('departments.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Departemen
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Alerts -->
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-emerald-500 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-sm font-bold">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-rose-500 me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium text-rose-800">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 text-sm font-bold">&times;</button>
                </div>
            @endif

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Search & Actions Bar -->
                <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <form method="GET" action="{{ route('departments.index') }}" class="flex items-center gap-2 w-full sm:w-80">
                        <div class="relative w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau deskripsi..." class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 ps-10 pe-4 py-2">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition">
                            Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('departments.index') }}" class="px-3 py-2 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-lg text-sm transition">
                                Reset
                            </a>
                        @endif
                    </form>
                    <span class="text-xs text-gray-500">
                        Total: <strong class="text-gray-900">{{ $departments->total() }}</strong> Departemen
                    </span>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 font-semibold border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3.5 w-16 text-center">#</th>
                                <th class="px-6 py-3.5">Nama Departemen</th>
                                <th class="px-6 py-3.5">Deskripsi</th>
                                <th class="px-6 py-3.5 text-center">Jumlah Pegawai</th>
                                <th class="px-6 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            @forelse($departments as $index => $dept)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-6 py-4 text-center text-xs text-gray-400">
                                        {{ $departments->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">
                                        <div class="flex items-center gap-2">
                                            <span class="p-1.5 bg-blue-50 text-blue-600 rounded-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </span>
                                            <a href="{{ route('departments.show', $dept) }}" class="hover:text-indigo-600">
                                                {{ $dept->name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 max-w-md">
                                        {{ $dept->description ?: '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('employees.index', ['department_id' => $dept->id]) }}" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition" title="Lihat pegawai dalam departemen ini">
                                            {{ $dept->employees_count }} Orang
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('departments.show', $dept) }}" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('departments.edit', $dept) }}" class="p-1.5 text-indigo-600 hover:text-indigo-800 hover:bg-indigo-50 rounded-lg transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('departments.destroy', $dept) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus departemen {{ $dept->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-rose-600 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            <p class="font-medium text-gray-600">Belum ada departemen yang terdaftar</p>
                                            <p class="text-xs text-gray-400 mt-1">Mulai dengan menambahkan data departemen baru.</p>
                                            <a href="{{ route('departments.create') }}" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-semibold hover:bg-indigo-700 transition">
                                                + Tambah Departemen
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($departments->hasPages())
                    <div class="p-5 border-t border-gray-100">
                        {{ $departments->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
