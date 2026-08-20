<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // app/Http/Controllers/GuestController.php

    public function index()
    {
        $guests = Guest::latest()->paginate(10);

        $stats = [
            'total_tamu' => Guest::count(),
            'konfirmasi_hadir' => Guest::where('status', 'Hadir')->count(),
            'tidak_hadir' => Guest::where('status', 'Tidak Hadir')->count(),
            'menunggu' => Guest::where('status', 'Menunggu')->count(),
        ];

        $baseInvitationUrl = url('/undangan');
        $design = [];

        return view('dashboard.DaftarTamu', compact('guests', 'stats', 'baseInvitationUrl', 'design'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
        ]);

        Guest::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'status' => 'Menunggu',
            'opened' => false,
        ]);

        return redirect()->route('daftartamu')->with('success', 'Tamu berhasil ditambahkan!');
    }
};
