@extends('ui.admin_panel.master')

@section('title','rent list')

@section('style')
@endsection

@section('content_title', 'Rent List')

@section('main_content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
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
        <div class="page_content">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">P_Name</th>
                    <th scope="col">Flat/Shop No.</th>
                    <th scope="col">HouseB</th>
                    <th scope="col">GassB</th>
                    <th scope="col">WaterB</th>
                    <th scope="col">ServiceC</th>
                    <th scope="col">Advance</th>
                    <th scope="col">T_Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i=1;
                  @endphp
                  @foreach($propertyContractData as $row)
                    @php
                      $propertyName = \App\Models\addProperty::select('propertyName')->where(['id' => $row->propertyName])->first();
                    @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $propertyName->propertyName }}</td>
                      <td>{{ $row->flatNumber }}</td>
                      <td>{{ $row->houseBill }}</td>
                      <td>{{ $row->gasBill }}</td>
                      <td>{{ $row->waterBill }}</td>
                      <td>{{ $row->utilityBill }}</td>
                      <td>{{ $row->advanceBill }}</td>
                      <td>{{ $row->tenentName }}</td>
                      <td>{{ $row->tenentPhone }}</td>
                      <td>
                          <a href="{{ URL('/rentListEdit/'.$row->id) }}" class="btn btn-warning">Edit</a>
                          <a href="{{ URL('/rentListDelete/'.$row->id) }}" class="btn btn-danger">Delete</a>
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
    <div class="col-md-1"></div>
</div>
@endsection

@section('script')
@endsection