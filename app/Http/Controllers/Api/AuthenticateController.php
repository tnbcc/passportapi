<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthenticateRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;
use Socialite;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthenticateController extends ApiController
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth:api')->only([
            'logout'
        ]);
    }

    public function username()
    {
        return 'phone';
    }

    // 登录
    public function login(AuthenticateRequest $request)
    {

        $credentials = $this->credentials($request);

        if ($this->guard('api')->attempt($credentials, $request->has('remember'))) {

            return $this->sendLoginResponse($request);
        }

        return $this->setStatusCode(401)->failed('登录失败');
    }

    // 退出登录
    public function logout(Request $request)
    {

        if (Auth::guard('api')->check()){

            Auth::guard('api')->user()->token()->revoke();

        }

        return $this->message('退出登录成功');

    }

    // 第三方登录
    public function redirectToProvider($driver) {

        if (!in_array($driver,['qq','wechat'])){

            throw new NotFoundHttpException;
        }

        return Socialite::driver($driver)->redirect();
    }

    // 第三方登录回调
    public function handleProviderCallback($driver) {

        $user = Socialite::driver($driver)->user();

        $openId = $user->id;

        // 第三方认证
        $db_user = User::where('xxx',$openId)->first();

        if (empty($db_user)){

            $db_user = User::forceCreate([
                'phone' => '',
                'xxUnionId' => $openId,
                'nickname' => $user->nickname,
                'head' => $user->avatar,
            ]);

        }

        // 直接创建token

        $token = $db_user->createToken($openId)->accessToken;

        return $this->success(compact('token'));

    }

    //调用认证接口获取授权码
    protected function authenticateClient(Request $request)
    {
        $credentials = $this->credentials($request);

        // 个人感觉通过.env配置太复杂，直接从数据库查更方便
        $password_client = Client::query()->where('password_client',1)->latest()->first();
        $client = new \GuzzleHttp\Client();
        $url = config('app.url') . '/oauth/token';
        $params = [
            'grant_type' => 'password',
            'client_id' => $password_client->id,
            'client_secret' => $password_client->secret,
            'username' => $credentials['phone'],
            'password' => $credentials['password'],
            'scope' => ''
        ];
        $respond = $client->request('POST', $url, ['form_params' => $params]);


        if ($respond->getStatusCode() !== 401) {
            return json_decode($respond->getBody()->getContents(), true);
        }
    }

    protected function authenticated(Request $request)
    {
        return $this->authenticateClient($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $msg = $request['errors'];
        $code = $request['code'];
        return $this->setStatusCode($code)->failed($msg);
    }
}