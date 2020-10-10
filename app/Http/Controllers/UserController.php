<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function addNewStudent(Request $request) {
        if ($request -> has('submit')) {
            // Press the submit button in register form, check the condition
            $request -> validate([
               'fullname' => ['required', 'string'],
               'username' => ['required', 'string', 'unique:users,username'],
               'password' => ['required', 'string', 'min:6'],
               'confirm_password' => ['required', 'string', 'same:password'],
               'email' => ['nullable', 'email'],
               'phonenumber' => ['nullable', 'digits_between:8,12'],
            ]);
            
            // Add new user to database
            $newUser = new User();
            $newUser -> fullname = $request -> fullname;
            $newUser -> username = $request -> username;
            $newUser -> password = $request -> password;
            $newUser -> email = $request -> email;
            $newUser -> phonenumber = $request -> phonenumber;
            $newUser -> save();
            // Return successful addStudent notification
            return redirect() -> back() -> with('addSuccess', true);
        }
       
    }

    public function editStudentProfile(Request $request, $id) {
        $user = User::find($id);
        if ($user -> type != 'student') return redirect() -> back();
        else return view('users.editStudentProfile', compact('user'));
    }
    public function updateStudentProfile(Request $request, $id) {
        $user = User::find($id);
        if ($user -> type != 'student') return redirect() -> back();
        else {
            $request -> validate([
                'fullname' => ['required', 'string'],
                'email' => ['required', 'email'],
                'phonenumber' => ['required', 'digits_between:8,12'],
            ]);
            $user -> fullname = $request -> fullname;
            $user -> email = $request -> email;
            $user -> phonenumber = $request -> phonenumber;
            $user -> save();
            return redirect() -> back() -> with('editSuccess', true);
        }
    }

    public function deleteStudentProfile(Request $request, $id) {
        $user = User::find($id);
        if ($user -> type != 'student') return redirect() -> back();
        else {
            $user -> delete();
            return redirect() -> back() -> with('deleteSuccess', true);
        }
    }
    public function listUser(Request $request) {
        $users = User::all();
        return view('users.listUser', compact('users'));
    }

    public function getProfile(Request $request) {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    public function editProfile(Request $request) {
        $user = Auth::user();
        return view('profile.editProfile', compact('user'));
    }

    public function updateProfile(Request $request) {
        $request -> validate([
            'email' => ['required', 'email'],
            'phonenumber' => ['required', 'digits_between:8,12'],
        ]);
        $user = User::find(Auth::user() -> id);
        $user -> email = $request -> email;
        $user -> phonenumber = $request -> phonenumber;
        $user -> save();
        return redirect() -> back() -> with('editSuccess', true);
    }

    public function changePassword(Request $request) {
        return view('profile.changePassword');
    }

    public function updatePassword(Request $request) {
        $request -> validate([
            'oldPassword' => ['required', 'password'],
            'newPassword' => ['required', 'string', 'min:6'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);

        $user = User::find(Auth::user() -> id);
        $user -> password = $request -> newPassword;
        $user -> save();

        return redirect() -> back() -> with('changeSuccess', true);
    }

    public function sendMsg(Request $request, $id) {
        // select * from messages where (sendId = $id and receiveId = Auth::user() -> id) or (sendId = Auth::user() -> id and receiveId = $id) 
       
        $messages = Message::where(function($query) use ($id) {
            $query -> where('sendId', $id) -> where('receiveId', Auth::user() -> id);
        }) -> orWhere(function($query) use ($id) {
            $query -> where('sendId', Auth::user() -> id) -> where('receiveId', $id);
        }) -> orderBy('created_at') -> get();

        // User that current user trying to chat
        $receiverUser = User::find($id);
        return view('users.sendMsg', compact('messages', 'receiverUser'));
    }

    public function insertMsg(Request $request, $id) {
        if ($request -> has('newMessage')) {
            $request -> validate([
                'messageContent' => ['required', 'string'],
            ]);
            $newMsg = new Message();
            $newMsg -> sendId = Auth::user() -> id;
            $newMsg -> receiveId = $id;
            $newMsg -> content = $request -> messageContent;
            $newMsg -> save();

            return redirect() -> to(url() -> previous() . '#bottomPage');
        }  
    }
    public function deleteMsg(Request $request, $id) {
        // Return 404 if not found
        $message = Message::findOrFail($id);
        
        // Authorization
        if ($message -> sendId != Auth::user() -> id) {
            return redirect() -> to(route('listUser'));
        }
        else {
            $message -> delete();
            return redirect() -> to(url() -> previous() . '#bottomPage');
        }
    }

    public function editMsg(Request $request, $id, $receiveId) {
        // Return 404 if not found
        $message = Message::findOrFail($id);

        // Authorization
        if ($message -> sendId != Auth::user() -> id) {
            return redirect() -> to(route('listUser'));
        }
        else {
            return view('users.editMsg', compact('message', 'receiveId'));
        }
    }
    public function updateMsg(Request $request, $id, $receiveId) {
        $message = Message::find($id);
         // Authorization
         if ($message -> sendId != Auth::user() -> id) {
            return redirect() -> to(route('listUser'));
        }
        else {
            // Validate content
            $request -> validate([
                'messageContent' => ['required', 'string'],
            ]);
            $message -> content = $request -> messageContent;
            $message -> save();
            return redirect() -> to(route('sendMsg', ['id' => $receiveId]) . '#bottomPage');
        }
      
    }
}
