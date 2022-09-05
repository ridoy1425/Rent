@extends('ui.admin_panel.master')

@section('title','rent Property')

@section('style')
@endsection

@section('content_title', 'Rent Property')

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
        {{-- card-body start --}}
        <div class="card card-default">
            <div class="card-body">
                <table class="table" id="table_id">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">P_Name</th>
                            <th scope="col">P_Type</th>
                            <th scope="col">Location</th>
                            <th scope="col">Age</th>
                            <th scope="col">Size(sqft)</th>
                            <th scope="col">Rooms</th>
                            <th scope="col">BedRooms</th>
                            <th scope="col">Washrooms</th>
                            <th scope="col">Belcony</th>
                            <th scope="col">Amenities</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
        {{-- card-body end --}}
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });

</script>
@endsection
