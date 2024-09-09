@extends('layouts.dashboard.app')
@section('title', $title ?? 'Form Dynamic')
@section('subtitle' , 'Setting ' . $title)
@section('head')
@endsection
@section('script')
@include('form.form-group.datatable.script')
@endsection

@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">

        <!--begin::Card-->
        <div class="card mb-5">
            <!--begin::Card body-->
            <form method="POST" action="#" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label for="title" class="form-label fw-bolder text-dark fs-6">Title</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="title" name="title" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->title : '' }}" readonly/>
                                    @error('title')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label for="type" class="form-label fw-bolder text-dark fs-6">Type</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="type" name="type" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->type : '' }}" readonly/>
                                    @error('type')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                        <div class="form-group col-md-6 fv-row mb-3">
                            <!--begin::Wrapper-->
                                <!--begin::Label-->
                                <label for="category" class="form-label fw-bolder text-dark fs-6">Category</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input type="category" name="category" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data->category) ? $data->category->name : '' }}" readonly/>
                                    @error('category')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                            <!--end::Wrapper-->
                        </div>

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route($route.'index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

        <!--begin::Table Form Group -->
        @include('form.form-group.index')
        <!--end::Table Form Group -->

    </div>

    <!--end::Container-->
</div>
@endsection
