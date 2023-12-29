<?php

namespace App\Http\Controllers\firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FireBaseController extends Controller
{
    public function __invoke()
    {
        
    }
    public function index()
    {
        $firebase = (new Factory)
        ->withServiceAccount(__DIR__.'/../fit-reducer-395622-firebase-adminsdk-pgfv0-63bdd7866d.json')
        ->withDatabaseUri('https://fit-reducer-395622-default-rtdb.firebaseio.com/');

        $database = $firebase->createDatabase();
        $reference = $database->getReference(); // Retrieve reference to the root of the database
    
        $data = $reference->getValue(); // Fetch data from the entire database
    
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
