<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function edit(Request $request){
        return view('profiles.edit')->with([
            'user' => $request->user()
        ]);
    }

    public function update(ProfileRequest $request){
        return DB::transaction(function () use($request) {
            $user = $request->user();
            $user->fill($request->validated());

            if($user->isDirty('email')){
                $user->admin_since = null;
                $user->sendEmailVerificationNotification();
            }
            if($request->hasFile('image')){
                if($user->image != null){
                    Storage::disk('images')->delete($user->image->path);
                    $user->image()->delete();
                }
                $path = $request->file('image')->store('users', 'images');
                $user->image()->create([
                    'path' => $path
                ]);
            }
            $user->save();
            return redirect()->route('profile.edit')->withSuccess('Perfil editado exitosamente');
        });
    }
}
