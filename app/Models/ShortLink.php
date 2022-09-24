<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;

    protected $table = 'short_links';

    protected $fillable = [
        'user_id',
        'shorten_link',
        'link',
        'expire_date'
    ];

    // Relation One to Many (User can create many shorten URL)
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
