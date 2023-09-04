<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Validator;

class TodoController extends Controller
{
    public function index()
    {
        $data = Todo::latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => 'Data fetched.'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = Todo::create([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);
        if ($user) {
            return response()->json([
                'status' => 'success',
                'data' => $user,
                'message' => 'Data Added.'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'data' => $user,
                'message' => 'Data Failed.'
            ]);
        }

    }

    public function show($id)
    {
        if (!empty($id)) {
            $data = Todo::find($id);
            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'data' => $data,
                    'message' => 'Data Found.'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'data' => $id,
                    'message' => 'No Data Found.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'data' => $id,
                'message' => 'No Data Found!.'
            ]);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'desc' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $todo = Todo::find($request->id);
        $updated = $todo->update([
            'name' => $request->name,
            'desc' => $request->desc
        ]);
        if ($updated) {
            return response()->json([
                'status' => 'success',
                'data' => $request->id,
                'message' => 'Data Updated.'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'data' => $request->id,
                'message' => 'Data Failed.'
            ]);
        }
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);
        $deleted = $todo->delete();
        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'data' => $id,
                'message' => 'Data Deleted.'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'data' => $id,
                'message' => 'Data Failed.'
            ]);
        }
    }




}
