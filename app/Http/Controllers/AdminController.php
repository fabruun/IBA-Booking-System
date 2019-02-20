<?php

namespace App\Http\Controllers;

use App\Rekvirent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(Auth::check()){
            $rekvirents = \App\Rekvirent::all()->sortBy('rekvirentid');
            return view('admin.index', compact('rekvirents'));
        }
        return redirect('/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Rekvirent $rekvirent)
    {
        Rekvirent::create([
            'uid' => request('uid'),
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password')
        ]);
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rekvirent $rekvirent)
    {
        return view('admin.show', compact('rekvirent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekvirent $rekvirent)
    {
        return view('admin.edit', compact('rekvirent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Rekvirent $rekvirent)
    {
        $rekvirent->rekvirent = request('rekvirent');

        $rekvirent->save();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekvirent $rekvirent)
    {
        $rekvirent->delete();
        return redirect('admin');
    }
}
