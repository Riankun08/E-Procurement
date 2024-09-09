@extends('layouts.dashboard.app')
@section('title', 'Form Group')
@section('subtitle' , 'Edit ' . 'Form Group' . ' > ' . $forms->title)
@section('head')
@endsection
@section('script')
@endsection
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <form method="POST" action="{{ route($route.'group.update' , e($data->id)) }}" class="needs-validation" id="xss-validation"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include($view.'form-group.field')
            </form>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection
