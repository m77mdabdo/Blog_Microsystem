<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
               'post_id' => Post::factory(),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['pending','success','failed']),
            'transaction_id' => $this->faker->uuid(),
            'amount' => $this->faker->randomFloat(2, 5, 100),
            
        ];
    }
}
