<?php

namespace App\Http\Controllers;

use App\Category;
use App\QuizSet;
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

    public function getQuiz($quiz_num){
        $quiz_sets = QuizSet::orderBy('id')->get();

        $quiz_set_num = ceil($quiz_num / 2);
        $quiz_a_b = fmod($quiz_num, 2);

        if ($quiz_set_num > $quiz_sets->count()) {
            return redirect(action('ExperimentController@getThankYou'));
        }

        $quiz = $quiz_sets[$quiz_set_num - 1]->a;
        $user_group = fmod(Auth::user()->id, 2);
        if ($user_group == 1 && $quiz_a_b == 0) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
        } else if ($user_group == 0 && $quiz_a_b == 1) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
        }
        return view('quiz', ['quiz' => $quiz, 'quiz_num' => $quiz_num]);
    }

    public function getExperiment($quiz_num, $category_id)
    {
        $quiz_sets = QuizSet::orderBy('id')->get();

        $quiz_set_num = ceil($quiz_num / 2);
        $quiz_a_b = fmod($quiz_num, 2);

        if ($quiz_set_num > $quiz_sets->count()) {
            return redirect(action('ExperimentController@getThankYou'));
        }

        $quiz = $quiz_sets[$quiz_set_num - 1]->a;
        $user_group = fmod(Auth::user()->id, 2);
        if ($user_group == 1 && $quiz_a_b == 0) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
        } else if ($user_group == 0 && $quiz_a_b == 1) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
        }

        if ($category_id != 1) {
            Track::firstOrCreate(['subject_id' => Auth::user()->id, 'quiz_id' => $quiz->id, 'category_id' => $category_id]);
        }

        $category = Category::with('childs')->find($category_id);
        $contents = $category->contents()->paginate(12);

        return view('exp', ['quiz' => $quiz,
            'quiz_num' => $quiz_num,
            'category' => $category,
            'contents' => $contents]);
    }

    public function getResult($quiz_num, $content_id)
    {
        $quiz_sets = QuizSet::orderBy('id')->get();

        $quiz_set_num = ceil($quiz_num / 2);
        $quiz_a_b = fmod($quiz_num, 2);

        $quiz = $quiz_sets[$quiz_set_num - 1]->a;
        $user_group = fmod(Auth::user()->id, 2);
        if ($user_group == 1 && $quiz_a_b == 0) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
        } else if ($user_group == 0 && $quiz_a_b == 1) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
        }

        if ($content_id == 0) $content_id = null;
        Track::create(['subject_id' => Auth::user()->id, 'quiz_id' => $quiz->id, 'content_id' => $content_id]);

        if ($quiz_num + 1 > $quiz_sets->count() * 2) {
            return redirect(action('ExperimentController@getThankYou'));
        }

        return redirect(action('ExperimentController@getQuiz', [$quiz_num + 1]));
    }

    public function getThankYou()
    {
        Auth::logout();
        return view('thank_you');
    }
}
