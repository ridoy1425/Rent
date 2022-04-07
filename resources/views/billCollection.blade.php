@extends('ui.admin_panel.master')

@section('title','bill collection')

@section('style')
@endsection

@section('content_title', 'Bill Collection')

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
                    <th scope="col">Total Payment Amount</th>
                    <th scope="col">Due Amount</th>
                    <th scope="col">Payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Mark</td>
                    <td>@mdo</td>
                    <td>5000</td>
                    <td>
                        <a href="#" class="btn btn-warning">Payment</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>Mark</td>
                    <td>@fat</td>
                    <td>5000</td>
                    <td>
                        <a href="#" class="btn btn-warning">Payment</a>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>Mark</td>
                    <td>@twitter</td>
                    <td>5000</td>
                    <td>
                        <a href="#" class="btn btn-warning">Payment</a>
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