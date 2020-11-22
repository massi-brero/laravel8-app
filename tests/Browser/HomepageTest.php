<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
class HomepageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @throws \Throwable
     */
    public function testHomePageBasic()
    {
        $this->assertEquals('local', env('APP_ENV'));
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Startseite');
        });
    }

    public function testLoginSuccesfull()
    {
        $password = '12345678';
        $user = User::factory()->create([
            'email' => 'a@b.de',
            'password' => bcrypt($password)
        ]);

        $this->browse(function ($browser) use ($user, $password) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', $password)
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }

    public function testLoginFail()
    {
        $password = '12345678';
        $user = User::factory()->create([
            'email' => 'a@b.de'
        ]);

        $this->browse(function ($browser) use ($user, $password) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', $password)
                    ->press('Login')
                    ->waitFor('.alert-danger', 0.2)
                    ->assertPathIs('/login');
        });
    }
}
