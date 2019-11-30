<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Unidades;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = Unidades::all();
    
    	return view('admin.units.index', [
            'unidades' => $unidades
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.units.create');
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
          'unidad' => 'required|max:20',
          'contraccion' => 'required|max:6'
        ]);

        $unidad = Unidades::create([
            'unidad' => $request->get('unidad'),
            'contraccion' => $request->get('contraccion')
        ]);

        $message = $unidad ? 'Unidad agregada correctamente!' : 'La unidad NO pudo agregarse!';

        return redirect()->route('admin.units.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unidades $unidad)
    {
        return $unidad;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidades $unidad)
    {
        return view('admin.units.edit', [
            'unidad' => $unidad
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidades $unidad)
    {
        $this->validate($request, [
          'unidad' => 'required|max:20',
          'contraccion' => 'required|max:6'
        ]);

        $unidad->fill($request->all());
        $updated = $unidad->save();

        $message = $updated ? 'Unidad actualizada correctamente!' : 'La unidad NO pudo actualizarse!';
        
        return redirect()->route('admin.units.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidades $unidad)
    {
        $deleted = $unidad->delete();

        $message = $deleted ? 'Unidad eliminada correctamente!' : 'La unidad NO pudo eliminarse!';
        
        return redirect()->route('admin.units.index')->with('message', $message);
    }
}
