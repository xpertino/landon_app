<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContentsController extends Controller
{
    //
    public function home(Request $request)
    {
        $data['version'] = '0.1.2';
        $last_updated = $request->session()->has('last_updated') ? $request->session()->pull('last_updated') : 'none';
        $data['last_updated'] = $last_updated;

        return view('contents/home', $data);
    }

    public function upload(Request $request)
    {
        $data['version'] = '0.1.2';

        if($request->isMethod('post')) {
            $this->validate(
                $request,
                [
                    'image_upload' => 'mimes:jpeg,jpg,png'
                ]
            );
            Input::file('image_upload')->move('images', 'attractions.jpg');
            return redirect('/');
        }

        return view('contents/upload', $data);
    }
}
