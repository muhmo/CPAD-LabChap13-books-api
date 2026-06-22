<?php
namespace App;
use PDO;
use PDOException;
final class Database
{
 private static ?PDO $pdo = null;
 public static function get(): PDO
 {
 if (self::$pdo) return self::$pdo;
 $dsn = sprintf(
 'mysql:host=%s;port=%s;dbname=%s;charset=%s',
 Env::get('DB_HOST', '127.0.0.1'),
 Env::get('DB_PORT', '3306'),
 Env::get('DB_NAME', 'books_api'),
 Env::get('DB_CHARSET', 'utf8mb4')
 );
 try {
 self::$pdo = new PDO($dsn, Env::get('DB_USER', 'root'), Env::get('DB_PASS', ''), [
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 PDO::ATTR_EMULATE_PREPARES => false,
 ]);
 } catch (PDOException $e) {
 error_log('[DB] ' . $e->getMessage());
 throw new \RuntimeException('Database connection failed', 500, $e);
 }
 return self::$pdo;
 }
}