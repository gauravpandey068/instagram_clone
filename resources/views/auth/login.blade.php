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
            <form class="mx-auto w-50" action="{{route('login')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" required id="exampleInputEmail1"
                           aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Login</button>
                <p class="">Dont Have an Account. <a href="{{route('register')}}">Register Here!</a></p>
            </form>
        </div>
    </div>
@endsection
