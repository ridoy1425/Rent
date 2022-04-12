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
                        <a href="#" class="btn btn-warning payment">Payment</a>
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
                        <a href="#" class="btn btn-warning payment">Payment</a>
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
                        <a href="#" class="btn btn-warning payment">Payment</a>
                    </td>
                  </tr>
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
          <form id="action_btn" action="" method="post">
              <input type="hidden" value="" name="id">
              <div id="action"></div>
              <div class="box-body">
                  <h5>Payment</h5>
                  <div class="mb-3">
                      <label for="total_amt" class="form-label">Total Amount</label>
                      <input type="text" class="form-control" id="total_amt" name="total_amt" required>
                  </div>
                  <div class="mb-3">
                      <label for="pay_amt" class="form-label">Payment Amount</label>
                      <input type="text" class="form-control" id="pay_amt" name="pay_amt" required>
                  </div>
                  <div class="mb-3">
                      <label for="due_amt" class="form-label">Due Amount</label>
                      <input type="text" class="form-control" id="due_amt" name="due_amt" required>
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
      document.querySelector('#reject_modal').style.display = 'block';
    });

    $('.close').on('click', function () {
        document.querySelector('#reject_modal').style.display = 'none';
    });
  });
</script>
@endsection