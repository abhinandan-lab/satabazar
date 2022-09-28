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
        $data['list'] = $sattamodel->findAll();

        return view('home', $data);
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

        if (! $this->validate($rules)) {
            return view('adminlogin', [
                'validation' => $this->validator, 
            ]);
        }

        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $userModel = new AdminModel();
        $email = $this->request->getVar('email');
        $pass =  $this->request->getVar('password');
        $user = $userModel->where( 'email', $email)->first();

        $hashed_password = $user['password'];

        if($user != null) {
            if($user['email'] == $email) {
                // echo 'valid email';
                if(password_verify($pass, $hashed_password)) {
                    // all good setting session
                    $ses_data = [
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'admin' => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/admin');
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
            // $rowsPanel = $sataPanelModel->where(['satta_id' => $id, 'id' => 3])->orderBy('created_at', 'asc')->findAll();

            // echo '<pre>';
            // print_r($rowsPanel);
            return view('satta_panel', ['rows' => $rowsPanel, 'satta' => $sataRow]);
        }

        return view('satta_panel', ['rows' => $rowsPanel, 'satta' => $sataRow]);

    }

    public function sattaJodi($id = null) {
        if($id != null) {
            
            $sataPanelModel = new SattaPanelModel();

            $sataRowModel = new SattaModel();
            $sataRow = $sataRowModel->find($id);



            
            $rowsPanel = $sataPanelModel->where('satta_id', $id)->orderBy('created_at', 'asc')->findAll();
            // echo 'praise the LORD';
            return view('satta_jodi', ['rows' => $rowsPanel, 'satta' => $sataRow]);
        }
        return view('satta_jodi', ['rows' => null, 'satta' => $sataRow]);
    }

    public function adminSettings() {
        return view('adminsettings');
    }

    public function adminChangePassword() {

        // send otp 
        // create verification link, otp number 
        // view to enter otp
        // if matches to otp or link then 
        // chaange from db

        return 'j';
    }

    public function adminChangeEmail() {
        return 'jl';
    }

    public function setdefaultAdminCredentials() {

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
            return redirect()->to('/admin'); 
        }
        return redirect()->to('/admin');
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

        $to = 'oldghantabazar@gmail.com';
        $subject = 'hello sub';
        $message = 'good mor';
        
        $email = \Config\Services::email();
        $email->setFrom('ar253336@gmail.com', 'Confirm Registration');
        $email->setTo($to);
        
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) 
        {
            echo 'Email successfully sent';
        } 
        else 
        {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }

    }
}