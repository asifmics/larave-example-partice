@extends('admin.account.profile')
@section('member')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>My Personal Information</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">User ID</p>
                  <h4 class="profile_highlight_text">{{Auth::user()->code}}</h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Name</p>
                  <h4 class="profile_highlight_text">{{Auth::user()->name}}</h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Phone</p>
                  <h4 class="profile_highlight_text">
                    {{Auth::user()->phone}}
                  </h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Email</p>
                  <h4 class="profile_highlight_text">
                    {{Auth::user()->email}}
                  </h4>
              </div>
          </div>
          
        </div>
        <div class="col-md-4">
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Company</p>
                  <h4 class="profile_highlight_text">
                    Creative shaper
                  </h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Address</p>
                  <h4 class="profile_highlight_text">
                      Dhanmondi Dhaka.
                  </h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Phone</p>
                  <h4 class="profile_highlight_text">
                    {{Auth::user()->phone}}
                  </h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Email</p>
                  <h4 class="profile_highlight_text">
                    {{Auth::user()->email}}
                  </h4>
              </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Gender</p>
                  <h4 class="profile_highlight_text">{{Auth::user()->gender}}</h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Blood Group</p>
                  <h4 class="profile_highlight_text">{{Auth::user()->blood}}</h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Religion </p>
                  <h4 class="profile_highlight_text">Islam</h4>
              </div>
          </div>
          <div class="media mb-3">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Website</p>
                  <h4 class="profile_highlight_text">
                    ----
                  </h4>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer card_footer">
      <div class="btn-group mt-2" role="group">
          <a href="#" class="btn btn-secondary">Print</a>
          <a href="#" class="btn btn-dark">PDF</a>
          <a href="#" class="btn btn-secondary">Excel</a>
      </div>
    </div>
</div>
@endsection
