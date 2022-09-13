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
        echo '<pre>';
        print_r($data);

        return view('home', $data);
    }


    public function admin() {
        return view('admin');
    }

    public function adminCreate() {
   
        if (strtolower($this->request->getMethod()) !== 'post') {
            // get request
            return view('adminCreate', [
                'validation' => null]);
        }

        $rules = [
            'name' => 'required',
            // 'first_three_digit' => '',
            // 'first_one_digit' => '',
            // 'last_one_digit'    => '',
            // 'last_three_digit'    => '',
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

        $sattanumber = $this->request->getVar('end_time') .  $this->request->getVar('end_time') . $this->request->getVar('end_time') . $this->request->getVar('end_time');

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
}
