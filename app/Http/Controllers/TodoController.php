<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return view('welcome')->with('todos', $todos);
    }

    public function create(Request $request){

        $todo = new Todo();

        $todo->content = $request->content;
        $todo->status = "pending";

        $todo->save();

        return redirect()->route('home')->with('success', "Todo added successfully!");
    }

    public function update($id){

        $todo = Todo::find($id);
        $todo->status = "complete";
        $todo->save();

        return redirect()->route('home')->with('success', "Todo marked as complete!");
    }

    public function delete($id){

        $todo = Todo::find($id);
        $todo->delete();

        return redirect()->route('home')->with('success', "Todo deleted!");
    }
}
