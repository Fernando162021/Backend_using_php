<?php

    require_once "Connection.php";

    class CRUD {
        public static function get_dueño_autos() {
            $db = new Connection();
            $query_dueños = "SELECT * FROM dueño";
            $resultado_dueños = $db->query($query_dueños);
            $arr_dueños_autos = array();

            if ($resultado_dueños->num_rows) {
                while ($row_dueño = $resultado_dueños->fetch_assoc()) {
                    $query_autos = "SELECT a.id, a.marca, a.modelo, a.año, a.no_serie 
                                    FROM auto a 
                                    INNER JOIN dueño_auto da ON a.id = da.id_auto 
                                    WHERE da.id_dueño = " . $row_dueño['id'];

                    $resultado_autos = $db->query($query_autos);
                    $arr_autos = array();

                    if ($resultado_autos->num_rows) {
                        while ($row_auto = $resultado_autos->fetch_assoc()) {
                            $arr_autos[] = array(
                                'id' => $row_auto['id'],
                                'marca' => $row_auto['marca'],
                                'modelo' => $row_auto['modelo'],
                                'año' => $row_auto['año'],
                                'no_serie' => $row_auto['no_serie']
                            );
                        }
                    }

                    $arr_dueños_autos[] = array(
                            'dueño' => array(
                            'id' => $row_dueño['id'],
                            'nombre' => $row_dueño['nombre'],
                            'email' => $row_dueño['email'],
                        ),
                        'autos' => $arr_autos
                    );
                }
            }

        return $arr_dueños_autos;
    }        

        public static function insert($nombre, $email) {
            $db = new Connection();
            $query = "INSERT INTO dueño (nombre, email) 
            VALUES ('" . $nombre . "', '" . $email . "')";
            $db->query($query);
            if ($db->affected_rows) {
                return TRUE;
            }
            return FALSE;
        }

        public static function update($id, $nombre, $email) {
            $db = new Connection();
            $query = "UPDATE dueño 
            SET nombre='" . $nombre . "', email='" . $email . "' 
            WHERE id=" . $id; 
            $db->query($query);
            if ($db->affected_rows) {
                return TRUE;
            }
            return FALSE;
        }

        public static function delete($id_dueño) {
            $db = new Connection();
            $query = "DELETE FROM dueño WHERE id = $id_dueño";
            $db->query($query);
            if ($db->affected_rows) {
                return TRUE;
            }
            return FALSE;
        }
    }

?>