<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeEmailRequest;
use App\Models\AppLog;
use App\Rules\LoggedUserPassword;

class OptionsController extends Controller
{
    /**
     * Show options index page
     */
    public function index()
    {
        return view('pages.options');
    }

    /**
     * Show options index page with
     * selected one tab
     */
    public function show($selected)
    {
        return view('pages.options', [
            'selected' => $selected
        ]);
    }

    /**
     * Change user's avatar
     */
    public function avatarChange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => ['image', 'mimes:jpeg,jpg,png', 'max:10000', 'dimensions:max_width=800,max_height=800']
        ]);

        $result = [
            'success' => true,
            'message' => 'Awatar został pomyślnie zmieniony.'
        ];

        if ($validator->fails()) {
            $result = [
                'success' => false,
                'message' => $validator->errors()->first(),
            ];
        } else {
            $this->changeUserAvatar($request->file('image'));
        }

        $this->createAppLog(
            'avatar_change',
            'Użytkownik '.Auth::user()->name.' zmienił swój awatar.'
        );

        return response()->json([
            'result' => $result,
            'avatarPath' => Auth::user()->avatar
        ]);
    }

    /**
     * Delete user's avatar
     */
    public function avatarDelete()
    {
        $result = [
            'success' => true,
            'message' => 'Awatar został pomyślnie usunięty.',
            'avatarPath' => '/assets/images/avatar.png',
        ];

        $this->deleteUserAvatar();

        $this->createAppLog(
            "avatar_delete",
            "Użytkownik ".Auth::user()->name." usunął swój awatar."
        );

        return response()->json([
            'result' => $result
        ]);
    }

    /**
     * Change user's password
     */
    public function passwordChange(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        $this->createAppLog(
            'change_password',
            'Użytkownik '.$user->name.' zmienił swoje hasło.'
        );

        $user->password = Hash::make($request->new_password);
        $user->api_token = Str::random(60);
        $user->save();

        return redirect()->route('options.show', 'haslo')
            ->with('password_success', 'Hasło zostało pomyślnie zmienione.');
    }

    /**
     * Change user's email
     */
    public function emailChange(ChangeEmailRequest $request)
    {
        $user = Auth::user();

        $this->createAppLog(
            'change_email',
            'Użytkownik '.$user->name.' zmienił e-mail z '.$user->email.'
             na '.$request->new_email.'.'
        );

        $user->email = $request->new_email;
        $user->save();

        return redirect()->route('options.show', 'email')
            ->with('email_success', 'Email został pomyślnie zmieniony.');
    }

    /**
     * Validate form confirmation while deleting user's account
     */
    public function accountDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['bail', 'required', new LoggedUserPassword]
        ]);

        if ($validator->fails()) {
            $result = [
                'error' => true,
                'message' => $validator->errors()->first(),
            ];

            return response()->json([
                'result' => $result,
            ]);
        }

        $this->deleteUserAccountByID(Auth::user()->id);

        $result = [
            'error' => false,
            'url' => route('home'),
        ];
        return response()->json([
            'result' => $result,
        ]);
    }

    /**
     * Change user's token - logout from game
     */
    public function logoutFromGame()
    {
        $user = Auth::user();
        $user->api_token = Str::random(60);
        $user->save();

        $result = [
            'success' => true,
            'message' => 'Zostałeś pomyślnie wylogowany z gry na wszystkich urządzeniach.',
        ];

        $this->createAppLog(
            "game_total_logout",
            "Użytkownik ".$user->name." wylogował się z gry przez stronę."
        );

        return response()->json([
            'result' => $result,
        ]);
    }

    /**
     * Logout from all devices on website
     */
    public function logoutFromAccountOnWebsite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['bail', 'required', new LoggedUserPassword]
        ]);

        if ($validator->fails()) {
            $result = [
                'error' => true,
                'message' => $validator->errors()->first(),
            ];

            return response()->json([
                'result' => $result,
            ]);
        }

        Auth::logoutOtherDevices($request->password);

        $result = [
            'success' => true,
            'message' => 'Pomyślnie wylogowano z konta na stronie ze wszystkich urządzeń.',
        ];

        return response()->json([
            'result' => $result
        ]);
    }

    /**
     * Return all login application logs specified user
     */
    public function getUserLoginApplicationLogs()
    {
        $logs = AppLog::query()
            ->where('user_id', '=', Auth::user()->id)
            ->where('type', '=', 'site_login')
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'data' => $logs
        ]);
    }

}
