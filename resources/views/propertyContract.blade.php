@extends('ui.admin_panel.master')

@section('title','property contract')

@section('style')
@endsection

@section('content_title', 'Property Contract')

@section('main_content')
<div class="row page-content">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="mb-3">
            <label for="propertyType" class="form-label">Property Name*</label>
            <select class="form-select" id="propertyType" name="propertyType" required>
              <option selected disabled value="">Choose...</option>
              <option>...</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Property Type*</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="location" class="form-label">House Rent*</label>
                <input type="text" class="form-control" id="" name="">
            </div>
            <div class="col">
                <label for="location" class="form-label">Gas Bill*</label>
                <input type="text" class="form-control" id="" name="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="location" class="form-label">Water Bill*</label>
                <input type="text" class="form-control" id="" name="">
            </div>
            <div class="col">
                <label for="location" class="form-label">Utility Bill*</label>
                <input type="text" class="form-control" id="" name="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="location" class="form-label">Advance Bill*</label>
                <input type="text" class="form-control" id="" name="">
            </div>
            <div class="col">
                <label for="location" class="form-label">Flat Number</label>
                <input type="text" class="form-control" id="" name="">
            </div>
        </div>
        <div class="mb-3">
            <label for="propertySize" class="form-label">Others Bill:</label>
            <button class="btn btn-warning">Add Bill</button>
        </div>
        <div class="other_bill"></div>
        <div class="mb-3">
            <label for="NumbersOfRooms" class="form-label">Contractual Time</label>
            <input type="text" class="form-control" id="NumbersOfRooms" name="NumbersOfRooms" required>
        </div>
        <div class="mb-3">
            <label for="NumbersOfRooms" class="form-label">Tenent Name*</label>
            <input type="text" class="form-control" id="NumbersOfRooms" name="NumbersOfRooms" required>
        </div>
        <div class="mb-3">
            <label for="NumbersOfWashrooms" class="form-label">Address*</label>
            <input type="text" class="form-control" id="NumbersOfWashrooms" name="NumbersOfWashrooms" required>
        </div>
        <div class="mb-3">
            <label for="NumbersOfWashrooms" class="form-label">Phone Number*</label>
            <input type="text" class="form-control" id="NumbersOfWashrooms" name="NumbersOfWashrooms" required>
        </div>
        <div class="mb-3">
            <label for="NumbersOfWashrooms" class="form-label">Profession</label>
            <input type="text" class="form-control" id="NumbersOfWashrooms" name="NumbersOfWashrooms" required>
        </div>
        <div class="mb-3">
            <label for="NumbersOfWashrooms" class="form-label">NID Card*</label>
            <input type="file" class="form-control" id="NumbersOfWashrooms" name="NumbersOfWashrooms" required>
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