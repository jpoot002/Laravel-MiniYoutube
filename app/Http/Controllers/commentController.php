<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use App\video;
use App\comments;
class commentController extends Controller
{
    public function savecomen(Request $request){

        $validardatos=$this->validate($request,[
            'body' => 'required',
            'id' => 'required',
        ]);
        //cargar datos
        $comment=new comments();
        $user = \Auth::user();
        $comment->user_id=$user->id;//id del usuario
        $comment->video_id=$request->input('id') ;//id del video
        $comment->body=$request->input('body') ;//body
        //guardar datos
        $comment->save();
        return redirect()->route('Vervideo',$comment->video_id)->with('status', 'gracias por tu comentario');
    }

    public function showcomment()
    {
            $id='35';
            $comments = comments::where('video_id','=', $id)->orderBy('id', 'desc') -> paginate(5);
        return view( 'video.comments', array(
            'comments'=>$comments
        ));

    }


    public function delete(Request $request){

        $validardatos=$this->validate($request,[
            'id' => 'required',
        ]);

        $comment=comments::find($request->id);
        $user = \Auth::user();
        $comment->id=$request->input('id');


        $comment->delete();
        return redirect()->route('Mostrarvideo');
    }

}
