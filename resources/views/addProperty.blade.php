@extends('ui.admin_panel.master')

@section('title','add property')

@section('style')
@endsection

@section('content_title', 'Add Property')

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
        <form action="/propertyStore" method="post">
            @csrf  
            <div class="mb-3">
                <label for="propertyName" class="form-label">Property Name</label>
                <input type="text" class="form-control" id="propertyName" name="propertyName" required>
            </div>
            <div class="mb-3">
                <label for="propertyType" class="form-label">Property Type</label>
                <select class="form-select" id="propertyType" name="propertyType" required>
                  <option selected disabled value="">Choose...</option>
                  @foreach($propertyType as $row)
                    <option value="{{ $row->id }}">{{ $row->propertyType }}</option>
                  @endforeach                  
                </select>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="propertySize" class="form-label">Property Size(sft)</label>
                <input type="text" class="form-control" id="propertySize" name="propertySize" required>
            </div>
            <div class="mb-3">
                <label for="NumbersOfRooms" class="form-label">Numbers of Rooms</label>
                <input type="text" class="form-control" id="NumbersOfRooms" name="numbersOfRooms" required>
            </div>
            <div class="mb-3">
                <label for="NumbersOfWashrooms" class="form-label">Number of Washrooms</label>
                <input type="text" class="form-control" id="NumbersOfWashrooms" name="numbersOfWashrooms" required>
            </div>
            <div class="mb-3">
                <label for="facilities" class="form-label">Facilities</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Gas" id="facilities1" name="facilities[]">
                    <label class="form-check-label" for="facilities1">
                      Gas Line Connection
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Water" id="facilities2" name="facilities[]">
                    <label class="form-check-label" for="facilities2">
                      Water Line Connection
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Electicity" id="facilities3" name="facilities[]">
                    <label class="form-check-label" for="facilities3">
                      Electicity Line
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Elevator" id="facilities4" name="facilities[]">
                    <label class="form-check-label" for="facilities4">
                      Elevator
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Car Parking" id="facilities5" name="facilities[]">
                    <label class="form-check-label" for="facilities5">
                        Car Parking
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Guard" id="facilities6" name="facilities[]">
                    <label class="form-check-label" for="facilities6">
                      Security Guard
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Camera" id="facilities7" name="facilities[]">
                    <label class="form-check-label" for="facilities7">
                      CC Camera
                    </label>
                </div>
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
@endsection