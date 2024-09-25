<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #3b5998;
            padding-top: 20px;
        }

        .sidebar .sidebar-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar-header img {
            width: 80px;
            margin-bottom: 10px;
        }

        .sidebar a {
            padding: 15px;
            display: block;
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #575fcf;
        }

        .sidebar a.active {
            background-color: #575fcf;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            background-color: #ffffff;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            margin-top: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ffffff;
            font-weight: bold;
            font-size: 1.2em;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: none;
        }

        .radio-inline {
            margin-right: 10px;
        }

        .input-group-prepend img {
            width: 20px;
            margin-right: 5px;
        }

        .flag-select {
            display: flex;
            align-items: center;
        }

        .flag-select img {
            width: 20px;
            margin-right: 5px;
        }

        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .whatsapp-icon {
            width: 20px;
            height: 20px;
            color: #25D366;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }

        @media (min-width: 769px) {
            .content {
                margin-left: 250px;
                padding: 20px;
            }
        }

        /* Centering content */
        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <img src="/profile.jpg" alt="Profile" class="rounded-circle">
            <div>Allen Moreno</div>
            <div>Admin</div>
        </div>

        <!-- Icône de menu en mode téléphone -->
        <button class="btn d-block d-md-none mb-3" type="button" data-toggle="collapse" data-target="#sidebarMenu"
            aria-expanded="false" aria-controls="sidebarMenu" title="Menu">
            <i class="fas fa-bars fa-2x text-white"></i>
        </button>

        <!-- Menu qui se cache en mode téléphone -->
       <div class="collapse d-md-block" id="sidebarMenu">
            <a href="{{ route('home') }}" id="ajoutClient" class="sidebar-link "><i class="fas fa-user-plus"></i> Ajout Client</a>
            <a href="{{ route('Liste_client') }}" id="listeClients"  class="sidebar-link"><i class="fas fa-list"></i> Liste des Clients</a>
            {{-- <div id="clientList" class="collapse">
            <a href="#acdValide" class="pl-4"><i class="fas fa-check-circle"></i> ACD Validé</a>
            <a href="#acdEnCours" class="pl-4"><i class="fas fa-clock"></i> ACD en Cours</a>
            </div> --}}
            <a href="{{ route('Modifier_client') }}" id="modifierClient" class="sidebar-link active"><i class="fas fa-edit"></i> Modifier Client</a>
            <a href="#" id="desactiverClient" class="sidebar-link"><i class="fas fa-user-times"></i> Désactiver Client</a>
            <a href="{{ route('Ajout_document') }}" id="ajoutDocument" class="sidebar-link"><i class="fas fa-file-upload"></i> Ajout Document</a>
            <a href="{{ route('Eatat_document') }}" id="etatDocument" class="sidebar-link"><i class="fas fa-file-alt"></i> État Document</a>
        </div>
    </div>

    <div class="content">
        <nav class="navbar">
            <span>M.  est connecté</span>
            <div class="ml-auto">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Se déconnecter
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
            </div>
        </nav>

        <div class="container mt-5">
            <h2>Modifier un Client</h2>

            <!-- Afficher un message de succès -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Sélection du client à modifier -->
            <form id="select-client-form">
                <div class="form-group">
                    <label for="client_id">Sélectionner un client :</label>
                    <select class="form-control" id="client_id" name="client_id" onchange="fetchClientDetails()">
                        <option value="">-- Sélectionner un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenoms }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <!-- Formulaire de modification -->
            <form id="edit-client-form" action="{{ route('clients.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="client_id_hidden" name="client_id">
                
                <!-- Étape 1 : Informations Client -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prenoms">Prénoms :</label>
                            <input type="text" class="form-control" id="prenoms" name="prenoms" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_whatsapp">Numéro WhatsApp :</label>
                            <input type="text" class="form-control" id="phone_whatsapp" name="phone_whatsapp" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sexe">Sexe :</label>
                            <select class="form-control" id="sexe" name="sexe" required>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nature">Nature de la pièce :</label>
                            <input type="text" class="form-control" id="nature" name="nature" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="numero">Numéro de la pièce :</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lieu_edition">Lieu d'édition :</label>
                            <input type="text" class="form-control" id="lieu_edition" name="lieu_edition" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_edition">Date d'édition :</label>
                            <input type="date" class="form-control" id="date_edition" name="date_edition" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_expiration">Date d'expiration :</label>
                            <input type="date" class="form-control" id="date_expiration" name="date_expiration" required>
                        </div>
                    </div>
                </div>

                <!-- Étape 2 : Informations sur la pièce d'identité -->
                <h4 class="mt-4">Informations de la pièce d'identité</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo_piece_recto">Photo de la pièce (Recto) :</label>
                            <input type="file" class="form-control-file" id="photo_piece_recto" name="photo_piece_recto">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo_piece_verso">Photo de la pièce (Verso) :</label>
                            <input type="file" class="form-control-file" id="photo_piece_verso" name="photo_piece_verso">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Gestion du menu sidebar
            $('.sidebar-link').click(function () {
                $('.sidebar-link').removeClass('active');
                $(this).addClass('active');
            });

            // Ouvrir le sous-menu pour Liste des Clients
            $('#listeClients').click(function () {
                $('#clientList').collapse('toggle');
            });
        });

        function fetchClientDetails() {
        var clientId = $('#client_id').val();

        if (clientId) {
            $.ajax({
                url: `/api/clients/${clientId}`,
                type: 'GET',
                success: function(response) {
                    $('#client_id_hidden').val(response.id);
                    $('#nom').val(response.nom);
                    $('#prenoms').val(response.prenoms);
                    $('#phone_whatsapp').val(response.phone_whatsapp);
                    $('#email').val(response.email);
                    $('#sexe').val(response.sexe);
                    $('#nature').val(response.nature);
                    $('#numero').val(response.numero);
                    $('#lieu_edition').val(response.lieu_edition);
                    $('#date_edition').val(response.date_edition);
                    $('#date_expiration').val(response.date_expiration);

                    // Manipuler les photos
                    if (response.photo_piece) {
                        var photos = JSON.parse(response.photo_piece);
                        // Vous pouvez afficher les images actuelles ici si nécessaire
                    }
                }
            });
        }
    }
    </script>

</body>

</html>
