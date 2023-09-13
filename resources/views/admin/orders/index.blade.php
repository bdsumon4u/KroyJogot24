@extends('layouts.light.master')
@section('title', 'Orders')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<style>
    .dt-buttons.btn-group {
        margin: .25rem 1rem 1rem 1rem;
    }
    .dt-buttons.btn-group .btn {
        font-size: 12px;
    }
    th:focus {
        outline: none;
    }
</style>
@endpush

@section('breadcrumb-title')
<h3>Orders</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Orders</li>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="orders-table">
            <div class="card rounded-0 shadow-sm">
                <div class="card-header p-3">
                    <strong>All Orders</strong>
                    <div class="row d-none">
                        <div class="col-auto">
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="">Change Status</option>
                                @foreach(config('app.orders', []) as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" onclick="changeStatus()">Update</button>
                        </div>
                        <div class="col-auto">
                            <button onclick="printInvoice()" id="invoice" class="btn btn-sm btn-primary float-right">Invoice</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="check_all">
                                    </th>
                                    <th width="80">ID</th>
                                    <th style="min-width: 80px;">DateTime</th>
                                    <th style="min-width: 120px;">Name</th>
                                    <th style="min-width: 100px;">Phone</th>
                                    <th style="min-width: 250px;">Address</th>
                                    <th width="10">Price</th>
                                    <th width="10">Status</th>
                                    <th width="10">Staff</th>
                                    <th width="10" class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/product-list-custom.js')}}"></script>
@endpush

@push('scripts')
<script>
    var checked_count = 0;
    function updateBulkMenu() {
        var total = $('[name="order_id[]"]').length;
        checked_count = $('[name="order_id[]"]:checked').length;
        $('[name="check_all"]').prop('checked', checked_count === total);

        if (checked_count > 0) {
            $('.card-header > .row').removeClass('d-none');
            $('.card-header > strong').addClass('d-none');
        } else {
            $('.card-header > .row').addClass('d-none');
            $('.card-header > strong').removeClass('d-none');
        }
    }
    $('[name="check_all"]').on('change', function () {
        var checked = $(this).prop('checked');
        $('[name="order_id[]"]').prop('checked', checked);
        updateBulkMenu();
    });

    var table = $('.datatable').DataTable({
        search: [
            {
                bRegex: true,
                bSmart: false,
            },
        ],
        // aoColumns: [{ "bSortable": false }, null, null, { "sType": "numeric" }, { "sType": "date" }, null, { "bSortable": false}],
        dom: 'lBftip',
        buttons: [
            @foreach(config('app.orders', []) as $status)
            {
                text: '{{ $status }}',
                className: 'btn-light text-dark px-1 py-1 {{ request('status') === strtolower($status) ? 'active' : '' }}',
                action: function ( e, dt, node, config ) {
                    window.location = '{!! request()->fullUrlWithQuery(['status' => strtolower($status)]) !!}'
                }
            },@endforeach,
            {
                text: 'All',
                className: 'btn-light text-dark px-1 py-1 {{ request('status') === null ? 'active' : '' }}',
                action: function ( e, dt, node, config ) {
                    window.location = '{!! request()->fullUrlWithQuery(['status' => '']) !!}'
                }
            },
        ],
        columnDefs: [
            {
                type: 'num',
                orderable: false,
                searchable: false,
                targets: -4
            },
            {
                orderable: false,
                searchable: false,
                targets: -1
            },
        ],
        processing: true,
        serverSide: true,
        ajax: "{!! route('api.orders', request()->query() + ['admin_id' => request()->user()->id, 'role_id' => request()->user()->role_id]) !!}",
        columns: [
            { data: 'checkbox', name: 'checkbox', sortable: false, searchable: false},
            { data: 'id', name: 'id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
            { data: 'price', name: 'price' },
            { data: 'status', name: 'status' },
            { data: 'admin_id', name: 'admin_id' },
            { data: 'actions', name: 'actions' },
        ],
        initComplete: function () {
            // var tr = $(this.api().table().header()).children('tr').clone();
            // tr.find('th').each(function (i, item) {
            //     $(this).removeClass('sorting').addClass('p-1');
            // });
            // tr.appendTo($(this.api().table().header()));
            // this.api().columns().every(function (i) {
            //     var th = $(this.header()).parents('thead').find('tr').eq(1).find('th').eq(i);
            //     $(th).empty();

            //     if ($.inArray(i, [1, 5, 7]) === -1) {
            //         var column = this;
            //         var input = document.createElement("input");
            //         input.classList.add('form-control', 'border-primary');
            //         $(input).appendTo($(th))
            //             .on('change', function () {
            //                 if (i) {
            //                     column.search($(this).val(), false, false, true).draw();
            //                 } else {
            //                     column.search('^'+ (this.value.length ? this.value : '.*') +'$', true, false).draw();
            //                 }
            //             });
            //     }
            // });
        },
        order: [
            // [1, 'desc']
        ],
        // pageLength: 1,
    });

    setInterval(() => {
        $(document).find('[name="order_id[]"]').off('change', updateBulkMenu);
        $(document).find('[name="order_id[]"]').on('change', updateBulkMenu);
    }, 500);

    function changeStatus() {
        $.post({
            url: '{{ route('admin.orders.status') }}',
            data: {
                _token: '{{ csrf_token() }}',
                order_id: $('[name="order_id[]"]:checked').map(function () {
                    return $(this).val();
                }).get(),
                status: $('[name="status"]').val(),
            },
            success: function (response) {
                $('[name="order_id[]"]:checked').prop('checked', false);
                $('[name="check_all"]').prop('checked', false);
                updateBulkMenu();
                table.draw();
            }
        });
    }

    function printInvoice() {
        window.open('{{ route('admin.orders.invoices') }}?order_id=' + $('[name="order_id[]"]:checked').map(function () {
            return $(this).val();
        }).get().join(','), '_blank');
    }

    // $('.datatable thead tr').clone(true).appendTo( '.datatable thead' );
    // $('.datatable thead tr th').each( function (i) {
    //     if ($.inArray(i, [0]) != -1) {
    //         var title = $(this).text();
    //         $(this).removeClass('sorting').addClass('p-1').html( '<input class="form-control" type="text" placeholder="'+title+'" size="10" />' );
    //
    //         $( 'input', this ).on( 'keyup change', function () {
    //             if ( table.column(i).search() !== this.value ) {
    //                 table
    //                     .column(i)
    //                     .search('^'+ (this.value.length ? this.value : '.*') +'$', true, false)
    //                     .draw();
    //             }
    //         } );
    //     }
    // });
</script>
@endpush
