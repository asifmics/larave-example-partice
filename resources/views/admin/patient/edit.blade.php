@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/patient/update')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Edit patient Information </h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/patient')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All patient</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-7">
                      @if(Session::has('success'))
                        <div class="alert alert-success alertsuccess" role="alert">
                           <strong>Success!</strong> {{Session::get('success')}}
                        </div>
                      @endif
                      @if(Session::has('error'))
                        <div class="alert alert-danger alerterror" role="alert">
                           <strong>Opps!</strong> {{Session::get('error')}}
                        </div>
                      @endif
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="name" value="{{$data->patient_name}}">
                    <input type="hidden" name="id" value="{{$data->patient_id}}">
                    <input type="hidden" name="slug" value="{{$data->patient_slug}}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="phone" value="{{$data->patient_phone}}">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Email</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" autocomplete="off" class="form-control form_control" name="email" value="{{$data->patient_email}}">
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('gender') ? ' has-error' : '' }}">
            <label class="col-sm-3 col-form-label col_form_label">Gender<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <select class="form-control form_control" name="gender" >
                <option value="">Select Gender</option>
                <option value="Male" {{(@$data->patient_gender=='Male')?'selected':''}}>Male</option>
                <option value="Female" {{(@$data->patient_gender=='Female')?'selected':''}}>Female</option>
              </select>
              @if ($errors->has('gender'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('gender') }}</strong>
                  </span>
              @endif
            </div>
        </div>
        <div class="form-group row mb-3 {{ $errors->has('blood') ? ' has-error' : '' }}">
            <label class="col-sm-3 col-form-label col_form_label">Blood Group<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <select class="form-control form_control" name="blood" >
                <option value="">Select Blood Group</option>
                <option value="A+" {{(@$data->patient_blood=='A+')?'selected':''}}>A+</option>
                <option value="A-" {{(@$data->patient_blood=='A-')?'selected':''}}>A-</option>
                <option value="B+" {{(@$data->patient_blood=='B+')?'selected':''}}>B+</option>
                <option value="B-" {{(@$data->patient_blood=='B-')?'selected':''}}>B-</option>
                <option value="AB+" {{(@$data->patient_blood=='AB+')?'selected':''}}>AB+</option>
                <option value="AB-" {{(@$data->patient_blood=='AB-')?'selected':''}}>AB-</option>
                <option value="O+" {{(@$data->patient_blood=='O+')?'selected':''}}>O+</option>
                <option value="O-" {{(@$data->patient_blood=='O-')?'selected':''}}>O-</option>
              </select>
              @if ($errors->has('blood'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('blood') }}</strong>
                  </span>
              @endif
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
            <div class="col-sm-4">
              <div class="input-group">
                  <span class="input-group-btn">
                      <span class="btn btn-default btn-file btnu_browse">
                          Browse… <input type="file" name="pic" id="imgInp">
                      </span>
                  </span>
                  <input type="text" class="form-control" readonly>
              </div>
            </div>
            <div class="col-md-2">
                <img id="img-upload" src="{{(@$data->patient_photo!='')?asset('uploads/patients/'.@$data->patient_photo):asset('uploads/avatar/avatar-black.jpg')}}">
            </div>
        </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
