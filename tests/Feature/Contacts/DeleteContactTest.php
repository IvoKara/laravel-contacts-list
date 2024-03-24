<?php

namespace Tests\Feature\Contacts;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteContactTest extends TestCase
{
    public function test_contact_should_be_deleteable()
    {
        // create a contact with factory
        $contact = Contact::factory()->create();

        // assert that one exact record exists in the database
        $this->assertModelExists($contact);

        // delete the given contact from storage
        $contact->delete();

        // assert that it is no longer in storage
        $this->assertModelMissing($contact);
    }

    // TODO: others
}
