<?php

namespace App\Http\Repositories;

use App\Models\Contact;
use App\Models\ContactGroup;

class ContactGroupRepo
{

    // get all groups
    public static function all()
    {
        return ContactGroup::all();
    }

    // get one group 
    public static function show(string|int $id)
    {
        return ContactGroup::findOrFail($id);
    }

    // get all contats from a single group
    public static function showContactsOfGroup(string|int $id)
    {
        return ContactGroup::findOrFail($id)->contacts;
    }

    // edit a group

    // create a group

    // delete a group ?

    // bulk add contacts to one group ? 

    // bulk remove contacts from one group ?
}
