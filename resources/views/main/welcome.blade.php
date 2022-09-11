@extends('layouts.student')

@section('content')
<section class="">

    <div class="container">
        <div class="card p-3 my-5">
                <div class="text-center alert alert-success">
                    Login Successful
                </div>
                <div class="text-center ">
                    <p> 
                        <strong>
                            Hello <span class="text-danger">{{auth()->user()->name}}</span> Welcome to Test Preparation Portal.
                        </strong>
                    </p>
                </div>


                <div class="div">
                    <div class="alert alert-light">
                        <p>Here are some of the rules and regulations of this app.</p>
                        <ol>
                            <li>
                                This is a preparatory exam for Yabatech post utme exam.
                            </li>
                            <li>
                                This exam is automated and you won't be able to return after you have submitted your exam.
                            </li>

                            <li>
                                We have more than 1000 questions in our Question Bank.
                            </li>

                            <li>
                                After you click on "start exam", the timer will start and it can't be paused or stopped.
                            </li>

                        </ol>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="/start-quiz" class="mx-4 btn btn-success">Take Exam</a>
                        <a href="/results" class="mx-4 btn btn-warning" >Results</a>
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button class="mx-4 btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>

</section>
@endsection
