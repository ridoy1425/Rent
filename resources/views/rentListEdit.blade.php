@extends('ui.admin_panel.master')

@section('title','edit contract')

@section('style')
@endsection

@section('content_title', 'Edit Contract')

@section('main_content')
<div class="row page-content">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="{{ URL('/updateRentList',$ContractData->id) }}" method="post">
            @csrf
            @php                     
                $propertyName = \App\Models\addProperty::select('propertyName','id')->where(['id' => $ContractData->propertyName])->first();
            @endphp
            <div class="mb-3">
                <label for="propertyName" class="form-label">Property Name*</label>
                <select class="form-select" id="propertyName" name="propertyName" required>
                <option selected value="{{ $propertyName->id }}">{{ $propertyName->propertyName }}</option>
                @foreach ($propertyData as $row)
                    @if($row->id != $propertyName->id)
                    <option value="{{ $row->id }}">{{ $row->propertyName }}</option>
                    @endif
                @endforeach              
                </select>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="houseBill" class="form-label">House Rent*</label>
                    <input type="text" value="{{ $ContractData->houseBill }}" class="form-control" id="houseBill"  name="houseBill">
                </div>
                <div class="col">
                    <label for="gasBill" class="form-label">Gas Bill*</label>
                    <input type="text" value="{{ $ContractData->gasBill }}" class="form-control" id="gasBill"  name="gasBill">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="waterBill" class="form-label">Water Bill*</label>
                    <input type="text" value="{{ $ContractData->waterBill }}" class="form-control" id="waterBill"  name="waterBill">
                </div>
                <div class="col">
                    <label for="utilityBill" class="form-label">Utility Bill*</label>
                    <input type="text" value="{{ $ContractData->utilityBill }}" class="form-control" id="utilityBill"  name="utilityBill">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="advanceBill" class="form-label">Advance Bill*</label>
                    <input type="text" value="{{ $ContractData->advanceBill }}" class="form-control" id="advanceBill" name="advanceBill">
                </div>
                <div class="col">
                    <label for="flatNumber" class="form-label">Flat Number</label>
                    <input type="text" value="{{ $ContractData->flatNumber }}" class="form-control" id="flatNumber" name="flatNumber">
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Others Bill:</label>
                <button id="addBill" type="button" class="btn btn-warning">Add Others Bill</button>
            </div>           
            <div id="otherBill">
                @if($ContractData->otherBill)
                    @foreach($ContractData->otherBill as $row)
                        <div id="moreBill " class="mb-3">
                            <input class="btn btn-danger  float-right rounded-circle mt-4" type="button" name="remove_btn" id="remove_btn" value="x">
                            <div class="row">
                                <div class="col">
                                    <label for="otherBillName" class="form-label">Bill Name</label>
                                    <input type="text" value="{{ $row['billName'] }}" class="form-control" id="otherBillName" name="otherBillName[]">
                                </div>
                                <div class="col">
                                    <label for="otherBillAmount" class="form-label">Amount</label>
                                    <input type="text" value="{{ $row['billAmount']}}"  class="form-control" id="otherBillAmount" name="otherBillAmount[]">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mb-3">
                <label for="tenentName" class="form-label">Tenent Name*</label>
                <input type="text" value="{{ $ContractData->tenentName }}" class="form-control" id="tenentName" name="tenentName" required>
            </div>
            <div class="mb-3">
                <label for="tenentAddress" class="form-label">Address*</label>
                <input type="text" value="{{ $ContractData->tenentAddress }}" class="form-control" id="tenentAddress" name="tenentAddress" required>
            </div>
            <div class="mb-3">
                <label for="tenentPhone" class="form-label">Phone Number*</label>
                <input type="text" value="{{ $ContractData->tenentPhone }}" class="form-control" id="tenentPhone" name="tenentPhone" required>
            </div>
            <div class="mb-3">
                <label for="tenentProfession" class="form-label">Profession</label>
                <input type="text" value="{{ $ContractData->tenentProfession }}" class="form-control" id="tenentProfession" name="tenentProfession" required>
            </div>
            <div class="mb-3">
                <label for="tenentNID" class="form-label">NID Card*</label>
                <input type="file" value="{{ $ContractData->tenentNID }}" class="form-control" id="tenentNID" name="tenentNID" required>
            </div>

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
                        $("#propertyType").empty();
                        $("#propertyType").val(data);
                    }
                });
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