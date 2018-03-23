@extends('layouts.master')

@section('title', 'NDRMS - General Settings')

@section('content')

    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header bg-info">
                Account Settings

                <div class="card-actions">
                   <a href="#" class="btn btn-sm">
                       <i class="fa fa-pencil-alt"></i> Edit profile
                   </a>

                   <a href="#" class="btn btn-sm">
                       <i class="fa fa-cog"></i> Edit Settings
                   </a>
               </div>
            </div>

            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-4 mb-4">
                        <h4 class="text-info">Profile Information</h4>
                        <div class="text-muted small">These information are visible to the top Administration.</div>
                        <img src="{{ asset('imgs/avatar-1.png') }}" class="avatar avatar-lg img-responsive" alt="Profile photo">
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <input class="form-control" value="{{ $currentUser->name }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Address</label>
                                    <input class="form-control" value="{{ $currentUser->address }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Tel No.</label>
                                    <input class="form-control" value="{{ $currentUser->phone }}" disabled>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input class="form-control" value="{{ $currentUser->email }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Gender</label>
                                    <input class="form-control" value="{{ $currentUser->gender }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Account Status</label>
                                    <input class="form-control" value="{{ $currentUser->status == 1 ? 'Active' : 'Inactive' }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row mt-1">

                  <div class="col-md-12">
                    <h4 class="text-info"> <strong>HEALTH FACILITY</strong> </h4>

                    <div class="text-muted small">You have been assigned to this Health Facility and all your activities reflect the ones of this Health Facility</div>

                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Name</label>
                          <input type="text" class="form-control" value="{{ $currentUser->healthFacility->name or 'Not Found'}}" disabled>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Health Facility Level</label>
                          <input type="text" class="form-control" value="{{ $currentUser->healthFacility->level or 'Not Found'}}" disabled>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Health Sub Disrict</label>
                          <input type="text" class="form-control" value="{{ $currentUser->healthFacility->healthSubDistrict->name or 'Not Found'}}" disabled>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">HSD Population</label>
                          <input type="text" class="form-control" value="{{ number_format($currentUser->healthFacility->healthSubDistrict->population) }}" disabled>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">District</label>
                          <input type="text" class="form-control" value="{{ $currentUser->healthFacility->healthSubDistrict->district->name or 'Not Found'}}" disabled>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Region</label>
                          <input type="text" class="form-control" value="{{ $currentUser->healthFacility->healthSubDistrict->district->region->name or 'Not Found'}}" disabled>
                      </div>
                  </div>
              </div>

            </div>

            <div class="card-footer bg-info text-right">
                <button type="submit" class="btn btn-warning"> <i class="icon icon-pencil"></i> Edit Your Profile</button>
            </div>
        </div>
    </div>
@endsection
