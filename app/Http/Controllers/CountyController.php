<?php

namespace App\Http\Controllers;

use App\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $counties = County::all();
            $data = $counties;
            $message = 'Counties fetched successfully';
        }catch (\Exception $e){
            $data = [];
            $message='An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request = $request->all();
            $data = County::create($request);
            $message ='County created successfully';
        }catch (\Exception $e){
            $data=[];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return  response()->json(['data'=>$data,'message'=>$message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $county = County::find($id);
            $request = $request->all();
            $county->update($request);
            $data = $county;
            $message = 'County updated successfully';
        }catch (\Exception $e){
            $data =[];
            $message= 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $county = County::find($id);
            $county->delete();
            $data = $id;
            $message= 'County deleted successfully';

        }catch (\Exception $e){
            $data=[];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
}
