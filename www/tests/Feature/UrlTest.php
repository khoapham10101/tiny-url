<?php

namespace Tests\Feature;

use App\Helper\Helpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Url;

class UrlTest extends TestCase
{
    /**
     * Anonymous can't access any url list.
     *
     * @return void
     */
    public function test_anonymous_can_not_access_their_url_list()
    {
        $response = $this->get('/user/urls');

        $response->assertStatus(302);

        $response->assertRedirect('/login');
    }

    public function test_users_can_access_their_url_list()
    {
        $this->post('/login', [
            'email' => 'khoapham10101@gmail.com',
            'password' => '12121212'
        ]);

        // Is authenticated?
        $this->assertAuthenticated();

        $response = $this->get('/user/urls');

        $response->assertSee('Your Urls List');
        $response->assertStatus(200);
    }

    public function test_user_can_create_shorten_url()
    {
        // Check creating a new user
        $url = Url::factory()->create();

        $this->assertNotNull($url);
        $this->assertIsString($url->short_url);
        $this->assertIsString($url->long_url);
        $this->assertEquals(Helpers::LENGTH, strlen($url->short_url));
    }

    public function test_validate_an_existing_shorten_url()
    {
        $this->assertTrue(Helpers::validate('XzdVA8i'));
    }

    public function test_user_can_use_this_shorten_url()
    {
        $this->assertFalse(Helpers::validate('XzdVA89'));
    }

    public function test_users_can_see_their_shorten_detail()
    {
        $this->post('/login', [
            'email' => 'khoa@abc.def',
            'password' => '12121212'
        ]);

        // Is authenticated?
        $this->assertAuthenticated();

        $response = $this->get('/user/urls/177');

        $response->assertSee('Url detail');
        $response->assertStatus(200);
    }
}
