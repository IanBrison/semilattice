<?php

namespace App\Console\Commands;

use App\Rakuten;
use App\Category;
use App\CategoryConnection;
use Illuminate\Console\Command;

class rakuten_clean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rakuten_clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clean the dataset';

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
        $rakuten_small_duplicates = Rakuten::select(['id', 'big_category', 'medium_category', 'small_category', 'recipe_title'])->whereColumn('small_category', 'medium_category')->get();
        $delete_category = collect();
        foreach ($rakuten_small_duplicates as $rakuten) {
            $delete_category->push(array('big_category' => $rakuten->big_category, 'medium_category' => $rakuten->medium_category, 'small_category' => $rakuten->small_category));
        }
        $delete_category = $delete_category->unique();
        echo 'delete ' . $delete_category->count() . " small categories\n";
        foreach ($delete_category as $index => $category) {
            echo $index . ' ';
            $big = Category::where('name', $category['big_category'])->first();
            if($big == null) continue;
            $medium = $big->childs()->where('name', $category['medium_category'])->first();
            if($medium == null) continue;
            $small = $medium->childs()->where('name', $category['small_category'])->first();
            if($small == null) continue;
            $small->delete();
            echo $small->name;
        }

        $rakuten_medium_duplicates = Rakuten::select(['id', 'big_category', 'medium_category', 'small_category', 'recipe_title'])->whereColumn('big_category', 'medium_category')->get();
        $delete_category = collect();
        foreach ($rakuten_medium_duplicates as $rakuten) {
            $delete_category->push(array('big_category' => $rakuten->big_category, 'medium_category' => $rakuten->medium_category, 'small_category' => $rakuten->small_category));
        }
        $delete_category = $delete_category->unique();
        echo 'delete ' . $delete_category->count() . " medium categories\n";
        $delete_category_models = collect();
        foreach ($delete_category as $index => $category) {
            echo $index . ' ';
            $big = Category::where('name', $category['big_category'])->first();
            if($medium == null) continue;
            $medium = $big->childs()->where('name', $category['medium_category'])->first();
            if($small == null) continue;
            if ($category['medium_category'] != $category['small_category']) {
                $small = $medium->childs()->where('name', $category['small_category'])->first();
                if($small == null) {
                    $delete_category_models->push($medium);
                    echo $medium->name;
                    continue;
                }
                $delete_connection = CategoryConnection::where('parent_category_id', $medium->id)->where('child_category_id', $small->id)->first();
                $delete_connection->delete();
                CategoryConnection::firstOrCreate(['parent_category_id' => $big->id, 'child_category_id' => $small->id, 'type' => 1]);
                echo ' yeah ' . $small->name;
            }
            $delete_category_models->push($medium);
            echo $medium->name;
        }
        foreach ($delete_category_models as $delete_category_model) {
            $delete_category_model->delete();
        }
        $blank_categories = Category::where('name', '')->get();
        foreach ($blank_categories as $blank_category) {
            $blank_category->delete();
        }

    }
}
