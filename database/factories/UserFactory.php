<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    use HasFactory;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;


    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            echo "made user {$user->name}";
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'motto' => $this->faker->realText('30'),
            'ueber_mich' => $this->faker->realText(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
