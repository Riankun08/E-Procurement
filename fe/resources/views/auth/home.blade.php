@extends('layouts.auth.app')
@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto" style="text-align: center;">
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">Sign In to <span style="color:#f08e48">Vendor</span></h1>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" style="width: 300px;" fill="#f08e48">
                    <path d="M0 488L0 171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4L640 488c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24l0-264c0-17.7-14.3-32-32-32l-384 0c-17.7 0-32 14.3-32 32l0 264c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24zm488 24l-336 0c-13.3 0-24-10.7-24-24l0-56 384 0 0 56c0 13.3-10.7 24-24 24zM128 400l0-64 384 0 0 64-384 0zm0-96l0-80 384 0 0 80-384 0z"/>
                </svg>
                <a href="{{ route('authentications.login.vendor') }}">
                    <div class="text-center mb-10" style="margin-top: 30px">
                        <button class="btn btn-primary">
                            Login Here
                        </button>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto" style="text-align: center;">
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">Sign In to <span style="color:#f08e48">Buyer</span></h1>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 200px" fill="#f08e48">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                </svg>
                <a href="{{ route('authentications.login.buyer') }}">
                    <div class="text-center mb-10" style="margin-top: 30px">
                        <button class="btn btn-primary">
                            Login Here
                        </button>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
