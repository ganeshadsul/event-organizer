<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'artist_id' ,'genre_id', 'venue_id', 'image', 'description', 'amount', 'event_on'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}