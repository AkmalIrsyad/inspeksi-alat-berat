<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'foto' => 'required|image',
        ],
        [
            'name.required'=>'Nama Tidak Boleh Kosong',
            'email.required'=>'Email Tidak Boleh Kosong',
            'email.email' => 'Format email Tidak Benar',
            'password.required'=>'Password Tidak Boleh Kosong',
            'foto.required' => 'Foto tidak boleh kosong',
            'foto.image' => 'Foto harus dalam format gambar',
        ]);

           // Upload foto ke folder storage/app/public/users
        $request->file('foto')->storeAs( 'users',$request->file('foto')->hashName(),'public');

        // Simpan user
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'foto' => $request->file('foto')->hashName(), // hanya simpan nama file-nya
        ]);
        session()->flash('success','Berhasil didaftarkan');
        return redirect()->route('register');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
