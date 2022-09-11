@extends('layouts.student')

@section('content')
<section class="">

    <div class="container">
        <div class="card p-3 my-3">
            <h3>Results</h3>
            <div ><a class="btn btn-link text-danger" href="/welcome">return</a></div>
            <table class="table table-stripped table-hover">
                <head>
                    <tr>
                        <th scope="col">Exam</th>
                        <th scope="col">Score</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </head>

                <tbody>
                    @foreach ($exams as $exam)
                    <tr>
                        <td>{{$exam->exam_id}}</td>
                        <td>{{$exam->score}}</td>
                        <td>{{$exam->datecreated}}</td>
                        <td> <a href="/details/{{$exam->exam_id}}" class="btn btn-success">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>

</section>
@endsection
