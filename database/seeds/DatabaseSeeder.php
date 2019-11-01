<?php

use Domain\Course\Course;
use Domain\Exercise\Language;
use Domain\User\User;
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
        // $this->call(UsersTableSeeder::class);
        factory(User::class)->create();

        $course = Course::create([
            'title' => 'PHP Basics',
            'name' => 'PHP Basics',
            'description' => 'Lorem ipsum',
            'description_short' => 'Lorem ipsum',
            'image' => 'https://some image',
            'user_id' => 1,
        ]);
        $section = $course->sections()->create([
            'title' => 'H W',
            'user_id' => 1,
        ]);
        $lesson = $section->lessons()->create([
            'name' => '2222',
            'body' => '### some text \n another text',
        ]);
        Language::insert([
            'folder' => 'exercises-php',
            'slug' => 'php',
            'title' => 'PHP',
        ]);
        $exercise = $lesson->exercises()->create([
            'title' => 'H W task',
            'slug' => 'hello',
            'body' => 'Some long text, ## Markdown too',
            'language_id' => 1,
            'user_id' => 1,
        ]);
    }
}
