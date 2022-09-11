@extends('layouts.student')

@section('content')
<section class="">

    <div class="container my-5 submit_page">
        <div class="card p-3 text-center">
            <p >Dear <span class="fw-bold">{{auth()->user()->name}}</span>,</p>
            <p class="message">You have successfully completed the exam. Thank You</p>
            <p class="mt-2">You got</p>
            <h3 class="text-danger fw-bold score">{{$exam->score}}/30</h3>
            <div>
                <a href="/details/{{$exam->exam_id}}" class="btn btn-success">View Result</a>
                <a class="btn text-danger" href="/welcome">exit</a>
            </div>
        </div>
    </div>

</section>
@endsection
