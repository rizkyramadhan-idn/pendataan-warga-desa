<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(["job"])->orderBy("created_at", "DESC")->paginate(10);

        return view("admin.users.index", compact("users"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with(["reports"])->where("id", $id)->first();

        if (count($user->reports) > 0) {
            return redirect(route("admin.users.index"))->with(["error" => "User memiliki laporan!"]);
        }

        File::delete('assets/images/' . $user->image);

        $user->delete();

        return redirect(route("admin.users.index"))->with(["success" => "User berhasil dihapus!"]);
    }
}