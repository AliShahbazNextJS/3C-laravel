<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\PlaylistSong;

class UniquePlaylistSong implements ValidationRule
{
    protected $playlistId;

    public function __construct($playlistId)
    {
        $this->playlistId = $playlistId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = PlaylistSong::where('playlist_id', $this->playlistId)
            ->where('song_id', $value)
            ->exists();

        if ($exists) {
            $fail('The selected song is already in the playlist.');
        }
    }
}
