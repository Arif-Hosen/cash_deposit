@extends('layout.admin')

@section('stylesheet')
@section('stylesheet')
  <!-- DataTables -->
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

@endsection
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Create Semester</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('Create Semester', 'Institute Head'))
              {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.trainingType.list') }}" class="brn btn-success btn-sm">List of Training Types</a>
                </div>
              </div> --}}
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.semester.store') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Semester Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Name" autocomplete="off" required
                             value="{{ old('name') }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Status<span class="text-danger">*</span></label>
                      <select name="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="">Choose a status</option>
                        @foreach(\App\Models\Semester::$statusArrays as $status)
                          <option value="{{ $status }}"
                                  @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
                        @endforeach
                      </select>
                      @error('status')
                      <strong class="text-danger">{{ $errors->first('status') }}</strong>
                      @enderror
                      <strong class="text-danger" id="status_error"></strong>
                    </div>
                  </div>
                </div>
                <div class="row">
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
{{-- training list --}}
  <div class="row mt-5">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Semester list</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              @if(\App\Helper\CustomHelper::canView('Create Semester', 'Institute Head'))
               
              @endif
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                     cellspacing="0" width="100%" style="font-size: 14px">

                <thead>
                <tr>
                  <th width="50">#</th>
                  <th>Name</th>
                  <th>Created By</th>
                  <th>Updated By</th>
                  <th>Status</th>
                  @if(\App\Helper\CustomHelper::canView('Manage Semester|Delete Semester', 'Institute Head'))
                    <th class="hidden-phone" width="40">Option</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->name }}</td>
                    <td class="p-1 text-capitalize">{{ $val->created_by }}</td>
                    <td class="p-1 text-capitalize">{{ $val->deleted_by }}</td>

                    @if(\App\Helper\CustomHelper::canView('Manage Institute', 'Institute Head'))
                          <td class="text-capitalize p-1" width="100">
                              <div class="onoffswitch">
                                  <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                         @checked($val->status == \App\Models\Semester::$statusArrays[1])
                                         data-id="{{ $val->id }}"
                                         id="myonoffswitch{{ ($key+1) }}">
                                  <label class="onoffswitch-label" for="myonoffswitch{{ ($key+1) }}">
                                      <span class="onoffswitch-inner"></span>
                                      <span class="onoffswitch-switch"></span>
                                  </label>
                              </div>
                          </td>
                      @else
                          <td class="p-1 text-capitalize">{{ $val->status }}</td>
                      @endif

                    @if(\App\Helper\CustomHelper::canView('Manage Semester|Delete Semester', 'Institute Head'))
                      <td class="center hidden-phone p-1" width="100">
                          @if(\App\Helper\CustomHelper::canView('Manage Semester', 'Institute Head'))
                            
                            <span class="btn btn-sm btn-success btn-manage manage_{{ $val->id }}" style="cursor: pointer"
                              data-id="{{ $val->id }}" data-name="{{ $val->name }}" ><i class="fa fa-edit"></i></span>
                          @endif
                          @if(\App\Helper\CustomHelper::canView('Delete Semester', 'Institute Head'))
                            <span class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                  data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                          @endif
                      </td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>


{{-- manage modal --}}
  <div class="modal fade" id="manageTrainingTypeModal" tabindex="-1" role="dialog" aria-labelledby="manageTrainingType"
       aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <header class="panel-heading">
              <h2 class="panel-title ml-4">Manage Semester</h2>
            </header>
          <div class="modal-body">
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List Of Semester', 'Institute Head'))
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.semester.store') }}" method="post">
                @csrf
                <input type="hidden" class="dt form-control" name="id" id="manage-id" value="">
                @if($datas)
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Name<span class="text-danger">*</span></label>
                      <input type="text" id="manage-name" name="name" placeholder="Name" autocomplete="off" required
                             value= ""
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Status<span class="text-danger">*</span></label>
                      <select name="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="">Choose a status</option>
                        @foreach(\App\Models\Semester::$statusArrays as $status)
                          <option value="{{ $status }}"
                                  @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
                        @endforeach
                      </select>
                      @error('status')
                      <strong class="text-danger">{{ $errors->first('status') }}</strong>
                      @enderror
                      <strong class="text-danger" id="status_error"></strong>
                    </div>
                  </div>
                </div>
                @endif
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  {{-- delete modal --}}
  <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete Semester</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this Semester?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <!-- Required datatable js -->
  <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.colVis.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>


  <script>
    $(document).ready(function () {
      
      // training type show in manage modal  

      $(document).on('click', '.btn-manage', function () {
        var pid = $(this).data('id');
        $("#manage-id").val(pid) ;
        var pName = $(this).data('name');
        $("#manage-name").val(pName) ;
      })

      // model open
      $(document).on('click', '.btn-manage', function () {
        $('#manageTrainingTypeModal').modal('show')
      });
      //end show manage modal  


      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.semester.destroy') }}",
          method: "DELETE",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success") {
              $('#userDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })

      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#userDeleteModal').modal('show')
      });

      $(document).on('change', 'input[name="onoffswitch"]', function () {
        var status = 'inactive';
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 'active';
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.semester.status') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
            }
          }
        });
      })
    
    })
  </script>
@endsection
