<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\Payment;
use App\Models\SubAgent;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class WithdrawController extends Controller
{

public function list(){
    $wid['wid'] = Withdraw::get();
    $data['datas'] = Payment::orderby('id', 'desc')->get();
//        return $wid;
    return view('admin.cashmanage.withdrawmanage', $data, $wid);

}


    public function create(){
        // return auth()->user()->roles->pluck('name')[0];
//        if((auth()->user()->roles->pluck('name')[0] == "Super Admin")){
//            $data['agents'] = User::whereHas('roles',function( $user){$user->where('roles.name','Agent');})->get();
//            $data['isAdmin'] = true;
//        }


        $user_id=app('request')->user()->id;
        $activewith = Withdraw::select(DB::raw("SUM(`amount`) as `sum_total`"))
            ->where('status', '=', Withdraw::$statusArrays[1])->groupby('withdraw_id')->where('user_id',$user_id)->get();
        $data['sum_total'] = $activewith[0]['sum_total'] ?? "";
        $data['user'] = User::whereHas('roles',function( $user){$user->where('roles.name','Agent','Sub Agent');})->first();
        $data['bkash'] = Payment::where('user_id',$user_id)->where('name','bkash personal')->get();
        $wid['wid'] = Withdraw::where('user_id',$user_id)->get();
//        return $datas;
        $data['roles'] = Role::select('id', 'name')->orderby('name', 'asc')->get();
        return view('admin.cash.withdraw', $data, $wid);
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
//        return $request;
        $message = '<strong>Congratulations!!!</strong> Withdraw successfully ';
        if ($request->has('id')) {
            $withdraw = Withdraw::find($request->id);
            $rules['withdraw_id'] = 'required|string';
            $rules['transaction_type'] = 'required|string';
            $rules['amount'] = 'nullable|numeric';
                        $message = $message . ' updated';
        } else {
            $withdraw = new Withdraw();
            $rules['withdraw_id'] = 'required|string';
            $rules['amount'] = 'nullable|string';

            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $withdraw->user_id = auth()->id();
            $withdraw->withdraw_id = $request->withdraw_id;
            $withdraw->transaction_type = $request->transaction_type;
            $withdraw->amount = $request->amount;
            $withdraw->status = Withdraw::$statusArrays[0];
            if ($withdraw->save()) {
                return RedirectHelper::routeSuccess('admin.withdraw.create', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
//            return $e;
            return RedirectHelper::backWithInputFromException();
        }

    }



    public function destroy(Request $request)
    {
        $id = $request->post('id');
        try {
            $user = SubAgent::find($id);
            if ($user->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }


    /**
     * @param Request $request
     * @return string|void
     */
    public function ajaxUpdateStatus(Request $request)
    {
        if ($request->isMethod("POST")) {
            $id = $request->post('id');
            $postStatus = $request->post('status');
            $status = strtolower($postStatus);
            $user = Withdraw::find($id);
            if ($user->update(['status' => $status])) {
                return "success";
            }
        }
    }








}
