<?php
class ClientController {
    private $client;

    public function __construct($db) {
        $this->client = new Client($db);
    }

    public function index() {
        $clients = $this->client->read();
        include ROOT_PATH . '/app/views/clients/index.php';
    }

    public function getClients() {
        return $this->client->read();
    }

    public function getClient($id) {
        $this->client->id = $id;
        return $this->client->readOne();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->client->nom = $_POST['nom'];
            $this->client->prenom = $_POST['prenom'];
            $this->client->email = $_POST['email'];
            $this->client->telephone = $_POST['telephone'];

            if ($this->client->create()) {
                header('Location: index.php?action=clients');
                exit();
            }
        }
        include ROOT_PATH . '/app/views/clients/create.php';
    }

    public function edit($id) {
        // S'assurer que l'id est un entier
        $id = intval($id);
        
        // Récupérer les données du client avant tout traitement
        $this->client->id = $id;
        $client = $this->client->readOne();
        
        if (!$client) {
            header('Location: index.php?action=clients');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->client->id = $id;
            $this->client->nom = $_POST['nom'];
            $this->client->prenom = $_POST['prenom'];
            $this->client->email = $_POST['email'];
            $this->client->telephone = $_POST['telephone'];
    
            if ($this->client->update()) {
                header('Location: index.php?action=clients');
                exit();
            }
        }
        
        // Passer les données à la vue
        include ROOT_PATH . '/app/views/clients/edit.php';
    }

    public function delete($id) {
        $this->client->id = $id;
        if ($this->client->delete()) {
            header('Location: index.php?action=clients');
            exit();
        }
    }
}