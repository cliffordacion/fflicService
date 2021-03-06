<?php

namespace App\UserInterface\Courier\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserInterface\Courier\Requests\RegistrationRequest;

use App\Domain\CourierUserActivation;
use App\Domain\CourierUser;

class CourierUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            return view('userProfile', compact('user'));
        }
    }

    public function profileUpdate()
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            return view('userProfileUpdate', compact('user'));
        }
    }

    public function profileSaveId(Request $request)
    {
        if (\Auth::user())
        {
            $params = $request->all();
            //Get the Id to be updated (Front/Back Id)
            $userId = \Auth::user()->id;
            $idImageFile = isset($params['idFrontImageFile']) ? $params['idFrontImageFile'] : $params['idBackImageFile']; 
            $idImageType = isset($params['idFrontImageFile']) ? 'Front' : 'Back';
            $imageFileType = $idImageFile->getClientOriginalExtension();

            //Get the target url to store the images
            $target_dir = base_path() . '/public_html/id';
            $target_filename =  $userId . '_' . $idImageType . '.' . $imageFileType;
            $target_file = $target_dir . '/' . $target_filename;

            $uploadOk = 1;

            // Check if image file is a actual image or fake image
            $check = getimagesize($idImageFile);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }

            // delete if file exists 
            if (file_exists($target_file)) {
                if (!unlink($target_file)) {
                    echo ("Error deleting $file");
                } else {
                    echo ("Deleted " . $target_file);
                }
            }
            // Check file size
            if ($idImageFile->getClientSize() > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                $idImageFile->move($target_dir, $target_filename);
                $user = \Auth::user();
                if($idImageType === 'Front')
                    $user->id_image_front = '/id/' . $target_filename;
                else
                    $user->id_image_back = '/id/' . $target_filename;

                $user->save();
                return back();
            }
        }
    }

    public function showRegistrationForm()
    {
        if (\Auth::check()) {
            return redirect()->route('courier_home');
        } else {
            return view('auth.register');
        }
    }

    /**
     * @param Request $request
     * @return View || Illuminate\Http\RedirectResponse
     */
    public function register(RegistrationRequest $request)
    {
        $user = CourierUser::register($request);
        
        CourierUserActivation::sendActivationMail($user); 

        return redirect('courier/login')->with('status', 'We sent you an activation code. Check your email.');
    }


    public function activateUser($activationLink)
    {
        $courierUserActivation = new CourierUserActivation;
        $userActivation = $courierUserActivation->getActivationByToken($activationLink);
        if (isset($userActivation)) {
            $user = CourierUser::where('id', $userActivation->user_id)->first();
            $user->activate();
            $userActivation->delete();
            return redirect('courier/login')->with('status', 'Congratulations! Please Login with your registered credentials.');
        }

        return redirect('courier/login')->with('status', 'Invalid activation link. Please check your email.');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
