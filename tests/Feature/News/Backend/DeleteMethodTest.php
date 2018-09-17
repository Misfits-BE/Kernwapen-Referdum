<?php

namespace Tests\Feature\News\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Article;
use App\User;

/**
 * Class DeletemethodTest 
 * ---- 
 * PHPUnit testcase voor het testen van de method die nieuwsberichten verwijderd. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Test\Feature\News\Backend
 */
class DeleteMethodTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een aangemelde gebruiker succesvol een nieuwsbericht kan verwijderen.
     */
    public function success(): void 
    {
        $article = factory(Article::class)->create(); 
        $user    = factory(User::class)->create(); 
        $dbCheck = ['id' => $article->id, 'slug' => $article->slug];

        $this->assertDatabasehas('articles', $dbCheck);

        $this->actingAs($user)
            ->get(route('admin.news.destroy', ['article' => $article->slug]))
            ->assertStatus(302)
            ->assertRedirect(route('admin.news.index'))
            ->assertSessionHas([
                $this->flashSession . '.message'   => 'Het nieuwsbericht ' . $article['titel'] . ' is verwijderd uit de applicatie', 
                $this->flashSession . '.level'     => 'info', 
                $this->flashSession . '.important' => true
            ]);

        $this->assertDatabaseMissing('articles', $dbCheck);
    }

    /**
     * @test
     * @testdox test de error response wanneer de gebruiker niet is aangemeld.
     */
    public function unauthenticated(): void 
    {
        $article = factory(Article::class)->create(); 

        $this->get(route('admin.news.destroy', ['slug' => $article->slug]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de error response wanneer we een nieuwsbericht verwijderen met ongeldige id. 
     */
    public function invalidId(): void 
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.news.destroy', ['slug' => 'article-slug']))
            ->assertStatus(404);
    }
}
