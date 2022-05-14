@extends('ui.admin_panel.master')

@section('title','add property')

@section('style')
<style>
    /* .clearfix:after {
  content: "";
  display: table;
  clear: both;
} */

.clearfix a {
  color: black;
  /* text-decoration: underline; */
}

/* body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
} */

header {
  padding: 10px 0;
  margin-bottom: 30px;
}


.clearfix h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
  /* text-align: left; */
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}
#company span {
  color: #5D6975;
  text-align: left;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  /* text-align: right; */
}

#project div,
#company div {
  white-space: nowrap;        
}

 table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
} 

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
} 
table td.total {
  text-align: right;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

/* footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
  
} */
</style>
@endsection

@section('content_title', 'Bill Genarate')

@section('main_content')
<div class="row page-content">
    <div class="col-md-2"></div>
    <div class="col-md-8">
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
        <header class="clearfix">
            <div class="d-flex flex-row-reverse">
              <form action="/pdfDownload" method="GET">
                <input type="hidden" value="{{ $waterBill }}" name="waterBill">
                <input type="hidden" value="{{ $electricBill }}" name="electricBill">
                <input type="hidden" value="{{ $contractData }}" name="contractData">
                <input type="hidden" value="{{ $totalAmount }}" name="totalAmount">
                <input type="hidden" value="{{ $userInfo }}" name="userInfo">
                <input type="hidden" value="{{ $paymentDate }}" name="paymentDate">
                <button type="submit" class="btn btn-warning mb-3">PDF Download</button>
              </form>
              {{-- <a href="/pdfDownload" class="btn btn-warning mb-3">PDF Download</a> --}}
            </div>
            <h1>INVOICE</h1>
            <div id="company" class="clearfix">
              <div><b>Bill To</b></div>
              <div><span>Name:</span>{{ $contractData->tenentName }}</div>
              {{-- <div><span>Profession:</span>{{ $contractData->tenentProfession }}</div> --}}
              <div><span>Phone:</span>{{ $contractData->tenentPhone }}</div>
              <div><span>Email:</span><a href="mailto:company@example.com">company@example.com</a></div>
            </div>
            <div id="project">
              <div><b>Bill From</b></div>
              {{-- <div><span>PROJECT</span> Website development</div> --}}
              <div><span>Owner:</span>{{ $userInfo->first_name }} {{ $userInfo->last_name }}</div>
              @php
                  $propertyDetails = App\Models\addProperty::where('id',$contractData->propertyName)->first();
                  $i=1;
                  // dd($propertyDetails);
              @endphp
              <div><span>Property:</span>{{ $propertyDetails->propertyName }}</div>
              <div><span>Flat/Shop:</span>{{ $contractData->flatNumber }}</div>
              <div><span>Address:</span>{{ $propertyDetails->location }}</div>
              <div><span>Email:</span><a href="mailto:john@example.com">{{ $userInfo->email }}</a></div>
              <div><span>Phone:</span>0132361216</div>
              <div><span>Date:</span> {{ $paymentDate }}</div>
            </div>
          </header>
          <main>
            <table>
              <thead>
                <tr>
                  <th class="service">#</th>
                  <th class="desc">DESCRIPTION</th>
                  <th class="d-flex flex-row-reverse">TOTAL</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="service">{{ $i }}</td>
                  <td class="desc">House Rent</td>
                  <td class="total">{{ $contractData->houseBill }}</td>
                </tr>
                @php
                $i++;
                @endphp 
                @foreach($propertyDetails->facilities as $facility)
                @if($facility=="Gas")
                  <tr>
                    <td class="service">{{ $i }}</td>
                    <td class="desc">{{ $facility }}</td>
                    <td class="total">{{ $contractData->gasBill }}</td>
                  </tr>
                  @elseif($facility=="Water")
                  <tr>
                    <td class="service">{{ $i }}</td>
                    <td class="desc">{{ $facility }}</td>
                    <td class="total">{{ $waterBill }}</td>
                  </tr>
                  @elseif($facility=="Electicity")
                  <tr>
                    <td class="service">{{ $i }}</td>
                    <td class="desc">{{ $facility }}</td>
                    <td class="total">{{ $electricBill }}</td>
                  </tr>
                  @elseif($facility=="Elevator")
                  <tr>
                    <td class="service">{{ $i }}</td>
                    <td class="desc">{{ $facility }}</td>
                    <td class="total">{{ $contractData->elevatorBill }}</td>
                  </tr>
                  @elseif($facility=="Garage")
                  <tr>
                    <td class="service">{{ $i }}</td>
                    <td class="desc">{{ $facility }}</td>
                    <td class="total">{{ $contractData->garageCharge }}</td>
                  </tr>
                  @elseif($facility=="Guard")
                  <tr>
                    <td class="service">{{ $i }}</td>
                    <td class="desc">{{ $facility }}</td>
                    <td class="total">{{ $contractData->guardBill }}</td>
                  </tr>
                  @else
                  <tr>
                    <td class="service">{{ $i }}</td>
                    <td class="desc">{{ $facility }}</td>
                    <td class="total">0</td>
                  </tr>
                  @endif   
                  @php
                $i++;
                @endphp              
                @endforeach
                @if($contractData->otherBill != null)
                  @foreach($contractData->otherBill as $facility)
                  <tr>
                    <td class="service">{{ $i }}</td>
                    <td class="desc">{{ $facility['billName'] }}</td>
                    <td class="total">{{ $facility['billAmount'] }}</td>
                  </tr>
                  @php
                  $i++;
                  @endphp 
                  @endforeach 
                @endif
                           
                
                {{-- <tr>
                  <td colspan="4">SUBTOTAL</td>
                  <td class="total">$5,200.00</td>
                </tr>
                <tr>
                  <td colspan="4">TAX 25%</td>
                  <td class="total">$1,300.00</td>
                </tr> --}}
                {{-- <tr>
                  <td class="grand total">GRAND TOTAL</td>
                  <td class="grand total">$6,500.00</td>
                </tr> --}}
                <tr>
                  <td></td>
                  <td colspan="1" class="total">Total</td>
                  <td class="total">{{ $totalAmount }}</td>
                </tr>
              </tbody>
            </table>
            <div id="notices">
              <div>NOTICE:</div>
              <div class="notice">Please Pay this bill within 10 days.</div>
            </div>
        </main>
        <br>
        {{-- <footer>
        Invoice was created on a computer and is valid without the signature and seal.
        </footer> --}}
    </div>
    <div class="col-md-2"></div>
</div>
@endsection

@section('script')
@endsection