<?php

namespace app\controllers;

class CustomerController extends Controller
{
    public function customers()
    {
        $this->view('customer');
    }
}
