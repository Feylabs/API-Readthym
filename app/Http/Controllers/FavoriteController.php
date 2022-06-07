<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\Author;
use App\Models\Book;
use App\Models\FavoriteBook;
use App\Models\Material;
use Illuminate\Http\Request;

class FavoriteController extends Controller
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
        $datas = FavoriteBook::all();
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
    public function getByUser(Request $request,$id)
    {
        $datas =  FavoriteBook::where([
            ['id_user', '=', $id],
        ])->get();

        if(RazkyFeb::isAPI($request)){
            if ($datas) {
                return RazkyFeb::responseSuccessWithData(
                    200,1,200,"Berhasil","",$datas
                );
            } else {
                return RazkyFeb::responseErrorWithData(
                    200, 3, 400,
                    "Gagal Mendapatkan Data Data",
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
     */
    public function getDetail(Request $request,$id)
    {
        $datas = FavoriteBook::findOrFail($id);
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
        $material = new FavoriteBook();
        $material->id_user = $request->id_user;
        $material->id_book = $request->id_book;

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $material = FavoriteBook::findOrFail($id);

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

    public function deleteAndroid(Request $request)
    {
        $userId = $request->user_id;
        $bookId = $request->book_id;

        $data = FavoriteBook::where([
            ['id_user', '=', $userId],
            ['id_book', '=', $bookId],
        ]);

        if(RazkyFeb::isAPI($request)){
            if ($data->delete()) {
                return RazkyFeb::responseSuccessWithData(
                    200,1,200,"Berhasil Menghapus Data","",$data->get()
                );
            } else {
                return RazkyFeb::responseErrorWithData(
                    200, 3, 400,
                    "Gagal Menghapus Data",
                    "Success",
                    $data->get()
                );
            }
        }else{
            if ($data->delete()) {
                return back()->with(["success" => "Data saved successfully"]);
            } else {
                return back()->with(["error" => "Saving process failed"]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function findCategory(Request $request)
    {
        $material = Book::where('category','=',$request->category)->get();

        if(RazkyFeb::isAPI($request)){
            if ($material) {
                return RazkyFeb::responseSuccessWithData(
                    200,1,200,"Berhasil","",$material
                );
            } else {
                return RazkyFeb::responseErrorWithData(
                    200, 3, 400,
                    "Gagal",
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
     */
    public function check(Request $request)
    {
        $userId = $request->user_id;
        $bookId = $request->book_id;

        $data = FavoriteBook::where([
            ['id_user', '=', $userId],
            ['id_book', '=', $bookId],
        ])->get();

        if (RazkyFeb::isAPI($request)) {
            if (count($data)) {
                return RazkyFeb::responseSuccessWithData(
                    200, 1, 200, "Berhasil", "", $data
                );
            } else {
                return RazkyFeb::responseErrorWithData(
                    200, 3, 400,
                    "Favorite Tidak Ditemukan",
                    "Failed",
                    $data
                );
            }
        } else {
            if ($data) {
                return back()->with(["success" => "Data saved successfully"]);
            } else {
                return back()->with(["error" => "Saving process failed"]);
            }
        }
    }
}
