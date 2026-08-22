<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitaze &mdash; Daftar Tamu Undangan</title>
    
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
                    colors: {
                        cream: '#FDFBF7',
                        sand: '#F7F3EB'
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif']
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
            background: #E11D48;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-cream text-stone-800 font-sans antialiased selection:bg-rose-100 selection:text-rose-700">

    <!-- OVERLAY UNTUK MOBILE SAAT SIDEBAR DIBUKA -->
    <div id="sidebarOverlay" onclick="toggleSidebar()"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 hidden lg:hidden transition-opacity"></div>

    <div class="flex min-h-screen">
        
        <!-- SIDEBAR DRAWER WRAPPER (Memanggil layouts.sidebar) -->
        <div id="sidebarWrapper"
            class="fixed top-0 bottom-0 left-0 z-40 w-64 -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            @include('layouts.sidebar')
        </div>

        <!-- MAIN WRAPPER -->
        <main class="w-full lg:ml-64 flex flex-col min-h-screen">
            
            <!-- HEADER WORKSPACE -->
            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-rose-100 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-20">
                
                <div class="flex items-center gap-3">
                    <!-- HAMBURGER BUTTON (MOBILE ONLY) -->
                    <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-2xl bg-stone-50 border border-rose-100 text-stone-700 hover:bg-rose-50 transition focus:outline-none">
                        <i class="ph-bold ph-list text-xl"></i>
                    </button>

                    <div>
                        <h2 class="font-serif text-lg sm:text-xl font-bold text-stone-900 leading-tight">Daftar Tamu Undangan ✨</h2>
                        <p class="text-[11px] sm:text-xs text-stone-500 hidden sm:block">Generate link personal & kelola konfirmasi kehadiran langsung dari database.</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('editor.index') ?? '/editor' }}"
                        class="px-3 sm:px-4 py-2 sm:py-2.5 rounded-2xl border border-rose-200 bg-white text-stone-700 text-xs font-semibold flex items-center gap-1.5 hover:bg-rose-50 transition shadow-sm">
                        <i class="ph-bold ph-pencil-simple text-sm text-rose-600"></i>
                        <span class="hidden md:inline">Buka</span> Editor Desain
                    </a>
                    <button onclick="document.getElementById('quickAddInput').focus()"
                        class="px-4 sm:px-5 py-2 sm:py-2.5 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold flex items-center gap-1.5 transition shadow-md shadow-rose-200">
                        <i class="ph-bold ph-plus text-sm"></i>
                        <span>+ Tambah Tamu</span>
                    </button>
                </div>
            </header>

            <!-- CONTENT SECTION -->
            <section class="p-4 sm:p-8 space-y-6 flex-1">
                @if(session('success'))
                    <div
                        class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold flex items-center gap-2 shadow-sm">
                        <i class="ph-bold ph-check-circle text-base"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- STAT CARDS (Sesuai Gaya Profil & Aksen Sidebar) -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
                    <div class="bg-stone-50 p-4 sm:p-5 rounded-3xl border border-rose-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-stone-400">Total Tamu</p>
                                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 mt-1">
                                    {{ $stats['total_tamu'] ?? ($guests->total() ?? count($guests)) }}
                                </h3>
                            </div>
                            <div class="w-10 h-10 rounded-2xl bg-rose-100/70 text-rose-700 flex items-center justify-center text-lg shadow-sm">
                                <i class="ph-duotone ph-users-three"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-stone-50 p-4 sm:p-5 rounded-3xl border border-rose-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Hadir
                                </p>
                                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 mt-1">
                                    {{ $stats['konfirmasi_hadir'] ?? 0 }}
                                </h3>
                            </div>
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-bold shadow-sm">
                                <i class="ph-bold ph-check"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-stone-50 p-4 sm:p-5 rounded-3xl border border-rose-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-rose-600 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-rose-400"></span> Berhalangan
                                </p>
                                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 mt-1">
                                    {{ $stats['tidak_hadir'] ?? 0 }}
                                </h3>
                            </div>
                            <div class="w-10 h-10 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-lg font-bold shadow-sm">
                                <i class="ph-bold ph-x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-stone-50 p-4 sm:p-5 rounded-3xl border border-rose-100 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-amber-600 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span> Menunggu
                                </p>
                                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 mt-1">
                                    {{ $stats['menunggu'] ?? 0 }}
                                </h3>
                            </div>
                            <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg shadow-sm">
                                <i class="ph-bold ph-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MAIN CONTENT GRID -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- FORM TAMBAH TAMU -->
                    <form action="{{ route('guests.store') }}" method="POST"
                        class="bg-stone-50 p-6 rounded-3xl border border-rose-100 shadow-sm flex flex-col justify-between space-y-6">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <span class="text-[10px] uppercase font-bold tracking-wider text-rose-700 bg-rose-100 px-3 py-0.5 rounded-full">
                                    Tambah Cepat
                                </span>
                                <h3 class="font-serif text-lg font-bold text-stone-900 mt-2">Data Tamu Baru</h3>
                                <p class="text-xs text-stone-500 leading-relaxed mt-0.5">
                                    Ketik nama tamu untuk menyimpan ke database dan generate tautan khusus.
                                </p>
                            </div>

                            <div class="space-y-3 pt-1">
                                <div>
                                    <label class="text-[11px] font-bold uppercase tracking-wider text-stone-600 block mb-1">
                                        Nama Tamu / Pasangan
                                    </label>
                                    <input type="text" name="name" id="quickAddInput" required
                                        placeholder="contoh: Fitri & Partner"
                                        class="w-full px-4 py-2.5 rounded-2xl bg-white border border-rose-200/80 text-sm text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition shadow-sm" />
                                </div>

                                <div>
                                    <label class="text-[11px] font-bold uppercase tracking-wider text-stone-600 block mb-1">
                                        Kategori
                                    </label>
                                    <select name="category" id="guestCategory"
                                        class="w-full px-4 py-2.5 rounded-2xl bg-white border border-rose-200/80 text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition shadow-sm">
                                        <option value="Close Friends">Besties / Close Friends</option>
                                        <option value="Family">Keluarga Besar</option>
                                        <option value="Colleagues">Teman Kerja</option>
                                        <option value="VIP">Tamu VIP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white border border-rose-100 shadow-sm space-y-1">
                                <span class="text-[10px] uppercase font-bold text-stone-400 tracking-wider block">Preview Generated URL</span>
                                <p id="generatedUrl" class="text-xs text-rose-600 font-mono break-all font-semibold">
                                    {{ $baseInvitationUrl ?? url('/') }}?to=Nama+Tamu
                                </p>
                            </div>
                        </div>

                        <div class="space-y-2 pt-2">
                            <button type="submit"
                                class="w-full py-2.5 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold flex items-center justify-center gap-2 shadow-md shadow-rose-200 transition">
                                <i class="ph-bold ph-plus-circle text-sm"></i> Simpan ke Daftar Tamu
                            </button>
                            <button type="button"
                                onclick="previewGuestLive(document.getElementById('quickAddInput').value.trim() || 'Tamu Undangan')"
                                class="w-full py-2.5 rounded-2xl bg-rose-100/70 hover:bg-rose-200/70 text-rose-700 text-xs font-bold flex items-center justify-center gap-2 transition">
                                <i class="ph-bold ph-eye text-base"></i> Cek Desain Tamu Ini
                            </button>
                        </div>
                    </form>

                    <!-- TABEL DAFTAR TAMU DARI DATABASE -->
                    <div class="lg:col-span-2 bg-stone-50 rounded-3xl border border-rose-100 shadow-sm p-6 flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <h3 class="font-serif text-lg font-bold text-stone-900">Daftar Link Tamu</h3>
                                    <p class="text-xs text-stone-400">Data realtime dari database</p>
                                </div>

                                <div class="relative">
                                    <i class="ph ph-magnifying-glass absolute left-3.5 top-3 text-stone-400 text-sm"></i>
                                    <input type="text" id="tableSearch" onkeyup="filterGuests()"
                                        placeholder="Cari nama tamu..."
                                        class="pl-9 pr-4 py-2 rounded-2xl bg-white border border-rose-200/80 text-xs focus:outline-none focus:border-rose-500 w-full sm:w-56 shadow-sm">
                                </div>
                            </div>

                            <div class="overflow-x-auto -mx-6 sm:mx-0">
                                <table class="w-full text-left text-sm min-w-[500px]">
                                    <thead class="bg-white text-stone-500 border-y border-rose-100 text-[11px] uppercase tracking-wider font-semibold">
                                        <tr>
                                            <th class="py-3.5 px-4 font-medium">Nama Tamu</th>
                                            <th class="py-3.5 px-4 font-medium">Kategori</th>
                                            <th class="py-3.5 px-4 font-medium">Status RSVP</th>
                                            <th class="py-3.5 px-4 font-medium text-right">Aksi & Cek Undangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-rose-100/70" id="guestTableBody">
                                        @forelse ($guests as $g)
                                            @php
                                                $baseTarget = $baseInvitationUrl ?? url('/');
                                                $customUrl = $baseTarget . "?to=" . urlencode($g->name);
                                            @endphp
                                            <tr class="hover:bg-rose-50/50 transition">
                                                <td class="py-3.5 px-4 font-semibold text-stone-800">
                                                    <div class="flex items-center gap-2">
                                                        <span class="guest-name-cell">{{ $g->name }}</span>
                                                        @if(!empty($g->opened))
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500" title="Sudah dibuka"></span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="py-3.5 px-4">
                                                    <span class="px-2.5 py-1 rounded-full bg-white text-stone-600 text-[11px] font-medium border border-rose-100 shadow-sm">
                                                        {{ $g->category }}
                                                    </span>
                                                </td>
                                                <td class="py-3.5 px-4">
                                                    @if ($g->status === 'Hadir')
                                                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 font-medium rounded-full text-xs inline-flex items-center gap-1">
                                                            <i class="ph-fill ph-check-circle"></i> Hadir
                                                        </span>
                                                    @elseif ($g->status === 'Tidak Hadir')
                                                        <span class="px-3 py-1 bg-rose-100 text-rose-600 font-medium rounded-full text-xs inline-flex items-center gap-1">
                                                            <i class="ph-fill ph-x-circle"></i> Berhalangan
                                                        </span>
                                                    @else
                                                        <span class="px-3 py-1 bg-amber-50 text-amber-600 font-medium rounded-full text-xs inline-flex items-center gap-1">
                                                            <i class="ph-fill ph-clock"></i> Pending
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="py-3.5 px-4 text-right">
                                                    <div class="flex items-center justify-end gap-1.5">
                                                        <button onclick="previewGuestLive('{{ addslashes($g->name) }}')"
                                                            class="p-2 rounded-xl bg-rose-100/80 hover:bg-rose-200 text-rose-700 transition font-medium text-xs flex items-center gap-1"
                                                            title="Cek Undangan">
                                                            <i class="ph-bold ph-eye text-sm"></i>
                                                            <span class="hidden sm:inline">Cek</span>
                                                        </button>

                                                        <button onclick="navigator.clipboard.writeText('{{ $customUrl }}')"
                                                            class="p-2 rounded-xl bg-white hover:bg-rose-50 text-stone-700 border border-rose-100 transition shadow-sm"
                                                            title="Copy Link">
                                                            <i class="ph-bold ph-copy text-xs"></i>
                                                        </button>

                                                        <a href="https://wa.me/?text={{ urlencode('Halo ' . $g->name . ', kamu diundang ke pernikahan kami: ' . $customUrl) }}"
                                                            target="_blank"
                                                            class="p-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 transition"
                                                            title="Share WhatsApp">
                                                            <i class="ph-bold ph-whatsapp-logo text-xs"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-6 text-stone-400 text-xs">Belum ada data tamu di database.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- PAGINATION -->
                        @if(method_exists($guests, 'links'))
                            <div class="pt-4 border-t border-rose-100">
                                {{ $guests->links() }}
                            </div>
                        @endif
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
                <span class="text-[10px] uppercase font-bold tracking-wider text-rose-700 bg-rose-100 px-3 py-0.5 rounded-full">
                    Live Desain Studio
                </span>
                <h3 id="modalGuestTitle" class="font-serif font-bold text-base text-stone-900 mt-1">Undangan</h3>
            </div>

            <div class="w-[280px] sm:w-[300px] h-[480px] sm:h-[520px] bg-stone-900 rounded-[38px] p-2.5 shadow-xl border-4 border-stone-800 relative flex flex-col">
                <div class="w-24 h-3 bg-stone-900 rounded-b-xl mx-auto z-30 flex-shrink-0"></div>
                <div id="modalPhoneScreen"
                    class="w-full flex-1 rounded-[28px] overflow-hidden relative transition-all bg-cream">
                    <div id="modalCanvasLayer" class="w-full h-full flex items-center justify-center text-xs text-stone-400">
                        Memuat...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const baseUrl = "{{ $baseInvitationUrl ?? url('/') }}";
        const inputName = document.getElementById('quickAddInput');
        const outputUrl = document.getElementById('generatedUrl');

        function toggleSidebar() {
            const sidebarWrapper = document.getElementById('sidebarWrapper');
            const overlay = document.getElementById('sidebarOverlay');

            const isClosed = sidebarWrapper.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebarWrapper.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebarWrapper.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        if (inputName && outputUrl) {
            inputName.addEventListener('input', function (e) {
                const val = e.target.value.trim();
                outputUrl.textContent = val.length > 0 ? `${baseUrl}?to=${encodeURIComponent(val)}` : `${baseUrl}?to=Nama+Tamu`;
            });
        }

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
            const modalScreen = document.getElementById('modalPhoneScreen');
            
            const targetUrl = `${baseUrl}?to=${encodeURIComponent(guestName)}`;
            modalScreen.innerHTML = `
                <iframe src="${targetUrl}" class="w-full h-full border-0 rounded-[28px] overflow-y-auto"></iframe>
            `;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeGuestPreview() {
            const modal = document.getElementById('guestPreviewModal');
            const modalScreen = document.getElementById('modalPhoneScreen');
            modalScreen.innerHTML = '<div id="modalCanvasLayer" class="w-full h-full flex items-center justify-center text-xs text-stone-400">Memuat...</div>';
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>

</html>