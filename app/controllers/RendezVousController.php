<?php
require_once ROOT_PATH . '/app/models/RendezVous.php';
require_once ROOT_PATH . '/app/models/Client.php';

class RendezVousController {
    private $rendezVous;
    private $client;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->rendezVous = new RendezVous($db);
        $this->client = new Client($db);
    }

    public function getRendezVous($id = null) {
        if ($id) {
            $this->rendezVous->id = $id;
            return $this->rendezVous->readOne();
        }
        return $this->rendezVous->read();
    }

    public function create() {
        $clients = $this->client->read();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->rendezVous->date = $_POST['date'];
            $this->rendezVous->heure = $_POST['heure'];
            $this->rendezVous->description = $_POST['description'];
            $this->rendezVous->client_id = $_POST['client_id'];

            if ($this->rendezVous->create()) {
                header('Location: index.php?action=rendezvous');
                exit();
            }
        }
        include ROOT_PATH . '/app/views/rendezvous/create.php';
    }
    public function edit($id) {
        // Charger tous les clients pour le formulaire (si nécessaire)
        $clients = $this->client->read();
        $id = intval($id);
        
        // Récupérer les détails du rendez-vous à éditer
        $this->rendezVous->id = $id;
        $rdv = $this->rendezVous->readOne();
    
        // Vérifier si un rendez-vous est trouvé
        if (!$rdv) {
            echo "<div class='alert alert-danger'>Aucun rendez-vous trouvé pour cet ID.</div>";
            exit; // Arrête l'exécution si aucun rendez-vous n'est trouvé
        }
    
        // Traitement du formulaire POST (soumission du formulaire)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Valider les données reçues
            $this->rendezVous->date = $_POST['date'] ?? null;
            $this->rendezVous->heure = $_POST['heure'] ?? null;
            $this->rendezVous->description = $_POST['description'] ?? null;
            $this->rendezVous->client_id = $_POST['client_id'] ?? null;
    
            // Vérifier que tous les champs nécessaires sont renseignés
            if (empty($this->rendezVous->date) || empty($this->rendezVous->heure) || empty($this->rendezVous->client_id)) {
                echo "<div class='alert alert-danger'>Veuillez remplir tous les champs obligatoires.</div>";
            } else {
                // Tenter la mise à jour
                if ($this->rendezVous->update()) {
                    header('Location: index.php?action=rendezvous');
                    exit(); // Redirige après la mise à jour réussie
                } else {
                    echo "<div class='alert alert-danger'>Une erreur s'est produite lors de la mise à jour du rendez-vous.</div>";
                }
            }
        }
    
        // Charger la vue d'édition avec les données du rendez-vous et des clients
        include ROOT_PATH . '/app/views/rendezvous/edit.php';
    }
    
    
    

    public function delete($id) {
        $this->rendezVous->id = $id;
        if ($this->rendezVous->delete()) {
            header('Location: index.php?action=rendezvous');
            exit();
        }
    }
}