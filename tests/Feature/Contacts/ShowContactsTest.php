<?php

namespace Tests\Feature\Contacts;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowContactsTest extends TestCase
{
    public function test_show_all_contacts_information(): void
    {
        $response = $this->get(route('contacts.index'));

        $response->assertStatus(200);
    }

    public function test_show_newly_created_models()
    {
        $contact = Contact::factory()->create();

        $response = $this->get(route('contacts.show', $contact->id));

        $response->assertStatus(200);
    }

    /**
     * Check if update page exists
     */
    public function test_show_contact_edit_page(): void
    {
        $contact = Contact::factory()->create();

        $response = $this->get(route('contacts.edit', $contact->id));

        $response->assertStatus(200);
    }
    // TODO: all show and read routes
}
