<?php

namespace Tests\Feature;

use App\Models\Hobby;
use App\Models\User;
use Carbon\Carbon;
use HobbyTest;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseTest extends TestCase
{

    use RefreshDatabase;

    public function testNewUserNotInDB()
    {
        $this->assertEquals('testing', env('APP_ENV'));
        $this->assertDatabaseMissing(
            'users',
            ['email' => 'a@b.de']
        );
    }

    public function testCreateAndStoreUser()
    {
        User::factory()->create([
            'email' => 'a@b.de'
        ]);

        $this->assertDatabaseHas(
            'users',
            ['email' => 'a@b.de']
        );
    }

    public function testCreatedUsersWithSpecifiedAttributeValue()
    {
        User::factory()->count(10)
            ->state(new Sequence(
                ['motto' => 'motto'],
                ['motto' => '']))
            ->create();

        $this->assertEquals(
            5,
            User::where('motto', 'motto')->count()
        );
    }

    public function testUserHobbyHasManyRelationship()
    {
//        $user = User::factory()->has(Hobby::factory()->count(3), 'hobbies')
//                               ->create();

        $user = User::factory()->hasHobbies(3, [
            'created_at' => Carbon::tomorrow()
        ])
                               ->create();

        $this->assertEquals(
            3,
            User::where('id', $user->id)->first()->hobbies()->count()
        );
    }

    public function testHobbyHasManyUsersRelationship()
    {
        $user = user::factory()->create();
        $hobbies = Hobby::factory()->count(3)
                                   ->for(user::factory())
                                   ->create();

        $this->assertEquals(
            3,
            Hobby::where('user_id', $hobbies->first()->user->id)->count()
        );
    }
}
