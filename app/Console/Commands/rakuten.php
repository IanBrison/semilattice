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
        echo "\nmaking 3 collecions \n";
        foreach($rakutens as $index => $rakuten) {
            echo $index;
            $big_categories->push(array('name' => $rakuten->big_category));
            echo $rakuten->big_category;
            $medium_categories->push(array('name' => $rakuten->medium_category, 'parent' => $rakuten->big_category));
            echo $rakuten->medium_category;
            $small_categories->push(array('name' => $rakuten->small_category, 'grand_parent' => $rakuten->big_category, 'parent' => $rakuten->medium_category));
            echo $rakuten->small_category;
            $contents->push(array('name' => $rakuten->recipe_title, 'real_name' => $rakuten->recipe_real_name, 'img_url' => $rakuten->recipe_img));
            echo $rakuten->recipe_title;
        }
        $big_categories = $big_categories->unique()->values();
        $medium_categories = $medium_categories->unique()->values();
        $small_categories = $small_categories->unique()->values();

        Category::insert($big_categories->toArray());
        $bigs = Category::where('id', '>', $top_category->id)->get();
        $big_ids = array_combine($big_categories->pluck('name')->all(), $bigs->pluck('id')->all());
        $big_connections = collect();
        echo "\n made big category. starting to make big category content \n";
        foreach($rakutens as $index => $rakuten) {
            echo $index . ' ';
            $big_connections->push(array('parent_category_id' => $top_category->id, 'child_category_id' => $big_ids[$rakuten->big_category], 'type' => 1));
        }
        foreach($big_connections->unique()->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryConnection::insert($item->toArray());
        }

        Category::insert($medium_categories->map(function($item, $key){
            return ['name' => $item['name']];
        })->toArray());
        $mediums = Category::where('id', '>', $bigs->last()->id)->get();
        $plucked_mediums = $mediums->pluck('id')->all();
        $medium_ids = $medium_categories->mapWithKeys(function($item, $key) use ($plucked_mediums){
            echo $item['parent'] . $item['name'] . ': ' . $plucked_mediums[$key] . "\n";
            return [$item['parent'] . $item['name'] => $plucked_mediums[$key]];
        });
        $medium_connections = collect();
        echo "\n made medium category. starting to make medium category content \n";
        foreach($rakutens as $index => $rakuten) {
            echo $index . ' ';
            $medium_connections->push(array('parent_category_id' => $big_ids[$rakuten->big_category], 'child_category_id' => $medium_ids[$rakuten->big_category . $rakuten->medium_category], 'type' => 1));
        }
        foreach($medium_connections->unique()->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryConnection::insert($item->toArray());
        }

        Category::insert($small_categories->map(function($item, $key){
            return ['name' => $item['name']];
        })->toArray());
        $smalls = Category::where('id', '>', $mediums->last()->id)->get();
        $plucked_smalls = $smalls->pluck('id')->all();
        $small_ids =  $small_categories->mapWithKeys(function($item, $key) use ($plucked_smalls){
            return [$item['grand_parent'] . $item['parent'] . $item['name'] => $plucked_smalls[$key]];
        });
        $small_connections = collect();
        echo "\n made small category. starting to make small category content \n";
        foreach($rakutens as $index => $rakuten) {
            echo $index . ' ';
            $small_connections->push(array('parent_category_id' => $medium_ids[$rakuten->big_category . $rakuten->medium_category], 'child_category_id' => $small_ids[$rakuten->big_category . $rakuten->medium_category . $rakuten->small_category], 'type' => 1));
        }
        foreach($small_connections->unique()->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryConnection::insert($item->toArray());
        }

        echo "\n make contents \n";
        foreach($contents->chunk(1000) as $index => $item) {
            echo $index . ' ';
            Content::insert($item->toArray());
        }
        $cons = Content::all();
        $con_ids = array_combine($cons->pluck('name')->all(), $cons->pluck('id')->all());

        echo "\n make category_contents \n";
        $cat_conts = collect();
        foreach($rakutens as $index => $rakuten) {
            echo $index . ' ';
            $con_id = $con_ids[$rakuten->recipe_title];
            $cat_conts->push(array('category_id' => $top_category->id, 'content_id' => $con_id));
            $cat_conts->push(array('category_id' => $big_ids[$rakuten->big_category], 'content_id' => $con_id));
            $cat_conts->push(array('category_id' => $medium_ids[$rakuten->big_category . $rakuten->medium_category], 'content_id' => $con_id));
            $cat_conts->push(array('category_id' => $small_ids[$rakuten->big_category . $rakuten->medium_category . $rakuten->small_category], 'content_id' => $con_id));
        }
        foreach($cat_conts->unique()->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryContent::insert($item->toArray());
        }
    }
}
