<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $editors = User::where('role', 'editor')->get();

        foreach ($editors as $editor) {
            Post::factory(3)->create([
                'user_id' => $editor->id,
            ]);
        }
    }
}

