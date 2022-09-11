@extends('layouts.student')

@section('content')
<section class="">

    <div class="container">
        <exam-details :user="{{auth()->user()->id}}" ></exam-details>
    </div>

</section>
@endsection
