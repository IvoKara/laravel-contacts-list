<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\ContactGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seed();
    }

    public function seed()
    {
        $contacts = Contact::factory(30)->create();

        $group_ids = ContactGroup::all()->pluck('id');

        foreach ($contacts->random(20) as $contact) {
            $contact->groups()->attach(
                $group_ids->random(rand(1, 3))
            );
        }
    }
}
