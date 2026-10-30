<?php

namespace App\Http\Controllers;

use App\Models\Residents;
use Illuminate\Http\Request;

class ResidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAccount()
    {
        return view()
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',


        ])
    }

    /**
     * Display the specified resource.
     */
    public function show(Residents $residents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Residents $residents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Residents $residents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Residents $residents)
    {
        //
    }
}
