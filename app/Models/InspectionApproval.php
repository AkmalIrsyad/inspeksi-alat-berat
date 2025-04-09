<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionApproval extends Model
{
    protected $fillable = ['inspection_id', 'supervisor_id', 'status', 'notes'];

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
