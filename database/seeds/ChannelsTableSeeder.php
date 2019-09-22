<?php

use App\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'laravel 6.2',
            'slug' => str_shuffle('laravel 6.2')
        ]);

        Channel::create([
            'name' => 'vue js 3',
            'slug' => str_shuffle('vue js 3')
        ]);

        Channel::create([
            'name' => 'angular 8',
            'slug' => str_shuffle('angular 8')
        ]);

        Channel::create([
            'name' => 'node js',
            'slug' => str_shuffle('node js')
        ]);
    }
}
