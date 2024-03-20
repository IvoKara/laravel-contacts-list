<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ContactGroupRepo;
use Illuminate\Http\Request;

class ContactGroupController extends Controller
{
    public function index()
    {
        return ContactGroupRepo::all();
    }

    public function show(string $id)
    {
        return ContactGroupRepo::show($id);
    }

    public function showContactsOfGroup(string $id)
    {
        return ContactGroupRepo::showContactsOfGroup($id);
    }
}
