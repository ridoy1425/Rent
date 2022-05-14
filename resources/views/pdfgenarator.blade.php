<style>

.clearfix a {
  color: black;
  /* text-decoration: underline; */
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
  width: 100%;
  display:flex
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

.company {
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

table td.project{
  text-align: left;
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
  padding: 5 15px;
  text-align: left;
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

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
  
}
</style>

@php
$contractData = json_decode($contractData);
$userInfo = json_decode($userInfo);
@endphp
<body>
<header class="clearfix">
    <h1>INVOICE</h1>
    <table>
      <tr>
        <td>
          <div id="project" class="project">
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
        </td>
        <td>
          <div id="company" class="company">
            <div><b>Bill To</b></div>
            <div><span>Name:</span>{{ $contractData->tenentName }}</div>
            {{-- <div><span>Profession:</span>{{ $contractData->tenentProfession }}</div> --}}
            <div><span>Phone:</span>{{ $contractData->tenentPhone }}</div>
            <div><span>Email:</span><a href="mailto:company@example.com">company@example.com</a></div>
          </div>
        </td>
      </tr>
    </table>
    
    
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
            <td class="desc">{{ $facility->billName }}</td>
            <td class="total">{{ $facility->billAmount }}</td>
          </tr>
          @php
          $i++;
          @endphp 
          @endforeach 
        @endif
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
<footer>
Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>