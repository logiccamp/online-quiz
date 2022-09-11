@extends('layouts.admin')

@section('content')
<section class="">

    <div class="container">

        <div class="card my-4 shadow p-3">
           <a href="/admin/subject/add">Add Subject</a>


           <div class="my-4">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">Subject</th>
                            <th scope="col">View</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($subjects as $subject)
                        <tr>
                            <td>
                                {{$subject->title}}
                            </td>
                            <td>
                                <a class="btn" href="/admin/questions/view/{{$subject->id}}">view</a>
                            </td>
                            <td>
                                <form action="{{ route('updateQuestion', $subject->id) }}" method="post">
                                    @csrf
                                @if ($subject->isList)
                                <input type="text" value="Unlist" hidden name="status" />
                                <button class="btn btn-danger" type="submit">UnList Subject</button>
                                @else
                                <input type="text" value="List" hidden name="status" />
                                <button class="btn btn-success" type="submit">List Subject</button>
                                @endif
                                </form>
                            </td>
                        </tr>
                         @endforeach
                    </tbody>
                </table>
               <ul>
               </ul>
           </div>
        </div>
    </div>

</section>
@endsection
