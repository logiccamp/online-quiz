@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">
        <div class="card my-4 shadow p-3">
            <div class="my-3">
                <h3>UPDATE QUESTION</h3>
                <a class="text-danger" href="/admin/questions">return</a>
            </div>
            <edit-question :thisquestion="{{$question}}"></edit-question>
        </div>
    </div>

</section>
@endsection

