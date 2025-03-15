<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private function makeFixedText($text)
    {
        $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
        
        $new_text = "";
        $count_ru = 0;
        $count_eng = 0;
    
        foreach ($chars as $char) {
            if (preg_match('/^[а-яА-ЯёЁ]$/u', $char)) {
                ++$count_ru;
            } elseif (preg_match('/^[a-zA-Z]$/', $char)) {
                ++$count_eng;
            }
        }
    
        foreach ($chars as $char) {
            if ($count_ru < $count_eng && preg_match('/^[а-яА-ЯёЁ]$/u', $char)) {
                $new_text = $new_text."<strong>$char</strong>";
            } elseif ($count_ru >= $count_eng && preg_match('/^[a-zA-Z]$/', $char)) {
                $new_text = $new_text."<strong>$char</strong>";
            } else {
                $new_text = $new_text."$char";
            }
        }
        return $new_text;
    }

    public function storeText(Request $request)
    {
        $text = $request->input('userText');
        $text = strip_tags($text);

        // $str = "Для aктивации аккaунта неoбxодимо ввeсти код подтвеpждения";
        // $str = "Fоr accоunt аctivatiоn plеasе еntеr yоur cоnfirmation codе";
        $text = $this->makeFixedText($text);

        $session_id = Session::getId();

        $history = History::create(['session_id' => $session_id, 'text' => $text]);
        Session::put('user_text', $text);
        return redirect()->back();
    }

    public function checkText(Request $request)
    {
        $text = $request->input('userText');
        $text = strip_tags($text);

        $text = $this->makeFixedText($text);

        $session_id = Session::getId();

        Session::put('user_text', $text);
        return response()->json($text);
    }

    public function index(Request $request)
    {
        $session_id = Session::getId();
        $history = History::where('session_id', $session_id)->get();
        return view('index', compact('history'));
    }
}
