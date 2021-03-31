<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\MasterLog;
use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '5') {
                $user = User::paginate(10);

                return view('role.index')->with('user', $user);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');;
    }


    public function create()
    {

        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '5') {
                // return  to Role Create
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');;
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $user = auth()->user();
        $role = Role::all();
        foreach ($user->role as $item) {
            if ($item->id == '5') {
                $log = MasterLog::where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(20);
                $calledUser = User::where('id', $id)->first();
                return view('role.show')
                    ->with('user', $user)
                    ->with('role', $role)
                    ->with('calledUser', $calledUser)
                    ->with('log', $log);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');;
    }


    public function edit(Role $role)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '5') {
                // Return To Role Edit
                return "قيد الانشاء";
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');;
    }

    public function update(Request $request, Role $role)
    {
        //
    }

    public function userRole(Request $request,  $id)
    {
        $user = User::find($id);
        $user->role()->sync($request->role);
        return redirect()->route('role')
            ->with('success', 'نجحت');
    }
}
