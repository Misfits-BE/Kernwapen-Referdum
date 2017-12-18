<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    /**
     * Mass-assign velden voor de databank tabel.
     *
     * @var array
     */
    protected $fillable = ['voornaam', 'achternaam', 'geboortedatum', 'postcode', 'straatnaam', 'stadsnaam', 'huis_nr'];
}
