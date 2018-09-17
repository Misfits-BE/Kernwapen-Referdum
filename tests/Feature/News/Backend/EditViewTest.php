<?php

namespace Tests\Feature\News\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\{User, Article};

/**
 * Class EditViewTest 
 * ---- 
 * PHPUnit testcase voor de weergave omtrent het wijzigen van een nieuwsbericht
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\News\Backend
 */
class EditViewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een gaautneceerde gebruiker de weergave kan bekijken
     */
    public function authenticated(): void 
    {
        $user    = factory(User::class)->create();  
        $article = factory(Article::class)->create();

        $this->actingAs($user)
            ->get(route('admin.news.edit', ['slug' => $article->slug]))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker de weergave niet kan bekijken. 
     */
    public function unAuthenticated(): void 
    {
        $article = factory(Article::class)->create(); 

        $this->get(route('admin.news.edit', ['slug' => $article->slug]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de error response wanneer de unieke identificatie niet word gevonden in de databank. 
     */
    public function invalidId(): void 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->get(route('admin.news.edit', ['slug' => 'article-slug']))
            ->assertStatus(404);
    }
}
