<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
     * Zorg ervoor dat de eerste letter van de voornaam altijd een hoofdletter is.
     *
     * @param  string $voornaam De gegeven voornaam in de invoer van de gebruiker.
     * @return void
     */
    public function setVoornaamAttribute(string $voornaam): void
    {
        $this->attributes['voornaam'] = ucfirst($voornaam);
    }

    /**
     * Zorg ervoor dat de eerste letter van de achternaam altijd een hoofdletter is.
     *
     * @param  string $achternaam De gegeven achternaam in de invoer van de gebruiker.
     * @return void
     */
    public function setAchternaamAttribute(string $achternaam): void
    {
        $this->attributes['achternaam'] = ucfirst($achternaam);
    }

    public function setStadsnaam(): void
    {
        //
    }

    public function setStraatnaam(): void
    {
        //
    }
}
