<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\mapel;
use App\Http\Requests\CreateMapelRequest;
use App\Http\Requests\UpdateMapelRequest;
use Auth;

class mapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = mapel::orderBy('id_mapel','asc')->paginate(5);
        return view('backend.admin.mapel.index',compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.admin.mapel.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMapelRequest $request)
    {
        $input = Request::all();
        $input['id_user'] = Auth::admin()->get()->id_user;
        $input['postdate'] = date('Y-m-d');
        mapel::create($input);
        flash()->success('Mapel berhasil dibuat');
        return Redirect('index/manajemen/mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mapel = mapel::find($id);
        if(is_null($mapel)) {
            abort(404);
        }
        return view('backend.admin.mapel.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMapelRequest $request, $id)
    {
        $mapel = mapel::find($id);
        if(is_null($mapel)) {
            abort(404);
        }
        $input = Request::all();
        $input['id_user'] = Auth::admin()->get()->id_user;
        $input['postdate'] = date('Y-m-d');
        $mapel->update($input);
        flash()->info('Mapel berhasil diupdate');
        return Redirect('index/manajemen/mapel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = mapel::find($id);
        if(is_null($mapel)) {
            abort(404);
        }
        $mapel->delete();
        flash()->warning('Mapel berhasil dihapus');
        return Redirect('index/manajemen/mapel');
    }
}
