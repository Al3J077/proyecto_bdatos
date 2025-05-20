<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
        $password = $_POST['password'];

            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
                $stmt->bind_param("s", $email);
                    $stmt->execute();
                        $result = $stmt->get_result();

                            if ($user = $result->fetch_assoc()) {
                                    if (password_verify($password, $user['password_hash'])) {
                                                $_SESSION['user_id'] = $user['id'];
                                                            $_SESSION['user_name'] = $user['nombre'];
                                                                        header("Location: index.php");
                                                                                    exit();
                                                                                            } else {
                                                                                                        echo "Contraseña incorrecta.";
                                                                                                                }
                                                                                                                    } else {
                                                                                                                            echo "Usuario no encontrado.";
                                                                                                                                }
                                                                                                                                }

                                                                                                                                $stmt->close();
                                                                                                                                ?>

                                                                                                                                <!DOCTYPE html>
                                                                                                                                <html lang="es">
                                                                                                                                <head>
                                                                                                                                    <meta charset="UTF-8">
                                                                                                                                        <title>Iniciar Sesión</title>
                                                                                                                                            <link rel="stylesheet" href="styles.css">
                                                                                                                                            </head>
                                                                                                                                            <body>
                                                                                                                                                <h1>Iniciar Sesión</h1>
                                                                                                                                                    <form method="POST" action="login.php">
                                                                                                                                                            <label for="email">Email:</label>
                                                                                                                                                                    <input type="email" name="email" required><br>

                                                                                                                                                                            <label for="password">Contraseña:</label>
                                                                                                                                                                                    <input type="password" name="password" required><br>

                                                                                                                                                                                            <button type="submit">Iniciar Sesión</button>
                                                                                                                                                                                                </form>
                                                                                                                                                                                                    <p><a href="register.php">¿No tienes cuenta? Regístrate aquí.</a></p>
                                                                                                                                                                                                    </body>
                                                                                                                                                                                                    </html>