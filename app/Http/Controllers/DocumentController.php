<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        
        return view('admin.document.document_list');
    }
    public function back_up_list(){
        
        return view('admin.document.document_backup');
    }
    public function qa_list(){
        
        return view('admin.document.document_qa');
    }
    public function saas_list(){
        
        return view('admin.document.saas_tech');
    }
}
