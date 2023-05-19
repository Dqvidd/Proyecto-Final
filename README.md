# Web almacenamiento en red con Laravel

Este es el proyecto final de ASIX. Es una aplicación web de almacenamiento en red local en el servidor, construida con Laravel.

# Requisitos
Antes de comenzar, asegúrate de tener lo siguiente en tu sistema:

- Linux
- PHP 8.1

# Instalación

1. Clona el proyecto ejecutando el siguiente comando

```bash
git clone https://github.com/Dqvidd/Proyecto-Final.git
```
2. Necesitarás módulos de PHP 8.1, por lo cual descarga el repositorio usando:

```bash
sudo apt update
sudo apt install ca-certificates apt-transport-https
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list

```

3. Instala los paquetes de PHP 8.1 siguientes:

```bash
sudo apt update
sudo apt-get install php8.1 php8.1-cli php8.1-common php8.1-mbstring php8.1-mysql php8.1-xml php8.1-zip php8.1-curl
```

4. Instala el composer:

```bash
sudo apt install composer
```

5. Con el composer, yendo a la carpeta del proyecto, ejecuta lo siguiente:

```bash
composer install
```

6. Para levantar la página web usando el servidor web de laravel, usa:

```bash
php artisan serve --host=0.0.0.0 --port={puerto}
```

7. En el caso de querer aumentar el máximo tamaño de archivos a subir o descargar, recuerda modificar los siguientes campos del archivo php.ini

```bash
upload_max_filesize = 2000MB
post_max_size = 2000MB
```

8. Para poder elegir la ruta de tu sistema que quieres que se visualice en la web, modifica la siguiente línea del .env indicando la ruta ABSOLUTA

```bash
PATHUSUARIO="/"
```
# Documentación
La documentación de la aplicación se encuentra disponible en el siguiente enlace:
https://david.alert.7e5.gitlab.io/proyecto/

# Autores
- David Alert Franco
