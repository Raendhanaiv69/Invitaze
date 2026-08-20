<?php
// Mock data untuk simulasi halaman desain
$event_slug = "dimas-sarah";
$base_invitation_url = "https://invitaze.me/" . $event_slug;

$design = [
    'title' => 'Dimas & Sarah',
    'font' => 'Playfair Display (Serif Elegan)',
    'theme_color' => '#D47355',
];

$templates = [
    [
        'id' => 1,
        'title' => 'Earthy Warmth & Terracotta',
        'category' => 'Boho Romantic',
        'tag' => 'Active Theme',
        'is_active' => true,
        'color_dots' => ['#D47355', '#F7F3EB', '#6E6259'],
        'img' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&auto=format&fit=crop&q=80'
    ],
    [
        'id' => 2,
        'title' => 'Botanical Sage & Olive',
        'category' => 'Minimalist Rustic',
        'tag' => 'Popular',
        'is_active' => false,
        'color_dots' => ['#556B2F', '#E8EFE6', '#2F3E2B'],
        'img' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&auto=format&fit=crop&q=80'
    ],
    [
        'id' => 3,
        'title' => 'Regal Navy & Gold Foliage',
        'category' => 'Modern Luxury',
        'tag' => 'Premium',
        'is_active' => false,
        'color_dots' => ['#1E293B', '#D4AF37', '#F8FAFC'],
        'img' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=600&auto=format&fit=crop&q=80'
    ],
    [
        'id' => 4,
        'title' => 'Serene Blush & Pastel Rose',
        'category' => 'Classic Floral',
        'tag' => 'Trending',
        'is_active' => false,
        'color_dots' => ['#FBCFE8', '#FFF1F2', '#831843'],
        'img' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=600&auto=format&fit=crop&q=80'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitaze &mdash; Kustomisasi Desain</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
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
                        warmgray: '#6E6259'
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-cream text-stone-800 font-sans antialiased selection:bg-rosewarm-200">

    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- MAIN CONTENT WRAPPER -->
        <main class="ml-64 w-full min-h-screen flex flex-col">

            <!-- STICKY TOP HEADER -->
            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-rosewarm-100 flex items-center justify-between px-8 sticky top-0 z-10">
                <div>
                    <h2 class="font-serif text-xl font-bold text-stone-900">Kustomisasi Desain 🎨</h2>
                    <p class="text-xs text-warmgray">Pilih gaya visual, atur tipografi, atau buat tema undangan baru
                        sesuai selera.</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="<?php echo $base_invitation_url; ?>" target="_blank"
                        class="px-4 py-2.5 rounded-full border border-rosewarm-200 bg-white text-stone-700 text-xs font-semibold flex items-center gap-2 hover:bg-rosewarm-50 transition shadow-sm">
                        <i class="ph ph-arrow-square-out text-sm"></i>
                        Preview Website
                    </a>

                    <button onclick="document.getElementById('design-form').submit()"
                        class="px-5 py-2.5 rounded-full bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold flex items-center gap-2 transition shadow-sm">
                        <i class="ph-bold ph-floppy-disk text-sm"></i>
                        Simpan Perubahan
                    </button>

                    <div class="h-8 w-px bg-rosewarm-100 mx-1"></div>

                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-rosewarm-100 border border-rosewarm-200 flex items-center justify-center text-rosewarm-600 font-semibold text-sm">
                            DS
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-stone-900">Dimas & Sarah</p>
                            <p class="text-[10px] text-warmgray">18 Desember 2026</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT CONTAINER -->
            <section class="p-8 space-y-8 flex-1">

                <!-- FORM SETTINGS CARD -->
                {{-- <form id="design-form" method="POST" action="">
                    <div class="bg-white p-6 md:p-8 rounded-2xl border border-rosewarm-100 shadow-sm space-y-6">
                        <div class="border-b border-stone-100 pb-4">
                            <h3 class="font-serif text-lg font-bold text-stone-900">Pengaturan Dasar Desain Undangan
                            </h3>
                            <p class="text-xs text-warmgray mt-0.5">Sesuaikan tipografi dan warna utama undangan web
                                kamu.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- NAMA PASANGAN / JUDUL ACARA -->
                            <div>
                                <label class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Nama
                                    Pasangan / Judul</label>
                                <input type="text" name="event_title"
                                    value="<?php echo htmlspecialchars($design['title']); ?>"
                                    class="w-full mt-2 px-4 py-2.5 rounded-xl bg-sand/30 border border-stone-200 text-sm focus:outline-none focus:border-rosewarm-400">
                            </div>

                            <!-- PILIHAN FONT -->
                            <div>
                                <label class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Gaya Font
                                    Header</label>
                                <select name="font_family"
                                    class="w-full mt-2 px-4 py-2.5 rounded-xl bg-sand/30 border border-stone-200 text-sm focus:outline-none focus:border-rosewarm-400">
                                    <option <?php echo ($design['font'] === 'Playfair Display (Serif Elegan)') ? 'selected' : ''; ?>>Playfair Display (Serif Elegan)</option>
                                    <option>Cinzel (Classic Royal)</option>
                                    <option>Plus Jakarta Sans (Modern Minimalist)</option>
                                    <option>Great Vibes (Handwriting Calligraphy)</option>
                                </select>
                            </div>

                            <!-- SKEMA WARNA AKSEN -->
                            <div>
                                <label class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Palet Warna
                                    Aksen</label>
                                <div class="flex items-center gap-3 mt-3">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="theme_color" value="#D47355" class="sr-only peer"
                                            checked>
                                        <div
                                            class="w-7 h-7 rounded-full bg-[#D47355] border-2 border-transparent peer-checked:border-stone-900 peer-checked:scale-110 shadow-sm transition">
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="theme_color" value="#556B2F" class="sr-only peer">
                                        <div
                                            class="w-7 h-7 rounded-full bg-[#556B2F] border-2 border-transparent peer-checked:border-stone-900 peer-checked:scale-110 shadow-sm transition">
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="theme_color" value="#1E293B" class="sr-only peer">
                                        <div
                                            class="w-7 h-7 rounded-full bg-[#1E293B] border-2 border-transparent peer-checked:border-stone-900 peer-checked:scale-110 shadow-sm transition">
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="theme_color" value="#F43F5E" class="sr-only peer">
                                        <div
                                            class="w-7 h-7 rounded-full bg-[#F43F5E] border-2 border-transparent peer-checked:border-stone-900 peer-checked:scale-110 shadow-sm transition">
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> --}}

                <!-- TEMPLATE GALLERY SECTION -->
                <div class="space-y-4">
                    <div>
                        <h3 class="font-serif text-xl font-semibold text-stone-900">Koleksi Desain Pilihan ✨</h3>
                        <p class="text-xs text-warmgray mt-0.5">Pilih tema siap pakai atau buat desain dari awal dengan
                            kanvas kosong.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                        <!-- KARTU 0: HALAMAN KOSONG / KREASI SENDIRI (BLANK CANVAS) -->
                        <a href="{{ route('editor', ['new' => 1]) }}"
                            class="group bg-white rounded-2xl border-2 border-dashed border-rosewarm-200 hover:border-rosewarm-400 p-5 flex flex-col justify-between transition hover:shadow-md bg-gradient-to-b from-white to-sand/20 cursor-pointer block">
                            <div class="space-y-4">
                                <div
                                    class="h-44 rounded-xl bg-sand/50 border border-stone-200/60 flex flex-col items-center justify-center p-4 text-center group-hover:bg-rosewarm-50/60 transition">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-white border border-rosewarm-200 flex items-center justify-center text-terracotta shadow-sm group-hover:scale-110 transition">
                                        <i class="ph-bold ph-plus text-2xl"></i>
                                    </div>
                                    <span
                                        class="mt-3 text-[10px] font-bold uppercase tracking-wider text-rosewarm-500 bg-rosewarm-100/60 px-2.5 py-0.5 rounded-full">
                                        Kanvas Kosong
                                    </span>
                                </div>

                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-warmgray">Custom
                                        Builder</span>
                                    <h4 class="font-serif text-base font-bold text-stone-900 mt-1 leading-snug">Mulai
                                        Dari Awal</h4>
                                    <p class="text-[11px] text-warmgray mt-1 leading-relaxed">Atur layout, ornamen,
                                        palet warna, dan elemen sesuka hatimu.</p>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-stone-100 mt-4">
                                <span
                                    class="w-full py-2.5 rounded-xl bg-gradient-to-r from-rosewarm-500 to-terracotta text-white text-xs font-semibold flex items-center justify-center gap-1.5 shadow-sm group-hover:opacity-95 transition">
                                    <i class="ph-bold ph-paint-brush text-sm"></i>
                                    Buat Desain Sendiri
                                </span>
                            </div>
                        </a>

                        <!-- TEMPLATE PRESETS LAINNYA -->
                        <?php foreach ($templates as $t): ?>
                        <div
                            class="group bg-white rounded-2xl border <?php    echo $t['is_active'] ? 'border-rosewarm-400 ring-2 ring-rosewarm-300/50' : 'border-rosewarm-100'; ?> overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">

                            <!-- Thumbnail Area -->
                            <div class="relative h-48 overflow-hidden">
                                <img src="<?php    echo $t['img']; ?>"
                                    alt="<?php    echo htmlspecialchars($t['title']); ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                                <div class="absolute top-3 left-3">
                                    <span
                                        class="px-3 py-1 rounded-full <?php    echo $t['is_active'] ? 'bg-rosewarm-500 text-white' : 'bg-stone-900/80 backdrop-blur-md text-white'; ?> text-[10px] font-semibold tracking-wide shadow-sm">
                                        <?php    echo $t['tag']; ?>
                                    </span>
                                </div>

                                <div
                                    class="absolute bottom-3 right-3 flex items-center gap-1.5 bg-white/90 backdrop-blur-md px-2 py-1 rounded-full shadow-sm">
                                    <?php    foreach ($t['color_dots'] as $color): ?>
                                    <span class="w-2.5 h-2.5 rounded-full"
                                        style="background-color: <?php        echo $color; ?>;"></span>
                                    <?php    endforeach; ?>
                                </div>
                            </div>

                            <!-- Card Info & Actions -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                                <div>
                                    <span
                                        class="text-[10px] uppercase font-bold tracking-wider text-rosewarm-500"><?php    echo $t['category']; ?></span>
                                    <h4 class="font-serif text-base font-bold text-stone-900 mt-1 leading-snug">
                                        <?php    echo htmlspecialchars($t['title']); ?>
                                    </h4>
                                </div>

                                <div class="pt-3 border-t border-stone-100 flex items-center gap-2">
                                    <?php    if ($t['is_active']): ?>
                                    <button type="button" disabled
                                        class="w-full py-2 rounded-xl bg-rosewarm-50 text-rosewarm-600 text-xs font-bold flex items-center justify-center gap-1.5 cursor-default">
                                        <i class="ph-bold ph-check"></i> Sedang Digunakan
                                    </button>
                                    <?php    else: ?>
                                    <button type="button"
                                        class="w-full py-2 rounded-xl bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold transition">
                                        Gunakan Tema
                                    </button>
                                    <?php    endif; ?>
                                    <button type="button"
                                        class="p-2 rounded-xl bg-sand hover:bg-rosewarm-100 text-stone-700 transition"
                                        title="Live Preview">
                                        <i class="ph-bold ph-eye text-sm"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>

            </section>

        </main>

    </div>

</body>

</html>