@extends('ui.admin_panel.master')

@section('title','property list')

@section('style')
@endsection

@section('content_title', 'Property List')

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
                    <th scope="col">Property Type</th>
                    <th scope="col">Location</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i=1;
                  @endphp
                  @foreach($propertyList as $row)
                    @php
                      $propertyTypeName = \App\Models\propertyType::where(['id' => $row->propertyType])->first();
                    @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $row->propertyName }}</td>
                      <td>{{ $propertyTypeName->propertyType }}</td>
                      <td>{{ $row->location }}</td>
                      <td>
                          <a href="{{ route('propertyListEdit') }}" class="btn btn-warning">Edit</a>
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