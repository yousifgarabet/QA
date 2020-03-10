<div class="row mt-4">
        <div class="col-md-12">
            <div class="media">
                <div class="media-body">
                    <div class="card-title">
                        <h2> {{$answerCount. " ". str_plural('Answer',$answerCount)}}</h2>
                    </div>
                    <hr>
                    @include('layouts._messeges')
                    @foreach($answers as $answer)
                        <div class="media">
                                <div class="d-flex flex-column vote-controls">
                                    <a title="this answer is useful" class="vote-up">
                                        <i class="fas fa-caret-up fa-3x"></i>
                                    </a>
                                    <span class="votes-cuont">1230</span>
                                    <a title="this answer is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                    </a>
                                    <a title="mark this answer as the best answer" class="vote-accepted mt-2">
                                    <i class="fas fa-check fa-2x"></i>
                                    </a>
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class='ml-auto'>
                                            <!--  to check if user is signed in or not -->
                                            @can('update', $answer)
                                                <a href="{{route('questions.answers.edit', [$question->id, $answer->id])}}" class='btn btn-sm btn-outline-info'>Edit</a>
                                            @endcan

                                            <form class='form-delete' method="POST" action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}">
                                                @method('DELETE')
                                                @csrf
                                                @can('delete', $answer)
                                                     <button type='submit' class='btn btn-sm btn-outline-danger' onclick="return confirm('Are you sure?')">Delete</button>
                                                @endcan
                                             </form>
                                        </div>
                                     <div class="col-4"></div>
                                     <div class="col-4">
                                        <span class="text-muted"> Answered {{$question->created_date}}</span>
                                        <div class="media mt-2">
                                            <a href="{{ $answer->user->url}}" class="pr-2">
                                                <img src="{{ $answer->user->avatar}}">
                                            </a>
                                            <div class="media-body mt-1 ">
                                                <a href="{{$answer->user->url}}"> {{ $answer->user->name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
