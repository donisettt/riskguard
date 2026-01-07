<?php

require_once 'app/core/AuthMiddleware.php';
require_once 'config/Database.php';

class SettingsController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index()
    {
        AuthMiddleware::isAdmin();

        $title = "Pengaturan Sistem";

        // Get last backup info
        $lastBackupFile = 'public/uploads/.last_backup';
        $lastBackup = '-';
        if (file_exists($lastBackupFile)) {
            $backupTime = file_get_contents($lastBackupFile);
            if ($backupTime) {
                date_default_timezone_set('Asia/Jakarta');
                $lastBackup = date('d M Y, H:i', strtotime($backupTime));
            }
        }

        // Include layout
        include 'app/views/layouts/header.php';
        include 'app/views/settings/index.php';
        include 'app/views/layouts/footer.php';
    }

    public function exportDatabase()
    {
        AuthMiddleware::isAdmin();

        try {
            $database = new Database();

            // Get database credentials
            $reflection = new ReflectionClass($database);
            $host = $reflection->getProperty('host');
            $host->setAccessible(true);
            $user = $reflection->getProperty('user');
            $user->setAccessible(true);
            $pass = $reflection->getProperty('pass');
            $pass->setAccessible(true);
            $db_name = $reflection->getProperty('db_name');
            $db_name->setAccessible(true);

            $hostValue = $host->getValue($database);
            $userValue = $user->getValue($database);
            $passValue = $pass->getValue($database);
            $dbNameValue = $db_name->getValue($database);

            // Create backup directory if not exists
            $backupDir = 'public/uploads/backups';
            if (!file_exists($backupDir)) {
                mkdir($backupDir, 0777, true);
            }

            // Generate filename with timestamp
            $filename = 'backup_' . $dbNameValue . '_' . date('Y-m-d_H-i-s') . '.sql';
            $filepath = $backupDir . '/' . $filename;

            // Get all tables
            $stmt = $this->db->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Start building SQL dump
            $sqlDump = "-- SIGMA Database Backup\n";
            $sqlDump .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
            $sqlDump .= "-- Database: " . $dbNameValue . "\n\n";
            $sqlDump .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                // Get CREATE TABLE statement
                $createStmt = $this->db->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
                $sqlDump .= "-- Table structure for `$table`\n";
                $sqlDump .= "DROP TABLE IF EXISTS `$table`;\n";
                $sqlDump .= $createStmt['Create Table'] . ";\n\n";

                // Get table data
                $rowStmt = $this->db->query("SELECT * FROM `$table`");
                $rows = $rowStmt->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($rows)) {
                    $sqlDump .= "-- Data for table `$table`\n";

                    foreach ($rows as $row) {
                        $values = array_map(function ($value) {
                            return $value === null ? 'NULL' : $this->db->quote($value);
                        }, array_values($row));

                        $sqlDump .= "INSERT INTO `$table` VALUES (" . implode(', ', $values) . ");\n";
                    }
                    $sqlDump .= "\n";
                }
            }

            $sqlDump .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Write to file
            file_put_contents($filepath, $sqlDump);

            // Save backup time
            date_default_timezone_set('Asia/Jakarta');
            $lastBackupFile = 'public/uploads/.last_backup';
            file_put_contents($lastBackupFile, date('Y-m-d H:i:s'));

            // Download file
            header('Content-Type: application/sql');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);

            // Delete file after download
            unlink($filepath);
            exit;
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal melakukan export database: ' . $e->getMessage();
            header('Location: index.php?url=settings');
            exit;
        }
    }

    public function deleteAllData()
    {
        AuthMiddleware::isAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=settings');
            exit;
        }

        try {
            $this->db->beginTransaction();

            // Get all tables
            $stmt = $this->db->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Disable foreign key checks
            $this->db->exec("SET FOREIGN_KEY_CHECKS = 0");

            // Delete data from all tables except users (keep admin account)
            $excludeTables = ['users'];

            foreach ($tables as $table) {
                if (!in_array($table, $excludeTables)) {
                    $this->db->exec("TRUNCATE TABLE `$table`");
                }
            }

            // Delete only user role data, keep admin
            $this->db->exec("DELETE FROM users WHERE role = 'user'");

            // Re-enable foreign key checks
            $this->db->exec("SET FOREIGN_KEY_CHECKS = 1");

            $this->db->commit();

            $_SESSION['success'] = 'Semua data berhasil dihapus. Akun admin tetap tersimpan.';
            header('Location: index.php?url=settings');
            exit;
        } catch (Exception $e) {
            $this->db->rollBack();
            $_SESSION['error'] = 'Gagal menghapus data: ' . $e->getMessage();
            header('Location: index.php?url=settings');
            exit;
        }
    }
}
