<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class EmailCadencesController extends Controller
{
    public function index(){
        return View::make('email_cadences.index');
    }
    public function directClient(){
        return View::make('email_cadences.direct_client');
    }
    public function whiteLabelled(){
        return View::make('email_cadences.white_labelled_partners');
    }
    public function technology(){
        return View::make('email_cadences.technology_partners');
    }
}
