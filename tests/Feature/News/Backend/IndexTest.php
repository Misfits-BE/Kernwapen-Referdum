<?php

namespace Tests\Feature\News\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Article;
use App\User;

/**
 * Class Indextest 
 * ---- 
 * PHPUnit testcase voor de index pagina van de beheers console. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\News\Backend
 */
class IndexTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox test of een niet aangemelde gebruiker de beheers console niet kan bekijken.
     * 
     * @group news
     */
    public function unauthenticated(): void 
    {
        factory(Article::class)->create();

        $this->get(route('admin.news.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox T§est of een aangemelde gebruiker de beheersconsole kan bekijken.
     * 
     * @group news
     */
    public function authenticated(): void 
    {
        factory(Article::class)->create(); 
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertStatus(200);
    }
}
