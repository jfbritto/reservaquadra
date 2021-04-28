<?php

namespace App\Http\Controllers;

class EntryController extends Controller
{

    public function index()
    {
        return view('entry.home');
    }

}
