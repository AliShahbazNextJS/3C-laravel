<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $albums = 'playlists';
    public $fillable = ['title', 'status', 'user_id'];
    // public $timestamps = false;

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_songs', 'playlist_id', 'song_id');
    }
    // public function songs()
    // {
    //     return $this->belongsToMany(Song::class);
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
