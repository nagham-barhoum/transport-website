<?php

namespace App\Http\Controllers;

use App\Enums\OrderTypesEnums;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\OrdersGetRequest;
use App\Http\Requests\OrdersUpdateRequest;
use App\Models\Entsorgung;
use App\Models\Transport;
use App\Models\umzuge;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $per_page;

    public function __construct()
    {
        $this->per_page = 15;
    }
    public function getAll(Request $request)
    {
        $orders = [
            'umzuges' => Umzuge::orderBy('created_at', 'desc')->paginate($this->per_page, ['*'], 'page', $request->page),
            'transports' => Transport::orderBy('created_at', 'desc')->paginate($this->per_page, ['*'], 'page', $request->page),
            'entsorgung' => Entsorgung::orderBy('created_at', 'desc')->paginate($this->per_page, ['*'], 'page', $request->page),
        ];
        return response()->json(['data' => $orders], 200);
    }
    public function get(OrdersGetRequest $request)
    {
        $valid = $request->validated();
        if ($valid['type'] == OrderTypesEnums::umzuge->value) {
            $order = Umzuge::find($valid['order_id']);
        } elseif ($valid['type'] == OrderTypesEnums::transport->value) {
            $order = Transport::find($valid['order_id']);
        } else {
            $order = Entsorgung::find($valid['order_id']);
        }
        return response()->json(['data' => $order], 200);
    }
    public function update(OrdersUpdateRequest $request)
    {
        try {
            $valid = $request->validated();
            $file_path = '';
            if ($valid['type'] == OrderTypesEnums::umzuge->value) {
                $order = Umzuge::findOrFail($valid['order_id']);
                $type = 'umzuge';
            } elseif ($valid['type'] == OrderTypesEnums::transport->value) {
                $order = Transport::findOrFail($valid['order_id']);
                $type = 'transport';
            } else {
                $order = Entsorgung::findOrFail($valid['order_id']);
                $type = 'entsorgung';
            }
            if ($order) {
                if ($request->hasFile('file') && $request->file('file')->isValid()) {
                    if ($order->getOriginal('file')) {
                        $order->deleteFile($order->getOriginal('file'));
                    }
                    $file_path = $request->file('file')->store('files/' . $type, 'public');
                }
                $order->update($valid);
                $order->file = $file_path;
                $order->save();
            }
            return response()->json(['data' => $order, 'message' => 'update Successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Model not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error with updating Model'], 500);
        }
    }
    public function filter(FilterRequest $request)
    {
        try {
            $valid = $request->validated();
            $orders = [
                'umzuges' => umzuge::orderBy('created_at', 'desc')->where('approved_date', '>=', $valid['approved_date'])->get(),
                'transports' => Transport::orderBy('created_at', 'desc')->where('approved_date', '>=', $valid['approved_date'])->get(),
                'entsorgung' => Entsorgung::orderBy('created_at', 'desc')->where('approved_date', '>=', $valid['approved_date'])->get(),
            ];
            return response()->json(['data' => $orders, 'message' => 'get Successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Model not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error with updating Model'], 500);
        }
    }
    public function delete(DeleteRequest $request){
        try {
            $valid = $request->validated();
            if ($valid['type'] == OrderTypesEnums::umzuge->value) {
                $order = Umzuge::findOrFail($valid['order_id']);
            } elseif ($valid['type'] == OrderTypesEnums::transport->value) {
                $order = Transport::findOrFail($valid['order_id']);
            } else {
                $order = Entsorgung::findOrFail($valid['order_id']);
            }
            $order->delete();
            return response()->json(['data' => $order, 'message' => 'deleted Successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Model not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error with updating Model'], 500);
        }
    }
}
