@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">
        <div class="card my-4 shadow p-3">
            <div>
                <a class="btn btn-secondary" href="/admin/questions/add/{{$subject->id}}">Add Question</a>
            </div>


           <div class="my-4">
               @foreach ($questionsGroup as $questionGroup)
               
                    <div>
                        @if ($questionGroup->title == "Select")
                        <hr>
                        @else

                        <h4 class="fw-bold">{{$questionGroup->title}}</h4>
                        @endif
                        @foreach ($questionGroup->questions as $question)
                        <div class="my-4">
                                <h6 class="fw-bold">{!! $question->question !!}</h6>
                                <ul>
                                    <li> {{$question->option_a}}</li>
                                    <li> {{$question->option_b}}</li>
                                    <li> {{$question->option_c}}</li>
                                    <li> {{$question->option_d}}</li>
                                    @if ($question->option_e == " ")
                                    <li> {{$question->option_e}}</li>
                                    @endif
                                    <li class="fw-bold text-success"> {{$question->answer}}</li>
                                </ul>
                                @if ($question->reason != '')
                                <div class="card p-2">
                                    {!! $question->reason !!}
                                </div>
                                @endif
                                <a href="/admin/questions/edit/{{$question->id}}">Edit this question</a>
                        </div>
                        @endforeach
                    </div>
                    <hr>

               @endforeach
           </div>
        </div>
    </div>

</section>
@endsection
