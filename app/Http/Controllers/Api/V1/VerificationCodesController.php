<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\VerificationCodeRequest;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use Illuminate\Support\Str;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $phone = $request->phone;

        if(!app()->environment('production')) {
            $code = '1234';
        } else {
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1,9999), 4, 0, STR_PAD_LEFT);

            try {
                $result = $easySms->send($phone, [
                    'template' => config('easysms.gateways.qcloud.templates.register'),
                    'data' => [
                        $code
                    ],
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $message = $exception->getException('qcloud')->getMessage();
                abort(500, $message ?: '短信发送异常');
            }
        }



        $key = 'verificationCode_' . Str::random(15);
        $expireAt = now()->addMinutes(5);
        // 缓存验证码 5 分钟过期。
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expireAt);

        return response()->json([
            'key' => $key,
            'expireAt' => $expireAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
