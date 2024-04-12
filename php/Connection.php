<?php

    class Connection extends Mysqli {
        function __construct() {
            parent::__construct('localhost', 'sysAdmin', 'oERzNfsYtJqdTKzG', 'venta_de_autos');
            $this->set_charset('utf8');
            $this->connect_error == NULL ? 'Conexión exitosa a la DB' : die('Error al conectarse a la DB');
        }
    }

?>