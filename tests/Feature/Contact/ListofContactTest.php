<?php

namespace Tests\Feature\Contact;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListofContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_successfully_show_list_of_contacts(): void
    {
        $this->withExceptionHandling();
        $contact = Contact::factory()->count(5)->create();

        $response = $this->getJson('/api/contacts');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'name',
                        'mobile_number',
                        'address',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }
}
