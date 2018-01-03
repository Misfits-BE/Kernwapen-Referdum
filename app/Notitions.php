<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notitions extends Model
{
    /**
     * Mass-assign velden voor de databank tabel. 
     * 
     * @var array
     */
    protected $fillable = ['author_id', 'titel', 'status', 'beschrijving'];

    /**
     * Data relati voor de autheur. 
     * 
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
