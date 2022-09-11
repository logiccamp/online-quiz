<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionGroup;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Category::all();
        return view("admin.questions", ["subjects" => $subjects]);
    }
    public function subjects()
    {
        $subjects = Category::all();
        return view("admin.subjects", ["subjects" => $subjects]);
    }

    public function viewquestions($id)
    {
        $subject = Category::where("id", $id)->first();
        $questionGroups = QuestionGroup::where("category_id", $subject->id)->orderBy("id", "DESC")->get();
        return view("admin.viewquestions", [
            "questionsGroup" => $questionGroups,
            "subject" => $subject,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view("admin.addQuestion", ["subject"=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionById($id){
        $question = Question::where("id", $id)->first();
        return response()->json($question, 200);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'option_d' => 'required',
            'group_id' => '',
            'option_e' => '',
            'subject' => 'required',
            'answer' => 'required',
        ]);

        $groupid = '';
        $subject = Category::where("title", $request->subject)->first();
        if ($request->group_id == ""){
            $groupid = QuestionGroup::where("title", "Select")->where("category_id", $subject->id)->first();
        }
        
        $question = Question::create([
            "question" => $request->question,
            "option_a" => $request->option_a,
            "option_b" => $request->option_b,
            "option_c" => $request->option_c,
            "option_d" => $request->option_d,
            "option_e" => $request->option_e,
            "category" => $request->subject,
            "answer" => $request->answer,
            "reason" => $request->reason,
            "group_id" => $request->group_id == "" ? $groupid->id : $request->group_id,
        ]);
        
        if ($question){
            return response()->json(true, 200);
        }else{
            return response()->json(false, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question)
    {
        $question = Question::where("id", $question)->first();
        return view("admin.editquestion", ["question"=>$question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'option_d' => 'required',
            'group_id' => '',
            'option_e' => '',
            'subject' => 'required',
            'answer' => 'required',
        ]);

        $groupid = '';
        $subject = Category::where("title", $request->subject)->first();
        if ($request->group_id == ""){
            $groupid = QuestionGroup::where("title", "Select")->where("category_id", $subject->id)->first();
        }


        
        $question = Question::where("id", $id)->first();

        $question->question = $request->question;
        $question->option_a = $request->option_a;
        $question->option_b = $request->option_b;
        $question->option_c = $request->option_c;
        $question->option_d = $request->option_d;
        $question->option_e = $request->option_e;
        $question->category = $request->subject;
        $question->answer = $request->answer;
        $question->reason = $request->Reason;
        $question->group_id = $request->group_id == "" ? $groupid->id : $request->group_id;

        $question->save();
        return response()->json(true, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
