@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container w-50 m-auto align-items-center justify-content-center mt-5">
        <div class="card">
            <img src="https://avrillo.co.uk/wp-content/uploads/2021/05/avrillo-logo.svg" class="card-img-top mt-3" alt="AVRillo" style="height: 80px;">

            <div class="card-body">
                <h5 class="card-title">Your account is activated!</h5>

                <a href="{{ route('logout') }}" class="float-end">Logout</a>
            </div>
        </div>
    </div>
@endsection
