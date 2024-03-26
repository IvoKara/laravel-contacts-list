<?php

namespace Database\Factories;

use App\Models\ContactGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        $minThreeChars = fn ($word) => strlen($word) >= 3;

        return [
            'name' => $faker->name(),
            'nickname' => $faker->valid($minThreeChars)->word(),
            'phone' => $faker->phoneNumber(),
            'email' => $faker->email(),
        ];
    }
}
