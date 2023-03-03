<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\District;
use App\Models\Division;
use App\Models\Institute;
use App\Models\Notification;
use App\Models\Training;
use App\Models\Upazila;
use App\Models\User;
use App\Rules\MatchOldPasswordRule;
use App\Rules\MinWordsRule;
use Illuminate\Http\Request;

class AdminController extends Controller {
  public function logout() {
    \auth()->logout();
    \session()->flush();
    return redirect()->route('login');
  }

  public function index() {
    $today = (date('Y-m-d'));
    $today = date('Y-m-d', strtotime($today . ' +1 day'));

    // $data['name'] = User::with('institute')->where('id', auth()->id())->get();
    //  $data['name'][0]->institute->name;
    return view('admin.index');
  }

  public function profile() {
    $data['divisions'] = Division::Select('name', 'id')->orderby('name', 'asc')->get();
    $data['districts'] = District::Select('name', 'id')->orderby('name', 'asc')->get();
    return view('admin.profile', $data);
  }

  public function profileUpdate(Request $request) {
    $request->validate([
      'username' => 'required|string|unique:' . with(new User)->getTable() . ',username,' . auth()->id(),
      'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,' . auth()->id(),
      'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
      'name_en' => 'required|string',
//      'name_bn' => 'nullable|string',
//      'father_name' => 'nullable|string',
//      'mother_name' => 'nullable|string',
//      'email' => 'required|unique:' . with(new User)->getTable() . ',email,',
//      'phone' => 'required|unique:' . with(new User)->getTable() . ',phone,',
      'nid ' => 'nullable|unique:' . with(new User)->getTable() . ',nid,',
      'dob ' => 'nullable|date',
      'alt_phone' => 'nullable|string|regex:' . CustomHelper::PhoneNoRegex,
//      'village' => 'nullable|string',
//      'ps' => 'nullable|string',
//      'po' => 'nullable|string',
//      'division_id' => 'nullable|numeric|exists:' . with(new Division)->getTable() . ',id',
//      'district_id' => 'nullable|numeric|exists:' . with(new District)->getTable() . ',id',
    ]);
//    return $request->all();

    $data = $request->only(['username', 'email', 'phone', 'name_en', 'dob', 'alt_phone']);
//    return $data;
    $user = User::where('id', auth()->user()->id);

    try {
//        auth()->user()->update($data);
      if ($request->hasFile('profile_photo')) {
        $logo = CustomHelper::storeImage($request->file('profile_photo'), '/users/');
        if ($logo != false) {
          $user->profile_photo_path = $logo;
        }
      }
      if (!$request->hasFile('profile_photo')) {
        $user->profile_photo_path = $request->old_photo;
      } else {
        CustomHelper::deleteFile($request->old_photo);
      }
      auth()->user()->update($data);


    } catch (\Exception $e) {
      return $e;
    }
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                <strong>Congratulation !!!</strong> Profile updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    return redirect()->back()->with('updateProfile', $status);
  }

  public function passwordUpdate(Request $request) {
    $request->validate([
      'current_password' => ['required', 'string', 'min:' . User::$minimumPasswordLength, new MatchOldPasswordRule()],
      'password' => 'required|string|min:' . User::$minimumPasswordLength,
      'password_confirmation' => 'required|string|min:' . User::$minimumPasswordLength . '|same:password'
    ]);
    \auth()->user()->update(['password' => bcrypt($request->password)]);
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                <strong>Congratulation !!!</strong> Password updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    return redirect()->back()->with('updatePassword', $status);
  }

  public function instituteProfile(Request $request) {
    if ($institute = Institute::find(auth()->user()->institute_id)) {
      if ($request->isMethod('POST')) {
//        return $request;
        $request->validate([
          "name" => 'required|string',
          "name_bn" => 'required|string',
          "code" => 'required|numeric',
          "phone" => 'required|numeric|unique:' . with(new Institute)->getTable() . ',phone,' . $institute->id,
          "email" => 'required|email|unique:' . with(new Institute)->getTable() . ',email,' . $institute->id,
          "website" => 'required|url',
          "division_id" => 'required|numeric|exists:' . with(new Division)->getTable() . ',id',
          "district_id" => 'required|numeric|exists:' . with(new District)->getTable() . ',id',
          "upazila_id" => 'required|numeric|exists:' . with(new Upazila)->getTable() . ',id',
          "address" => 'required|string',
        ]);

        $institute->name = $request->name;
        $institute->name_bn = $request->name_bn;
        $institute->code = CustomHelper::fillLeft($request->code);
        $institute->phone = $request->phone;
        $institute->email = $request->email;
        $institute->website = $request->website;
        $institute->division_id = $request->division_id;
        $institute->district_id = $request->district_id;
        $institute->upazila_id = $request->upazila_id;
        $institute->address = $request->address;

        $old_photo = $institute->photo;
        if ($request->hasFile('photo')) {
          $logo = CustomHelper::storeImage($request->file('photo'), '/institute/');
          if ($logo != false) {
            $institute->photo = $logo;
          }
        }

        try {

          if ($institute->save()) {
            if ($old_photo != $institute->photo) {
              CustomHelper::deleteFile($old_photo);
            }
            return RedirectHelper::back('<strong>Congratulation!!! </strong> Profile Updated.');
          }
          return RedirectHelper::backWithWarning('<strong>Sorry!!! </strong> Update not possible.');
        } catch (\Exception $e) {
          return $e;
        }
      }
      $data['institute'] = $institute;
      $data['divisions'] = Division::select('id', 'name')->orderBy('name')->get();
      $data['districts'] = District::select('id', 'name')->orderBy('name')->get();
      $data['upazilas'] = Upazila::select('id', 'name')->orderBy('name')->get();
      return view('admin.institute.profile', $data);
    }
    return RedirectHelper::routeWarning('admin.dashboard', '<strong>Sorry!!!</strong> Institute not found');
  }
}
