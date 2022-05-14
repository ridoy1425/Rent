@extends('ui.admin_panel.master')

@section('title','bill collection')

@section('style')
@endsection

@section('content_title', 'Bill Collection')

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
                    <th scope="col">Property Name</th>
                    <th scope="col">Flat/Shop No.</th>
                    <th scope="col">Tenent Name</th>                    
                    {{-- <th scope="col">Monthy Payment</th>
                    <th scope="col">Due</th>
                    <th scope="col">Total Payment</th> --}}
                    <th scope="col">Bill Genarate</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i=1;
                  @endphp
                  @foreach($contractData as $row)
                    @php
                      // $contractId = $row['id'];
                      // $totalAmount = $row['amount'];
                      // $monthyAmount = $row['monthly'];
                      // $dueAmount = $row['due'];
                      // $contractData = \App\Models\PropertyContract::where(['id' => $contractId])->first(); 
                      $gassBill = $row->gassBill;                    
                      $propertyData = \App\Models\addProperty::where(['id' => $row->propertyName])->first();
                    @endphp
                    <tr>
                      <th>{{ $i }}</th>
                      <td>{{ $propertyData->propertyName }}</td>
                      <td>{{ $row->flatNumber }}</td>
                      <td>{{ $row->tenentName }}</td>                      
                      {{-- <td>{{ $monthyAmount }}</td>
                      <td>{{ $dueAmount }}</td>
                      <td class="contractAmount">{{ $totalAmount }}</td> --}}
                      <td>
                          <a href="#" class="btn btn-warning payment">Action</a>
                          <input type="hidden" value="{{$row->id}}" class="contractId">
                          <input type="hidden" name="contractWater" class="contractWater" value="{{$row->water}}">
                          <input type="hidden" name="contractElecticity" class="contractElecticity" value="{{$row->electicity}}">
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
<!-- The Modal -->
<div id="reject_modal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
      <div>
          <span class="close">&times;</span>
      </div>
      <div>
          <form id="action_btn" action="/billGenerate" method="post">
            @csrf
              <input type="hidden" value="" name="inputContractId" id="inputContractId">
              {{-- <div id="action"></div> --}}
              <div class="box-body">
                  <h4>Bill Genarate</h4>
                  <div class="pUnit"></div>
                  @php 
                      $month = date('m');
                      $day = date('d');
                      $year = date('Y');
                      $today = $year . '-' . $month . '-' . $day;
                  @endphp
                  <div class="mb-3">
                    <label for="paymentDate" class="form-label">Payment Date</label>
                    <input type="date" value="<?php echo $today; ?>" class="form-control" id="paymentDate" name="paymentDate" required>
                  </div>
              </div><!-- /.box-body -->
              <div class="form-footer">
                  <div class="row">
                      <div class="col-md-4">
                      </div>
                      <div class="col-md-4">
                          <button type="submit" class="btn btn-warning btn-block">Submit</button>
                      </div>
                      <div class="col-md-4">
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function(){
    $('.payment').click(function(){
      var contractId = $(this).closest("tr").find(".contractId").val();
      var contractAmount = $(this).closest("tr").find(".contractAmount").text();
      var water = $(this).closest("tr").find(".contractWater").val();
      var electicity = $(this).closest("tr").find(".contractElecticity").val();
      $(".pUnit").empty();
      if(water != '1')
      {
        $(".pUnit").append(`<div class="mb-3">
                    <label for="pUnitWater" class="form-label">Present Unit(Water)</label>
                    <input type="text" class="form-control" id="pUnitWater" name="pUnitWater">
                  </div>`);
      }
      if(electicity != '1')
      {
        $(".pUnit").append(`<div class="mb-3">
                    <label for="pUnitElecticity" class="form-label">Present Unit(Electicity)</label>
                    <input type="text" class="form-control" id="pUnitElecticity" name="pUnitElecticity">
                  </div>`);
      }  
      document.querySelector('#reject_modal').style.display = 'block';
      $("#inputContractId").val(contractId);
      $("#total_amt").val(gassBill);      
          
    });

    $('#dueAmount').click(function(){
      var due_amt = 0;
      var total_amt =$('#total_amt').val() ;
      var pay_amt =$('#pay_amt').val();
      if(pay_amt)
      {
        due_amt = total_amt-pay_amt;
        $("#dueAmount").val(due_amt);
      }
      else{
        alert("insert the payment amount");
      }     
      
    });

    $('.close').on('click', function () {
        document.querySelector('#reject_modal').style.display = 'none';
        $("form")[0].reset();
    });
  });

</script>
@endsection