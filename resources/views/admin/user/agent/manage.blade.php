@extends('layout.admin')

@section('stylesheet')
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Manage user</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List of User', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.user.list') }}" class="brn btn-success btn-sm">List of user</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <input type="hidden" name="id" value="{{ $user->id }}">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Name" required value="{{ $user->name_en }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Login ID<span class="text-danger">*</span></label>
                      <input type="text" name="username" placeholder="Username" required value="{{ $user->username }}"
                             class="form-control @error('username') is-invalid @enderror">
                      @error('username')
                      <strong class="text-danger">{{ $errors->first('username') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Email<span class="text-danger">*</span></label>
                      <input type="email" name="email" placeholder="Email" required value="{{ $user->email }}"
                             class="form-control @error('email') is-invalid @enderror">
                      @error('email')
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Phone<span class="text-danger">*</span></label>
                      <input type="number" name="phone" placeholder="Phone" required value="{{ $user->phone }}"
                             class="form-control @error('phone') is-invalid @enderror">
                      @error('phone')
                      <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                      @enderror
                    </div>
                  </div>
               
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Password</label>
                      <input type="password" name="password" placeholder="Password"
                             class="form-control @error('password') is-invalid @enderror">
                      @error('password')
                      <strong class="text-danger">{{ $errors->first('password') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Role<span class="text-danger">*</span></label>
                      <select name="role" required class="form-control @error('role') is-invalid @enderror">
                        <option value="">Choose a role</option>
                        <?php
                        $roleNo = count($user->roles);
                        $role_id = 0;
                        if ($roleNo > 0) {
                          $role_id = $user->roles[0]->id;
                        }
                        $role_id = old('role', $role_id);
                        ?>
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}"
                                  @if($role_id == $role->id) selected @endif>{{ ucfirst($role->name) }}</option>
                        @endforeach
                      </select>
                      @error('role')
                      <strong class="text-danger">{{ $errors->first('role') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Set Interest<span class="text-danger">*</span></label>
                      <input type="number" name="interest_percentage" placeholder="15" value="{{ $user->interest_percentage }}"
                             class="form-control @error('interest_percentage') is-invalid @enderror" required>
                      @error('interest_percentage')
                      <strong class="text-danger">{{ $errors->first('interest_percentage') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Status<span class="text-danger">*</span></label>
                      <select name="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="">Choose a status</option>
                        @foreach(\App\Models\User::$statusArrays as $status)
                          <option value="{{ $status }}"
                                  @if(old('status', $user->status) == $status) selected @endif>{{ ucfirst($status) }}</option>
                        @endforeach
                      </select>
                      @error('status')
                      <strong class="text-danger">{{ $errors->first('status') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
@endsection