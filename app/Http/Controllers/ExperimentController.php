<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class ExperimentController extends Controller
{
    public function getStart()
    {
        return view('start');
    }

    public function getCategory($id)
    {
        $category = Category::find($id);

        return view('exp', ['category' => $category]);
    }
}
