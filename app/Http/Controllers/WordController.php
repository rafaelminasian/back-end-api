<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index() {
      return Word::all('text');
    }


    public function create(Request $request)
    {

        if(Word::count() === 0){
            try{
                $word= new Word();
                $word->text= $request->text;
                $word->save();
                return $word;

            }catch (\Exception $e){
                return response()->json(['status' => 'false'], 500);
            }
        }
        else {
            try {
                $id= Word::first();
                $id=$id->id;
                $word = Word::find($id);
                $word->text= $request->text;
                $word->save();

                return response()->json([
                    'status' => 'true',
                    'word'   => $word

                ], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => 'false'], 500);
            }

        }



    }
}
