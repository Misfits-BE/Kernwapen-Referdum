<?php

namespace Tests\Feature\News\Backend;

use App\Article;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class SearchTest 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\News\Backend
 */
class SearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker niet kan zoeken tussen de artikelen. 
     */
    public function unauthenticated(): void 
    {
        $articles = factory(Article::class, 20)->create(); 
        
        $this->get(route('admin.news.index', ['term' => $articles[0]->titel]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test of een aangemelde gebruiker kan zoeken tussen de nieuwsberichten
     */
    public function authenticated(): void 
    {
        $user     = factory(User::class)->create();
        $articles = factory(Article::class, 20)->create();

        $this->actingAs($user)
            ->get(route('admin.news.index', ['term' => $articles[0]->titel]))
            ->assertStatus(200);
    }
}
