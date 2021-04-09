<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Dotenv\Regex\Result;
use phpDocumentor\Reflection\Types\This;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class NoteController extends Controller
{

    private $array = ['error'=>'', 'result'=>[] ];
    public function all(){
        $notes = Note::all();

            foreach($notes as $note) {
                $this->array['result'][] = [
                    'id' => $note->id,
                    'title' => $note->title
                ];
            }

            return $this->array;
   }
   public function one($id) {
        $note = Note::find($id);

        if($note) {
            $this->array['result'] = $note;
        }else{
            $this->array['error'] = 'ID não encontrado!';
        }

            return $this->array;
   }

   // ADICIONANDO
   public function new(Request $request) {
       $title = $request->input('title');
       $body = $request->input('body');

        if($title && $body) {

            $note = new Note();
            $note->title = $title;
            $note->body = $body;
            $note->save();

            $this->array['result'] = [
                'id'=>$note->id,
                'title'=> $title,
                'body'=> $body
            ];
        }else {
            $this->array['error'] = 'Campos não enviados!';
       }
        return $this->array;
     }
}


