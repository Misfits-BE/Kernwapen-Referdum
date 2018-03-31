<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Article 
 * ---- 
 * Database model voor de nieuws berichten 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App
 */
class Article extends Model implements HasMedia
{
    use HasMediaTrait, HasSlug;

    /**
     * Mass-assign velden voor de database tabellen. 
     * 
     * @return array
     */
    protected $fillable = ['author_id', 'titel', 'is_public', 'bericht'];

    /**
     * De data relatie voor gegevens van de autheur. 
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * De configuratie voor het genereren van een slug. 
     *  
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('titel')
            ->saveSlugsTo('slug');
    }

    /**
     * Custom conversion for the article image. 
     * 
     * @param  Media $media The media instance default to null 
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(92)
              ->height(92)
              ->sharpen(20);
    }
}
