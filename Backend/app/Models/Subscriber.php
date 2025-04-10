<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'name', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class)
                    ->withTimestamps()
                    ->withPivot(['sent_at', 'opened_at', 'clicked_at']);
    }
}
