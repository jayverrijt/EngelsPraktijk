<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    //
    public function add () {
        $type = request('type');
        if($type == 1) {
            // Open vraag
            $qname = request('qname');
            $qanswer = request('qanswer');
            $qlevel = request('qlevel');
            \DB::table('questions')->insert([
                'question' => $qname,
                'answer' => $qanswer,
                'level_id' => $qlevel,
                'category_id' => 1,
            ]);
            return redirect()->route('admin.cards');
        } elseif ($type == 2)  {
            // Ja nee vraag
            $qname = request('qname');
            $qanswer = request('qanswer');
            $qlevel = request('qlevel');
            if($qanswer == 1) {
                $qas = 'Ja';
            } else {
                $qas = 'Nee';
            }
            \DB::table('questionsyn')->insert([
                'question' => $qname,
                'answer' => $qas,
                'level_id' => $qlevel,
                'category_id' => 2,
            ]);
            return redirect()->route('admin.cards');
        } else {
            // Errorhandeling
            return redirect()->route('admin.cards');

        }
    }
}
