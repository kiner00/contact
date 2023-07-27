<?php

namespace Tests\Feature\Contact;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateContactTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /** @test */
    public function can_successfully_create_contact(): void
    {
        /**
         * GIVEN, WHEN, THEN
         */
        $name = $this->faker->name();
        $address = $this->faker->address();
        $mobileNumber = $this->faker->phoneNumber();
        $response = $this->postJson('/api/contacts', [
            'name' => $name,
            'mobile_number' => $mobileNumber,
            'address' => $address
        ]);

        $this->assertDatabaseHas('contacts', [
            'id' => 1,
            'name' => $name,
            'address' => $address,
            'mobile_number' => $mobileNumber
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'created',
                'message'
            ])
            ->assertJson([
                'created' => true,
                'message' => 'successfully created!'
            ]);
    }

    /** @test */
    public function name_is_missing(): void
    {
        $name = $this->faker->name();
        $address = $this->faker->address();
        $mobileNumber = $this->faker->phoneNumber();
        $response = $this->postJson('/api/contacts', [
            // 'name' => $name,
            'mobile_number' => $mobileNumber,
            'address' => $address
        ])->assertJsonValidationErrorFor('name')
        ->assertStatus(422);
    }

    /** @test */
    public function name_is_not_string(): void
    {
        // $name = $this->faker->name();
        $address = $this->faker->address();
        $mobileNumber = $this->faker->phoneNumber();
        $response = $this->postJson('/api/contacts', [
            'name' => [1,23,4],
            'mobile_number' => $mobileNumber,
            'address' => $address
        ])->assertJsonValidationErrorFor('name')
        ->assertStatus(422);
    }

    /** @test */
    public function name_is_above_255_characters(): void
    {
        $name = 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test 
        test test test test test test test test test test test test test test test test ';
        $address = $this->faker->address();
        $mobileNumber = $this->faker->phoneNumber();
        $response = $this->postJson('/api/contacts', [
            'name' => $name,
            'mobile_number' => $mobileNumber,
            'address' => $address
        ])->assertJsonValidationErrorFor('name')
        ->assertStatus(422);
    }

    /** @test */
    public function mobile_number_is_missing(): void
    {
        $name = $this->faker->name();
        $address = $this->faker->address();
        $mobileNumber = $this->faker->phoneNumber();
        $response = $this->postJson('/api/contacts', [
            'name' => $name,
            // 'mobile_number' => $mobileNumber,
            'address' => $address
        ])->assertJsonValidationErrorFor('mobile_number')
        ->assertStatus(422);
    }
}
