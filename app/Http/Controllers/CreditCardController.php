<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditCard;
use Auth;

/**
 * @Resource("CreditCard", uri="/credit-cards" )
 */
class CreditCardController extends Controller
{

    /**
     * List of CreditCards
     *
     * @Get("/")
     * 
     * @Transaction({
     *      @Request({}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"credit_card":{"id":1,"user_id":"15","name":null,"month":"11","year":"2018","card_number":"4242-4242-4242-4242","cvc":"123"}})
     * })
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $credit_card = CreditCard::where('user_id', '=', $user->id)->first();
        return $credit_card;
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
     * Add/Edit CreditCard
     * 
     * @Post("/")
     * 
     * @Parameters({
     *      @Parameter("month", type="integer", required=true),
     *      @Parameter("year", type="integer", required=true),
     *      @Parameter("card_number", required=true),
     *      @Parameter("cvc", type="integer", required=true),
     *      @Parameter("name"),
     * })
     * @Transaction({
     *      @Request({"month": "11", "year": "2018", "card_number": "4242-4242-4242-4242", "cvc": 123}, headers={"Authorization": "Bearer {token}"}),
     *      @Response(200, body={"credit_card":{"id":1,"user_id":"15","name":null,"month":"11","year":"2018","card_number":"4242-4242-4242-4242","cvc":"123"}}),
     *      @Response(422, body={"message":"Could not update credit card information.","errors":{"month":{"The month field is required."},"year":{"The year field is required."},"card_number":{"The card number field is required."},"cvc":{"The cvc field is required."}},"status_code":422})
     * })
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $credit_card = CreditCard::where('user_id', '=', $user->id)->first();
        if (!$credit_card) {
            $credit_card = new CreditCard;
        }
        $credit_card->fill($request->all());
        $credit_card->user_id = $user->id;
        if (!$credit_card->save()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not update credit card information.', $credit_card->getErrors());
        }
        return $credit_card;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->isAdmin()) {
            return;
        }
        $question = CreditCard::findOrFail($id);
        return $question;
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
