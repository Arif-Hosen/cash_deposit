@extends('layout.admin')

@section('content')
  <div class="container">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>

          <p class="mt-1 text-sm text-gray-600">
            Update your accounts profile information and email address.
          </p>
        </div>

        <div class="px-4 sm:px-0">

        </div>
      </div>

      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('admin.profile.update') }}" method="POST">
          @csrf
          <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            @if(session()->has('updateProfile'))
              {!! session()->get('updateProfile') !!}
            @endif
            <div class="grid grid-cols-6 gap-6">
              <!-- UserName -->
              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="username">Username</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('username') is-invalid @enderror"
                  id="username"
                  name="username" type="text" autocomplete="username" value="{{ old('username', auth()->user()->username) }}">
                @error('username')
                <strong class="text-danger">{{ $errors->first('username') }}</strong>
                @enderror
              </div>
              <!-- Email -->
              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('email') is-invalid @enderror"
                  id="email"
                  name="email" type="email" autocomplete="email" value="{{ old('email', auth()->user()->email) }}">
                @error('email')
                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                @enderror
              </div>
              <!-- Phone -->
              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="phone">Phone</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('phone') is-invalid @enderror"
                  id="phone"
                  name="phone" type="number" autocomplete="phone" value="{{ old('phone', auth()->user()->phone) }}">
                @error('phone')
                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                @enderror
              </div>
              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="name_en">Name (English)</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('name_en') is-invalid @enderror"
                  id="name_en"
                  name="name_en" type="text" autocomplete="name_en" value="{{ old('name_en', auth()->user()->name_en) }}">
                @error('name_en')
                <strong class="text-danger">{{ $errors->first('name_en') }}</strong>
                @enderror
              </div>
{{--              <div class="col-span-6 sm:col-span-4">--}}
{{--                <label class="block font-medium text-sm text-gray-700" for="name_bn">Name(Bangla)</label>--}}
{{--                <input--}}
{{--                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('name_bn') is-invalid @enderror"--}}
{{--                  id="name_bn"--}}
{{--                  name="name_bn" type="text" autocomplete="name_bn" value="{{ old('name_bn', auth()->user()->name_bn) }}">--}}
{{--                @error('name_bn')--}}
{{--                <strong class="text-danger">{{ $errors->first('name_bn') }}</strong>--}}
{{--                @enderror--}}
{{--              </div>--}}
{{--              <div class="col-span-6 sm:col-span-4">--}}
{{--                <label class="block font-medium text-sm text-gray-700" for="father_name">Father Name </label>--}}
{{--                <input--}}
{{--                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('father_name') is-invalid @enderror"--}}
{{--                  id="father_name"--}}
{{--                  name="father_name" type="text" autocomplete="father_name" value="{{ old('father_name', auth()->user()->father_name) }}">--}}
{{--                @error('father_name')--}}
{{--                <strong class="text-danger">{{ $errors->first('father_name') }}</strong>--}}
{{--                @enderror--}}
{{--              </div>--}}
{{--              <div class="col-span-6 sm:col-span-4">--}}
{{--                <label class="block font-medium text-sm text-gray-700" for="mother_name">Mother Name</label>--}}
{{--                <input--}}
{{--                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('mother_name') is-invalid @enderror"--}}
{{--                  id="mother_name"--}}
{{--                  name="mother_name" type="text" autocomplete="mother_name" value="{{ old('mother_name', auth()->user()->mother_name) }}">--}}
{{--                @error('mother_name')--}}
{{--                <strong class="text-danger">{{ $errors->first('mother_name') }}</strong>--}}
{{--                @enderror--}}
{{--              </div>--}}
{{--              <div class="col-span-6 sm:col-span-4">--}}
{{--                <label class="block font-medium text-sm text-gray-700" for="nid">NID</label>--}}
{{--                <input--}}
{{--                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('phone') is-invalid @enderror"--}}
{{--                  id="nid"--}}
{{--                  name="nid" type="text" autocomplete="nid" value="{{ old('nid', auth()->user()->nid) }}">--}}
{{--                @error('nid')--}}
{{--                <strong class="text-danger">{{ $errors->first('nid') }}</strong>--}}
{{--                @enderror--}}
{{--              </div>--}}
              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="birth_certificate">Date of birth</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('birth_certificate') is-invalid @enderror"
                  id="birth_certificate"
                  name="birth_certificate" type="text" autocomplete="birth_certificate" value="{{ old('birth_certificate', auth()->user()->birth_certificate) }}">
                @error('birth_certificate')
                <strong class="text-danger">{{ $errors->first('birth_certificate') }}</strong>
                @enderror
              </div>
              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="village">Village</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('village') is-invalid @enderror"
                  id="village"
                  name="village" type="text" autocomplete="village" value="{{ old('village', auth()->user()->village) }}">
                @error('village')
                <strong class="text-danger">{{ $errors->first('village') }}</strong>
                @enderror
              </div>
{{--              <div class="col-span-6 sm:col-span-4">--}}
{{--                <label class="block font-medium text-sm text-gray-700" for="po">P.O.</label>--}}
{{--                <input--}}
{{--                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('po') is-invalid @enderror"--}}
{{--                  id="po"--}}
{{--                  name="po" type="text" autocomplete="po" value="{{ old('po', auth()->user()->po) }}">--}}
{{--                @error('po')--}}
{{--                <strong class="text-danger">{{ $errors->first('po') }}</strong>--}}
{{--                @enderror--}}
{{--              </div>--}}
{{--              <div class="col-span-6 sm:col-span-4">--}}
{{--                <label class="block font-medium text-sm text-gray-700" for="ps">P.S.</label>--}}
{{--                <input--}}
{{--                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('ps') is-invalid @enderror"--}}
{{--                  id="ps"--}}
{{--                  name="ps" type="text" autocomplete="ps" value="{{ old('ps', auth()->user()->ps) }}">--}}
{{--                @error('ps')--}}
{{--                <strong class="text-danger">{{ $errors->first('ps') }}</strong>--}}
{{--                @enderror--}}
{{--              </div>--}}
{{--              <div class="col-span-6 sm:col-span-4">--}}
{{--                <div class="form-group">--}}
{{--                  <label class="block font-medium text-sm text-gray-700">Division</label>--}}
{{--                  <select name="division_id"--}}
{{--                          class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('division_id') is-invalid @enderror">--}}
{{--                    <option value="">Choose a district</option>--}}
{{--                    @foreach($divisions as $division)--}}
{{--                      <option value="{{ $division->id }}"--}}
{{--                        @selected($division->id == old('division->id', auth()->user()->division_id))>{{ $division->name }}</option>--}}
{{--                    @endforeach--}}
{{--                  </select>--}}
{{--                  @error('division')--}}
{{--                  <strong class="text-danger">{{ $errors->first('division') }}</strong>--}}
{{--                  @enderror--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="col-span-6 sm:col-span-4">--}}
{{--                <div class="form-group">--}}
{{--                  <label class="block font-medium text-sm text-gray-700">District</label>--}}
{{--                  <select name="district_id"--}}
{{--                          class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('district_id') is-invalid @enderror">--}}
{{--                    <option value="">Choose a district</option>--}}
{{--                    --}}{{--                        @foreach($divisions as $val)--}}
{{--                    @foreach($districts as $district)--}}
{{--                      <option value="{{ $district->id }}"--}}
{{--                        @selected($district->id == old('district_id', auth()->user()->district_id))>{{ $district->name }}</option>--}}
{{--                    @endforeach--}}
{{--                    --}}{{--                        @endforeach--}}
{{--                  </select>--}}
{{--                  @error('district')--}}
{{--                  <strong class="text-danger">{{ $errors->first('district') }}</strong>--}}
{{--                  @enderror--}}
{{--                </div>--}}
{{--              </div>--}}
              <div class="col-span-6 sm:col-span-4">
                <div class="form-group">
                  <label class="control-label">Profile Photo <label class="text-danger">*</label></label>
                  <input type="file" name="profile_photo" placeholder="Profile Photo" value="{{ old('profile_photo', auth()->user()->profile_photo_path) }}"
                         class="form-control @error('profile_photo') is-invalid @enderror">
                  @error('profile_photo')
                  <strong class="text-danger">{{ $errors->first('profile_photo',auth()->user()->profile_photo_path ) }}</strong>
                  @enderror
                </div>
                <div>
                  <img style="width: 100px" src="{{asset(old('profile_photo', auth()->user()->profile_photo_path))}}" alt="">
                  <input type="hidden" name="old_photo" value="{{(old('profile_photo', auth()->user()->profile_photo_path))}}" alt="">

                </div>

                <div>
                  <img style="width: 100px" src="{{asset(old('profile_photo', auth()->user()->profile_photo_path))}}" alt="">
                  <input type="hidden" name="old_photo" value="{{(old('profile_photo', auth()->user()->profile_photo_path))}}" alt="">

                </div>
              </div>
            </div>
          </div>

          <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="hidden sm:block">
      <div class="py-8">
        <div class="border-t border-gray-200"></div>
      </div>
    </div>

    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Update Password</h3>

            <p class="mt-1 text-sm text-gray-600">
              Ensure your account is using a long, random password to stay secure.
            </p>
          </div>

          <div class="px-4 sm:px-0">

          </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
          <form action="{{ route('admin.password.update') }}" method="POST">
            @csrf
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
              @if(session()->has('updatePassword'))
                {!! session()->get('updatePassword') !!}
              @endif
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4">
                  <label class="block font-medium text-sm text-gray-700" for="current_password">
                    Current Password
                  </label>
                  <input
                    class="@error('current_password') is-invalid @enderror border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    id="current_password" name="current_password" type="password" autocomplete="current-password">
                  @error('current_password')
                  <strong class="text-danger">{{ $errors->first('current_password') }}</strong>
                  @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label class="block font-medium text-sm text-gray-700" for="password">
                    New Password
                  </label>
                  <input
                    class="@error('password') is-invalid @enderror border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    id="password" name="password"
                    type="password" autocomplete="new-password">
                  @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                  @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                    Confirm Password
                  </label>
                  <input
                    class="@error('password_confirmation') is-invalid @enderror border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                  @error('password_confirmation')
                  <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
              <button type="submit"
                      class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{--    <div class="hidden sm:block">--}}
    {{--      <div class="py-8">--}}
    {{--        <div class="border-t border-gray-200"></div>--}}
    {{--      </div>--}}
    {{--    </div>--}}


    {{--    <div class="mt-10 sm:mt-0">--}}
    {{--      <div class="md:grid md:grid-cols-3 md:gap-6">--}}
    {{--        <div class="md:col-span-1 flex justify-between">--}}
    {{--          <div class="px-4 sm:px-0">--}}
    {{--            <h3 class="text-lg font-medium text-gray-900">Browser Sessions</h3>--}}

    {{--            <p class="mt-1 text-sm text-gray-600">--}}
    {{--              Manage and log out your active sessions on other browsers and devices.--}}
    {{--            </p>--}}
    {{--          </div>--}}

    {{--          <div class="px-4 sm:px-0">--}}

    {{--          </div>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    </div>--}}

    {{--    <div class="hidden sm:block">--}}
    {{--      <div class="py-8">--}}
    {{--        <div class="border-t border-gray-200"></div>--}}
    {{--      </div>--}}
    {{--    </div>--}}

    {{--    <div class="mt-10 sm:mt-0">--}}
    {{--      <div class="md:grid md:grid-cols-3 md:gap-6">--}}
    {{--        <div class="md:col-span-1 flex justify-between">--}}
    {{--          <div class="px-4 sm:px-0">--}}
    {{--            <h3 class="text-lg font-medium text-gray-900">Delete Account</h3>--}}

    {{--            <p class="mt-1 text-sm text-gray-600">--}}
    {{--              Permanently delete your account.--}}
    {{--            </p>--}}
    {{--          </div>--}}

    {{--          <div class="px-4 sm:px-0">--}}

    {{--          </div>--}}
    {{--        </div>--}}

    {{--        <div class="mt-5 md:mt-0 md:col-span-2">--}}
    {{--          <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">--}}
    {{--            <div class="max-w-xl text-sm text-gray-600">--}}
    {{--              Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that--}}
    {{--              you wish to retain.--}}
    {{--            </div>--}}

    {{--            <div class="mt-5">--}}
    {{--              <button type="button"--}}
    {{--                      class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">--}}
    {{--                Delete Account--}}
    {{--              </button>--}}
    {{--            </div>--}}
    {{--          </div>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    </div>--}}
  </div>
@endsection

@section('script')

  <script>
    $('select[name="division_id"]').change(function () {
      const $this = $('select[name="district_id"]')
      var idDivision = this.value;
      $this.html('');
      $.ajax({
        url: "{{url('api/fetch-districts')}}/" + idDivision,
        type: "GET",
        dataType: 'json',
        success: function (result) {
          $this.html('<option value="">-- Select District --</option>');
          $.each(result.districts, function (key, value) {
            $this.append('<option value="' + value
              .id + '">' + value.name + '</option>');
          });

        }
      });
    });


  </script>

@endsection
