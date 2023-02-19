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
                            <h2 class="panel-title">Online Payment</h2>
                        </header>


                        <div class="panel-body">



                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <div class="product-list-box">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                            <img src="{{asset('assets/admin/images/cash/1.png')}}" class="img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="detail">
                                            <h4 class="font-16 text-center"><a href="" class="text-dark">bKash Agent</a> </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="product-list-box">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat" href="javascript:void(0);">
                                            <img src="{{asset('assets/admin/images/cash/2.png')}}" class="img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="detail">
                                            <h4 class="font-16 text-center"><a href="" class="text-dark">bKash Personal</a> </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="product-list-box">
                                        <a href="javascript:void(0);">
                                            <img src="{{asset('assets/admin/images/cash/3.png')}}" class="img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="detail">
                                            <h4 class="font-16 text-center"><a href="" class="text-dark">Nagad Personal</a> </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="product-list-box">
                                        <a href="javascript:void(0);">
                                            <img src="{{asset('assets/admin/images/cash/4.png')}}" class="img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="detail">
                                            <h4 class="font-16 text-center"><a href="" class="text-dark">Rocket Personal</a> </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="product-list-box">
                                        <a href="javascript:void(0);">
                                            <img src="{{asset('assets/admin/images/cash/5.png')}}" class="img-fluid" alt="work-thumbnail">
                                        </a>
                                        <div class="detail">
                                            <h4 class="font-16 text-center text-center"><a href="" class="text-dark">Upay Personal</a> </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--                            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">--}}


                            <header class="panel-heading">
                                <h2 class="panel-title">Withdraw List</h2>
                            </header>


                            <div class="panel-body">
                                @if(session()->has('status'))
                                    {!! session()->get('status') !!}
                                @endif

                                @if(\App\Helper\CustomHelper::canView('Create Sub Agent', 'Super Admin|Agent'))
                                    {{--                                        <div class="row">--}}
                                    {{--                                            <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">--}}
                                    {{--                                                <a href="{{ route('admin.subagent.create') }}" class="brn btn-success btn-sm">New Agent</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                @endif
                                {{--<table class="table table-bordered table-striped mb-none" id="data-table">--}}
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                       cellspacing="0" width="100%" style="font-size: 14px">

                                    <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Date</th>
                                        <th>Transaction Type</th>
                                        <th>Mobile/AC Number</th>
                                        <th>Amount</th>
                                        <th>Coin Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        {{--                                            <th width="30">Status</th>--}}
                                        {{--                                            <th width="200">screen</th>--}}
                                        {{--                                            <th width="50">Action</th>--}}
                                        @if(\App\Helper\CustomHelper::canView('Manage Sub Agent|Delete Sub Agent', 'Super Admin|Agent'))
                                            <th class="hidden-phone" width="40">Option</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>







                                {{--Model Start--}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><strong>bKash Agent</strong></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if(session()->has('status'))
                                                {!! session()->get('status') !!}
                                            @endif
                                            <form action="" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">



                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Mobile Number<span class="text-danger">*</span></label>
                                                            <input type="number" name="phone" placeholder="Phone No" value="{{ old('phone') }}"
                                                                   class="form-control @error('phone') is-invalid @enderror" required>
                                                            @error('phone')
                                                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Amount<span class="text-danger">*</span></label>
                                                            <input type="number" name="amount" placeholder="Phone No" value="{{ old('amount') }}"
                                                                   class="form-control @error('amount') is-invalid @enderror" required>
                                                            @error('amount')
                                                            <strong class="text-danger">{{ $errors->first('amount') }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
{{--                                        <div class="modal-footer">--}}
{{--                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                                            <button type="button" class="btn btn-outline-brown">Submit</button>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>





                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#datatable-buttons').DataTable();

            // var table = $('#datatable-buttons').DataTable({
            //   lengthChange: false,
            //   buttons: ['copy', 'excel', 'pdf', 'colvis']
            // });
            //
            // table.buttons().container()
            //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


            {{--$(document).on('change', 'input[name="onoffswitch"]', function () {--}}
            {{--    var status = 'inactive';--}}
            {{--    var id = $(this).data('id')--}}
            {{--    var isChecked = $(this).is(":checked");--}}
            {{--    if (isChecked) {--}}
            {{--        status = 'active';--}}
            {{--    }--}}
            {{--    $.ajax({--}}
            {{--        url: "{{ route('admin.ajax.update.subagent.status') }}",--}}
            {{--        method: "post",--}}
            {{--        dataType: "html",--}}
            {{--        data: {'id': id, 'status': status},--}}
            {{--        success: function (data) {--}}
            {{--            if (data === "success") {--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}
            {{--})--}}


            {{--$(document).on('click', '.yes-btn', function () {--}}
            {{--    var pid = $(this).data('id');--}}
            {{--    var $this = $('.delete_' + pid)--}}
            {{--    $.ajax({--}}
            {{--        url: "{{ route('admin.subagent.destroy') }}",--}}
            {{--        method: "delete",--}}
            {{--        dataType: "html",--}}
            {{--        data: {id: pid},--}}
            {{--        success: function (data) {--}}
            {{--            if (data === "success") {--}}
            {{--                $('#userDeleteModal').modal('hide')--}}
            {{--                $this.closest('tr').css('background-color', 'red').fadeOut();--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}
            {{--})--}}

            {{--$(document).on('click', '.btn-delete', function () {--}}
            {{--    var pid = $(this).data('id');--}}
            {{--    $('.yes-btn').data('id', pid);--}}
            {{--    $('#userDeleteModal').modal('show')--}}
            {{--});--}}
        })
    </script>

@endsection
