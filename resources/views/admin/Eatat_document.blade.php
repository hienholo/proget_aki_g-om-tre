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
    .checkbox-inline {
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
  <button class="btn d-block d-md-none mb-3" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
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
    <a href="{{ route('Modifier_client') }}" id="modifierClient" class="sidebar-link"><i class="fas fa-edit"></i> Modifier Client</a>
    <a href="#" id="desactiverClient" class="sidebar-link"><i class="fas fa-user-times"></i> Désactiver Client</a>
    <a href="{{ route('Ajout_document') }}" id="ajoutDocument" class="sidebar-link"><i class="fas fa-file-upload"></i> Ajout Document</a>
    <a href="{{ route('Eatat_document') }}" id="etatDocument" class="sidebar-link active"><i class="fas fa-file-alt"></i> État Document</a>
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

  <div class="card mb-2 p-3" style="margin-top: 5%; max-width: 500px; margin-left: auto; margin-right: auto;">
    <div class="card-header m-3">
      Modifier l'état d'un document
    </div>
    <form> 
      <div class="form-group">
        <label for="clientSelect">Le client</label>
        <select class="form-control select2" id="clientSelect" required>
          <option value="" disabled selected>Sélectionnez un client</option>
          <option value="1">Holo</option>
          <option value="2">AKI</option>
          <!-- Ajoutez d'autres options de clients ici -->
        </select>
      </div>
    
      <div class="form-group">
        <label for="clientSelect">Type de document</label>
        <select class="form-control select2" id="clientSelect" required>
          <option value="" disabled selected>Sélectionnez un client</option>
          <option value="1">l'Attestation villageoise</option>
          <option value="2">La Cession </option>
          <option value="3">Le Compulsoire </option>
          <option value="4">Les Dossier Techniques </option>
          <option value="5">L'A.C.D </option>
        </select>
      </div>
    
      <div class="form-group">
        <label for="documentState">État du document</label>
        <select class="form-control select2" id="documentState" required>
          <option value="" disabled selected>Sélectionnez l'état du document</option>
          <option value="valide">Validé</option>
          <option value="enCours">En cours</option>
          <option value="aFaire">À faire</option>
        </select>
      </div>
    
      <div class="form-group">
        <label for="fileUpload">Télécharger un document</label>
        <input type="file" class="form-control-file" id="fileUpload" accept=".pdf,.png,.jpg,.jpeg" required>
      </div>
    
      <button type="submit" class="btn btn-primary btn-block">Ajouter le document</button>
    </form>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  // Fonction pour gérer la classe active
  function setActiveLink(linkId) {
    // Supprimer la classe active de tous les liens
    document.querySelectorAll('.sidebar-link').forEach(link => {
      link.classList.remove('active');
    });
    // Ajouter la classe active au lien cliqué
    document.getElementById(linkId).classList.add('active');
  }

  // Ajouter des écouteurs d'événements aux liens
  document.querySelectorAll('.sidebar-link').forEach(link => {
    link.addEventListener('click', function() {
      setActiveLink(this.id);
    });
  });
</script>
</body>
</html>
