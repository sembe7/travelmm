<?php
namespace Modules\User\Controllers;

use Illuminate\Support\Facades\Log;
use Matrix\Exception;
use Modules\FrontendController;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Models\Newsletter;
use Modules\User\Models\Subscriber;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Validator;
use Modules\Booking\Models\Booking;
use App\Helpers\ReCaptchaEngine;

class UserController extends FrontendController
{
    public function dashboard(Request $request)
    {
        $this->checkPermission('tour_view');
        $user_id = Auth::id();
        $data = [
            'cards_report'       => Booking::getTopCardsReportForVendor($user_id),
            'earning_chart_data' => Booking::getEarningChartDataForVendor(strtotime('monday this week'), time(), $user_id)
        ];
        return view('User::frontend.dashboard', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        $user_id = Auth::id();
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                $this->sendSuccess([
                    'data' => Booking::getEarningChartDataForVendor(strtotime($from), strtotime($to), $user_id)
                ]);
                break;
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        if (!empty($request->input())) {
            $request->request->remove('email');
            $user->fill($request->input());
            $user->birthday = date("Y-m-d", strtotime($user->birthday));
            $user->save();
            return redirect('user/profile')->with('success', __('Update successfully'));
        }
        return view('User::frontend.profile', ['dataUser' => $user]);
    }


    public function changePassword(Request $request)
    {
        if (!empty($request->input())) {
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error", __("Your current password does not matches with the password you provided. Please try again."));
            }
            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->with("error", __("New Password cannot be same as your current password. Please choose a different password."));
            }
            $request->validate([
                'current-password' => 'required',
                'new-password'     => 'required|string|min:6|confirmed',
            ]);
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect('user/profile')->with('success', __('Password changed successfully !'));
        }
        return view('User::frontend.changePassword');
    }

    public function bookingHistory(Request $request)
    {
        $user_id = Auth::id();
        $data = [
            'bookings' => Booking::getBookingHistory($request->input('status'), $user_id),
            'statues'  => config('booking.statuses')
        ];
        return view('User::frontend.bookingHistory', $data);
    }

    public function userLogin(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required'
        ];
        $messages = [
            'email.required'    => __('Email is required field'),
            'email.email'       => __('Email invalidate'),
            'password.required' => __('Password is required field'),
        ];
        if(ReCaptchaEngine::isEnable() and setting_item("user_enable_login_recaptcha")){
            $codeCapcha = $request->input('g-recaptcha-response');
            if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                $errors = new MessageBag(['message_error' => __('Please verify the captcha') ]);
                return response()->json(['error'   => true,
                                         'messages' => $errors
                ], 200);
            }
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error'   => true,
                                     'messages' => $validator->errors()
            ], 200);
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            if (Auth::attempt(['email'    => $email,
                               'password' => $password
            ], $request->has('remember'))) {
                return response()->json([
                    'error'    => false,
                    'messages'  => false,
                    'redirect' => $request->headers->get('referer') ?? url('/')
                ], 200);
            } else {
                $errors = new MessageBag(['message_error' => __('Username or password incorrect')]);
                return response()->json([
                    'error'    => true,
                    'messages'  => $errors,
                    'redirect' => false
                ], 200);
            }
        }
    }

    public function userRegister(Request $request)
    {
        $rules = [
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password'   => [
                'required',
                'string'
            ],
            'term'       => ['required'],
        ];
        $messages = [
            'email.required'    => __('Email is required field'),
            'email.email'       => __('Email invalidate'),
            'password.required' => __('Password is required field'),
            'first_name.required'     => __('The first name is required field'),
            'last_name.required'     => __('The last name is required field'),
            'term.required'     => __('The terms and conditions field is required'),
        ];

        if(ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")){
            $codeCapcha = $request->input('g-recaptcha-response');
            if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                $errors = new MessageBag(['message_error' => __('Please verify the captcha') ]);
                return response()->json(['error'   => true,
                                         'messages' => $errors
                ], 200);
            }
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error'   => true,
                                     'messages' => $validator->errors()
            ], 200);
        } else {
            $user = \App\User::create([
                'first_name'     => $request->input('first_name'),
                'last_name'     => $request->input('last_name'),
                'email'    => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'status'   => 'publish'
            ]);
            Auth::loginUsingId($user->id);
            try {

                event(new SendMailUserRegistered($user));

            }catch (Exception $exception){

                Log::warning("SendMailUserRegistered: ".$exception->getMessage());

            }
            $user->assignRole('customer');
            return response()->json([
                'error'    => false,
                'messages'  => false,
                'redirect' => $request->headers->get('referer') ?? url('/')
            ], 200);
        }
    }

    // sjncsjkncsjdncsdn

    public function AddRegister(Request $request)
    {
        /**
         * @param Booking $booking
         */
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            $this->sendError('', ['errors' => $validator->errors()]);
        }
        $code = $request->input('code');
        $booking = Booking::where('code', $code)->first();
        if (empty($booking)) {
            abort(404);
        }

        if ($booking->customer_id != Auth::id()) {
            abort(404);
        }
        if ($booking->status != 'draft') {
            return $this->sendError('',[
                'url'=>$booking->getDetailUrl()
            ]);
        }
        /**
         * Google ReCapcha
         */
        if(ReCaptchaEngine::isEnable() and setting_item("booking_enable_recaptcha")){
            $codeCapcha = $request->input('g-recaptcha-response');
            if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                $this->sendError(__("Please verify the captcha"));
            }
        }


        $rules = [
            'first_name' => ['required','string','max:255'],
            'last_name'  => ['required','string','max:255'],
            'phone' => ['required'],
            'parent_id'=> ['required'],
            'email' => ['required','string','email','max:255','unique:users'],
            'Foreign_FirstName' => ['required','string','max:255',],
            'Foreign_LastName' => ['required','string','max:255',],
            'Foreign_Registration' => ['required','string','max:8',],
            'Registration' => ['required','string','max:10',],
            'Foreign_Start_Date' => ['required','string','max:10',],
            'Foreign_End_Date' => ['required','string','max:10',],
            // 'password'   => [
            //     'required',
            //     'string'
            // ],
        ];
        $messages = [
            'phone'=>__('phone is required'),
            'Registration'=>__('Registration is required'),
            'Foreign_Start_Date'=>__('Foreign_Start_Date is required'),
            'Foreign_End_Date'=>__('Foreign_End_Date is required '),
            'Foreign_FirstName'=>__('Foreign_FirstName is required'),
            'Foreign_LastName'=>__('Foreign_LastName is required'),
            'email.required'    => __('Email is required field'),
            'email.email'       => __('Email invalidate'),
            // 'password.required' => __('Password is required field'),
            'first_name.required'     => __('The first name is required field'),
            'last_name.required'     => __('The last name is required field'),
            'term.required'     => __('The terms and conditions field is required'),
            'parent_id.required' => ('Хэрэглэгчийн бүртгэл үүсгэхэд алдаа гарлаа'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error'   => true,
                                     'messages' => $validator->errors()
            ], 200);
        } else {
            $user = \App\User::create([
                'first_name'     => $request->input('first_name'),
                'last_name'     => $request->input('last_name'),
                'email'    => $request->input('email'),
                'phone' => $request->input('phone'),
                // 'password' => Hash::make($request->input('password')),
                'status'   => 'publish',
                'parent_id'=>$request->input('parent_id'),
                'Foreign_FirstName'=> $request->input('Foreign_FirstName'),
                'Foreign_LastName' => $request->input('Foreign_LastName'),
                'Foreign_Registration'=>$request->input('Foreign_Registration'),
                'Registration'=> $request->input('Registration'),
                'Foreign_Start_Date' => $request->input('Foreign_Start_Date'),
                'Foreign_End_Date' => $request->input('Foreign_End_Date'),

            ]);
            $ids =$user->latest('created_at')->pluck('id')->first();
            // $booking = Modules\Booking\Models\Booking::create([
            //     //'customer_id'=> Auth::id(),
            //     'code' => $request->input('code'),
            //     'first_name'     => $request->input('first_name'),
            //     'last_name'     => $request->input('last_name'),
            //     'email'    => $request->input('email'),
            //     // 'password' => Hash::make($request->input('password')),
            //     'status'   => 'publish',
 
            //     'Foreign_FirstName'=> $request->input('Foreign_FirstName'),
            //     'Foreign_LastName' => $request->input('Foreign_LastName'),
            //     'Foreign_Registration'=>$request->input('Foreign_Registration'),
            //     'Registarion'=> $request->input('Registarion'),
            //     'Foreign_Start_date' => $request->input('Foreign_Start_date'),
            //     'Foreign_End_date' => $request->input('Foreign_End_date'),

            // ]);

            // Auth::loginUsingId($user->id);
            // try {
            //     event(new SendMailUserRegistered($user));
            // }catch (Exception $exception){
            //     Log::warning("SendMailUserRegistered: ".$exception->getMessage());
            // }
            $last =$booking->latest('start_date')->pluck('code')->first();

            $user->assignRole('customer');
            // return response()->json([
            //     'error'    => false,
            //     'message'  => false,
            //     'last_id' => $user->id,
            //     'redirect' => url('/booking'.'/'.$last.'/checkout'),

            // ], 200);
            
        }
        return redirect('/booking'.'/'.$last.'/checkout')->with('success','data edited');
    }

    public function EditRegister(Request $request,$id)
    {
        $rules = [
            'parent_id'=> ['required'],
        ];
        $messages = [
            'email.required'    => __('Email is required field'),
        ];

        // $code = $request->input('code');
        // $booking = Booking::where('code', $code)->first();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error'   => true,
                                     'messages' => $validator->errors()
            ], 200);
        } else {
            
            $user = User::find($id);
            $request->request->remove('email');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->phone = $request->input('phone2');
            $user->address = $request->input('address_line_1');
            $user->address2 = $request->input('address_line_2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->zip_code = $request->input('zip_code');
            $user->country = $request->input('country');
            $user->Foreign_FirstName = $request->input('Foreign_FirstName');
            $user->Foreign_LastName = $request->input('Foreign_LastName');
            $user->Foreign_Registration = $request->input('Foreign_Registration');
            $user->Registration = $request->input('Registration');
            $user->Foreign_Start_Date = $request->input('Foreign_Start_Date');
            $user->Foreign_End_Date = $request->input('Foreign_End_Date');
            $user->save();

            $booking = new Booking;
            $ids =$user->latest('created_at')->pluck('id')->first();
            $last =$booking->latest('start_date')->pluck('code')->first();

            // return response()->json([
            //     'error'    => false,
            //     'message'  => false,
            //     'last_id' => $user->id,
            //     'redirect' => url('/booking'.'/'.$last.'/checkout'),

            // ], 200);
            return redirect('/booking'.'/'.$last.'/checkout')->with('success','data edited');
        }
        return redirect('/booking'.'/'.$last.'/checkout')->with('success','data edited');
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
        $check = Subscriber::withTrashed()->where('email', $request->input('email'))->first();
        if ($check) {
            if ($check->trashed()) {
                $check->restore();
                $this->sendSuccess([], __('Thank you for subscribing'));
            }
            $this->sendError(__('You are already subscribed'));
        } else {
            $a = new Subscriber();
            $a->email = $request->input('email');
            $a->first_name = $request->input('first_name');
            $a->last_name = $request->input('last_name');
            $a->save();
            $this->sendSuccess([], __('Thank you for subscribing'));
        }
    }
    public function delete($id){
        $user = User::find($id);
        $user->delete();
        $last =Booking::latest('start_date')->pluck('code')->first();
        return redirect('/booking'.'/'.$last.'/checkout')->with('success','data deleted');
    }
}
