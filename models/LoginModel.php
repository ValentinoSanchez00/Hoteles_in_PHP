<?php

include 'db/DB.php';

class LoginModel {

    private $bd;
    private $pdo;

    public function __construct() {
        try {
            // Crear una instancia de la clase DB para manejar la conexión a la base de datos.
            $this->bd = new DB();
            // Obtener el objeto PDO de la instancia de DB.
            $this->pdo = $this->bd->getPDO();

            // Verificar si la conexión a la base de datos fue exitosa.
            if (!$this->pdo) {
                throw new Exception("Error inesperado al conectar a la base de datos.");
            }
        } catch (Exception $exc) {
            // Manejar cualquier excepción durante la inicialización del modelo.
            echo $exc->getMessage();
        }
    }

    /**
     * Comprueba las credenciales del usuario en la base de datos.
     * @param string $usuario Nombre de usuario.
     * @param string $password Contraseña del usuario.
     * @return array|false Retorna un array asociativo con los datos del usuario si la autenticación es exitosa, de lo contrario, retorna false.
     */
    public function comprobarUsuario($usuario, $password) {
        try {
            // Preparar la consulta SQL utilizando parámetros para evitar SQL injection.
            $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE nombre = :nombre AND contraseña = :password');
            
            // Asignar valores a los parámetros.
            $stmt->bindParam(':nombre', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);

            // Ejecutar la consulta.
            $stmt->execute();

            // Verificar si se encontró algún usuario.
            if ($stmt->rowCount() > 0) {
                // Obtener y devolver los datos del usuario como un array asociativo.
                foreach ($stmt as $user) {
                    return $user;
                }
            } else {
                // Si no se encuentra el usuario, retornar false.
                return false;
            }
        } catch (Exception $exc) {
            // Manejar cualquier excepción durante la ejecución de la consulta.
            echo "Error al comprobar el usuario en el modelo.";
        }
    }
}
