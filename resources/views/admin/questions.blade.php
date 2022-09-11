@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">
        <div class="card my-4 shadow p-3">
           <div class="my-4">
               @foreach ($subjects as $subject)
               <div class="alert alert-secondary">
                    <h3>{{$subject->title}}</h3>
                    <a class="btn" href="/admin/questions/view/{{$subject->id}}">View All ({{count($subject->questions)}})</a>
               </div>
               @endforeach
           </div>
        </div>
    </div>

</section>
@endsection
