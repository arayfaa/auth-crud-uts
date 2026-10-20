<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard Kepegawaian') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Sistem Informasi Manajemen Kepegawaian & Departemen</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('departments.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Departemen
                </a>
                <a href="{{ route('employees.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Tambah Pegawai
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Banner -->
            <div class="relative overflow-hidden bg-gradient-to-r from-indigo-700 via-indigo-800 to-slate-900 rounded-2xl shadow-lg p-6 sm:p-8 text-white">
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-block px-3 py-1 rounded-full bg-white/10 text-indigo-200 text-xs font-semibold mb-3 tracking-wide">
                        Sistem Informasi Kepegawaian (SIMPEG)
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        Halo, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="mt-2 text-indigo-100 text-sm sm:text-base leading-relaxed">
                        Selamat datang di portal manajemen data SDM. Anda dapat mengelola departemen dan data pegawai lengkap dengan fungsi Create, Read, Update, dan Delete (CRUD).
                    </p>
                    <div class="mt-5 flex flex-wrap gap-3">
                        <a href="{{ route('departments.index') }}" class="inline-flex items-center gap-2 bg-white text-indigo-900 font-semibold px-4 py-2 rounded-lg text-sm shadow hover:bg-indigo-50 transition">
                            <span>📁</span> Kelola Departemen
                        </a>
                        <a href="{{ route('employees.index') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-white font-semibold px-4 py-2 rounded-lg text-sm shadow transition">
                            <span>👥</span> Kelola Pegawai
                        </a>
                    </div>
                </div>
                <!-- Decorative background elements -->
                <div class="absolute -right-8 -bottom-8 w-64 h-64 rounded-full bg-indigo-500/10 blur-2xl"></div>
                <div class="absolute right-12 top-6 text-white/10 text-9xl font-black select-none pointer-events-none hidden md:block">
                    HR
                </div>
            </div>

            <!-- Metric Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card Departemen -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Departemen</p>
                            <h3 class="text-3xl font-extrabold text-gray-900 mt-2">{{ $totalDepartments }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-sm">
                        <a href="{{ route('departments.index') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 flex items-center gap-1">
                            Buka Menu Departemen &rarr;
                        </a>
                        <a href="{{ route('departments.create') }}" class="text-gray-400 hover:text-indigo-600 font-medium">
                            + Tambah
                        </a>
                    </div>
                </div>

                <!-- Card Pegawai -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Pegawai</p>
                            <h3 class="text-3xl font-extrabold text-gray-900 mt-2">{{ $totalEmployees }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-sm">
                        <a href="{{ route('employees.index') }}" class="text-emerald-600 font-semibold hover:text-emerald-800 flex items-center gap-1">
                            Buka Menu Pegawai &rarr;
                        </a>
                        <a href="{{ route('employees.create') }}" class="text-gray-400 hover:text-emerald-600 font-medium">
                            + Tambah
                        </a>
                    </div>
                </div>

                <!-- Card Estimasi Gaji -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Anggaran Gaji</p>
                            <h3 class="text-2xl font-extrabold text-gray-900 mt-2">
                                Rp {{ number_format($totalPayroll, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-sm">
                        <span class="text-gray-500 text-xs">Akumulasi pengeluaran gaji / bulan</span>
                        <span class="font-medium text-amber-600 text-xs">Payroll Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Two Columns: Recent Employees & Departments Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Employees (2 cols) -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 text-base">Pegawai Terbaru</h3>
                            <p class="text-xs text-gray-500">Daftar pegawai yang baru ditambahkan ke sistem</p>
                        </div>
                        <a href="{{ route('employees.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">
                            Lihat Semua &rarr;
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-400 font-semibold">
                                <tr>
                                    <th class="px-5 py-3">Nama Pegawai</th>
                                    <th class="px-5 py-3">Departemen</th>
                                    <th class="px-5 py-3">Jabatan</th>
                                    <th class="px-5 py-3">Gaji</th>
                                    <th class="px-5 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-600">
                                @forelse($recentEmployees as $emp)
                                    <tr class="hover:bg-gray-50/70 transition">
                                        <td class="px-5 py-3.5 font-medium text-gray-900">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                                    {{ strtoupper(substr($emp->name, 0, 1)) }}
                                                </div>
                                                <span>{{ $emp->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                                {{ $emp->department->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5 text-gray-700">{{ $emp->position }}</td>
                                        <td class="px-5 py-3.5 font-mono text-xs font-semibold text-gray-900">
                                            Rp {{ number_format($emp->salary, 0, ',', '.') }}
                                        </td>
                                        <td class="px-5 py-3.5 text-right whitespace-nowrap">
                                            <a href="{{ route('employees.edit', $emp) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-xs me-3">
                                                Edit
                                            </a>
                                            <a href="{{ route('employees.show', $emp) }}" class="text-gray-500 hover:text-gray-800 font-medium text-xs">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-8 text-center text-gray-400">
                                            <p class="text-sm">Belum ada data pegawai.</p>
                                            <a href="{{ route('employees.create') }}" class="mt-2 inline-block text-xs font-semibold text-emerald-600 hover:underline">
                                                + Tambah Pegawai Pertama
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Departments Overview (1 col) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-gray-900 text-base">Departemen</h3>
                                <p class="text-xs text-gray-500">Distribusi anggota departemen</p>
                            </div>
                            <a href="{{ route('departments.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">
                                Semua &rarr;
                            </a>
                        </div>
                        <div class="p-5 divide-y divide-gray-100">
                            @forelse($recentDepartments as $dept)
                                <div class="py-3 first:pt-0 last:pb-0 flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900">
                                            <a href="{{ route('departments.show', $dept) }}" class="hover:text-indigo-600">
                                                {{ $dept->name }}
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-400 truncate max-w-[180px]">
                                            {{ $dept->description ?: 'Tidak ada deskripsi' }}
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                        {{ $dept->employees_count }} Pegawai
                                    </span>
                                </div>
                            @empty
                                <div class="py-8 text-center text-gray-400">
                                    <p class="text-sm">Belum ada departemen.</p>
                                    <a href="{{ route('departments.create') }}" class="mt-2 inline-block text-xs font-semibold text-indigo-600 hover:underline">
                                        + Tambah Departemen Baru
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
                        <a href="{{ route('departments.create') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">
                            + Tambah Departemen Baru
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>