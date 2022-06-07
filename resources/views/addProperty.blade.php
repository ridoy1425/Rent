@extends('ui.admin_panel.master')

@section('title','add property')

@section('style')
@endsection

@section('content_title', 'Add Property')

@section('main_content')
<div class="page-content">
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
        <form action="/propertyStore" method="post">
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                {{-- <div class="card-header">
                    <h3 class="card-title">Add Prperty</h3>
                  </div> --}}
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Basic Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="propertyName" class="form-label">Property Name</label>
                                    <input type="text" class="form-control" id="propertyName" name="propertyName"
                                        required>
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="propertyType" class="form-label">Property Type</label>
                                    <select class="form-select" id="propertyType" name="propertyType" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach($propertyType as $row)
                                        <option value="{{ $row->id }}">{{ $row->propertyType }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="propertyContent">
                        <h6>Location</h6>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location Search</label>
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="Type to search the location">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="postalCode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postalCode" name="postalCode"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                        required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="propertyContent">
                        <h6>Features</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="propertyAge" class="form-label">Property Age</label>
                                    <select class="form-select" id="propertyAge" name="propertyAge">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="5">0-5 years</option>
                                        <option value="10">5-10 years</option>
                                        <option value="15">10-15 years</option>
                                        <option value="20">15-20 years</option>
                                        <option value="25">20-25 years</option>
                                        <option value="30">25-30 years</option>
                                        <option value="30+">30+ years</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bedRooms" class="form-label">BedRooms</label>
                                    <select class="form-select" id="bedRooms" name="bedRooms">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="belcony" class="form-label">Belcony</label>
                                    <select class="form-select" id="belcony" name="belcony">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rooms" class="form-label">Rooms</label>
                                    <select class="form-select" id="rooms" name="rooms">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="washrooms" class="form-label">WashRooms</label>
                                    <select class="form-select" id="washrooms" name="washrooms">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="propertySize" class="form-label">Property Size</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">sqft</div>
                                        </div>
                                        <input type="text" class="form-control" id="propertySize" name="propertySize"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="propertyContent">
                        <h6>Amenitties</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Electricity" id="amenities1"
                                        name="amenities[]">
                                    <label class="form-check-label" for="amenities1">
                                        Electricity Line
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Gas" id="amenities2" name="amenities[]">
                                    <label class="form-check-label" for="amenities2">
                                        Gas Line
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="CCcamera" id="amenities3"
                                        name="amenities[]">
                                    <label class="form-check-label" for="amenities3">
                                        CC Camera
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Water" id="amenities4" name="amenities[]">
                                    <label class="form-check-label" for="amenities4">
                                        Water Line
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="CarParking" id="amenities5"
                                        name="amenities[]">
                                    <label class="form-check-label" for="amenities5">
                                        Car Parking
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Internet" id="amenities6"
                                        name="amenities[]">
                                    <label class="form-check-label" for="amenities6">
                                        Internet
                                    </label>
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Elevator" id="amenities7"
                                        name="amenities[]">
                                    <label class="form-check-label" for="amenities7">
                                        Elevator
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="SecurityGuard" id="amenities8"
                                        name="amenities[]">
                                    <label class="form-check-label" for="amenities8">
                                        Security Guard
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" mx-auto mb-5">
                    <button class="btn btn-warning" type="submit">Create Property</button>
                </div>
            </div>
            {{-- card-body end --}}
            
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnO2uu9M8W5QtfHB8SRkZrELS81beukSc&libraries=places">
</script>
<script>
    // $(document).ready(function () {
    //     // var id = 'location';
    //     var autocomplete;

    //     function initAutocomplete() {
    //         autocomplete = new google.maps.places.Autocomplete(
    //             document.getElementById('location'), {
    //                 types: ['geocode'],
    //             });
    //     }
    // });

</script>
@endsection
