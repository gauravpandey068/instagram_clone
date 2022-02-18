@extends('layout.app')
@section('content')
    <div class="row mb-5">
        <div class="col-2">
            <img src="/storage/{{auth()->user()->profile_pic}}" alt="" class="rounded-circle" width="150" height="150"
                 data-bs-toggle="modal" data-bs-target="#updateProfilePic">
        </div>
        <div class="col">
            <div class="d-flex p-3">
                <div class="fw-bold fs-4">{{auth()->user()->name}}</div>
                <button class="btn btn-light ms-4 border-dark" data-bs-toggle="modal" data-bs-target="#editProfile">
                    Edit Profile
                </button>
                <div class="dropdown">
                    <button class="btn btn-white ms-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="bi bi-gear-wide"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <p class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePassword">Change
                                Password</p>
                        </li>
                        <li>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-white dropdown-item">logout</button>
                            </form>

                        </li>
                    </ul>
                </div>
            </div>
            <div class="d-flex mt-5">
                <div class="p-3"><span class="fw-bold">{{$posts->count()}}</span> posts</div>
                <div class="p-3"><span class="fw-bold">100</span> followers</div>
                <div class="p-3"><span class="fw-bold">10</span> following</div>
            </div>
            <!-- Modal Edit Profile -->
            <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfile"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('changeProfile')}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control"
                                           id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="InputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" value="{{auth()->user()->email}}"
                                           class="form-control" id="InputEmail1"
                                           aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal  Change Password-->
            <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePassword"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form action="{{route('changePassword')}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control"
                                           id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal update profile pic -->
            <div class="modal fade" id="updateProfilePic" tabindex="-1" aria-labelledby="updateProfilePic"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Profile Picture</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('updateProfilePic')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <img src="/storage/{{auth()->user()->profile_pic}}" alt="{{auth()->user()->name}}" class="rounded-circle" width="100%">
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Profile Picture</label>
                                    <input class="form-control form-control-sm" id="formFileSm" type="file"
                                           name="profile_pic">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <hr>
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
        <div class="row mt-4">
            @foreach($posts as $post)
                <div class="card m-2" style="width: 20rem; height: 18rem;">
                    <div class="card-body p-0 m-0">
                        <img src="/storage/{{$post->image}}" alt="{{$post->caption}}" width="100%" height="270">
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-danger fs-1 mt-5">No posts found!</p>
    @endif


@endsection
