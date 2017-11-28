<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    public function getIndex() {
        return view('admin_top');
    }

    public function getCategories() {
        $category_layers = new Collection();
        $category_layers[0] = Category::where('type', 0)->get();

        $layer_num = 0;
        while (isset($category_layers[$layer_num])) {
            for ($n = 0; $n < count($category_layers[$layer_num]); $n++) {
                if ($category_layers[$layer_num][$n]->childs()->count() > 0) {
                    if (isset($category_layers[$layer_num + 1])){
                        $category_layers[$layer_num + 1] = $category_layers[$layer_num + 1]->merge($category_layers[$layer_num][$n]->childs);
                    } else {
                        $category_layers[$layer_num + 1] = $category_layers[$layer_num][$n]->childs;
                    }
                    $category_layers[$layer_num + 1] = $category_layers[$layer_num + 1]->values($category_layers[$layer_num + 1]->unique());
                }
            }
            $layer_num++;
        }

        return view('admin_categories', ['category_layers' => $category_layers]);
    }

    public function createCategory(Request $request)
    {
        $category = Category::create(['name' => $request->input('name'), 'type' => $request->input('type')]);
        $category->parents()->attach($request->input('parent_id'));

        return redirect()->action('AdminController@getCategories');
    }

    public function createConnection(Request $request)
    {
        $category = Category::findOrFail($request->input('child_id'));
        $category->parents()->attach($request->input('parent_id'));

        return redirect()->action('AdminController@getCategories');
    }
}
