<?php
namespace App\Controller;

use App\Model\GetOrders;




class DebuggingController extends AppController {
   
    public function index()
    {
        $nabbo = "hah";
        $this->set(compact('nabbo'));
    }
}

