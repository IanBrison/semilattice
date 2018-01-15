<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class rakuten_init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rakuten_init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize rakuten table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file_ = new \SplFileObject(__DIR__ . "/rakuten.tsv", 'r');
        $count = 0;
        $db = array();
        while (!$file_->eof()) {
            $line_= $file_->fgetcsv("\t");
            if (count($line_) == 20)
            {
                echo $line_[0] . ", ";
                $tmp = array(
                    'recipe_id' => $line_[0],
                    'user_id' => $line_[1],
                    'big_category' => $line_[2],
                    'medium_category' => $line_[3],
                    'small_category' => $line_[4],
                    'recipe_title' => $line_[5],
                    'recipe_story' => $line_[6],
                    'recipe_description' => $line_[7],
                    'recipe_img' => $line_[8],
                    'recipe_real_name' => $line_[9],
                    'tag_1' => $line_[10],
                    'tag_2' => $line_[11],
                    'tag_3' => $line_[12],
                    'tag_4' => $line_[13],
                    'one_point_info' => $line_[14],
                    'cook_time' => $line_[15],
                    'cook_purpose' => $line_[16],
                    'cook_cost' => $line_[17],
                    'cook_amount' => $line_[18],
                    'registered_at' => $line_[19]);
                array_push($db, $tmp);
                $count++;
                if($count > 100) {
                    \App\Rakuten::insert($db);
                    $count = 0;
                    $db = array();
                }
            }
        }
        \App\Rakuten::insert($db);
    }
}
