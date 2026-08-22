<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitaze &mdash; Daftar Akun</title>

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
                    Registrasi Pengantin
                </span>
                <h2 class="font-serif text-2xl font-bold text-stone-900">Buat Akun Baru ✨</h2>
                <p class="text-xs text-stone-500">Mulai kelola daftar tamu & studio desain undanganmu.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Nama Lengkap / Pasangan -->
                <div>
                    <label for="name" class="text-[11px] font-bold uppercase tracking-wider text-stone-600 block mb-1.5">
                        Nama Pasangan / Lengkap
                    </label>
                    <div class="relative">
                        <i class="ph-bold ph-users-three absolute left-3.5 top-3 text-rose-400 text-base"></i>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            placeholder="contoh: Dimas & Sarah"
                            class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-white border border-rose-200/80 text-sm text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition shadow-sm" />
                    </div>
                    @error('name')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="text-[11px] font-bold uppercase tracking-wider text-stone-600 block mb-1.5">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <i class="ph-bold ph-envelope-simple absolute left-3.5 top-3 text-rose-400 text-base"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            placeholder="nama@email.com"
                            class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-white border border-rose-200/80 text-sm text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition shadow-sm" />
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="text-[11px] font-bold uppercase tracking-wider text-stone-600 block mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <i class="ph-bold ph-lock-key absolute left-3.5 top-3 text-rose-400 text-base"></i>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-white border border-rose-200/80 text-sm text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition shadow-sm" />
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="text-[11px] font-bold uppercase tracking-wider text-stone-600 block mb-1.5">
                        Konfirmasi Kata Sandi
                    </label>
                    <div class="relative">
                        <i class="ph-bold ph-shield-check absolute left-3.5 top-3 text-rose-400 text-base"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi kata sandi"
                            class="w-full pl-10 pr-4 py-2.5 rounded-2xl bg-white border border-rose-200/80 text-sm text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition shadow-sm" />
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1.5 text-xs text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold shadow-md shadow-rose-200 transition-all duration-150 flex items-center justify-center gap-2">
                        <i class="ph-bold ph-user-plus text-base"></i>
                        <span>Daftar Akun</span>
                    </button>
                </div>

                <!-- Link ke Halaman Login -->
                <div class="text-center pt-4 border-t border-rose-100">
                    <p class="text-xs text-stone-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-rose-600 hover:text-rose-700 hover:underline transition ml-1">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- FOOTER PROFIL PREVIEW -->
        <div class="mt-6 flex items-center gap-2 text-stone-400 text-xs">
            <i class="ph-fill ph-sparkle text-rose-400"></i>
            <span>Invitaze Wedding Edition &bull; {{ date('Y') }}</span>
        </div>
    </div>

</body>

</html>