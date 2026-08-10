<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function index()
    {
        return view('admin.testimony.testimony');
    }

    public function create()
    {
        return view('admin.testimony.add');
    }

    public function edit($id)
    {
        return view('admin.testimony.edit', compact('id'));
    }
}
