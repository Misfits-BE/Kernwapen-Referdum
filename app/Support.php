<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    /**
     * Mass-assign fields voor de databank tabel.
     *
     * @return array
     */
    protected $fillable = ['name', 'link', 'telefoon_nr', 'verantwoordelijke_naam', 'verantwoordelijke_email'];
}
