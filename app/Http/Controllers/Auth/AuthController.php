<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\User\Entities\User;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Auth;
use Exception;

class AuthController extends Controller
{
    protected $redirectTo = '/';
	protected $loginPath = '/google';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
		try {
			$user = Socialite::driver('google')->user();
			if (!$this->isDetik($user->getEmail())) {
				return redirect('auth/google');
			} else {
				$create['name'] = $user->getName();
				$create['email'] = $user->getEmail();
				$create['provider_id'] = $user->getId();
				$create['password'] = bcrypt(str_random(40));

				$userModel = new User;
				$createdUser = $userModel->addNew($create);
				Auth::loginUsingId($createdUser->id);

				//return redirect()->route('home');
				return redirect()->route('/');
			}
		} catch (Exception $e) {
			return redirect('auth/google');
		}
    }
	
	public function createUser($user) {
		$authUser = User::where('provider_id', $user->id)->first();
		if ($authUser) {
			return $authUser;
		}
		return User::create([
			'name' => $user->name,
			'provider_id' => $user->id,
			'email' => $user->email
		]);
	}

	private function isDetik($email) {
		$arrEmail = explode('@', $email);
		$domain = $arrEmail[1];
		if ($domain !== 'detik.com')
			return false;
		else
			return true;
	}
}
