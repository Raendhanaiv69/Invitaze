<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitaze Studio &mdash; Dedicated Design Editor</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400&family=Great+Vibes&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
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
                            400: '#E27367',
                            500: '#C04A3E',
                            600: '#A3372C',
                            800: '#7B2A26',
                            900: '#4A1816',
                        },
                        terracotta: '#E27367',
                        darkcharcoal: '#2D2422',
                        warmgray: '#7A6660'
                    },
                    fontFamily: {
                        playfair: ['"Playfair Display"', 'serif'],
                        cormorant: ['"Cormorant Garamond"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        script: ['"Great Vibes"', 'cursive'],
                        cinzel: ['"Cinzel"', 'serif'],
                        montserrat: ['"Montserrat"', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #E27367;
            border-radius: 10px;
        }

        .font-playfair {
            font-family: 'Playfair Display', serif !important;
        }

        .font-cormorant {
            font-family: 'Cormorant Garamond', serif !important;
        }

        .font-sans {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .font-script {
            font-family: 'Great Vibes', cursive !important;
        }

        .font-cinzel {
            font-family: 'Cinzel', serif !important;
        }

        .font-montserrat {
            font-family: 'Montserrat', sans-serif !important;
        }

        .shape-rect {
            border-radius: 0px;
        }

        .shape-rounded {
            border-radius: 20px;
        }

        .shape-arch {
            border-radius: 9999px 9999px 16px 16px;
        }

        .shape-circle {
            border-radius: 9999px;
        }

        .shape-oval {
            border-radius: 50% / 60% 60% 40% 40%;
        }

        .shape-wave {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }

        .shape-polaroid {
            border-radius: 6px;
            padding-bottom: 24px;
            background-color: #ffffff;
        }

        .shape-heart {
            border-radius: 0px !important;
            clip-path: url(#heartClipPath);
            -webkit-clip-path: url(#heartClipPath);
            background-color: transparent !important;
        }

        .canvas-item {
            touch-action: none;
            user-select: none;
            cursor: grab;
            position: absolute;
            z-index: 10;
        }

        .canvas-item:active {
            cursor: grabbing;
        }

        .canvas-item.is-locked {
            cursor: default !important;
        }

        .canvas-item.active-item {
            outline: 2px dashed #E27367 !important;
            outline-offset: 4px;
            z-index: 50 !important;
        }

        .canvas-item.active-item.is-locked {
            outline: 2px dashed #7A6660 !important;
        }

        .canvas-item [contenteditable="true"] {
            outline: 1.5px dashed #E27367;
            cursor: text !important;
            user-select: text !important;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 6px;
            padding: 2px 4px;
        }

        #centerGuideLine {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 1.5px;
            background: #E27367;
            transform: translateX(-50%);
            pointer-events: none;
            z-index: 40;
            display: none;
        }

        #centerGuideLine::after {
            content: 'TENGAH';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            background: #E27367;
            color: #ffffff;
            font-size: 8px;
            font-weight: 700;
            padding: 1px 4px;
            border-radius: 4px;
            letter-spacing: 0.05em;
        }

        @keyframes spinSlow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .spin-vinyl {
            animation: spinSlow 4s linear infinite;
        }
    </style>
</head>

<body class="bg-cream text-darkcharcoal font-sans h-full flex flex-col antialiased selection:bg-rosewarm-100">

    <svg class="absolute w-0 h-0" aria-hidden="true" focusable="false">
        <defs>
            <clipPath id="heartClipPath" clipPathUnits="objectBoundingBox">
                <path
                    d="M 0.5, 0.95 C 0.5, 0.95 0.03, 0.62 0.01, 0.35 C -0.01, 0.16 0.14, 0.02 0.32, 0.02 C 0.42, 0.02 0.47, 0.08 0.5, 0.14 C 0.53, 0.08 0.58, 0.02 0.68, 0.02 C 0.86, 0.02 1.01, 0.16 0.99, 0.35 C 0.97, 0.62 0.5, 0.95 0.5, 0.95 Z">
                </path>
            </clipPath>
        </defs>
    </svg>

    <div class="flex min-h-screen">

        <!-- SIDEBAR NAVIGATION -->
        @include('layouts.sidebar')

        <!-- MAIN WORKSPACE -->
        <div class="ml-64 w-full flex flex-col h-screen overflow-hidden">

            <!-- TOP WORKSPACE HEADER -->
            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-rosewarm-100 px-8 flex items-center justify-between z-20 flex-shrink-0">
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="font-playfair font-bold text-xl text-darkcharcoal">Studio Editor Kustomisasi Desain
                            🎨</h1>
                        <span
                            class="bg-rosewarm-100 text-rosewarm-500 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Free
                            Canvas Editor</span>
                    </div>
                    <p class="text-xs text-warmgray mt-0.5">{{ $design['groom_short'] ?? 'Dimas' }} &
                        {{ $design['bride_short'] ?? 'Sarah' }} &bull; Custom Audio & Canvas</p>
                </div>

                <!-- ACTION CONTROLS -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('daftartamu') ?? '/guests' }}"
                        class="px-4 py-2.5 rounded-full border border-rosewarm-200 bg-white text-darkcharcoal text-xs font-semibold hover:bg-rosewarm-50 transition shadow-sm flex items-center gap-1.5">
                        <i class="ph-bold ph-users"></i> Ke Daftar Tamu
                    </a>
                    <button type="button" onclick="clearCanvas()"
                        class="px-4 py-2.5 rounded-full border border-rosewarm-200 bg-white text-darkcharcoal text-xs font-semibold hover:bg-rosewarm-50 transition shadow-sm flex items-center gap-1.5">
                        <i class="ph-bold ph-trash"></i> Bersihkan Kanvas
                    </button>
                    <button type="button" onclick="prepareSubmit()"
                        class="px-5 py-2.5 rounded-full bg-gradient-to-r from-terracotta to-rosewarm-500 hover:opacity-95 text-white text-xs font-semibold flex items-center gap-2 shadow-lg shadow-rosewarm-200 transition">
                        <i class="ph-bold ph-floppy-disk text-sm"></i> Simpan Perubahan
                    </button>
                </div>
            </header>

            <!-- FLASH NOTIFICATION ALERT -->
            @if (session('status_msg') || !empty($status_msg))
                <div
                    class="bg-{{ (session('status_type') ?? $status_type) === 'success' ? 'emerald-600' : 'rosewarm-500' }} text-white text-xs font-semibold px-8 py-2.5 flex items-center justify-between flex-shrink-0 transition-all">
                    <div class="flex items-center gap-2">
                        <i
                            class="ph-bold {{ (session('status_type') ?? $status_type) === 'success' ? 'ph-check-circle' : 'ph-warning-circle' }} text-base"></i>
                        <span>{{ session('status_msg') ?? $status_msg }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-white/80 hover:text-white"><i
                            class="ph-bold ph-x"></i></button>
                </div>
            @endif

            <!-- MAIN WORKSPACE FORM -->
            <form id="editorForm" action="{{ route('editor.save') }}" method="POST" enctype="multipart/form-data"
                class="flex-1 flex overflow-hidden">
                @csrf

                <input type="hidden" name="theme" id="selectedTheme"
                    value="{{ $design['theme'] ?? 'warm-terracotta' }}">
                <input type="hidden" name="canvas_elements_json" id="canvasElementsJson" value="">
                <input type="hidden" name="canvas_config_json" id="canvasConfigJson" value="">
                <input type="hidden" name="bg_music_title" id="bgMusicTitle"
                    value="{{ $design['bg_music_title'] ?? '' }}">
                <input type="hidden" name="bg_music_url" id="bgMusicUrl" value="{{ $design['bg_music_url'] ?? '' }}">

                <!-- LEFT CONTROL SIDEBAR -->
                <aside
                    class="w-[500px] bg-white border-r border-rosewarm-100 flex flex-col z-10 flex-shrink-0 shadow-sm">

                    <!-- TAB HEADERS -->
                    <div
                        class="flex border-b border-rosewarm-100 bg-sand/40 p-2 gap-1 flex-shrink-0 overflow-x-auto custom-scrollbar">
                        <button type="button" onclick="switchEditorTab('add-elements')" id="tabBtn-add-elements"
                            class="tab-btn flex-1 py-2 px-2.5 rounded-xl text-xs font-semibold text-rosewarm-500 bg-white shadow-sm flex items-center justify-center gap-1 transition whitespace-nowrap">
                            <i class="ph-bold ph-plus-circle text-sm"></i> Elemen
                        </button>
                        <button type="button" onclick="switchEditorTab('media')" id="tabBtn-media"
                            class="tab-btn flex-1 py-2 px-2.5 rounded-xl text-xs font-semibold text-warmgray hover:text-darkcharcoal flex items-center justify-center gap-1 transition whitespace-nowrap">
                            <i class="ph-bold ph-images text-sm"></i> Foto
                        </button>
                        <button type="button" onclick="switchEditorTab('music')" id="tabBtn-music"
                            class="tab-btn flex-1 py-2 px-2.5 rounded-xl text-xs font-semibold text-warmgray hover:text-darkcharcoal flex items-center justify-center gap-1 transition whitespace-nowrap">
                            <i class="ph-bold ph-music-notes text-sm"></i> Musik
                        </button>
                        <button type="button" onclick="switchEditorTab('active-layers')" id="tabBtn-active-layers"
                            class="tab-btn flex-1 py-2 px-2.5 rounded-xl text-xs font-semibold text-warmgray hover:text-darkcharcoal flex items-center justify-center gap-1 transition whitespace-nowrap">
                            <i class="ph-bold ph-stack text-sm"></i> Layer (<span id="layerCount">0</span>)
                        </button>
                        <button type="button" onclick="switchEditorTab('styling')" id="tabBtn-styling"
                            class="tab-btn flex-1 py-2 px-2.5 rounded-xl text-xs font-semibold text-warmgray hover:text-darkcharcoal flex items-center justify-center gap-1 transition whitespace-nowrap">
                            <i class="ph-bold ph-paint-bucket text-sm"></i> Latar
                        </button>
                    </div>

                    <!-- TAB PANELS CONTENT -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar">

                        <!-- TAB 1: TAMBAH ELEMEN TEKS & KOMPONEN -->
                        <div id="panel-add-elements" class="editor-panel space-y-5">
                            <div>
                                <h3 class="font-playfair text-base font-bold text-darkcharcoal">Pilih & Masukkan Elemen
                                </h3>
                                <p class="text-xs text-warmgray mt-0.5">Klik salah satu tombol di bawah untuk memasukkan
                                    elemen ke kanvas.</p>
                            </div>

                            <div class="space-y-2.5">
                                <label
                                    class="text-[11px] font-bold text-darkcharcoal uppercase tracking-wider block">Elemen
                                    Teks Undangan</label>

                                <div class="grid grid-cols-2 gap-2.5">
                                    <button type="button" onclick="addElement('badge', 'THE WEDDING OF')"
                                        class="p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-tag text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Badge Judul</span>
                                            <span class="text-[9px] text-warmgray">"The Wedding Of"</span>
                                        </div>
                                    </button>

                                    <button type="button" onclick="addElement('groom_name', 'Dimas Anggara')"
                                        class="p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-gender-male text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Nama Groom</span>
                                            <span class="text-[9px] text-warmgray">Mempelai Pria</span>
                                        </div>
                                    </button>

                                    <button type="button" onclick="addElement('ampersand', '&')"
                                        class="p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-sketch-logo text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Simbol &</span>
                                            <span class="text-[9px] text-warmgray">Konektor Romantis</span>
                                        </div>
                                    </button>

                                    <button type="button" onclick="addElement('bride_name', 'Sarah Amalia')"
                                        class="p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-gender-female text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Nama Bride</span>
                                            <span class="text-[9px] text-warmgray">Mempelai Wanita</span>
                                        </div>
                                    </button>

                                    <button type="button" onclick="addElement('date', 'Sabtu, 18 Desember 2026')"
                                        class="p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-calendar text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Tanggal Acara</span>
                                            <span class="text-[9px] text-warmgray">Hari & Tanggal</span>
                                        </div>
                                    </button>

                                    <button type="button" onclick="addElement('venue', 'The Plataran Garden, Jakarta')"
                                        class="p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-map-pin text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Lokasi &
                                                Gedung</span>
                                            <span class="text-[9px] text-warmgray">Nama Venue</span>
                                        </div>
                                    </button>

                                    <button type="button"
                                        onclick="addElement('quote', '“Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan pasangan untukmu...”')"
                                        class="col-span-2 p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-quotes text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Kutipan Romantis /
                                                Ayat</span>
                                            <span class="text-[9px] text-warmgray">Teks doa & kutipan</span>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <!-- Kategori: Komponen Interaktif -->
                            <div class="space-y-2.5 pt-3 border-t border-rosewarm-100">
                                <label
                                    class="text-[11px] font-bold text-darkcharcoal uppercase tracking-wider block">Komponen
                                    & Kartu Interaktif</label>

                                <div class="grid grid-cols-2 gap-2.5">
                                    <button type="button" onclick="addElement('guest_card', 'Nama Tamu Undangan')"
                                        class="p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-envelope-open text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Kartu Tamu</span>
                                            <span class="text-[9px] text-warmgray">Kepada Yth.</span>
                                        </div>
                                    </button>

                                    <button type="button"
                                        onclick="addElement('rsvp_button', 'Konfirmasi Kehadiran (RSVP)')"
                                        class="p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-cursor-click text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Tombol RSVP</span>
                                            <span class="text-[9px] text-warmgray">Button Konfirmasi</span>
                                        </div>
                                    </button>

                                    <button type="button"
                                        onclick="addElement('gift_card', 'BCA - 8410293810 (a.n Dimas)')"
                                        class="col-span-2 p-3 bg-sand/30 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-100 text-left transition flex items-center gap-2.5">
                                        <i class="ph-bold ph-gift text-terracotta text-lg"></i>
                                        <div>
                                            <span class="text-xs font-bold text-darkcharcoal block">Kotak Amplop
                                                Digital</span>
                                            <span class="text-[9px] text-warmgray">Nomor Rekening & Bank</span>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <!-- Tambah Teks Custom -->
                            <div class="pt-3 border-t border-rosewarm-100 space-y-2">
                                <label
                                    class="text-[11px] font-bold text-darkcharcoal uppercase tracking-wider block">Tambah
                                    Teks Kustom Bebas</label>
                                <div class="flex gap-2">
                                    <input type="text" id="customTextInput" placeholder="Ketik teks kustom..."
                                        class="flex-1 px-3.5 py-2 rounded-xl bg-sand/40 border border-rosewarm-200 text-xs">
                                    <button type="button" onclick="addCustomText()"
                                        class="px-4 py-2 bg-terracotta text-white rounded-xl text-xs font-semibold hover:bg-rosewarm-600 transition">
                                        + Tambah
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: MEDIA FOTO & BINGKAI -->
                        <div id="panel-media" class="editor-panel hidden space-y-5">
                            <div>
                                <h3 class="font-playfair text-base font-bold text-darkcharcoal">Galeri Aset & Tambah
                                    Foto</h3>
                                <p class="text-xs text-warmgray mt-0.5">Unggah foto lalu klik bentuk bingkai di bawah
                                    untuk memasukkannya ke kanvas.</p>
                            </div>

                            <div id="dropZone" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)"
                                ondrop="handleDrop(event)"
                                class="border-2 border-dashed border-rosewarm-200 rounded-2xl p-5 text-center bg-sand/30 hover:bg-rosewarm-50/50 transition relative cursor-pointer">
                                <input type="file" id="multiFileInput" multiple accept="image/*"
                                    onchange="handleMultipleFiles(event)"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <div class="space-y-1.5 pointer-events-none">
                                    <i class="ph-bold ph-cloud-arrow-up text-2xl text-terracotta"></i>
                                    <p class="text-xs font-bold text-darkcharcoal">Tarik & Lepas foto ke sini</p>
                                    <p class="text-[10px] text-warmgray">atau <span
                                            class="text-terracotta underline font-semibold">klik untuk upload</span></p>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-[11px] font-bold text-darkcharcoal uppercase tracking-wider block">Pustaka
                                    Aset Foto (<span id="photoCount">0</span>)</label>
                                <div id="galleryGrid"
                                    class="grid grid-cols-4 gap-2 max-h-44 overflow-y-auto custom-scrollbar p-1"></div>
                            </div>

                            <div class="pt-3 border-t border-rosewarm-100 space-y-2">
                                <label
                                    class="text-[11px] font-bold text-darkcharcoal uppercase tracking-wider block">Pilihan
                                    Bentuk Bingkai Foto</label>
                                <div class="grid grid-cols-4 gap-2">
                                    <button type="button" onclick="addPhotoFrame('shape-heart')"
                                        class="p-2 bg-rosewarm-100 hover:bg-rosewarm-200 rounded-xl border border-rosewarm-300 text-center text-xs font-bold text-terracotta shadow-sm">💖
                                        Love</button>
                                    <button type="button" onclick="addPhotoFrame('shape-rect')"
                                        class="p-2 bg-sand/40 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-200 text-center text-xs font-medium">▬
                                        Persegi</button>
                                    <button type="button" onclick="addPhotoFrame('shape-arch')"
                                        class="p-2 bg-sand/40 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-200 text-center text-xs font-medium">🏛️
                                        Arch</button>
                                    <button type="button" onclick="addPhotoFrame('shape-circle')"
                                        class="p-2 bg-sand/40 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-200 text-center text-xs font-medium">⚪
                                        Circle</button>
                                    <button type="button" onclick="addPhotoFrame('shape-rounded')"
                                        class="p-2 bg-sand/40 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-200 text-center text-xs font-medium">🔲
                                        Card</button>
                                    <button type="button" onclick="addPhotoFrame('shape-oval')"
                                        class="p-2 bg-sand/40 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-200 text-center text-xs font-medium">🥚
                                        Oval</button>
                                    <button type="button" onclick="addPhotoFrame('shape-wave')"
                                        class="p-2 bg-sand/40 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-200 text-center text-xs font-medium">🌊
                                        Wave</button>
                                    <button type="button" onclick="addPhotoFrame('shape-polaroid')"
                                        class="p-2 bg-sand/40 hover:bg-rosewarm-50 rounded-xl border border-rosewarm-200 text-center text-xs font-medium">📷
                                        Polaroid</button>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: MUSIK & LATAR AUDIO -->
                        <div id="panel-music" class="editor-panel hidden space-y-5">
                            <div>
                                <h3 class="font-playfair text-base font-bold text-darkcharcoal">Musik Latar Undangan
                                    (Audio File)</h3>
                                <p class="text-xs text-warmgray mt-0.5">Unggah file lagu audio MP3/WAV dari perangkat
                                    Anda.</p>
                            </div>

                            <div
                                class="border-2 border-dashed border-rosewarm-200 rounded-2xl p-6 text-center bg-sand/30 hover:bg-rosewarm-50/50 transition relative cursor-pointer">
                                <input type="file" id="customAudioInput" accept="audio/*"
                                    onchange="handleCustomAudioUpload(event)"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <div class="space-y-2 pointer-events-none">
                                    <div
                                        class="w-12 h-12 rounded-full bg-rosewarm-100 text-terracotta flex items-center justify-center mx-auto">
                                        <i class="ph-bold ph-music-notes text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-darkcharcoal">Pilih File Audio dari Perangkat
                                        </p>
                                        <p class="text-[10px] text-warmgray mt-0.5">Mendukung format MP3, WAV, AAC, M4A
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div id="audioActiveContainer"
                                class="p-4 rounded-2xl bg-white border border-rosewarm-200 shadow-sm space-y-3.5 {{ empty($design['bg_music_url']) ? 'hidden' : '' }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div id="audioDiscIcon"
                                            class="w-11 h-11 rounded-full bg-darkcharcoal text-white flex items-center justify-center shadow-md">
                                            <i class="ph-fill ph-disc text-xl text-rosewarm-300"></i>
                                        </div>
                                        <div class="max-w-[200px]">
                                            <span id="currentMusicLabel"
                                                class="text-xs font-bold text-darkcharcoal block truncate">{{ $design['bg_music_title'] ?? 'Lagu Terpilih' }}</span>
                                            <span id="musicStatusText" class="text-[10px] text-warmgray">Status: Siap
                                                diputar</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" id="previewPlayBtn" onclick="toggleAudioPreview()"
                                            class="w-9 h-9 rounded-full bg-terracotta text-white flex items-center justify-center hover:bg-rosewarm-600 transition shadow">
                                            <i id="playIcon" class="ph-fill ph-play text-base"></i>
                                        </button>
                                        <button type="button" onclick="removeAudio()"
                                            class="w-8 h-8 rounded-full bg-stone-100 text-stone-400 hover:text-red-500 flex items-center justify-center transition"
                                            title="Hapus Lagu">
                                            <i class="ph-bold ph-trash text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <audio id="globalAudioPlayer" preload="auto" class="hidden"></audio>
                            </div>

                            <div id="audioEmptyNotice"
                                class="p-4 text-center text-xs text-warmgray border border-dashed border-rosewarm-200 rounded-xl bg-sand/20 {{ !empty($design['bg_music_url']) ? 'hidden' : '' }}">
                                Belum ada file musik yang dipilih.
                            </div>

                            <div class="pt-3 border-t border-rosewarm-100 space-y-2">
                                <label
                                    class="flex items-center justify-between p-3 rounded-xl bg-white border border-stone-200 cursor-pointer">
                                    <div>
                                        <p class="text-xs font-semibold text-darkcharcoal">Auto-Play Lagu</p>
                                        <p class="text-[10px] text-warmgray">Putar otomatis saat tamu membuka undangan
                                        </p>
                                    </div>
                                    <input type="checkbox" id="autoPlayMusicCheck" checked
                                        class="w-4 h-4 accent-terracotta rounded">
                                </label>
                            </div>
                        </div>

                        <!-- TAB 4: DAFTAR LAYER & EDIT ELEMEN AKTIF -->
                        <div id="panel-active-layers" class="editor-panel hidden space-y-4">
                            <div>
                                <h3 class="font-playfair text-base font-bold text-darkcharcoal">Daftar Layer & Kunci
                                    Posisi</h3>
                                <p class="text-xs text-warmgray mt-0.5">Ubah teks, ukuran, bentuk, posisi & zoom foto di
                                    dalam bingkai.</p>
                            </div>
                            <div id="elementsLayerList" class="space-y-3"></div>
                        </div>

                        <!-- TAB 5: CUSTOM PANJANG, LATAR & FONT -->
                        <div id="panel-styling" class="editor-panel hidden space-y-5">
                            <div>
                                <h3 class="font-playfair text-base font-bold text-darkcharcoal">Pengaturan Kanvas & Gaya
                                    Visual</h3>
                                <p class="text-xs text-warmgray mt-0.5">Sesuaikan panjang scroll halaman, tema warna
                                    background, dan font.</p>
                            </div>

                            <div class="bg-rosewarm-50/50 p-4 rounded-2xl border border-rosewarm-100 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <label class="text-xs font-bold text-darkcharcoal block">Panjang / Tinggi Kanvas
                                            (Scroll)</label>
                                        <span class="text-[10px] text-warmgray">Atur tinggi total konten undangan</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <input type="number" id="canvasHeightInput" min="600" max="3500" step="50"
                                            value="1200" oninput="updateCanvasHeight(this.value)"
                                            class="w-16 px-2 py-1 bg-white border border-rosewarm-200 rounded-lg text-xs font-bold text-center">
                                        <span class="text-[10px] text-warmgray font-semibold">px</span>
                                    </div>
                                </div>
                                <input type="range" id="canvasHeightSlider" min="600" max="3000" step="50" value="1200"
                                    oninput="updateCanvasHeight(this.value)"
                                    class="w-full accent-terracotta cursor-pointer">
                            </div>

                            <div class="space-y-3 pt-2 border-t border-rosewarm-100">
                                <label
                                    class="text-[11px] font-bold text-darkcharcoal uppercase tracking-wider block">Tipe
                                    Warna Latar (Background)</label>

                                <div class="grid grid-cols-2 gap-2 bg-sand/50 p-1 rounded-xl">
                                    <button type="button" onclick="setBackgroundMode('solid')" id="btnBgModeSolid"
                                        class="py-1.5 rounded-lg text-xs font-bold bg-white text-darkcharcoal shadow-sm transition">Warna
                                        Solid</button>
                                    <button type="button" onclick="setBackgroundMode('gradient')" id="btnBgModeGradient"
                                        class="py-1.5 rounded-lg text-xs font-semibold text-warmgray hover:text-darkcharcoal transition">Gradasi
                                        (Gradient)</button>
                                </div>

                                <div id="solidBgControls"
                                    class="p-3 bg-sand/30 rounded-xl border border-rosewarm-100 flex items-center justify-between">
                                    <div>
                                        <span class="text-xs font-bold text-darkcharcoal block">Warna Latar Solid</span>
                                        <span class="text-[10px] text-warmgray">Background utama kanvas</span>
                                    </div>
                                    <input type="color" id="solidBgColorPicker" value="#FDFBF7"
                                        oninput="applySolidBg(this.value)"
                                        class="w-9 h-9 rounded-lg cursor-pointer bg-transparent border-0">
                                </div>

                                <div id="gradientBgControls"
                                    class="hidden space-y-2.5 p-3 bg-sand/30 rounded-xl border border-rosewarm-100">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div
                                            class="p-2 bg-white rounded-lg border border-rosewarm-100 flex items-center justify-between">
                                            <span class="text-[10px] font-semibold">Warna 1</span>
                                            <input type="color" id="gradColor1" value="#FFF5F5"
                                                oninput="applyGradientBg()"
                                                class="w-7 h-7 rounded cursor-pointer bg-transparent border-0">
                                        </div>
                                        <div
                                            class="p-2 bg-white rounded-lg border border-rosewarm-100 flex items-center justify-between">
                                            <span class="text-[10px] font-semibold">Warna 2</span>
                                            <input type="color" id="gradColor2" value="#FDE8E8"
                                                oninput="applyGradientBg()"
                                                class="w-7 h-7 rounded cursor-pointer bg-transparent border-0">
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-semibold text-warmgray block mb-1">Arah
                                            Gradasi</span>
                                        <select id="gradDirection" onchange="applyGradientBg()"
                                            class="w-full px-3 py-1.5 rounded-lg bg-white border border-rosewarm-100 text-xs font-medium">
                                            <option value="to bottom">Atas ke Bawah (&darr;)</option>
                                            <option value="to top">Bawah ke Atas (&uarr;)</option>
                                            <option value="to bottom right">Diagonal Kanan Bawah (&searr;)</option>
                                            <option value="to right">Kiri ke Kanan (&rarr;)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 pt-2 border-t border-rosewarm-100">
                                <label
                                    class="text-[11px] font-bold text-darkcharcoal uppercase tracking-wider block">Gaya
                                    Tipografi & Warna Font Global</label>

                                <div>
                                    <label class="text-[11px] font-semibold text-warmgray block mb-1">Pilihan Font
                                        Family Default</label>
                                    <select id="globalFontFamily" onchange="updateGlobalFont(this.value)"
                                        class="w-full px-3.5 py-2.5 rounded-xl bg-sand/50 border border-rosewarm-200 text-xs font-medium text-darkcharcoal">
                                        <option value="font-playfair">Playfair Display (Klasik Romantis Serif)</option>
                                        <option value="font-cormorant">Cormorant Garamond (Vintage Luxury Serif)
                                        </option>
                                        <option value="font-script">Great Vibes (Script / Kaligrafi Elegan)</option>
                                        <option value="font-cinzel">Cinzel (Royal & Majestic Serif)</option>
                                        <option value="font-sans">Plus Jakarta Sans (Modern Clean)</option>
                                        <option value="font-montserrat">Montserrat (Geometric Modern)</option>
                                    </select>
                                </div>

                                <div
                                    class="p-3 bg-sand/30 rounded-xl border border-rosewarm-100 flex items-center justify-between">
                                    <div>
                                        <span class="text-xs font-bold text-darkcharcoal block">Ubah Semua Warna
                                            Teks</span>
                                        <span class="text-[10px] text-warmgray">Terapkan warna ini ke seluruh elemen
                                            teks</span>
                                    </div>
                                    <input type="color" id="globalTextColorPicker" value="#2D2422"
                                        oninput="applyGlobalFontColor(this.value)"
                                        class="w-9 h-9 rounded-lg cursor-pointer bg-transparent border-0">
                                </div>
                            </div>
                        </div>

                    </div>
                </aside>

                <!-- RIGHT CANVAS: SMARTPHONE LIVE PREVIEW -->
                <main
                    class="flex-1 bg-stone-100 flex flex-col items-center justify-center p-6 overflow-y-auto relative">

                    <!-- TOP TOOLBAR -->
                    <div
                        class="mb-2.5 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full border border-rosewarm-200 shadow-sm flex items-center gap-4 text-xs z-30">
                        <label
                            class="flex items-center gap-1.5 cursor-pointer select-none text-[11px] font-semibold text-darkcharcoal">
                            <input type="checkbox" id="toggleSnap" checked onchange="toggleSnapMode(this.checked)"
                                class="w-3.5 h-3.5 accent-terracotta rounded cursor-pointer">
                            <i class="ph-bold ph-magnet text-terracotta text-sm"></i>
                            <span>Snap Garis Tengah</span>
                        </label>
                        <span class="text-stone-300">|</span>
                        <button type="button" onclick="centerActiveElement()"
                            class="text-warmgray hover:text-terracotta text-[11px] font-medium flex items-center gap-1 transition">
                            <i class="ph-bold ph-align-center-horizontal text-sm"></i> Ratakan Tengah Elemen Aktif
                        </button>
                    </div>

                    <!-- Phone Frame -->
                    <div id="previewWrapper"
                        class="w-[340px] h-[640px] bg-darkcharcoal rounded-[44px] p-3 shadow-2xl border-4 border-stone-800 relative flex flex-col">

                        <div class="w-32 h-4 bg-stone-900 rounded-b-2xl mx-auto z-30 flex-shrink-0"></div>

                        <div id="phoneScreen" onclick="deselectAll(event)"
                            class="w-full flex-1 rounded-[34px] overflow-y-auto custom-scrollbar relative font-playfair transition-all duration-300 min-h-[600px]"
                            style="background-color: #FDFBF7;">

                            <div id="centerGuideLine"></div>

                            <button type="button" id="phoneMusicDisc" onclick="toggleAudioPreview()"
                                class="absolute bottom-4 right-4 z-40 w-9 h-9 rounded-full bg-darkcharcoal/90 text-white flex items-center justify-center shadow-lg border border-white/20 transition hover:scale-105 {{ empty($design['bg_music_url']) ? 'hidden' : '' }}"
                                title="Musik Latar">
                                <i id="phoneDiscIcon" class="ph-fill ph-disc text-lg text-rosewarm-300"></i>
                            </button>

                            <div id="emptyCanvasNotice"
                                class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center text-stone-400 pointer-events-none space-y-2">
                                <div
                                    class="w-12 h-12 rounded-full border-2 border-dashed border-stone-300 flex items-center justify-center">
                                    <i class="ph-bold ph-plus text-xl text-stone-400"></i>
                                </div>
                                <p class="text-xs font-semibold text-stone-500">Kanvas Kosong</p>
                                <p class="text-[10px] leading-relaxed">Klik menu di sebelah kiri untuk mulai menambahkan
                                    teks, foto, musik & kartu undangan.</p>
                            </div>

                            <div id="canvasItemsLayer" class="relative w-full" style="height: 1200px;"></div>

                        </div>
                    </div>

                    <!-- Status Pill -->
                    <div
                        class="absolute bottom-6 right-6 bg-white/95 backdrop-blur-md px-4 py-2 rounded-2xl border border-rosewarm-200 shadow-md flex items-center gap-2.5 text-xs text-warmgray font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Studio Canvas Sync Active</span>
                    </div>
                </main>

            </form>

        </div>

    </div>

    <!-- CLIENT SCRIPTS -->
    <script>
        let photoGallery = [];
        let canvasElements = @json($design['canvas_elements'] ?? []);
        let canvasConfig = @json($design['canvas_config'] ?? []);

        if (!Array.isArray(canvasElements)) {
            canvasElements = [];
        }

        if (Array.isArray(canvasConfig) || !canvasConfig.height) {
            canvasConfig = {
                height: 1200,
                bgMode: 'solid',
                bgColor: '#FDFBF7',
                gradColor1: '#FFF5F5',
                gradColor2: '#FDE8E8',
                gradDirection: 'to bottom',
                globalFont: 'font-playfair',
                globalColor: '#2D2422'
            };
        }

        let activeElementId = null;
        let isDragging = false;
        let dragStartPos = { x: 0, y: 0 };
        let elementInitialPos = { x: 0, y: 0 };
        let isSnapEnabled = true;

        let isMusicPlaying = false;
        let currentAudioSrc = "{{ $design['bg_music_url'] ?? '' }}";
        const audioPlayer = document.getElementById('globalAudioPlayer');

        const CANVAS_WIDTH = 316;
        const CANVAS_CENTER_X = CANVAS_WIDTH / 2;
        const SNAP_THRESHOLD = 6;

        function toggleSnapMode(enabled) { isSnapEnabled = enabled; }

        function switchEditorTab(tabName) {
            document.querySelectorAll('.editor-panel').forEach(panel => panel.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-rosewarm-500', 'shadow-sm');
                btn.classList.add('text-warmgray');
            });

            document.getElementById(`panel-${tabName}`).classList.remove('hidden');
            const activeBtn = document.getElementById(`tabBtn-${tabName}`);
            if (activeBtn) {
                activeBtn.classList.add('bg-white', 'text-rosewarm-500', 'shadow-sm');
                activeBtn.classList.remove('text-warmgray');
            }

            if (tabName === 'active-layers') {
                renderLayersPanel();
            }
        }

        function handleCustomAudioUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                currentAudioSrc = url;
                audioPlayer.src = url;

                const fileName = file.name.replace(/\.[^/.]+$/, "");
                document.getElementById('bgMusicTitle').value = fileName;
                document.getElementById('bgMusicUrl').value = url;
                document.getElementById('currentMusicLabel').innerText = fileName;

                document.getElementById('audioActiveContainer').classList.remove('hidden');
                document.getElementById('audioEmptyNotice').classList.add('hidden');
                document.getElementById('phoneMusicDisc').classList.remove('hidden');

                playAudio();
            }
        }

        function removeAudio() {
            pauseAudio();
            currentAudioSrc = '';
            audioPlayer.src = '';
            document.getElementById('bgMusicTitle').value = '';
            document.getElementById('bgMusicUrl').value = '';
            document.getElementById('customAudioInput').value = '';

            document.getElementById('audioActiveContainer').classList.add('hidden');
            document.getElementById('audioEmptyNotice').classList.remove('hidden');
            document.getElementById('phoneMusicDisc').classList.add('hidden');
        }

        function toggleAudioPreview() {
            if (!currentAudioSrc) {
                alert('Silakan pilih file audio terlebih dahulu di tab Musik.');
                return;
            }

            if (isMusicPlaying) {
                pauseAudio();
            } else {
                if (!audioPlayer.src || audioPlayer.src === window.location.href) {
                    audioPlayer.src = currentAudioSrc;
                }
                playAudio();
            }
        }

        function playAudio() {
            if (!audioPlayer.src) return;
            audioPlayer.play().then(() => {
                isMusicPlaying = true;
                document.getElementById('playIcon').className = 'ph-fill ph-pause text-base';
                document.getElementById('musicStatusText').innerText = 'Status: Memutar... 🎵';
                document.getElementById('audioDiscIcon').classList.add('spin-vinyl');
                document.getElementById('phoneDiscIcon').classList.add('spin-vinyl');
            }).catch(err => {
                console.log('Audio error:', err);
            });
        }

        function pauseAudio() {
            audioPlayer.pause();
            isMusicPlaying = false;
            document.getElementById('playIcon').className = 'ph-fill ph-play text-base';
            document.getElementById('musicStatusText').innerText = 'Status: Berhenti';
            document.getElementById('audioDiscIcon').classList.remove('spin-vinyl');
            document.getElementById('phoneDiscIcon').classList.remove('spin-vinyl');
        }

        function updateCanvasHeight(val) {
            val = parseInt(val) || 1200;
            canvasConfig.height = val;

            document.getElementById('canvasHeightInput').value = val;
            document.getElementById('canvasHeightSlider').value = val;

            const layer = document.getElementById('canvasItemsLayer');
            if (layer) {
                layer.style.height = `${val}px`;
            }
        }

        function setBackgroundMode(mode) {
            canvasConfig.bgMode = mode;
            const btnSolid = document.getElementById('btnBgModeSolid');
            const btnGradient = document.getElementById('btnBgModeGradient');
            const solidPanel = document.getElementById('solidBgControls');
            const gradPanel = document.getElementById('gradientBgControls');

            if (mode === 'solid') {
                btnSolid.className = 'py-1.5 rounded-lg text-xs font-bold bg-white text-darkcharcoal shadow-sm transition';
                btnGradient.className = 'py-1.5 rounded-lg text-xs font-semibold text-warmgray hover:text-darkcharcoal transition';
                solidPanel.classList.remove('hidden');
                gradPanel.classList.add('hidden');
                applySolidBg(canvasConfig.bgColor);
            } else {
                btnGradient.className = 'py-1.5 rounded-lg text-xs font-bold bg-white text-darkcharcoal shadow-sm transition';
                btnSolid.className = 'py-1.5 rounded-lg text-xs font-semibold text-warmgray hover:text-darkcharcoal transition';
                gradPanel.classList.remove('hidden');
                solidPanel.classList.add('hidden');
                applyGradientBg();
            }
        }

        function applySolidBg(color) {
            canvasConfig.bgColor = color;
            const phone = document.getElementById('phoneScreen');
            phone.style.backgroundImage = 'none';
            phone.style.backgroundColor = color;
        }

        function applyGradientBg() {
            const c1 = document.getElementById('gradColor1').value;
            const c2 = document.getElementById('gradColor2').value;
            const dir = document.getElementById('gradDirection').value;

            canvasConfig.gradColor1 = c1;
            canvasConfig.gradColor2 = c2;
            canvasConfig.gradDirection = dir;

            const phone = document.getElementById('phoneScreen');
            phone.style.backgroundColor = 'transparent';
            phone.style.backgroundImage = `linear-gradient(${dir}, ${c1}, ${c2})`;
        }

        function updateGlobalFont(fontClass) {
            canvasConfig.globalFont = fontClass;
            const phone = document.getElementById('phoneScreen');
            phone.classList.remove('font-playfair', 'font-cormorant', 'font-sans', 'font-script', 'font-cinzel', 'font-montserrat');
            phone.classList.add(fontClass);
        }

        function applyGlobalFontColor(color) {
            canvasConfig.globalColor = color;
            canvasElements.forEach(el => {
                if (el.type !== 'photo_frame') {
                    el.fontColor = color;
                }
            });
            renderCanvas();
            renderLayersPanel();
        }

        function addElement(type, defaultContent) {
            const newId = 'elem_' + Date.now();
            let newElem = {
                id: newId,
                type: type,
                content: defaultContent,
                headerText: 'Kepada Yth. Bapak/Ibu/Saudara/i',
                footerText: 'Di Tempat',
                posX: 25,
                posY: 40 + (canvasElements.length * 45),
                fontSize: 14,
                fontColor: canvasConfig.globalColor || '#2D2422',
                fontFamily: canvasConfig.globalFont || 'font-playfair',
                rotation: 0,
                width: 266,
                height: 'auto',
                isLocked: false
            };

            if (type === 'badge') {
                newElem.fontSize = 10;
                newElem.fontColor = '#E27367';
                newElem.width = 160;
                newElem.fontFamily = 'font-sans';
                newElem.posX = Math.round(CANVAS_CENTER_X - (160 / 2));
            } else if (type === 'groom_name' || type === 'bride_name') {
                newElem.fontSize = 28;
                newElem.posX = 25;
            } else if (type === 'ampersand') {
                newElem.fontSize = 22;
                newElem.fontColor = '#E27367';
                newElem.width = 40;
                newElem.fontFamily = 'font-script';
                newElem.posX = Math.round(CANVAS_CENTER_X - 20);
            } else if (type === 'quote') {
                newElem.fontSize = 11;
                newElem.fontColor = '#7A6660';
                newElem.posX = 25;
            } else if (type === 'rsvp_button' || type === 'guest_card') {
                newElem.width = 266;
                newElem.posX = 25;
                newElem.fontSize = 14;
            }

            canvasElements.push(newElem);
            activeElementId = newId;
            renderCanvas();
        }

        function addCustomText() {
            const input = document.getElementById('customTextInput');
            const text = input.value.trim();
            if (!text) return;
            addElement('custom_text', text);
            input.value = '';
        }

        function addPhotoFrame(shape) {
            if (photoGallery.length === 0) {
                alert('Silakan upload foto terlebih dahulu di tab Foto.');
                return;
            }

            const newId = 'frame_' + Date.now();
            const photoSrc = photoGallery[0];

            let frameWidth = 150;
            let frameHeight = 190;

            if (shape === 'shape-heart') {
                frameWidth = 190;
                frameHeight = 190;
            } else if (shape === 'shape-rect') {
                frameWidth = 160;
                frameHeight = 210;
            } else if (shape === 'shape-circle') {
                frameWidth = 160;
                frameHeight = 160;
            }

            canvasElements.push({
                id: newId,
                type: 'photo_frame',
                src: photoSrc,
                shape: shape,
                width: frameWidth,
                height: frameHeight,
                posX: Math.round(CANVAS_CENTER_X - (frameWidth / 2)),
                posY: 80 + (canvasElements.length * 30),
                rotation: 0,
                borderWidth: (shape === 'shape-heart' ? 0 : 3),
                borderColor: '#FFFFFF',
                imgZoom: 100,
                imgPosX: 50,
                imgPosY: 50,
                isLocked: false
            });

            activeElementId = newId;
            renderCanvas();
        }

        function renderCanvas() {
            const container = document.getElementById('canvasItemsLayer');
            const emptyNotice = document.getElementById('emptyCanvasNotice');
            container.innerHTML = '';

            if (canvasElements.length === 0) {
                emptyNotice.classList.remove('hidden');
            } else {
                emptyNotice.classList.add('hidden');
            }

            document.getElementById('layerCount').innerText = canvasElements.length;

            canvasElements.forEach(item => {
                const el = document.createElement('div');
                el.id = item.id;
                el.className = `canvas-item ${activeElementId === item.id ? 'active-item' : ''} ${item.isLocked ? 'is-locked' : ''} ${item.fontFamily || ''}`;
                el.style.left = `${item.posX}px`;
                el.style.top = `${item.posY}px`;
                el.style.transform = `rotate(${item.rotation || 0}deg)`;
                el.style.width = item.width ? `${item.width}px` : 'auto';

                const lockBadge = item.isLocked ? `<div class="absolute -top-2 -right-2 bg-stone-700 text-white rounded-full w-4 h-4 flex items-center justify-center text-[9px] shadow pointer-events-none z-30" title="Terkunci"><i class="ph-bold ph-lock-key"></i></div>` : '';

                if (item.type === 'badge') {
                    el.innerHTML = `${lockBadge}<span data-prop="content" class="inline-text-target inline-block px-3 py-1 rounded-full bg-rosewarm-100 tracking-widest uppercase font-bold" style="font-size: ${item.fontSize}px; color: ${item.fontColor};">${item.content}</span>`;
                } else if (item.type === 'groom_name' || item.type === 'bride_name') {
                    el.innerHTML = `${lockBadge}<h2 data-prop="content" class="inline-text-target font-bold text-center" style="font-size: ${item.fontSize}px; color: ${item.fontColor};">${item.content}</h2>`;
                } else if (item.type === 'ampersand') {
                    el.innerHTML = `${lockBadge}<div data-prop="content" class="inline-text-target font-bold text-center" style="font-size: ${item.fontSize}px; color: ${item.fontColor};">&</div>`;
                } else if (item.type === 'quote') {
                    el.innerHTML = `${lockBadge}<p data-prop="content" class="inline-text-target italic text-center leading-relaxed px-2" style="font-size: ${item.fontSize}px; color: ${item.fontColor};">${item.content}</p>`;
                } else if (item.type === 'guest_card') {
                    el.innerHTML = `
                    ${lockBadge}
                    <div class="bg-white/90 backdrop-blur-sm p-3 rounded-2xl border border-rosewarm-200 shadow-sm space-y-0.5 text-center">
                        <p data-prop="headerText" class="inline-text-target text-[9px] uppercase tracking-wider font-semibold" style="color: ${item.fontColor}; opacity: 0.8;">${item.headerText || 'Kepada Yth. Bapak/Ibu/Saudara/i'}</p>
                        <p data-prop="content" class="inline-text-target text-sm font-bold" style="font-size: ${item.fontSize || 14}px; color: ${item.fontColor};">${item.content}</p>
                        <p data-prop="footerText" class="inline-text-target text-[9px]" style="color: ${item.fontColor}; opacity: 0.6;">${item.footerText || 'Di Tempat'}</p>
                    </div>
                `;
                } else if (item.type === 'rsvp_button') {
                    el.innerHTML = `${lockBadge}<button type="button" data-prop="content" class="inline-text-target w-full py-2.5 rounded-xl bg-gradient-to-r from-terracotta to-rosewarm-500 text-white text-xs font-semibold shadow-md shadow-rosewarm-200">${item.content}</button>`;
                } else if (item.type === 'gift_card') {
                    el.innerHTML = `
                    ${lockBadge}
                    <div class="p-3 bg-white/90 rounded-2xl border border-rosewarm-200 shadow-sm text-center space-y-0.5">
                        <span data-prop="headerText" class="inline-text-target text-[10px] block" style="color: ${item.fontColor}; opacity: 0.8;">${item.headerText || 'Tanda Kasih (Amplop Digital)'}</span>
                        <p data-prop="content" class="inline-text-target text-xs font-bold font-mono" style="color: ${item.fontColor};">${item.content}</p>
                    </div>
                `;
                } else if (item.type === 'photo_frame') {
                    el.className += ` ${item.shape}`;
                    el.style.height = `${item.height}px`;
                    if (item.shape !== 'shape-heart') {
                        el.style.border = `${item.borderWidth || 3}px solid ${item.borderColor || '#FFFFFF'}`;
                        el.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.15)';
                    } else {
                        el.style.border = 'none';
                        el.style.boxShadow = 'none';
                    }
                    el.style.overflow = 'hidden';

                    const zoom = (item.imgZoom || 100) / 100;
                    const posX = item.imgPosX !== undefined ? item.imgPosX : 50;
                    const posY = item.imgPosY !== undefined ? item.imgPosY : 50;

                    el.innerHTML = `${lockBadge}<img src="${item.src}" class="w-full h-full object-cover pointer-events-none transition-transform" style="object-position: ${posX}% ${posY}%; transform: scale(${zoom});">`;
                } else {
                    el.innerHTML = `${lockBadge}<div data-prop="content" class="inline-text-target text-center" style="font-size: ${item.fontSize}px; color: ${item.fontColor};">${item.content}</div>`;
                }

                el.addEventListener('mousedown', (e) => startDrag(e, item.id));
                el.addEventListener('touchstart', (e) => startDrag(e, item.id), { passive: false });

                el.querySelectorAll('.inline-text-target').forEach(targetEl => {
                    targetEl.addEventListener('dblclick', (e) => {
                        e.stopPropagation();
                        enableInlineEdit(el, targetEl, item.id);
                    });
                });

                container.appendChild(el);
            });
        }

        function enableInlineEdit(parentEl, targetEl, itemId) {
            targetEl.setAttribute('contenteditable', 'true');
            targetEl.focus();

            const range = document.createRange();
            range.selectNodeContents(targetEl);
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);

            const propKey = targetEl.getAttribute('data-prop') || 'content';

            function finishEdit() {
                targetEl.removeAttribute('contenteditable');
                const newText = targetEl.innerText.trim();
                const elem = canvasElements.find(e => e.id === itemId);
                if (elem && newText) {
                    elem[propKey] = newText;
                }
                targetEl.removeEventListener('blur', finishEdit);
                targetEl.removeEventListener('keydown', handleKey);
            }

            function handleKey(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    targetEl.blur();
                }
            }

            targetEl.addEventListener('blur', finishEdit);
            targetEl.addEventListener('keydown', handleKey);
        }

        function toggleLockElement(id) {
            const elem = canvasElements.find(e => e.id === id);
            if (elem) {
                elem.isLocked = !elem.isLocked;
                renderCanvas();
                renderLayersPanel();
            }
        }

        function centerActiveElement() {
            if (!activeElementId) {
                alert('Silakan pilih salah satu elemen di canvas terlebih dahulu.');
                return;
            }
            const elem = canvasElements.find(e => e.id === activeElementId);
            if (elem) {
                if (elem.isLocked) {
                    alert('Elemen ini sedang digembok/dikunci. Buka gembok terlebih dahulu.');
                    return;
                }
                const elemWidth = elem.width ? parseInt(elem.width) : 200;
                elem.posX = Math.round(CANVAS_CENTER_X - (elemWidth / 2));
                renderCanvas();
                renderLayersPanel();
            }
        }

        function renderLayersPanel() {
            const list = document.getElementById('elementsLayerList');
            if (!list) return;
            list.innerHTML = '';

            if (canvasElements.length === 0) {
                list.innerHTML = `<div class="p-6 text-center text-xs text-warmgray border-2 border-dashed border-rosewarm-200 rounded-2xl">Belum ada elemen di kanvas.</div>`;
                return;
            }

            canvasElements.forEach((item, index) => {
                const card = document.createElement('div');
                card.id = `layer-card-${item.id}`;
                card.className = `p-3.5 rounded-xl border transition space-y-2.5 ${activeElementId === item.id ? 'border-terracotta bg-rosewarm-50/50' : 'border-rosewarm-100 bg-sand/20'}`;

                let inputsHtml = '';

                if (item.type === 'guest_card') {
                    inputsHtml = `
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold text-warmgray uppercase tracking-wider block">Teks Atas (Label)</label>
                        <input type="text" value="${item.headerText || 'Kepada Yth. Bapak/Ibu/Saudara/i'}" oninput="fastUpdateField('${item.id}', 'headerText', this.value)" class="w-full px-2.5 py-1.5 rounded-lg bg-white border border-rosewarm-200 text-xs">
                        
                        <label class="text-[9px] font-bold text-warmgray uppercase tracking-wider block pt-1">Nama Tamu Undangan</label>
                        <input type="text" value="${item.content}" oninput="fastUpdateField('${item.id}', 'content', this.value)" class="w-full px-2.5 py-1.5 rounded-lg bg-white border border-rosewarm-200 text-xs font-bold">
                        
                        <label class="text-[9px] font-bold text-warmgray uppercase tracking-wider block pt-1">Teks Bawah (Tempat/Alamat)</label>
                        <input type="text" value="${item.footerText || 'Di Tempat'}" oninput="fastUpdateField('${item.id}', 'footerText', this.value)" class="w-full px-2.5 py-1.5 rounded-lg bg-white border border-rosewarm-200 text-xs">
                    </div>
                `;
                } else if (item.type === 'gift_card') {
                    inputsHtml = `
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-bold text-warmgray uppercase tracking-wider block">Judul Kotak</label>
                        <input type="text" value="${item.headerText || 'Tanda Kasih (Amplop Digital)'}" oninput="fastUpdateField('${item.id}', 'headerText', this.value)" class="w-full px-2.5 py-1.5 rounded-lg bg-white border border-rosewarm-200 text-xs">
                        
                        <label class="text-[9px] font-bold text-warmgray uppercase tracking-wider block pt-1">Nomor Rekening & Info Bank</label>
                        <input type="text" value="${item.content}" oninput="fastUpdateField('${item.id}', 'content', this.value)" class="w-full px-2.5 py-1.5 rounded-lg bg-white border border-rosewarm-200 text-xs font-mono font-bold">
                    </div>
                `;
                } else if (item.type !== 'photo_frame') {
                    inputsHtml = `
                    <textarea rows="2" oninput="fastUpdateField('${item.id}', 'content', this.value)" class="w-full px-2.5 py-1.5 rounded-lg bg-white border border-rosewarm-200 text-xs focus:ring-1 focus:ring-terracotta focus:outline-none custom-scrollbar">${item.content}</textarea>
                    
                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <div>
                            <span class="text-[9px] text-warmgray block">Font Family</span>
                            <select onchange="fastUpdateFontFamily('${item.id}', this.value)" class="w-full px-2 py-1 rounded bg-white border border-rosewarm-200 text-[11px]">
                                <option value="font-playfair" ${item.fontFamily === 'font-playfair' ? 'selected' : ''}>Playfair</option>
                                <option value="font-cormorant" ${item.fontFamily === 'font-cormorant' ? 'selected' : ''}>Cormorant</option>
                                <option value="font-script" ${item.fontFamily === 'font-script' ? 'selected' : ''}>Great Vibes</option>
                                <option value="font-cinzel" ${item.fontFamily === 'font-cinzel' ? 'selected' : ''}>Cinzel</option>
                                <option value="font-sans" ${item.fontFamily === 'font-sans' ? 'selected' : ''}>Plus Jakarta</option>
                                <option value="font-montserrat" ${item.fontFamily === 'font-montserrat' ? 'selected' : ''}>Montserrat</option>
                            </select>
                        </div>
                        <div>
                            <span class="text-[9px] text-warmgray block">Warna Font</span>
                            <div class="flex items-center gap-1.5 bg-white px-2 py-0.5 rounded border border-rosewarm-200">
                                <input type="color" value="${item.fontColor || '#2D2422'}" oninput="fastUpdateFontColor('${item.id}', this.value)" class="w-6 h-6 rounded cursor-pointer bg-transparent border-0">
                                <span class="text-[10px] text-warmgray font-mono">${item.fontColor || '#2D2422'}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <div>
                            <span class="text-[9px] text-warmgray block">Ukuran Font (px)</span>
                            <input type="number" min="8" max="60" value="${item.fontSize || 14}" oninput="fastUpdateStyle('${item.id}', 'fontSize', this.value)" class="w-full px-2 py-1 rounded bg-white border border-rosewarm-200 text-xs">
                        </div>
                        <div>
                            <span class="text-[9px] text-warmgray block">Rotasi (°)</span>
                            <input type="number" min="-45" max="45" value="${item.rotation || 0}" oninput="fastUpdateStyle('${item.id}', 'rotation', this.value)" class="w-full px-2 py-1 rounded bg-white border border-rosewarm-200 text-xs">
                        </div>
                    </div>
                `;
                } else {
                    inputsHtml = `
                    <div>
                        <span class="text-[9px] text-warmgray block mb-1">Ubah Bentuk Bingkai</span>
                        <select onchange="fastUpdateFrameShape('${item.id}', this.value)" class="w-full px-2.5 py-1 rounded bg-white border border-rosewarm-200 text-xs font-semibold">
                            <option value="shape-heart" ${item.shape === 'shape-heart' ? 'selected' : ''}>💖 Love / Heart (Besar)</option>
                            <option value="shape-rect" ${item.shape === 'shape-rect' ? 'selected' : ''}>▬ Persegi Panjang (Tegas)</option>
                            <option value="shape-arch" ${item.shape === 'shape-arch' ? 'selected' : ''}>🏛️ Arch / Kubah</option>
                            <option value="shape-circle" ${item.shape === 'shape-circle' ? 'selected' : ''}>⚪ Circle / Lingkaran</option>
                            <option value="shape-rounded" ${item.shape === 'shape-rounded' ? 'selected' : ''}>🔲 Card / Rounded</option>
                            <option value="shape-oval" ${item.shape === 'shape-oval' ? 'selected' : ''}>🥚 Oval</option>
                            <option value="shape-wave" ${item.shape === 'shape-wave' ? 'selected' : ''}>🌊 Wave / Organic</option>
                            <option value="shape-polaroid" ${item.shape === 'shape-polaroid' ? 'selected' : ''}>📷 Polaroid</option>
                        </select>
                    </div>

                    <div class="p-2.5 bg-rosewarm-50/70 rounded-xl border border-rosewarm-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-darkcharcoal flex items-center gap-1">
                                <i class="ph-bold ph-arrows-out-cardinal text-terracotta"></i> Posisi & Zoom Foto
                            </span>
                            <button type="button" onclick="resetImageCrop('${item.id}')" class="text-[9px] bg-white px-2 py-0.5 rounded border border-rosewarm-200 text-warmgray hover:text-darkcharcoal">Reset Tengah</button>
                        </div>
                        
                        <div>
                            <div class="flex justify-between text-[9px] text-warmgray">
                                <span>Zoom / Skala Foto</span>
                                <span id="valZoom_${item.id}" class="font-bold text-darkcharcoal">${item.imgZoom || 100}%</span>
                            </div>
                            <input type="range" min="100" max="250" step="2" value="${item.imgZoom || 100}" oninput="fastUpdateImageCrop('${item.id}', 'imgZoom', this.value)" class="w-full accent-terracotta cursor-pointer">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <div class="flex justify-between text-[9px] text-warmgray">
                                    <span>Geser X (Kiri-Kanan)</span>
                                </div>
                                <input type="range" min="0" max="100" value="${item.imgPosX !== undefined ? item.imgPosX : 50}" oninput="fastUpdateImageCrop('${item.id}', 'imgPosX', this.value)" class="w-full accent-terracotta cursor-pointer">
                            </div>
                            <div>
                                <div class="flex justify-between text-[9px] text-warmgray">
                                    <span>Geser Y (Atas-Bawah)</span>
                                </div>
                                <input type="range" min="0" max="100" value="${item.imgPosY !== undefined ? item.imgPosY : 50}" oninput="fastUpdateImageCrop('${item.id}', 'imgPosY', this.value)" class="w-full accent-terracotta cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <div>
                            <span class="text-[9px] text-warmgray block">Lebar Bingkai (px)</span>
                            <input type="number" min="60" max="320" value="${item.width}" oninput="fastUpdateStyle('${item.id}', 'width', this.value)" class="w-full px-2 py-1 rounded bg-white border border-rosewarm-200 text-xs">
                        </div>
                        <div>
                            <span class="text-[9px] text-warmgray block">Tinggi Bingkai (px)</span>
                            <input type="number" min="60" max="350" value="${item.height}" oninput="fastUpdateStyle('${item.id}', 'height', this.value)" class="w-full px-2 py-1 rounded bg-white border border-rosewarm-200 text-xs">
                        </div>
                    </div>
                `;
                }

                card.innerHTML = `
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-darkcharcoal capitalize flex items-center gap-1.5">
                        <i class="ph-bold ph-dots-six-vertical text-stone-400"></i> #${index + 1} ${item.type.replace('_', ' ')}
                    </span>
                    <div class="flex items-center gap-1">
                        <button type="button" onclick="toggleLockElement('${item.id}')" class="p-1 rounded transition ${item.isLocked ? 'bg-amber-100 text-amber-700' : 'text-stone-400 hover:text-darkcharcoal'}" title="${item.isLocked ? 'Buka Kunci' : 'Kunci Posisi'}">
                            <i class="ph-bold ${item.isLocked ? 'ph-lock-key' : 'ph-lock-key-open'} text-sm"></i>
                        </button>
                        <button type="button" onclick="selectElement('${item.id}')" class="text-[10px] bg-white border border-rosewarm-200 px-2 py-0.5 rounded font-medium hover:border-terracotta">Pilih</button>
                        <button type="button" onclick="deleteElement('${item.id}')" class="text-stone-400 hover:text-red-500 p-1"><i class="ph-bold ph-trash"></i></button>
                    </div>
                </div>
                ${inputsHtml}
            `;

                list.appendChild(card);
            });
        }

        function fastUpdateField(id, prop, val) {
            const elem = canvasElements.find(e => e.id === id);
            if (elem) {
                elem[prop] = val;
                const domEl = document.getElementById(id);
                if (domEl) {
                    const target = domEl.querySelector(`[data-prop="${prop}"]`);
                    if (target) target.innerText = val;
                }
            }
        }

        function fastUpdateFrameShape(id, shape) {
            const elem = canvasElements.find(e => e.id === id);
            if (elem) {
                elem.shape = shape;
                if (shape === 'shape-heart') {
                    elem.width = Math.max(elem.width, 180);
                    elem.height = elem.width;
                    elem.borderWidth = 0;
                }
                renderCanvas();
                renderLayersPanel();
            }
        }

        function fastUpdateImageCrop(id, prop, val) {
            const elem = canvasElements.find(e => e.id === id);
            if (elem) {
                elem[prop] = parseInt(val);
                const domEl = document.getElementById(id);
                if (domEl) {
                    const img = domEl.querySelector('img');
                    if (img) {
                        const zoom = (elem.imgZoom || 100) / 100;
                        const posX = elem.imgPosX !== undefined ? elem.imgPosX : 50;
                        const posY = elem.imgPosY !== undefined ? elem.imgPosY : 50;
                        img.style.objectPosition = `${posX}% ${posY}%`;
                        img.style.transform = `scale(${zoom})`;
                    }
                }
                const labelZoom = document.getElementById(`valZoom_${id}`);
                if (labelZoom && prop === 'imgZoom') {
                    labelZoom.innerText = `${val}%`;
                }
            }
        }

        function resetImageCrop(id) {
            const elem = canvasElements.find(e => e.id === id);
            if (elem) {
                elem.imgZoom = 100;
                elem.imgPosX = 50;
                elem.imgPosY = 50;
                renderCanvas();
                renderLayersPanel();
            }
        }

        function fastUpdateFontFamily(id, fontClass) {
            const elem = canvasElements.find(e => e.id === id);
            if (elem) {
                elem.fontFamily = fontClass;
                const domEl = document.getElementById(id);
                if (domEl) {
                    domEl.classList.remove('font-playfair', 'font-cormorant', 'font-sans', 'font-script', 'font-cinzel', 'font-montserrat');
                    domEl.classList.add(fontClass);
                }
            }
        }

        function fastUpdateFontColor(id, color) {
            const elem = canvasElements.find(e => e.id === id);
            if (elem) {
                elem.fontColor = color;
                const domEl = document.getElementById(id);
                if (domEl) {
                    domEl.querySelectorAll('.inline-text-target, p, h2, div, span').forEach(el => {
                        el.style.color = color;
                    });
                }
            }
        }

        function fastUpdateStyle(id, prop, val) {
            const elem = canvasElements.find(e => e.id === id);
            if (elem) {
                elem[prop] = parseInt(val) || val;
                const domEl = document.getElementById(id);
                if (domEl) {
                    if (prop === 'fontSize') {
                        const textTarget = domEl.querySelector('[data-prop="content"]') || domEl;
                        textTarget.style.fontSize = `${val}px`;
                    } else if (prop === 'rotation') {
                        domEl.style.transform = `rotate(${val}deg)`;
                    } else if (prop === 'width') {
                        domEl.style.width = `${val}px`;
                    } else if (prop === 'height') {
                        domEl.style.height = `${val}px`;
                    }
                }
            }
        }

        function selectElement(id) {
            activeElementId = id;
            document.querySelectorAll('.canvas-item').forEach(el => el.classList.remove('active-item'));
            const activeDom = document.getElementById(id);
            if (activeDom) activeDom.classList.add('active-item');
        }

        function deleteElement(id) {
            canvasElements = canvasElements.filter(e => e.id !== id);
            if (activeElementId === id) activeElementId = null;
            renderCanvas();
            renderLayersPanel();
        }

        function clearCanvas() {
            if (confirm('Yakin ingin mengosongkan seluruh isi kanvas?')) {
                canvasElements = [];
                activeElementId = null;
                renderCanvas();
                renderLayersPanel();
            }
        }

        function deselectAll(e) {
            if (e.target.id === 'phoneScreen' || e.target.id === 'canvasItemsLayer') {
                activeElementId = null;
                document.querySelectorAll('.canvas-item').forEach(el => el.classList.remove('active-item'));
            }
        }

        function startDrag(e, elemId) {
            if (e.target.isContentEditable) return;

            const elem = canvasElements.find(el => el.id === elemId);
            if (!elem) return;

            if (elem.isLocked) {
                selectElement(elemId);
                return;
            }

            e.stopPropagation();
            activeElementId = elemId;
            isDragging = true;

            selectElement(elemId);

            const clientX = e.type.startsWith('touch') ? e.touches[0].clientX : e.clientX;
            const clientY = e.type.startsWith('touch') ? e.touches[0].clientY : e.clientY;

            dragStartPos = { x: clientX, y: clientY };
            elementInitialPos = { x: elem.posX, y: elem.posY };

            document.addEventListener('mousemove', onDragMove);
            document.addEventListener('mouseup', onDragEnd);
            document.addEventListener('touchmove', onDragMove, { passive: false });
            document.addEventListener('touchend', onDragEnd);
        }

        function onDragMove(e) {
            if (!isDragging || !activeElementId) return;
            e.preventDefault();

            const clientX = e.type.startsWith('touch') ? e.touches[0].clientX : e.clientX;
            const clientY = e.type.startsWith('touch') ? e.touches[0].clientY : e.clientY;

            const deltaX = clientX - dragStartPos.x;
            const deltaY = clientY - dragStartPos.y;

            const elem = canvasElements.find(el => el.id === activeElementId);
            if (elem && !elem.isLocked) {
                let targetX = Math.max(0, Math.min(260, elementInitialPos.x + deltaX));
                let targetY = Math.max(0, elementInitialPos.y + deltaY);

                const domEl = document.getElementById(elem.id);
                const guideLine = document.getElementById('centerGuideLine');

                if (isSnapEnabled && domEl) {
                    const elemWidth = domEl.offsetWidth || (elem.width ? parseInt(elem.width) : 200);
                    const elemCenterX = targetX + (elemWidth / 2);
                    const diffFromCenter = Math.abs(elemCenterX - CANVAS_CENTER_X);

                    if (diffFromCenter <= SNAP_THRESHOLD) {
                        targetX = Math.round(CANVAS_CENTER_X - (elemWidth / 2));
                        if (guideLine) guideLine.style.display = 'block';
                    } else {
                        if (guideLine) guideLine.style.display = 'none';
                    }
                }

                elem.posX = targetX;
                elem.posY = targetY;

                if (domEl) {
                    domEl.style.left = `${elem.posX}px`;
                    domEl.style.top = `${elem.posY}px`;
                }
            }
        }

        function onDragEnd() {
            isDragging = false;
            const guideLine = document.getElementById('centerGuideLine');
            if (guideLine) guideLine.style.display = 'none';

            document.removeEventListener('mousemove', onDragMove);
            document.removeEventListener('mouseup', onDragEnd);
            document.removeEventListener('touchmove', onDragMove);
            document.removeEventListener('touchend', onDragEnd);
        }

        function handleDragOver(e) { e.preventDefault(); document.getElementById('dropZone').classList.add('border-terracotta'); }
        function handleDragLeave(e) { e.preventDefault(); document.getElementById('dropZone').classList.remove('border-terracotta'); }
        function handleDrop(e) {
            e.preventDefault();
            document.getElementById('dropZone').classList.remove('border-terracotta');
            if (e.dataTransfer.files.length > 0) processFiles(e.dataTransfer.files);
        }
        function handleMultipleFiles(e) { if (e.target.files.length > 0) processFiles(e.target.files); }

        function processFiles(files) {
            Array.from(files).filter(f => f.type.startsWith('image/')).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (evt) {
                    photoGallery.push(evt.target.result);
                    renderGalleryGrid();
                };
                reader.readAsDataURL(file);
            });
        }

        function renderGalleryGrid() {
            const grid = document.getElementById('galleryGrid');
            grid.innerHTML = '';
            document.getElementById('photoCount').innerText = photoGallery.length;

            photoGallery.forEach(imgUrl => {
                const item = document.createElement('div');
                item.className = 'group relative aspect-square rounded-xl overflow-hidden border border-rosewarm-200 cursor-pointer shadow-sm bg-stone-100';
                item.innerHTML = `
                <img src="${imgUrl}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition p-1 text-white">
                    <button type="button" onclick="addCustomPhoto('${imgUrl}')" class="text-[9px] bg-terracotta px-2 py-1 rounded font-medium">+ Pasang</button>
                </div>
            `;
                grid.appendChild(item);
            });
        }

        function addCustomPhoto(imgUrl) {
            const newId = 'frame_' + Date.now();
            const frameWidth = 150;
            canvasElements.push({
                id: newId,
                type: 'photo_frame',
                src: imgUrl,
                shape: 'shape-rounded',
                width: frameWidth,
                height: 190,
                posX: Math.round(CANVAS_CENTER_X - (frameWidth / 2)),
                posY: 80,
                rotation: 0,
                borderWidth: 3,
                borderColor: '#FFFFFF',
                imgZoom: 100,
                imgPosX: 50,
                imgPosY: 50,
                isLocked: false
            });
            activeElementId = newId;
            renderCanvas();
        }

        // --- SUBMIT & SIMPAN DESAIN KE STORAGE & FORM ---
        function prepareSubmit() {
            const jsonElems = JSON.stringify(canvasElements);
            const jsonConfig = JSON.stringify(canvasConfig);

            document.getElementById('canvasElementsJson').value = jsonElems;
            document.getElementById('canvasConfigJson').value = jsonConfig;

            // Simpan juga ke localStorage agar otomatis dibaca langsung oleh halaman Daftar Tamu
            localStorage.setItem('invitaze_saved_elements', jsonElems);
            localStorage.setItem('invitaze_saved_config', jsonConfig);

            alert('✅ Perubahan desain studio berhasil disimpan!');
            document.getElementById('editorForm').submit();
        }

        document.addEventListener("DOMContentLoaded", () => {
            const urlParams = new URLSearchParams(window.location.search);
            const isNewCanvas = urlParams.has('new');

            // Jika mode kanvas baru, hapus cache lama di localStorage dan kosongkan elemen
            if (isNewCanvas) {
                localStorage.removeItem('invitaze_saved_elements');
                localStorage.removeItem('invitaze_saved_config');
                canvasElements = [];
            } else {
                // Cek penyimpanan lokal jika bukan mode baru
                const localElems = localStorage.getItem('invitaze_saved_elements');
                const localConfig = localStorage.getItem('invitaze_saved_config');

                if (localElems && canvasElements.length === 0) {
                    try { canvasElements = JSON.parse(localElems); } catch (e) { }
                }
                if (localConfig && (!canvasConfig || !canvasConfig.height)) {
                    try { canvasConfig = JSON.parse(localConfig); } catch (e) { }
                }
            }

            updateCanvasHeight(canvasConfig.height || 1200);

            if (canvasConfig.bgMode === 'gradient') {
                setBackgroundMode('gradient');
            } else {
                setBackgroundMode('solid');
            }

            if (canvasConfig.globalFont) {
                updateGlobalFont(canvasConfig.globalFont);
                document.getElementById('globalFontFamily').value = canvasConfig.globalFont;
            }

            if (currentAudioSrc) {
                audioPlayer.src = currentAudioSrc;
            }

            renderCanvas();
            renderGalleryGrid();
        });
    </script>

</body>

</html>