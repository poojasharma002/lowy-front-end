<?php namespace App\Controllers;

use App\Models\UserModel;


class Users extends BaseController
{
	public function index()
	{
		$data = [];
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
			    'password' => 'validateUser[email,password]',
			];

			// $errors = [
			// 	'password' => [
			// 		'validateUser' => 'Email or Password don\'t match'
			// 	]
			// ];

			// if (! $this->validate($rules, $errors)) {
			// 	$data['validation'] = $this->validator;
			// }else{
			// 	$model = new UserModel();

			// 	$user = $model->where('email', $this->request->getVar('email'))
			// 								->first();

			// 	$this->setUserSession($user);
			// 	//$session->setFlashdata('success', 'Successful Registration');
			// 	return redirect()->route('adminDashboard');

			// }
			if($this->request->getVar('email')== "tracy@gmail.com" && password_verify($this->request->getVar('password'), '$2y$10$xikGQ31IO/9y8BhSt2hU0e0TbXpCtmYQGMFaWHgCLQWJrz0yVr92i')){
				$data = [
					'id' => 1,
					'firstname' => 'tracy',
					'lastname' => "tracy",
					'email' => 'tracy@gmail.com',
					'isLoggedIn' => true,
				];
		
				session()->set($data);
				return redirect()->route('adminDashboard');
			}else{
				$session = session();
				$session->setFlashdata('error', 'Invalid credentials.');
			}
		}		
		echo view('login',$data);
	
	}

	private function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function logout(){
		session()->destroy();
		 return redirect()->route('login');
	}

	//--------------------------------------------------------------------

}
