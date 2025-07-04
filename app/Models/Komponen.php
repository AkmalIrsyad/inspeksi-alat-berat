<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory;
    protected $fillable = ['id','name', 'alat_berats_id'];

        // Relasi: Komponen milik AlatBerat
        public function alatBerat()
        {
            return $this->belongsTo(AlatBerat::class,'alat_berats_id');
        }

        public function inspeksis()
        {
            return $this->belongsToMany(Inspeksi::class, 'inspeksi_komponen', 'komponens_id', 'inspeksi_id')
            ->withPivot('status','komentar')
            ->withTimestamps();
        }
}
