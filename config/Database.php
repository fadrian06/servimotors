<?php

/** Clase para gestionar la conexión a la base de datos */
final class Database
{
    private static ?PDO $pdo = null;

    /** Método para obtener la conexión */
    static function getConnection(): PDO
    {
        require_once __DIR__ . '/environment.php';

        $_ENV['DB_CONNECTION'] ??= 'mysql';
        $_ENV['DB_HOST'] ??= 'localhost';
        $_ENV['DB_DATABASE'] ??= 'servimotorsdavila';
        $_ENV['DB_USERNAME'] ??= 'root';
        $_ENV['DB_PASSWORD'] ??= '';

        if (!self::$pdo) {
            try {
                /** Crear una instancia de PDO para conectarse a la base de datos */
                self::$pdo = self::getSqliteConnection()
                    ?? self::getMysqlConnection()
                    ?? throw new Exception('Unsupported database connection');

                // Configurar el modo de error para que use excepciones
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                // Mostrar un mensaje en caso de error
                exit("Connection error: {$exception->getMessage()}");
            }
        }

        return self::$pdo; // Devolver la conexión
    }

    static function getSqliteConnection(): ?PDO
    {
        return $_ENV['DB_CONNECTION'] === 'sqlite'
            ? new PDO("sqlite:{$_ENV['DB_DATABASE']}")
            : null;
    }

    static function getMysqlConnection(): ?PDO
    {
        return $_ENV['DB_CONNECTION'] === 'mysql'
            ? new PDO(
                "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}",
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD']
            )
            : null;
    }
}
