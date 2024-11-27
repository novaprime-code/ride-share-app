<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $user->load('driver');

        return $user;
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|between:1900,2025',
            'make' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|alpha',
            'license_plate' => 'required|string',
            'name' => 'required|string',
        ]);
        $user = $request->user();
        $user->update($request->only('name'));
        $user->driver()->updateOrCreate($request->only([
            'year',
            'make',
            'model',
            'color',
            'license_plate',
        ]));

        $user->load('driver');
        return $user;
    }
}
