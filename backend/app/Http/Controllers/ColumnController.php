<?php

namespace App\Http\Controllers;

use App\Http\Requests\Column\StoreRequest;
use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;



/**
     * 
     * 
     * 
     * 
     * since it is not a big project, using resource collection and services would not be needed
     * 
     * 
*/

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Column::with('cards')->get();
        return $this->retrievedResponse($cards); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = Arr::only($request->validated(), 'title');
            Column::create($data);
            return $this->createdResponse();
            
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
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
        $column = Column::findorFail($id);
        $column->destroy();
        return $this->deletedResponse();
    }
}
