<?php

namespace Tests\Feature\ContactGroups;

use App\Models\ContactGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteContactGroupTest extends TestCase
{
    public function test_contact_should_be_deleteable()
    {
        $this->markTestSkipped("Do not know what to do on delete");
        // create a contact group with factory
        $contact_group = ContactGroup::factory()->create();

        // assert that one exact record exists in the database
        $this->assertModelExists($contact_group);

        // delete the given contact from storage
        $contact_group->delete();

        // assert that it is no longer in storage
        $this->assertModelMissing($contact_group);
    }

    // TEST: others
}
