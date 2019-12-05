<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SaveCharastecRequest;
use App\Http\Controllers\Controller;
use App\Models\Caracteristica;

class CharastecController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($producto_id)
    {
        return view('admin.characteristics.create', [
            'producto_id' => $producto_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCharastecRequest $request)
    {
        $caracteristica = Caracteristica::create([
            'producto_id' => $request->get('producto_id'),
            'caracteristica' => $request->get('caracteristica'),
            'descripcion' => $request->get('descripcion')
        ]);

        return redirect()->route('admin.characteristics.show', $request->get('producto_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $caracteristicas = Caracteristica::where('producto_id', $id)->get();
        
        return view('admin.characteristics.show', [
            'producto_id' => $id,
            'caracteristicas' => $caracteristicas
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
        $caracteristica = Caracteristica::find($id);

        return view('admin.characteristics.edit', [
            'caracteristica' => $caracteristica
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCharastecRequest $request, $id)
    {
        $carac = Caracteristica::find($id);
        $carac->caracteristica = $request->get('caracteristica');
        $carac->descripcion = $request->get('descripcion');
        $carac->save();
       
        return redirect()->route('admin.characteristics.show', $carac->producto_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $deleted = Caracteristica::where('id', $id)->delete();

        return redirect()->back();
    }
}
