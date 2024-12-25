<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define root path
define('ROOT_PATH', dirname(__DIR__));

// Include necessary files using absolute paths
require_once ROOT_PATH . '/app/config/database.php'; // Includes the database configuration
require_once ROOT_PATH . '/app/database.php'; // Includes the database functions
require_once ROOT_PATH . '/app/controllers/ClientController.php';
require_once ROOT_PATH . '/app/controllers/RendezVousController.php';

// Initialize database connection
$db = getConnection(); // Call the getConnection function from the included database configuration

// Start session if needed
session_start();

// Get action parameters
$action = $_GET['action'] ?? 'rendezvous';
$id = $_GET['id'] ?? null;
$subaction = $_GET['subaction'] ?? null;

// Start output buffering
ob_start();

try {
    // Include header first (with correct path)
    include ROOT_PATH . '/app/views/header.php';
    
    // Main routing logic
    switch ($action) {
        case 'clients':
            $controller = new ClientController($db);
            if ($subaction) {
                switch ($subaction) {
                    case 'create':
                        $controller->create();
                        break;
                    case 'edit':
                        if ($id) {
                            $client = $controller->getClient($id);
                            $controller->edit($client);
                        } else {
                            throw new Exception("ID client manquant");
                        }
                        break;
                    case 'delete':
                        if ($id) {
                            $controller->delete($id);
                            header('Location: index.php?action=clients');
                            exit();
                        }
                        break;
                    default:
                        $clients = $controller->getClients();
                        include ROOT_PATH . '/app/views/clients/index.php';
                }
            } else {
                $clients = $controller->getClients();
                include ROOT_PATH . '/app/views/clients/index.php';
            }
            break;

        case 'rendezvous':
        default:
            $controller = new RendezVousController($db);
            if ($subaction) {
                switch ($subaction) {
                    case 'create':
                        $controller->create();
                        break;
                    case 'edit':
                        if ($id) {
                            $rdv = $controller->getRendezVous($id);
                            $controller->edit($rdv);
                        } else {
                            throw new Exception("ID rendez-vous manquant");
                        }
                        break;
                    case 'delete':
                        if ($id) {
                            $controller->delete($id);
                            header('Location: index.php?action=rendezvous');
                            exit();
                        }
                        break;
                    default:
                        $rendezVous = $controller->getRendezVous();
                        include ROOT_PATH . '/app/views/rendezvous/index.php';
                }
            } else {
                $rendezVous = $controller->getRendezVous();
                include ROOT_PATH . '/app/views/rendezvous/index.php';
            }
    }

    // Get and clean the buffered content
    $content = ob_get_clean();
    
    // Output the content
    echo $content;
    
    // Include footer
    include ROOT_PATH . '/app/views/footer.php';
    
} catch (Exception $e) {
    ob_end_clean();
    echo "Une erreur est survenue : " . $e->getMessage();
}
