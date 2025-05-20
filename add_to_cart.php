<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
        exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario_id = $_SESSION['user_id'];
                $producto_id = $_POST['id'];

                    // Verificar si el producto ya está en el carrito
                        $stmt = $conn->prepare("SELECT * FROM carrito WHERE usuario_id = ? AND producto_id = ?");
                            $stmt->bind_param("ii", $usuario_id, $producto_id);
                                $stmt->execute();
                                    $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                                // Si ya existe, aumentar la cantidad
                                                        $row = $result->fetch_assoc();
                                                                $cantidad_actual = $row['cantidad'];
                                                                        $nueva_cantidad = $cantidad_actual + 1;

                                                                                $update_stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND producto_id = ?");
                                                                                        $update_stmt->bind_param("iii", $nueva_cantidad, $usuario_id, $producto_id);
                                                                                                $update_stmt->execute();
                                                                                                    } else {
                                                                                                            // Si no existe, agregarlo al carrito
                                                                                                                    $insert_stmt = $conn->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, 1)");
                                                                                                                            $insert_stmt->bind_param("ii", $usuario_id, $producto_id);
                                                                                                                                    $insert_stmt->execute();
                                                                                                                                        }

                                                                                                                                            echo json_encode(['success' => true]);
                                                                                                                                                exit();
                                                                                                                                                }

                                                                                                                                                echo json_encode(['success' => false]);
                                                                                                                                                ?>