<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Databank model voor de handtekeningen in het systeem.
 *
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App
 */
class Signature extends Model
{
    /**
     * Mass-assign velden voor de databank tabel.
     *
     * @var array
     */
    protected $fillable = ['voornaam', 'achternaam', 'geboortedatum', 'postcode', 'straatnaam', 'stadsnaam', 'huis_nr'];

    /**
     * De velden die gemuteerd worden tot datums.
     *
     * @var array
     */
    protected $dates = ['geboortedatum', 'created_at', 'updated_at'];

    /**
     * Data relatie voor het koppelen van de handtekening aan de stad.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function city(): BelongsToMany
    {
        return $this->belongsToMany(City::class)->withTimestamps();
    }

    /**
     * Zorg ervoor dat de eerste letter van de voornaam altijd een hoofdletter is.
     *
     * @param  string $voornaam De gegeven voornaam in de gebruikersinvoer..
     * @return void
     */
    public function setVoornaamAttribute(string $voornaam): void
    {
        $this->attributes['voornaam'] = ucfirst($voornaam);
    }

    /**
     * Zorg ervoor dat de eerste letter van de achternaam altijd een hoofdletter is.
     *
     * @param  string $achternaam De gegeven achternaam in de gebruikersinvoer.
     * @return void
     */
    public function setAchternaamAttribute(string $achternaam): void
    {
        $this->attributes['achternaam'] = ucfirst($achternaam);
    }

    /**
     * Zorg ervoor dat de eerste letter van de stadsnaam altijd een hoofdletter is.
     *
     * @param  string $stadsnaam De gegeven stadsnaam in de gebruikersinvoer.
     * @return void
     */
    public function setStadsnaam(string $stadsnaam): void
    {
        $this->attributes['stadsnaam'] = ucfirst($stadsnaam);
    }

    /**
     * Zorg ervoor dat de eerste letter in de straatnaam altijd een hoofdletter is.
     *
     * @param  string $straatnaam De gegeven straatnaam in de gebruikers invoer.
     * @return void
     */
    public function setStraatnaam(string $straatnaam): void
    {
        $this->attributes['straatnaam'] = ucfirst($straatnaam);
    }
}
