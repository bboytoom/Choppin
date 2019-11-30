<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Caracteristica;

class CharastecController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.characteristics.create', [
            'producto_id' => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'caracteristica' => 'required|max:50',
            'descripcion' => 'required'
        ]);

        $caracteristica = Caracteristica::create([
            'producto_id' => $request->get('producto_id'),
            'caracteristica' => $request->get('caracteristica'),
            'descripcion' => $request->get('descripcion')
        ]);

        $message = $caracteristica ? 'Caracteristica agregada correctamente!' : 'La caracteristica NO pudo agregarse!';

        return redirect()->route('admin.characteristics.show', $request->get('producto_id'))->with('message', $message);
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
    public function update(Request $request, $id, $producto_id)
    {
        $this->validate($request, [
            'caracteristica' => 'required|max:50',
            'descripcion' => 'required'
        ]);

        $carac = Caracteristica::find($id);
        $carac->caracteristica = $request->get('caracteristica');
        $carac->descripcion = $request->get('descripcion');
        $carac->save();
       
        $message = $carac ? 'Caracteristica actualizada correctamente!' : 'La caracteristica NO pudo actualizarse!';
        
        return redirect()->route('admin.characteristics.show', $producto_id)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $product_id)
    {        
        $deleted = Caracteristica::where('id', $id)->delete();

        $message = $deleted ? 'Caracteristica eliminada correctamente!' : 'La caracteristica NO pudo eliminarse!';
        
        return redirect()->route('admin.characteristics.show', $product_id)->with('message', $message);
    }
}
