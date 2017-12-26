<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
