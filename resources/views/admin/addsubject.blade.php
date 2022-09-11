@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">
        <div class="card my-4 shadow p-3">
           <a class="text-danger" href="/admin/subjects/">return</a>


           <div class="my-4">
                @if(session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                @endif
               <form action="{{route('addSubject')}}" method="POST">
                   @csrf
                   <input name="title" class="form-control" type="text"/>
                   <button type="submit" class="btn btn-success">SUBMIT</button>
                </form>
           </div>
        </div>
    </div>

</section>
@endsection
