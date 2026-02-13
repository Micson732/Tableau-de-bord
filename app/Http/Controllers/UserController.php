<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     */
    // public function store(Request $request)
    // {
    //     // Validation des données
    //     $data = array();
    //     $data['name'] = $request -> name;
    //     $data['email'] = $request -> email;


    //     if($request->password != $request->password_confirmation){

    //         return redirect()-> back();

    //     }
    //     else
    //     {
    //         $data['password'] = Hash::make($request -> password);

    //         $user = User::create($data);

    //         return redirect()-> route('user.index')->with('message', 'User Added successfully!!!');
    //     }
                
    // }

//     public function store(Request $request)
// {
//     // Validation des données
//     $data = array();
//     $data['name'] = $request->name;
//     $data['email'] = $request->email;

//     if($request->password != $request->password_confirmation) {
//         return redirect()->back()->with('error', 'Les mots de passe ne correspondent pas.');
//     }
//     else
//     {
//         $data['password'] = Hash::make($request->password);

//         // Création de l'utilisateur
//         $user = User::create($data);

//         // Attribution des rôles si des rôles sont sélectionnés
//         if($request->has('roles')) {
//             $user->syncRoles($request->roles);
//         }

//         return redirect()->route('user.index')
//             ->with('success', 'Utilisateur ajouté avec succès !!!');
//     }
// }

    public function store(Request $request)
    {
        // Validation des données
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'sometimes|array',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Attribution des rôles si des rôles sont sélectionnés
        if (!empty($data['roles'])) {
            // Synchronisation manuelle des rôles avec model_type
            foreach ($data['roles'] as $roleName) {
                $role = \Spatie\Permission\Models\Role::where('name', $roleName)->first();
                if ($role) {
                    $user->roles()->attach($role->id, ['model_type' => get_class($user)]);
                }
            }
        }

        return redirect()->route('user.index')
            ->with('success', 'Utilisateur ajouté avec succès !!!');
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
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('dashboard.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Mise à jour des informations de base
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Mise à jour du mot de passe si fourni
        if (!empty($request->password)) {
            if ($request->password === $request->password_confirmation) {
                $user->password = Hash::make($request->password);
            } else {
                return redirect()->back()->with('error', 'Les mots de passe ne correspondent pas.');
            }
        }
        
        $user->save();
        
        // Synchronisation manuelle des rôles
        if ($request->has('roles')) {
            // D'abord, supprimer tous les rôles actuels
            $user->roles()->detach();
            
            // Ensuite, ajouter les nouveaux rôles avec le model_type correct
            foreach ($request->roles as $roleName) {
                $role = Role::where('name', $roleName)->first();
                if ($role) {
                    $user->roles()->attach($role->id, ['model_type' => get_class($user)]);
                }
            }
        } else {
            $user->roles()->detach();
        }
        
        return redirect()->route('user.index')
            ->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     * 
     */
    public function destroy(string $id)
    {
        $user=User::where('id', $id)->delete();
        return redirect()->route('user.index')
            ->with('Warning', 'User Delete successfully!');

    }

    
}
