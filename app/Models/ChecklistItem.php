<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    protected $fillable = ['item_name', 'checklist_id', 'status'];
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
