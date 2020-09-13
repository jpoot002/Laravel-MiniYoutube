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

class VideoControll extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CreateVideo(){

        return view( 'video.register');
    }

    //para mostrar el video
    public function showvideo()
    {
        $videos = video::where('user_id','=', Auth::user()->id)->orderBy('id', 'desc') -> paginate(6);
            return view( 'video.welcome', array(
                'videos'=>$videos
            ));


    }
  //para mostrar el video
    public function showvideo2()
    {
        $videos = video::orderByRaw('RAND()')->paginate(8);
            return view( 'home', array(
                'videos'=>$videos
            ));

    }

//para mostrar la imagen
    public function Getimage($filename){
        $user = \Auth::user();
        $file = Storage::disk('Images')->get($filename);
        return new Response($file,200);
    }


    //Para registrar el video
    public function Savevideo(Request $request)
    {
        //validar datos
        $validardatos=$this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            "image" => "required",
            "video" => "required",
        ]);
        //cargar datos
        $video=new video();
        $user = \Auth::user();
        $video->user_id=$user->id;
        $video->title=$request->input('title') ;
        $video->description=$request->input('description') ;
        $video->image=$request->file('image');
        $video->video_path=$request->file('video');


      	// Subir la imagen
		$image= $request->file('image');
        if($image){
			$image_path= time().$image->getClientOriginalName();
			Storage::disk('Images')->put($image_path, File::get($image));
            $video->image=$image_path;

        }

        	// Subir la video
		$Video_file= $request->file('video');
        if($Video_file){
			$video_path= time().$Video_file->getClientOriginalName();
			Storage::disk('Videos')->put($video_path, File::get($Video_file));
            $video->video_path = $video_path;

        }
        //guardar datos
        $video->save();
        return redirect()->route('Mostrarvideo')->with('status', 'Video registrado con exito');


    }

    //para la pagina d editar e video
    public function getvideoedit($id){

        $video=video::findOrFail($id);
        return view( 'video.edit', array(
            'video'=>$video

        ));
    }

    //Para registrar el video
    public function postvideoedit(Request $request)
    {
        //validar datos
        $validardatos=$this->validate($request,[
            'id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        //cargar datos
        $user = \Auth::user();
        $video=video::findOrFail($request->id);
        $video->user_id=$user->id;
        $video->title=$request->input('title') ;
        $video->description=$request->input('description') ;

          // Subir la imagen
        $image= $request->file('image');
        if($image){
            $image_path= time().$image->getClientOriginalName();
            Storage::disk('Images')->put($image_path, File::get($image));
            $video->image=$image_path;
        }

            // Subir la video
        $Video_file= $request->file('video');
        if($Video_file){
            $video_path= time().$Video_file->getClientOriginalName();
            Storage::disk('Videos')->put($video_path, File::get($Video_file));
            $video->video_path = $video_path;
        }
        //guardar datos
        $video->update();
        return redirect()->route('Mostrarvideo')->with('status', 'Video actualizado con exito');
    }

    //para mostrar el video ven la pantalla de ver
    public function getvideover($id){

        $comments = comments::where('video_id','=', $id)->orderBy('id', 'desc') -> paginate();
        $video=video::find($id);
        return view( 'video.Mostrarvideo', array(
            'video'=>$video,
            'comments'=>$comments
        ));
    }

    //para mostrar la video
    public function Getvideo($filename){
        $user = \Auth::user();
        $file = Storage::disk('Videos')->get($filename);
        return new Response($file,200);
    }

    public function delete(Request $request){

        $validardatos=$this->validate($request,[
            'id' => 'required',
            'imagen' => 'required',
            'video_path' => 'required',
        ]);

        $user = \Auth::user();
        $video=video::find($request->id);
        $video->id=$request->input('id');
        //eliminar comentarios
        comments::where('video_id','=', $request->id)->get()->each->delete();
        //Eliminar ficheros
        Storage::disk('Images')->delete($request->imagen);
        Storage::disk('Videos')->delete($request->video_path);
        //Eliminar video
        $video->delete();

        return redirect()->route('Mostrarvideo');
    }

}
