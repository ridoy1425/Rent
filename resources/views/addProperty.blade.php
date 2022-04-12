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
                <label for="propertySize" class="form-label">Property Size</label>
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
                <label for="NumbersOfWashrooms" class="form-label">Car Parking Facilicy:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input mt-2" type="radio" name="carParking" id="carParking1" value="1">
                    <label class="form-check-label" for="carParking1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input mt-2" type="radio" name="carParking" id="carParking2" value="0">
                    <label class="form-check-label" for="carParking2">No</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="NumbersOfWashrooms" class="form-label">Security System</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Guard" id="securitySystem1" name="securitySystem[]">
                    <label class="form-check-label" for="securitySystem1">
                      Security Guard
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Camera" id="securitySystem2" name="securitySystem" name="securitySystem[]">
                    <label class="form-check-label" for="securitySystem2">
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