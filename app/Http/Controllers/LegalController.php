<?php

namespace App\Http\Controllers;


class LegalController extends Controller
{
    /**
     * Display privacy policy page
     */
    public function privacy()
    {
        return view('legal.privacy');
    }
    
    /**
     * Display terms of service page
     */
    public function terms()
    {
        return view('legal.terms');
    }
    
    /**
     * Display cookie policy page
     */
    public function cookie()
    {
        return view('legal.cookie');
    }
    
    /**
     * Display disclaimer page
     */
    public function disclaimer()
    {
        return view('legal.disclaimer');
    }
}