@extends('ui.admin_panel.master')

@section('title','property contract')

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
                    {{-- search tenant --}}
                    <div class="propertyContent">
                        <h6>Search Tenant</h6>
                        <div class="mb-3">
                            <label for="tenentSearch" class="form-label">Location Search</label>
                            <input type="text" class="form-control" id="tenentSearch" name="tenentSearch"
                                placeholder="Type to search the Tenent">
                        </div>
                    </div>
                    {{-- tenant information --}}
                    <div class="propertyContent">
                        <h6>Tenent Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Identification Document</label>
                                            <input type="file" class="form-control" id="image" name="image"
                                            onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img height="100px" width="180px" id="output" src=""
                                        alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="nidNo" class="form-label">National ID No</label>
                                    <input type="text" class="form-control" id="nidNo" name="nidNo"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="propertyContent">
                        <h6>Work Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ocupation" class="form-label">Ocupation Status</label>
                                    <select class="form-select" id="ocupation" name="ocupation" required>
                                        <option selected disabled value="">Choose..</option>
                                        <option value="Business">Business</option>
                                        <option value="Service Holder">Service Holder</option>
                                        <option value="Self Employed">Self Employed</option>
                                        <option value="Job seeker">Job seeker</option>
                                        <option value="Student">Student</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="workPlace" class="form-label">Work Place</label required>
                                    <input type="text" class="form-control" id="workPlace" name="workPlace"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="propertyContent">
                        <h6>Emergency Contact</h6>
                        <div class="mb-3">
                            <label for="relation" class="form-label">Relation</label>
                            <select class="form-select" id="relation" name="relation" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Friend">Friend</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">                                
                                <div class="mb-3">
                                    <label for="relativeName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="relativeName" name="relativeName"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="relativePhone" class="form-label">Phone No</label>
                                    <input type="text" class="form-control" id="relativePhone" name="relativePhone"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- property information --}}
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
                    {{-- contract details --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
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

        // autocomplete search js
        var route = "{{ url('autocomplete-search') }}";
        $('#tenentSearch').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                    console.log(data);
                });
            }
        });

        // on change field tenant information
        $('#tenentSearch').on('change', function () {
            if ($(this).val()) {
                var tenantSearch = $(this).val();
                $.ajax({
                    url: "{{url('tenantSearch')}}",
                    type: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        tenantSearch: tenantSearch,
                    },
                    success: function (data) {
                        console.log(data);
                        $("#name").empty();
                        $("#phone").empty();
                        $("#email").empty();
                        $("#nidNo").empty();
                        $("#address").empty();
                        $.each(data, function (key, value) {
                            $("#name").val(data['first_name']+' '+data['last_name'])
                            $("#phone").val(data['phone_number'])
                            $("#email").val(data['email'])
                            $("#address").val(data['id'])

                        });
                    }
                });
            }
        });

    });

</script>
@endsection
