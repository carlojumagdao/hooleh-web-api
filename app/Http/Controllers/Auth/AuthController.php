<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

    use AuthenticatesUsers, ThrottlesLogins;
    
    protected $username = 'username';

    protected $redirectAfterLogout = '/admin';

    protected $redirectTo = '/dashboard';

    
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->back();
    }

    public function authenticate(Request $request){
        $credentials = $request->only('username', 'password');  

        try {
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'User Credentials are Invalid.'], 401);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('token'))->setStatusCode(200);
    }

    public function logout(Request $request){
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());

        }
        return response()->json([ 'message' => 'Logout successful'], 200);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
