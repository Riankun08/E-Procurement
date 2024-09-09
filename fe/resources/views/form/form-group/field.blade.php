<div class="card-body">
    <div class="row">

        <div class="form-group col-md-6 fv-row mb-3">
            <!--begin::Wrapper-->
                <!--begin::Label-->
                <label role="title" class="form-label fw-bolder text-dark fs-6">Title <span class="text-danger">*</span></label>
                <!--end::Label-->
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input type="title" name="title" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->title : '' }}" placeholder="Input title"/>
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
                    <select name="element_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select">
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
                    <select name="formula_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select">
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
                    <input type="sequence" name="sequence" class="form-control form-control-lg form-control-solid" autocomplete="off" value="{{ isset($data) ? $data->sequence : '' }}" placeholder="Input Sequence"/>
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
    <button class="btn btn-primary mr-1" type="submit">Save</button>
</div>
