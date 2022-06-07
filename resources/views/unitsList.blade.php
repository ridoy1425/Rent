@extends('ui.admin_panel.master')

@section('title','Units List')

@section('style')
@endsection

@section('content_title', 'Units List')

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
                            <th scope="col">Unit Name</th>
                            <th scope="col">Total Rent</th>
                            <th scope="col">Deposit</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($units as $row)
                        @php
                        $propertyName = \App\Models\Property::select('propertyName')->where(['id' =>
                        $row->propertyName])->first();
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $propertyName->propertyName }}</td>
                            <td>{{ $row->unitName }}</td>
                            @foreach($totalAmount as $amount)
                                @if($amount['id'] == $row->id)                                
                                    <td>{{ $amount['totalAmount'] }}</td>
                                @endif
                            @endforeach
                            <td>{{ $row->deposit }}</td>
                            @php
                            if($row->unitName)
                            {
                            $status = \App\Models\Contract::where(['propertyName' =>
                            $row->propertyName])->where(['unitName' => $row->id])->first();
                            }
                            else {
                            $status = \App\Models\Contract::where(['propertyName' => $row->propertyName])->first();
                            }

                            @endphp
                            @if($status)
                            <td><p style="padding:1px; text-align:center;" class="bg-info">Occupied</p></td>
                            @else
                            <td><p style="padding:1px;text-align:center;" class="bg-danger">Vacant</p></td>
                            @endif
                            <td>
                                <a href="{{ URL('/unitsDetails',$row->id) }}" class="text-info" title="View Details"><i
                                    class="fas fa-eye-slash"></i></a>
                                <a href="{{ URL('/unitEdit',$row->id) }}" class="text-warning" title="Edit"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ URL('/tenantDelete',$row->id) }}" class="text-danger" title="Delete"><i
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
