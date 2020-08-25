<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function userProfile() {
        $user = User::with(["job"])->findOrFail(Auth::user()->id);

        return view("user.profile.show", compact("user"));
    }
    
    public function editUserProfile($id) {
        $jobs = Job::orderBy("created_at", "DESC")->get();
        $user = User::with(["job"])->findOrFail($id);

        return view("user.profile.edit", compact("jobs", "user"));
    }

    public function updateUserProfile(Request $request, $id) {
        $this->validate($request, [
            "name" => "required|string",
            "job_id" => "required|exists:jobs,id",
            "email" => "required|email|unique:users,id," . $id,
            "password" => "required",
            "image" => "required|mimes:jpeg,jpg,png",
            "gender" => "required",
            "phone_number" => "required|numeric"
        ]);

        $user = User::with(["job"])->findOrFail($id);

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $filename = time() . "." . $file->getClientOriginalExtension();

            $file->move('assets/images', $filename);

            File::delete('assets/images' . $user->image);

            // Jika user mengganti passwornya password 

            if ($user->password != $request->password) {
                $user->update([
                    "name" => $request->name,
                    "job_id" => $request->job_id,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "image" => $filename,
                    "gender" => $request->gender,
                    "phone_number" => $request->phone_number
                ]);
            } else {
                // Jika user tidak mengganti passwordnya

                $user->update([
                    "name" => $request->name,
                    "job_id" => $request->job_id,
                    "email" => $request->email,
                    "password" => $request->password,
                    "image" => $filename,
                    "gender" => $request->gender,
                    "phone_number" => $request->phone_number
                ]);
            }
        }

        return redirect(route("user.profile", $user->id))->with(["success" => "User berhasil diupdate!"]);
    }
}