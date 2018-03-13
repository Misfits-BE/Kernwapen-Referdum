<?php 

use Jenssegers\Date\Date;

/**
 * @param  string $date De datum instantie dat omgezet moet worden naar een diffForHumans
 * @return string 
 */
function readableDifference(string $date): string
{
    Date::setLocale(config('app.locale'));
    $date = new Date($date);
    
    return $date->diffForHumans();
}