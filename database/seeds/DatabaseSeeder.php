<?php

use App\Answer;
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
        factory(App\User::class, 3)->create()->each(function($u){ // create random users
            $u->questions()
            ->saveMany(
                factory(App\Question::class, rand(1,5))->make() // create questions for each user
            )
            ->each(function($q){
                $q->answers()->saveMany(factory(App\Answer::class, rand(1,5))->make()); // create random answers for each question
            });
        });
        // $this->call(UsersTableSeeder::class);

    }
}
