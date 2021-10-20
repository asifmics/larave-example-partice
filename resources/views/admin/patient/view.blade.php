@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> View patient Information</h4>
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
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
                          <tr>
                            <td>P-ID</td>
                            <td>:</td>
                            <td>{{$data->patient_code}}</td>
                          </tr>
                          <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{$data->patient_name}}</td>
                          </tr>
                          <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>{{$data->patient_phone}}</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{$data->patient_email}}</td>
                          </tr>
                          <tr>
                            <td>Gender</td>
                            <td>:</td>
                            <td>{{$data->patient_gender}}</td>
                          </tr>
                          <tr>
                            <td>Blood</td>
                            <td>:</td>
                            <td>{{$data->patient_blood}}</td>
                          </tr>
                          <tr>
                            <td>Photo</td>
                            <td>:</td>
                            <td>
                              @if($data->patient_photo!='')
                                <img class="img-thumbnail img200" src="{{asset('uploads/patients/'.$data->patient_photo)}}"/>
                              @else
                                <img class="img-thumbnail img200" src="{{asset('uploads/avatar/avatar-black.jpg')}}"/>
                              @endif
                            </td>
                          </tr>
                          <br>
                      </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                 <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7 text-center">
                 <a class="btn btn-success" href="#" id="softDelete" title="Add Payment" data-toggle="modal" data-target="#paymentModal" data-id="">ADD PAYMENT</a>
                </div>
                <div class="col-md-2"></div>
            </div>
            </div>
            <div class="card-footer">
              <div >
                  <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                    <thead class="thead-dark">
                      <tr>
                          <th>SL.</th>
                          <th>Category</th>
                          <th>Service</th>
                          <th>Price</th>
                          <th>Discount</th>
                          <th>Payable</th>
                          <th>Paid</th>
                          <th>Due</th>
                          <th>Days</th>
                          <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($all as $key => $pay)
                      <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$pay->catInfo->category_name}}</td>
                      <td>{{$pay->serviceInfo->service_name}}</td>
                      <td>{{$pay->payment_price}}</td>
                      <td>{{$pay->payment_price-$pay->payment_payable}}</td>
                      <td>{{$pay->payment_payable}}</td>
                      <td>{{$pay->payment_pay}}</td>
                      <td>{{$pay->payment_payable-$pay->payment_pay}}</td>
                      <td>{{$pay->payment_days}}</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-dark btn-sm" type="button">Manage</button>
                          <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split waves-effect btn-label waves-light card_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-chevron-down"></i>
                          </button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" href="">Publish</a>
                              <a class="dropdown-item" href="{{url('dashboard/payment/edit/'.$data->patient_id.'/'.$pay->payment_slug)}}">Edit</a>
                              <a class="dropdown-item" href="{{url('dashboard/payment/invoice/'.$data->patient_id.'/'.$pay->payment_slug)}}">Invoice</a>
                              <a class="dropdown-item" href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id="{{$pay->payment_id}}">Delete</a>
                          </div>
                        </div>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>


<!--softdelete modal start-->
<div id="softDelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('dashboard/payment/softdelete')}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
        </div>
        <div class="modal-body modal_card">
          Are you sure you want to delete?
          <input type="hidden" id="modal_id" name="modal_id">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">Confirm</button>
            <button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>



<!-- Add Payment -->
<div id="paymentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('dashboard/payment/submit')}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> ADD PAYMENT</h5>
        </div>
        <div class="modal-body modal_card">
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="name" value="{{$data->patient_name}}" readonly>
                    <input type="hidden"  name="patient_id" value="{{$data->patient_id}}">
                    <input type="hidden"  name="pslug" value="{{$data->patient_slug}}">
                  </div>
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
                  <label class="col-sm-3 col-form-label col_form_label">Service<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                   <select class="form-control form_control" name="service_id" required>
                        <option value="">Select Service</option>
                        
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
                    <input type="text" class="form-control form_control" name="price"  id="price" value="" readonly>
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
                    <input type="number" class="form-control form_control" value="" id="discount" autocomplete="off">
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Payable<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" required class="form-control form_control" name="payable" value="" id="payable" readonly>
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Pay Now<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" required class="form-control form_control" name="paynow" value="" id="paynow">
                  </div>
              </div> 
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Due Amount<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" required class="form-control form_control" value="" id="due" readonly>
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Days<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" required class="form-control form_control" name="days" value="" required autocomplete="off">
                  </div>
              </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">Confirm</button>
            <button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- <script type="text/javascript">
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



<!-- <script type="text/javascript">
  $(function(){
  $('#service').on('change', function(){
    var id = $(this).val();
    var url = window.origin + 'admin/service/package/' + id;

    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'HTML',
      success: function(data) {
        $('#package').html(data);
      }
    });
  });


  });
</script> -->