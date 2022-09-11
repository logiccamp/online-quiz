<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\ExamSessionGroup;
use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($title)
    {
        $subject = Category::where("title", $title)->first();
        if(!auth()->check()) return redirect("/");
        if(auth()->user()->role == 'admin') return redirect("/admin");
        return view("exam.index", ["subject" => $subject]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($examid)
    {
        if(!auth()->check()) return redirect("/");
        if(auth()->user()->role == 'admin') return redirect("/admin");

        $exam = Exam::where("exam_id", $examid)->first();
        $exam->status = "close";
        
        $examQuestions = ExamSession::with("question")->where("exam_id", $exam->id)->get();
        $score = 0;
        foreach ($examQuestions as $question) {
            $studentPick = $question->answer;
            $answer = $question->question->answer;
            if($studentPick == $answer){
                $score ++;
            }
        }


        $exam->score = $score;
        $exam->save();

        return view("exam.submit", ["exam" => $exam]);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!auth()->check()) return redirect("/");
        if(auth()->user()->role == 'admin') return redirect("/admin");
        return view("exam.details");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::where("id", $id)->first();
        $examQuestions = ExamSession::where("exam_id", $id)->get();

        foreach ($examQuestions as $question) {
            $question->delete();
        }
        
        $exam->delete();
        return response()->json(true, 200);
    }
    
    public function getQuestions($user, $title){
        $data = [];
        $category = Category::where("id", $title)->first();
        
        $questionGroups = QuestionGroup::with("category")->where("category_id", $title)->get();
        $groups = [];
        foreach ($questionGroups as $group) {
            array_push($groups, $group);
        }
        
        $questions = Question::all()->where("category", $category->title)->shuffle()->take(30);
        
        $endTime = Carbon::now()->addMinutes(30);

        $exam = Exam::create([
            "exam_id" => substr(str_shuffle("1234567890"), 0, 50),
            "student_id" => $user,
            "end_time" => $endTime,
            "time_left" => "30:00",
            "status" => "open",
            "score" => "0",
            "total_question" => "30",
        ]);
        $exam_created = date_create($exam->created_at)->format("h:i A");
        $exam["exam_created"] = $exam_created;
        // use carbon to sub the time
        $ddate = Carbon::createFromDate(date_create_from_format("i:s", $exam->time_left));

        // break it to string
        $min = $ddate->format("i");
        $sec = $ddate->format("s");

        // update exam tile 
        $exam["total_sec"] = $min * 60 + $sec;
        
        $data["exam"] = $exam ? $exam : null;

        for ($i=0; $i < $questions->count(); $i++) { 
            ExamSession::create([
                "exam_id" => $exam->id,
                "question_number" => $i + 1,
                "question_id" => $questions[$i]->id,
            ]);
        }

        $examQuestions = ExamSession::with("question")->where("exam_id", $exam->id)->get();

        $data["student"] = User::where("id", $user)->first();
        $data["exam_questions"] = $examQuestions;

        shuffle($groups);

        // save groups
        for ($i=0; $i < count($groups); $i++) { 
            ExamSessionGroup::create([
                "exam_id" =>$exam->id,
                "group_id" => $groups[$i]->id,
                "title" => $groups[$i]->title,
                
            ]);
        }
        // 
        $data["groups"] = $groups;
        return response()->json($data, 200);
    }

    public function getExam($user, $examid){
        $data =[];
        $exam = Exam::where("id", $examid)->first();
        if ($exam == null || !$exam){
            $data["exam"] = null;
            return response()->json($data, 200);
        }

        $groups = [];
        $questionGroups = ExamSessionGroup::where("exam_id", $exam->id)->get();
        foreach ($questionGroups as $group) {
            array_push($groups, $group);
        }
        // suffle it
        $exam_created = date_create($exam->created_at)->format("h:i A");

        // use carbon to sub the time
        $ddate = Carbon::createFromDate(date_create_from_format("i:s", $exam->time_left));

        // break it to string
        $min = $ddate->format("i");
        $sec = $ddate->format("s");

        // update exam tile 
        $exam["total_sec"] = $min * 60 + $sec;

        $exam["exam_created"] = $exam_created;
        $examQuestions = ExamSession::with("question")->where("exam_id", $exam->id)->get();
        $data["exam"] = $exam ? $exam : null;
        $data["student"] = User::where("id", $user)->first();
        $data["exam_questions"] = $examQuestions;
        $data["groups"] = $groups;
        return response()->json($data, 200);
    }


    public function answer($question, $option, $examid){
        $question = ExamSession::where("id", $question)->first();
        $question->answer = $option == '0' ? '' : $option;
        $question->save();

        $examQuestions = ExamSession::with("question")->where("exam_id", $examid)->get();
        $data["exam_questions"] = $examQuestions;
        return response()->json($data, 200);
    }

    public function updateTime ($current, $examId){
        // get Exam
        $exam = Exam::where("id", $examId)->first();

        // use carbon to sub the time
        $ddate = Carbon::createFromDate(date_create_from_format("i:s", $current));
        $ddate->subSecond();

        // break it to string
        $min = $ddate->format("i");
        $sec = $ddate->format("s");
        $timeLeft = $min.":".$sec;

        // update exam tile 
        $exam->time_left = $timeLeft;
        $exam->save();
        
        $data = [
            "time_left" => $timeLeft,
            "total_sec" => $min * 60 + $sec,
        ];

        return response()->json($data, 200);

    }


    public function getdetails (Request $request){
        // trim pathname to get the exam id
        $examid = str_replace("/details/", "", $request->pathname);

        $exam = Exam::with("Student")->where("exam_id", $examid)->where("status", "close")->first();
        if (!$exam || $exam == null){
            return response()->json(["exam"=>null], 200);
        }
        $examQuestions = ExamSession::with("question")->where("exam_id", $exam->id)->get();
        $data = ["exam"=>$exam, "exam_questions"=>$examQuestions];
        return response()->json($data, 200);
    }

    public function results(){
        if(!auth()->check()) return redirect("/");
        $exams = Exam::where("student_id", auth()->user()->id)->where("status", "close")->get();
        foreach ($exams as $exam ) {
            $datecreated = $exam->created_at;
            $datecreated = Carbon::createFromDate($datecreated);
            $exam['datecreated'] = $datecreated->diffForHumans();

        }
        return view("exam.results", ["exams"=>$exams]);
    }
}
