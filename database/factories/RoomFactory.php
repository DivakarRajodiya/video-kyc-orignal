<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'agent' => $this->faker->word,
        'visitor' => $this->faker->word,
        'agenturl' => $this->faker->word,
        'visitorurl' => $this->faker->word,
        'password' => $this->faker->word,
        'roomId' => $this->faker->word,
        'datetime' => $this->faker->word,
        'duration' => $this->faker->word,
        'shortagenturl' => $this->faker->word,
        'shortvisitorurl' => $this->faker->word,
        'agent_id' => $this->faker->word,
        'is_active' => $this->faker->word,
        'agenturl_broadcast' => $this->faker->word,
        'visitorurl_broadcast' => $this->faker->word,
        'shortagenturl_broadcast' => $this->faker->word,
        'shortvisitorurl_broadcast' => $this->faker->word,
        'title' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
