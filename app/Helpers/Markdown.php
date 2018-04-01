<?php 

use GrahamCampbell\Markdown\Facades\Markdown;

/**
 * Convert the database content from Markdown to HTML
 * 
 * @param  string $text The data from the database that needs to be converted
 * @return string
 */
function markdown(string $text): string 
{
    return Markdown::convertToHtml($text);
}