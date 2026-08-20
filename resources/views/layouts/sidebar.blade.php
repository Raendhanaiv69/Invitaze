<!-- SIDEBAR COMPONENT (sidebar.php) -->
<aside class="w-64 bg-white/80 backdrop-blur-xl border-r border-rosewarm-100 fixed h-screen z-10 flex flex-col justify-between p-6">

    <div class="space-y-8">
        <!-- LOGO & BRAND -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rosewarm-400 to-terracotta flex items-center justify-center text-white shadow-md shadow-rosewarm-200 shrink-0">
                <i class="ph-duotone ph-heart text-xl"></i>
            </div>
            <div>
                <h1 class="font-serif text-xl font-bold tracking-tight text-stone-900 leading-tight">
                    Invitaze<span class="text-rosewarm-500">.</span>
                </h1>
                <p class="text-[10px] text-warmgray tracking-widest uppercase font-semibold">Love Edition</p>
            </div>
        </div>

        <!-- MENU NAVIGASI (Dengan Active State Langsung) -->
        <nav class="space-y-1.5">

            <!-- 1. Daftar Tamu -->
            <a href="{{ route('daftartamu') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm transition-all <?php echo (!isset($_GET['page']) || $_GET['page'] == 'guests') ? 'bg-rosewarm-50 text-rosewarm-600 font-semibold shadow-sm' : 'text-warmgray hover:bg-rosewarm-50/50 hover:text-stone-900 font-medium'; ?>">
                <i class="ph-fill ph-users-three text-lg"></i>
                <span>Daftar Tamu</span>
            </a>

            <!-- 2. Kustomisasi Desain -->
            <a href="{{ route('kustomdesain') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm transition-all <?php echo (isset($_GET['page']) && $_GET['page'] == 'design') ? 'bg-rosewarm-50 text-rosewarm-600 font-semibold shadow-sm' : 'text-warmgray hover:bg-rosewarm-50/50 hover:text-stone-900 font-medium'; ?>">
                <i class="ph-bold ph-palette text-lg"></i>
                <span>Kustomisasi Desain</span>
            </a>

            <!-- 3. Ucapan & Doa -->
            <a href="index.php?page=wishes"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm transition-all <?php echo (isset($_GET['page']) && $_GET['page'] == 'wishes') ? 'bg-rosewarm-50 text-rosewarm-600 font-semibold shadow-sm' : 'text-warmgray hover:bg-rosewarm-50/50 hover:text-stone-900 font-medium'; ?>">
                <i class="ph-bold ph-chat-centered-text text-lg"></i>
                <span>Ucapan & Doa</span>
            </a>

            <!-- 4. Musik & Galeri -->
            <a href="index.php?page=gallery"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm transition-all <?php echo (isset($_GET['page']) && $_GET['page'] == 'gallery') ? 'bg-rosewarm-50 text-rosewarm-600 font-semibold shadow-sm' : 'text-warmgray hover:bg-rosewarm-50/50 hover:text-stone-900 font-medium'; ?>">
                <i class="ph-bold ph-music-notes text-lg"></i>
                <span>Musik & Galeri</span>
            </a>

        </nav>
    </div>

    <!-- PROFIL BAWAH -->
    <div class="pt-6 border-t border-stone-100 flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-rosewarm-100 border border-rosewarm-200 flex items-center justify-center text-rosewarm-600 font-semibold text-sm">
            DS
        </div>
        <div class="truncate">
            <p class="text-xs font-semibold text-stone-900 truncate">Dimas & Sarah</p>
            <p class="text-[10px] text-warmgray">18 Desember 2026</p>
        </div>
    </div>

</aside>