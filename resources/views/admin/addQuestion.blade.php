@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">
        <div class="card my-4 shadow p-3">
            <div class="my-3">
                <h3>ADD QUESTION</h3>
            </div>

            <add-question :subject="{{$subject}}"></add-question>
        </div>
    </div>

</section>
@endsection

