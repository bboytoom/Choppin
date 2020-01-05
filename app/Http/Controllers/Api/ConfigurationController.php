<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use App\Http\Resources\Configuration\ConfigurationResource;
use App\Http\Resources\Configuration\ConfigurationCollection;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ConfigurationCollection(Configuration::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfigurationRequest $request)
    {
        Configuration::create([
            'domain' => strip_tags($request->get('domain')),
            'name' => strip_tags($request->get('name')),
            'business_name' => strip_tags($request->get('business_name')),
            'slogan' => strip_tags($request->get('slogan')),
            'email' => strip_tags($request->get('email')),
            'phone' => strip_tags($request->get('phone')),
            'status' => $request->get('status')
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        ConfigurationResource::withoutWrapping();
        return new ConfigurationResource($configuration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->domain = strip_tags($request->get('domain'));
        $configuration->name = strip_tags($request->get('name'));
        $configuration->business_name = strip_tags($request->get('business_name'));
        $configuration->slogan = strip_tags($request->get('slogan'));
        $configuration->email = strip_tags($request->get('email'));
        $configuration->phone = strip_tags($request->get('phone'));
        $configuration->status = $request->get('status');
        $configuration->save();

        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        $configuration->delete();

        return response(null, 204);
    }
}
