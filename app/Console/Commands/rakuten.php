<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;
use App\CategoryConnection;
use App\CategoryContent;
use App\Content;
use PhpParser\Node\Scalar\String_;

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
        $big_categories = collect();
        $medium_categories = collect();
        $small_categories = collect();
        $contents = collect();
        echo $top_category->name;
        foreach($rakutens as $index => $rakuten) {
            echo $index;
            $big_categories->push(array('name' => $rakuten->big_category));
            echo $rakuten->big_category;
            $medium_categories->push(array('name' => $rakuten->medium_category));
            echo $rakuten->medium_category;
            $small_categories->push(array('name' => $rakuten->small_category));
            echo $rakuten->small_category;
            $contents->push(array('name' => $rakuten->recipe_title, 'real_name' => $rakuten->recipe_real_name, 'img_url' => $rakuten->recipe_img));
            echo $rakuten->recipe_title;
        }
        $big_categories = $big_categories->unique('name');
        $medium_categories = $medium_categories->unique('name');
        $small_categories = $small_categories->unique('name');
        Category::insert($big_categories->toArray());
        $bigs = Category::where('id', '>', $top_category->id)->get();
        $big_ids = array_combine($bigs->pluck('name')->all(), $bigs->pluck('id')->all());
        Category::insert($medium_categories->toArray());
        $mediums = Category::where('id', '>', $bigs->last()->id)->get();
        $medium_ids = array_combine($mediums->pluck('name')->all(), $mediums->pluck('id')->all());
        Category::insert($small_categories->toArray());
        $smalls = Category::where('id', '>', $mediums->last()->id)->get();
        $small_ids = array_combine($smalls->pluck('name')->all(), $smalls->pluck('id')->all());
        foreach($contents->chunk(1000) as $index => $item) {
            echo $index . ' ';
            Content::insert($item->toArray());
        }
        $cons = Content::all();
        $con_ids = array_combine($cons->pluck('name')->all(), $cons->pluck('id')->all());

        $connections = collect();
        $cat_conts = collect();
        foreach($rakutens as $index => $rakuten) {
            echo $index . ' ';
            $big_id = $big_ids[$rakuten->big_category];
            $medium_id = $medium_ids[$rakuten->medium_category];
            $small_id = $small_ids[$rakuten->small_category];
            $con_id = $con_ids[$rakuten->recipe_title];
            $connections->push(array('parent_category_id' => $top_category->id, 'child_category_id' => $big_id, 'type' => 1));
            $connections->push(array('parent_category_id' => $big_id, 'child_category_id' => $medium_id, 'type' => 1));
            $connections->push(array('parent_category_id' => $medium_id, 'child_category_id' => $small_id, 'type' => 1));
            $cat_conts->push(array('category_id' => $top_category->id, 'content_id' => $con_id));
            $cat_conts->push(array('category_id' => $big_id, 'content_id' => $con_id));
            $cat_conts->push(array('category_id' => $medium_id, 'content_id' => $con_id));
            $cat_conts->push(array('category_id' => $small_id, 'content_id' => $con_id));
        }
        foreach($connections->unique()->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryConnection::insert($item->toArray());
        }
        foreach($cat_conts->unique()->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryContent::insert($item->toArray());
        }
    }
}
