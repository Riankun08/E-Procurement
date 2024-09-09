@extends('layouts.auth.app')
@section('content')
<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('authentications.store') }}" method="POST">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">Sign In to E - Procurement</h1>
        </div>
        <div class="fv-row mb-10">
            <label for="email" class="form-label fs-6 fw-bolder text-dark">Email</label>
            <input id="email" class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
        </div>
        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
            </div>
            <input id="password" class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
        </div>
        <div class="text-center">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100">
                <span class="indicator-label">Sign In</span>
                <span class="indicator-progress">Please Wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
</div>
@endsection
