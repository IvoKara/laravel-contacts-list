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
}
