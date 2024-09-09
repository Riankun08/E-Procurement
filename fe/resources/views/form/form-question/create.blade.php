@extends('layouts.dashboard.app')
@section('title', 'Form Group')
@section('subtitle' , 'Add ' . 'Form Group'  . ' > ' . $forms->title)
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
            <form method="POST" action="{{ route($route.'group.store' , $form_id) }}" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                @csrf
                @include($view.'form-group.field')
            </form>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection
