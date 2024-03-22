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
        $groupIds = ContactGroup::all()->pluck('id');

        foreach ($groupIds as $id) {
            Contact::factory(7)->create([
                'group_id' => $id
            ]);
        }
    }
}
