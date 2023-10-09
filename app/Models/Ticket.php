<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'priority',
        'details',
        'awaited_from',
        'category_id',
        'user_id',
        'agent_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'id', 'agent_id');
    }

    public function images()
    {
        return $this->hasMany(TicketImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
