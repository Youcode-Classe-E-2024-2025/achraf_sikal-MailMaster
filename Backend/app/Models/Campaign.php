<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'status', 'sent_at', 'newsletter_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class)
                    ->withTimestamps()
                    ->withPivot(['sent_at', 'opened_at', 'clicked_at']);
    }
}
