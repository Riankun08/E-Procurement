@extends('layouts.dashboard.app')
@section('title', 'Form Group')
@section('subtitle' , 'Setting ' . 'Form Group' . ' > ' . $data->title)
@section('head')
@endsection
@section('script')
@endsection
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <div class="row">
            <!--begin::Card-->
            <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                <!--begin::Card body-->
                <form method="POST" action="" class="needs-validation" id="xss-validation" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-md-6 fv-row mb-3">
                                <!--begin::Wrapper-->
                                    <!--begin::Label-->
                                    <label role="title" class="form-label fw-bolder text-dark fs-6">Title <span class="text-danger">*</span></label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input type="title" name="title" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->title : '' }}" placeholder="Input title" readonly />
                                        @error('title')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                        @enderror
                                    </div>
                                <!--end::Wrapper-->
                            </div>

                            <div class="form-group col-md-6 fv-row mb-3">
                                <!--begin::Wrapper-->
                                    <!--begin::Label-->
                                    <label role="element_id" class="form-label fw-bolder text-dark fs-6">Element <span class="text-danger">*</span></label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <select name="element_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select" disabled>
                                            <option></option>
                                            @foreach ($elements as $elems)
                                                <option value="{{ $elems->id }}" {{ isset($data) && $data->element_id == $elems->id ? 'selected' : '' }}>
                                                    {{$elems->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('element_id')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                        @enderror
                                    </div>
                                <!--end::Wrapper-->
                            </div>

                            <div class="form-group col-md-6 fv-row mb-3">
                                <!--begin::Wrapper-->
                                    <!--begin::Label-->
                                    <label role="formula_id" class="form-label fw-bolder text-dark fs-6">Matrix <span class="text-danger">*</span></label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <select name="formula_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select" disabled>
                                            @foreach ($formulas as $forms)
                                                <option></option>
                                                <option value="{{ $forms->id }}" {{ isset($data) && $data->formula_id == $forms->id ? 'selected' : '' }}>{{$forms->matrix}}</option>
                                            @endforeach
                                        </select>
                                        @error('formula_id')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                        @enderror
                                    </div>
                                <!--end::Wrapper-->
                            </div>


                            <div class="form-group col-md-6 fv-row mb-3">
                                <!--begin::Wrapper-->
                                    <!--begin::Label-->
                                    <label role="sequence" class="form-label fw-bolder text-dark fs-6">Sequence <span class="text-danger">*</span></label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input type="sequence" name="sequence" class="form-control form-control-lg form-control-solid" readonly autocomplete="off" value="{{ isset($data) ? $data->sequence : '' }}" placeholder="Input Sequence"/>
                                        @error('sequence')
                                        <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{$message}} !</p>
                                        @enderror
                                    </div>
                                <!--end::Wrapper-->
                            </div>

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route($route.'show' , isset($form_id) ? $form_id : $data->form_id) }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
                <!--end::Card body-->
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-10 mb-lg-0">
                            <!--begin::Description-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <h4 class="fs-1 text-gray-800 w-bolder mb-6">UI/UX Designer</h4>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <p class="fw-bold fs-4 text-gray-600 mb-2">First, a disclaimer – the entire process of writing a blog post often takes more than a couple of hours, even if you can type eighty words as per minute and your writing skills are sharp.</p>
                                <!--end::Text-->
                            </div>
                            <!--end::Description-->
                            <!--begin::Accordion-->
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_2_1">
                                    <!--begin::Icon-->
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                        <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                        <span class="svg-icon toggle-off svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Requirements</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="kt_job_2_1" class="collapse show fs-6 ms-1">
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with REST API</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Git knowledge is a plus</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_2_2">
                                    <!--begin::Icon-->
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                        <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                        <span class="svg-icon toggle-off svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">What is your job role?</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="kt_job_2_2" class="collapse fs-6 ms-1">
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with REST API</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Git knowledge is a plus</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_2_3">
                                    <!--begin::Icon-->
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                        <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                        <span class="svg-icon toggle-off svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Job Candidate Benefits</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="kt_job_2_3" class="collapse fs-6 ms-1">
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with REST API</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Git knowledge is a plus</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_2_4">
                                    <!--begin::Icon-->
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                        <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                        <span class="svg-icon toggle-off svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Application Terms</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="kt_job_2_4" class="collapse fs-6 ms-1">
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10 mb-n1">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Experience with REST API</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-4">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center ps-10">
                                            <!--begin::Bullet-->
                                            <span class="bullet me-3"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-600 fw-bold fs-6">Git knowledge is a plus</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Section-->
                            <!--end::Accordion-->
                        </div>
                    </div>
                </div>
            <!--end::Card-->
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>
@endsection
