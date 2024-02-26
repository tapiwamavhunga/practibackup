<?php

namespace App\Http\Controllers;

use App\Models\Mails;
use App\Http\Requests\StoreMailsRequest;
use App\Http\Requests\UpdateMailsRequest;

class MailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mails  $mails
     * @return \Illuminate\Http\Response
     */
    public function show(Mails $mails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mails  $mails
     * @return \Illuminate\Http\Response
     */
    public function edit(Mails $mails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMailsRequest  $request
     * @param  \App\Models\Mails  $mails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMailsRequest $request, Mails $mails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mails  $mails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mails $mails)
    {
        //
    }
}
