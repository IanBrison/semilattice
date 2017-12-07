<?php

namespace App\Console\Commands;

use App\Category;
use App\CategoryConnection;
use App\CategoryLink;
use App\Content;
use App\Page;
use Illuminate\Console\Command;

class move extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'move';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command is for moving data in to Semilattice ';

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
        $categories = collect([Category::find(1)]);
        $all_num = 1;

        for ($num = 0; $num < count($categories); $num++) {
            $connections = CategoryLink::where('cl_to', $categories[$num]->name)->where('cl_type', 'subcat')->get();
            foreach ($connections as $connection) {
                $page_name = Page::where('page_id', $connection->cl_from)->first()->page_title;
                if (preg_match('/のテンプレート/', $page_name)) {
                    continue;
                }
                $category = Category::firstOrCreate(['name' => $page_name, 'type' => 1]);
                CategoryConnection::firstOrCreate(['parent_category_id' => $categories[$num]->id, 'child_category_id' => $category->id]);
                if (!$categories->contains('id', $category->id)) {
                    $categories->push($category);
                    $this->line($num . ': ' . $all_num . ',' . $category->name);
                    $all_num++;
                }
            }
        }
        $all_num = 1;
        foreach ($categories as $category) {
            $pages = Page::whereIn('page_id', CategoryLink::select('cl_from')->where('cl_to', $category->name)->where('cl_type', 'page')->get()->pluck('cl_from'))->get();
            foreach ($pages as $page) {
                $content = Content::firstOrCreate(['name' => $page->page_title]);
                $content->categories()->attach($category->id);
                $this->line($all_num . ': ' . $content->name);
                $all_num++;
            }
        }

    }
}