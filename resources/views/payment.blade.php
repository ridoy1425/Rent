@extends('ui.admin_panel.master')

@section('title','payment')

@section('style')
<style>
    .session {
        width: 80%;
        margin: 0 auto;
    }

    /* The Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 150px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        display: flex;
    }

    .close {
        color: #aaaaaa;
        font-size: 28px;
        float: right;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

</style>
@endsection

@section('content_title', 'Payments')

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
                <div class="session">
                    @foreach($contractData as $row)
                    @php
                    $propertyName = \App\Models\Property::select('propertyName')->where('userId',
                    session('loginId'))->where(['id' =>
                    $row->propertyName])->first();
                    $tenantName = \App\Models\Tenant::select('name')->where('userId', session('loginId'))->where(['id'
                    => $row->tenantName])->first();
                    $unitName =
                    \App\Models\Unit::select('unitName','electricity','water')->where('userId',
                    session('loginId'))->where(['id'=>$row->unitName])->first();
                    if($row->hasUnit == 1)
                    {
                    $presentUnitInput = \App\Models\Unit::select('electricity','water')->where('userId',
                    session('loginId'))->where(['id'
                    =>$row->unitName])->first();
                    }
                    else {
                    $presentUnitInput = \App\Models\Unit::select('electricity','water')->where('userId',
                    session('loginId'))->where(['propertyName'
                    =>$row->propertyName])->first();
                    }
                    $payment = \App\Models\Payment::where('userId', session('loginId'))->where(['propertyName'
                    =>$row->propertyName])->where(['tenantName' =>
                    $row->tenantName])->where(['unitName'=>$row->unitName])->latest('created_at')->first();
                    $method = \App\Models\PaymentMethod::select('method')->where(['id' =>$payment['method']])->first();
                    @endphp
                    <div class="card mb-5">
                        <div class="card-header d-flex">
                            <input type="hidden" class="tenantNameInput" value="{{ $row->tenantName }}">
                            <input type="hidden" class="unitNameInput" value="{{ $row->unitName }}">
                            <input type="hidden" class="propertyNameInput" value="{{ $row->propertyName }}">
                            <input type="hidden" class="dueAmountInput" value="{{ $payment['dueAmount'] }}">
                            <input type="hidden" class="paymentId" value="{{ $payment['id'] }}">
                            <input type="hidden" class="electricity" name="electricity"
                                value="{{ $presentUnitInput->electricity }}">
                            <input type="hidden" class="water" name="water" value="{{ $presentUnitInput->water }}">
                            <div class="">
                                <h6> {{ $propertyName->propertyName }}-{{$unitName['unitName']  }}</h6>
                            </div>
                            @if($presentUnitInput->electricity==3 or $presentUnitInput->water==3 or
                            ($presentUnitInput->electricity==3 and $presentUnitInput->water==3))
                            <div class="ml-auto">
                                <a href="#" id="presentUnitInput" class="btn btn-danger presentUnitInput"
                                    title="Input Present Unit">Input</a>
                            </div>
                            @else
                            <div class="ml-auto">
                                <a href="#" id="" class="btn btn-info payment">Payment</a>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Tenant Name: {{ $tenantName->name }}</h5>
                            <h5 class="card-text">Last Payment Status</h5>
                            <table class="table mb-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Payment Date</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Advance</th>
                                        <th scope="col">Due</th>
                                        <th scope="col">Payment Method</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{date('d M Y', strtotime( $payment['created_at']))}}</td>
                                        <td>{{ $payment['PaidAmount'] }}</td>
                                        <td>{{ $payment['advanceAmt'] }}</td>
                                        <td>{{ $payment['dueAmount'] }}</td>
                                        <td>{{ $method['method']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="paymentFooter d-flex">
                                <a href="#" class="text-info payStatus">Last Month Payment Status</a>
                                <a href="#" class="text-info ml-auto">Invoice</a>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- card-body end --}}
    </div>
</div>
<!-- Input Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <div>
            <span class="close">&times;</span>
        </div>
        <div>
            <h4>Present Meter Unit Input</h4>
            <form action="/presentUnit" method="post">
                @csrf
                <div class="hidden">
                    <input type="hidden" class="tenantName" name="tenantName" value="">
                    <input type="hidden" class="unitName" name="unitName" value="">
                    <input type="hidden" class="propertyName" name="propertyName" value="">
                    <input type="hidden" class="paymentId1" name="paymentId" value="">
                </div>
                <div class="presentUnit"></div>
                <div class=" mx-auto mb-5 text-center">
                    <button class="btn btn-warning" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Payment Modal -->
<div id="payment" class="modal">
    <div class="modal-content">
        <div>
            <span class="close off">&times;</span>
        </div>
        <div>
            <h4>Payment</h4>
            <form action="/payment" method="post">
                @csrf
                <div class="hidden">
                    <input type="hidden" class="tenantName" name="tenantName" value="">
                    <input type="hidden" class="unitName" name="unitName" value="">
                    <input type="hidden" class="propertyName" name="propertyName" value="">
                </div>
                <div class="mb-3">
                    <label for="totalAmount" class="form-label">Total Amount</label>
                    <input type="text" class="form-control totalAmount" id="totalAmount" name="totalAmount" value="">
                </div>
                <div class="mb-3">
                    <label for="paidAmount" class="form-label">Payment Amount</label>
                    <input type="text" class="form-control" id="paidAmount" name="paidAmount" value="">
                </div>
                <div class="mb-3">
                    <label for="dueAmount" class="form-label">Due Amount</label>
                    <input type="text" class="form-control" id="dueAmount" name="dueAmount" value="">
                </div>                
                <div class="mb-3">
                    <label for="advanceAmt" class="form-label">Advance Amount</label>
                    <input type="text" class="form-control" id="advanceAmt" name="advanceAmt" value="">
                </div>
                <div class="mb-3">
                    <label for="payMethod" class="form-label">Payment Method</label>
                    <select class="form-select" id="payMethod" name="payMethod">
                        <option selected disabled value="">Choose...</option>
                        @foreach($paymentMethod as $method)
                        <option value="{{ $method->id }}">{{ $method->method }}</option>
                        @endforeach
                    </select>

                </div>
                <div class=" mx-auto mb-5 text-center">
                    <button class="btn btn-warning" type="submit">Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- payment status modal --}}
<div id="payStatusModal" class="modal">
    <div class="modal-content">
        <div>
            <span class="close statusClose">&times;</span>
        </div>
        <div>
            <h4>Last Month Payment History</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Payment Date</th>
                        <th scope="col">Payment Amount</th>
                        <th scope="col">Due Amount</th>
                        <th scope="col">Payment Method</th>
                    </tr>
                </thead>
                <tbody class="tableData">
                    
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
        // Get input modal
        var modal = document.getElementById("myModal");
        $(".presentUnitInput").click(function () {
            modal.style.display = "block";
            var tenant = $(this).closest(".card-header").find(".tenantNameInput").val();
            var property = $(this).closest(".card-header").find(".propertyNameInput").val();
            var unit = $(this).closest(".card-header").find(".unitNameInput").val();
            var electricity = $(this).closest(".card-header").find(".electricity").val();
            var water = $(this).closest(".card-header").find(".water").val();
            var paymentId = $(this).closest(".card-header").find(".paymentId").val();
            $(".presentUnit").empty();
            if (water == '3') {
                $(".presentUnit").append(`<div class="mb-3">
                            <label for="waterPreUnit" class="form-label">Present Unit(Water)</label>
                            <input type="text" class="form-control" id="waterPreUnit" name="waterPreUnit">
                        </div>`);
            }
            if (electricity == '3') {
                $(".presentUnit").append(`<div class="mb-3">
                            <label for="electricPreUnit" class="form-label">Present Unit(Electicity)</label>
                            <input type="text" class="form-control" id="electricPreUnit" name="electricPreUnit">
                        </div>`);
            }
            $(".tenantName").val(tenant);
            $(".propertyName").val(property);
            $(".unitName").val(unit);
            $(".paymentId1").val(paymentId);
        });
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function () {
            modal.style.display = "none";
        }

        // Get payment modal
        var payment = document.getElementById("payment");
        $(".payment").click(function () {
            payment.style.display = "block";
            var tenant = $(this).closest(".card-header").find(".tenantNameInput").val();
            var property = $(this).closest(".card-header").find(".propertyNameInput").val();
            var unit = $(this).closest(".card-header").find(".unitNameInput").val();
            var dueAmount = $(this).closest(".card-header").find(".dueAmountInput").val();
            $(".tenantName").val(tenant);
            $(".propertyName").val(property);
            $(".unitName").val(unit);
            $(".totalAmount").val(dueAmount);
        });
        var span = document.getElementsByClassName("off")[0];
        span.onclick = function () {
            payment.style.display = "none";
        }

        //dueAmount work
        $('#dueAmount').click(function () {
            var due_amt = 0;
            var total_amt = parseInt($('#totalAmount').val());
            var pay_amt = parseInt($('#paidAmount').val());
            $("#dueAmount").empty();
            $("#advanceAmt").empty();
            if (pay_amt) {                 
                due_amt = total_amt - pay_amt;
                if(due_amt >= 0)
                {
                    $("#dueAmount").val(due_amt);
                    $("#advanceAmt").val(0);
                }
                if(due_amt < 0)
                {
                    $("#advanceAmt").val(due_amt);
                    $("#dueAmount").val(0);
                } 
                
            } else {
                alert("insert the payment amount");
            }

        });

        //payment Status
        var payStatusModal = document.getElementById("payStatusModal");
        $('.payStatus').click(function () {
            payStatusModal.style.display = "block";
            var tenant = $(this).closest(".card").find(".tenantNameInput").val();
            var property = $(this).closest(".card").find(".propertyNameInput").val();
            var unit = $(this).closest(".card").find(".unitNameInput").val();
            
            $.ajax({
                url:"{{url('paymentHistory')}}",
                type:'GET',
                data: {
                "_token": "{{ csrf_token() }}",
                tenant: tenant,
                property: property,
                unit: unit
                },
                success: function (data) {
                    console.log(data[1].findMethod);
                    $(".tableData").empty();
                    $.each(data, function (key, value) {
                        var date = new Date(value.updated_at)
                        $(".tableData").append(`
                        <tr>
                        <td>`+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear()+`</td>
                        <td>`+value.PaidAmount+`</td>
                        <td>`+value.dueAmount+`</td>
                        <td>`+value.method+`</td>
                        </tr>`)

                    });
                }
            });
        });

        var statusClose = document.getElementsByClassName("statusClose")[0];
        statusClose.onclick = function () {
            payStatusModal.style.display = "none";          
           
        }

    });

</script>
@endsection
