@extends('ui.admin_panel.master')

@section('title','property contract')

@section('style')
<style>
    .display{
        display:none;
    }
</style>
@endsection

@section('content_title', 'Property Contract')

@section('main_content')
<div class="row page-content">
    <div class="col-md-2"></div>
    <div class="col-md-8">
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
        <form action="/propertContractStore" method="post">
            @csrf
            <div class="mb-3">
                <label for="tenentName" class="form-label">Tenent Name*</label>
                <input type="text" class="form-control" id="tenentName" name="tenentName" required>
            </div>
            <div class="mb-3">
                <label for="tenentAddress" class="form-label">Address*</label>
                <input type="text" class="form-control" id="tenentAddress" name="tenentAddress" required>
            </div>
            <div class="mb-3">
                <label for="tenentPhone" class="form-label">Phone Number*</label>
                <input type="text" class="form-control" id="tenentPhone" name="tenentPhone" required>
            </div>
            <div class="mb-3">
                <label for="tenentProfession" class="form-label">Profession</label>
                <input type="text" class="form-control" id="tenentProfession" name="tenentProfession" required>
            </div>
            <div class="mb-3">
                <label for="tenentNID" class="form-label">NID Card*</label>
                <input type="file" class="form-control" id="tenentNID" name="tenentNID" required>
            </div>
            <div class="mb-3">
                <label for="propertyName" class="form-label">Property Name*</label>
                <select class="form-select" id="propertyName" name="propertyName" required>
                <option selected disabled value="">Choose...</option>
                @foreach ($propertyDetails as $row)
                    <option value="{{ $row->id }}">{{ $row->propertyName }}</option>
                @endforeach              
                </select>
            </div>
            <div class="mb-3">
                <label for="propertyType" class="form-label">Property Type*</label>
                <input type="text" class="form-control" id="propertyType" name="propertyType" required>
            </div>
            <div class="mb-3">
                <label for="propertyType" class="form-label">House Rent*</label>
                <input type="text" class="form-control" id="houseBill" name="houseBill" required>
            </div>
            <div class="mb-3">
                <label for="facilities" class="form-label">Include with House Rent*</label>
                <div id="facilitiesValue"></div>
            </div>            
            <div class="mb-3">
                <label for="advanceBill" class="form-label">Advance Bill*</label>
                <input type="text" class="form-control" id="advanceBill" name="advanceBill">
            </div>
            <div class="mb-3">
                <label for="flatNumber" class="form-label">Flat Number</label>
                <input type="text" class="form-control" id="flatNumber" name="flatNumber">
            </div>
            <div class="mb-3">
                <label  class="form-label">Others Bill:</label>
                <button id="addBill" type="button" class="btn btn-warning">Add Others Bill</button>
            </div>
            <div id="otherBill"></div>            

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-warning" type="submit">Submit</button>
            </div>
        </form> 
    </div>
    <div class="col-md-2"></div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {

        // get peopertType on change peopertName 
        $('#propertyName').on('change', function () {
            if ($(this).val()) {
                var propertyId = $(this).val();
                $.ajax({
                    url: "{{url('/propertTypeSearch')}}",
                    type: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        propertyId: propertyId,
                    },
                    success: function (data) {
                        console.log(data);
                        console.log(data[1].facilities);
                        $("#propertyType").empty();
                        $("#facilitiesValue").empty();
                        $("#propertyType").val(data[0]);
                        $.each(data[1].facilities, function (key, value) {
                                    if(value === "Gas")
                                    {
                                        var facilitiesValue = `<div class="mb-3 display `+value+`">
                                            <label for="gasBill" class="form-label">Gas Bill</label>
                                            <input type="text" class="form-control" id="gasBill" name="gasBill">
                                        </div>`                                            
                                    }
                                    else if(value === "Water"){
                                        var facilitiesValue = `<div class="row mb-3 display `+value+`">
                                            <div class="col">
                                                <label for="waterIniUnit" class="form-label">Initital Unit(Water)</label>
                                                <input type="text" class="form-control" id="waterIniUnit"  name="waterIniUnit">
                                            </div>
                                            <div class="col">
                                                <label for="waterPerCost" class="form-label">Per Unit Cost</label>
                                                <input type="text" class="form-control" id="waterPerCost"  name="waterPerCost">
                                            </div>
                                        </div>`
                                    }
                                    else if(value === "Electicity"){
                                        var facilitiesValue = `<div class="row mb-3 display `+value+`">
                                            <div class="col">
                                                <label for="electicityIniUnit" class="form-label">Initital Unit(Electicity)</label>
                                                <input type="text" class="form-control" id="electicityIniUnit"  name="electicityIniUnit">
                                            </div>
                                            <div class="col">
                                                <label for="electicityPerCost" class="form-label">Per Unit Cost</label>
                                                <input type="text" class="form-control" id="electicityPerCost"  name="electicityPerCost">
                                            </div>
                                        </div>` 
                                    }
                                    else if(value === "Elevator"){
                                        var facilitiesValue =`<div class="mb-3 display `+value+`">
                                            <label for="elevatorBill" class="form-label">Elevator Charge</label>
                                            <input type="text" class="form-control" id="elevatorBill" name="elevatorBill">
                                        </div>`
                                    }
                                    else if(value == "Garage"){
                                        var facilitiesValue =`<div class="mb-3 display `+value+`">
                                            <label for="garageCharge" class="form-label">Garage Charge</label>
                                            <input type="text" class="form-control" id="garageCharge" name="garageCharge">
                                        </div>`
                                    }
                                    else if(value == "Guard"){
                                        var facilitiesValue =`<div class="mb-3 display `+value+`">
                                            <label for="guardBill" class="form-label">Security Charge</label>
                                            <input type="text" class="form-control" id="guardBill" name="guardBill">
                                        </div>`
                                    };

                            var facilities = `<div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"  id="`+value+`" name="`+value+`" checked>
                                        <label class="form-check-label" for="facilities1">
                                            `+value+`
                                        </label>
                                        </div>
                                        `+facilitiesValue;

                            $('#facilitiesValue').append(facilities);

                        });
                    }
                });
            }
        });

        // facilities works
        $('#facilitiesValue').on('click', '#Gas', function (){
            if($(this).prop("checked") == true){
                $('.Gas').hide();
            }
            else if($(this).prop("checked") == false){
                $('.Gas').show();
            }
        });

        $('#facilitiesValue').on('click', '#Water', function (){
            if($(this).prop("checked") == true){
                $('.Water').hide();
            }
            else if($(this).prop("checked") == false){
                $('.Water').show();
            }
        });

        $('#facilitiesValue').on('click', '#Electicity', function (){
            if($(this).prop("checked") == true){
                $('.Electicity').hide();
            }
            else if($(this).prop("checked") == false){
                $('.Electicity').show();
            }
        });

        $('#facilitiesValue').on('click', '#Garage', function (){
            if($(this).prop("checked") == true){
                $('.Garage').hide();
            }
            else if($(this).prop("checked") == false){
                $('.Garage').show();
            }
        });

        $('#facilitiesValue').on('click', '#Elevator', function (){
            if($(this).prop("checked") == true){
                $('.Elevator').hide();
            }
            else if($(this).prop("checked") == false){
                $('.Elevator').show();
            }
        });

        $('#facilitiesValue').on('click', '#Guard', function (){
            if($(this).prop("checked") == true){
                $('.Guard').hide();
            }
            else if($(this).prop("checked") == false){
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