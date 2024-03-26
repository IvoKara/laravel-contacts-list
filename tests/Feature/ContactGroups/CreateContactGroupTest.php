<?php

namespace Tests\Feature\ContactGroups;

use App\Models\ContactGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateContactGroupTest extends TestCase
{
    use RefreshDatabase;
    use InvalidContactGroups;

    private function storeContactGroup(array $data)
    {
        return $this->post(route('contacts-groups.store'), $data);
    }

    public function test_create_one_contact_group_with_request(): void
    {
        $group_attributes = [
            'name' => 'My Family',
        ];

        $contact_group = ContactGroup::factory()->make($group_attributes);

        $response = $this->storeContactGroup($contact_group->toArray());

        $response->assertStatus(200);
        // $this->assertModelExists($contact_group);
        $this->assertDatabaseHas('contacts_groups', $group_attributes);

        $this->markTestIncomplete('should test w/ and w/out adding to group at create');
    }

    /**
     * @dataProvider invalidContactGroupsProvider
     */
    public function test_cannot_create_invalid_contact_group(array $invalid_attributes, array $validation_errors)
    {
        $contact_group = ContactGroup::factory()->make($invalid_attributes);

        $response = $this->storeContactGroup($contact_group->toArray());

        $response->assertInvalid($validation_errors);

        $this->markTestIncomplete('should implement logic related to group_id');
    }

    public function test_cannot_create_two_contact_groups_with_same_name()
    {
        $group_attributes = [
            'name' => 'My Family',
        ];

        ContactGroup::factory()->create($group_attributes);

        $this->assertDatabaseHas('contacts_groups', $group_attributes);

        foreach ($group_attributes as $attribute => $value) {
            $contact_group = ContactGroup::factory()->make([$attribute => $value]);

            $response = $this->storeContactGroup($contact_group->toArray());

            $response->assertInvalid([$attribute => 'already been taken']);
        }

        $this->markTestIncomplete('should implement logic for group_id');
    }

    // TEST: create with several contacts
    // TEST: create without contacts
}
