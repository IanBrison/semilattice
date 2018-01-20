<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $table = 'questionnaires';
    protected $guarded = ['id'];

    public function getAnswer1Attribute()
    {
        $text = '';
        if ($this->question1 == 5) {
            $text = 'はっきりと違いを認識していた';
        } else if ($this->question1 == 4) {
            $text = '違いがあると感じていた';
        } else if ($this->question1 == 3) {
            $text = '言われてみれば違った';
        } else if ($this->question1 == 2) {
            $text = '言われても少し違和感を感じたくらい';
        } else if ($this->question1 == 1) {
            $text = '全く気づかなかった';
        }
        return $text;
    }

    public function getAnswer2Attribute()
    {
        $text = '';
        if ($this->question2 == 5) {
            $text = 'かなりの違いがあった';
        } else if ($this->question2 == 4) {
            $text = 'それなりに違いが出ていた';
        } else if ($this->question2 == 3) {
            $text = '少し違いが見受けられた';
        } else if ($this->question2 == 2) {
            $text = 'ほとんど違いはなかった';
        } else if ($this->question2 == 1) {
            $text = '全く違いが感じられなかった';
        }
        return $text;
    }

    public function getAnswer4Attribute()
    {
        $text = '';
        if ($this->question4 == 5) {
            $text = 'Aの方がかなり探しやすかった';
        } else if ($this->question4 == 4) {
            $text = 'Aの方が少し探しやすかった';
        } else if ($this->question4 == 3) {
            $text = 'どちらも同じだった';
        } else if ($this->question4 == 2) {
            $text = 'Bの方が少し探しやすかった';
        } else if ($this->question4 == 1) {
            $text = 'Bの方がかなり探しやすかった';
        }
        return $text;
    }

    public function getAnswer5Attribute()
    {
        $text = '';
        if ($this->question5 == 5) {
            $text = 'Aの方がかなり操作しやすかった';
        } else if ($this->question5 == 4) {
            $text = 'Aの方が少し操作しやすかった';
        } else if ($this->question5 == 3) {
            $text = 'どちらも同じだった';
        } else if ($this->question5 == 2) {
            $text = 'Bの方が少し操作しやすかった';
        } else if ($this->question5 == 1) {
            $text = 'Bの方がかなり操作しやすかった';
        }
        return $text;
    }

    public function getAnswer6Attribute()
    {
        $text = '';
        if ($this->question6 == 5) {
            $text = 'Aの方がかなり疲れやすかった';
        } else if ($this->question6 == 4) {
            $text = 'Aの方が少し疲れやすかった';
        } else if ($this->question6 == 3) {
            $text = 'どちらも同じだった';
        } else if ($this->question6 == 2) {
            $text = 'Bの方が少し疲れやすかった';
        } else if ($this->question6 == 1) {
            $text = 'Bの方がかなり疲れやすかった';
        }
        return $text;
    }

    public function getAnswer7Attribute()
    {
        $text = '';
        if ($this->question7 == 5) {
            $text = 'Aの方がかなり効率よく探せた';
        } else if ($this->question7 == 4) {
            $text = 'Aの方が少し効率よく探せた';
        } else if ($this->question7 == 3) {
            $text = 'どちらも同じだった';
        } else if ($this->question7 == 2) {
            $text = 'Bの方が少し効率よく探せた';
        } else if ($this->question7 == 1) {
            $text = 'Bの方がかなり効率よく探せた';
        }
        return $text;
    }

    public function getAnswer8Attribute()
    {
        $text = '';
        if ($this->question8 == 5) {
            $text = 'とても使いやすかった';
        } else if ($this->question8 == 4) {
            $text = '少し使いやすかった';
        } else if ($this->question8 == 3) {
            $text = 'とくになにも感じなかった';
        } else if ($this->question8 == 2) {
            $text = '少し使いづらかった';
        } else if ($this->question8 == 1) {
            $text = 'とても使いづらかった';
        }
        return $text;
    }
}
