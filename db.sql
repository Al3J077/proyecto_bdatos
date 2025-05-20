-- Crear la base de datos
CREATE DATABASE tienda_zapatos;
USE tienda_zapatos;

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
                password_hash VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    );

                    -- Tabla productos
                    CREATE TABLE productos (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                            nombre VARCHAR(100) NOT NULL,
                                descripcion TEXT,
                                    precio DECIMAL(10, 2) NOT NULL,
                                        imagen_url VARCHAR(255),
                                            stock INT NOT NULL,
                                                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                                                );

                                                -- Tabla carrito
                                                CREATE TABLE carrito (
                                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                                        usuario_id INT,
                                                            producto_id INT,
                                                                cantidad INT NOT NULL,
                                                                    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
                                                                        FOREIGN KEY (producto_id) REFERENCES productos(id)
                                                                        );

                                                                        -- Tabla auditoria
                                                                        CREATE TABLE auditoria (
                                                                            id INT AUTO_INCREMENT PRIMARY KEY,
                                                                                tabla VARCHAR(50) NOT NULL,
                                                                                    accion VARCHAR(20) NOT NULL,
                                                                                        fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                                                                            usuario_id INT,
                                                                                                FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
                                                                                                );

                                                                                                -- Trigger para registrar acciones en la tabla auditoria
                                                                                                DELIMITER //
                                                                                                CREATE TRIGGER after_productos_insert
                                                                                                AFTER INSERT ON productos
                                                                                                FOR EACH ROW
                                                                                                BEGIN
                                                                                                    INSERT INTO auditoria (tabla, accion, usuario_id)
                                                                                                        VALUES ('productos', 'INSERT', NEW.usuario_id);
                                                                                                        END//
                                                                                                        DELIMITER ;

                                                                                                        DELIMITER //
                                                                                                        CREATE TRIGGER after_productos_update
                                                                                                        AFTER UPDATE ON productos
                                                                                                        FOR EACH ROW
                                                                                                        BEGIN
                                                                                                            INSERT INTO auditoria (tabla, accion, usuario_id)
                                                                                                                VALUES ('productos', 'UPDATE', NEW.usuario_id);
                                                                                                                END//
                                                                                                                DELIMITER ;

                                                                                                                DELIMITER //
                                                                                                                CREATE TRIGGER after_productos_delete
                                                                                                                AFTER DELETE ON productos
                                                                                                                FOR EACH ROW
                                                                                                                BEGIN
                                                                                                                    INSERT INTO auditoria (tabla, accion, usuario_id)
                                                                                                                        VALUES ('productos', 'DELETE', OLD.usuario_id);
                                                                                                                        END//
                                                                                                                        DELIMITER ;