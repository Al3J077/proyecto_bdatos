<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
        exit();
        }

        $stmt = $conn->prepare("SELECT * FROM productos");
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
                <title>Listado de Productos</title>
                    <link rel="stylesheet" href="styles.css">
                    </head>
                    <body>
                        <h1>Listado de Productos</h1>
                            <a href="add_product.php">Agregar Nuevo Producto</a>
                                <table>
                                        <thead>
                                                    <tr>
                                                                    <th>Nombre</th>
                                                                                    <th>Precio</th>
                                                                                                    <th>Acciones</th>
                                                                                                                </tr>
                                                                                                                        </thead>
                                                                                                                                <tbody>
                                                                                                                                            <?php while ($row = $result->fetch_assoc()): ?>
                                                                                                                                                            <tr>
                                                                                                                                                                                <td><?php echo $row['nombre']; ?></td>
                                                                                                                                                                                                    <td>$<?php echo number_format($row['precio'], 2); ?></td>
                                                                                                                                                                                                                        <td>
                                                                                                                                                                                                                                                <a href="edit_product.php?id=<?php echo $row['id']; ?>">Editar</a>
                                                                                                                                                                                                                                                                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                                                                                                                                                                                                                                                                                            </td>
                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                                        <?php endwhile; ?>
                                                                                                                                                                                                                                                                                                                                </tbody>
                                                                                                                                                                                                                                                                                                                                    </table>
                                                                                                                                                                                                                                                                                                                                    </body>
                                                                                                                                                                                                                                                                                                                                    </html>