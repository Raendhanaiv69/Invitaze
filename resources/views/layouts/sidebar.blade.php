<!-- SIDEBAR COMPONENT (sidebar.blade.php) -->
<aside
    class="w-64 bg-stone-50 border-r border-rose-100 fixed h-screen z-10 flex flex-col justify-between p-5 text-stone-800 shadow-sm">

    <div class="space-y-6">
        <!-- LOGO & BRAND -->
        <div class="flex items-center gap-3 px-1">
            <div
                class="w-10 h-10 rounded-2xl bg-rose-600 flex items-center justify-center text-white shadow-md shadow-rose-200 shrink-0">
                <i class="ph-fill ph-heart text-xl"></i>
            </div>
            <div>
                <h1 class="font-serif text-xl font-bold tracking-tight text-stone-900 leading-tight">
                    Invitaze<span class="text-rose-600">.</span>
                </h1>
                <p class="text-[10px] text-stone-400 tracking-widest uppercase font-semibold">Love Edition</p>
            </div>
        </div>

        <!-- MENU NAVIGASI -->
        <nav class="space-y-1.5">

            <!-- 1. Daftar Tamu -->
            <a href="{{ route('daftartamu') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('daftartamu') ? 'bg-rose-600 text-white shadow-md shadow-rose-200' : 'text-stone-600 hover:bg-rose-50 hover:text-rose-700' }}">
                <i class="{{ request()->routeIs('daftartamu') ? 'ph-fill' : 'ph-bold' }} ph-users-three text-lg"></i>
                <span>Daftar Tamu</span>
            </a>

            <!-- 2. Kustomisasi Desain & Editor -->
            <a href="{{ route('kustomdesain') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('kustomdesain', 'editor*') ? 'bg-rose-600 text-white shadow-md shadow-rose-200' : 'text-stone-600 hover:bg-rose-50 hover:text-rose-700' }}">
                <i
                    class="{{ request()->routeIs('kustomdesain', 'editor*') ? 'ph-fill' : 'ph-bold' }} ph-palette text-lg"></i>
                <span>Kustomisasi Desain</span>
            </a>

            <!-- 3. Ucapan & Doa -->
            <a href="{{ Route::has('ucapan') ? route('ucapan') : '#' }}"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('ucapan*') ? 'bg-rose-600 text-white shadow-md shadow-rose-200' : 'text-stone-600 hover:bg-rose-50 hover:text-rose-700' }}">
                <i
                    class="{{ request()->routeIs('ucapan*') ? 'ph-fill' : 'ph-bold' }} ph-chat-centered-text text-lg"></i>
                <span>Ucapan & Doa</span>
            </a>

            <!-- 4. Musik & Galeri -->
            <a href="{{ Route::has('galeri') ? route('galeri') : '#' }}"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('galeri*') ? 'bg-rose-600 text-white shadow-md shadow-rose-200' : 'text-stone-600 hover:bg-rose-50 hover:text-rose-700' }}">
                <i class="{{ request()->routeIs('galeri*') ? 'ph-fill' : 'ph-bold' }} ph-music-notes text-lg"></i>
                <span>Musik & Galeri</span>
            </a>

        </nav>
    </div>

    <!-- PROFIL BAWAH -->
    <!-- PROFIL BAWAH (DINAMIS SESUAI AUTH LOGIN) -->
    @auth
        @php
            $fullName = Auth::user()->name ?? 'User';
            // Mengambil inisial huruf dari kata pertama & kedua (contoh: "Dimas & Sarah" -> "DS", "Ilmi Vadhiasih" -> "IV")
            $words = preg_split('/\s+/', trim($fullName));
            $initials = '';
            if (count($words) >= 2) {
                $first = mb_substr($words[0], 0, 1);
                $secondWord = $words[1] === '&' && isset($words[2]) ? $words[2] : $words[1];
                $second = mb_substr($secondWord, 0, 1);
                $initials = strtoupper($first . $second);
            } else {
                $initials = strtoupper(mb_substr($fullName, 0, 2));
            }
        @endphp

        <div class="p-3 rounded-2xl bg-white border border-rose-100 flex items-center justify-between shadow-sm gap-2">
            <div class="flex items-center gap-3 min-w-0">
                <!-- Inisial Avatar -->
                <div
                    class="w-10 h-10 rounded-xl bg-rose-100 border border-rose-200 flex items-center justify-center text-rose-700 font-bold text-xs shrink-0 uppercase">
                    {{ $initials }}
                </div>

                <!-- Nama & Info Akun -->
                <div class="truncate">
                    <p class="text-xs font-semibold text-stone-900 truncate" title="{{ $fullName }}">
                        {{ $fullName }}
                    </p>
                    <p class="text-[10px] text-stone-400 font-medium truncate">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>

            <!-- Tombol Logout Cepat -->
            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit" class="p-2 rounded-xl text-stone-400 hover:text-rose-600 hover:bg-rose-50 transition"
                    title="Keluar">
                    <i class="ph-bold ph-sign-out text-base"></i>
                </button>
            </form>
        </div>
    @else
        <!-- TAMPILAN JIKA BELUM LOGIN / GUEST -->
        <a href="{{ route('login') }}"
            class="p-3 rounded-2xl bg-rose-50 hover:bg-rose-100 border border-rose-200 flex items-center justify-center gap-2 text-rose-600 font-semibold text-xs transition">
            <i class="ph-bold ph-sign-in text-base"></i>
            <span>Masuk ke Akun</span>
        </a>
    @endauth

</aside>