@extends('ui.admin_panel.master')

@section('title','property list')

@section('style')
@endsection

@section('content_title', 'Property List')

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
                        @php
                        $i=1;
                        @endphp
                        @foreach($property as $row)
                        @php
                        $propertyTypeName = \App\Models\propertyType::select('propertyType')->where(['id' =>
                        $row->propertyType])->first();
                        $amenities = implode( ", ", $row->amenities );
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row->propertyName }}</td>
                            <td>{{ $propertyTypeName->propertyType }}</td>
                            <td>{{ $row->state }},{{ $row->city }}-{{ $row->postalCode }},{{ $row->country }}</td>
                            <td>{{ $row->propertyAge }}</td>
                            <td>{{ $row->propertySize }}</td>
                            <td>{{ $row->rooms }}</td>
                            <td>{{ $row->bedRooms }}</td>
                            <td>{{ $row->washrooms }}</td>
                            <td>{{ $row->belcony }}</td>
                            <td>{{ $amenities }}</td>
                            <td>
                                <a href="{{ URL('/propertyEdit',$row->id) }}" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ URL('/propertyDelete',$row->id) }}" class="btn btn-danger"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
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
