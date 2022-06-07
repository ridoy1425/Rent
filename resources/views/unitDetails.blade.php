@extends('ui.admin_panel.master')

@section('title','Unit Details')

@section('style')
<style>
    .section{
        margin: 0 245px;
    }
    .info{
        line-height: 40%;
    }
</style>
@endsection

@section('content_title', 'Unit Details')

@section('main_content')
<div class="page-content">
  <div class="container">
      {{-- message alert --}}
      <div class="alert_message mt-5">
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul style="margin-bottom:0rem;">
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
              <div class="section">
                <h5>Property Name: {{ $propertyName->propertyName }}</h5>
                <h6>Unit Name: {{ $units->unitName }}</h6>
                <div class="row mt-5 info">
                    <div class="col-md-8">
                        <p>Deposit: {{ $units->deposit }}<p>
                        <p>House Rent: {{ $units->houseRent }}<p>
                        @if($units->gasBill)
                        <p>Gas Bill: {{ $units->gasBill }}<p>
                        @endif  
                        @if($units->electricity == 2)
                        <p>Electic Bill: {{ $units->electricBill }}<p>
                        @endif
                        @if($units->water == 2)
                        <p>Water Bill: {{ $units->waterBill }}<p>
                        @endif
                        @if($units->carParkingBill)
                        <p>Car Parking Charge: {{ $units->carParkingBill }}<p>
                        @endif   
                        @if($units->guardBill)
                        <p>Security Bill: {{ $units->guardBill }}<p>
                        @endif         
                        @if($units->elevatorBill)
                        <p>Elevator Charge: {{ $units->elevatorBill }}<p>
                        @endif         
                        @if($units->securityBill)
                        <p>CC Camera Charge: {{ $units->securityBill }}<p>
                        @endif         
                        @if($units->internetBill)
                        <p>Internet Bill: {{ $units->internetBill }}<p>
                        @endif
                        @if($units->othersBill)
                            @foreach($units->othersBill as $value)
                                <p>{{ $value['billName'] }}: {{ $value['billAmount'] }}</p>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h6>Inculde Bill With House Rent</h6>
                        @if($units->gasBill == null)
                        <p>Gas Bill<p>
                        @endif  
                        @if($units->electricity == 1)
                        <p>Electricity<p>
                        @endif
                        @if($units->water == 1)
                        <p>Water Bill<p>
                        @endif
                        @if($units->carParkingBill == null)
                        <p>Car Parking Charge<p>
                        @endif   
                        @if($units->guardBill == null)
                        <p>Security Bill<p>
                        @endif         
                        @if($units->elevatorBill ==null)
                        <p>Elevator Charge<p>
                        @endif
                    </div>    
                </div>
            </div>
          </div>
      </div>
      {{-- card-body end --}}
  </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection