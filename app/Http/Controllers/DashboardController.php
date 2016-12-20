<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Log;

class DashboardController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index', ['user' => Auth::user()]);
    }

    public function environment()
    {
        return view('dashboard.environment', ['user' => Auth::user()]);
    }

    public function setEnvironment(Request $request)
    {
        Log::alert($request->all());
        // Validation
        $this->validate($request, [
                'temp_max' => 'required|numeric|min:'.$request->temp_min,
                'temp_min' => 'required|numeric',
                'pH_max' => 'required|numeric|min:'.$request->pH_min,
                'pH_min' => 'required|numeric',
//                'period' => 'required|numeric|min:0',
            ],
            [
                'temp_max.min' => '溫度上限 不能低於 :min',
                'pH_max.min' => 'PH上限 不能低於 :min',
                'numeric' => '此欄位必須為數字',
                'required' => '此欄位必須填寫',
                'period.min' => '週期需大於0',
            ]
        );
        $user = Auth::user();
        $user->temp_max = $request->temp_max;
        $user->temp_min = $request->temp_min;
        $user->pH_max = $request->pH_max;
        $user->pH_min = $request->pH_min;

        if ($user->save()) {
            return redirect()->route('environment')->with('success', '儲存成功');
        }
        return redirect()->route('environment')->with('error', '儲存失敗');
    }

    public function getEnvironment(Request $request)
    {
        $user = Auth::user();
        $environment = $user->environments->where('temp', '!=', null)->where('pH', '!=', null)->sortByDesc('datetime')->first();

        $json = [
            'light' => is_null($environment) ? 'NaN' : $environment->light,
            'tmp' => is_null($environment) ? 'NaN' : $environment->temp,
            'ph' => is_null($environment) ? 'NaN' : $environment->pH,
            'tmp_max' => $user->temp_max,
            'tmp_min' => $user->temp_min,
            'ph_max' => $user->pH_max,
            'ph_min' => $user->pH_min,
            'period' => $user->period,
        ];

        return response()->json($json);
    }

    public function changeStatus(Request $request)
    {
        $user = Auth::user();
        if ($request->status == 'true') {
            $user->status = 1;
        } else {
            $user->status = 0;
        }
        $result = $user->save();
        return response()->json(['result' => $result]);
    }
}
