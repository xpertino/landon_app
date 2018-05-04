<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client;

class ClientController extends Controller
{
    //
    public function __construct( Title $titles )
    {
        $this->titles = $titles->all();
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
        $data = [];

        $data['clients'] = Client::all();

        return view('client/index', $data);
    }

    public function export()
    {
        $data = [];

        $data['clients'] = Client::all();

        header('Content-Disposition: attachment; filename=export.xls');
        return view('client/export', $data);
    }

    public function newClient(Request $request)
    {
        $data['title'] = $request->title;
        $data['name'] = $request->name;
        $data['last_name'] = $request->last_name;
        $data['address'] = $request->address;
        $data['zip_code'] = $request->zip_code;
        $data['city'] = $request->city;
        $data['state'] = $request->state;
        $data['email'] = $request->email;

        

        if ( $request->isMethod('post') ) {
            //dd($data);
            $this->validate($request,[
                'name' => 'required|min:5',
                'last_name' => 'required',
                'address' => 'required',
                'zip_code' => 'required',
                'city' => 'required',
                'state' => 'required',
                'email' => 'required',
            ]);

            $client = Client::insert($data);

            return redirect('clients');
            
        }

        $data['titles'] = $this->titles;
        $data['modify'] = 0;

        return view('client/form', $data);
    }

    public function create()
    {
        return view('client/create');
    }

    public function show(Request $request, $client_id)
    {
        $data['title'] = $request->title;
        $data['name'] = $request->name;
        $data['last_name'] = $request->last_name;
        $data['address'] = $request->address;
        $data['zip_code'] = $request->zip_code;
        $data['city'] = $request->city;
        $data['state'] = $request->state;
        $data['email'] = $request->email;

        $data['client'] = Client::find($client_id);
        $data['client_id'] = $client_id;

        if ( $request->isMethod('post') ) {
            //dd($data);
            $this->validate($request,[
                'name' => 'required|min:5',
                'last_name' => 'required',
                'address' => 'required',
                'zip_code' => 'required',
                'city' => 'required',
                'state' => 'required',
                'email' => 'required',
            ]);

            $data['client']->update($data);

            return redirect('clients');
            
        }
        
        $data['titles'] = $this->titles;
        $data['modify'] = 1;

        $request->session()->put(
            'last_updated',
            $request->name . ' ' . $request->last_name
        );

        return view('client/form', $data);
    }
}
