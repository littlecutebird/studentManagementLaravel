<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ChallengeController extends Controller
{
    // Call ChallengeController::UPLOAD_FOLDER to get upload folder
    const UPLOAD_FOLDER = 'uploads/challenges';

    // Challenges are name like $id_filename. for example: 1_filename.txt, 2_challenge.txt
    // Given id, find in UPLOAD_FOLDER the filename
    public function getFilePath($id) {
        foreach(Storage::files(self::UPLOAD_FOLDER) as $filepath) {
            $filename = pathinfo($filepath, PATHINFO_FILENAME);
            $fileId = substr($filename, 0, strpos($filename, '_'));
            if ($fileId == $id) return $filepath;
        }
        return null;
    }
    public function filenameIsExist($checkFilename) {
        foreach(Storage::files(self::UPLOAD_FOLDER) as $filepath) {
            // 1_filename
            $filename = pathinfo($filepath, PATHINFO_FILENAME);
            // filename
            $originalFilename = substr($filename, strpos($filename, '_') + 1);
            if ($checkFilename == $originalFilename) return true;
        }
        return false;
    }
    public function getAnswer($challengeId) {
        foreach(Storage::files(self::UPLOAD_FOLDER) as $filepath) {
            $filename = pathinfo($filepath, PATHINFO_FILENAME);
            $fileId = substr($filename, 0, strpos($filename, '_'));
            if ($fileId == $challengeId) {
                $answer = substr($filename, strpos($filename, '_') + 1);
                return $answer;
            }
        }
        return null;
    }
    public function listChallenge(Request $request) {
        $challenges = Challenge::all();
        return view('challenges.listChallenge', compact('challenges'));
    }
    
    public function deleteChallenge(Request $request, $challengeId) {
        $challenge = Challenge::findOrFail($challengeId);
        // Check Authorization
        if ($challenge -> teacher_id != Auth::user() -> id) {
            return redirect() -> route('listChallenge');
        }
        else {
            Storage::delete($this -> getFilePath($challengeId));
            $challenge -> delete();
            return redirect() -> back() -> with('deleteSuccess', true);
        }
    }

    public function insertChallenge(Request $request) {
        if ($request -> has('addNew')) {
            $request -> validate([
                'title' => ['required', 'string'],
                'hint' => ['required', 'string'],
                'deadline' => ['required', 'date'],
                // Max file size: 10MB
                'fileToUpload' => ['required', 'file', 'max:10240'],
            ]);
            
            if ($request -> hasFile('fileToUpload')) {
                $fileName = pathinfo($request -> file('fileToUpload') -> getClientOriginalName() , PATHINFO_FILENAME);
                // Challenge name exist
                if ($this -> filenameIsExist($fileName) == true) return redirect() -> back() -> with('error', 'Challenge has already existed! Maybe you should rename the file?');

                // Challenge must be txt file
                $fileExtension = $request -> file('fileToUpload') -> getClientOriginalExtension();
                if ($fileExtension != 'txt') return redirect() -> back() -> with('error', 'Challenge must be a txt file!');
                
                $challenge = new Challenge();
                $challenge -> teacher_id = Auth::user() -> id;
                $challenge -> title = $request -> title;
                $challenge -> hint = $request -> hint;
                $challenge -> deadline = $request -> deadline;
                $challenge -> save();
                
                // save file with format like 1_filename.txt, 2_file.txt, ...
                $fileNameToStore = ($challenge -> id) . '_' . $fileName. '.' .$fileExtension;
                $request -> file('fileToUpload') -> storeAs(self::UPLOAD_FOLDER, $fileNameToStore);

                return redirect() -> route('listChallenge') -> with('addSuccess', true);
            }
        }
    }

    public function submitChallenge(Request $request, $challengeId) {
        $challenge = Challenge::find($challengeId);
        return view('challenges.submitChallenge', compact('challenge'));
    }
    public function submitAnswer(Request $request, $challengeId) {
        $answer = self::getAnswer($challengeId);
        if ($request -> has('submitChallenge')) {
            $request -> validate([
                'answer' => ['required', 'string'],
            ]);
            if ($request -> answer == $answer) return Storage::get(self::getFilePath($challengeId));
            else return redirect() -> back() -> with('wrongAnswer', true);
        }
    }
}
