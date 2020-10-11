<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exercise;
use App\Models\Submitexercise;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
{
    public function listExercise(Request $request) {
        if (Auth::user() -> type == 'teacher') {
            // Return all homework of that teacher
            $exercises = Exercise::where('teacher_id', Auth::user() -> id) -> get(); 
            return view('exercises.listExercise', compact('exercises'));
        }
        else if (Auth::user() -> type == 'student') {
            $exercises = Exercise::all();
            $submitExercises = Submitexercise::where('student_id', Auth::user() -> id) -> get();
            $submitStatus = array();
            foreach ($submitExercises as $submitExercise) {
                $submitStatus[$submitExercise -> exercise_id] = true;
            }
            return view('exercises.listExercise', compact('exercises', 'submitStatus'));
        }
    }
    public function insertExercise(Request $request) {
        if ($request -> has('addNew')) {
            $request -> validate([
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'deadline' => ['required', 'date'],
                // Max file size: 10MB
                'fileToUpload' => ['required', 'file', 'max:10240'],
            ]);
                
            if ($request -> hasFile('fileToUpload')) {
                $fileName = pathinfo($request -> file('fileToUpload') -> getClientOriginalName() , PATHINFO_FILENAME);
                $fileExtension = $request -> file('fileToUpload') -> getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$fileExtension;
                $filePath = $request -> file('fileToUpload') -> storeAs('uploads/exercises', $fileNameToStore);
            }

            $exercise = new Exercise();
            $exercise -> teacher_id = Auth::user() -> id;
            $exercise -> title = $request -> title;
            $exercise -> description = $request -> description;
            $exercise -> deadline = $request -> deadline;
            $exercise -> file_path = 'uploads/exercises/'. $fileNameToStore;
            $exercise -> save();

            return redirect() -> back() -> with('addSuccess', true);
        }
    }
    public function deleteExercise(Request $request, $id) {
        $exercise = Exercise::findOrFail($id);
        // Check Authorization
        if ($exercise -> teacher_id != Auth::user() -> id) {
            return redirect() -> route('listExercise');
        }
        else {
            Storage::delete($exercise -> file_path);
            $exercise -> delete();
            return redirect() -> back() -> with('deleteSuccess', true);
        }
    }

    public function submitExercise(Request $request, $id) {
        $exercise = Exercise::findOrFail($id);
        return view('exercises.submitExercise', compact('exercise'));
    }
    public function insertSubmitexercise(Request $request, $id) {
        if ($request -> has('submit')) {
            $request -> validate([
                // Max file size: 10MB
                'fileToUpload' => ['required', 'file', 'max:10240'],
            ]);
                
            if ($request -> hasFile('fileToUpload')) {
                $fileName = pathinfo($request -> file('fileToUpload') -> getClientOriginalName() , PATHINFO_FILENAME);
                $fileExtension = $request -> file('fileToUpload') -> getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$fileExtension;
                $filePath = $request -> file('fileToUpload') -> storeAs('uploads/submits', $fileNameToStore);
            }

            $submitExercise = new Submitexercise();
            $submitExercise -> exercise_id = $id;
            $submitExercise -> student_id = Auth::user() -> id;
            $submitExercise -> submit_time = now();
            $submitExercise -> file_path = 'uploads/submits/'. $fileNameToStore;
            $submitExercise -> save();

            return redirect() -> back() -> with('addSuccess', true);
        }
    }

    public function seeSubmissions(Request $request, $exerciseId) {
        $exercise = Exercise::findOrFail($exerciseId);
        
        //Authorization
        if ($exercise -> teacher_id != Auth::user() -> id) {
            return redirect() -> route('listExercise');
        }
        else {
            $submissions = Submitexercise::where('exercise_id', $exerciseId) -> get();
            return view('exercises.seeSubmissions', compact('exercise', 'submissions'));
        }
    }
}
