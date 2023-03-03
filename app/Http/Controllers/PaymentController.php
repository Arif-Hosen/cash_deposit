<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\Payment;
use App\Models\Payment_number;
// use App\Models\Payment\paymentMethods;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        $data['datas'] = Payment::where('user_id',auth()->id())->with('numbers')->orderby('id', 'desc')->get();
//        return $data;
        return view('admin.payment.index', $data);
    }
    public function store(Request $request)
    {
        // return $request;
        $message = '<strong>Congratulations!!!</strong> Semester Successfully ';
        if ($request->has('id')) {
            $payment = Payment::find($request->id);

            $rules['name'] = 'nullable|string';
            $rules['mobile'] = 'nullable|string';
            $rules['status'] = 'nullable|string';
            $rules['image'] = 'nullable|file|mimes:jpeg,png,jpg';
            $message = $message . ' updated';
        } else {
            $payment = new Payment();

            $payment->user_id = auth()->id();
            $rules['name'] = 'required|string';
            $rules['mobile'] = 'required|string';
            $rules['status'] = 'required|string';
            $rules['image'] = 'nullable|file|mimes:jpeg,png,jpg';
            $message = $message . ' created';
        }
        $request->validate($rules);
        try {
            if(Payment::where('name_key',$request->name)->exists()){
                $method_id = Payment::select('id')->where('name_key',$request->name)->get();
                $method_id = $method_id[0]->id;

                $payment_number = new Payment_number();
                $payment_number->user_id = auth()->id();
                $payment_number->method_id = $method_id;
                $payment_number->number =$request->mobile;
                if($payment_number->save()){
                return RedirectHelper::routeSuccess('admin.payment.create', $message);
            }
            return RedirectHelper::backWithInput();
            }
            $payment->name_key = $request->name;
            $payment->name = Payment::$paymentMethods[$request->name];
            // $payment->mobile = $request->mobile;
            $payment->status = $request->status;
            // $payment->image = $request->image;

            $oldImage = $payment->image;
            // return $oldImage;
            if ($request->hasFile('image')) {
                $logo = CustomHelper::storeImage($request->file('image'), '/paymentMethod/');
                if ($logo != false) {
                    $payment->image = $logo;
                }
            }

            if ($payment->save()) {
              $payment_number = new Payment_number();
              $payment_number->user_id = auth()->id();
              $payment_number->method_id = $payment->id;
              $payment_number->number =$request->mobile;
                if ($oldImage != null && $logo != null) {
                    CustomHelper::deleteFile($oldImage);
                }
                if($payment_number->save()){
                    return RedirectHelper::routeSuccess('admin.payment.create', $message);
                }
                return RedirectHelper::backWithInput();
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            return $e;
            return RedirectHelper::backWithInputFromException();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->post('id');
        try {
            $semester = Payment::find($id);
            if ($semester->delete()) {
                return 'success';
            }
        } catch (\Exception $e) {
        }
    }

    public function ajaxUpdateStatus(Request $request)
    {
        if ($request->isMethod("POST")) {
            $id = $request->post('id');
            $postStatus = $request->post('status');
            $status = strtolower($postStatus);
            $semester = Payment::find($id);
            if ($semester->update(['status' => $status])) {

                return "success";
            }
        }
    }
}
