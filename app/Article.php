<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * ----
 * Database model voor de nieuwsberichten
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App
 */
class Article extends Model
{
    /**
     * Mass-assign velden voor de database table.
     */
    protected $fillable = ['name'];

    /**
     * Data relatie voor de gegevens van de autheur.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')
            ->withDefault(['name' => config('app.name')]);
    }
}
