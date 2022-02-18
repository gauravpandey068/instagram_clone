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
                                            <p class="dropdown-item">Edit</p>
                                        </li>
                                        <li>
                                            <form action="{{route('destroy', $post->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item btn btn-white btn-sm" type="submit">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-black">
                            {!! nl2br(e($post->caption)) !!}
                        </div>
                        <div class="d-flex mt-3">
                            <img src="" alt="">
                            <p class="fw-bold ms-2">Ram</p>
                            <p class="ms-2">Comments</p>
                        </div>
                        <p class="ms-2 mt-0 ">2h</p>
                    </div>
                    <div class="card-header bg-white border-top">
                        <div class="d-flex">
                            <button class="btn btn-white ms-2 p-2"><i class="bi bi-heart"></i></button>
                            <button class="btn btn-white ms-2 p-2"><i class="bi bi-chat"></i></button>
                        </div>
                        <div class="d-flex">
                            <p class="ms-2"><span class="fw-bold">2</span> likes</p>
                            <p class="ms-2"><span class="fw-bold">3</span> comments</p>

                        </div>
                        <div class="ml-auto">
                            <p class="ms-2">{{$post->created_at->diffForHumans()}}</p>
                        </div>
                        <form action="" method="post">
                            <input type="text" class="form-control" id="comment"
                                   placeholder="comment">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
