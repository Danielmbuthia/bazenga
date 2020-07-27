<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $hospitals = Hospital::all();
            return response()->json(['data'=>$hospitals,'message'=>'Hospitals fetched']);
        }catch (\Exception $e){
            return response()->json(['data'=>[],'message'=>'An error occurred try later '.$e->getMessage()]);
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request = $request->all();
           $data = Hospital::create($request);
            $message ='Hospital created successfully';
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
            $hospital = Hospital::find($id);
            $request = $request->all();
            $hospital->update($request);
            $data = $hospital;
            $message = 'Hospital updated successfully';
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
            $hospital = Hospital::find($id);
            $hospital->delete();
            $data = $id;
            $message= 'Hospital deleted successfully';

        }catch (\Exception $e){
            $data=[];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }

    public function getBranches($id){
        try {
            $hospital = Hospital::find($id);
            $data = Branch::whereIn('hospital_id',$id)->get();
            $message = 'Branches of '.$hospital['name']. ' fetched successfully';
        }catch (\Exception $exception){
            $data = [];
            $message='An error occurred try later';
        }

        return response()->json(['data'=>$data,'message'=>$message]);
    }
    public function editBranch(Request $request,$id){
        try {
            $branch = Branch::find($id);
            $request = $request->all();
            $branch->update($request);
            $data = $branch;
            $message = 'Branch data updated successfully';
        }catch (\Exception $e){
            $data=[];
            $message = 'An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
    public function deleteBranch($id){
        try {
             $branch = Branch::find($id);
             $branch->delete();
             $data = $id;
             $message='Branch deleted successfully';
        }catch (\Exception $e){
           $data=[];
           $message = 'An error occurred try later';
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
    public function createBranch(Request $request){
        try {
            $request=$request->all();
            $hospital = Branch::create($request);
            $data = $hospital;
            $message = 'Branch created successfully';
        }catch (\Exception $e){
            $data=[];
            $message='An error occurred try later '.$e->getMessage();
        }
        return response()->json(['data'=>$data,'message'=>$message]);
    }
}
