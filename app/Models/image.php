<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [ 
        'name',
        'album_id',
        'slug',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
