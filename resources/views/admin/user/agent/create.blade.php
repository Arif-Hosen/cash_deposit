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
              <h2 class="panel-title">Create new Agent</h2>
            </header>


            <div class="panel-body">

              @if(\App\Helper\CustomHelper::canView('List Of User', 'Super Admin'))
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.user.list') }}" class="brn btn-success btn-sm">List of Agents</a>
                </div>
              </div>
              @endif

              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Full name <span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Full name" required value="{{ old('name') }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Login ID<span class="text-danger">*</span></label>
                      <input type="text" name="username" placeholder="Username" required value="{{ old('username') }}"
                             class="form-control @error('username') is-invalid @enderror">
                      @error('username')
                      <strong class="text-danger">{{ $errors->first('username') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Email <span class="text-danger">*</span></label>
                      <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                             class="form-control @error('email') is-invalid @enderror" required>
                      @error('email')
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Phone No <span class="text-danger">*</span></label>
                      <input type="number" name="phone" placeholder="Phone No" value="{{ old('phone') }}"
                             class="form-control @error('phone') is-invalid @enderror" required>
                      @error('phone')
                      <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Password<span class="text-danger">*</span></label>
                      <input type="password" name="password" placeholder="Password" required
                             value="{{ old('password') }}"
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
                        {{-- <option value="">Choose a role</option> --}}
                        {{-- @foreach($roles as $role) --}}
                          <option value="{{ $roles[0]->id }}"
                                  @if(old('role') == $roles[0]->id) selected @endif>{{ ucfirst($roles[0]->name) }}</option>
                        {{-- @endforeach --}}
                      </select>
                      @error('role')
                      <strong class="text-danger">{{ $errors->first('role') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Set Interest<span class="text-danger">*</span></label>
                      <input type="number" name="interest_percentage" placeholder="15" value="{{ old('interest_percentage') }}"
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
                                  @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
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
