@extends('layout.app')
@section('content')
    <div class="mx-auto">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <div class="mb-3">
                            {{$error}}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{$post->image}}" alt="" width="100%">
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="d-flex">
                            <img src="/storage/{{$post->user->profile_pic}}" alt="" class="rounded-circle ms-2"
                                 width="30"
                                 height="30">
                            <p class="ms-2 fw-bold">{{$post->user->username}}</p>
                            <p class="ms-2">Follow</p>
                            @if (Auth::user()->id == $post->user->id)
                                <div class="dropdown">
                                    <button class="btn btn-white ms-4 btn-sm" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <button class="btn btn-sm btn-white" data-bs-toggle="modal"
                                                    data-bs-target="#delete">Delete
                                            </button>
                                        </li>
                                    </ul>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-primary">
                                                    Are you sure you want to delete this post?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <form action="{{route('destroy', $post->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-black">
                            {!! nl2br(e($post->caption)) !!}
                        </div>
                        @if($post->comments->count())
                            @foreach($post->comments as $comment)
                                <div class="d-flex mt-3">
                                    <img src="/storage/{{$comment->user->profile_pic}}"
                                         alt="" class="rounded-circle" height="25" width="25">
                                    <p class="fw-bold ms-2">{{$comment->user->username}}</p>
                                    <p class="ms-2">{{$comment->comment}}</p>
                                </div>
                                <div class="d-flex mt-0">
                                    <p class="ms-2 me-3">{{$comment->created_at->diffForHumans()}}</p>
                                    @if(auth()->user() == $comment->user)
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-white" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <form action="{{route('deleteComment',[$post->id, $comment->id])}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit"><i
                                                            class="bi bi-trash3"></i>
                                                    </button>
                                                </form>
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="card-header bg-white border-top">
                        <div class="d-flex">
                            <form action="{{route('like', $post->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-white ms-2 p-2"><i class="bi bi-heart"></i>
                                </button>

                            </form>
                            <button class="btn btn-white ms-2 p-2"><i class="bi bi-chat"></i></button>
                        </div>
                        <div class="d-flex">
                            <p class="ms-2"><span class="fw-bold">{{$post->likes->count()}}</span> likes</p>
                            <p class="ms-2"><span class="fw-bold">{{$post->comments->count()}}</span> comments</p>

                        </div>
                        <div class="ml-auto">
                            <p class="ms-2">{{$post->created_at->diffForHumans()}}</p>
                        </div>
                        <form action="{{route('comment', $post->id)}}" method="post">
                            @csrf
                            <input type="text" class="form-control" id="comment"
                                   placeholder="comment" name="comment">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
