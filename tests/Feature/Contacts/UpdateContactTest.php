<?php

namespace Tests\Feature\Contacts;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateContactTest extends TestCase
{
    use InvalidContacts;
    use RefreshDatabase;

    private function updateContact(Contact|int $contact, array $data, string $method = "PATCH")
    {
        $id = is_int($contact) ? $contact : $contact->id;

        if ($method === "PATCH")
            return $this->patch(route('contacts.update', $id), $data);
        else if ($method === "PUT")
            return $this->put(route('contacts.update', $id), $data);
    }

    /**
     * @dataProvider invalidContactsProvider
     */
    public function test_cannot_update_invalid_contact(array $invalid_attributes, array $validation_errors)
    {
        $contact = Contact::factory()->create();

        $response = $this->updateContact($contact->id, $invalid_attributes);

        $response->assertInvalid(array_keys($invalid_attributes));

        $this->markTestIncomplete('should implement logic related to group_id');
    }

    // unique attributes
    public function test_cannot_update_contact_to_duplicate_other()
    {
        /** @var Contact */
        [$contact, $other] = Contact::factory(2)->create();

        foreach (['nickname', 'email', 'phone'] as $attribute) {

            $response = $this->updateContact($contact->id, [$attribute => $other[$attribute]]);

            $response->assertInvalid([$attribute => 'already been taken']);
        }

        $this->markTestIncomplete('should implement logic for group_id');
    }

    // can be saved with same information
    /**
     * @group failing
     */
    public function test_can_update_contact_with_same_information()
    {
        $contact_attributes = [
            'nickname' => 'johndoe',
            'email' => 'johndoe@gmail.com',
            'phone' => '0898000000'
        ];

        $contact = Contact::factory()->create($contact_attributes);
        $this->assertModelExists($contact);

        foreach ($contact_attributes as $attribute => $value) {

            $response = $this->updateContact($contact->id, [$attribute => $value]);

            $response->assertValid([$attribute]);
        }

        $this->markTestIncomplete('should implement logic for group_id');
    }

    // check validations on patch
    // check required on put
}
