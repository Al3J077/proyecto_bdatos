<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
        exit();
        }

        $id = $_GET['id'];

        $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: products.php?success=Eliminado exitosamente");
                exit();
                } else {
                    echo "Error al eliminar producto: " . $stmt->error;
                    }

                    $stmt->close();
                    ?>