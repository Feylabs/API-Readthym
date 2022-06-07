<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\Author;
use App\Models\Material;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function test(){
        return 99;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCreate()
    {
        return view('author.create');
    }

    /**
     * Show the form for managing existing resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewManage()
    {
        $datas = Author::all();
        return view('material.manage')->with(compact('datas'));
    }

    /**
     */
    public function getAll(Request $request)
    {
        $datas = Author::all();
        if(RazkyFeb::isAPI($request)){
            if ($datas) {
                return RazkyFeb::responseSuccessWithData(
                    200,1,200,"Berhasil","",$datas
                );
            } else {
                return RazkyFeb::responseErrorWithData(
                    200, 3, 400,
                    "Gagal Menyimpan Data",
                    "Success",
                    ""
                );
            }
        }else{
            if ($datas) {
                return back()->with(["success" => "Data saved successfully"]);
            } else {
                return back()->with(["error" => "Saving process failed"]);
            }
        }
    }

    /**
     */
    public function getDetail(Request $request,$id)
    {
        $datas = Author::findOrFail($id);
        if(RazkyFeb::isAPI($request)){
            if ($datas) {
                return RazkyFeb::responseSuccessWithData(
                    200,1,200,"Berhasil","",$datas
                );
            } else {
                return RazkyFeb::responseErrorWithData(
                    200, 3, 400,
                    "Gagal Menampilkan Data",
                    "Failed",
                    ""
                );
            }
        }else{
            if ($datas) {
                return back()->with(["success" => "Data saved successfully"]);
            } else {
                return back()->with(["error" => "Saving process failed"]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $material = new Author();
        $material->name = $request->name;
        $material->desc = $request->desc;
        $material->birth_date = $request->birth_date;
        $material->death_date = $request->death_date;
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/author/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $material->photo = $photoPath;
        }

        if(RazkyFeb::isAPI($request)){
            if ($material->save()) {
                return RazkyFeb::responseSuccessWithData(
                    200,1,200,"Berhasil","",$material
                );
            } else {
                return RazkyFeb::responseErrorWithData(
                    200, 3, 400,
                    "Gagal Menyimpan Data",
                    "Success",
                    ""
                );
            }
        }else{
            if ($material->save()) {
                return back()->with(["success" => "Data saved successfully"]);
            } else {
                return back()->with(["error" => "Saving process failed"]);
            }
        }

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
        $datas = Material::where('id', '=', $id)->first();
        return view('material.edit')->with(compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $material = Material::findOrFail($request->id);
        $material->name = $request->material_name;
        $material->stock = $request->stock;
        $material->unit = $request->material_unit;
        if ($request->hasFile('photo')) {


            // remove photo first
            $file_path = public_path() . $material->photo;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (Exception $e) {
                    // Do Nothing on Exception
                }
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/material/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $material->photo = $photoPath;


        }

        if ($material->save()) {
            return back()->with(["success" => "Data saved successfully"]);
        } else {
            return back()->with(["error" => "Saving process failed"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $material = Author::findOrFail($id);
        $file_path = public_path() . $material->photo;
        RazkyFeb::removeFile($file_path);

        if(RazkyFeb::isAPI($request)){
            if ($material->delete()) {
                return RazkyFeb::responseSuccessWithData(
                    200,1,200,"Berhasil","",$material
                );
            } else {
                return RazkyFeb::responseErrorWithData(
                    200, 3, 400,
                    "Gagal Menyimpan Data",
                    "Success",
                    ""
                );
            }
        }else{
            if ($material->save()) {
                return back()->with(["success" => "Data saved successfully"]);
            } else {
                return back()->with(["error" => "Saving process failed"]);
            }
        }
    }
}
