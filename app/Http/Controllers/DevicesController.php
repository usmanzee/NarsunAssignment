<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use Session;
use File;


class DevicesController extends Controller
{
    public function index() {
    	$devices = Device::all();
    	return view('devices/index', compact('devices'));
    }

    public function addDevice(Request $request) {

    	$uploadName = "";
    	if($request->hasFile('image')) {
    		$image = $request->file('image');
    		$extension = $image->getClientOriginalExtension();
            $uploadNameWithoutExt = date('Ymd-His');
            $uploadName = date('Ymd-His').'.'.$extension;

            $path = public_path('device_images');
            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $image->move($path, $uploadName);
    	}
        $params = [
            'name' => $request->name,
            'image' => $uploadName,
            'warranty' => $request->warranty,
            'expiry' => $request->expiry,
            'cost' => $request->cost
        ];
        Device::create($params);
        Session::put('success', 'Device created successfully.');
        return redirect('devices');
    }

    public function deleteDevice(Request $request) {

    }

    public function editDevice(Request $request, $deviceId ) {

    	$uploadName = "";
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $uploadNameWithoutExt = date('Ymd-His');
            $uploadName = date('Ymd-His').'.'.$extension;

            $path = public_path('device_images');
            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $image->move($path, $uploadName);
        }
    	$params = [
            'name' => $request->name,
            'image' => $uploadName,
            'warranty' => $request->warranty,
            'expiry' => $request->expiry,
            'cost' => $request->cost
        ];
        Device::where('id', $deviceId)->update($params);
        Session::put('success', 'Device updated successfully.');
        return redirect('devices');
    }

    public function getAssignedUsersDevices() {
        $devices = Device::where('user_id', '!=', 0)->with('user')->get();
        if($devices->count()) {
            $output = [
                'status' => true,
                'data' => $devices
            ];
        } else {
            $output = [
                'status' => false,
                'message' => 'No data found.'
            ];
        }
        return response()->json($output);
    }
}
