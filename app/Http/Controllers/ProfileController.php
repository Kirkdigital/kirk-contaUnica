<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    use UploadTrait;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $you = auth()->user();
        $countinstlist = Institution::where('integrador', $you->id)->get();
        $countinst = $countinstlist->count();
        return view('admin.profileEditForm', compact('countinst'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|email|max:256',
            'profile_image'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $user = User::findOrFail(auth()->user()->id);
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');
        $user->mobile       = $request->input('mobile');
        $user->doc       = $request->input('doc');
        
        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp

            $name = Str::slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'profiles', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = URL::to('/').'/storage/profiles/'.$filePath;
        }
        $this->adicionar_log_global('8', 'U', '{"name":"' . $user->name . '","email":"' . $user->email . '","mobile":"' . $user->mobile . '","doc":"' . $user->doc . '"}');
        
        $user->save();
        $request->session()->flash("success", 'events.change_success');

        return redirect()->back();
    }
    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        $request->session()->flash("success", 'events.locale_change_success');

        return redirect()->back();
    }
    
}
