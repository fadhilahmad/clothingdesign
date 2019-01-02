<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // method for index page
    public function index(){
        $title = "Welcome to clothing design";
        return view('pages.index')->with('title', $title);
    }

    // method for about page
    public function about(){
        $title = "About";
        return view('pages.about')->with('title', $title);
    }

    //method for services page
    public function services(){
        //$title = "Services";

        // to handle an array to with()
        $data = array(
            'title' => 'Services',
            'services' => ['Design cloth', 'Printing', 'Sewing']
        );

        return view('pages.services')->with($data);
    }

}
