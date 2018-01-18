<?php

namespace App\Console\Commands;

use App\Category;
use App\CategoryConnection;
use App\CategoryContent;
use App\Content;
use Illuminate\Console\Command;

class rakuten_semilattice extends Command
{//delete from category_contents; delete from category_connections; delete from contents; delete from categories where id > 1;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rakuten_semilattice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Semilattice Category';

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
        $categories = Category::all();
        $new_category_num = $categories->last()->id + 1;
        $plucked_categories = $categories->pluck('name', 'id');
        $compare_categories = $categories->unique('name')->pluck('name', 'id');
        $duplicate_categories = $plucked_categories->diffKeys($compare_categories)->unique();
        $semilattice_categories = collect();
        $parent_names = collect();
        foreach ($duplicate_categories as $index => $duplicate_category) {
            echo $index . ': ' . $duplicate_category . " -> ";
            $same_categories = $categories->where('name', $duplicate_category);
            foreach ($same_categories as $index => $same_category) {
                $parent = $same_category->parents()->first();
                if ($parent == null) {
                    $same_categories->forget($index);
                    continue;
                }
                $grand_parent = $parent->parents()->first();
                if ($grand_parent != null) {
                    $parent_names->put($same_category->id, $parent->name);
                    $same_category->grand_parent = $grand_parent->id;
                    echo $same_category->grand_parent . ', ';
                } else {
                    $same_categories->forget($index);
                }
            }
            echo "\n";
            $semilattice_categories->push($same_categories);
        }
        $create_semilattices = collect();
        $top_semilattices = collect();
        $create_categories = collect();
        $create_category_contents = collect();
        foreach ($semilattice_categories as $semilattice_category) {
            $name = $semilattice_category->first()->name;
            echo $name . "\n";
            $semilattice_group = $semilattice_category->mapToGroups(function($item) {
                echo 'yeah';
                if ($item->grand_parent != null) {
                    echo 'no' . "\n";
                    return [$item->grand_parent => $item->id];
                }
            });
            echo var_dump($semilattice_group->toArray());
            foreach($semilattice_group as $index => $semilattice_ids) {
                if (is_numeric($index) && $index != 1) {
                    if ($semilattice_ids->count() > 1) {
                        $create_categories->push(array('name' => $name));
                        $create_semilattices->push(array('parent_category_id' => $index, 'child_category_id' => $new_category_num, 'type' => 2, 'semilattice_name' => NULL));
                        foreach ($semilattice_ids as $semilattice_id) {
                            $semi_cat = $categories->firstWhere('id', $semilattice_id);
                            $semi_contents_ids = $semi_cat->contents()->select(['contents.id'])->get()->pluck('id')->all();
                            foreach ($semi_contents_ids as $semi_contents_id) {
                                $create_category_contents->push(array('category_id' => $new_category_num, 'content_id' => $semi_contents_id));
                            }
                            $create_semilattices->push(array('parent_category_id' => $new_category_num, 'child_category_id' => $semilattice_id, 'type' => 2, 'semilattice_name' => $parent_names[$semilattice_id]));
                        }
                        if (!$semilattice_group->has(1)) {
                            echo 'add';
                            $semilattice_group[1] = collect();
                        }
                        $semilattice_group[1]->push($new_category_num);
                        $new_category_num++;
                    }
                }
            }
//            if ($semilattice_group->has(1) && $semilattice_group[1]->count() > 1) {
//                $top_semilattices->push(array('name' => $name, 'ids' => $semilattice_group[1]));
//            }
        }
//        echo $top_semilattices->count() . "\n";
//        foreach ($top_semilattices as $index => $top_semilattice) {
//            echo $index . ' ';
//            $create_categories->push(array('name' => $top_semilattice['name']));
//            $create_semilattices->push(array('parent_category_id' => 1, 'child_category_id' => $new_category_num, 'type' => 2, 'semilattice_name' => NULL));
//            foreach ($top_semilattice['ids'] as $semilattice_id) {
//                $semi_cat = $categories->firstWhere('id', $semilattice_id);
//                if ($semi_cat == null) continue;
//                $semi_contents_ids = $semi_cat->contents()->select(['contents.id'])->get()->pluck('id')->all();
//                foreach ($semi_contents_ids as $semi_contents_id) {
//                    $create_category_contents->push(array('category_id' => $new_category_num, 'content_id' => $semi_contents_id));
//                }
//                $create_semilattices->push(array('parent_category_id' => $new_category_num, 'child_category_id' => $semilattice_id, 'type' => 2, 'semilattice_name' => $parent_names[$semilattice_id]));
//            }
//            $new_category_num++;
//        }
        foreach($create_categories->chunk(1000) as $index => $item) {
            echo $index . ' ';
            Category::insert($item->toArray());
        }
        foreach($create_category_contents->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryContent::insert($item->toArray());
        }
        foreach($create_semilattices->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryConnection::insert($item->toArray());
        }

        $tree_category_connections = CategoryConnection::where('type', 1)->get();
        $semilattice_array = collect();
        foreach ($tree_category_connections as $index => $tree_category_connection) {
            echo $index . ' ';
            $semilattice_array->push(array('parent_category_id' => $tree_category_connection->parent_category_id, 'child_category_id' => $tree_category_connection->child_category_id, 'type' => 2));
        }
        foreach($semilattice_array->chunk(1000) as $index => $item) {
            echo $index . ' ';
            CategoryConnection::insert($item->toArray());
        }
    }
}
