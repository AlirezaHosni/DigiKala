<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('customer.auth.login-register');
    }

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();

        //check id is email or not
        if (filter_var($inputs['id'], FILTER_VALIDATE_EMAIL))
        {
            $type = 1; // 1 => email
            $user = User::where('email', $inputs['id'])->first();
            if(empty($user)){
                $newUser['email'] = $inputs['id'];
            }
        }
        //check id is mobile or not
        elseif (preg_match('/^[\+98|098|98|0]9\d{9}$/', $inputs['id']))
        {
            $type = 0; // 0 => email
            // all mobile numbers are in one format 9** *** ****
            $inputs['id'] = ltrim($inputs['id'], '0');
            $inputs['id'] = substr($inputs['id'], 0, 2) === '98' ? substr($inputs['id'],2) : $inputs['id'];
            $inputs['id'] = str_replace('+98', '', $inputs['id']);

            $user = User::where('mobile', $inputs['id'])->first();
            if(empty($user)){
                $newUser['mobile'] = $inputs['id'];
            }
        }else{
            $errorText = 'شناسه وارد شده نه شماره موبایل است نه ایمیل';
            return redirect()->route('auth.customer.login-register-fo   rm')->withErrors(['id' => $errorText]);
        }

        if (empty($user)){
            $newUser['password'] = '98355154';
            $newUser['activation'] = 1;
            $user = User::create($newUser);
        }

        // create otp code
        $otpCode = rand(111111, 999999);
        $token = Str::random(60);
        $otpInputs = [
            'otp_code' => $otpCode,
            'token' => $token,
            'user_id' => $user->id,
            'type' => $type,
            'login_id' => $inputs['id']
        ];

        Otp::create($otpInputs);

        // send sms or email
        if ($type == 0){
            // sms
            $smsService = new SmsService();
            $smsService->setFrom(config('sms.otp_from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText("مجموعه آمازون\n کد تایید:$otpCode");
            $smsService->setIsFlash(true);

            $messageService = new MessageService($smsService);
        }else{
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعال‌سازی',
                'body' => "کد فعال‌سازی شما : $otpCode"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($inputs['id']);

            $messageService = new MessageService($emailService);
//            dd($emailService, $messageService);

        }

        dd($messageService->send());
    }
}
