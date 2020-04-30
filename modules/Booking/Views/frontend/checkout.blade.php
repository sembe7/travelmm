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
                            <div class="col-md-6">
                                <button style="width: 320px" type="button" class="create-modal btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    Хамтран аялагчийн мэдээлэл нэмэх 
                                    {{-- <i class="fa fa-plus"></i> --}}
                                </button>
                            </div>
                            
                            @include('Booking::frontend/booking/add_form')
                            {{-- start modal --}}

                            {{-- Count guests --}}
        
        <div class="col-md-12" id="table_refresh">
            <div class="form-group">
 
                    <div class="table table-responsive">
                        <table class="table table-bordered " id="table">
                            <tr>
                                <th>№</th>
                                <th style="width:400px">Нэр</th>
                                {{-- <th style="width:400px">и-мэил</th>
                                <th style="width:300px">утас</th> --}}
                                <th> 
                                    
                                </th>
                                <th > 
                                    
                                </th>
                            </tr>
                            {{ csrf_field() }}
                            <?php
                                $childrens = $user->children()->get();
                                $no=1; 
                            ?>
                            {{-- @if ($user->parent_id = $user->id) --}}
                            {{-- @for ($i = 1; $i < $booking->total_guests; $i++) --}}
                                @foreach ($childrens as $item) 
                                <tr>
                                    <td>{{$no++}}  </td>
                                    <td>{{ $item->name}}  </td>
                                    {{-- <td>{{ $item->email}}</td>
                                    <td>{{ $item->phone}}    </td> --}}
                                    <td> 
                                        {{-- <a href="#" class="show-modal btn btn-info btn-xs" style="width: 30%">
                                            <i class="fa fa-eye"></i>
                                        </a> --}}
                                        <button type="button" value={{$item->id}} class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg{{$item->id}}"
                                            data-id="{{$ids = $item->id}}" >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        @include('Booking::frontend/booking/edit_form')
                                        </td>
                                        <td>
                                    <form method="post" class="delete-form" action="{{action('\Modules\User\Controllers\UserController@delete',$item->id)}}">
                                        @csrf
                                            <button type="submit" class="delete-modal btn btn-danger" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            {{-- @endfor --}}
                            {{-- @endif --}}
                        </table>
                    </div>
                
            </div>
        </div>

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