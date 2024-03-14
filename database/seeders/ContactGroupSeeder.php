<?php

namespace Database\Seeders;

use App\Models\ContactGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;

class ContactGroupSeeder extends Seeder
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
        DB::table('contacts_groups')->truncate();
        ContactGroup::factory(5)->create();
    }
}
