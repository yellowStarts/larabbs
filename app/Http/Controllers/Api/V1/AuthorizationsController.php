<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\SocialAuthorizationsRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthorizationsController extends Controller
{
    public function socialStore($social_type, SocialAuthorizationsRequest $request)
    {
        $driver = \Socialite::create($social_type);

        try {
            if ($code = $request->code) {
                $oauthUser = $driver->userFromCode($code);
            } else {
                $tokenData['access_token'] = $request->access_token;

                // 微信需要增加 openid
                if($social_type == 'wechat') {
                    $driver->withOpenid($request->openid);
                }

                $oauthUser = $driver->userFromToken($request->access_token);
            }
        } catch (\Exception $e) {
            throw new AuthenticationException('参数错误，未获取用户信息');
        }

        if (!$oauthUser->getId()) {
            throw new AuthenticationException('参数错误，未获取用户信息');
        }

        switch($social_type) {
            case 'wechat':
                $unionid = $oauthUser->getRaw()['unionid'] ?? null;

                if($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();
                }

                // 没有用户，默认创建一个用户
                if(!$user) {
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $unionid,
                    ]);
                }

                break;
        }

        return response()->json(['token' => $user->id]);
    }
}
