<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Databank model voor de ondersteunende organisaties.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App
 */
class Support extends Model
{
    /**
     * Mass-assign fields voor de databank tabel.
     *
     * @return array
     */
    protected $fillable = ['name', 'link', 'telefoon_nr', 'verantwoordelijke_naam', 'verantwoordelijke_email'];
}
