<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = DB::table('customers')->orderBy('id', 'DESC')->get();

        return response()->json($customer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees|max:255',
            'phone' => 'required|unique:employees',
        ]);

        if ($request->photo) {
            $position   = strpos($request->photo, ';');
            $sub        = substr($request->photo, 0, $position);
            $ext        = explode('/', $sub)[1];

            $name           = time() . "." . $ext;
            $img            = Image::make($request->photo)->resize(240, 200);
            $upload_path    = 'backend/customer/';
            $image_url      = $upload_path . $name;

            $img->save($image_url);

            $customer               = new Customer;
            $customer->name         = $request->name;
            $customer->email        = $request->email;
            $customer->phone        = $request->phone;
            $customer->address      = $request->address;
            $customer->photo        = $image_url;
            $customer->save();
        } else {
            $customer               = new Customer;
            $customer->name         = $request->name;
            $customer->email        = $request->email;
            $customer->phone        = $request->phone;
            $customer->address      = $request->address;
            $customer->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();

        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data                   = array();
        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['phone']          = $request->phone;
        $data['address']        = $request->address;
        $image                  = $request->newphoto;

        if ($image) {
            $position   = strpos($image, ';');
            $sub        = substr($image, 0, $position);
            $ext        = explode('/', $sub)[1];

            $name           = time() . "." . $ext;
            $img            = Image::make($image)->resize(240, 200);
            $upload_path    = 'backend/customer/';
            $image_url      = $upload_path . $name;

            $success        = $img->save($image_url);

            if ($success) {
                $data['photo']  = $image_url;
                $img            = DB::table('customers')->where('id', $id)->first();
                $image_path     = $img->photo;
                $done           = unlink($image_path);
                $user           = DB::table('customers')->where('id', $id)->update($data);
            }
        } else {
            $oldPhoto       = $request->photo;
            $data['photo']  = $oldPhoto;
            $user           = DB::table('customers')->where('id', $id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee   = DB::table('customers')->where('id', $id)->first();
        $photo      = $employee->photo;

        if ($photo) {
            unlink($photo);
            DB::table('customers')->where('id', $id)->delete();
        } else {
            DB::table('customers')->where('id', $id)->delete();
        }
    }
}
