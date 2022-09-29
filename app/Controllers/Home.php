<?php

namespace App\Controllers;

use \App\Models\AdminModel;
use \App\Models\SattaModel;
use \App\Models\SattaPanelModel;

class Home extends BaseController
{

    protected $helpers = ['form', 'session', 'SmallFunctions'];

    public function index()
    {
        $sattamodel = new SattaModel();
        $data = $sattamodel->findAll();
        $viewData = [
            'title' => 'Home | show lists',
        ];

        return view('home', ['list'=> $data, 'viewdata'=> $viewData]);
    }

    public function adminLogin() {

        if (strtolower($this->request->getMethod()) !== 'post') {
            // get request
            return view('adminlogin', [
                'validation' => null]);
        }

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        // post request
        if (! $this->validate($rules)) {
            return view('adminlogin', [
                'validation' => $this->validator, 
            ]);
        }

        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $emailService = \Config\Services::email();

        $userModel = new AdminModel();
        $email = $this->request->getVar('email');
        $pass =  $this->request->getVar('password');
        $user = $userModel->where( 'email', $email)->first();

        
        if($user != null) {

            $hashed_password = $user['password'];

            if($user['email'] == $email) {
                // echo 'valid email';
                if(password_verify($pass, $hashed_password)) {
                    // all good setting session


                    
                    if($user['two_step_auth'] == 'true') {
                        // verify otp
                        $subject = 'OTP for admin login';
                        $message = 'test message';

                        $to = $user['email'];
                        $emailService->setFrom('oldghantabazar@gmail.com', 'OTP login request');
                        $emailService->setTo($to);

                        $generatedOtp = randomNumber();
                        $otpHash = password_hash($generatedOtp, PASSWORD_DEFAULT);

                        $userModel->update($user['id'], ['verify_otp'=> $otpHash]);
                        $emailService->setSubject($subject);
                        // Using a custom template
                        $heading = 'Requested OTP for admin login';
                        $para = 'Use this otp to login ! have a nice day :)';
                        $template = view("changePasswordEmailTemplate", ['email'=>$to, 'otp'=> $generatedOtp, 'heading'=> $heading, 'para'=>$para]);
                        $emailService->setMessage($template);
                        if ($emailService->send()) 
                        {
                           // get otp view

                            $msg = 'Enter OTP to login';
                            $pinkhead = 'Admin Login';
                            $session->setFlashdata('success', 'Email sent successfully');

                            $mydata = [
                                'email' => $user['email'],
                                'msg' => $msg,
                                'pinkhead' =>$pinkhead,
                                'redirectTo' => 'verify-login-otp',
                            ];
                            return view('getOtpPassword',['mydata'=> $mydata ] );

                            // exit

                            // $ses_data = [
                            //     'id' => $user['id'],
                            //     'email' => $user['email'],
                            //     'admin' => TRUE
                            // ];
                            // $session->set($ses_data);
                            // return redirect()->to('/admin');
                        } 
                        else 
                        {
                            // $data = $email->printDebugger(['headers']);
                            // print_r($data); email not sent
                            $session->setFlashdata('success', 'something went wrong! Email not sent');
                            return redirect()->to('/admin'); 
                        }

                    }
                    else {
                        $ses_data = [
                            'id' => $user['id'],
                            'email' => $user['email'],
                            'admin' => TRUE
                        ];
                        $session->set($ses_data);
                        return redirect()->to('/admin');
                    }

                    // $ses_data = [
                    //     'id' => $user['id'],
                    //     'email' => $user['email'],
                    //     'admin' => TRUE
                    // ];
                    // $session->set($ses_data);
                    // return redirect()->to('/admin');
                }

                else {
                    // echo 'wrong password';
                    $session->setFlashdata('error', 'you entered wrong password');
                    return view('adminlogin', [ 'validation' => $this->validator, ]);
                }
            }
        }
        else {
            // echo 'wrong emaIl';
            $session->setFlashdata('error', 'Email is not valid');
            return view('adminlogin', [ 'validation' => $this->validator, ]);

        }
    }

    public function admin() {
        // showing list of satta with option to edit and delete

        $satamodel = new SattaModel();
        $data = $satamodel->findall();


        return view('admin', ['list'=>$data]);
    }

    public function adminCreate() {
   
        if (strtolower($this->request->getMethod()) !== 'post') {
            // get request
            return view('adminCreate', [
                'validation' => null]);
        }

        $rules = [
            'name' => 'required',
            'first_three_digit' => 'required',
            'first_one_digit' => 'required',
            'last_one_digit'    => 'required',
            'last_three_digit'    => 'required',
            'start_time'    => 'required',
            'end_time'    => 'required',

        ];

        if (! $this->validate($rules)) {
            return view('adminCreate', [
                'validation' => $this->validator, 
            ]);
        }


        $request = \Config\Services::request();
        $session = \Config\Services::session();

        //saving to satta
        $satta = new SattaModel();

        $sattanumber = $this->request->getVar('first_three_digit') .  $this->request->getVar('first_one_digit') . $this->request->getVar('last_one_digit') . $this->request->getVar('last_three_digit');
        $sataname = $this->request->getVar('name');

        $sattaData = [
            'name' => $sataname,
            'start_time'    => $this->request->getVar('start_time'),
            'end_time'    => $this->request->getVar('end_time'),
            'satta_number'    => $sattanumber,
        ]; 



        $sataPanelRow = $satta->where( 'name', $sataname)->first();

        if($sataPanelRow == null) {

            $satta->insert($sattaData);

            $sataPanelRow = $satta->where( 'name', $sataname)->first();

            // saving to satta_panel
            $satapanel = new SattaPanelModel();

            date_default_timezone_set("Asia/Calcutta");
            $currentDate = date('Y-m-d h:i a', time());

            $sattapaneldata = [
                'satta_number' => $sattanumber,
                'current_date' => $currentDate,
                'satta_id' => $sataPanelRow['id'],
            ];

            $satapanel->insert($sattapaneldata);

            $session->setFlashdata('success', 'list created successfully');
            return redirect('create');
        }

        // going to home with flash data
        $session->setFlashdata('success', 'list already exist!');
        return redirect('create');
    }

    public function adminSattaEdit($id = null) {
        
        $satamodel = new SattaModel();
        $sataPanelModel = new SattaPanelModel();
        $row = $satamodel->find($id);

        if (strtolower($this->request->getMethod()) !== 'post') {
            // get request

            return view('adminEdit', [
                'validation' => null, 'row' => $row]);
        }

        $rules = [
            'name' => 'required',
            'first_three_digit' => 'required',
            'first_one_digit' => 'required',
            'last_one_digit'    => 'required',
            'last_three_digit'    => 'required',
            'start_time'    => 'required',
            'end_time'    => 'required',

        ];

        // post request
        if (! $this->validate($rules)) {
            return view('adminEdit', [
                'validation' => $this->validator, 
            ]);
        }


        $postReqSataID = (int)$this->request->getVar('id');


        $request = \Config\Services::request();
        $session = \Config\Services::session();

        //saving to db
        $sattanumber = $this->request->getVar('first_three_digit') .  $this->request->getVar('first_one_digit') . $this->request->getVar('last_one_digit') . $this->request->getVar('last_three_digit');

        $sattaData = [
            'name' => $this->request->getVar('name'),
            'start_time'    => $this->request->getVar('start_time'),
            'end_time'    => $this->request->getVar('end_time'),
            'satta_number'    => $sattanumber,
        ]; 

        $rowPanel = $sataPanelModel->where('satta_id', $postReqSataID)->orderBy('created_at', 'desc')->first();

        if(isTodayDate($rowPanel['created_at']) == 1) {
            // today's date
            $rowPanel_id = $rowPanel['id'];

            $sataPanelData = [
                'satta_number'    => $sattanumber,
                'current_date'    => date('Y-m-d h:i a', time()),
                'satta_id'    => $postReqSataID,
            ];

            $sataPanelModel->update($rowPanel_id, $sataPanelData);

        }

        if(isTodayDate($rowPanel['created_at']) == 0) {
            // next day or another day
            $sataPanelDataNewDay = [
                'satta_number'    => $sattanumber,
                'current_date'    => date('Y-m-d h:i a', time()),
                'satta_id'    =>  $postReqSataID,
            ];

            $sataPanelModel->insert($sataPanelDataNewDay);
        }
        
        $satamodel->update($postReqSataID, $sattaData);

        // going to home with flash data
        $session->setFlashdata('success', 'list updated successfully');
        return redirect('admin');
    }

    public function adminSattaDelete($id = null) {

        $session = \Config\Services::session();

        $satamodel = new SattaModel();
        $row = $satamodel->find($id);

        $sataPanelModel = new SattaPanelModel();
        
        if($row != null ) {
            $sataPanelModel->where('satta_id', $id)->delete();
            $satamodel->delete($id);

            $session->setFlashdata('success', 'list removed successfully');
            return redirect('admin');
        }
    }

    public function adminSattaDeleteConfirmation($id =null) {

        $session = \Config\Services::session();

        $satamodel = new SattaModel();
        $row = $satamodel->find($id);

        return view('confirmation', ['row' => $row ]);
    }

    public function sattaPanel($id = null) {
        // echo $id;

        if($id != null) {
            
            $sataPanelModel = new SattaPanelModel();
            $sataRowModel = new SattaModel();
            $sataRow = $sataRowModel->find($id);
            $rowsPanel = $sataPanelModel->where('satta_id', $id)->orderBy('created_at', 'asc')->findAll();

            $viewData = [
                'title' => $sataRow['name']. ' panel chart',
            ];
            
            // $rowsPanel = $sataPanelModel->where(['satta_id' => $id, 'id' => 3])->orderBy('created_at', 'asc')->findAll();

            // echo '<pre>';
            // print_r($rowsPanel);
            return view('satta_panel', ['rows' => $rowsPanel, 'satta' => $sataRow, 'viewdata'=> $viewData]);
        }

        return view('satta_panel', ['rows' => $rowsPanel, 'satta' => $sataRow, 'viewdata'=> null]);

    }

    public function sattaJodi($id = null) {
        if($id != null) {
            
            $sataPanelModel = new SattaPanelModel();

            $sataRowModel = new SattaModel();
            $sataRow = $sataRowModel->find($id);
            
            $rowsPanel = $sataPanelModel->where('satta_id', $id)->orderBy('created_at', 'asc')->findAll();
            // echo 'praise the LORD';

            $viewData = [
                'title' => $sataRow['name']. ' jodi chart',
            ];

            return view('satta_jodi', ['rows' => $rowsPanel, 'satta' => $sataRow, 'viewdata'=> $viewData]);
        }
        return view('satta_jodi', ['rows' => null, 'satta' => $sataRow, 'viewdata'=> null]);
    }

    public function adminSettings() {
        // return view('adminsettings');

        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $userEmail = $session->get('email');

        $admin = new AdminModel();
        $user = $admin->where( 'email', $userEmail)->first();

        if (strtolower($this->request->getMethod()) !== 'post') {
            // get request

            if($user['two_step_auth'] == 'true') {
                
                return view('adminsettings', ['otp_enable'=> 'checked']);
            }
            else {
                return view('adminsettings', ['otp_enable'=> null]);
            }
        }

        // post request
        $boolval = $this->request->getVar('otpVerification');

        if($boolval != null ) {
            // enable otp setting
            $session->setFlashdata('success', 'Setting saved successfully');
            $admin->update($session->get('id'), ['two_step_auth' => 'true']);
            return redirect()->to('/adminsettings');

        }
        else {
            $session->setFlashdata('success', 'Setting saved successfully');
            $admin->update($session->get('id'), ['two_step_auth' => 'false']);
            return redirect()->to('/adminsettings');
        }

    }

    public function adminVerifyOtpLogin() {

        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $userEmail = $this->request->getVar('email');

        $admin = new AdminModel();
        $user = $admin->where( 'email', $userEmail)->first();

        $rules = [
            'otp' => 'required|integer|min_length[6]|max_length[6]',
        ];

        $msg = 'Enter OTP to login';
        $pinkhead = 'Admin Login';
        $mydata = [
            'email' => $userEmail,
            'msg' => $msg,
            'pinkhead' =>$pinkhead,
            'redirectTo' => 'verify-login-otp',
        ];

        // post request
        if (! $this->validate($rules)) {
            return view('getOtpPassword', ['validation' => $this->validator, 'mydata' => $mydata ]);
        }

        $otpByuser = (int)$this->request->getVar('otp');

        if(password_verify($otpByuser, $user['verify_otp'])) {
            // otp match done login
            $ses_data = [
                'id' => $user['id'],
                'email' => $user['email'],
                'admin' => TRUE
            ];
            $session->set($ses_data);
            return redirect()->to('/admin');
           
        }
        else {
            // wrong otp
            $session->setFlashdata('success', 'You entered wrong OTP');
            return view('getOtpPassword', ['validation' => $this->validator, 'mydata'=> $mydata ]);
        }
    }

    public function adminChangePassword() {

        // return view('changePasswordEmailTemplate');
        $email = \Config\Services::email();
        $session = \Config\Services::session();
        $request = \Config\Services::request();

        $admin = new AdminModel();
        $data = $admin->findall();


        if(count($data) == 0) { 
            $url = base_url().'/setAdminDefaults';
            $session->setFlashdata('error', 'There is no admin, <a href="'.$url.'">click here to create</a>');
            return redirect()->to('/adminlogin');
        }
        

        $subject = 'Requested to Change Admin Password';
        $message = 'test message';
        $adminrow = $data[0];

        if (strtolower($this->request->getMethod()) !== 'post') {
            // get request | send email
            // create admin with default email and password

            $to = $adminrow['email'];
            $email->setFrom('oldghantabazar@gmail.com', 'Change Admin Password');
            $email->setTo($to);

            $generatedOtp = randomNumber();
            $otpHash = password_hash($generatedOtp, PASSWORD_DEFAULT);

            $admin->update($adminrow['id'], ['verify_otp'=> $otpHash]);
            $email->setSubject($subject);
            // Using a custom template

            $heading = ' Change password verification';
            $para = 'Enter this obove OTP to validate your email';
            $template = view("changePasswordEmailTemplate", ['email'=>$to, 'otp'=> $generatedOtp, 'heading'=> $heading, 'para'=>$para]);
            $email->setMessage($template);
            if ($email->send()) 
            {
                // echo 'Email successfully sent';
                // get otp view

                $msg = 'Enter OTP to change password';
                $pinkhead = 'Change Password';

                $mydata = [
                    'email' => $adminrow['email'],
                    'msg' => $msg,
                    'pinkhead' =>$pinkhead,
                    'redirectTo' => '',
                ];

                $session->setFlashdata('success', 'Email sent successfully');
                return view('getOtpPassword', ['mydata'=> $mydata]);
            } 
            else 
            {
                // $data = $email->printDebugger(['headers']);
                // print_r($data);
                // adminsetting view with error flash

                $session->setFlashdata('success', 'something went! Email not sent');
                return redirect()->to('/adminsettings'); 
            }
        }


        $rules = [
            'otp' => 'required|integer|min_length[6]|max_length[6]',
        ];

        // post request
        if (! $this->validate($rules)) {

            $mydata = [
                'email'=> $adminrow['email'],
            ];
            return view('getOtpPassword', [ 'validation' => $this->validator, $mydata]);
        }
        // verify otp and change admin data

        $otpByuser = (int)$this->request->getVar('otp');

        if(password_verify($otpByuser, $adminrow['verify_otp'])) {
            // otp match
            return view('adminGetnewPassword', ['email'=>$adminrow['email']]);
        }
        else {
            // wrong otp
            $session->setFlashdata('success', 'You entered wrong OTP');
            $mydata = [
                'email'=> $adminrow['email'],
            ];
            return view('getOtpPassword', [
                'validation' => null, $mydata,
            ]);
        }
    }

    public function adminGetNewpassword() {

        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $rules = [
            'pass' => 'required|min_length[4]',
        ];

        // return 'comes here';
        if (! $this->validate($rules)) {

            $mydata = [
                'email' => $adminrow['email'],
                'msg' => $msg,
                'pinkhead' =>$pinkhead,
                'redirectTo' => '',
            ];
            return view('getOtpPassword', ['validation' => $this->validator, $mydata ]);
        }

        // update db
        $admin = new AdminModel();
        $user = $admin->where( 'email', $this->request->getVar('email'))->first();

        $encryptedpass = password_hash( $this->request->getVar('pass'), PASSWORD_DEFAULT);

        $data = [
            'verify_otp'    => '',
            'password'    => $encryptedpass,
        ];

        $admin->update($user['id'], $data);

        $ses_data = [
            'id' => null,
            'email' => null,
            'admin' => null
        ];
        $session->set($ses_data);
        $session->setFlashdata('success', 'Password updated successfully! login again');
        return redirect()->to('/adminlogin');



    }

    public function adminChangeEmail() {

        $session = \Config\Services::session();
        $session->setFlashdata('success', 'Change email is not implemeted yet! Comging soon');
        return redirect()->to('/admin');
    }

    public function setdefaultAdminCredentials() {

        $session = \Config\Services::session();
        $admin = new AdminModel();
        $data = $admin->findall();

        if(count($data) == 0) {
            // create admin with default email and password

            $email = 'oldghantabazar@gmail.com';
            $password = password_hash('abhishekgunji121#', PASSWORD_DEFAULT);

            $logindata = [
                'email' => $email,
                'password' => $password,
            ];

            $admin->insert($logindata);
            $session->setFlashdata('success', 'Default admin created you can login now');
            return redirect()->to('/admin'); 
        }
        return redirect()->to('/admin');
    }

    public function adminForgotPasswordConfirm() {
        
        return view('forgotPasswordConfirmation');
    }

    public function adminForgotAdminPass() {

        // send otp forgot password
        // change password
        //login

        $session = \Config\Services::session();
        $request = \Config\Services::request();

        
        $admin = new AdminModel();
        $data = $admin->findall();

        $subject = 'Requested to Change Admin Password';
        $message = 'test message';
        $adminrow = $data[0];

        $msg = 'Enter OTP to change password';
        $pinkhead = 'Change Password';

        $rules = [
            'otp' => 'required|integer|min_length[6]|max_length[6]',
        ];

        // post request
        if (! $this->validate($rules)) {
            $mydata = [
                'email' => $adminrow['email'],
                'msg' => $msg,
                'pinkhead' =>$pinkhead,
                'redirectTo' => '',
            ];
            return view('getOtpPassword', [ 'validation' => $this->validator, 'mydata'=> $mydata]);
        }
        // verify otp and change admin data

        $otpByuser = (int)$this->request->getVar('otp');

        if(password_verify($otpByuser, $adminrow['verify_otp'])) {
            // otp match
            return view('adminGetnewPassword', ['email'=>$adminrow['email']]);
        }
        else {
            // wrong otp
            $session->setFlashdata('success', 'You entered wrong OTP');
            $mydata = [
                'email' => $adminrow['email'],
                'msg' => $msg,
                'pinkhead' =>$pinkhead,
                'redirectTo' => '',
            ];
            return view('getOtpPassword', ['validation' => null, 'mydata'=> $mydata,]);
        }



    }


    public function test() {

        // $password = 'oldghantabazar@gmail.com';
        // echo '<br>';
        // echo $password;

        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // echo '<br>';
        // echo $hashed_password;
        // // var_dump($hashed_password);

        // if(password_verify($password, $hashed_password)) {
        //     // If the password inputs matched the hashed password in the database
        //     // Do something, you know... log them in.
        //     echo 'helo';
        // } 
        // else {
        //     echo '<br>';
        //     echo 'no';
        // }

        // $to = 'oldghantabazar@gmail.com';
        // $subject = 'hello sub';
        // $message = 'good mor';
        
        // $email = \Config\Services::email();
        // $email->setFrom('ar253336@gmail.com', 'Confirm Registration');
        // $email->setTo($to);
        
        // $email->setSubject($subject);
        // $email->setMessage($message);
        // if ($email->send()) 
        // {
        //     echo 'Email successfully sent';
        // } 
        // else 
        // {
        //     $data = $email->printDebugger(['headers']);
        //     print_r($data);
        // }


        echo randomNumber();

    }
}
