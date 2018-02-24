<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Databank model voor de provincies
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App
 */
class Province extends Model
{
    /**
     * Mass-assign velden voor de databank tabel.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
