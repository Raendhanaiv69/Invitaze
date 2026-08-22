<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ $guestName ? 'Undangan Pernikahan - ' . $guestName : 'The Wedding of ' . ($design['groom_short'] ?? 'Dimas') . ' & ' . ($design['bride_short'] ?? 'Sarah') }}
    </title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400&family=Great+Vibes&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        .font-playfair { font-family: 'Playfair Display', serif !important; }
        .font-cormorant { font-family: 'Cormorant Garamond', serif !important; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif !important; }
        .font-script { font-family: 'Great Vibes', cursive !important; }
        .font-cinzel { font-family: 'Cinzel', serif !important; }
        .font-montserrat { font-family: 'Montserrat', sans-serif !important; }

        .shape-rect { border-radius: 0px; }
        .shape-rounded { border-radius: 20px; }
        .shape-arch { border-radius: 9999px 9999px 16px 16px; }
        .shape-circle { border-radius: 9999px; }
        .shape-oval { border-radius: 50% / 60% 60% 40% 40%; }
        .shape-wave { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        .shape-polaroid { border-radius: 6px; padding-bottom: 24px; background-color: #ffffff; }

        .shape-heart {
            border-radius: 0px !important;
            clip-path: url(#heartClipPathPreview);
            -webkit-clip-path: url(#heartClipPathPreview);
            background-color: transparent !important;
        }

        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .spin-vinyl {
            animation: spinSlow 4s linear infinite;
        }

        /* ANIMASI SCROLL REVEAL */
        .reveal-item {
            opacity: 0;
            transform: translateY(28px) scale(0.96);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-item.is-visible {
            opacity: 1;
            transform: translateY(0) scale(1) rotate(var(--item-rotation, 0deg));
        }

        @keyframes subtleFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        .animate-float {
            animation: subtleFloat 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-stone-900 flex items-center justify-center min-h-screen antialiased selection:bg-rose-200">

    <svg class="absolute w-0 h-0" aria-hidden="true" focusable="false">
        <defs>
            <clipPath id="heartClipPathPreview" clipPathUnits="objectBoundingBox">
                <path
                    d="M 0.5, 0.95 C 0.5, 0.95 0.03, 0.62 0.01, 0.35 C -0.01, 0.16 0.14, 0.02 0.32, 0.02 C 0.42, 0.02 0.47, 0.08 0.5, 0.14 C 0.53, 0.08 0.58, 0.02 0.68, 0.02 C 0.86, 0.02 1.01, 0.16 0.99, 0.35 C 0.97, 0.62 0.5, 0.95 0.5, 0.95 Z">
                </path>
            </clipPath>
        </defs>
    </svg>

    <!-- WRAPPER RESPONSIVE (Maks 420px di Desktop, Full Width di Mobile) -->
    <div id="invitationContainer"
        class="w-full max-w-[420px] min-h-screen relative shadow-2xl overflow-hidden transition-all flex flex-col">

        <!-- FLOATING MUSIC BUTTON -->
        <button id="floatingMusicBtn" onclick="toggleAudio()"
            class="fixed bottom-6 right-6 lg:right-[calc(50%-190px)] z-50 w-11 h-11 rounded-full bg-black/70 backdrop-blur-md text-white border border-white/30 flex items-center justify-center shadow-lg transition hover:scale-105 hidden">
            <i id="musicDiscIcon" class="ph-fill ph-disc text-2xl text-rose-300"></i>
        </button>
        <audio id="bgAudio" preload="auto" loop></audio>

        <!-- VIEWPORT CANVAS -->
        <div id="canvasViewport" class="w-full relative overflow-hidden" style="min-height: 1200px;"></div>

    </div>

    <script>
        const guestName = @json($guestName ?? 'Tamu Undangan');
        let serverElements = @json($design['canvas_elements'] ?? []);
        let serverConfig = @json($design['canvas_config'] ?? []);
        let serverMusicUrl = @json($design['bg_music_url'] ?? '');

        // Fallback data LocalStorage jika data server kosong
        const localElems = localStorage.getItem('invitaze_saved_elements');
        const localConfig = localStorage.getItem('invitaze_saved_config');

        let canvasElements = (serverElements && serverElements.length > 0) ? serverElements : (localElems ? JSON.parse(localElems) : []);
        let canvasConfig = (serverConfig && serverConfig.height) ? serverConfig : (localConfig ? JSON.parse(localConfig) : {
            height: 1200,
            bgMode: 'solid',
            bgColor: '#FDFBF7',
            gradColor1: '#FFF5F5',
            gradColor2: '#FDE8E8',
            gradDirection: 'to bottom',
            globalFont: 'font-playfair',
            globalColor: '#2D2422'
        });

        const baseWidth = 316; // Basis lebar canvas editor

        function renderInvitation() {
            const container = document.getElementById('invitationContainer');
            const viewport = document.getElementById('canvasViewport');

            if (canvasConfig.bgMode === 'gradient') {
                container.style.backgroundColor = 'transparent';
                container.style.backgroundImage = `linear-gradient(${canvasConfig.gradDirection || 'to bottom'}, ${canvasConfig.gradColor1 || '#FFF5F5'}, ${canvasConfig.gradColor2 || '#FDE8E8'})`;
            } else {
                container.style.backgroundImage = 'none';
                container.style.backgroundColor = canvasConfig.bgColor || '#FDFBF7';
            }

            if (canvasConfig.globalFont) {
                container.className = `w-full max-w-[420px] min-h-screen relative shadow-2xl overflow-hidden transition-all flex flex-col ${canvasConfig.globalFont}`;
            }

            viewport.style.height = `${canvasConfig.height || 1200}px`;
            viewport.innerHTML = '';

            const currentWidth = viewport.offsetWidth || 375;
            const scale = currentWidth / baseWidth;

            canvasElements.forEach((item, index) => {
                const el = document.createElement('div');
                el.className = `absolute reveal-item ${item.fontFamily || ''}`;

                const posX = Math.round(item.posX * scale);
                const posY = Math.round(item.posY * scale);
                const width = item.width ? `${Math.round(item.width * scale)}px` : 'auto';
                const fontSize = item.fontSize ? Math.round(item.fontSize * scale) : 14;

                el.style.left = `${posX}px`;
                el.style.top = `${posY}px`;
                el.style.width = width;
                el.style.setProperty('--item-rotation', `${item.rotation || 0}deg`);
                el.style.transitionDelay = `${(index % 3) * 0.12}s`;

                if (item.type === 'badge') {
                    el.innerHTML = `<span class="inline-block px-3 py-1 rounded-full bg-rose-100 uppercase tracking-widest font-bold shadow-sm" style="font-size: ${fontSize}px; color: ${item.fontColor};">${item.content}</span>`;
                } else if (item.type === 'guest_card') {
                    el.innerHTML = `
                        <div class="bg-white/90 backdrop-blur-md p-4 rounded-2xl border border-rose-100 shadow-md space-y-1 text-center animate-float">
                            <p class="text-[10px] uppercase tracking-wider font-semibold opacity-75" style="color: ${item.fontColor};">
                                ${item.headerText || 'Kepada Yth. Bapak/Ibu/Saudara/i'}
                            </p>
                            <h2 class="font-bold tracking-tight" style="font-size: ${fontSize}px; color: ${item.fontColor};">
                                ${guestName || item.content}
                            </h2>
                            <p class="text-[10px] opacity-60" style="color: ${item.fontColor};">
                                ${item.footerText || 'Di Tempat'}
                            </p>
                        </div>
                    `;
                } else if (item.type === 'rsvp_button') {
                    el.innerHTML = `<button type="button" class="w-full py-3 rounded-xl bg-gradient-to-r from-[#E27367] to-[#C04A3E] text-white font-semibold shadow-md text-xs transform transition active:scale-95 hover:scale-[1.02]">${item.content}</button>`;
                } else if (item.type === 'gift_card') {
                    el.innerHTML = `
                        <div class="p-4 bg-white/90 backdrop-blur-md rounded-2xl border border-rose-100 shadow-md text-center space-y-1">
                            <span class="text-xs opacity-75 block" style="color: ${item.fontColor};">${item.headerText || 'Amplop Digital'}</span>
                            <p class="font-bold font-mono text-sm" style="color: ${item.fontColor};">${item.content}</p>
                        </div>
                    `;
                } else if (item.type === 'photo_frame') {
                    const frameHeight = Math.round((item.height || 190) * scale);
                    el.className += ` ${item.shape}`;
                    el.style.height = `${frameHeight}px`;
                    if (item.shape !== 'shape-heart') {
                        el.style.border = `${item.borderWidth || 3}px solid ${item.borderColor || '#FFFFFF'}`;
                        el.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.15)';
                    }
                    el.style.overflow = 'hidden';

                    const zoom = (item.imgZoom || 100) / 100;
                    const imgX = item.imgPosX !== undefined ? item.imgPosX : 50;
                    const imgY = item.imgPosY !== undefined ? item.imgPosY : 50;

                    el.innerHTML = `<img src="${item.src}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" style="object-position: ${imgX}% ${imgY}%; transform: scale(${zoom});">`;
                } else {
                    el.innerHTML = `<div class="text-center" style="font-size: ${fontSize}px; color: ${item.fontColor};">${item.content}</div>`;
                }

                viewport.appendChild(el);
            });

            initScrollObserver();
        }

        // OBSERVER DETEKSI SCROLL ELEMEN
        function initScrollObserver() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -30px 0px'
            });

            document.querySelectorAll('.reveal-item').forEach(el => observer.observe(el));
        }

        // MUSIC HANDLER
        let isAudioPlaying = false;
        function setupAudio() {
            const musicUrl = serverMusicUrl || localStorage.getItem('invitaze_bg_music_url');
            if (!musicUrl) return;

            const audio = document.getElementById('bgAudio');
            const btn = document.getElementById('floatingMusicBtn');
            const icon = document.getElementById('musicDiscIcon');

            audio.src = musicUrl;
            btn.classList.remove('hidden');

            audio.play().then(() => {
                isAudioPlaying = true;
                icon.classList.add('spin-vinyl');
            }).catch(() => {
                document.body.addEventListener('click', () => {
                    if (!isAudioPlaying) toggleAudio();
                }, { once: true });
            });
        }

        function toggleAudio() {
            const audio = document.getElementById('bgAudio');
            const icon = document.getElementById('musicDiscIcon');
            if (!audio.src) return;

            if (isAudioPlaying) {
                audio.pause();
                icon.classList.remove('spin-vinyl');
                isAudioPlaying = false;
            } else {
                audio.play();
                icon.classList.add('spin-vinyl');
                isAudioPlaying = true;
            }
        }

        window.addEventListener('resize', renderInvitation);
        document.addEventListener('DOMContentLoaded', () => {
            renderInvitation();
            setupAudio();
        });
    </script>
</body>

</html>