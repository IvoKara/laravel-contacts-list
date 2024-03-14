<?php

namespace App\Http\Repositories;

use App\Models\ContactGroup;

class ContactGroupRepo
{

    // get all groups
    public static function all()
    {
        return ContactGroup::all();
    }

    // get one group 
    public static function show()
    {
    }

    // get all contats from a single group
    public static function getContactsOfGroup()
    {
    }

    // edit a group

    // create a group

    // delete a group ?

    // bulk add contacts to one group ? 

    // bulk remove contacts from one group ?
}
