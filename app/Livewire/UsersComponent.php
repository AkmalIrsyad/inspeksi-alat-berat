<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class UsersComponent extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $addPage = false, $editPage = false;
    public $name, $email, $password, $role, $id, $foto;
    public $search = '';

    public function render()
    {
        $data['user'] = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate(5);

        return view('livewire.users-component', $data);
    }

    public function create()
    {
        $this->reset();
        $this->addPage = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
            'foto' => 'required|image',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email salah',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password tidak boleh kosong',
            'role.required' => 'Role tidak boleh kosong',
            'foto.required' => 'Foto tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
        ]);

        $this->foto->storeAs('users', $this->foto->hashName(), 'public');

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'foto' => $this->foto->hashName()
        ]);

        session()->flash('success', 'Berhasil Simpan Data');
        $this->reset();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->foto && file_exists(public_path('storage/users/' . $user->foto))) {
            unlink(public_path('storage/users/' . $user->foto));
        }
        $user->delete();
        session()->flash('success', 'Berhasil Hapus Data');
        $this->reset();
    }

    public function edit($id)
    {
        $this->reset();
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->id = $user->id;
        $this->editPage = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'role' => 'required',
            'foto' => 'nullable|image',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email salah',
            'email.unique' => 'Email sudah digunakan oleh user lain',
            'role.required' => 'Role tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
        ]);

        $user = User::findOrFail($this->id);

        if ($this->foto) {
            if ($user->foto && file_exists(public_path('storage/users/' . $user->foto))) {
                unlink(public_path('storage/users/' . $user->foto));
            }
            $this->foto->storeAs('users', $this->foto->hashName(), 'public');
            $user->foto = $this->foto->hashName();
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'foto' => $user->foto,
        ]);

        session()->flash('success', 'Berhasil Ubah Data!');
        $this->reset();
    }
}
