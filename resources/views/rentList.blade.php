@extends('ui.admin_panel.master')

@section('title','rent list')

@section('style')
@endsection

@section('content_title', 'Rent List')

@section('main_content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="page_content">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Property Name</th>
                    <th scope="col">Flat/Shop No.</th>
                    <th scope="col">Tenent Name</th>
                    <th scope="col">Phone Number</th>
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
                      <td>{{ $row->tenentName }}</td>
                      <td>{{ $row->tenentPhone }}</td>
                      <td>
                          <a href="#" class="btn btn-warning">Edit</a>
                          <a href="#" class="btn btn-danger">Delete</a>
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