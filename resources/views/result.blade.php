@extends('ui.admin_panel.master')

@section('title','property list')
@section('style')
<style>
    /* The Modal (background) */
 .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 150px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        /* left:80px; */
        border: 1px solid #888;
        width: 50%;
        display:flex;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        font-size: 28px;
        float:right;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .display{
        display:none;
    }
</style>
@endsection

@section('content_title', 'Student Result')

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
            <div class=" d-flex flex-row-reverse mb-3">
                <button class="btn btn-warning" id="addBtn">Add Result</button>
            </div>            
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Roll No</th>
                    <th scope="col">Group</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i=1;
                  @endphp       
                </tbody>
              </table>  
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div>
           
        <span class="close">&times;</span>
        </div>
        <div>
            <h4>Add Result</h1>
        <form action="/studentResult" method="post" id="form">
        @csrf
        <div class="mb-3">
            <label for="sName" class="form-label">Student Name</label>
            <input type="text"  class="form-control" id="sName" name="sName" required>
        </div>
        <div class="mb-3">
            <label for="roll" class="form-label">Roll No.</label>
            <input type="text"  class="form-control" id="roll" name="roll" required>
        </div>
        <div class="form-group">
            <label for="group">Group</label>
            <select name="group" id="group" class="form-control">
                <option value="">Select</option>
                <option value="Science">Science</option>
                <option value="Commerce">Commerce</option>
                <option value="Arts">Arts</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="fName" class="form-label">Father Name</label>
            <input type="fName"  class="form-control" id="fName" name="fName" required>
        </div>
        <div class="mb-3">
            <label for="nName" class="form-label">Mother Name</label>
            <input type="text"  class="form-control" id="nName" name="nName" required>
        </div>
        <div class="mb-3">
            <label  class="form-label">Result:</label>
            <button id="addBill" type="button" class="btn btn-warning">Add Subject & Mark</button>
        </div>
        <div id="otherBill"></div>
        <div class="d-flex justify-content-center">
            <button type="submit" id="prodcut_save" class="btn btn-warning">Save</button>
        </div>
        
    </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#addBtn").click(function(){            
            document.querySelector('#myModal').style.display = 'block';
        });

        $('.close').on('click', function () {
        document.querySelector('#myModal').style.display = 'none';
        $("form")[0].reset();
        location.reload(true);
        });

        // on button click other bill add option
        var html = `<div id="moreBill">
                    <input class="btn btn-danger  float-right rounded-circle mt-4" type="button" name="remove_btn" id="remove_btn" value="x">
                    <div class="row">
                        <div class="col">
                            <label for="subName" class="form-label">Subject Name</label>
                            <select class="form-control" id="subName" name="subName[]">
                                <option value="en">Select</option>
                                <option value="en">English</option>
                                <option value="bn">Bangla</option>
                                <option value="mt">Math</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="otherBillMarkAmount" class="form-label">Mark</label>
                            <input type="text" class="form-control" id="Mark" name="Mark[]">
                        </div>
                    </div>
                     </div><br>`;
        $("#addBill").click(function () {
            $("#otherBill").append(html);
        });
        $("#otherBill").on('click', '#remove_btn', function () {
        $(this).parent('div').remove();
        });
    });
</script>
@endsection