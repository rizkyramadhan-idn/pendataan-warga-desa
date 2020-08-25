<?php

namespace App\Http\Controllers;

use App\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::orderBy("created_at", "DESC")->paginate(10);

        return view("admin.provinces.index", compact("provinces"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.provinces.create");
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
            "name" => "required|unique:provinces"
        ]);

        Province::create($request->except("_token"));

        return redirect(route("admin.provinces.index"))->with(["success" => "Provinsi berhasil ditambahkan!"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        return view("admin.provinces.edit", compact("province"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $this->validate($request, [
            "name" => "required|unique:provinces,id," . $province->id
        ]);

        $province->update($request->except("_token"));

        return redirect(route("admin.provinces.index"))->with(["success" => "Provinsi berhasil diupdate!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        $selectedProvince = Province::with(["cities"])->where("id", $province->id)->first();

        if (count($selectedProvince->cities) > 0) {
            return redirect(route("admin.provinces.index"))->with(["error" => "Provinsi sedang digunakan!"]);
        }

        $province->delete();

        return redirect(route("admin.provinces.index"))->with(["success" => "Provinsi berhasil dihapus!"]);
    }
}