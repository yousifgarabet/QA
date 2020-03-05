@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
                <div class="card-header">
                    <div class='d-flex align-items-center'>
                        <h2>All Questions</h2>
                        <div class='ml-auto'>
                            <a href="{{route('questions.create')}}" class='btn btn-outline-secondary'> Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messeges')
                   @foreach ($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class='vote'>
                                    <strong> {{$question->votes}}</strong> {{str_plural('vote', $question->votes)}}
                                </div>
                                <div class='status {{$question->status}}'>
                                    <strong> {{$question->answers}}</strong> {{str_plural('answer', $question->answers)}}
                                </div>
                                <div class='view'>
                                    {{$question->views . " ". str_plural('view', $question->views)}}
                                </div>
                            </div>
                                <div class='media-body'>
                                <div class="d-flex align-items-center ">
                                     <h3 class='mt-0'> <a  href="{{$question->url}}" > {{$question->title}} </a></h3>
                                     <div class='ml-auto'>
                                         <!--  to check if user is signed in or not -->
                                         @can('update', $question)
                                            <a href="{{route('questions.edit', $question->id)}}" class='btn btn-sm btn-outline-info'>Edit</a>
                                         @endcan

                                         <form class='form-delete' method="POST" action="{{route('questions.destroy', $question->id)}}">
                                           @method('DELETE')
                                           @csrf
                                           @can('delete', $question)
                                                 <button type='submit' class='btn btn-sm btn-outline-danger' onclick="return confirm('Are you sure?')">Delete</button>
                                           @endcan
                                       </form>
                                     </div>
                                </div>
                                    <p class='lead'>
                                    Asked by
                                    <a hred="{{$question->user->url}}"> {{$question->user->name}} </a>
                                    <small class='text-muted'> {{$question->created_date}}</small>
                                    </p>
                                    {{str_limit($question->body,255)}}

                                </div>
                        </div>
                   <hr>
                   @endforeach
                   <div class='text-center'>
                   {{$questions->links()}}
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
