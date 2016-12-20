<?php

namespace App\Http\Controllers;

use App\Environment;
use App\Picture;
use App\Farm;
use App\Contact;
use App\User;
use Illuminate\Http\Request;
use Storage;
use Log;
use DB;

class UploadController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin')->except('seed');
    }

    public function index($userId)
    {
        // $env = Environment::whereRaw("ndvi IS NOT NULL AND datetime > '2016-12-07 00:00:00' AND datetime <= '2016-12-09 06:00:00'")->orderBy('datetime', 'desc')->get()->toArray();
        // foreach ($env as $key => $ee) {
        //     $nd = new Environment();
        //     $nd->user_id = 1;
        //     $nd->ndvi = $ee['ndvi'];
        //     $nd->datetime = date('Y-m-d H:i:s', strtotime($ee['datetime']) + 60*60*24*5);
        //     $nd->save();
        // }
        // dd('ok');

        $files = Storage::disk('public')->files('uploads/'.$userId);
        dd($files);
    }

    public function picture()
    {
        $env = Picture::orderBy('datetime', 'desc')->get()->unique('datetime');
        return response()->json($env);
    }

    public function env($all = '')
    {
        if ($all == 'show') {
            $env = Environment::orderBy('datetime', 'desc')->take(24)->get()->toArray();
            dd($env);
        } else if ($all == 'all') {
            $env = Environment::orderBy('datetime', 'desc')->get()->unique('datetime')->toJson();
            Storage::disk('public')->put('all.env', $env);
            return response()->download('./' . Storage::disk('public')->url('all.env'));
        } else if ($all == 'json') {
            $env = Environment::orderBy('datetime', 'desc')->get()->unique('datetime');
            return response()->json($env);
        } else {
            $env = Environment::orderBy('datetime', 'desc')->get()->unique('datetime')->take(24)->toJson();
            $datetime = date('Y_m_d-H_i_s');
            Storage::disk('public')->put($datetime . '.env', $env);
            return response()->download('./' . Storage::disk('public')->url($datetime . '.env'));
        }
    }

    public function farm()
    {
        $env = Farm::all();
        return response()->json($env);
    }

    public function contact()
    {
        $env = Contact::all();
        return response()->json($env);
    }

    public function user()
    {
        $env = User::all();
        return response()->json($env);
    }

    public function seed($what = '')
    {
        try {
            $start = time();

            if ($what === 'farm' || $what === 'contact' || $what === 'user') {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => env('API_HOST') . "/" . $what,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                  CURLOPT_HTTPHEADER => array(
                    "api-key: " . env('API_KEY'),
                    "cache-control: no-cache",
                    "postman-token: a0d3f9a4-3434-85e6-922f-5c947a565486"
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                  echo "cURL Error #:" . $err;
                } else {
                    $env = null;
                    if ($what === 'farm') {
                        Farm::where('id', '>', '0')->delete();
                        $env = new Farm();
                    } else if ($what === 'contact') {
                        Contact::where('id', '>', '0')->delete();
                        $env = new Contact();
                    } else if ($what === 'user') {
                        User::where('id', '>', '0')->delete();
                        $env = new User();
                    }

                    foreach (json_decode($response, true) as $key => $value) {
                        $env->create($value);
                        usleep(1);
                    }
                }
            } else {
                return response('false');
            }

            $end = time();
            return response('true, excursion: ' . ($end-$start) . ' seconds');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function seedEnv($how)
    {
        try {
        $start = time();

        if ($how == 'all') {
            if (Storage::disk('public')->exists('all.env')) {
                Environment::where('id', '>', '0')->delete();
                $data = Storage::disk('public')->get('all.env');
                $data = collect(json_decode($data, true));
                foreach ($data->toArray() as $env) {
                    $environment = new Environment();
                    $environment->user_id = $env['user_id'];
                    $environment->datetime = $env['datetime'];
                    $environment->temp = $env['temp'];
                    $environment->pH = $env['pH'];
                    $environment->light = $env['light'];
                    $environment->water = $env['water'];
                    $environment->ndvi = $env['ndvi'];
                    $environment->created_at = $env['created_at'];
                    $environment->updated_at = $env['updated_at'];
                    $environment->save();
                    usleep(5);
                }
            } else {
                return response('all.env is not existed.');
            }
        } if($how == 'curl') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => env('API_HOST') . "/env",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "api-key: " . env('API_KEY'),
                "cache-control: no-cache",
                "postman-token: f60035af-707d-ad38-f7c0-97523450d3c8"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              return "cURL Error #:" . $err;
            } else {
                Environment::where('id', '>', '0')->delete();
                $env = new Environment();
                foreach (json_decode($response, true) as $key => $value) {
                    $env->create($value);
                    usleep(1);
                }
            }
        }
        //  else {
        //     $files = Storage::disk('public')->files();
        //     $envs = collect([]);
        //     foreach ($files as $file) {
        //         if (str_contains($file, '.env') && !starts_with($file, 'all')) {
        //             $json = Storage::disk('public')->get($file);
        //             $data = json_decode($json, true);
        //             foreach ($data as $env) {
        //                 $envs->push($env);
        //             }
        //         }
        //     }

        //     foreach ($envs->unique('datetime')->toArray() as $env) {
        //         $environment = new Environment();
        //         $environment->user_id = $env['user_id'];
        //         $environment->datetime = $env['datetime'];
        //         isset($env['temp']) ? $environment->temp = $env['temp'] : 0;
        //         isset($env['pH']) ? $environment->pH = $env['pH'] : 0;
        //         isset($env['light']) ? $environment->light = $env['light'] : 0;
        //         isset($env['water']) ? $environment->water = $env['water'] : 0;
        //         isset($env['ndvi']) ? $environment->ndvi = $env['ndvi'] : 0;
        //         isset($env['created_at']) ? $environment->created_at = $env['created_at'] : 0;
        //         isset($env['updated_at']) ? $environment->updated_at = $env['updated_at'] : 0;
        //         $environment->save();
        //         usleep(5);
        //     }
        // }

        $end = time();

        return response('ok, excursion: ' . ($end - $start) . ' seconds');
        }catch (\Exception $e) {
            dd($e);
        }
    }

    public function seedPicture($how, $userId)
    {
        try {
            $start = time();

            DB::beginTransaction();
            if($how == 'all') {
                if (Storage::disk('public')->has("seed/$userId")) {
                    $pictures = Storage::disk('public')->files('seed/'.$userId);
                    // dd($pictures);
                    $num = 0;
                    foreach ($pictures as $index => $picture) {
                        $filename = str_replace("seed/$userId/", '', $picture);
                        $datetime = str_replace(".jpg", "", $filename);
                        $time = explode("-", $datetime);
                        $first_time = str_replace('_', '-', $time[0]);
                        $last_time = str_replace('_', ':', $time[1]);
                        $datetime = $first_time . " " . $last_time;

                        if (Storage::disk('public')->has("uploads/$userId/$filename")) {
                            continue;
                        }

                        Storage::disk('public')->copy($picture, "uploads/$userId/$filename");
                        $pic = new Picture();
                        $pic->datetime = $datetime;
                        $pic->filename = $filename;
                        $pic->photo = base64_encode(Storage::disk('public')->get($picture));
                        $pic->user_id = $userId;
                        if (!$pic->save()) {
                            return response('false');
                        }
                        usleep(5);
                        if ($num++ > 20) {
                            break;
                        }
                    }
                } else {
                    DB::rollBack();
                    return response("UserId => $userId 的資料夾不存在");
                }
            } elseif ($how == 'curl') {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => env('API_HOST') . "/picture",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                  CURLOPT_HTTPHEADER => array(
                    "api-key: " . env('API_KEY'),
                    "cache-control: no-cache",
                    "postman-token: fcf3bfb0-d910-fc10-5b11-1498284cdb5b"
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                  return "cURL Error #:" . $err;
                } else {
                    Picture::where('id', '>', '0')->delete();
                    $picture = new Picture();
                    Log::alert($response);
                    foreach (json_decode($response, true) as $key => $value) {
                        $picture->create($value);
                        usleep(1);
                    }
                }
            }

            DB::commit();
            $end = time();
            return response('true, excursion: ' . ($end-$start) . ' seconds');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function editFarm(Farm $farm)
    {
        return view('editFarm', ['farm' => $farm]);
    }

    public function saveFarm(Request $request, Farm $farm)
    {
        $farm->user_id = $request->input('user_id');
        $farm->plant_id = $request->input('plant_id');
        $farm->plantname = $request->input('plantname');
        $farm->startdate = $request->input('startdate');
        if ($request->has('enddate')) {
            $farm->enddate = $request->input('enddate');
        }
        
        if(!$farm->save()) {
            return response('error');
        }
        return response('ok');
    }

    public function deleteFarm() {
        $data['plants'] = Farm::all();
        return view('deleteFarm', $data);
    }

    public function destroyFarm(Request $request) {
        $farm = Farm::find($request->plant);
        if ($farm->delete()) {
            return response('ok');
        } else {
            return response('not ok');
        }
    }
}
