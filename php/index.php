<?php
    require_once "CRUD.php";

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            echo json_encode(CRUD::get_dueño_autos());
            break;
        
        case 'POST':
            $datos = json_decode(file_get_contents('php://input'));
            if ($datos != NULL) {
                if (CRUD::insert($datos->nombre, $datos->email, $datos->estado)) {
                    http_response_code(200);
                }
                else {
                    http_response_code(400);
                }
            }
            else {
                http_response_code(405);
            }
            break;

        case 'PUT':
            $datos = json_decode(file_get_contents('php://input'));
            if ($datos != NULL) {
                if (CRUD::update($datos->id, $datos->nombre, $datos->email, $datos->estado)) {
                    http_response_code(200);
                }
                else {
                    http_response_code(400);
                }
            }
            else {
                http_response_code(405);
            }
            break;
        
        case 'DELETE':
            if(isset($_GET['id'])){
                if(CRUD::delete($_GET['id'])) {
                    http_response_code(200);
                }
                else {
                    http_response_code(400);
                }
            } 
            else {
                http_response_code(405);
            }
            break;

        default:
            http_response_code(405);
            break;
    }

?>