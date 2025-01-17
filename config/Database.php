<?php

/** Clase para gestionar la conexión a la base de datos */
final class Database
{
    private const SUPPORTED_DB_CONNECTIONS = [
        'sqlite' => 'sqlite',
        'mysql' => 'mysql'
    ];

    private static ?PDO $pdo = null;

    /** Método para obtener la conexión */
    static function getConnection(): ?PDO
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
                if ($_ENV['DB_CONNECTION'] === self::SUPPORTED_DB_CONNECTIONS['sqlite']) {
                    self::$pdo = new PDO("sqlite:{$_ENV['DB_DATABASE']}");
                } elseif ($_ENV['DB_CONNECTION'] === self::SUPPORTED_DB_CONNECTIONS['mysql']) {
                    self::$pdo = new PDO(
                        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}",
                        $_ENV['DB_USERNAME'],
                        $_ENV['DB_PASSWORD']
                    );
                }

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
}
