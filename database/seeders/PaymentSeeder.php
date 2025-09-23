<?php

namespace Database\Seeders;

use App\Models\Post;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          $posts = Post::all();

        foreach ($posts as $post) {
            Payment::factory()->create([
                'post_id' => $post->id,
                'user_id' => $post->user_id,
                'status' => $post->is_paid ? 'success' : 'pending',
            ]);
        }
    }
}
