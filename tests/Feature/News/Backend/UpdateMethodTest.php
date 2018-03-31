<?php

namespace Tests\Feature\News\Backend;

use Tests\TestCase;
use App\User;
use App\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class Up-dateMethodTest 
 * ----
 * 
 * @author 
 * @copyright
 * @package
 */
class UpdateMethodTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * @testdox Test of een aangemelde gebruiker zonder problemen een nieuwsbericht kan wijzigen. 
     */
    public function successAuthenticated(): void 
    { 
        $user    = factory(User::class)->create(); 
        $article = factory(Article::class)->create(); 
        $faker   = $this->faker($this->locale);
        $input   = ['titel' => $faker->word, 'bericht' => $faker->paragraph, 'is_public' => $faker->boolean];

        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertStatus(302)
            ->assertRedirect(route('admin.news.index'))
            ->assertSessionHas([
                $this->flashSession . '.message'   => 'Het nieuwsbericht ' . $input['titel'] . ' is gewijzigd.',
                $this->flashSession . '.level'     => 'success',
                $this->flashSession . '.important' => false
            ]);

        $this->assertDatabaseMissing('articles', ['titel' => $article->titel, "bericht" => $article->bericht, 'is_public' => $article->is_public]); 
        $this->assertDatabaseHas('articles', $input);
    }

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker geen nieuwsbericht kan wijzigen. 
     */
    public function unauthenticated(): void
    {
        $article = factory(Article::class)->create();
        $faker   = $this->faker($this->locale); 
        $input   = ['titel' => $faker->word, 'bericht' => $faker->paragraph, 'is_public' => $faker->boolean];

        $this->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test de HTTP response code wanneer men een artikel met ongeldige id wilt wijzigen
     */
    public function invalidId(): void 
    {
        $user    = factory(User::class)->create(); 
        $article = factory(Article::class)->create(); 
        $faker   = $this->faker($this->locale);
        $input   = ['titel' => $faker->word, 'bericht' => $faker->paragraph, 'is_public' => $faker->boolean];

        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => 'article-slug']), $input)
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox test de validatie regel dat een status vereist is. 
     */
    public function validationIsPublicRequired(): void 
    {
        $user    = factory(User::class)->create(); 
        $article = factory(Article::class)->create();
        $faker   = $this->faker($this->locale);
        $input   = ['titel' => $faker->word, 'bericht' => $faker->paragraph]; 

        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertSessionHasErrors(['is_public' => 'U moet een status opgeven voor het nieuwsbericht.']);
    } 

    /**
     * @test 
     * @testdox Validatie regel om te zeggen dat het status veld alleen een boolean waarde mag bevatten. 
     */
    public function validationIsPublicBoolean(): void 
    {
        $user    = factory(User::class)->create(); 
        $article = factory(Article::class)->create();
        $faker   = $this->faker($this->locale);
        $input   = ['titel' => $faker->word, 'bericht' => $faker->paragraph, 'is_public' => $faker->word];
        
        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertSessionHasErrors(['is_public' => 'Kan alleen de waarde klad of publicatie bevatten.']);
    }

    /**
     * @test 
     * @testdox Validatie regel om te checken of de content van een nieuwsbericht vereist is. 
     */
    public function validationBerichtRequired(): void 
    {
        $user    = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $faker   = $this->faker($this->locale); 
        $input   = ['titel' => $faker->word, 'is_public' => $faker->boolean];

        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertSessionHasErrors(['bericht' => trans('validation.required', ['attribute' => 'bericht'])]);
    }

    /**
     * @test 
     * @testdox Validatie regel test om te checken of de content van een nieuwsbericht alleen een tekenreeks kan zijn.
     */
    public function validationBerichtString(): void 
    {
        $user    = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $faker   = $this->faker($this->locale);
        $input   = ['titel' => $faker->word, 'is_public' => $faker->boolean, 'bericht' => rand(0, 50)];

        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertSessionHasErrors(['bericht' => trans('validation.string', ['attribute' => 'bericht'])]);
    }

    /**
     * @test
     * @testdox validatie regel test om te checken of een titel van een nieuwsbericht vereist is. 
     */
    public function validationTitelRequired(): void 
    {
        $user    = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $faker   = $this->faker($this->locale);
        $input   = ['is_public' => $faker->boolean, 'bericht' => $faker->paragraph];

        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertSessionHasErrors(['titel' => trans('validation.required', ['attribute' => 'titel'])]);  
    }

    /**
     * @test
     * @testdox Validatie regel test om te checken of een titel maar max 190 karakters mag bevatten.
     */
    public function validationTitelMax190(): void 
    {
        $user    = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $faker   = $this->faker($this->locale);
        $input   = ['titel' => str_random(255), 'is_public' => $faker->boolean, 'bericht' => $faker->paragraph];

        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertSessionHasErrors(['titel' => trans('validation.max.string', ['max' => 190, 'attribute' => 'titel'])]);
    }
    
    /**
     * @test 
     * @testdox Validatie regel om te checken of de titel van een nieuwsbericht alleen maar een tekenreeks mag zijn. 
     */
    public function validationTitelString(): void 
    {
        $user    = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $faker   = $this->faker($this->locale);
        $input   = ['titel' => rand(0, 250), 'is_public' => $faker->boolean, 'bericht' => $faker->paragraph];

        $this->actingAs($user)
            ->patch(route('admin.news.update', ['slug' => $article->slug]), $input)
            ->assertSessionHasErrors(['titel' => trans('validation.string', ['attribute' => 'titel'])]);
    }
}
