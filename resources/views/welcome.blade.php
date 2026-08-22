<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invitaze &mdash; Platform Undangan Pernikahan Digital Elegan</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400&family=Great+Vibes&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FDFBF7',
                        sand: '#F7F3EB',
                        rosewarm: {
                            50: '#FFF5F5',
                            100: '#FDE8E8',
                            200: '#FCD4D4',
                            300: '#F8A8A8',
                            400: '#F07575',
                            500: '#E04F4F',
                            600: '#C53030',
                            800: '#7B1E1E',
                            900: '#4A1111',
                        },
                        terracotta: '#D47355',
                        darkcharcoal: '#2D2422',
                        warmgray: '#6E6259'
                    },
                    fontFamily: {
                        playfair: ['"Playfair Display"', 'serif'],
                        cormorant: ['"Cormorant Garamond"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        script: ['"Great Vibes"', 'cursive'],
                        cinzel: ['"Cinzel"', 'serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-cream text-stone-800 font-sans antialiased selection:bg-rosewarm-200 min-h-screen flex flex-col justify-between">

    <!-- NAVIGATION HEADER -->
    <header class="w-full bg-white/80 backdrop-blur-md border-b border-rosewarm-100 sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-5 sm:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-rosewarm-500 flex items-center justify-center text-white shadow-md shadow-rosewarm-200 shrink-0">
                    <i class="ph-fill ph-heart text-xl"></i>
                </div>
                <div>
                    <h1 class="font-playfair text-xl font-bold tracking-tight text-stone-900 leading-tight">
                        Invitaze<span class="text-rosewarm-500">.</span>
                    </h1>
                    <p class="text-[10px] text-warmgray tracking-widest uppercase font-semibold">Wedding Studio</p>
                </div>
            </a>

            <!-- Auth Actions -->
            <nav class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('daftartamu') ?? url('/dashboard') }}"
                            class="px-5 py-2.5 rounded-full bg-gradient-to-r from-rosewarm-500 to-terracotta text-white text-xs font-semibold hover:opacity-95 transition shadow-sm flex items-center gap-1.5">
                            <i class="ph-bold ph-squares-four text-sm"></i>
                            <span>Masuk ke Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-full text-xs font-semibold text-stone-700 hover:text-rosewarm-600 transition">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-5 py-2.5 rounded-full bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold transition shadow-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <!-- HERO SECTION -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-5 sm:px-8 py-10 sm:py-16 flex flex-col lg:flex-row items-center justify-between gap-12">
        
        <!-- Left Column: Copywriting -->
        <div class="w-full lg:w-1/2 space-y-6 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rosewarm-100/80 border border-rosewarm-200 text-rosewarm-600 text-xs font-semibold">
                <i class="ph-duotone ph-sparkle text-base"></i>
                <span>Solusi Undangan Digital Masa Kini</span>
            </div>

            <h1 class="font-playfair text-3xl sm:text-5xl lg:text-6xl font-bold text-stone-900 leading-[1.15]">
                Bagikan Momen Bahagiamu dengan <span class="text-rosewarm-500 italic">Elegan</span> & Personal.
            </h1>

            <p class="text-sm sm:text-base text-warmgray max-w-xl mx-auto lg:mx-0 leading-relaxed">
                Buat dan kelola link undangan khusus untuk setiap tamu, atur live studio canvas editor, konfirmasi kehadiran realtime, dan bagikan dengan sekali klik ke WhatsApp.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-2">
                <a href="{{ route('kustomdesain') ?? route('editor.index') }}"
                    class="w-full sm:w-auto px-7 py-3.5 rounded-full bg-gradient-to-r from-rosewarm-500 to-terracotta hover:opacity-95 text-white text-sm font-semibold shadow-lg shadow-rosewarm-200 transition flex items-center justify-center gap-2">
                    <i class="ph-bold ph-pencil-simple text-base"></i>
                    <span>Coba Studio Editor</span>
                </a>
                <a href="{{ route('daftartamu') }}"
                    class="w-full sm:w-auto px-6 py-3.5 rounded-full border border-rosewarm-200 bg-white hover:bg-rosewarm-50 text-stone-700 text-sm font-semibold transition shadow-sm flex items-center justify-center gap-2">
                    <i class="ph-bold ph-users-three text-base text-rosewarm-500"></i>
                    <span>Kelola Daftar Tamu</span>
                </a>
            </div>

            <!-- Quick Feature Highlight -->
            <div class="pt-6 grid grid-cols-3 gap-4 border-t border-rosewarm-100 text-left">
                <div>
                    <h3 class="font-playfair text-xl font-bold text-stone-900">Custom</h3>
                    <p class="text-[11px] text-warmgray mt-0.5">Free drag & drop canvas studio</p>
                </div>
                <div>
                    <h3 class="font-playfair text-xl font-bold text-stone-900">Realtime</h3>
                    <p class="text-[11px] text-warmgray mt-0.5">RSVP & buku tamu langsung tersimpan</p>
                </div>
                <div>
                    <h3 class="font-playfair text-xl font-bold text-stone-900">WhatsApp</h3>
                    <p class="text-[11px] text-warmgray mt-0.5">Generate link personal per tamu</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Interactive Phone Preview Mockup -->
        <div class="w-full lg:w-1/2 flex justify-center items-center relative">
            <div class="absolute -inset-4 bg-gradient-to-tr from-rosewarm-200/50 to-sand rounded-[60px] filter blur-2xl -z-10"></div>

            <div class="w-[300px] sm:w-[320px] bg-stone-900 rounded-[44px] p-3 shadow-2xl border-4 border-stone-800 flex flex-col relative">
                <!-- Phone Notch -->
                <div class="w-28 h-3.5 bg-stone-900 rounded-b-2xl mx-auto z-20 flex-shrink-0"></div>

                <!-- Phone Content Layer -->
                <div class="w-full h-[480px] rounded-[34px] bg-cream p-5 flex flex-col justify-between items-center text-center overflow-hidden border border-rosewarm-100 relative">
                    
                    <span class="text-[9px] uppercase font-bold tracking-widest text-rosewarm-500 bg-rosewarm-100 px-3 py-1 rounded-full">
                        THE WEDDING OF
                    </span>

                    <div class="space-y-1.5 my-auto">
                        <h2 class="font-playfair text-2xl font-bold text-stone-900">Dimas & Sarah</h2>
                        <p class="font-cormorant italic text-sm text-stone-600">Sabtu, 18 Desember 2026</p>
                        
                        <!-- Guest Card Preview -->
                        <div class="mt-4 p-3 bg-white/90 rounded-2xl border border-rosewarm-200 shadow-sm text-left">
                            <p class="text-[8px] uppercase tracking-wider text-warmgray font-semibold">Kepada Yth:</p>
                            <p class="text-xs font-bold text-stone-900 mt-0.5">Tamu Undangan & Partner</p>
                            <span class="inline-block mt-1 text-[8px] text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full font-semibold">
                                Link Resmi
                            </span>
                        </div>
                    </div>

                    <button class="w-full py-2.5 rounded-xl bg-gradient-to-r from-rosewarm-500 to-terracotta text-white text-xs font-semibold shadow-md shadow-rosewarm-200">
                        Buka Undangan 💌
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="border-t border-rosewarm-100 bg-white/60 py-6 text-center text-xs text-warmgray">
        <p>&copy; {{ date('Y') }} Invitaze Wedding Platform. Crafted with love & elegance.</p>
    </footer>

</body>

</html>