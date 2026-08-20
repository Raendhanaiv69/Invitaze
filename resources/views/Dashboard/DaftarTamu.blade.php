<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitaze &mdash; Daftar Tamu Undangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400&family=Great+Vibes&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
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
            background: #E04F4F;
            border-radius: 10px;
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

        .shape-heart {
            border-radius: 0px !important;
            clip-path: url(#guestHeartClip);
            -webkit-clip-path: url(#guestHeartClip);
            background-color: transparent !important;
        }
    </style>
</head>

<body class="bg-cream text-stone-800 font-sans antialiased selection:bg-rosewarm-200">

    <svg class="absolute w-0 h-0" aria-hidden="true" focusable="false">
        <defs>
            <clipPath id="guestHeartClip" clipPathUnits="objectBoundingBox">
                <path
                    d="M 0.5, 0.95 C 0.5, 0.95 0.03, 0.62 0.01, 0.35 C -0.01, 0.16 0.14, 0.02 0.32, 0.02 C 0.42, 0.02 0.47, 0.08 0.5, 0.14 C 0.53, 0.08 0.58, 0.02 0.68, 0.02 C 0.86, 0.02 1.01, 0.16 0.99, 0.35 C 0.97, 0.62 0.5, 0.95 0.5, 0.95 Z">
                </path>
            </clipPath>
        </defs>
    </svg>

    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <main class="ml-64 w-full">
            <!-- HEADER -->
            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-rosewarm-100 flex items-center justify-between px-8 sticky top-0 z-10">
                <div>
                    <h2 class="font-playfair text-xl font-bold text-stone-900">Tamu Undangan ✨</h2>
                    <p class="text-xs text-warmgray">Generate link & kelola daftar undangan langsung dari database.</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('editor.index') ?? '/editor' }}"
                        class="px-4 py-2.5 rounded-full border border-rosewarm-200 bg-white text-stone-700 text-xs font-semibold flex items-center gap-2 hover:bg-rosewarm-50 transition shadow-sm">
                        <i class="ph-bold ph-pencil-simple text-sm"></i> Buka Editor Desain
                    </a>
                    <button onclick="document.getElementById('quickAddInput').focus()"
                        class="px-5 py-2.5 rounded-full bg-gradient-to-r from-rosewarm-500 to-terracotta text-white text-xs font-semibold flex items-center gap-2 hover:opacity-95 transition shadow-lg shadow-rosewarm-200">
                        <i class="ph-bold ph-plus text-sm"></i> + Tambah Tamu
                    </button>
                </div>
            </header>

            <!-- CONTENT SECTION -->
            <section class="p-8 space-y-8">
                <!-- ALERT NOTIFIKASI -->
                @if(session('success'))
                    <div
                        class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold flex items-center gap-2">
                        <i class="ph-bold ph-check-circle text-base"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- STAT CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="bg-white p-6 rounded-2xl border border-rosewarm-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-warmgray">Total Tamu</p>
                                <h3 class="font-playfair text-3xl font-bold text-stone-900 mt-2">
                                    {{ $stats['total_tamu'] }}</h3>
                            </div>
                            <div
                                class="w-10 h-10 rounded-xl bg-rosewarm-50 text-rosewarm-500 flex items-center justify-center text-lg">
                                <i class="ph-duotone ph-users"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-rosewarm-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p
                                    class="text-xs font-semibold uppercase tracking-wider text-emerald-600 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Hadir
                                </p>
                                <h3 class="font-playfair text-3xl font-bold text-stone-900 mt-2">
                                    {{ $stats['konfirmasi_hadir'] }}</h3>
                            </div>
                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-bold">
                                <i class="ph-bold ph-check"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-rosewarm-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p
                                    class="text-xs font-semibold uppercase tracking-wider text-rosewarm-500 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-rosewarm-400"></span> Berhalangan
                                </p>
                                <h3 class="font-playfair text-3xl font-bold text-stone-900 mt-2">
                                    {{ $stats['tidak_hadir'] }}</h3>
                            </div>
                            <div
                                class="w-10 h-10 rounded-xl bg-rosewarm-50 text-rosewarm-500 flex items-center justify-center text-lg font-bold">
                                <i class="ph-bold ph-x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-rosewarm-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p
                                    class="text-xs font-semibold uppercase tracking-wider text-amber-600 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span> Menunggu
                                </p>
                                <h3 class="font-playfair text-3xl font-bold text-stone-900 mt-2">
                                    {{ $stats['menunggu'] }}</h3>
                            </div>
                            <div
                                class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                                <i class="ph-bold ph-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MAIN GRID -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- FORM TAMBAH TAMU -->
                    <form action="{{ route('guests.store') }}" method="POST"
                        class="bg-white p-6 rounded-2xl border border-rosewarm-100 shadow-sm flex flex-col justify-between">
                        @csrf
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <i class="ph-duotone ph-sparkle text-xl text-terracotta"></i>
                                <h3 class="font-playfair text-lg font-bold text-stone-900">Tambah Tamu Baru</h3>
                            </div>
                            <p class="text-xs text-warmgray leading-relaxed">
                                Ketik nama tamu untuk menyimpan ke database dan generate tautan khusus.
                            </p>

                            <div class="space-y-3 pt-2">
                                <div>
                                    <label class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Nama
                                        Tamu / Pasangan</label>
                                    <input type="text" name="name" id="quickAddInput" required
                                        placeholder="contoh: Fitri & Partner"
                                        class="w-full mt-1.5 px-4 py-2.5 rounded-xl bg-sand/40 border border-rosewarm-200 text-sm focus:outline-none focus:ring-2 focus:ring-rosewarm-300">
                                </div>

                                <div>
                                    <label
                                        class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Kategori</label>
                                    <select name="category" id="guestCategory"
                                        class="w-full mt-1.5 px-4 py-2.5 rounded-xl bg-sand/40 border border-rosewarm-200 text-sm focus:outline-none focus:ring-2 focus:ring-rosewarm-300">
                                        <option value="Close Friends">Besties / Close Friends</option>
                                        <option value="Family">Keluarga Besar</option>
                                        <option value="Colleagues">Teman Kerja</option>
                                        <option value="VIP">Tamu VIP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-sand/50 border border-rosewarm-100 space-y-1 mt-4">
                                <span class="text-[10px] uppercase font-bold text-stone-400 tracking-wider">Preview
                                    Generated URL</span>
                                <p id="generatedUrl"
                                    class="text-xs text-rosewarm-600 font-mono break-all font-semibold">
                                    {{ $baseInvitationUrl }}?to=Nama+Tamu
                                </p>
                            </div>
                        </div>

                        <div class="space-y-2 pt-6">
                            <button type="submit"
                                class="w-full py-2.5 rounded-xl bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold flex items-center justify-center gap-2 transition shadow-sm">
                                <i class="ph-bold ph-plus-circle text-sm"></i> Simpan ke Daftar Tamu
                            </button>
                            <button type="button"
                                onclick="previewGuestLive(document.getElementById('quickAddInput').value.trim() || 'Tamu Undangan')"
                                class="w-full py-2.5 rounded-xl bg-rosewarm-100 hover:bg-rosewarm-200 text-rosewarm-600 text-xs font-bold flex items-center justify-center gap-2 transition shadow-sm">
                                <i class="ph-bold ph-eye text-base"></i> Cek Desain Tamu Ini
                            </button>
                        </div>
                    </form>

                    <!-- TABEL DAFTAR TAMU DARI DATABASE -->
                    <div
                        class="lg:col-span-2 bg-white rounded-2xl border border-rosewarm-100 shadow-sm p-6 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <h3 class="font-playfair text-lg font-bold text-stone-900">Daftar Link Tamu</h3>
                                    <p class="text-xs text-gray-400">Data realtime dari database</p>
                                </div>

                                <div class="relative">
                                    <i
                                        class="ph ph-magnifying-glass absolute left-3 top-2.5 text-stone-400 text-sm"></i>
                                    <input type="text" id="tableSearch" onkeyup="filterGuests()"
                                        placeholder="Cari nama tamu..."
                                        class="pl-9 pr-4 py-2 rounded-xl bg-sand/40 border border-stone-200 text-xs focus:outline-none focus:border-rosewarm-400 w-full sm:w-56">
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm">
                                    <thead
                                        class="bg-gray-50 text-gray-500 border-b border-gray-100 text-[11px] uppercase tracking-wider font-semibold">
                                        <tr>
                                            <th class="py-3.5 px-4 font-medium">Nama Tamu</th>
                                            <th class="py-3.5 px-4 font-medium">Kategori</th>
                                            <th class="py-3.5 px-4 font-medium">Status RSVP</th>
                                            <th class="py-3.5 px-4 font-medium text-right">Aksi & Cek Undangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100" id="guestTableBody">
                                        @forelse ($guests as $g)
                                            @php
                                                $customUrl = $baseInvitationUrl . "?to=" . urlencode($g->name);
                                            @endphp
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="py-3.5 px-4 font-semibold text-stone-800">
                                                    <div class="flex items-center gap-2">
                                                        <span class="guest-name-cell">{{ $g->name }}</span>
                                                        @if($g->opened)
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"
                                                                title="Sudah dibuka"></span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="py-3.5 px-4">
                                                    <span
                                                        class="px-2.5 py-1 rounded-full bg-sand text-stone-600 text-[11px] font-medium border border-stone-200">
                                                        {{ $g->category }}
                                                    </span>
                                                </td>
                                                <td class="py-3.5 px-4">
                                                    @if ($g->status === 'Hadir')
                                                        <span
                                                            class="px-3 py-1 bg-emerald-50 text-emerald-600 font-medium rounded-full text-xs inline-flex items-center gap-1">
                                                            <i class="ph-fill ph-check-circle"></i> Hadir
                                                        </span>
                                                    @elseif ($g->status === 'Tidak Hadir')
                                                        <span
                                                            class="px-3 py-1 bg-red-50 text-red-500 font-medium rounded-full text-xs inline-flex items-center gap-1">
                                                            <i class="ph-fill ph-x-circle"></i> Berhalangan
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-3 py-1 bg-amber-50 text-amber-600 font-medium rounded-full text-xs inline-flex items-center gap-1">
                                                            <i class="ph-fill ph-clock"></i> Pending
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="py-3.5 px-4 text-right">
                                                    <div class="flex items-center justify-end gap-1.5">
                                                        <button onclick="previewGuestLive('{{ addslashes($g->name) }}')"
                                                            class="p-2 rounded-lg bg-rosewarm-100 hover:bg-rosewarm-200 text-rosewarm-600 transition font-medium text-xs flex items-center gap-1"
                                                            title="Cek Undangan">
                                                            <i class="ph-bold ph-eye text-sm"></i>
                                                            <span class="hidden sm:inline">Cek</span>
                                                        </button>

                                                        <button onclick="navigator.clipboard.writeText('{{ $customUrl }}')"
                                                            class="p-2 rounded-lg bg-sand hover:bg-rosewarm-100 text-stone-700 transition"
                                                            title="Copy Link">
                                                            <i class="ph-bold ph-copy text-xs"></i>
                                                        </button>

                                                        <a href="https://wa.me/?text={{ urlencode('Halo ' . $g->name . ', kamu diundang ke pernikahan kami: ' . $customUrl) }}"
                                                            target="_blank"
                                                            class="p-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 transition"
                                                            title="Share WhatsApp">
                                                            <i class="ph-bold ph-whatsapp-logo text-xs"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-6 text-gray-400 text-xs">Belum ada
                                                    data tamu di database.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- PAGINATION -->
                        <div class="pt-4 border-t border-gray-100">
                            {{ $guests->links() }}
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- MODAL PREVIEW -->
    <div id="guestPreviewModal"
        class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-[32px] p-6 max-w-sm w-full shadow-2xl relative flex flex-col items-center">
            <button onclick="closeGuestPreview()"
                class="absolute top-4 right-4 w-8 h-8 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-600 flex items-center justify-center transition">
                <i class="ph-bold ph-x text-base"></i>
            </button>

            <div class="text-center mb-3">
                <span
                    class="text-[10px] uppercase font-bold tracking-wider text-rosewarm-500 bg-rosewarm-100 px-3 py-0.5 rounded-full">Live
                    Desain Studio</span>
                <h3 id="modalGuestTitle" class="font-playfair font-bold text-base text-stone-900 mt-1">Undangan</h3>
            </div>

            <div
                class="w-[300px] h-[520px] bg-stone-900 rounded-[38px] p-2.5 shadow-xl border-4 border-stone-800 relative flex flex-col">
                <div class="w-24 h-3 bg-stone-900 rounded-b-xl mx-auto z-30 flex-shrink-0"></div>
                <div id="modalPhoneScreen"
                    class="w-full flex-1 rounded-[28px] overflow-y-auto custom-scrollbar relative font-playfair transition-all"
                    style="background-color: #FDFBF7;">
                    <div id="modalCanvasLayer" class="relative w-full" style="height: 1200px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const baseUrl = "{{ $baseInvitationUrl }}";
        const inputName = document.getElementById('quickAddInput');
        const outputUrl = document.getElementById('generatedUrl');

        inputName.addEventListener('input', function (e) {
            const val = e.target.value.trim();
            outputUrl.textContent = val.length > 0 ? `${baseUrl}?to=${encodeURIComponent(val)}` : `${baseUrl}?to=Nama+Tamu`;
        });

        function filterGuests() {
            const query = document.getElementById('tableSearch').value.toLowerCase();
            document.querySelectorAll('#guestTableBody tr').forEach(row => {
                const name = row.querySelector('.guest-name-cell')?.innerText.toLowerCase() || '';
                row.style.display = name.includes(query) ? '' : 'none';
            });
        }

        function previewGuestLive(guestName) {
            const modal = document.getElementById('guestPreviewModal');
            document.getElementById('modalGuestTitle').innerText = `Undangan: ${guestName}`;

            const modalLayer = document.getElementById('modalCanvasLayer');
            modalLayer.innerHTML = `<div class="p-8 text-center text-xs text-warmgray">Preview untuk: <strong>${guestName}</strong></div>`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeGuestPreview() {
            const modal = document.getElementById('guestPreviewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>

</html>