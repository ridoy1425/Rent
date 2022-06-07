@extends('ui.admin_panel.master')

@section('title','Create Unit')

@section('style')
<style>
    .display {
        display: none;
    }
    .unitCreate{
        margin-top:39px;
        margin-bottom: 31px;
    }

</style>
@endsection

@section('content_title', 'Create Unit')

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
        <form action="/createUnit" method="post">
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Property Unit Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="propertyName" class="form-label">Property Name</label>
                                    <select class="form-select" id="propertyName" name="propertyName" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($property as $row)
                                        <option value="{{ $row->id }}">{{ $row->propertyName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 display" id="unit">
                                    <label for="unitName" class="form-label">Flat/Shop/Unit Name</label>
                                    <input type="text" class="form-control" id="unitName" name="unitName">
                                </div>
                                <div class="mb-3">
                                    <label for="houseRent" class="form-label">House Rent</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">BDT</div>
                                        </div>
                                        <input type="text" class="form-control" id="houseRent" name="houseRent"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="deposit" class="form-label">Advance/Deposit</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">BDT</div>
                                        </div>
                                        <input type="text" class="form-control" id="deposit" name="deposit">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Others Bill:</label>
                                    <button id="addBill" type="button" class="btn btn-info">Add Others Bill</button>

                                </div>
                                <div id="otherBill"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check unitCreate">
                                    <input class="form-check-input" type="checkbox" value="" id="unitCreate"
                                        name="unitCreate">
                                    <label class="form-check-label" for="unitCreate">
                                        Flat/Shop/Unit Create
                                    </label>
                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="amenities" class="form-label">Include with House Rent</label>

                                    <p style="color:rgb(162, 153, 142)">(if not, uncheck and mention the amount)</p>
                                    <div id="amenitiesValue"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" mx-auto mb-5">
                    <button class="btn btn-warning" type="submit">Create Unit</button>
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

        // get peopertType on change peopertName 
        $('#propertyName').on('change', function () {
            if ($(this).val()) {
                var propertyId = $(this).val();
                $.ajax({
                    url: "{{url('/propertSearch')}}",
                    type: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        propertyId: propertyId,
                    },
                    success: function (data) {
                        console.log(data);
                        // console.log(data.amenities);
                        $("#amenitiesValue").empty();
                        $.each(data.amenities, function (key, value) {
                            if (value === "Gas") {
                                var amenitiesValue = `                                    
                                    <div class="mb-3 display ` + value + `">
                                            <label for="gasBill" class="form-label">Gas Bill</label>
                                            <input type="text" class="form-control" id="gasBill" name="gasBill">
                                    </div>`
                            } else if (value === "Water") {
                                var amenitiesValue =
                                    `<div class="mb-3 display ` + value + ` " >
                                        <label for="waterType" class="form-label">Bill Type</label>
                                        <select class="form-select waterType" id="waterType" name="Water">
                                            <option selected disabled value="">Choose...</option>
                                            <option value="2">Fixed</option>
                                            <option value="3">Submeter</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 display " id="waterFixed">
                                        <label for="waterBill" class="form-label">Water Bill</label>
                                        <input type="text" class="form-control" id="waterBill" name="waterBill">
                                    </div>
                                    <div class="row mb-3 display"  id="waterSubmeter">
                                        <div class="col">
                                            <label for="waterIniUnit" class="form-label">Initital Unit(Water)</label>
                                            <input type="text" class="form-control" id="waterIniUnit"  name="waterIniUnit">
                                        </div>
                                        <div class="col">
                                            <label for="waterUnitCost" class="form-label">Per Unit Cost</label>
                                            <input type="text" class="form-control" id="waterUnitCost"  name="waterUnitCost">
                                        </div>
                                    </div>`
                            } else if (value === "Electricity") {
                                var amenitiesValue =
                                    `<div class="mb-3 display ` + value + `">
                                        <label for="electricType" class="form-label">Bill Type</label>
                                        <select class="form-select electricType" id="electricType" name="Electricity">
                                            <option selected disabled value="">Choose...</option>
                                            <option value="2">Fixed</option>
                                            <option value="3">Submeter</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 display" id="electricFixed">
                                        <label for="electricBill" class="form-label">Electricity Bill</label>
                                        <input type="text" class="form-control" id="electricBill" name="electricBill">
                                    </div>
                                    <div class="row mb-3 display" id="electricSubmeter"> 
                                        <div class="col">
                                            <label for="electricIniUnit" class="form-label">Initital Unit(Electricity)</label>
                                            <input type="text" class="form-control" id="electricIniUnit"  name="electricIniUnit">
                                        </div>
                                        <div class="col">
                                            <label for="electricUnitCost" class="form-label">Per Unit Cost</label>
                                            <input type="text" class="form-control" id="electricUnitCost"  name="electricUnitCost">
                                        </div>
                                    </div>`
                            } else if (value === "Elevator") {
                                var amenitiesValue = `<div class="mb-3 display ` +
                                    value + `">
                                            <label for="elevatorBill" class="form-label">Elevator Charge</label>
                                            <input type="text" class="form-control" id="elevatorBill" name="elevatorBill">
                                        </div>`
                            } else if (value == "CarParking") {
                                var amenitiesValue = `<div class="mb-3 display ` +
                                    value + `">
                                            <label for="carParkingBill" class="form-label">Car Parking</label>
                                            <input type="text" class="form-control" id="carParkingBill" name="carParkingBill">
                                        </div>`
                            } else if (value == "SecurityGuard") {
                                var amenitiesValue = `<div class="mb-3 display ` +
                                    value + `">
                                            <label for="guardBill" class="form-label">Security Charge</label>
                                            <input type="text" class="form-control" id="guardBill" name="guardBill">
                                        </div>`
                            } else if (value == "Internet") {
                                var amenitiesValue = `<div class="mb-3 display ` +
                                    value + `">
                                            <label for="internetBill" class="form-label">Internet Bill</label>
                                            <input type="text" class="form-control" id="internetBill" name="internetBill">
                                        </div>`
                            } else if (value == "CCcamera") {
                                var amenitiesValue = `<div class="mb-3 display ` +
                                    value + `">
                                            <label for="securityBill" class="form-label">Security Charge</label>
                                            <input type="text" class="form-control" id="securityBill" name="securityBill">
                                        </div>`
                            };

                            var amenities = `<div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"  id="` + value +
                                `" name="` + value + `" checked>
                                        <label class="form-check-label" for="amenities1">
                                            ` + value + `
                                        </label>
                                        </div>
                                        ` + amenitiesValue;

                            $('#amenitiesValue').append(amenities);

                        });
                    }
                });
            }
        });

        // amenities works
        $('#amenitiesValue').on('click', '#Gas', function () {
            if ($(this).prop("checked") == true) {
                $('.Gas').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Gas').show();
            }
        });

        $('#amenitiesValue').on('click', '#Water', function () {
            if ($(this).prop("checked") == true) {
                $('.Water').hide();
                $('#waterSubmeter').hide();
                $('#waterFixed').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Water').show();
            }
        });
        $('#amenitiesValue').on('change', '.waterType', function () {
            var waterType = this.value;
            if (waterType == '2') {
                $('#waterSubmeter').hide();
                $('#waterFixed').show();
            } else if (waterType == '3') {
                $('#waterFixed').hide();
                $('#waterSubmeter').show();
            }
        });

        $('#amenitiesValue').on('click', '#Electricity', function () {
            if ($(this).prop("checked") == true) {
                $('.Electricity').hide();
                $('#electricSubmeter').hide();
                $('#electricFixed').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Electricity').show();
            }
        });
        $('#amenitiesValue').on('change', '.electricType', function () {
            var electricType = this.value;
            if (electricType == '2') {
                $('#electricSubmeter').hide();
                $('#electricFixed').show();
            } else if (electricType == '3') {
                $('#electricFixed').hide();
                $('#electricSubmeter').show();
            }
        });

        $('#amenitiesValue').on('click', '#CarParking', function () {
            if ($(this).prop("checked") == true) {
                $('.CarParking').hide();
            } else if ($(this).prop("checked") == false) {
                $('.CarParking').show();
            }
        });

        $('#amenitiesValue').on('click', '#Elevator', function () {
            if ($(this).prop("checked") == true) {
                $('.Elevator').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Elevator').show();
            }
        });

        $('#amenitiesValue').on('click', '#SecurityGuard', function () {
            if ($(this).prop("checked") == true) {
                $('.SecurityGuard').hide();
            } else if ($(this).prop("checked") == false) {
                $('.SecurityGuard').show();
            }
        });
        $('#amenitiesValue').on('click', '#CCcamera', function () {
            if ($(this).prop("checked") == true) {
                $('.CCcamera').hide();
            } else if ($(this).prop("checked") == false) {
                $('.CCcamera').show();
            }
        });
        $('#amenitiesValue').on('click', '#Internet', function () {
            if ($(this).prop("checked") == true) {
                $('.Internet').hide();
            } else if ($(this).prop("checked") == false) {
                $('.Internet').show();
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
