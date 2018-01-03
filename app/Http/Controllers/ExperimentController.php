<?php

namespace App\Http\Controllers;

use App\Category;
use App\Content;
use App\Quiz;
use App\Subject;
use App\Track;
use Illuminate\Http\Request;

use Auth;

class ExperimentController extends Controller
{

    public function getIndex()
    {
        return view('start');
    }

    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $subject = Subject::create(['name' => $request->input('name'), 'uni_id' => $request->input('uni_id')]);
        Auth::login($subject);
        return redirect(action('ExperimentController@getIndex'));
    }

    public function getExperiment($quiz_num, $category_id)
    {
        $quizzes = Quiz::orderBy('id')->get();

        if ($quiz_num > $quizzes->count()) {
            return redirect(action('ExperimentController@getThankYou'));
        }

        if ($category_id != 1) {
            Track::firstOrCreate(['subject_id' => Auth::user()->id, 'quiz_id' => $quizzes[$quiz_num - 1]->id, 'category_id' => $category_id]);
        }

        $target_content = $quizzes[$quiz_num - 1]->content;
        $category = Category::find($category_id);
        $contents = $category->contents()->paginate(10);

        return view('exp', ['quiz' => $quizzes[$quiz_num - 1],
            'quiz_num' => $quiz_num,
            'target_content' => $target_content,
            'category' => $category,
            'contents' => $contents]);
    }

    public function getResult($quiz_num, $content_id)
    {
        $quizzes = Quiz::orderBy('id')->get();

        if ($content_id == 0) $content_id = null;
        Track::create(['subject_id' => Auth::user()->id, 'quiz_id' => $quizzes[$quiz_num - 1]->id, 'content_id' => $content_id]);

        if ($quiz_num > $quizzes->count()) {
            return redirect(action('ExperimentController@getThankYou'));
        }

        return redirect(action('ExperimentController@getExperiment', [$quiz_num + 1, 1]));
    }

    public function getThankYou()
    {
        Auth::logout();
        return view('thank_you');
    }
}
