<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $films = Film::all();
        return response()->json([
            'status' => 'Get All Films',
            'film'  => $films,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {
        //
       $rate = 0;
       $desc="the film is super";
       $show=null;
       $path = null;

       if ($request->hasFile('image')) {
        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = Str::random(20).'.'.$extension;
        $path = $request->file('image')->storeAs('film', $filename, 'public');
            $image = $path;

    }

//check
    $rating = $request->input('Rating') != null ? $request->input('Rating') : $rate;
       $description = $request->input('description') != null? $request->input('description') : $desc;
       $show_time = $request->input('show_time') != null ? $request->input('show_time') : $show;
       $image = $request->input('image') != null ? $path : null;
          try  {
            DB::beginTransaction();

            $film = Film::create([
                'name' => $request->name,
                'Rating' => $rating,
                'description' => $description,
                'show_time' => $show_time,
                'image' => $path,

            ]);

                     DB::commit();
              return response()->json([
                'status' => 'true',
                'film' => $film,
              ]);
    }

        catch(\Throwable $th){
              DB::rollBack();

    Log::error($th);
            return response()->json([
        'status'=> 'error',
    ]);



}
}

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $film = Film::find($id);
        return response()->json([
            'status' =>'success show',
            'film' =>$film,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, $id)
    {
        //
        $film = Film::find($id);

        $newData=[];

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = Str::random(20) . '.' . $extension;
            $path = $request->file('image')->storeAs('film', $filename, 'public');


        }

        if(isset($request->name)){
            $newData['name'] = $request->name;

        }
        if(isset($request->image)){
            $newData['image'] =$path ;

        }
        if(isset($request->Rating)){
            $newData['Rating'] = $request->Rating;

        }  if(isset($request->description)){
            $newData['description'] = $request->description;

        }  if(isset($request->show_time)){
            $newData['show_time'] = $request->show_time;

        }
        try{
            $film->update($newData);
            return response()->json([
                'status'=>"update",
                'film' => $film,
            ]);
        }
        catch(\Throwable $th){
            Log::error($th);
                    return response()->json([
                'status'=> 'error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $film=film::find($id);
        $film->delete();
         return response()->json([
            'status' => 'delate',

         ]);
    }
}
