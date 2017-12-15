<?php

namespace App\Http\Controllers;

use App\Category;
use App\Content;
use App\Subject;
use App\Track;
use Illuminate\Http\Request;

use Auth;

class ExperimentController extends Controller
{

    private $questions = [0, [93707, '/images/steven-gerrard.jpg'], [95626, '/images/halil.jpg']];

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
        if ($category_id != 1) {
            Track::firstOrCreate(['subject_id' => Auth::user()->id, 'quiz_num' => $quiz_num, 'category_id' => $category_id]);
        }

        $target_content = Content::find($this->questions[$quiz_num][0]);
        $category = Category::find($category_id);
        $contents = $category->contents()->paginate(30);

        return view('exp', ['quiz' => $this->questions[$quiz_num],
            'quiz_num' => $quiz_num,
            'target_content' => $target_content,
            'category' => $category,
            'contents' => $contents]);
    }

    public function getResult($quiz_num, $content_id)
    {
        if ($content_id == 0) $content_id = null;
        Track::create(['subject_id' => Auth::user()->id, 'quiz_num' => $quiz_num, 'content_id' => $content_id]);

        if ($quiz_num + 1 >= count($this->questions)) {
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
