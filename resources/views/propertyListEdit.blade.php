@extends('ui.admin_panel.master')

@section('title','Edit property')

@section('style')
@endsection

@section('content_title', 'Edit Property')

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
        <form action="{{ URL('/propertyUpdate',$property->id) }}" method="post">
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Basic Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="propertyName" class="form-label">Property Name</label>
                                    <input type="text" class="form-control" value="{{ $property->propertyName }}" id="propertyName" name="propertyName"
                                        required>
                                </div>
                            </div>
                            @php
                            $propertyTypeName = \App\Models\propertyType::where(['id' =>
                            $property->propertyType])->first();
                            @endphp
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="propertyType" class="form-label">Property Type</label>
                                    <select class="form-select" id="propertyType" name="propertyType" required>
                                        <option selected value="{{ $propertyTypeName->id }}">
                                            {{ $propertyTypeName->propertyType }}</option>
                                        @foreach($propertyType as $row)
                                        @if($row->id != $property->propertyType )
                                        <option value="{{ $row->id }}">{{ $row->propertyType }}</option>
                                        @endif
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
                                    <input type="text" class="form-control" value={{ $property->state }} id="state"
                                        name="state" required>
                                </div>
                                <div class="mb-3">
                                    <label for="postalCode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" value={{ $property->postalCode }}
                                        id="postalCode" name="postalCode" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" value={{ $property->city }} id="city"
                                        name="city" required>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" value={{ $property->country }} id="country"
                                        name="country" required>
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
                                        <option selected value="{{ $property->propertyAge }}">
                                            {{ $property->propertyAge }}</option>
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
                                        <option selected value="{{ $property->bedRooms }}">{{ $property->bedRooms }}
                                        </option>
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
                                        <option selected value="{{ $property->belcony }}">{{ $property->belcony }}
                                        </option>
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
                                        <option selected value="{{ $property->rooms }}">{{ $property->rooms }}</option>
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
                                        <option selected value="{{ $property->washrooms }}">{{ $property->washrooms }}
                                        </option>
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
                                        <input type="text" class="form-control" value="{{ $property->propertySize }}"
                                            id="propertySize" name="propertySize" required>
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
                                    <input class="form-check-input" type="checkbox" value="Electicity" id="amenities1"
                                        name="amenities[]"
                                        <?php echo (in_array("Electricity", $property->amenities)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="amenities1">
                                        Electicity Line
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Gas Line" id="amenities2"
                                        name="amenities[]"
                                        <?php echo (in_array("Gas", $property->amenities)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="amenities2">
                                        Gas Line
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="CC Camera" id="amenities3"
                                        name="amenities[]"
                                        <?php echo (in_array("CCcamera", $property->amenities)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="amenities3">
                                        CC Camera
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Water Line" id="amenities4"
                                        name="amenities[]"
                                        <?php echo (in_array("Water", $property->amenities)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="amenities4">
                                        Water Line
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Car Parking" id="amenities5"
                                        name="amenities[]"
                                        <?php echo (in_array("CarParking", $property->amenities)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="amenities5">
                                        Car Parking
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Internet" id="amenities6"
                                        name="amenities[]"
                                        <?php echo (in_array("Internet", $property->amenities)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="amenities6">
                                        Internet
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Elevator" id="amenities7"
                                        name="amenities[]"
                                        <?php echo (in_array("Elevator", $property->amenities)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="amenities7">
                                        Elevator
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Security Guard"
                                        id="amenities8" name="amenities[]"
                                        <?php echo (in_array("SecurityGuard", $property->amenities)) ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="amenities8">
                                        Security Guard
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" mx-auto mb-5">
                    <button class="btn btn-warning" type="submit">Update Property</button>
                </div>
            </div>
            {{-- card-body end --}}

        </form>
    </div>
</div>
@endsection

@section('script')
@endsection
