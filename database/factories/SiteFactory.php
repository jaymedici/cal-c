<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SiteFactory extends Factory
{
    protected $model = Site::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site_name' => Str::title($this->faker->word()),
            'district' => 'Mbeya',
            'region' => 'Mbeya',
            'country' => 'Tanzania',
            'updated_by' => $this->faker->userName(),
        ];
    }
}
