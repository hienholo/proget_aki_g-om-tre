<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    // Afficher le formulaire pour ajouter un client
    public function create()
    {
        return view('client.create');  // Retourne la vue du formulaire d'ajout de client
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'phone_whatsapp' => 'required|string|max:20',
            'email' => 'required|email|unique:clients',
            'mot_de_passe' => 'required|string|min:6',
            'sexe' => 'required',
            'nature_piece' => 'required|string|max:255',
            'numero_piece' => 'required|string|max:255',
            'lieu_edition' => 'required|string|max:255',
            'date_edition' => 'required|date',
            'date_expiration' => 'required|date',
            'structure_de_conception' => 'nullable|string|max:255',
            'photo_piece_recto' => 'required|image|max:2048', // Recto optionnel
            'photo_piece_verso' => 'nullable|image|max:2048', // Verso optionnel
        ]);


    
        // Créer un nouveau client
        $client = new Client();
        $client->nom = $request->nom;
        $client->prenoms = $request->prenoms;
        $client->phone_whatsapp = $request->phone_whatsapp;
        $client->email = $request->email;
        $client->mot_de_passe = bcrypt($request->mot_de_passe);
        $client->sexe = $request->sexe;
        $client->nature_piece = $request->nature_piece;
        $client->numero_piece  = $request->numero_piece;
        $client->lieu_edition = $request->lieu_edition;
        $client->date_edition = $request->date_edition;
        $client->date_expiration = $request->date_expiration;
        $client->structure_de_conception = $request->structure_de_conception;
    
        // Gérer l'upload des photos recto et verso
        $photos = [];
    
        if ($request->hasFile('photo_piece_recto')) {
            $pathRecto = $request->file('photo_piece_recto')->store('public/photos');
            $photos['recto'] = $pathRecto;
        }

    
        if ($request->hasFile('photo_piece_verso')) {
            $pathVerso = $request->file('photo_piece_verso')->store('public/photos');
            $photos['verso'] = $pathVerso;
        }
    
        // Stocker les chemins sous forme de JSON dans la colonne photo_piece
        $client->photo_piece = json_encode($photos);
    
        $client->save();  // Enregistrer le client dans la base de données
    
        return redirect()->route('Liste_client')->with('success', 'Client ajouté avec succès!');
    }
    public function edit()
    {
        
        // Récupérer tous les clients pour les afficher dans le select
        $clients = Client::all();
        return view('admin.modifier_client', compact('clients'));
    }

    public function update(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'phone_whatsapp' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sexe' => 'required|string|max:1',
            'nature' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'lieu_edition' => 'required|string|max:255',
            'date_edition' => 'required|date',
            'date_expiration' => 'required|date',
            'photo_piece_recto' => 'nullable|image',
            'photo_piece_verso' => 'nullable|image',
        ]);

        // Récupérer le client et mettre à jour les informations
        $client = Client::find($request->client_id);

        if (!$client) {
            return redirect()->back()->withErrors(['Client non trouvé']);
        }

        $client->update($request->only([
            'nom', 'prenoms', 'phone_whatsapp', 'email', 'sexe', 'nature', 'numero', 
            'lieu_edition', 'date_edition', 'date_expiration'
        ]));

        // Gérer la mise à jour des photos
        if ($request->hasFile('photo_piece_recto') && $request->hasFile('photo_piece_verso')) {
            $rectoPath = $request->file('photo_piece_recto')->store('clients/photos', 'public');
            $versoPath = $request->file('photo_piece_verso')->store('clients/photos', 'public');
            $client->photo_piece = json_encode(['recto' => $rectoPath, 'verso' => $versoPath]);
        }

        $client->save();

        return redirect()->route('clients.edit')->with('success', 'Informations client mises à jour avec succès.');
    }

}
