<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QuestionGroup;
use Illuminate\Http\Request;

class QuestionGroupsController extends Controller
{
    public function get($subject){
        $category = Category::where("title", $subject)->first();
        $groups = QuestionGroup::all()->where("category_id", $category->id);

        return response()->json($groups, 200);
    }

    public function store(Request $request){
        QuestionGroup::create([
            "title" => $request->group_title,
            "category_id" => $request->category_id
        ]);

        return response()->json(true, 200);
    }
}
