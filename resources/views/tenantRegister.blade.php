@extends('ui.admin_panel.master')

@section('title','Register Tenant')

@section('style')
<style>
    .display {
        display: none;
    }

</style>
@endsection

@section('content_title', 'Register Tenant')

@section('main_content')
<div class="row page-content">
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
        <form action="/tenantStore" method="post" enctype="multipart/form-data">
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                {{-- <div class="card-header">
                    <h3 class="card-title">Add Prperty</h3>
                  </div> --}}
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Basic Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Identification Document</label>
                                            <input type="file" class="form-control" id="image" name="image"
                                            onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img height="100px" width="180px" id="output" src=""
                                        alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="nidNo" class="form-label">National ID No</label>
                                    <input type="text" class="form-control" id="nidNo" name="nidNo"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="propertyContent">
                        <h6>Work Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ocupation" class="form-label">Ocupation Status</label>
                                    <select class="form-select" id="ocupation" name="ocupation" required>
                                        <option selected disabled value="">Choose..</option>
                                        <option value="Business">Business</option>
                                        <option value="Service Holder">Service Holder</option>
                                        <option value="Self Employed">Self Employed</option>
                                        <option value="Job seeker">Job seeker</option>
                                        <option value="Student">Student</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="workPlace" class="form-label">Work Place</label required>
                                    <input type="text" class="form-control" id="workPlace" name="workPlace"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="propertyContent">
                        <h6>Emergency Contact</h6>
                        <div class="mb-3">
                            <label for="relation" class="form-label">Relation</label>
                            <select class="form-select" id="relation" name="relation" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Friend">Friend</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">                                
                                <div class="mb-3">
                                    <label for="relativeName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="relativeName" name="relativeName"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="relativePhone" class="form-label">Phone No</label>
                                    <input type="text" class="form-control" id="relativePhone" name="relativePhone"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" mx-auto mb-5">
                    <button class="btn btn-warning" type="submit">Register Tenant</button>
                </div>
            </div>
            {{-- card-body end --}}
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection
