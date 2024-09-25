<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class userController extends Controller
{
 
 // returne view dashbord
    

    
    public function connextion(): View
    {
        return view('auth.login');
    }

    
    public function enregistrement(): View
    {
        return view('auth.register');
    }
    
    public function logout(Request $request)
        {
            Auth::logout();

            // Invalidate the session and regenerate the CSRF token
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Rediriger vers la page de login ou d'accueil après la déconnexion
            return redirect('/login');
        }
}
