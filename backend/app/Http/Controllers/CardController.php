<?php

namespace App\Http\Controllers;

use App\Http\Requests\Card\StoreRequest;
use App\Http\Requests\Card\UpdateRequest;
use App\Models\Card;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('listCards');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::all();
        return $this->retrievedResponse($cards);
    }


    /**
     * Display a listing of the resource.
     *
     * @param  String access_token
     * optional @param created_at,status
     * @return \Illuminate\Http\Response
     */
    public function listCards(Request $request)
    {
        $date = $request->input('date');
        $status = $request->input('status');
        
        $query = Card::query();
        if ($date) {
            $query->whereDate('created_at', $date);
        }
        if ($status !== null) {
            $query->where('status', $status);
        }
        $cards = $query->get();
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
            $data = Arr::only($request->validated(), ['title','column_id','description']);
            Card::create($data);
            return $this->createdResponse();
            
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        $id = $request->id;
        $card = Card::findOrFail($id);

        try {
            $data = Arr::only($request->validated(), ['title','description']);
            $card->update($data);
            return $this->updatedResponse($card);
            
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }
    }

    /**
     * Set status of the specified resource to 0.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $card = Card::findOrFail($id);
        $card->status = '0';
        $card->deleted_at = Carbon::now()->toDateTimeString();
        $card->save();

        return $this->successResponse("Card deleted successfully");
    }
}
