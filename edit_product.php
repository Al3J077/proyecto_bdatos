<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
        exit();
        }

        $id = $_GET['id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                    $precio = $_POST['precio'];
                        $stock = $_POST['stock'];
                            $imagen_url = $_POST['imagen_url'];

                                $stmt = $conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen_url = ?, stock = ? WHERE id = ?");
                                    $stmt->bind_param("ssddsi", $nombre, $descripcion, $precio, $imagen_url, $stock, $id);

                                        if ($stmt->execute()) {
                                                header("Location: products.php?success=Actualizado exitosamente");
                                                        exit();
                                                            } else {
                                                                    echo "Error al actualizar producto: " . $stmt->error;
                                                                        }

                                                                            $stmt->close();
                                                                            }

                                                                            $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
                                                                            $stmt->bind_param("i", $id);
                                                                            $stmt->execute();
                                                                            $result = $stmt->get_result();
                                                                            $product = $result->fetch_assoc();
                                                                            ?>

                                                                            <!DOCTYPE html>
                                                                            <html lang="es">
                                                                            <head>
                                                                                <meta charset="UTF-8">
                                                                                    <title>Editar Producto</title>
                                                                                        <link rel="stylesheet" href="styles.css">
                                                                                        </head>
                                                                                        <body>
                                                                                            <h1>Editar Producto</h1>
                                                                                                <form method="POST" action="edit_product.php">
                                                                                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                                                                                                <label for="nombre">Nombre:</label>
                                                                                                                        <input type="text" name="nombre" value="<?php echo $product['nombre']; ?>" required><br>

                                                                                                                                <label for="descripcion">Descripción:</label>
                                                                                                                                        <textarea name="descripcion"><?php echo $product['descripcion']; ?></textarea><br>

                                                                                                                                                <label for="precio">Precio:</label>
                                                                                                                                                        <input type="number" step="0.01" name="precio" value="<?php echo $product['precio']; ?>" required><br>

                                                                                                                                                                <label for="imagen_url">URL de Imagen:</label>
                                                                                                                                                                        <input type="text" name="imagen_url" value="<?php echo $product['imagen_url']; ?>" required><br>

                                                                                                                                                                                <label for="stock">Stock:</label>
                                                                                                                                                                                        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required><br>

                                                                                                                                                                                                <button type="submit">Guardar Cambios</button>
                                                                                                                                                                                                    </form>
                                                                                                                                                                                                        <a href="products.php">Volver a la lista de productos</a>
                                                                                                                                                                                                        </body>
                                                                                                                                                                                                        </html>