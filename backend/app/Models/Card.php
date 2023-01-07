<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['column_id','title','description','status'];

    public function column()
    {
        return $this->belongsTo(Column::class);
    }
}
