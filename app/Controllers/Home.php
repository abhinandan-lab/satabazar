<?php

namespace App\Controllers;

use \App\Models\AdminModel;
use \App\Models\SattaModel;
use \App\Models\SattaPanel;

class Home extends BaseController
{

    protected $helpers = ['form', 'session'];


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

        if($user != null) {
            if($user['email'] == $email) {
                // echo 'valid email';
                if($user['password'] == $pass) {
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
        // echo '<pre>';
        // print_r($data);

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

  
        // echo $this->request->getVar('name');
        // echo '<br>';
        // echo $this->request->getVar('start_time');
        // echo '<br>';
        // echo $this->request->getVar('end_time');
        // echo $this->request->getVar('name');
        // echo '<br>';
        // return view('User/setemail');


        //saving to db
        $satta = new SattaModel();

        $sattanumber = $this->request->getVar('first_three_digit') .  $this->request->getVar('first_one_digit') . $this->request->getVar('last_one_digit') . $this->request->getVar('last_three_digit');

        $sattaData = [
            'name' => $this->request->getVar('name'),
            'start_time'    => $this->request->getVar('start_time'),
            'end_time'    => $this->request->getVar('end_time'),
            'satta_number'    => $sattanumber,
        ]; 

        $satta->insert($sattaData);


        // going to home with flash data
        $session->setFlashdata('success', 'list created successfully');
        return redirect('create');
    }


    public function adminSattaEdit($id = null) {
        
        $satamodel = new SattaModel();
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

        if (! $this->validate($rules)) {
            return view('adminEdit', [
                'validation' => $this->validator, 
            ]);
        }


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

        $satamodel->update($this->request->getVar('id'), $sattaData);

        // going to home with flash data
        $session->setFlashdata('success', 'list updated successfully');
        return redirect('admin');
    }


    public function adminSattaDelete($id = null) {

        $session = \Config\Services::session();

        $satamodel = new SattaModel();
        $row = $satamodel->find($id);

        if($row != null ) {
            $satamodel->delete($id);


            $session->setFlashdata('success', 'list removed successfully');
            return redirect('admin');

        }
    }
}
