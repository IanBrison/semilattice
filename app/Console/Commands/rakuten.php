<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;
use App\CategoryConnection;
use App\Content;

class rakuten extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rakuten';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to move Rakuten data';

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
        $rakutens = \App\Rakuten::get();
        $top_category = Category::find(1);
        echo $top_category->name;
        foreach($rakutens as $index => $rakuten) {
            echo $index;
            $big_category = Category::firstOrCreate(['name' => $rakuten->big_category]);
            echo $big_category->name;
            CategoryConnection::firstOrCreate(['parent_category_id' => $top_category->id, 'child_category_id' => $big_category->id, 'type' => 1]);
            $medium_category = Category::firstOrCreate(['name' => $rakuten->medium_category]);
            echo $medium_category->name;
            CategoryConnection::firstOrCreate(['parent_category_id' => $big_category->id, 'child_category_id' => $medium_category->id, 'type' => 1]);
            $small_category = Category::firstOrCreate(['name' => $rakuten->small_category]);
            echo $small_category->name;
            CategoryConnection::firstOrCreate(['parent_category_id' => $medium_category->id, 'child_category_id' => $small_category->id, 'type' => 1]);

            $content = Content::firstOrCreate(['name' => $rakuten->recipe_title, 'real_name' => $rakuten->recipe_real_name, 'img_url' => $rakuten->recipe_img]);
            echo $content->name;
            $content->categories()->sync([$top_category->id, $big_category->id, $medium_category->id, $small_category->id]);
        }
    }
}
