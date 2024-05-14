<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlaylistSong extends Pivot
{
    protected $table = 'playlist_songs';
    protected $fillable = ['playlist_id', 'song_id', 'playlist_order_by'];
}
