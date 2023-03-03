<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\SubAgent;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class SubAgentController extends Controller
{
    public function index() {
            $data['sub_agent'] = User::with('agent')->whereHas('roles',function( $user){$user->where('roles.name','Sub Agent');})->paginate(100);
//            $data['agent'] = User::select('name_en','id')->where('id', $data['sub_agent'][0]->agent_id)->get();
//        $data['roles'] = Role::select('id', 'name')->orderby('name', 'asc')->get();
//        $roleNames = auth()->user()->roles->pluck('name');
//        $roles = Role::whereIn('name', $roleNames)->get();
//        $data['users'] = User::whereHas('roles', function ($query) use ($roles) {
//            $query->whereIn('role_id', $roles->pluck('id'));
//        })->paginate(100);
//        return $users;
//        $role['data'] = Role::where('name', $roleName)->first();
//        $data['users'] = User::with('roles')->orderby('id', 'desc')->paginate(100);
//return $data;
//        return $data['sub_agent'];
        return view('admin.user.subAgent.list', $data);
    }


    public function create(){
        // return auth()->user()->roles->pluck('name')[0];
        if((auth()->user()->roles->pluck('name')[0] == "Super Admin")){
            $data['agents'] = User::whereHas('roles',function( $user){$user->where('roles.name','Agent');})->get();
            $data['isAdmin'] = true;
        }
        $data['roles'] = Role::select('id', 'name')->orderby('id', 'asc')->get();
        // return $data;
        return view('admin.user.subAgent.create', $data);
    }


    public function manage($id = null)
    {
        $data['roles'] = Role::select('id', 'name')->orderby('name', 'asc')->get();
        if ($data['user'] = User::find($id)) {
            return view('admin.user.subAgent.manage', $data);
        }
        return RedirectHelper::routeWarningWithParams('admin.subagent.list', '<strong>Sorry!!!</strong> Sub Agent not found');
    }



    public function store(Request $request) {
        // return $request->agent_id;
        $message = '<strong>Congratulations!!!</strong> Sub Agent Successfully';
        $rules = [
            'name' => 'required|string',
            'password' => 'required|string|min:' . User::$minimumPasswordLength,
            'status' => ['required', Rule::in(User::$statusArrays)],
        ];
        if ($request->has('id')) {
            $user = User::find($request->id);
            $rules['email'] = 'nullable|email|unique:' . with(new User)->getTable() . ',email,' . $request->id;
            $rules['username'] = 'nullable|string|min:5|max:12|unique:'.with(new user)->getTable().',username';
            $rules['phone'] = 'nullable|string|min:11|max:11|unique:' . with(new User)->getTable() . ',phone,' . $request->id;
            $rules['password'] = 'nullable|string|min:' . User::$minimumPasswordLength;
            $message = $message . ' updated';
        } else {
            $user = new User();
            $rules['email'] = 'required|email|unique:' . with(new User)->getTable() . ',email';
            $rules['username'] = 'required|string|min:5|max:12|unique:'.with(new user)->getTable().',username';
            // $rules['phone'] = 'required|string|min:11|max:11|unique:' . with(new User)->getTable() . ',phone';
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $user->name_en = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if( !(auth()->user()->roles->pluck('name')[0]=='Super Admin')){
                $user->agent_id = auth()->id();
              }
              else{
            $user->agent_id = $request->agent_id;
              }
            $user->assignRole('Sub Agent');
            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }
            $user->status = strtolower($request->status);
            $role = Role::find($request->role);
            if ($user->save()) {
                if (isset($user->roles) && count($user->roles) > 1) {
                    CustomHelper::removeUsersRole($user);
                }
                $user->assignRole($role);
                return RedirectHelper::routeSuccess('admin.subagent.list', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return RedirectHelper::backWithInputFromException();
        }
    }


    public function destroy(Request $request)
    {
        $id = $request->post('id');
        try {
            $user = User::find($id);
            if ($user->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
//            return $e;
        }
    }


    /**
     * @param Request $request
     * @return string|void
     */
    public function ajaxUpdateStatus(Request $request) {
        if ($request->isMethod("POST")) {
            $id = $request->post('id');
            $postStatus = $request->post('status');
            $status = strtolower($postStatus);
            $user = User::find($id);
            if ($user->update(['status' => $status])) {
                return "success";
            }
        }
    }




}
