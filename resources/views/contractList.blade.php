@extends('ui.admin_panel.master')

@section('title','Contract List')

@section('style')
@endsection

@section('content_title', 'Contract List')

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
              <table class="table" id="table_id">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Tenant Name</th>
                      <th scope="col">Property Name</th>
                      <th scope="col">Unit Name</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php
                      $i=1;
                      @endphp
                      @foreach($contract as $row)
                      @php
                      $propertyName = \App\Models\Property::select('propertyName')->where(['id' => $row->propertyName])->first();
                      $tenantName = \App\Models\Tenant::select('name')->where(['id' => $row->tenantName])->first();
                      $unitName = \App\Models\Unit::select('unitName')->where(['id' => $row->unitName])->first();
                      @endphp
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $tenantName['name'] }}</td>
                        <td>{{ $propertyName->propertyName }}</td>
                        <td>{{ $unitName['unitName'] }}</td>
                        <td>
                            <a href="{{ URL('/tenantEdit',$row->id) }}" class="text-warning" title="Edit"><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ URL('/tenantDelete',$row->id) }}" class="text-danger" title="Delete"><i
                                    class="fas fa-trash"></i></a>
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
      {{-- card-body end --}}
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function () {
      $('#table_id').DataTable();
  });
</script>
@endsection