<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900">
        <div class="w-full max-w-md">

            <!-- Header Branding -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-600 text-white shadow-xl shadow-indigo-500/20 mb-4">
                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Daftar Akun Baru
                </h1>
                <p class="text-indigo-200 text-sm mt-1">
                    Buat akun pengguna untuk mengelola sistem kepegawaian
                </p>
            </div>

            <!-- Register Card -->
            <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-white/20">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input id="name" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2.5 @error('name') border-rose-400 @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama Anda" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-rose-600 font-medium" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                            Alamat Email
                        </label>
                        <input id="email" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2.5 @error('email') border-rose-400 @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-600 font-medium" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                            Password
                        </label>
                        <input id="password" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2.5 @error('password') border-rose-400 @enderror" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-600 font-medium" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">
                            Konfirmasi Password
                        </label>
                        <input id="password_confirmation" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2.5 @error('password_confirmation') border-rose-400 @enderror" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-rose-600 font-medium" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center items-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                            Daftar Sekarang &rarr;
                        </button>
                    </div>

                    <div class="text-center text-xs text-gray-500 pt-2">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-800">
                            Masuk di sini
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
