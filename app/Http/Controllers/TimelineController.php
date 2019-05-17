<?php

namespace App\Http\Controllers;

use App\Timeline;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guest()) {

//            //admin
//            $role = Auth::user()->role;
//            if ($role == '1') {
////                $timelines = Timeline::all();
//                $timelines = Timeline::orderBy('created_at' , 'desc')->paginate(3);
//                $users = User::all();
//                return view('timeline.home', compact('timelines', $timelines, 'users', $users));
//            } else {

                $userId = Auth::id();
//      //      $timelines = DB::select("SELECT * FROM timelines where user_id = '$userId'");
//    or    //        $timelines = Timeline::all()->where('user_id', '=', $userId);
                $timelines = Timeline::orderBy('created_at' , 'desc')->where('user_id', '=', $userId)->paginate(3);
                $users = User::all();

                return view('timeline.home', compact('timelines', $timelines, 'users', $users));
//            }
        }else{
            return view('welcome');
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $request->validate([
            'body'     => 'bail|required|min:5|max:5000',
        ]);

        // Create Post
        $post = new Timeline();
        $post->body = $request->input('body');
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect('/home')->with('success'  , 'Post Created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeline $id)
    {
//        dd($id);
//        dd(Auth::user());

        if ($id->user_id == Auth::user()->id or Auth::user()->role =='1' ) {
            return view('timeline.edit_post', compact('id'));
        }else{
            echo "You haven`t the Authorization to do that..";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'body' => 'required',
        ]);


        $post = Timeline::find($id);

            $post->body = $request->input('body');
//        $post->user_id = Auth::user()->id;
            $post->save();
            return redirect('/home')->with('success', 'Post updated succesfuly!! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Timeline::find($id);

        //Current User Id
//        $userId = Auth::id();
//        if ($post->user_id !== $userId ) {
//            return redirect('/posts')->with('error', 'That is not your post yaaaad!!!!');
//        }


        $post->delete();

        return redirect('/home')->with('success','Post Deleted Successfully');

    }

}
