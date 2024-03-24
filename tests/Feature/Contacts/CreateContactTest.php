<?php

namespace Tests\Feature\Contacts;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateContactTest extends TestCase
{
    use RefreshDatabase;
    use InvalidContacts;

    private function storeContact(array $data)
    {
        return $this->postJson(route('contacts.store'), $data);
    }

    public function test_create_one_contact_with_request(): void
    {
        $contact_attributes = [
            'nickname' => 'johndoe',
            'email' => 'johndoe@gmail.com'
        ];

        $contact = Contact::factory()->make($contact_attributes);

        $response = $this->storeContact($contact->toArray());

        $response->assertStatus(200);
        // $this->assertModelExists($contact);
        $this->assertDatabaseHas('contacts', $contact_attributes);

        $this->markTestIncomplete('should test w/ and w/out adding to group at create');
    }

    /**
     * @dataProvider invalidContactsProvider
     */
    public function test_cannot_create_invalid_contact(array $invalid_attributes, array $validation_errors)
    {
        $contact = Contact::factory()->make($invalid_attributes);

        $response = $this->storeContact($contact->toArray());

        $response->assertInvalid($validation_errors);

        $this->markTestIncomplete('should implement logic related to group_id');
    }

    public function test_cannot_create_two_contacts_with_same_information()
    {
        $contact_attributes = [
            'nickname' => 'johndoe',
            'email' => 'johndoe@gmail.com',
            'phone' => '0898000000'
        ];

        Contact::factory()->create($contact_attributes);

        $this->assertDatabaseHas('contacts', $contact_attributes);

        foreach ($contact_attributes as $attribute => $value) {
            $contact = Contact::factory()->make([$attribute => $value]);

            $response = $this->storeContact($contact->toArray());

            $response->assertInvalid([$attribute => 'already been taken']);
        }

        $this->markTestIncomplete('should implement logic for group_id');
    }
}
