
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord Admin</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="{{asset('style_table.css')}}">
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
    <a href="{{ route('Liste_client') }}" id="listeClients"  class="sidebar-link active"><i class="fas fa-list"></i> Liste des Clients</a>
    {{-- <div id="clientList" class="collapse">
      <a href="#acdValide" class="pl-4"><i class="fas fa-check-circle"></i> ACD Validé</a>
      <a href="#acdEnCours" class="pl-4"><i class="fas fa-clock"></i> ACD en Cours</a>
    </div> --}}
    <a href="{{ route('Modifier_client') }}" id="modifierClient" class="sidebar-link"><i class="fas fa-edit"></i> Modifier Client</a>
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

  
  <div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>User <b>Management</b></h2>
                    </div>
                    <div class="col-sm-7">
                        <a href="#" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
                        <a href="#" class="btn btn-secondary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>						
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>						
                        <th>Date Created</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>3</td>
                        <td><a href="#"><img src="/examples/images/avatar/3.jpg" class="avatar" alt="Avatar"> Antonio Moreno</a></td>
                        <td>11/05/2015</td>
                        <td>Publisher</td>
                        <td><span class="status text-danger">&bull;</span> Suspended</td>                        
                        <td>
                            <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                            <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                        </td>                        
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><a href="#"><img src="/examples/images/avatar/4.jpg" class="avatar" alt="Avatar"> Mary Saveley</a></td>
                        <td>06/09/2016</td>
                        <td>Reviewer</td>
                        <td><span class="status text-success">&bull;</span> Active</td>
                        <td>
                            <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                            <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><a href="#"><img src="/examples/images/avatar/5.jpg" class="avatar" alt="Avatar"> Martin Sommer</a></td>
                        <td>12/08/2017</td>                        
                        <td>Moderator</td>
                        <td><span class="status text-warning">&bull;</span> Inactive</td>
                        <td>
                            <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                            <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                        </td>
                    </tr>      
                </tbody>
            </table>
        </div>
    </div>
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
