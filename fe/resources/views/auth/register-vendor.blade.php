@extends('layouts.auth.app')
@section('content')
<div class="w-lg-800px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
    <div class="text-center mb-10">
        <h1 class="text-dark mb-3">Register Vendor</h1>
    </div>
    <div class="fv-row mb-10">
        <label for="email" class="form-label fs-6 fw-bolder text-dark">Email</label>
        <input id="email" class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
        </div>
        <input id="password" class="form-control form-control-lg form-control-solid" type="text" name="password" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Password Confirmation</label>
        </div>
        <input id="password_confirmation" class="form-control form-control-lg form-control-solid" type="text" name="password_confirmation" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Name</label>
        </div>
        <input id="name" class="form-control form-control-lg form-control-solid" type="text" name="name" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Phone</label>
        </div>
        <input id="phone" class="form-control form-control-lg form-control-solid" type="text" name="phone" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Province</label>
        </div>
        <select class="select form-control form-control-lg form-control-solid" name="select" id="province-select">
            <option value="#" selected disabled>Pilih Provinsi</option>
        </select>
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">City</label>
        </div>
        <select class="select form-control form-control-lg form-control-solid" name="select" id="city-select">
            <option value="#" selected disabled>Pilih City</option>
        </select>
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Address</label>
        </div>
        <textarea id="address" class="form-control form-control-lg form-control-solid" type="text" name="address" autocomplete="off" /></textarea>
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">NPWP</label>
        </div>
        <input id="npwp" class="form-control form-control-lg form-control-solid" type="text" name="npwp" autocomplete="off" />
    </div>
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">NPWP Name</label>
        </div>
        <input id="npwp_name" class="form-control form-control-lg form-control-solid" type="text" name="npwp_name" autocomplete="off" />
    </div>  
    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">NPWP Address</label>
        </div>
        <textarea id="npwp_address" class="form-control form-control-lg form-control-solid" type="text" name="npwp_address" autocomplete="off" /></textarea>
    </div>
    <div class="text-center">
        <button type="button" id="submit" class="btn btn-lg btn-primary w-100">
            <span class="indicator-label">Register</span>
            <span class="indicator-progress">Please Wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.get('http://localhost:9000/provincies', function(data) {
                const provinceSelect = $('#province-select');
                data.data.forEach(province => {
                    provinceSelect.append(new Option(province.name, province.id));
                });
            }).fail(function() {
                console.error("Error retrieving provinces.");
            });
            $('#province-select').on('change', function() {
                const selectedProvinceId = $(this).val();
                if (selectedProvinceId !== "#") {
                    console.log('Selected Province ID:', selectedProvinceId);
                    $.get(`http://localhost:9000/cities?provinceId=${selectedProvinceId}`, function(data) {
                        const citySelect = $('#city-select');
                        citySelect.empty();
                        citySelect.append('<option value="#" selected disabled>Pilih City</option>');
                        data.data.forEach(city => {
                            citySelect.append(new Option(city.name, city.id));
                        });
                    }).fail(function() {
                        console.error("Error retrieving cities.");
                    });
                }
            });
            $('#city-select').on('change', function() {
                const selectedCityValue = $(this).val();
                const selectedCityText = $(this).find('option:selected').text();
                if (selectedCityValue !== "#") {
                    console.log('Selected City ID:', selectedCityValue);
                    console.log('Selected City Name:', selectedCityText);
                }
            });
            $('#submit').on('click', function() {
                const formData = {
                    type: 'vendor',
                    email: $('#email').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    provinceId: $('#province-select').val(),
                    citiesId: $('#city-select').val(),
                    address: $('#address').val(),
                    npwp: $('#npwp').val(),
                    npwp_name: $('#npwp_name').val(),
                    npwp_address: $('#npwp_address').val()
                };
                $.post('http://localhost:9000/auth/register', formData)
                    .done(function(response) {
                        console.log('Success:', response);
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    });
            });
        });

    </script>
@endsection

