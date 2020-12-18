<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\CreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RecordResource;

class ContactController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required|regex:/(06)[0-9]{8}/|unique:contacts',
            'address' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['statu'=>false,'error'=>$validator->errors()]);
        }

        $contact = new Contact;
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->address = $request->address;
        $contact->cName = $request->cName;
        $contact->cNumero = $request->cNumero;
        $contact->cAddress = $request->cAddress;

        $contact->save();

        //Mail::to($contact->email)->send(new CreatedMail());

        return response()->json(['statu'=>true,'message'=>'Has been created']);
    }

    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
