<?php

namespace Database\Seeders;

use App\Models\Hobby;
use \App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(100)
            ->create()
            ->each(function ($user) {
                Hobby::factory()->count(rand(1, 8))
                     ->create([
                         'user_id' => $user->id
                     ])->each(function ($hobby) {
                        $tagIds = range(1, 8);
                        shuffle($tagIds);
                        $bindings = array_slice($tagIds, 0, rand(0, 8));
                        foreach ($bindings as $binding) {
                            DB::table('hobby_tag')
                              ->insert([
                                  'hobby_id' => $hobby->id,
                                  'tag_id' => $binding,
                                  'created_at' => Now(),
                                  'updated_at' => Now()
                              ]);
                         }
                    });;
            });
    }
}
