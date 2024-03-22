<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ContactGroupRepo;
use App\Http\Requests\ContactGroupRequest;
use App\Models\Contact;
use App\Models\ContactGroup;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactGroupController extends Controller
{
    /**
     * Display all contact groups.
     */
    public function index()
    {
        // Inertia::render("ContactGroup/Index",
        return ContactGroup::all();
    }

    // public function test()
    // {
    //     return Inertia::render("Test");
    // }

    /**
     * Show the page for creating new contact groups.
     */
    public function create()
    {
        // do not have a view yet
        //return Inertia::render("ContactGroup/Create");
    }

    /**
     * Store newly created contact group.
     */
    public function store(ContactGroupRequest $request)
    {
        ContactGroup::create($request->only('name'));
    }

    /**
     * Display the specified contact group with the contacts in it.
     */
    public function show(ContactGroup $group)
    {
        // return Inertia::render("ContactGroup/Show", 
        return [
            'group' => $group,
            'contacts' => $group->contacts
        ];
    }

    /**
     * Show every contact in specified group.
     */
    public function showContactsOfGroup(ContactGroup $group)
    {
        // return Inertia::render("ContactGroup/Show", $group);
        return $group->contacts;
    }

    /**
     * Show the page for editting the specified contact group.
     */
    public function edit(ContactGroup $group)
    {
        // do not have a view yet
        // return Inertia::render("ContactGroup/Edit");
        return Inertia::render("Test2", [
            "group" => $group
        ]);
    }

    /**
     * Update the specified contact group in storage.
     * Updates only name at this time.
     */
    public function update(ContactGroupRequest $request, ContactGroup $group)
    {
        $group->update($request->only('name'));
    }

    /**
     * Destroy the specified contact group from storage.
     * ! Not done yet because no clear guidelines what to do
     * Cascade or not?
     */
    public function destroy(ContactGroup $group)
    {
        // ContactGroup::destroy($group->id);
        // return redirect()->route('contacts-groups.index');
    }

    // TODO
    // bulk add contacts to one group ? 
    // bulk remove contacts from one group ?
}
