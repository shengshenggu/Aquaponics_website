<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plant;
use App\Farm;
use App\Contact;
use App\Picture;
use DB;
use Log;
use Auth;
use Storage;
use Validator;

class PlantController extends Controller
{
    /**
     * Home Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('plant.unika');
    }

    /**
     * Plant Library
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function library()
    {
        $data['plants'] = Plant::all();
        return view('plant.library', $data);
    }

    /**
     * Display Own Plant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function myPlant()
    {
        if (!Auth::check()) {
            return redirect('login')->with('warning', 'Please Login ! ');
        }

        $user = Auth::user();
        $data['pictures'] = [];
        $pictures = Picture::orderBy('datetime', 'desc')->take(20)->get();
        foreach ($pictures as $picture) {
            $filePath = 'uploads/'.$user->id.'/'.$picture->filename;
            $exist = Storage::disk('public')->has($filePath);
            if (!$exist) {
                $img = base64_decode($picture->photo);
                Storage::disk('public')->put($filePath, $img);
            }
            $data['pictures'][$picture->datetime] = Storage::disk('public')->url($filePath);
        }

        $data['myPlants'] = $user->farms;

        return view('plant.my_plant', $data);
    }

    /**
     * Display Analysis AmChart
     * @param null $plant
     * @param null $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showData($plant = null, $user = null)
    {
        $data['environments'] = json_encode([
            'pH' => 'p.H值',
            'temp' => 'Temperature',
            'light' => 'Light',
            'ndvi' => 'NDVI'
        ]);

        $data['plants'] = [];
        $data['share'] = '0';

        if (is_null($plant) && is_null($user)) {
            if (Auth::check()) {
                $data['plants'] = Auth::user()->farms;
            } else {
                return redirect('login')->with('warning', 'Please Login ! ');
            }
        } else if (!is_null($plant) && !is_null($user)) {
            $data['share'] = '1';
            $user = Farm::where('user_id', $user)->where('plant_id', $plant)->first();
            if (is_null($user)) {
                return redirect('share/' . $plant);
            }

            $data['user'] = $user->user;
            $data['plants'] = $user->where('plant_id', $plant)->get();
        }

        // dd($data);
        return view('plant.vue_data', $data);
    }

    /**
     * Display Share Plant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function share()
    {
        return view('plant.share');
    }

    /**
     * Display Share User
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function share_user($id)
    {
        $plant = Plant::find($id);

        if (is_null($plant)) {
            return redirect('share')->with('error', '不存在植物');
        }

        $data['plant'] = $plant;
        return view('plant.share_user', $data);
    }

    /**
     * Process Contact Information
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function contact(Request $request)
    {
        $input = array_only($request->all(), ['name', 'email', 'message']);
        $input['company'] = $request->input('subject', '');
        $contact = new Contact();
        foreach ($input as $key => $value) {
            $contact[$key] = $value;
        }
        if (!$contact->save()) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Sorry, there\'s a problem with our system. Please try again.',
            ]);
        }

        $text = "[通知] " . date('Y-m-d H:i:s') . "\n";
        $text .= $input['name'] . " 發送了訊息給我們\n";
        $text .= "主旨: " . $input['company'] . "\n";
        $text .= "內容: \n\t" . $input['message'] . "\n\n";
        $text .= "可以回覆訊息到: " . $input['email'] . "\n";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.telegram.org/bot290989005:AAHE_wvR0CTmqqdL-rm8WFxOYMwYpA8TQcU/sendMessage?chat_id=-1001096183268&text=".urlencode($text),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return response()->json([
            'result' => 'ok',
            'msg' => 'OK, We will contact you. Thank you!',
        ]);

        // $input = $request->only('name', 'company', 'phone', 'email', 'message');

        // if (count($request->all())) {
        //     $this->validate($request, [
        //         'name' => 'required|string',
        //         'email' => 'required|email',
        //         'message' => 'required',
        //     ], [
        //         'required' => ':attribute 為必填',
        //         'email' => ':attribute 須為Email格式'
        //     ]);

        //     DB::beginTransaction();
        //     try {
        //         $contact = new Contact();
        //         foreach ($input as $key => $value) {
        //             $contact[$key] = $value;
        //         }
        //         if (!$contact->save()) {
        //             throw new \Exception();
        //         }
        //     } catch (\Exception $e) {
        //         DB::rollBack();
        //         return redirect('contact')->with('success', '新增聯絡資訊失敗');
        //     }
        //     DB::commit();
        //     return redirect('contact')->with('success', '新增聯絡資訊成功');
        // }

        // return view('plant.contact');
    }
}
