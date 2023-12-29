<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use  Kreait\Firebase\Contract\Database;

class UserController extends Controller
{


    public $database;
    public $refTableName;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->refTableName = 'users';
    }

    public function index()
    {
        $users = $this->database->getReference($this->refTableName)->getValue();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validation rules for creating a user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
        ]);


        $postData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ];

        $postRef = $this->database->getReference($this->refTableName)->push($postData);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($key)
    {
        $userReference = $this->database->getReference($this->refTableName)->getChild($key);
        $userSnapshot = $userReference->getSnapshot();
        $user = $userSnapshot->getValue();
    
        return view('users.edit', compact('user', 'key')); // Pass both $user and $key to the view
    }
    
    
    public function update(Request $request, $key)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        // Find the user by ID
        $postData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ];

        $postRef = $this->database->getReference($this->refTableName .'/' . $key)->update($postData);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($key)
    {
        $userReference = $this->database->getReference($this->refTableName)->getChild($key);
        
        // Remove the node
        $userReference->remove();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
