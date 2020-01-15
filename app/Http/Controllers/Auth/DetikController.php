<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response;
use Modules\User\Entities\User;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Auth;
use Exception;

class DetikController extends Controller
{
	// Client ID: 10114
	// Client Secret: 9d5234f00c2989ec45f4b0f1f789474d
	// Logout URL: https://connect.detik.com/oauth/signout/?redirectUrl=URL_CALLBACK
	
    protected $redirectTo = '/';
	protected $loginPath = '/login';
	protected $clientID = '10114';
	protected $clientSecret = '9d5234f00c2989ec45f4b0f1f789474d';
	protected $urlCallback = 'https://nowreport.detik.com/auth/detik/callback';
	protected $urlDetikConnect = 'https://connect.detik.com/oauth/staff'; 
	
	public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        //$this->middleware('guest');
    }
	
	public function redirectToDetik()
    {
        return redirect($this->urlDetikConnect.'?clientId='.$this->clientID.'&redirectUrl='.$this->urlCallback);
    }
	
	public function handleDetikCallback(Request $request)
	{
		try {
			$oauth_code = $request->get('code');
			$userId = $request->get('userId');
			$times = $request->get('time');
			$detikToken = json_decode(file_get_contents($this->urlDetikConnect.'/code?code='.$oauth_code.'&appId='.$this->clientID.'&appSecret='.$this->clientSecret.'&redirectUrl='.$this->urlCallback.'&time='.$times), true);

			$accessToken = $detikToken['accessToken'];
			$refreshToken = $detikToken['refreshToken'];
			/*echo "OAuth Code : ".$oauth_code."<br>";
			echo "User ID : ".$userId."<br>";
			echo "Time : ".$times."<br>";
			echo "Access Token : ".$accessToken."<br>";
			echo "Refresh Token : ".$refreshToken."<br>";*/
			$dataDetik = json_decode(file_get_contents($this->urlDetikConnect.'/token?token='.$accessToken), true);
			
			$detik['name'] = $dataDetik['name'];
			$detik['provider_id'] = $dataDetik['id'];
			$detik['email'] = $dataDetik['email'];
			//$detik['avatar'] = $dataDetik['profilePicture'];
			$detik['password'] = bcrypt(str_random(40));
			/*echo "Name : ".$detikName."<br>";
			echo "Email : ".$detikEmail."<br>";
			echo "Detik ID : ".$detikID."<br>";*/
			if (!$this->isDetik($detik['email'])) {
				return redirect('/auth/detik');
			} else {
				$userModel = new User;
				$createdUser = $userModel->addNew($detik);
				Auth::loginUsingId($createdUser->id);
				return redirect()->route('index');
			}
			
		} catch (Excpetion $e) {
			return redirect('/auth/detik');	
		}
	}
	
	public function logoutDetik() {
		Auth::logout();
		return redirect('/');
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

