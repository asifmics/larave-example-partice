@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-lg-12">
               @php
                  $data=App\Models\Payment::with('serviceInfo', 'catInfo', 'patientInfo')->where('payment_status',1)->where('payment_slug',$slug)->where('patient_id',$id)->firstOrFail();
                  $all=App\Models\Payment::with('serviceInfo', 'catInfo', 'patientInfo')->where('payment_status',1)->where('patient_id',$id)->get();
                  $totalPrice=App\Models\Payment::with('serviceInfo', 'catInfo', 'patientInfo')->where('payment_status',1)->where('patient_id',$id)->sum('payment_price');
                  $totalPayable=App\Models\Payment::with('serviceInfo', 'catInfo', 'patientInfo')->where('payment_status',1)->where('patient_id',$id)->sum('payment_payable');
                  
                @endphp
      <div class="card">
          <div class="card-body">
              <div class="invoice-title">
                  <h4 class="float-right font-size-16">Patient Id # {{$data->patientInfo->patient_code}}</h4>
                  <div class="mb-4">
                    <img src="{{(@$data->patientInfo->patient_photo!='')?asset('uploads/patients/'.@$data->patientInfo->patient_photo):asset('uploads/avatar/avatar-black.jpg')}}" alt="logo" height="40"/>
                  </div>
              </div>
              <hr>
              <div class="row">
                  <div class="col-sm-6">
                      <address>
                          <strong>Patient:</strong><br>
                          Name: {{$data->patientInfo->patient_name}}<br>
                          Phone: {{$data->patientInfo->patient_phone}}<br>
                          Blood: {{$data->patientInfo->patient_blood}}<br>
                          Email: {{$data->patientInfo->patient_email}}
                      </address>
                  </div>
                  <div class="col-sm-6 text-sm-right">
                      <address class="mt-2 mt-sm-0">
                          <strong>Therapy Center:</strong><br>
                          Creative Shaper<br>
                          0123456789<br>
                          info@CreativeShaper.com<br>
                          Dhanmondi, Dhaka
                      </address>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-6 mt-3">
                      <address>
                          <strong>Payment Method:</strong><br>
                          Handcash
                      </address>
                  </div>
                  <div class="col-sm-6 mt-3 text-sm-right">
                      <address>
                          <strong>Payment Date:</strong><br>
                          {{date('M-d-Y',strtotime($data->created_at))}}<br><br>
                      </address>
                  </div>
              </div>
              <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
                          <tr class="text-center">
                            
                          </tr>
                          <tr>
                            <td>Service Price</td>
                            <td>:</td>
                            <td>{{$data->payment_price}}.00 TK</td>
                          </tr>
                          <tr>
                            <td>Discount Price</td>
                            <td>:</td>
                            <td>{{$data->payment_price-$data->payment_payable}}.00 TK</td>
                          </tr>
                          <tr>
                            <td>Payable Amount</td>
                            <td>:</td>
                            <td>{{$data->payment_payable}}.00 TK</td>
                          </tr>
                      </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                
              <div class="py-2 mt-3">
                  <h3 class="font-size-15 font-weight-bold">Payment summary</h3>
              </div>
              <div class="table-responsive">
                  <table class="table table-nowrap">
                      <thead>
                          <tr>
                              <th style="width: 70px;">No.</th>
                              <th>Category</th>
                              <th>Service</th>
                              <th>Days</th>
                              <th>Price</th>
                              <th>Discount</th>
                              <th>Payable</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($all as $key => $pay)
                      <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$pay->catInfo->category_name}}</td>
                      <td>{{$pay->serviceInfo->service_name}}</td>
                      <td>{{$pay->payment_days}}</td>
                      <td>{{$pay->payment_price}}.00 TK</td>
                      <td>{{$pay->payment_price-$pay->payment_payable}}.00 TK</td>
                      <td>{{$pay->payment_payable}}.00 TK</td>
                      </tr>
                      @endforeach
                      <tr><td></td></tr>
                      <tr>
                          <td colspan="4" class="text-right">Total Price</td>
                          <td class="">{{$totalPrice}}.00 TK</td>
                      </tr>
                      <tr>
                          <td colspan="5" class="border-0 text-right">
                              <strong>Discount</strong></td>
                          <td class="border-0 ">{{$totalPrice-$totalPayable}}.00 TK</td>
                      </tr>
                      <tr>
                          <td colspan="6" class="border-0 text-right">
                              <strong>Total Pay</strong></td>
                          <td class="border-0 "><h4 class="m-0">{{$totalPayable}}.00 TK</h4></td>
                      </tr>
                      </tbody>
                  </table>
              </div>
              <div class="d-print-none">
                  <div class="float-right">
                      <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                      <a href="{{url('dashboard/payment/pdf/'.$data->patient_id.'/'.$data->payment_slug)}}" target="_blank" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
