<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $_start = Carbon::parse(\request('start_d'));
        $start = $_start->format('Y-m-d');
        $_end = Carbon::parse(\request('end_d'));
        $end = $_end->format('Y-m-d');

//        dd(Order::query()->first());
        $orders = Order::with('admin')->when($request->has('status'), function ($query) {
            $query->where('status', 'like', \request('status'));
        })
            ->when($request->role_id == 1, function ($query) {
                $query->where('admin_id', request('admin_id'));
            })
            ->when($request->has(['start_d', 'end_d']), function ($query) use ($_start, $_end) {
                $query->whereBetween(Str::of(\request('status'))->lower()->is('shipping') ? 'shipped_at' : 'created_at', [
                    $_start->startOfDay()->toDateTimeString(),
                    $_end->endOfDay()->toDateTimeString()
                ]);
            })
            ->when(!$request->has('order'), function ($query) {
                $query->latest('id');
            });


        return DataTables::of($orders)
            ->addIndexColumn()
            ->setRowAttr([
                'style' => function ($row) {
                    if ($row->data->is_fraud ?? false) {
                        return 'background: #ff9e9e';
                    }
                    if (!($row->data->is_fraud ?? false) && ($row->data->is_repeat ?? false)) {
                        return 'background: #fffeeaa';
                    }
                },
            ])
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="order_id[]" value="' . $row->id . '">';
            })
            ->editColumn('name', function ($row) {
                return "<div class='text-nowrap'>" . $row->name . "<br><span class='text-danger'>" . $row->note . "</span></div>";
            })
            ->editColumn('created_at', function ($row) {
                return "<div class='text-nowrap'>" . $row->created_at->format('d-M-Y') . "<br>" . $row->created_at->format('h:i A') . "</div>";
            })
            ->editColumn('price', function ($row) {
                return ($row->data->subtotal ?? 0) + ($row->data->shipping_cost ?? 0);
            })
            ->editColumn('admin_id', function ($row) {
                return $row->admin->name ?? 'N/A';
            })
            ->addColumn('actions', function (Order $order) {
                return '<div class="d-flex justify-content-center">
                    <a target="_blank" href="'.route('admin.orders.show', $order).'" class="btn btn-sm btn-primary px-2 d-block">View</a>
                    <a href="'.route('admin.orders.destroy', $order).'" data-action="delete" class="btn btn-sm btn-danger px-2 d-block">Delete</a>
                </div>';
            })
            // ->filterColumn('created_at', function($query, $keyword) {
            //     $query->where('created_at', 'like', "%" . Carbon::createFromFormat('d-M-Y', $keyword)->format('Y-m-d') ."%");
            // })
            ->rawColumns(['checkbox', 'name', 'created_at', 'actions'])
            ->make(true);
    }
}
