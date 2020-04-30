@extends('layouts.app')
@section('head')
    <link href="{{ asset('module/booking/css/checkout.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <div id="bravo-checkout-page" >
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="form-title">{{__('Booking Submission')}}</h3>
                         <div class="booking-form">
                             @include ($service->checkout_form_file ?? 'Booking::frontend/booking/checkout-form')
                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="booking-detail">
                            @include ($service->checkout_booking_detail_file ?? '')
                            
                            {{-- start modal --}}

                            {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        
                                        <div class="modal-header">
                                        <h4 class="modal-title">Аялагчийн мэдээлэл</h4>
                                            <hr>
                                            
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                        </div>
                                        <div class="body">
                                            
                                                    
                                             @include('Booking::frontend/booking/add_form')
                                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- end modal --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('module/booking/js/checkout.js') }}"></script>
    <script type="text/javascript">
        jQuery(function () {
            $.ajax({
                'url': bookingCore.url + '/booking/{{$booking->code}}/check-status',
                'cache': false,
                'type': 'GET',
                success: function (data) {
                    if (data.redirect !== undefined && data.redirect) {
                        window.location.href = data.redirect
                    }
                }
            });
        })
    </script>
@endsection