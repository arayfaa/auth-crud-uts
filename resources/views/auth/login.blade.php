<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900">
        <div class="w-full max-w-md">

            <!-- Header Branding -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-600 text-white shadow-xl shadow-indigo-500/20 mb-4">
                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    SIM Kepegawaian
                </h1>
                <p class="text-indigo-200 text-sm mt-1">
                    Silakan masuk untuk mengakses dashboard dan manajemen data
                </p>
            </div>

            <!-- Login Card -->
            <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-white/20">

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 ps-10 py-2.5 @error('email') border-rose-400 @enderror" type="email" name="email" value="{{ old('email', 'admin@hrd.com') }}" required autofocus autocomplete="username" placeholder="admin@hrd.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-600 font-medium" />
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-semibold text-gray-700">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 ps-10 py-2.5 @error('password') border-rose-400 @enderror" type="password" name="password" value="password" required autocomplete="current-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-rose-600 font-medium" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember" checked>
                            <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full flex justify-center items-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                            Masuk ke Sistem &rarr;
                        </button>
                    </div>
                </form>

                <!-- Demo Account Helper Box -->
                <div class="mt-6 pt-5 border-t border-gray-100">
                    <div class="p-3 bg-indigo-50/70 border border-indigo-100 rounded-xl text-xs text-gray-600">
                        <p class="font-bold text-indigo-900 mb-1 flex items-center gap-1.5">
                            <span>🔑</span> Akun Demo Tersedia:
                        </p>
                        <div class="flex items-center justify-between mt-1">
                            <span>Email: <strong class="text-indigo-950 font-mono">admin@hrd.com</strong></span>
                            <span>Pass: <strong class="text-indigo-950 font-mono">password</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="mt-6 text-center text-xs text-gray-500">
                    Belum memiliki akun?
                    <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-800">
                        Daftar akun baru di sini
                    </a>
                </div>

            </div>

            <!-- Footer note -->
            <p class="text-center text-xs text-slate-500 mt-6">
                UTS Pemrograman Web &bull; Sistem Informasi Kepegawaian
            </p>
        </div>
    </div>
</x-guest-layout>