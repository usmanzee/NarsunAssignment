<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\User;
use Session;

class UsersController extends Controller
{
    public function index() {
    	$users = User::where('type', 2)->with('device')->get();
    	$devices = Device::all();
    	return view('users/index', compact('users', 'devices'));
    }

    public function addUser(Request $request) {
        $params = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'type' => 2
        ];

        User::create($params);
        Session::put('success', 'User added successfully.');
        return redirect('users');
    }

    public function editUser(Request $request, $userId) {
        $params = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ];
        User::where('id', $userId)->update($params);
        Session::put('success', 'User added successfully.');
        return redirect('users');
    }

    public function assignDevice(Request $request) {
        Device::where('id', $request->device)->update([
            'user_id' => $request->user_id
        ]);
        Session::put('success', 'User status update successfully.');
        return redirect('users');
    }

    public function makeUserAvailable(Request $request) {
        Device::where('user_id', $request->user_id1)->update([
            'user_id' => 0
        ]);
        Session::put('success', 'User status update successfully.');
        return redirect('users');
    }
}
