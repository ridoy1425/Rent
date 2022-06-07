@extends('ui.admin_panel.master')

@section('title','Edit contract')

@section('style')
<style>
    .display {
        display: none;
    }

    .unitCreate {
        margin-top: 39px;
    }

</style>
@endsection

@section('content_title', 'Property Contract')

@section('main_content')
<div class="row page-content">
    <div class="container">
        {{-- message alert --}}
        <div class="alert_message mt-5">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0rem;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success" role="success">
                {{ Session::get('success') }}
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger" role="success">
                {{ Session::get('error') }}
            </div>
            @endif
        </div>
        <form action="/contractStore" method="post" enctype="multipart/form-data">
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Tenat Information</h6>
                        <div class="mb-3">
                            <label for="tenantName" class="form-label">Select Tenant</label>
                            <select class="form-select" id="tenantName" name="tenantName" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($tenant as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="propertyContent">
                        <h6>Property Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="propertyName" class="form-label">Select Property</label>
                                    <select class="form-select" id="propertyName" name="propertyName" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($property as $row)
                                        <option value="{{ $row->id }}">{{ $row->propertyName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check unitCreate">
                                    <input class="form-check-input" type="checkbox" value="1" id="unitCreate"
                                        name="unitCreate">
                                    <label class="form-check-label" for="unitCreate">
                                        Rent Unit
                                    </label>
                                </div>
                            </div>
                        </div>                        
                        <div class="mb-3 display" id="unit">
                            <label for="unitName" class="form-label">Select Unit</label>
                            <select class="form-select" id="unitName" name="unitName">
                            </select>
                        </div>
                    </div>
                    <div class="propertyContent">
                        <h6>Contract Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Payment Deadline</label>
                                    <select class="form-select" id="deadline" name="deadline" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value="1">Everyday</option>
                                        <option value="5">Five Days</option>
                                        <option value="10">Ten Days</option>
                                        <option value="15">Fifteen Days</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="document" class="form-label">Contract Document(Optional)</label>
                                    <input type="file" class="form-control" id="document" name="document">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="frequency" class="form-label">Payment Frequency</label>
                                    <select class="form-select" id="frequency" name="frequency" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value="1">Daily</option>
                                        <option value="7">Weekly</option>
                                        <option value="31">Monthly</option>
                                        <option value="365">Yearly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" mx-auto mb-5">
                    <button class="btn btn-warning" type="submit">Contract</button>
                </div>
            </div>
            {{-- card-body end --}}
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {

        // unit create checkbox
        $('#unitCreate').on('click', function () {
            if ($(this).prop("checked") == true) {
                $('#unit').show();
            } else if ($(this).prop("checked") == false) {
                $('#unit').hide();
            }
        });
        // get unit on change peopertName 
        $('#propertyName').on('change', function () {
            if ($(this).val()) {
                var propertyId = $(this).val();
                $.ajax({
                    url: "{{url('/unitSearch')}}",
                    type: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        propertyId: propertyId,
                    },
                    success: function (data) {
                        console.log(data);
                        $("#unitName").empty();
                        $(`<option disabled selected value="">Select</option>`).appendTo(
                            "#unitName");
                        $.each(data, function (key, value) {
                            $("#unitName").append(`<option value="` + value
                                .id + `">` + value.unitName + `</option>`)
                        });
                    }
                });
            }
        });

        // facilities works
        $('#facilitiesValue').on('click', '#Gas', function () {
            if ($(this).prop("checked") == true) {
                $('.Gas').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Gas').show();
            }
        });

        $('#facilitiesValue').on('click', '#Water', function () {
            if ($(this).prop("checked") == true) {
                $('.Water').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Water').show();
            }
        });

        $('#facilitiesValue').on('click', '#Electicity', function () {
            if ($(this).prop("checked") == true) {
                $('.Electicity').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Electicity').show();
            }
        });

        $('#facilitiesValue').on('click', '#Garage', function () {
            if ($(this).prop("checked") == true) {
                $('.Garage').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Garage').show();
            }
        });

        $('#facilitiesValue').on('click', '#Elevator', function () {
            if ($(this).prop("checked") == true) {
                $('.Elevator').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Elevator').show();
            }
        });

        $('#facilitiesValue').on('click', '#Guard', function () {
            if ($(this).prop("checked") == true) {
                $('.Guard').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Guard').show();
            }
        });

        // on button click other bill add option
        var html = `<div id="moreBill">
                    <input class="btn btn-danger  float-right rounded-circle mt-4" type="button" name="remove_btn" id="remove_btn" value="x">
                    <div class="row">
                        <div class="col">
                            <label for="otherBillName" class="form-label">Bill Name</label>
                            <input type="text" class="form-control" id="otherBillName" name="otherBillName[]">
                        </div>
                        <div class="col">
                            <label for="otherBillAmount" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="otherBillAmount" name="otherBillAmount[]">
                        </div>
                    </div>
                     </div><br>`;
        $("#addBill").click(function () {
            $("#otherBill").append(html);
        });
        $("#otherBill").on('click', '#remove_btn', function () {
            $(this).parent('div').remove();
        });

    });

</script>
@endsection
