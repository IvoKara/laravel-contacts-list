<?php

namespace Tests\Feature\ContactGroups;

use App\Models\ContactGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowContactGroupsTest extends TestCase
{
    public function test_show_all_contacts_information(): void
    {
        $response = $this->get(route('contacts-groups.index'));

        $response->assertStatus(200);
    }

    public function test_show_newly_created_models()
    {
        $contact_group = ContactGroup::factory()->create();

        $response = $this->get(route('contacts-groups.show', $contact_group->id));

        $response->assertStatus(200);
    }

    /**
     * Check if update page exists
     */
    public function test_show_contact_edit_page(): void
    {
        $contact_group = ContactGroup::factory()->create();

        $response = $this->get(route('contacts-groups.edit', $contact_group->id));

        $response->assertStatus(200);
    }
    // TEST: all show and read routes
}
