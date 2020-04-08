<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Session;

class SettingsController extends Controller
{
    public function index() {
    	$settings = Setting::all();
    	return view('settings/index', compact('settings'));
    }

    public function addSetting(Request $request) {
        $params = [
            'setting1' => $request->setting1,
            'setting2' => $request->setting2,
            'setting3' => $request->setting3,
            'setting4' => $request->setting4
        ];
        Setting::create($params);
        Session::put('success', 'Setting created successfully.');
        return redirect('settings');
    }

    public function editSetting(Request $request, $settingId) {
    	$params = [
            'setting1' => $request->setting1,
            'setting2' => $request->setting2,
            'setting3' => $request->setting3,
            'setting4' => $request->setting4
        ];
        Setting::where('id', $settingId)->update($params);
        Session::put('success', 'Setting updated successfully.');
        return redirect('settings');
    }
}
