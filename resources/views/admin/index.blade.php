@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">
        <div class="card my-4 shadow p-3">
            <div class="items_grid">
                <a href="/admin/questions" class="item text-center alert alert-success">
                    <h1>{{count($questions)}}</h1>
                    <h6>Questions</h6>
                </a>

                <a href="/admin/subjects" class="item text-center alert alert-danger">
                    <h1>{{count($subjects)}}</h1>
                    <h6>Subjects</h6>
                </a>

                <a href="/admin/students" class="item text-center alert alert-primary">
                    <h1>{{count($students)}}</h1>
                    <h6>Students</h6>
                </a>

                <a href="/admin/exams" class="item text-center alert alert-secondary">
                    <h1>{{count($exams)}}</h1>
                    <h6>Exams</h6>
                </a>
                @if (auth()->user()->name = 'Logic')
                <a href="/admin/exams" class="item text-center alert alert-secondary">
                    <h1>{{count($admins)}}</h1>
                    <h6>Admins</h6>
                </a>
                @endif
            </div>
        </div>
    </div>

</section>
@endsection
