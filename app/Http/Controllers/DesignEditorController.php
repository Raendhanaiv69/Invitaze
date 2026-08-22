<?php

namespace App\Http\Controllers;

use App\Models\WeddingDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DesignEditorController extends Controller
{
    public function edit()
    {
        $userId = Auth::id();

        // Cari atau buat data default untuk user yang sedang aktif
        $design = WeddingDesign::when($userId, function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })->first();

        if (!$design) {
            $design = WeddingDesign::create([
                'user_id'         => $userId,
                'groom_short'     => 'Dimas',
                'bride_short'     => 'Sarah',
                'theme'           => 'warm-terracotta',
                'bg_music_title'  => '',
                'bg_music_url'    => '',
                'canvas_elements' => [],
                'canvas_config'   => [
                    'height'         => 1200,
                    'bgMode'         => 'solid',
                    'bgColor'        => '#FDFBF7',
                    'gradColor1'     => '#FFF5F5',
                    'gradColor2'     => '#FDE8E8',
                    'gradDirection'  => 'to bottom',
                    'globalFont'     => 'font-playfair',
                    'globalColor'    => '#2D2422'
                ]
            ]);
        }

        return view('dashboard.Editor', compact('design'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'canvas_elements_json' => 'nullable|string',
            'canvas_config_json'   => 'nullable|string',
            'audio_file'           => 'nullable|file|mimes:mp3,wav,aac,m4a|max:10240',
            'theme'                => 'nullable|string',
            'bg_music_title'       => 'nullable|string',
            'bg_music_url'         => 'nullable|string',
        ]);

        $userId = Auth::id();

        $design = WeddingDesign::when($userId, function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })->first();

        if (!$design) {
            $design = new WeddingDesign();
            $design->user_id = $userId;
            $design->groom_short = 'Dimas';
            $design->bride_short = 'Sarah';
        }

        $rawElements = $request->input('canvas_elements_json');
        $rawConfig   = $request->input('canvas_config_json');

        $design->canvas_elements = !empty($rawElements) ? (json_decode($rawElements, true) ?? []) : [];
        $design->canvas_config   = !empty($rawConfig) ? (json_decode($rawConfig, true) ?? []) : [
            'height'      => 1200,
            'bgMode'      => 'solid',
            'bgColor'     => '#FDFBF7',
            'globalFont'  => 'font-playfair',
            'globalColor' => '#2D2422'
        ];

        // Upload Audio jika ada
        if ($request->hasFile('audio_file')) {
            if ($design->bg_music_url && Storage::disk('public')->exists(str_replace('/storage/', '', $design->bg_music_url))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $design->bg_music_url));
            }

            $file = $request->file('audio_file');
            $path = $file->store('wedding_audio', 'public');
            $design->bg_music_url = Storage::url($path);
            $design->bg_music_title = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        } elseif ($request->filled('bg_music_title')) {
            $design->bg_music_title = $request->input('bg_music_title');
            $design->bg_music_url = $request->input('bg_music_url');
        }

        $design->theme = $request->input('theme', 'warm-terracotta');
        $design->save();

        return redirect()->route('editor')->with([
            'status_msg'  => 'Desain studio berhasil disimpan!',
            'status_type' => 'success'
        ]);
    }

    public function preview(Request $request)
    {
        // Mengambil nama tamu dari query string (?to=Nama+Tamu)
        $guestName = $request->query('to', 'Tamu Undangan');
        $userId = Auth::id();

        $design = WeddingDesign::when($userId, function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })->latest()->first();

        if (!$design) {
            $design = [
                'groom_short'     => 'Dimas',
                'bride_short'     => 'Sarah',
                'theme'           => 'warm-terracotta',
                'bg_music_title'  => '',
                'bg_music_url'    => '',
                'canvas_elements' => [],
                'canvas_config'   => [
                    'height'      => 1200,
                    'bgMode'      => 'solid',
                    'bgColor'     => '#FDFBF7',
                    'globalFont'  => 'font-playfair',
                    'globalColor' => '#2D2422'
                ]
            ];
        }

        return view('dashboard.preview', compact('design', 'guestName'));
    }
}
