<?php

namespace App\Http\Controllers;

use App\Category;
use App\Questionnaire;
use App\QuizSet;
use App\Subject;
use App\TimeTrack;
use App\Track;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Cache;

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
        $subject = Subject::create(['name' => $request->input('name'),
            'uni_id' => $request->input('uni_id'),
            'sex' => $request->input('sex'),
            'experience' => $request->input('experience')]);
        Auth::login($subject);
        return redirect(action('ExperimentController@getIndex'));
    }

    public function getQuiz($quiz_num){
        $quiz_sets = QuizSet::orderBy('id')->get();

        $quiz_set_num = ceil($quiz_num / 2);
        $quiz_a_b = fmod($quiz_num, 2);

        if ($quiz_set_num > $quiz_sets->count()) {
            return redirect(action('ExperimentController@getQuestionnaire'));
        }

        $quiz = $quiz_sets[$quiz_set_num - 1]->a;
        $a_b = 'a';
        if ($quiz_a_b == 0) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
            $a_b = 'b';
        }
        return view('quiz', ['quiz' => $quiz, 'quiz_set_num' => $quiz_set_num, 'a_b' => $a_b, 'quiz_num' => $quiz_num]);
    }

    public function getExperiment($quiz_num, $category_id, Request $request)
    {
        $quiz_sets = QuizSet::orderBy('id')->get();

        $quiz_set_num = ceil($quiz_num / 2);
        $quiz_a_b = fmod($quiz_num, 2);

        if ($quiz_set_num > $quiz_sets->count()) {
            return redirect(action('ExperimentController@getQuestionnaire'));
        }

        $user_group = fmod(Auth::user()->id, 2);
        $quiz = $quiz_sets[$quiz_set_num - 1]->a;
        if ($quiz_a_b == 0) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
        }
        $category_type = 1;
        if (fmod($user_group + $quiz_a_b, 2) == 0) {
            $category_type = 2;
        }

        if ($category_id != 1) {
            Track::create(['subject_id' => Auth::user()->id, 'quiz_id' => $quiz->id, 'category_id' => $category_id]);
        } else {
            if (!TimeTrack::where('subject_id', Auth::user()->id)->where('quiz_id', $quiz->id)->exists()) {
                TimeTrack::firstOrCreate(['subject_id' => Auth::user()->id, 'quiz_id' => $quiz->id, 'start_time' => Carbon::now()]);
            }
        }

        $category = Category::find($category_id);
        $page_num = $request->input('page') != null ? $request->input('page') : 1;
        $contents = Cache::rememberForever('quiz'.$quiz_num.'content'.$category_id.'page'.$page_num, function() use ($category){
            return $category->contents()->paginate(12);
        });

        $childs = Cache::rememberForever('childs'.$category_id.'category_type'.$category_type, function() use ($category, $category_type){
            return $category->childs()->wherePivot('type', $category_type)->withPivot('semilattice_name')->get();
        });

        return view('exp', ['quiz' => $quiz,
            'quiz_num' => $quiz_num,
            'category' => $category,
            'contents' => $contents,
            'childs' => $childs]);
    }

    public function getResult($quiz_num, $content_id)
    {
        $quiz_sets = QuizSet::orderBy('id')->get();

        $quiz_set_num = ceil($quiz_num / 2);
        $quiz_a_b = fmod($quiz_num, 2);

        $quiz = $quiz_sets[$quiz_set_num - 1]->a;
        if ($quiz_a_b == 0) {
            $quiz = $quiz_sets[$quiz_set_num - 1]->b;
        }

        if ($content_id == 0) $content_id = null;
        Track::create(['subject_id' => Auth::user()->id, 'quiz_id' => $quiz->id, 'content_id' => $content_id]);

        $time_track = TimeTrack::where('subject_id', Auth::user()->id)->where('quiz_id', $quiz->id)->first();
        $time_track->end_time = Carbon::now();
        $time_track->save();

        if ($quiz_num + 1 > $quiz_sets->count() * 2) {
            return redirect(action('ExperimentController@getQuestionnaire'));
        }

        return redirect(action('ExperimentController@getQuiz', [$quiz_num + 1]));
    }

    public function getQuestionnaire()
    {
        return view('questionnaire');
    }

    public function postQuestionnaire(Request $request)
    {
        Questionnaire::create(['subject_id' => Auth::user()->id,
            'question1' => $request->input('question1'),
            'question2' => $request->input('question2'),
            'question3' => $request->input('question3')]);
        return redirect(action('ExperimentController@getThankYou'));
    }

    public function getThankYou()
    {
        Auth::logout();
        return view('thank_you');
    }
}
