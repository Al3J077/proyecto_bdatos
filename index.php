<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
        <title>Tienda de Zapatos</title>
            <link rel="stylesheet" href="styles.css">
            </head>
            <body>
                <header>
                        <h1>Tienda de Zapatos</h1>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                            <p>Bienvenido, <?php echo $_SESSION['user_name']; ?>!</p>
                                                        <a href="logout.php">Cerrar Sesión</a>
                                                                <?php else: ?>
                                                                            <a href="login.php">Iniciar Sesión</a>
                                                                                        <a href="register.php">Registrarse</a>
                                                                                                <?php endif; ?>
                                                                                                    </header>

                                                                                                        <main>
                                                                                                                <h2>Productos Disponibles</h2>
                                                                                                                        <div class="productos">
                                                                                                                                    <!-- Aquí se mostrarán los productos -->
                                                                                                                                            </div>
                                                                                                                                                </main>

                                                                                                                                                    <script src="scripts.js"></script>
                                                                                                                                                    </body>
                                                                                                                                                    </html>