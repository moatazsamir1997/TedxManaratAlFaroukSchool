<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\board;
use App\AcademicYear;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class BoardController extends Controller
{
    protected $board;

    public function __construct()
    {
        $this->middleware('auth' , ['except' => ['index' , 'show']]);
        $this->board = new Board();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest()) {
          
            $isAccepted = false;
            
        }
        else {
            $isAccepted = Parent::autherization('show board' , true);
        }
        $boards = Board::all()->where('isdeleted',0);
        return view('boards.index')->with('boards' , $boards)->with('isAccepted', $isAccepted);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        if(Parent::autherization('show board')){
            return Parent::autherization('show board');
        }

        return view('boards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $image = 'cover_image';
        // dd($request);

        // $this->validate($request ,[
        //     'name' => 'required',
        //     'Opendate' => 'required',
        //     'closedate' => 'required',
        //     'description' => 'required'
        //     ]);


        if ($request->hasFile($image))
        {

            # get file name with extension
            $filenameWithExt = $request->file($image)->getClientOriginalName();
            //get just filename
            $filename =pathinfo($filenameWithExt , PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file($image)->getClientOriginalExtension();//get extension
            //fileNameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload
            $path = $request->file($image)->storeAs('public/cover_images',$fileNameToStore);

        }
        else {
            $fileNameToStore ='noimage.jpg';
        }
        


        // dd($request);
        $Board=new board();

        $Board->name=$request->input('name');
        
        $Board->openingDate=$request->input('Opendate');
        
        $Board->closingDate=$request->input('closedate');
        
        $Board->description=$request->input('description');
        
        // $Board->academicYearId = $request->input('academicYearId');
        $Board->academicYearId = 1;
        
        // var_dump($request->input('academicYearId')); die();
        $Board->cover_Image  = $fileNameToStore;
        // dd($fileNameToStore);

        $Board->save();
       return redirect('/ourTeam');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if (Auth::guest()) {
            $isAccepted = false;
        }
        else {
            $isAccepted = Parent::autherization('show board' , true);
        }
        $boards = Board::all()->where('isdeleted',0);
        return view('boards.show')->with('boards' , $boards)->with('isAccepted', $isAccepted);


      $boards=Board::find($id);
      if($boards->isdeleted == 1)
      {
          return redirect('/ourTeam')->with('error','this board is removed');

      }
      else {
          return view('boards.show')->with('boards',$boards)->with('id',$id);
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boards=Board::find($id);

         return  view('boards.edit')->with('boards',$boards);
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
       $Board=Board::find($id);
        $image = 'cover_image';
        // dd($request);

        // $this->validate($request ,[
        //     'name' => 'required',
        //     'Opendate' => 'required',
        //     'closedate' => 'required',
        //     'description' => 'required'
        //     ]);
            // $Board= new board();
            
            if ($request->hasFile($image))
            {
                
                # get file name with extension
                $filenameWithExt = $request->file($image)->getClientOriginalName();
                //get just filename
                $filename =pathinfo($filenameWithExt , PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file($image)->getClientOriginalExtension();//get extension
                //fileNameToStore
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //upload
                $path = $request->file($image)->storeAs('public/cover_images',$fileNameToStore);
                
            }
            else {
                $fileNameToStore ='noimage.jpg';
            }
            
            
            
            // dd($request);
            
            
        $Board->name=$request->input('name');
        
        
        $Board->openingDate=$request->input('Opendate');
        
        $Board->closingDate=$request->input('closedate');
        
        $Board->description=$request->input('description');
        
        // $Board->academicYearId = $request->input('academicYearId');
        $Board->academicYearId = 1;
        
        // var_dump($request->input('academicYearId')); die();
        $Board->cover_Image  = $fileNameToStore;
        // dd($fileNameToStore);

        $Board->save();
       return redirect('/ourTeam');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boards=Board::find($id);
        
        // if ($boards->cover_Image != 'noimage.jpg') {
        //     $imageRoute =  $this->imagesFolderRoutes.'/'.$boards->cover_Image;
        //     Storage::delete( $imageRoute );
        // }
        // dd($boards);
        // die();
        $boards->isdeleted = 1;
        $boards->save();
        return redirect('/ourTeam')->with('success' , 'board Deleted');
    }
}
