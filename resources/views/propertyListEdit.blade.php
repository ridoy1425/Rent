@extends('ui.admin_panel.master')

@section('title','Edit property')

@section('style')
@endsection

@section('content_title', 'Edit Property')

@section('main_content')
<div class="row page-content">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="{{ URL('/propertyUpdate',$propertyList->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="propertyName" class="form-label">Property Name</label>
                <input type="text" class="form-control" value={{ $propertyList->propertyName }} id="propertyName" name="propertyName" required>
            </div>
            @php
                $propertyTypeName = \App\Models\propertyType::where(['id' => $propertyList->propertyType])->first();
            @endphp
            <div class="mb-3">
                <label for="propertyType" class="form-label">Property Type</label>
                <select class="form-select" id="propertyType" name="propertyType" required>
                <option selected value="{{ $propertyTypeName->id }}">{{ $propertyTypeName->propertyType }}</option>
                @foreach($propertyType as $row)
                    @if($row->id != $propertyList->propertyType )
                        <option value="{{ $row->id }}">{{ $row->propertyType }}</option>
                    @endif
                @endforeach 
                </select>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" value={{ $propertyList->location }} id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="propertySize" class="form-label">Property Size</label>
                <input type="text" class="form-control" value={{ $propertyList->propertySize }} id="propertySize" name="propertySize" required>
            </div>
            <div class="mb-3">
                <label for="NumbersOfRooms" class="form-label">Numbers of Rooms</label>
                <input type="text" class="form-control" value={{ $propertyList->numbersOfRooms }} id="numbersOfRooms" name="numbersOfRooms" required>
            </div>
            <div class="mb-3">
                <label for="NumbersOfWashrooms" class="form-label">Number of Washrooms</label>
                <input type="text" class="form-control" value={{ $propertyList->numbersOfWashrooms }} id="numbersOfWashrooms" name="numbersOfWashrooms" required>
            </div>
            <div class="mb-3">
                <label for="facilities" class="form-label">Facilities</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Gass" id="facilities1" name="facilities[]" <?php echo (in_array("Gass", $propertyList->facilities)) ? "checked" : ""; ?>>
                    <label class="form-check-label" for="facilities1">
                      Gas Line Connection
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Water" id="facilities2" name="facilities[]" <?php echo (in_array("Water", $propertyList->facilities)) ? "checked" : ""; ?>>
                    <label class="form-check-label" for="facilities2">
                      Water Line Connection
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Electicity" id="facilities3" name="facilities[]" <?php echo (in_array("Electicity", $propertyList->facilities)) ? "checked" : ""; ?>>
                    <label class="form-check-label" for="facilities3">
                      Electicity Line
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Elevator" id="facilities4" name="facilities[]" <?php echo (in_array("Elevator", $propertyList->facilities)) ? "checked" : ""; ?>>
                    <label class="form-check-label" for="facilities4">
                      Elevator
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Garage" id="facilities5" name="facilities[]" <?php echo (in_array("Garage", $propertyList->facilities)) ? "checked" : ""; ?>>
                    <label class="form-check-label" for="facilities5">
                      Garage
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Guard" name="securitySystem[]" id="securitySystem1" <?php echo (in_array("Guard", $propertyList->facilities)) ? "checked" : ""; ?>>
                    <label class="form-check-label" for="securitySystem1">
                    Security Guard
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Camera" name="securitySystem[]" id="securitySystem2" <?php echo (in_array("Camera", $propertyList->facilities)) ? "checked" : ""; ?>>
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