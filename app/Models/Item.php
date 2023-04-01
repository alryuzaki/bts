<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Checklist;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'item_name',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_id');
    }
}
