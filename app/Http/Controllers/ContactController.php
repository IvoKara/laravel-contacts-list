<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display all avaliable contacts.
     */
    public function index()
    {
        // Inertia::render("Contacts/Index")
        return Contact::all();
    }

    /**
     * Show the page where contacts are created.
     */
    public function create()
    {
        // do not have a finished view yet
        return Inertia::render("Contact/Create");
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
    }

    /**
     * Display the specified contact.
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Show the page for editing the specified contact.
     */
    public function edit(Contact $contact)
    {
        // do not have a finished view yet
        return Inertia::render("Contact/Edit", [
            "contact" => $contact
        ]);
    }

    /**
     * Update the specified contact in storage.
     * Work in progress
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
    }

    /**
     * Remove the specified contact from storage.
     * Not fully completed yet because no clear guidelines what to do with groups
     */
    public function destroy(Contact $contact)
    {
        Contact::destroy($contact->id);
        return redirect()->route('contacts.index');
    }
}
