<?php 
    use Illuminate\Support\Facades\DB;
?>
<div class="modal fade" id="modal-booking-{{$booking->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__("Booking ID")}}: #{{$booking->id}}</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#booking-detail-{{$booking->id}}">{{__("Booking Detail")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#booking-customer-{{$booking->id}}">{{__("Your Information")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#booking-with-{{$booking->id}}">{{__("Хамтран аялагчид")}}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="booking-detail-{{$booking->id}}" class="tab-pane active"><br>
                        <div class="booking-review">
                            <div class="booking-review-content">
                                <div class="review-section">
                                    <div class="info-form">
                                        <ul>
                                            <li>
                                                <div class="label">{{__('Booking Date')}}</div>
                                                <div class="val">{{display_date($booking->created_at)}}</div>
                                            </li>
                                            @if(!empty($booking->gateway))
                                                <?php $gateway = get_payment_gateway_obj($booking->gateway);?>
                                                <li>
                                                    <div class="label">{{__('Payment Method')}}</div>
                                                    <div class="val">{{$gateway->name}}</div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="more-booking-review">
                            @include ($service->checkout_booking_detail_file ?? '')
                        </div>
                    </div>
                    <div id="booking-customer-{{$booking->id}}" class="tab-pane fade"><br>
                        @include ($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info')
                    </div>

                    
                    <div id="booking-with-{{$booking->id}}" class="tab-pane fade"><br>
                        <div class="col-md-12">
                            <div class="form-group">
                 
                                    <div class="table table-responsive">
                                        <table class="table table-bordered " id="table">
                                            <tr>
                                                <th>№</th>
                                                <th style="width:400px">Нэр</th>
                                                <th style="width:400px">и-мэил</th>
                                                <th style="width:300px">утас</th>
                                                <th style="width:500px"> 
                                                    
                                                </th>
                                            </tr>
                                            {{ csrf_field() }}
                                            <?php
                                                
                                                
                                                // $user = App\User::where($booking->customer_id,1)->get();
                                                // echo $user;
                                                //$users =new App\User;
                                                // $user = new App\User;
                                                // $childrens = $users->children()->get();
                                                // print_r($childrens);
                                                $childrens = DB::table('users')
                                                    ->where('parent_id',$booking->customer_id)
                                                    ->where('deleted_at',null)
                                                    ->get();
                                                //$childrens = $users->children()->get();
                                                $no=1; 
                                            ?>
                                            {{-- @if ($user->parent_id = $user->id) --}}
                                            {{-- @for ($i = 1; $i < $booking->total_guests; $i++) --}}
                                                
                                                    @foreach ($childrens as $item) 
                                                    <tr>
                                                        <td>{{$no++}}  </td>
                                                        <td>{{ $item->name}}  </td>
                                                        <td>{{ $item->email}}</td>
                                                        <td>{{ $item->phone}}    </td>
                                                        <td> 
                                                            {{-- <a href="#" class="show-modal btn btn-info btn-xs" style="width: 30%">
                                                                <i class="fa fa-eye"></i>
                                                            </a> --}}
                                                            {{-- <a type="button" value={{$item->id}} class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg"
                                                                data-id="{{$item->id}}">
                                                                <i class="fa fa-pencil"></i>{{$item->id}}
                                                            </a>
                                                            <a href="#" class="delete-modal btn btn-danger" style="width: 30%">
                                                                <i class="fa fa-trash"></i>
                                                            </a> --}}
                                                        </td>
                                                    </tr>
                                                    
                                                    @endforeach
                                            {{-- @endfor --}}
                                            {{-- @endif --}}
                                        </table>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="btn btn-secondary" data-dismiss="modal">{{__("Close")}}</span>
            </div>
        </div>
    </div>
</div>
