<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function storeProfile(Request $request)
    {
        

        $this->validate($request, [
            'about'     => 'required',
            'company'   => 'required',
            'job'       => 'required',
            'phone'     => 'required',
        ]);

        Profile::create([
            'user_id'   => $request->auth()->user()->id,
            'about'     => $request->about,
            'company'   => $request->company,
            'job'       => $request->job,
            'phone'     => $request->phone,
        ]);

        ddd($request);
    }
}
