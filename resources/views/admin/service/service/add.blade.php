@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/service/submit')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> New Service</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/service')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Service</a>
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
                  <label class="col-sm-3 col-form-label col_form_label">Service Name<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('price') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Service Price<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="price" value="{{old('price')}}">
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Service Category<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <select class="form-control form_control" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($allCat as $cat)
                        <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Remarks:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="remarks" value="{{old('remarks')}}">
                  </div>
              </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">UPLOAD</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
