@extends('layout.app')
@section('content')
    <div class="">
        <div class="text-center">
            <img width="50%"
                 src="https://www.kuleuven.be/campussen/campus-groep-t-leuven/afbeeldingen/socials_images/instagram-fullwidth.png/image"
                 alt="">
        </div>
        <div class="">
            <p class="text-center fs-1 fw-bold text-primary">Login</p>
            <div class=" mx-auto w-50">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <form class="mx-auto w-50" action="{{route('register')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" required id="exampleInputEmail1"
                           aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary mb-3">Register</button>
                <p class="">Already Have an Account. <a href="{{route('login')}}">Login Here!</a></p>
            </form>
        </div>
    </div>
@endsection
