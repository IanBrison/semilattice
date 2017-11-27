<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex() {
        return view('admin_top');
    }

    public function getCategories() {
        return view('admin_categories');
    }

    public function createCategory(Request $request)
    {
        $category = Category::create(['name' => $request->input('name'), 'type' => $request->input('type')]);
        $category->parents()->attach($request->input('parent_id'));

        return redirect()->action('AdminController@getCategories');
    }
}
