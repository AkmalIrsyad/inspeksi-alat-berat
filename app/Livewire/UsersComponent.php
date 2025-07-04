<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use PhpParser\Node\Expr\FuncCall;

class UsersComponent extends Component
{
    use WithPagination,WithoutUrlPagination,WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $addPage,$editPage =false;
    public $name,$email,$password,$role,$id,$foto;
    public function render()
    {
        $data['user']= User::paginate(2);
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
            'name'=>'required',
            'email'=> 'required|email',
            'password'=>'required',
            'role'=>'required',
            'foto'=>'required|image',
        ],[
            'name.required'=>'nama Tidak boleh Kosong',
            'email.required'=>'email Tidak boleh kosong',
            'email.email'=>'Format email salah',
            'password.required'=>'Password Tidak Boleh Kosong',
            'role.required'=>'role tidak boleh kosong',
            'foto.required'=>'foto tidak boleh kosong',
            'foto.image'=>'foto dalam format image',
        ]);

         $this->foto->storeAs('users', $this->foto->hashName(),'public');
        User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'role'=>$this->role,
            'foto'=>$this->foto->hashName()
        ]);
        session()->flash('success', 'Berhasi Simpan Data');
        $this->reset();
    }
    public function destroy($id){
        // $cari=User::find($id);
        // $cari->delete();
        $users = User::find($id);
        unlink(public_path('storage/users/'.$users->foto));
        $users->delete();
        session()->flash('success','Berhasil Hapus Data');
        $this->reset();
    }
    public function edit($id)
    {
        $this->reset();
        $users=User::find($id);
        $this->name = $users->name;
        $this->email = $users->email;
        $this->role = $users->role;
        $this->id = $users->id;
        $this->editPage = true;
    }
    public function update()
    {
        $users = User::find($this->id);
        if (empty($this->foto)) {
            $users->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'role'=>$this->role,
            ]);
        }else{
            unlink(public_path('storage/users/' . $users->foto));
            $this->foto->storeAs('users', $this->foto->hashName(),'public');
            $users->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'role'=> $this->role,
                'foto' => $this->foto->hashName()
            ]);
        }
        // if ($this->password=="") {
        //     $cari->update([
        //         'name'=>$this->name,
        //         'email'=>$this->email,
        //         'role' =>$this->role
        //     ]);
        // }else{
        //     $cari->update([
        //         'name'=>$this->name,
        //         'email'=>$this->email,
        //         'password'=>Hash::make($this->password),
        //         'role' =>$this->role
        //     ]);
        // }
        session()->flash('success','Berhasil Ubah Data!');
        $this->reset();
    }
}
