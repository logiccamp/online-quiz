@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">
        <div class="card my-4 shadow p-3">
           <a class="text-danger" href="/admin/subjects/">return</a>


           <div class="my-4">
           @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
               <form action="{{route('AddstudentStore')}}" method="POST">
                   @csrf
                   <div class="my-3">
                       <label for="">Student Name</label>
                       <input name="name" class="form-control" type="text" placeholder="Student Fullname" />
                   </div>
                   <div class="my-3">
                        <label for="">Student Email</label>
                       <input name="email" class="form-control" type="email" placeholder="Student Email Address"/>
                   </div>
                   <div class="my-3">
                        <label for="">Student No.</label>
                       <input name="jambNo" class="form-control" type="text" placeholder="Jamb No"/>
                   </div>
                   <div class="my-3">
                        <label for="">Password</label>
                       <input name="password" class="form-control" type="text" placeholder="Simple type student surname"/>
                   </div>
                   @if (auth()->user()->name == 'Logic')
                   <input name="role" class="form-control" value="student" type="text" placeholder=""/>
                   @else
                   <input name="role" hidden class="form-control" value="student" type="text" placeholder=""/>
                   @endif
                   <button type="submit" class="btn btn-success">SUBMIT</button>
                </form>
           </div>
        </div>
    </div>

</section>
@endsection
