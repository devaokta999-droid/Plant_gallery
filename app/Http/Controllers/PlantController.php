<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlantController extends Controller
{
    // Menampilkan daftar tanaman (dengan search & pagination)
    public function index(Request $request)
    {
        $search = $request->get('search');
        $plants = Plant::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('plants.index', compact('plants', 'search'));
    }

    // Tampilkan form create
    public function create()
    {
        return view('plants.create');
    }

    // Simpan tanaman baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // nama unik: timestamp_random.extension
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['image'] = $filename;
        }

        Plant::create($validated);

        return redirect()->route('plants.index')->with('success', 'Tanaman Berhasil Ditambah!');
    }

    // Tampilkan form edit
    public function edit(Plant $plant)
    {
        return view('plants.edit', compact('plant'));
    }

    // Update tanaman
    public function update(Request $request, Plant $plant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // hapus file lama jika ada
            if ($plant->image && file_exists(public_path('images/' . $plant->image))) {
                @unlink(public_path('images/' . $plant->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['image'] = $filename;
        }

        $plant->update($validated);

        return redirect()->route('plants.index')->with('success', 'Tanaman Berhasil Diperbahrui!');
    }

    // Hapus tanaman
    public function destroy(Plant $plant)
    {
        if ($plant->image && file_exists(public_path('images/' . $plant->image))) {
            @unlink(public_path('images/' . $plant->image));
        }

        $plant->delete();

        return redirect()->route('plants.index')->with('success', 'Tanaman Berhasil Dihapus!');
    }
}
