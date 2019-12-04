<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SaveUserEnvioRequest;
use App\Http\Controllers\Controller;
use App\UserEnvios;

class UserEnvioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        return view('admin.envios.create', [
            'user_id' => $user_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserEnvioRequest $request)
    {
        UserEnvios::create([
            'user_id' => $request->get('user_id'),
            'calle_uno' => $request->get('calle_uno'),
            'calle_dos' => $request->get('calle_dos'),
            'direccion' => $request->get('direccion'),
            'colonia' => $request->get('colonia'),
            'municipio' => $request->get('municipio'),
            'estado' => $request->get('estado'),
            'pais' => $request->get('pais'),
            'codigo_postal' => $request->get('codigo_postal'),
            'status' => $request->get('status')
        ]);

        return redirect()->route('admin.envios.show', $request->get('user_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $envios = UserEnvios::where('user_id', $id)->get();

        return view('admin.envios.show', [
            'envios' => $envios,
            'user_id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $envios = UserEnvios::find($id);

        return view('admin.envios.edit', [
            'envios' => $envios
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserEnvioRequest $request, $id)
    {
        $envios = UserEnvios::find($id);
        $envios->calle_uno = $request->get('calle_uno');
        $envios->calle_dos = $request->get('calle_dos');
        $envios->direccion = $request->get('direccion');
        $envios->colonia = $request->get('colonia');
        $envios->municipio = $request->get('municipio');
        $envios->estado = $request->get('estado');
        $envios->pais = $request->get('pais');
        $envios->codigo_postal = $request->get('codigo_postal');
        $envios->status = $request->get('status');
        $envios->save();
       
        return redirect()->route('admin.envios.show', $envios->user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserEnvios::where('id', $id)->delete();

        return redirect()->back();
    }
}
