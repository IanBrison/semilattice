<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryConnection;
use App\CategoryLink;
use App\Content;
use App\Page;
use App\Quiz;
use App\QuizSet;
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
        $subjects = Subject::with('tracks')->with('time_tracks')->get();
        $quizzes = Quiz::orderBy('id')->get();
        return view('admin_results', ['subjects' => $subjects, 'quizzes' => $quizzes]);
    }

    public function getSubjectResult($id)
    {
        $subject = Subject::find($id);
        $quizzes = Quiz::orderBy('id')->get();
        $questionnaire = $subject->questionnaire;
        return view('admin_result', ['subject' => $subject, 'questionnaire' => $questionnaire, 'quizzes' => $quizzes]);
    }

    public function getChilds($id)
    {
        $childs = Category::find($id)->childs;
        return $childs;
    }

    public function getQuizzes()
    {
        $quiz_sets = QuizSet::orderBy('id')->get();
        return view('admin_quizzes', ['quiz_sets' => $quiz_sets]);
    }

    public function getSearchQuizzes($keyword)
    {
        $search_contents = Content::where('name', 'like', '%' . $keyword . '%')->get();
        return response()->json($search_contents);
    }

    public function postCreateQuizSet(Request $request)
    {
        $quiz_a = Quiz::create(['description' => $request->input('description_a'), 'img_url' => $request->input('img_url_a')]);
        $quiz_b = Quiz::create(['description' => $request->input('description_b'), 'img_url' => $request->input('img_url_b')]);

        QuizSet::create(['quiz_a_id' => $quiz_a->id, 'quiz_b_id' => $quiz_b->id]);

        return redirect(action('AdminController@getQuizzes'));
    }

    public function postDeleteQuizSet(Request $request)
    {
        $quiz_set = QuizSet::findOrFail($request->input('quiz_id'));
        $quiz_set->a->delete();
        $quiz_set->b->delete();
        $quiz_set->delete();

        return redirect(action('AdminController@getQuizzes'));
    }

    public function getCategories()
    {
        $category_layers = collect();
        $category_layers[0] = Category::where('id', 1)->get();

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

    public function postDeleteSubject(Request $request)
    {
        $subject = Subject::findOrFail($request->input('subject_id'));
        $subject->delete();

        return redirect(action('AdminController@getSubjectResults'));
    }
}
