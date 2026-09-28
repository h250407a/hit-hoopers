<?php
/**
 * Database Connection & Initialization
 * ICS 2102: Web Development Mini Project - HIT Hoopers
 * 
 * Demonstrates:
 * - PHP Data Objects (PDO)
 * - Prepared statements for security
 * - Robust dual-mode database support:
 *   1. MySQL / MariaDB (standard for XAMPP & production hosting like InfinityFree)
 *   2. Automatic fallback to SQLite (zero-config local operation without database servers)
 */

function getDatabaseConnection() {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    // Database credentials (can be overridden via environment variables)
    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $port = getenv('DB_PORT') ?: '3306';
    $dbname = getenv('DB_NAME') ?: 'hit_hoopers';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';

    // Check if PDO MySQL driver is available and try connecting
    if (in_array('mysql', PDO::getAvailableDrivers())) {
        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => 2
            ]);
            initTable($pdo, 'mysql');
            return $pdo;
        } catch (PDOException $e) {
            // MySQL connection failed; fall back to SQLite
            error_log("MySQL connection failed (" . $e->getMessage() . "). Falling back to SQLite.");
        }
    }

    // Fallback to SQLite (works out of the box with zero configuration)
    $dataDir = __DIR__ . '/data';
    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0755, true);
    }
    $sqlitePath = $dataDir . '/hit_hoopers.sqlite';

    try {
        $pdo = new PDO("sqlite:" . $sqlitePath, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        initTable($pdo, 'sqlite');
        return $pdo;
    } catch (PDOException $e) {
        die("Fatal Database Error: Unable to establish database connection. " . htmlspecialchars($e->getMessage()));
    }
}

/**
 * Automatically creates the members table and seeds default data if empty.
 */
function initTable(PDO $pdo, string $driver) {
    if ($driver === 'mysql') {
        $sql = "CREATE TABLE IF NOT EXISTS members (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(100) NOT NULL,
            email VARCHAR(120) NOT NULL,
            student_id VARCHAR(50) NOT NULL,
            position VARCHAR(50) DEFAULT 'General Member',
            membership_type VARCHAR(50) DEFAULT 'Player',
            message TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    } else {
        $sql = "CREATE TABLE IF NOT EXISTS members (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            full_name TEXT NOT NULL,
            email TEXT NOT NULL,
            student_id TEXT NOT NULL,
            position TEXT DEFAULT 'General Member',
            membership_type TEXT DEFAULT 'Player',
            message TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );";
    }

    $pdo->exec($sql);

    // Seed sample member applications if table is completely empty
    $count = (int) $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();
    if ($count === 0) {
        $stmt = $pdo->prepare("INSERT INTO members (full_name, email, student_id, position, membership_type, message, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sampleMembers = [
            ['Tadiwa Moyo', 'tmoyo@hit.ac.zw', 'H230101A', 'Point Guard', 'Competitive Player', 'Excited for the upcoming inter-varsity games!', '2026-09-15 10:30:00'],
            ['Chipo Ndlovu', 'cndlovu@hit.ac.zw', 'H230205B', 'Shooting Guard', 'Competitive Player', 'Looking forward to weekend training sessions.', '2026-09-18 14:15:00'],
            ['Kudzai Marume', 'kmarume@hit.ac.zw', 'H240312C', 'Center', 'Social / Fitness', 'Want to stay active and learn basketball fundamentals.', '2026-09-22 09:00:00']
        ];
        foreach ($sampleMembers as $m) {
            $stmt->execute($m);
        }
    }
}
