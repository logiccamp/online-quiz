@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">
        <div class="card my-4 shadow p-3">
           <a href="/admin/students/add">Add New Student</a>
           <div class="my-4">
               <table class="table table-stripped">
                <thead>
                    <tr>
                        <th scope="col">Student Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $user)
                    <tr>
                        <td>
                            <h3>{{$user->name}}</h3>
                        </td>
                        <td>
                            <small ><a class="btn btn-danger" href="/admin/questions/view/">Block </a></small>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
               </table>
           </div>
        </div>
    </div>

</section>
@endsection
