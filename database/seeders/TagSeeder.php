<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;


class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Sport' => 'primary',
            'Entspannung' => 'secondary',
            'Fun' => 'warning',
            'Inspiration' => 'success',
            'Freunde' => 'light',
            'Liebe' => 'info',
            'Interesse' => 'danger',
            'Natur' => 'dark',
        ];

        foreach ($tags as $k => $v) {
            $tag = new Tag(
                [
                    'name' => $k,
                    'style' => $v
                ]
            );
            $tag->save();
        }
    }
}
