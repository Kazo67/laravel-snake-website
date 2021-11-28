<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    /**
     * Show welcome index page
     */
    public function index()
    {
        return view('pages.welcome');
    }

    /**
     * Show offline fallback page
     */
    public function offlineFallback()
    {
        return view('pages.offline-fallback');
    }
}
