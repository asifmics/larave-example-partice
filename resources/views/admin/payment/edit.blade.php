@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/payment/update')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Edit payment Information </h4>
                    </div>
                    @php
                    $pslug= $data->patientInfo->patient_slug;
                    @endphp
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/patient/view/'.$pslug)}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All payment</a>
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
        
            
                <div class="form-group row mb-3 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Category<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    @php
                       $allCat=App\Models\ServiceCategory::where('category_status',1)->orderBy('category_id','ASC')->get();
                    @endphp
                    <select class="form-control form_control" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach($allCat as $cat)
                        <option value="{{$cat->category_id}}" {{($cat->category_id==$data->category_id)?'selected':''}}>{{$cat->category_name}}</option>
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
                  <label class="col-sm-3 col-form-label col_form_label">Service<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                   <select class="form-control form_control" name="service_id" required>
                        <option value="{{$data->service_id}}">{{$data->serviceInfo->service_name}}</option>
                        
                    </select>
                    @if ($errors->has('service_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('service_id') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
               <div class="form-group row mb-3 {{ $errors->has('price') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Price<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="price"  id="price" value="{{$data->payment_price}}" readonly>
                    <input type="hidden"name="patient_id"value="{{$data->patient_id}}">
                    <input type="hidden"name="id"value="{{$data->payment_id}}">
                    <input type="hidden"name="pslug"value="{{$pslug}}">
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Discount<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="number" class="form-control form_control" name="name" value="{{$data->payment_price-$data->payment_payable}}" id="discount" autocomplete="off">
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Payable<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" required class="form-control form_control" name="payable" value="{{$data->payment_payable}}" id="payable" readonly>
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Pay Now<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" required class="form-control form_control" name="paynow" value="{{$data->payment_pay}}" id="paynow">
                  </div>
              </div> 
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Due Amount<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" required class="form-control form_control" value="{{$data->payment_payable-$data->payment_pay}}" id="due" readonly>
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Days<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" required class="form-control form_control" name="days" value="{{$data->payment_days}}" required autocomplete="off">
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


<!-- 
<script type="text/javascript">
  $(document).ready(function(){

    $('select[name="category_id"]').on('change',function(){
      var category_id= $(this).val();
       // alert(category_id);
      if(category_id){
        $.ajax({
          url:"{{url('dashboard/service/getService')}}/"+category_id,
          type:"GET",
          dataType:"json",
          success:function(data){
            var d = $('select[name="service_id"]').empty();
              $.each(data, function(key, value){
                  $('select[name="service_id"]').append('<option value="'+value.service_id+'">'+value.service_name+'</option>');
              });
          }
        });
      }

    });

  });
</script> -->


<script type="text/javascript">
  $(document).ready(function(){
    $('select[name="category_id"]').on('change',function(){
      var category_id= $(this).val();
       // alert(category_id);
      if(category_id){
        $.ajax({
          url:"{{url('dashboard/service/getService')}}/"+category_id,
          type:"GET",
          dataType:"json",
          success:function(data){
            var d = $('select[name="service_id"]').empty();
              $.each(data, function(key, value){
                  $('select[name="service_id"]').append('<option value="'+value.service_id+'">'+value.service_name+'</option>');
              });
          }
        });
      }
    });

    $('select[name="service_id"]').on('change',function(){
      var service_id= $(this).val();
       // alert(service_id);
      if(service_id){
        $.ajax({
          url:"{{url('dashboard/service/getPrice')}}/"+service_id,
          type:"GET",
          dataType:"json",
          success:function(data){
              $("#price").val(data.service_price);
          }
        });
      }
    });
  });



  $(document).ready(function(){
      $("#price, #discount").keyup(function(){
          var total=0;
          var price = $("#price").val();
          var discount = $("#discount").val();
          var total= price-discount;
          $("#payable").val(total);
      });
  });


  $(document).ready(function(){
      $("#payable, #paynow").keyup(function(){
          var total=0;
          var payable = $("#payable").val();
          var paynow = $("#paynow").val();
          var total= payable-paynow;
          $("#due").val(total);
      });
  });
</script>
@endsection
