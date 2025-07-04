<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    protected $fillable = ['komponens_id', 'user_id', 'status','alat_berat_id','status'];

    public function komponens()
    {
        return $this->belongsToMany(Komponen::class,'inspeksi_komponen','inspeksi_id', 'komponen_id')
        ->withPivot('status','komentar')
        ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function persetujuanInspeksi()
    {
        return $this->hasMany(PersetujuanInspeksi::class);
    }

    public function alatBerat()
    {
    return $this->belongsTo(AlatBerat::class);
    }
}
