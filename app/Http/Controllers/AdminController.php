<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        return view('admins.index');
    }

}
