<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vendor_id' => \App\Models\Vendor::factory(),
            'invoice_number' => fake()->regexify('[A-Z]{3}[0-4]{5}'),
            'amount_due' => fake()->randomFloat(2),
            'invoice_date' => fake()->dateTimeInInterval('-3 months', '-1 month'),
            'date_due' => fake()->dateTimeInInterval('+1 month', '+2 months'),
            'status' => fake()->randomElement(['A', 'O', 'P','R'])
        ];
    }
}
