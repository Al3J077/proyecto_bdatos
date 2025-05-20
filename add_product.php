<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
        exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                    $precio = $_POST['precio'];
                        $stock = $_POST['stock'];
                            $imagen_url = $_POST['imagen_url'];

                                $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen_url, stock) VALUES (?, ?, ?, ?, ?)");
                                    $stmt->bind_param("ssdds", $nombre, $descripcion, $precio, $imagen_url, $stock);

                                        if ($stmt->execute()) {
                                                header("Location: products.php?success=Agregado exitoso");
                                                        exit();
                                                            } else {
                                                                    echo "Error al agregar producto: " . $stmt->error;
                                                                        }

                                                                            $stmt->close();
                                                                            }
                                                                            ?>

                                                                            <!DOCTYPE html>
                                                                            <html lang="es">
                                                                            <head>
                                                                                <meta charset="UTF-8">
                                                                                    <title>Agregar Producto</title>
                                                                                        <link rel="stylesheet" href="styles.css">
                                                                                        </head>
                                                                                        <body>
                                                                                            <h1>Agregar Producto</h1>
                                                                                                <form method="POST" action="add_product.php">
                                                                                                        <label for="nombre">Nombre:</label>
                                                                                                                <input type="text" name="nombre" required><br>

                                                                                                                        <label for="descripcion">Descripción:</label>
                                                                                                                                <textarea name="descripcion" required></textarea><br>

                                                                                                                                        <label for="precio">Precio:</label>
                                                                                                                                                <input type="number" step="0.01" name="precio" required><br>

                                                                                                                                                        <label for="imagen_url">URL de Imagen:</label>
                                                                                                                                                                <input type="text" name="imagen_url" required><br>

                                                                                                                                                                        <label for="stock">Stock:</label>
                                                                                                                                                                                <input type="number" name="stock" required><br>

                                                                                                                                                                                        <button type="submit">Agregar Producto</button>
                                                                                                                                                                                            </form>
                                                                                                                                                                                                <a href="products.php">Volver a la lista de productos</a>
                                                                                                                                                                                                </body>
                                                                                                                                                                                                </html>