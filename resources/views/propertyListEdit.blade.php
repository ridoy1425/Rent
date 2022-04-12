@extends('ui.admin_panel.master')

@section('title','Edit property')

@section('style')
@endsection

@section('content_title', 'Edit Property')

@section('main_content')
<div class="row page-content">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="mb-3">
            <label for="propertyName" class="form-label">Property Name</label>
            <input type="text" class="form-control" id="propertyName" name="propertyName" required>
        </div>
        <div class="mb-3">
            <label for="propertyType" class="form-label">Property Type</label>
            <select class="form-select" id="propertyType" name="propertyType" required>
              <option selected disabled value="">Choose...</option>
              <option>...</option>
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
            <input type="text" class="form-control" id="NumbersOfRooms" name="NumbersOfRooms" required>
        </div>
        <div class="mb-3">
            <label for="NumbersOfWashrooms" class="form-label">Number of Washrooms</label>
            <input type="text" class="form-control" id="NumbersOfWashrooms" name="NumbersOfWashrooms" required>
        </div>
        <div class="mb-3">
            <label for="NumbersOfWashrooms" class="form-label">Car Parking Facilicy:</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input mt-2" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                <label class="form-check-label" for="inlineRadio1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input mt-2" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
                <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="NumbersOfWashrooms" class="form-label">Security System</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Guard" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Security Guard
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Camera" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                  CC Camera
                </label>
            </div>
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-warning" type="button">Submit</button>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
@endsection

@section('script')
@endsection