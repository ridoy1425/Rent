@extends('ui.admin_panel.master')

@section('title','Edit Tenant')

@section('style')
<style>
    .display {
        display: none;
    }

</style>
@endsection

@section('content_title', 'Edit Tenant')

@section('main_content')
<div class="row page-content">
    <div class="container">
        <form action="{{ URL('/tenantUpdate',$tenant->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Basic Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value="{{ $tenant->name }}" id="name" name="name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" value="{{ $tenant->phone }}" id="phone" name="phone"
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
                                        <img height="100px" width="180px" id="output" src="{{ asset('images/'.$tenant->image) }}"
                                        alt="{{ $tenant->image }}">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{ $tenant->email }}" id="email" name="email"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="nidNo" class="form-label">National ID No</label>
                                    <input type="text" class="form-control" value="{{ $tenant->nidNo }}" id="nidNo" name="nidNo"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" value="{{ $tenant->address }}" id="address" name="address"
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
                                        <option selected value="{{ $tenant->ocupation }}">{{ $tenant->ocupation }}</option>
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
                                    <input type="text" class="form-control" value="{{ $tenant->workPlace }}" id="workPlace" name="workPlace"
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
                                <option selected value="{{ $tenant->relation }}">{{ $tenant->relation }}</option>
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
                                    <input type="text" class="form-control" value="{{ $tenant->relativeName }}" id="relativeName" name="relativeName"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="relativePhone" class="form-label">Phone No</label>
                                    <input type="text" class="form-control" value="{{ $tenant->relativePhone }}" id="relativePhone" name="relativePhone"
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
