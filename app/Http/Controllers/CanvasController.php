<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
use \App\Room;

class CanvasController extends Controller
{
    public function test() {

        JavaScript::put([
           'testname' => 'Hello World'
        ]);

        return view('canvas');
    }
}
