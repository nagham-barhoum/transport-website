<?php

namespace App\Http\Controllers;

use App\Http\Requests\users\AddUsersRequest;
use App\Http\Requests\users\UpdateUsersRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $model, $request, $per_page;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->per_page = 15;
    }
    public function getAll(Request $request)
    {
        $users = $this->model->orderBy('created_at', 'desc')->paginate($this->per_page, ['*'], 'page', $request->pageNumber);
        return response()->json(['data' => $users], 200);
    }

    public function store(AddUsersRequest $request)
    {
        try {
            $request->validated()['password'] = Hash::make($request->validated()['password']);
            $user = $this->model->create($request->validated());
            return response()->json(['data' => $user, 'message' => 'data get success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Model not add '.$e], 500);
        }
    }
    public function get(int $id)
    {
        try {
            $user =  $this->model->find($id);
            return response()->json(['data' => $user],);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Model not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error with getting Model'], 404);
        }
    }
    public function update(UpdateUsersRequest $request, int $id)
    {
        try {
            $user = $this->model->find($id);
            if (isset($request->validated()['password']) && $request->validated()['password'] != null) {
                $request->validated()['password'] = Hash::make($request->validated()['password']);
            } else {
                unset($request->validated()['password']);
            }
            $user->update($request->validated());
            return response()->json(['data' => $user, 'message' => 'Model updated successfully'],200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Model not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error with updating Model'], 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->model->delete($id);
            return response()->json(['message' => 'Model permanently deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Model not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error with deleting Model'], 500);
        }
    }
}
