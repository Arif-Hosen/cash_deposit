@extends('layout.admin')

@section('stylesheet')
    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Deposit</h2>
                        </header>

                        <div class="panel-body">
                            @if (session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif

                            <div class="row">
                                @foreach ($payment_numbers as $item)
                                    <div class="col-md-3 col-lg-3">
                                        <div class="product-list-box">
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#{{ $item?->name_key }}" data-bs-whatever="@mdo">
                                                <img src="{{ asset($item->image) }}" class="img-fluid"
                                                    alt="work-thumbnail">
                                            </a>
                                            <div class="detail">
                                                <h4 class="font-16 text-center"><a href=""
                                                        class="text-dark">{{ ucfirst($item?->name) }}</a> </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <header class="panel-heading">
                                <h2 class="panel-title">Deposit List</h2>
                            </header>
                            <?php
                            $total = 0;
                            foreach ($total_deposits as $item) {
                                $total += intval($item->amount);
                            }
                            ?>
                            <h1 class="btn btn-primary mb-3 fw-bold">Total Deposit: {{ $total }}</h1>
                            <div class="panel-body">
                                @if (session()->has('status'))
                                    {!! session()->get('status') !!}
                                @endif

                                @if (\App\Helper\CustomHelper::canView('Create Sub Agent', 'Super Admin|Agent'))
                                @endif
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%" style="font-size: 14px">

                                    <thead>
                                        <tr>
                                            <th width="10">#</th>
                                            <th>Date</th>
                                            <th>Transaction Type</th>
                                            <th>Transaction ID</th>
                                            <th>Payment Number</th>
                                            <th>Amount</th>
                                            {{-- <th>Coin Amount</th> --}}
                                            <th>Status</th>
                                            {{-- <th>screen</th>
                                            <th>Action</th> --}}
                                            {{-- @if (\App\Helper\CustomHelper::canView('Manage Sub Agent|Delete Sub Agent', 'Super Admin|Agent'))
                                                <th class="hidden-phone" width="40">Option</th>
                                            @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deposits as $key => $val)
                                            <tr class="@if ($key % 2 == 0) gradeX @else gradeC @endif">
                                                <td class="p-1">{{ $key + 1 }}</td>
                                                <td width="200" class="p-1">
                                                    {{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                                                <td class="p-1 text-capitalize">{{ $val->transaction_type }}</td>
                                                <td class="p-1 text-capitalize">{{ $val->transaction_id }}</td>
                                                <td class="p-1 text-capitalize">{{ $val->payment_no }}</td>
                                                <td class="p-1">{{ $val->amount }}</td>
                                                {{-- <td class="p-1">{{ $val->status }}</td> --}}
                                                {{-- <td class="p-1">{{ $val->phone }}</td> --}}
                                                {{-- <td class="p-1 text-capitalize"> --}}
                                                {{-- {{ \App\Helper\CustomHelper::userRoleName($val) }}</td> --}}


                                                <td class="p-1 text-capitalize "><button
                                                        class="btn text-capitalize @if ($val->status == 'pending') btn-warning @else btn-success @endif">{{ $val->status }}</button>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @foreach ($payment_numbers as $item)
                                <div class="modal fade" id="{{ $item?->name_key }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    <strong>{{ ucfirst($item?->name) }}</strong>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.deposit') }}" method="POST">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Transaction Type<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="transaction_type"
                                                                    class="form-control @error('transaction_type') is-invalid @enderror">
                                                                    <option value="{{ ucfirst($item?->name) }}">
                                                                        {{ ucfirst($item?->name) }}</option>
                                                                    /
                                                                </select>
                                                                @error('transaction_type')
                                                                    <strong
                                                                        class="text-danger">{{ $errors->first('transaction_type') }}</strong>
                                                                @enderror
                                                                <strong class="text-danger" id="name_error"></strong>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Payment No<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="payment_no"
                                                                    class="form-control @error('payment_no') is-invalid @enderror">
                                                                    <option value="">Choose a Payment Number</option>
                                                                    @foreach ($item->numbers as $num)
                                                                        <option value="{{ $num->number }}"
                                                                            @if (old('mobile') == $num->mobile) selected @endif>
                                                                            {{ ucfirst($num->number) }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('payment_no')
                                                                    <strong
                                                                        class="text-danger">{{ $errors->first('payment_no') }}</strong>
                                                                @enderror
                                                                <strong class="text-danger" id="payment_no_error"></strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Transaction Number<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="transaction_id"
                                                                    placeholder="017****" autocomplete="off" required
                                                                    value="{{ old('transaction_id') }}"
                                                                    class="form-control @error('transaction_id') is-invalid @enderror">
                                                                @error('transaction_id')
                                                                    <strong
                                                                        class="text-danger">{{ $errors->first('transaction_id') }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Amount<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="amount" placeholder="017****"
                                                                    autocomplete="off" required
                                                                    value="{{ old('amount') }}"
                                                                    class="form-control @error('amount') is-invalid @enderror">
                                                                @error('amount')
                                                                    <strong
                                                                        class="text-danger">{{ $errors->first('amount') }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                    {{-- nextt  --}}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // $('#datatable-buttons').DataTable();

            // var table = $('#datatable-buttons').DataTable({
            //   lengthChange: false,
            //   buttons: ['copy', 'excel', 'pdf', 'colvis']
            // });
            //
            // table.buttons().container()
            //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


            $(document).on('change', 'input[name="onoffswitch3"]', function() {
                console.log('ttttt')
                var status = 'pending';
                var id = $(this).data('id')
                var isChecked = $(this).is(":checked");
                if (isChecked) {
                    status = 'accepted';
                }
                $.ajax({
                    url: "{{ route('admin.ajax.update.deposit.status') }}",
                    method: "post",
                    dataType: "html",
                    data: {
                        'id': id,
                        'status': status
                    },
                    success: function(data) {
                        if (data === "success") {}
                    }
                });
            })


            {{-- $(document).on('click', '.yes-btn', function () { --}}
            {{--    var pid = $(this).data('id'); --}}
            {{--    var $this = $('.delete_' + pid) --}}
            {{--    $.ajax({ --}}
            {{--        url: "{{ route('admin.subagent.destroy') }}", --}}
            {{--        method: "delete", --}}
            {{--        dataType: "html", --}}
            {{--        data: {id: pid}, --}}
            {{--        success: function (data) { --}}
            {{--            if (data === "success") { --}}
            {{--                $('#userDeleteModal').modal('hide') --}}
            {{--                $this.closest('tr').css('background-color', 'red').fadeOut(); --}}
            {{--            } --}}
            {{--        } --}}
            {{--    }); --}}
            {{-- }) --}}

            {{-- $(document).on('click', '.btn-delete', function () { --}}
            {{--    var pid = $(this).data('id'); --}}
            {{--    $('.yes-btn').data('id', pid); --}}
            {{--    $('#userDeleteModal').modal('show') --}}
            {{-- }); --}}
        })
    </script>
@endsection
