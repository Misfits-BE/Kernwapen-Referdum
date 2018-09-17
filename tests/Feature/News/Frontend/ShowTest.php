<?php

namespace Tests\Feature\News\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Article;

/**
 * Class ShowTest 
 * ---- 
 * PHPUnit estcase voor het testing van de specifieke weergave van een nieuwsbericht. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\News\Frontend
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test 
     * @testdox Test of een gast gebruiker een nieuws bericht kan bekijken zonder problemen.  
     * 
     * @group news
     */
    public function success(): void 
    {   
        $article = factory(Article::class)->create(); 
        $this->get(route('news.show', ['slug' => $article->slug]))->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test de error response wanneer een ongeldige slug word gegeven. 
     * 
     * @group news
     */
    public function invalidSlug(): void 
    {
        $this->get(route('news.show', ['slug' => 'slug-form-article']))->assertStatus(404);
    }
}
