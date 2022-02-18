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
                        <img src="/storage/{{$post->user->profile_pic}}" width="40" height="40" alt="" class="rounded-circle">
                        <p class="ms-2 pt-2">{{$post->user->name}}</p>
                    </div>
                    <div class="card-body">
                        <img src="/storage/{{$post->image}}" alt="{{$post->caption}}" width="100%"  data-bs-toggle="modal" data-bs-target="#view-post-{{$post->id}}">
                        <p class="fs-4 mt-3" data-bs-toggle="modal" data-bs-target="#view-post-{{$post->id}}">{{$post->caption}}</p>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="view-post-{{$post->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-7">
                                    <img src="/storage/{{$post->image}}" alt="" width="100%" height="100%">
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <p class="fs-4">{{$post->caption}}</p>
                                        <div class="d-flex">
                                            <p>like</p>
                                            <p class="ml-auto">20</p>
                                        </div>
                                        <div class="a">
                                            Comment
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-danger fs-1 mt-5">No posts found!</p>
        @endif
    </div>

@endsection
