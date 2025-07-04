<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatBerat extends Model
{
    protected $fillable = ['merk', 'serial_number','jenis', 'foto'];

    public function komponen()
    {
        return $this->hasMany(Komponen::class);
    }

    public function inspeksis()
{
    return $this->hasMany(Inspeksi::class);
}
}
