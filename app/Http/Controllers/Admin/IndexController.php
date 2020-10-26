<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends AdminController
{
    public function index() {
        $this->template = env('THEME') . '.admin.admin';


        return $this->renderOutput();
    }
}
