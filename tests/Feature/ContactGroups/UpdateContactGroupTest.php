<?php

namespace Tests\Feature\ContactGroups;

use App\Models\ContactGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateContactGroupTest extends TestCase
{
    use InvalidContactGroups;
    use RefreshDatabase;

    private function updateContactGroup(ContactGroup|int $group, array $data, string $method = "PATCH")
    {
        $id = is_int($group) ? $group : $group->id;

        if ($method === "PATCH")
            return $this->patch(route('contacts-groups.update', $id), $data);
        else if ($method === "PUT")
            return $this->put(route('contacts-groups.update', $id), $data);
    }

    /**
     * Cannot update with invalid data
     * @dataProvider invalidContactGroupsProvider
     */
    public function test_cannot_update_invalid_contact_group(array $invalid_attributes, array $validation_errors)
    {
        $contact_group = ContactGroup::factory()->create();

        $response = $this->updateContactGroup($contact_group->id, $invalid_attributes);

        $response->assertInvalid($validation_errors);

        $this->markTestIncomplete('should implement logic related to group_id');
    }

    /**
     * Cannot have two groups with the same name
     */
    public function test_cannot_update_contact_group_to_have_duplicating_name()
    {
        /** @var ContactGroup */
        [$group, $other] = ContactGroup::factory(2)->create();

        $response = $this->updateContactGroup($group->id, ['name' => $other['name']]);

        $response->assertInvalid(['name' => 'already been taken']);
    }

    /**
     * Can be updated with same information
     */
    public function test_can_update_contact_group_with_same_information()
    {
        $contact_attributes = [
            'name' => 'My Family',
        ];

        $contact_group = ContactGroup::factory()->create($contact_attributes);
        $this->assertModelExists($contact_group);

        foreach ($contact_attributes as $attribute => $value) {

            $response = $this->updateContactGroup($contact_group->id, [$attribute => $value]);

            $response->assertValid([$attribute]);
        }

        $this->markTestIncomplete('should implement logic for group_id');
    }

    // TEST: update only group name
    // TEST: add a contact to group
    // TEST: add several contacts to group
    // TEST: remove contact from group
    // TEST: remove several contacts from group
    // TEST: cannot add one contact two times in one group
    // TEST: cannot remove one contact two times
}
