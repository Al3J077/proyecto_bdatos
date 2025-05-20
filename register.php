<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
        $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password_hash) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $nombre, $email, $password);

                        if ($stmt->execute()) {
                                header("Location: login.php?success=Registro exitoso");
                                        exit();
                                            } else {
                                                    echo "Error al registrar usuario: " . $stmt->error;
                                                        }

                                                            $stmt->close();
                                                            }
                                                            ?>

                                                            <!DOCTYPE html>
                                                            <html lang="es">
                                                            <head>
                                                                <meta charset="UTF-8">
                                                                    <title>Registro</title>
                                                                        <link rel="stylesheet" href="styles.css">
                                                                        </head>
                                                                        <body>
                                                                            <h1>Registro de Usuario</h1>
                                                                                <form method="POST" action="register.php">
                                                                                        <label for="nombre">Nombre:</label>
                                                                                                <input type="text" name="nombre" required><br>

                                                                                                        <label for="email">Email:</label>
                                                                                                                <input type="email" name="email" required><br>

                                                                                                                        <label for="password">Contraseña:</label>
                                                                                                                                <input type="password" name="password" required><br>

                                                                                                                                        <button type="submit">Registrarse</button>
                                                                                                                                            </form>
                                                                                                                                                <p><a href="login.php">¿Ya tienes cuenta? Inicia sesión aquí.</a></p>
                                                                                                                                                </body>
                                                                                                                                                </html>