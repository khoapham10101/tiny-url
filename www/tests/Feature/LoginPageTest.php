<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login_using_login_form()
    {

       // Check user login
        // Can't work with current user, must fix the email+pass
       $response = $this->post('/login', [
//           'email' => $user->email,
           'email' => 'khoa@abc.def',
           'password' => '12121212'
       ]);

       // Is authenticated?
       $this->assertAuthenticated();

       // After login, is it redirected to homepage?
       $response->assertRedirect('/');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_not_access_admin_page()
    {
        // Check user login
        // Can't work with current user, must fix the email+pass
        $response = $this->post('/login', [
            'email' => 'xazijycul@mailinator.com', // => normal user
            'password' => 'password',
        ]);

        $response = $this->get('/admin/users');

        $response->assertStatus(500);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_access_admin_page()
    {
        // Check user login
        // Can't work with current user, must fix the email+pass
        $this->post('/login',
        [
            'email' => 'khoa@abc.def', // => admin user
            'password' => '12121212'
        ]);

        $response = $this->get('/admin/users');
        $response->assertSee('User');
        $response->assertStatus(200);
    }
}
