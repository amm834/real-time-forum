<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Category::factory(5)->create();
        Question::factory(10)->create();
        // hasLikes is magic method
        Reply::factory(50)
            ->hasLikes(50)
            ->create();
    }
}
