<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Support extends Model
{
    /**
     * Mass-assign fields voor de databank tabel. 
     * 
     * @return array
     */
    protected $fillable = [];

    /**
     * Databank relatie voor de contact personen van de organisatie.
     * 
     * @return BelongsToMany 
     */
    public function contact(): BelongsToMany
    {
        return $this->belongsToMany(Contacts::class)->withTimestamps();
    }
}
