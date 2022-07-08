# PRUEBA TECNICA DE KONECTA

## Instalación del repositorio

- **[Clonamos nuestro repositorio]**

```
git clone https://github.com/BrandonOcampoDs1/prueba_konecta.git
```

Ejecutamos nuestro comando [git clone] más el repositorio.

- **[Instalamos los manejadores de dependencias**

```
composer install
```

- **[Instalamos las dependencias de package.json]**

```
npm install
```

- **Crear el archivo .env**

```
Copiamos el archivo .env del servidor
```
- **Generamos las llaves de la base de datos Ejecutamos**
```
php artisan key:generate
```

### CORREMOS MIGRACIONES
```
php artisan migrate
```
### BASE DE DATOS
• DB_DATABASE=db_konecta_cafeteria
<br>
• DB_USERNAME=k_user
<br>
• DB_PASSWORD=k_123

### USUARIO PARA INGRESAR AL SISTEMA
• CORREO:admin@admin.com
<br>
• CONTRASEÑA=12345678


### CONSULTA PARA VER EL PRODUCTO CON MÁS STOCK
```
SELECT id, kp_nombre_producto, kp_stock  FROM productos WHERE kp_stock = ( SELECT MAX( kp_stock ) FROM productos);
```

### CONSULTA PARA VER LISTA DEL PRODUCTO MÁS VENDIDO
```
SELECT id_producto, count(id_producto) AS total_ventas from ventas group by id_producto;
```



### Desarollado por:

- **[Brandon Ocampo]()**


