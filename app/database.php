<?php
// Configuration de la base de données
$config = [
    'host' => 'localhost',
    'dbname' => 'gestion_rdv',
    'username' => 'root',
    'password' => 'Passer123'
];

// Fonction pour établir une connexion à la base de données
function getConnection() {
    global $config;  // Accéder à la configuration définie au-dessus
    
    try {
        // Connexion avec PDO
        $conn = new PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
            $config['username'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        
        // Retourner l'objet de connexion
        return $conn;
    } catch (PDOException $e) {
        // Si une exception est lancée, afficher le message d'erreur
        die("Erreur de connexion: " . $e->getMessage());
    }
}
?>
