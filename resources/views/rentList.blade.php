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
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Mark</td>
                    <td>@mdo</td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>Mark</td>
                    <td>@fat</td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>Mark</td>
                    <td>@twitter</td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
@endsection

@section('script')
@endsection