<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class EditProfile extends Component
{
    use WithFileUploads;

    public $name, $email;
    public $old_password, $password, $password_confirmation;
    public $foto;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'old_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user = Auth::user();

        // Validasi dan ubah password jika diisi
        if ($this->password) {
            if (!Hash::check($this->old_password, $user->password)) {
                $this->addError('old_password', 'Password lama salah.');
                return;
            }
            $user->password = Hash::make($this->password);
        }

        $user->name = $this->name;
        $user->email = $this->email;

        // Upload foto jika ada
        if ($this->foto) {
    // Hapus foto lama jika ada
    if ($user->foto && Storage::disk('public')->exists('users/' . $user->foto)) {
        Storage::disk('public')->delete('users/' . $user->foto);
    }

    // Upload foto baru
    $filename = $this->foto->hashName();
    $this->foto->store('users', 'public');
    $user->foto = $filename;
}



        /** @var \App\Models\User $user */

        $user->save();

        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}

