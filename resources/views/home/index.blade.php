@extends('layout.app')
@section('content')
    <div class="mx-auto">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
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
        @if($posts->count())
            @foreach($posts as $post)
                <div class="card m-2" style="width: 40rem;">
                    <div class="card-header bg-white border-white d-flex">
                        <img src="/storage/{{$post->user->profile_pic}}" width="40" height="40" alt=""
                             class="rounded-circle">
                        <p class="ms-2 pt-2">{{$post->user->username}}</p>
                    </div>
                    <div class="card-body">
                        <a href="{{route('show', $post->id)}}">
                            <img src="/storage/{{$post->image}}" alt="{{$post->caption}}" width="100%">
                        </a>
                        <div class="mt-1">
                            <div class="d-flex">
                                <form action="{{route('like', $post->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-white ms-2 p-2"><i class="bi bi-heart"></i>
                                    </button>

                                </form>
                                <a href="{{route('show', $post->id)}}" class="btn btn-white ms-2 p-2"><i
                                        class="bi bi-chat"></i></a>
                            </div>
                            <p class="ms-2"><span class="fw-bold">{{$post->likes->count()}}</span> likes</p>
                        </div>
                        <p class="mt-3">
                            {!! nl2br(e(substr($post->caption, 0, 200))) !!} .....
                        </p>
                    </div>
                    <div class="card-footer bg-white">
                        <form action="{{route('comment', $post->id)}}" method="post">
                            @csrf
                            <input type="text" class="form-control" id="comment"
                                   placeholder="comment" name="comment">
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-danger fs-1 mt-5">No posts found!</p>
        @endif
    </div>

@endsection
