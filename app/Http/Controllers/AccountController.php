<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\User;

class AccountController extends Controller
{
    public function myAccount()
    {
        $user = auth()->user();

        // Sessões do usuário
        $sessions = DB::table('sessions')
            ->where('user_id', $user->id)
            ->get();

        return view('account.profile', [
            'user' => $user,
            'sessions' => $sessions,
        ]);
    }


    


    public function updateProfile(Request $request)
    {
        $user = auth()->user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Valida a imagem
        ]);
    
        // Verifica se o usuário enviou uma nova foto de perfil
        if ($request->hasFile('profile_picture')) {
            // Remove a foto antiga (se houver)
            if ($user->profile_picture && file_exists(public_path('uploads/profile_pictures/' . $user->profile_picture))) {
                unlink(public_path('uploads/profile_pictures/' . $user->profile_picture));
            }
    
            // Processa a nova foto de perfil
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_pictures'), $imageName);
    
            // Atualiza o campo profile_picture no banco
            $user->profile_picture = $imageName;
        }
    
        // Atualiza os outros campos (nome e email)
        $user->update($request->only('name', 'email'));

        // Atualiza a sessão do usuário com a nova foto
        auth()->user()->profile_picture = $user->profile_picture;
    
        return redirect()->back()->with('msg', 'Perfil atualizado com sucesso!');
    }}
