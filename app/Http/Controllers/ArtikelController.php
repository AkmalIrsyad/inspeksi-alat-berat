<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::latest()->paginate(10);
        return view('supervisor.artikels.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supervisor.artikels.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif'
    ]);

    $path = null;
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('artikel', 'public');
    }

    Artikel::create([
        'judul' => $request->judul,
        'konten' => $request->konten,
        'foto' => $path
    ]);

    return redirect()->route('artikels.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('supervisor.artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        return view('supervisor.artikels.form', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif'
    ]);

    if ($request->hasFile('foto')) {
        if ($artikel->foto) {
            Storage::disk('public')->delete($artikel->foto);
        }
        $artikel->foto = $request->file('foto')->store('artikel', 'public');
    }

    $artikel->update([
        'judul' => $request->judul,
        'konten' => $request->konten,
        'foto' => $artikel->foto
    ]);

    return redirect()->route('artikels.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
         if($artikel->foto) {
            Storage::disk('public')->delete($artikel->foto);
        }
        $artikel->delete();
        return redirect()->route('artikels.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
