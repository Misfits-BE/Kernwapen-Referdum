<?php

namespace Tests\Feature\News\Backend;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CreateTest 
 * ---- 
 * PHPUnit testcase voor de crreatie weergave van een nieuwsbericht. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten 
 * @package     Tests\Feature\News\Backend
 */
class CreateTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox Test of een aangemelde gebruiker de creatie pagiàna kan bekijken.
     * 
     * @group news
     */
    public function authencated(): void 
    {
        $user = factory(User::class)->create(); 
        
        $this->actingAs($user)
            ->get(route('admin.news.create'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker de creatie pagàina niet kan weergeven
     * 
     * @group news
     */
    public function unauthenticated(): void 
    {
        $this->get(route('admin.news.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
