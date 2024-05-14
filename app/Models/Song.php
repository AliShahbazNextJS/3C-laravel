<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    public $fillable = ['title', 'status', 'user_id', 'album', 'generous', 'artist', 'favorite', 'lyrics', 'order_by', 'font_size', 'font_color', 'scroll_speed', 'background_color'];
    // public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_songs', 'song_id', 'playlist_id');
    }
    public function recentPlayed()
    {
        return $this->hasOne(RecentlyPlayed ::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($song) {
            $song->playlists()->detach();
            $song->recentPlayed()->delete();
        });
    }
    // public function playlists()
    // {
    //     return $this->belongsToMany(Playlist::class);
    // }
}
