<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryConnection;
use App\CategoryLink;
use App\Content;
use App\Page;
use App\Quiz;
use App\Subject;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex() {
        return view('admin_top');
    }

    public function getCategoryVue()
    {
        // テスト
        return view('admin_category_vue');
    }

    public function getSubjectResults()
    {
        $subjects = Subject::with('tracks')->get();
        $quizzes = Quiz::orderBy('id')->get();
        return view('admin_results', ['subjects' => $subjects, 'quizzes' => $quizzes]);
    }

    public function getChilds($id)
    {
        $childs = Category::find($id)->childs;
        return $childs;
    }

    public function getQuizzes()
    {
        $quizzes = Quiz::orderBy('id')->get();
        return view('admin_quizzes', ['quizzes' => $quizzes]);
    }

    public function getSearchQuizzes($keyword)
    {
        $search_contents = Content::where('name', 'like', '%' . $keyword . '%')->get();
        return response()->json($search_contents);
    }

    public function postCreateQuiz(Request $request)
    {
        $quiz = Quiz::create(['content_id' => $request->input('content_id')]);
        $quiz->types()->sync($request->input('types'));

        return redirect(action('AdminController@getQuizzes'));
    }

    public function postDeleteQuiz(Request $request)
    {
        $quiz = Quiz::findOrFail($request->input('quiz_id'));
        $quiz->delete();

        return redirect(action('AdminController@getQuizzes'));
    }

    public function getCategories()
    {
        $category_layers = collect();
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

        $contents = collect(Content::all());
        foreach ($contents as $content) {
            $last_categories = $content->categories;
            $categories = $last_categories->pluck('id');
            foreach ($last_categories as $index => $category) {
                foreach ($category->childs->pluck('id') as $child) {
                    if ($categories->contains($child)) {
                        $last_categories->pull($index);
                        break;
                    }
                }
            }
            $content->last_categories = $last_categories;
        }

        return view('admin_categories', ['category_layers' => $category_layers, 'contents' => $contents]);
    }

    public function createCategory(Request $request)
    {
        $category = Category::create(['name' => $request->input('name'), 'type' => $request->input('category_type')]);
        $connection = CategoryConnection::create(['parent_category_id' => $request->input('parent_id'), 'child_category_id' => $category->id]);
        $connection->types()->create(['type' => $request->input('connection_type')]);

        return redirect()->action('AdminController@getCategories');
    }

    public function createConnection(Request $request)
    {
        $connection = CategoryConnection::where('parent_category_id', $request->input('parent_id'))->where('child_category_id', $request->input('child_id'))->first();
        if (!isset($connection)) {
            $connection = CategoryConnection::create(['parent_category_id' => $request->input('parent_id'), 'child_category_id' => $request->input('child_id')]);
        }
        $connection->types()->create(['type' => $request->input('connection_type')]);

        return redirect()->action('AdminController@getCategories');
    }

    public function createContent(Request $request)
    {
        $content = Content::create(['name' => $request->input('name')]);
        $category = Category::find($request->input('category_id'));

        $target_categories = collect([$category]);
        $num = 0;
        while($num < $target_categories->count()) {
            $target_categories = $target_categories->merge($target_categories[$num]->parents);
            $target_categories = $target_categories->unique('id');
            $num++;
        }
        $content->categories()->sync($target_categories->pluck('id'));

        return redirect()->action('AdminController@getCategories');
    }

    public function createCategoryContent(Request $request)
    {
        $content = Content::find($request->input('content_id'));
        $category = Category::find($request->input('category_id'));
        $target_categories = collect([$category]);
        $num = 0;
        while($num < $target_categories->count()) {
            $target_categories = $target_categories->merge($target_categories[$num]->parents);
            $target_categories = $target_categories->unique('id');
            $num++;
        }
        $target_categories = $target_categories->merge($content->categories)->unique('id');
        $content->categories()->sync($target_categories->pluck('id'));

        return redirect()->action('AdminController@getCategories');
    }
}
