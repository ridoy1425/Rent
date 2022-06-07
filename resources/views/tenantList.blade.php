@extends('ui.admin_panel.master')

@section('title','property list')

@section('style')
@endsection

@section('content_title', 'Tenants List')

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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone No</th>
                            <th scope="col">Address</th>
                            <th scope="col">Nid No</th>
                            <th scope="col">Ocupation</th>
                            <th scope="col">Work Place</th>
                            <th scope="col">Status</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($tenant as $row)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->address }}</td>
                            <td>{{ $row->nidNo }}</td>
                            <td>{{ $row->ocupation }}</td>
                            <td>{{ $row->workPlace }}</td>
                            @php
                             $status = \App\Models\Contract::select('propertyName')->where(['tenantName' => $row->id])->first();
                            @endphp 
                            @if($status)
                                <td><p style="padding:1px;text-align:center;" class="bg-info">Occupied</p></td>
                            @else 
                                <td><p style="padding:1px;text-align:center;" class="bg-danger">Vacant</p></td>
                            @endif                            
                            <td>
                                <a href="{{ asset('images/tenant'.$row->image) }}">
                                    <img height="50px" width="100px" src="{{ asset('images/tenant/'.$row->image) }}"
                                        alt="{{ $row->image }}">
                                </a>
                            </td>
                            <td>
                                <a href="{{ URL('/tenantEdit',$row->id) }}" class="text-info" title="Edit" ><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ URL('/tenantDelete',$row->id) }}" class="text-danger"  title="Delete"><i
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
