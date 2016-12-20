<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Environment;
use App\User;
use App\Farm;
use App\Plant;
use App\Picture;
use DB;
use Log;
use Auth;
use Storage;
use Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DataController extends Controller
{
    public function deleteUpload()
    {
        try {
            $directories = Storage::disk('public')->directories();
            foreach ($directories as $directory) {
                Storage::disk('public')->deleteDirectory($directory);
            }

            $pictures = Picture::all();
            foreach ($pictures as $picture) {
                $picture->delete();
            }

            return response('true');

        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * store the upload picture and record to the database for picture
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function upload(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
               'file' => 'required',
               'file.*' => 'required|file|image|max:5000',
            ], [
                'required' => ':attribute 該欄位必須填',
                'file' => ':attribute 其中有一個或以上不是檔案',
                'image' => ':attribute 其中有一個或以上的檔案不是圖片格式',
                'max' => ':attribute 不能超過 5MB'
            ]);

           if ($validator->fails()) {
                $messages = '';
                foreach ($validator->errors()->all() as $key => $value) {
                    $messages .= "$value\n";
                }
               return response($messages);
           }

            $files = $request->file('file');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $datetime = str_replace(".jpg", "", $filename);
                $time = explode("-", $datetime);
                $first_time = str_replace('_', '-', $time[0]);
                $last_time = str_replace('_', ':', $time[1]);
                $datetime = $first_time . " " . $last_time;

                $path = $file->storeAs('uploads/'.$request->input('user_id', 1), $filename, 'public');
                $picture = new Picture();
                $picture->datetime = $datetime;
                $picture->filename = $filename;
                $picture->photo = base64_encode(Storage::disk('public')->get($path));
                $picture->user_id = $request->input('user_id', 1);
                if (!$picture->save()) {
                    DB::rollBack();
                    return response('false');
                }
            }

            DB::commit();
            return response('true');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * For Pi to insert Environment Data
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function insertData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'datetime' => 'required|date',
            ], [
                'integer' => ':attibute Need to be Integer',
                'required' => ':attribute Required',
                'date' => ':attribute Need to be Data Format',
            ]);

            if ($validator->fails()) {
                return response($validator->messages());
            }

            $data = new Environment;
            $data->user_id = $request->input('user_id', '0');
            $data->datetime = $request->input('datetime');
            $data->temp = $request->input('temp', null);
            $data->water = $request->input('water', null);
            $data->pH = $request->input('pH', null);
            $data->light = $request->input('light', null);
            $data->ndvi = $request->input('ndvi', null);

            $result = $data->save();

            if ($result < 1) {
                return response('false');
            }

            $data = [];
            $data['user_id'] = $request->input('user_id');
            $data['datetime'] = $request->input('datetime');
            $data['temp'] = $request->input('temp', null);
            $data['water'] = $request->input('water', null);
            $data['pH'] = $request->input('pH', null);
            $data['light'] = $request->input('light', null);
            $data['ndvi'] = $request->input('ndvi', null);
            
            $field = http_build_query($data);

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => env('API_HOST') . "/env",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $field,
              CURLOPT_HTTPHEADER => array(
                "api-key: ". env('API_KEY'),
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: 0bc3ee66-44e9-d133-d67f-10b3c400026a"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            return response('true');
        } catch (\Exception $e) {
            return response('false');
        }
    }

    /**
     * For Pi to get user's environment setting
     * @param $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getWarn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response('請輸入正確的User ID');
        }

        try {
            $user = User::find($request->input('id'));
            $data = $user->toArray();
            
            $farm = $user->farms->where('enddate', null)->sortBy('updated_at')->pop();

            if (!is_null($farm) && $farm->plant_id != 0) {
                $plant = $farm->plant;
                $data['temp_max'] = $plant->temp_max;
                $data['temp_min'] = $plant->temp_min;
                $data['pH_max'] = $plant->pH_max;
                $data['pH_min'] = $plant->pH_min;
            }

            return response()->json($data);
        } catch (\Exception $e) {
            return response('沒有此使用者ID');
        }
    }

    public function addPlant(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!Auth::check()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => '請先登入',
                ]);
            }

            $plant = Plant::find($request->input('plantId'));

            if (is_null($plant)) {
                return response()->json([
                    'result' => 'error',
                    'msg' => '植物不存在',
                ]);
            }

            if (strtotime($request->input('startDate')) == false) {
                return response()->json([
                    'result' => 'error',
                    'msg' => '時間格式錯誤',
                ]);
            }

            $myPlant = new Farm;
            $myPlant->plant_id = $plant->id;
            $myPlant->user_id = Auth::user()->id;
            $myPlant->plantname = $plant->chi_name;
            $myPlant->startdate = $request->input('startDate');

            if (!$myPlant->save()) {
                DB::rollback();
                return response()->json([
                    'result' => 'error',
                    'msg' => '新增植物失敗',
                ]);
            }
        } catch (\PDOException $e) {
            DB::rollback();
            return response()->json([
                'result' => 'error',
                'msg' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'result' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }

        DB::commit();
        return response()->json([
            'result' => 'ok',
            'msg' => '新增植物成功'
        ]);
    }

    public function addOtherPlant(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!Auth::check()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => '請先登入',
                ]);
            }

            if (strtotime($request->input('startDate')) == false) {
                return response()->json([
                    'result' => 'error',
                    'msg' => '時間格式錯誤',
                ]);
            }

            $myPlant = new Farm;
            $myPlant->plant_id = 0;
            $myPlant->user_id = Auth::user()->id;
            $myPlant->plantname = $request->input('plantName');
            $myPlant->startdate = $request->input('startDate');


            if (!$myPlant->save()) {
                DB::rollback();
                return response()->json([
                    'result' => 'error',
                    'msg' => '新增植物失敗',
                ]);
            }
        } catch (\PDOException $e) {
            DB::rollback();
            return response()->json([
                'result' => 'error',
                'msg' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'result' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }

        DB::commit();
        return response()->json([
            'result' => 'ok',
            'msg' => '新增植物成功'
        ]);
    }

    public function endPlant(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!Auth::check()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => '請先登入',
                ]);
            }

            $myPlant = Farm::find($request->input('myPlantId'));

            if (strtotime($request->input('endDate')) == false) {
                return response()->json([
                    'result' => 'error',
                    'msg' => '時間格式錯誤',
                ]);
            }

            if (is_null($myPlant)) {
                return response()->json([
                    'result' => 'error',
                    'msg' => '植物不存在',
                ]);
            }

            $myPlant->enddate = $request->input('endDate');

            if (!$myPlant->save()) {
                DB::rollback();
                return response()->json([
                    'result' => 'error',
                    'msg' => '加入結束時間失敗',
                ]);
            }
        } catch (\PDOException $e) {
            DB::rollback();
            return response()->json([
                'result' => 'error',
                'msg' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'result' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }

        DB::commit();
        return response()->json([
            'result' => 'ok',
            'msg' => '加入結束時間成功'
        ]);
    }

    public function getEnvData(Request $request)
    {
        // if($request->share == '1') {
        //     $required = 'required|';
        //     $user_id = $request->user_id;
        // } else {
        //     if(!Auth::check())
        //     {
        //         return response()->json([
        //             'result' => 'error',
        //             'msg' => Auth::user() .'尚未登入'.$request->share,
        //         ]);
        //     }
        //     $user_id = Auth::user()->id;
        // }


        $validator = Validator::make($request->all(), [
            'plant_id' => 'required|exists:farms,id',
            'period' => 'required|in:24,30',
            'env' => 'required|in:pH,temp,light,water,ndvi',
            'user' => 'required|exists:users,id',
        ], [
            'required' => ':attribute 是必填欄位',
            'in' => ':attribute 只能是以下之一: :values',
            'exists' => ':attribute 不存在'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'result' => 'error',
                'msg' => $validator->messages(),
            ]);
        }


        $time = $this->getTime($request->period);


        if ($request->period == '24') {
            $temp = Environment::where('user_id', $request->user)->where('datetime', '>=', $time)->get();
        } else {
            $farm = Farm::find($request->plant_id);
//            $farm = Farm::where('user_id', $request->user)->where('plant_id', $request->plant_id)->first();
            $endDate = is_null($farm->enddate) ? date('Y-m-d H:i:s', date('U') + 60*60*24) : date('Y-m-d H:i:s', strtotime($farm->enddate) + 1);
            $temp = Environment::where('user_id', $request->user)
                ->where('datetime', '>=', $farm->startdate)
                ->where('datetime', '<', $endDate)
                ->get();
        }

        $temp = $temp->unique('datetime')->sortBy('datetime');


        $env = $request->env;

        $proc = [];
        $farm = Farm::find($request->plant_id);
        $plant = Plant::find($farm->plant_id);
        $plantname = '';
        if ($request->plant_id == '0') {
            $proc = $this->onlyGetEnv($temp, $env, $time);
//            $farm = Farm::where('user_id', $request->user)->where('plant_id', $request->plant_id)->first();
            $plantname = $farm->plantname;
        } else {
            $proc = $this->recollectData($plant, $temp, $env, $time);
            $plantname = $farm->plantname;
        }


        $result = [
            'result' => 'ok',
            'ret' => $proc,
            'plantname' => $plantname,
        ];

        return response()->json($result);
    }

    protected function recollectData($plant, $temp, $env, $time)
    {
        $proc = [];
        switch ($env) {
            case 'pH':
            case 'temp':
                foreach ($temp as $tt) {
                    if (!is_null($tt[$env])) {
                        $proc[] = [
                            'date' => $tt->datetime,
                            'max' => $plant[$env . '_max'],
                            'min' => $plant[$env . '_min'],
                            'record' => $tt[$env],
                        ];
                    }
                }

                if (count($proc) == 0) {
                    $proc[] = [
                        'date' => $time,
                        'max' => $plant[$env . '_max'],
                        'min' => $plant[$env . '_min'],
                    ];
                }
                break;

            case 'light':
            case 'water':
            case 'ndvi':
                foreach ($temp as $tt) {
                    if (!is_null($tt[$env])) {
                        $proc[] = [
                            'date' => $tt->datetime,
                            'record' => $tt[$env],
                        ];
                    }
                }
                if (count($proc) == 0) {
                    $proc[] = [
                        'date' => $time,
                    ];
                }
                break;
        }

        return $proc;
    }

    protected function onlyGetEnv($temp, $env, $time)
    {
        $proc = [];
        switch ($env) {
            case 'pH':
            case 'temp':
            case 'light':
            case 'water':
            case 'ndvi':
                foreach ($temp as $tt) {
                    if (!is_null($tt[$env])) {
                        $proc[] = [
                            'date' => $tt->datetime,
                            'record' => $tt[$env],
                        ];
                    }
                }
                if (count($proc) == 0) {
                    $proc[] = [
                        'date' => $time,
                    ];
                }
                break;
        }

        return $proc;
    }

    protected function getTime($period)
    {
        switch ($period) {
            case '24':
                $period = time() - 60 * 60 * 24;
                $time = date('Y-m-d H:i:s', $period);
                break;
            case '30':
                $period = time() - 60 * 60 * 24 * 30;
                $time = date('Y-m-d H:i:s', $period);
                break;
        }

        return $time;
    }
}
