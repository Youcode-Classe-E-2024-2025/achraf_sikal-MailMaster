<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(),
            'status' => 'draft',
            'sent_at' => null,
            'user_id' => User::factory(),
            'newsletter_id' => Newsletter::factory(),
        ];
    }
}
