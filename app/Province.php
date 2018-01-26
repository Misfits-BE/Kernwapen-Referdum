<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * Mass-assign velden voor de databank tabel.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
