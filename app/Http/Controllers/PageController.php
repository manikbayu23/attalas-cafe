<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.public.home');
    }

    public function about()
    {
        return view('pages.public.about');
    }

    public function reservation()
    {
        return view('pages.public.reservation');
    }

    public function gallery()
    {
        return view('pages.public.gallery');
    }

    public function contact()
    {
        return view('pages.public.contact');
    }

    public function menu()
    {
        return view('pages.public.menu');
    }
}
