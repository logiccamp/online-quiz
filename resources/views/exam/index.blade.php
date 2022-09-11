@extends('layouts.student')

@section('content')
<section class="">

    <div class="container">
        <exam-component :user="{{auth()->user()->id}}" :title="{{$subject->id}}" ></exam-component>
    </div>

</section>
@endsection
