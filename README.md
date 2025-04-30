# Tienda IGA - Prueba Técnica

## Descripción
Este proyecto implementa una tienda online para cursos gastronómicos ofrecidos por IGA. Los clientes pueden ver los cursos disponibles, realizar compras y consultar sus compras anteriores. Además, se incluye una vista para administradores donde pueden ver estadísticas sobre las compras realizadas.

## Tecnologías Utilizadas
- **Frontend**: Vue.js
- **Backend**: CodeIgniter 4
- **Base de Datos**: MySQL
- **Contenedorización**: Docker
- **Control de Versiones**: Git

## Requisitos del Sistema
- Docker instalado
- Node.js (para el frontend)
- Composer (para el backend)

## Instalación y Configuración

### 1. Clonar el Repositorio
```bash
git clone https://github.com/abolognesi/iga-courses.git
cd iga-courses
```

### 2. Configurar el Backend (CodeIgniter)
en el archivo .env de la raiz estan los datos de conexión a la base de datos
Ejecutar los migrate como se define al final del documento, ingresar al Docker de PHP y luego ejecutar las migraciones para poder generar la base de datos y tablas necesarias

### 3. Configurar el Frontend (Vue.js)

```bash
cd frontend-vue
npm install
```

### 4. Levantar el Entorno con Docker
```bash
docker-compose up --build
```
### 5. Acceder a la Aplicación 

- Frontend: http://localhost:8008 
- API Backend: http://localhost:8080

## Estructura del Proyecto
```bash
iga-courses/
├── backend-ci/          # Código del backend (CodeIgniter)
│   ├── app/
│   ├── public/
│   ├── ...
├── frontend-vue/         # Código del frontend (Vue.js)
│   ├── src/
│   ├── public/
│   ├── ...
├── docker-compose.yml # Configuración de Docker
├── README.md          # Documentación principal

```
## Endpoints de la API

Se deja la documentación de los endpoints en el siguiente [link a Postman](https://documenter.getpostman.com/view/1968004/2sB2j4eAR7) 

Se deja también un json con la colección de prueba para postman IGA - Cursos Gastronómicos.postman_collection.json en el directorio raíz.

## Acceder al contenedor de PHP
```bash
docker exec -it <nombre_del_contenedor_php> bash
```

## Ejecutar migraciones
```bash
docker exec -it <nombre_del_contenedor_php> php spark migrate
```
## Conclusión
Hay varios aspectos a mejorar, como agregar un manejo de usuarios, login, manejo de perfiles o roles, pero por cuestiones de tiempo se deja asi por el momento. Tambien queda faltando la realización de pruebas unitarias y de integración.