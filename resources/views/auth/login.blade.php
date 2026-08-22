<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitaze &mdash; Masuk Akun</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#FDFBF7] text-stone-800 font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-rose-100 selection:text-rose-700">

    <!-- BACKGROUND ORNAMENTS -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-rose-100/60 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-rose-200/40 blur-3xl"></div>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="flex-1 flex flex-col justify-center items-center px-4 sm:px-6 py-10">

        <!-- LOGO & BRAND (Identik dengan Sidebar) -->
        <div class="mb-6 text-center">
            <a href="/" class="inline-flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl bg-rose-600 flex items-center justify-center text-white shadow-lg shadow-rose-200 group-hover:scale-105 transition-transform duration-200 shrink-0">
                    <i class="ph-fill ph-heart text-2xl"></i>
                </div>
                <div class="text-left">
                    <h1 class="font-serif text-2xl font-bold tracking-tight text-stone-900 leading-tight">
                        Invitaze<span class="text-rose-600">.</span>
                    </h1>
                    <p class="text-[10px] text-stone-400 tracking-widest uppercase font-semibold">Love Edition</p>
                </div>
            </a>
        </div>

        <!-- FORM CARD -->
        <div class="w-full max-w-md bg-stone-50 border border-rose-100 rounded-3xl p-6 sm:p-8 shadow-xl shadow-rose-100/50 relative">

            <div class="text-center mb-6 space-y-1">
                <span class="inline-block text-[10px] uppercase font-bold tracking-wider text-rose-700 bg-rose-100 px-3 py-0.5 rounded-full mb-1">
                    Selamat Datang Kembali
                </span>
                <h2 class="font-serif text-2xl font-bold text-stone-900">Masuk Akun ✨</h2>
                <p class="text-xs text-stone-500">Kelola kembali data undangan & daftar tamu spesialmu.</p>
            </div>

            <!-- SESSION STATUS NOTIFICATION -->
            @if (session('status'))
                <div class="mb-4 p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold flex items-center gap-2">
                    <i class="ph-bold ph-check-circle text-base"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="text-[11px] font-bold uppercase tracking-wider text-stone-600 block mb-1.5">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <i class="ph-bold ph-envelope-simple absolute left-3.5 top-3 text-rose-400 text-base"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            placeholder="nama@email.com"
                            class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-white border border-rose-200/80 text-sm text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition shadow-sm" />
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="text-[11px] font-bold uppercase tracking-wider text-stone-600">
                            Kata Sandi
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] text-rose-600 hover:text-rose-700 hover:underline font-medium transition">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <i class="ph-bold ph-lock-key absolute left-3.5 top-3 text-rose-400 text-base"></i>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Masukkan kata sandi"
                            class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-white border border-rose-200/80 text-sm text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition shadow-sm" />
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center pt-1">
                    <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded-lg border-rose-300 text-rose-600 focus:ring-rose-400 focus:ring-offset-0 cursor-pointer">
                        <span class="text-xs text-stone-600">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold shadow-md shadow-rose-200 transition-all duration-150 flex items-center justify-center gap-2">
                        <i class="ph-bold ph-sign-in text-base"></i>
                        <span>Masuk ke Akun</span>
                    </button>
                </div>

                <!-- Link ke Halaman Register -->
                <div class="text-center pt-4 border-t border-rose-100">
                    <p class="text-xs text-stone-600">
                        Belum memiliki akun?
                        <a href="{{ route('register') }}" class="font-semibold text-rose-600 hover:text-rose-700 hover:underline transition ml-1">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- FOOTER -->
        <div class="mt-6 flex items-center gap-2 text-stone-400 text-xs">
            <i class="ph-fill ph-sparkle text-rose-400"></i>
            <span>Invitaze Wedding Edition &bull; {{ date('Y') }}</span>
        </div>
    </div>

</body>

</html>