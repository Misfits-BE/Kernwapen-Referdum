<?php

namespace Tests\Feature\Notifications;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\DatabaseNotification;

/**
 * Class IndexViewTest
 * ----
 * PHPUnit testsuite voor de notification index weergave
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Notifications
 */
class IndexViewTest extends TestCase
{
    /**
     * @test
     * @testdox test de HTTP/1 code en doorverwijzing.
     */
    public function nietAangemeld(): void
    {
        $this->get(route('notifications.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test dat de gebruiker de notificatie weergave kan bekijken wanneer geen notificaties gevonden zijn.
     */
    public function indexGeenNotificaties(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('notifications.index'))
            ->assertStatus(200);
    }
}
