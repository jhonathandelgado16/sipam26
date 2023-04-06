<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Militar;
use App\Models\Pelotao;
use App\Models\Posto;
use App\Models\Subunidade;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = '';
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);
        if (Auth::user()->hasRole('Admin')) {
            $militares = Militar::all();
        } else {
            $militares = Militar::where('subunidade_id', $user->subunidade_id)->get();
        }

        return view('militares.index',compact('user_auth', 'militares', 'search'));
    }
}
