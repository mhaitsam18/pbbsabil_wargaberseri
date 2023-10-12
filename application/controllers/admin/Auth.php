<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/AuthModel', 'Auth_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('admin');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'User Log In';
			$this->load->view('admin/pages/auth/login', $data);
		} else {
			$this->_login();
		}
	}
	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('admin');
		}
		$this->db->where_not_in('id', 1);
		$data['user_role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'this email has already registered!'
		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'this Username has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]', [
			'matches' => 'password dont match!',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('role_id', 'Role', 'required|trim');
		$this->form_validation->set_rules('gender', 'Gander', 'required|trim');
		$this->form_validation->set_rules('place_of_birth', 'Place of Birth', 'required|trim');
		$this->form_validation->set_rules('birthday', 'Birth Day', 'required|trim');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('religion_id', 'Religion', 'required|trim');
		// 
		$this->form_validation->set_rules('password2', 'Confrim Password', 'required|trim|matches[password1]');
		$data['agama'] = $this->db->get('agama')->result_array();
		if ($this->form_validation->run() == false) {
			$data['title'] = 'User Registration';
			$this->load->view('admin/pages/auth/registration', $data);
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'gender' => htmlspecialchars($this->input->post('gender', true)),
				'place_of_birth' => htmlspecialchars($this->input->post('place_of_birth', true)),
				'birthday' => htmlspecialchars($this->input->post('birthday', true)),
				'phone_number' => htmlspecialchars($this->input->post('phone_number', true)),
				'address' => htmlspecialchars($this->input->post('address', true)),
				'religion_id' => htmlspecialchars($this->input->post('religion_id', true)),
				'image' => 'default.svg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role_id', true)),
				'is_active' => 0,
				'date_created' => time(),
			];

			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $this->input->post('email', true),
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token, 'verify');

			$user = $this->db->get_where('user', ['email' => $this->input->post('email', true)])->row_array();

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Congratulation! Your account has been created, check your email! please activate!
        </div>');
			redirect('admin/auth');
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'perumahanpbb@gmail.com',
			'smtp_pass' => 'Sepakbola17',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'chatset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->from('perumahanpbb@gmail.com', 'Perumahan Permata Buah Batu');
		$this->email->to('perumahanpbb@gmail.com');
		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click <a href="' . base_url('auth/verify?email=') . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a> to verify email :' . $this->input->post('email'));
		} elseif ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="' . base_url('auth/resetPassword?email=') . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			if ($user['is_active'] != 1) {
				$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
				if ($user_token) {
					if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
						$this->db->set('is_active', 1);
						$this->db->where('email', $email);
						$this->db->update('user');
						$this->db->delete('user_token', ['email' => $email]);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            ' . $email . ' has been activated. Please Login!
            </div>');
						redirect('auth');
					} else {
						$this->db->delete('user', ['email' => $email]);
						$this->db->delete('user_token', ['email' => $email]);
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account activation failed: Token Expired!
            </div>');
						redirect('auth');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Account activation failed: Invalid Token!
          </div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
        Your account has been activated!
        </div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Account activation failed: Wrong Email!
      </div>');
			redirect('auth');
		}
	}

	private function _login()
	{
		if ($this->session->userdata('email')) {
			redirect('admin/user');
		}
		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			if ($user['is_active'] ==  1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'id' => $user['id'],
						'name' => $user['name']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1 || $user['role_id'] == 6 || $user['role_id'] == 7) {
						redirect('admin');
					} else {
						redirect('admin/user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong password!
            </div>');
					redirect('admin/auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          This email has not been activated!
          </div>');
				redirect('admin/auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Email is not registered!
        </div>');
			redirect('admin/auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      You have been log out
      </div>');
		redirect('admin/auth');
	}

	public function blocked()
	{
		$data['title'] = 'blocked';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/auth/blocked');
		$this->load->view('admin/layouts/footer');
	}

	public function forgotPassword()
	{
		if ($this->session->userdata('email')) {
			redirect('Dashboard');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];
				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Please check your email to reset password!
          </div>');
				redirect('auth/forgotPassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Email is not registered!
          </div>');
				redirect('auth/forgotPassword');
			}
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->session->set_userdata('reset_email', $email);
					$this->changePassword();
				} else {
					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Reset Password failed: Token Expired!
          </div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Reset Password failed: Invalid Token!
        </div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Reset Password failed: Wrong email!
      </div>');
			redirect('auth');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('password2', 'Confrim Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'change Password';
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('auth/change-password');
			$this->load->view('admin/layouts/footer');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');
			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Password has been change! Please login!
      </div>');
			redirect('admin/auth');
		}
	}
}
