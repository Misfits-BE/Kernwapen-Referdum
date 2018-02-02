<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Steden model voor de databank. 
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App
 */
class City extends Model
{   
    /**
     * Mass-assign velden voor de databnak tabel.
     *
     * @return array
     */
    protected $fillable = ['province_id', 'postal', 'name', 'lat', 'lng', 'kernwapen_vrij'];

    /**
     * De data relatie voor de provincie gegevens van de gemeente.
     *
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id')
            ->withDefault(['name' => 'Provincie onbekend.']);
    }

    /**
     * Haal de handtekeningen op van de gegeven stad.
     * 
     * @return \Illmûnate\Database\Eloquent\Relations\BelongsToMany
     */
    public function signatures(): BelongsToMany
    {
        return $this->belongsToMany(Signature::class)->withTimestamps();
    }

    /**
     * Data relatie voor de notities van de gegeven stad.
     *
     * @return HasMany
     */
    public function notitions(): HasMany
    {
        return $this->hasMany(Notitions::class);
    }
}
