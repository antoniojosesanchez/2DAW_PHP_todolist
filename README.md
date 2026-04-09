# ToDo List

Este repositorio contiene una aplicación web de tipo ToDo List, desarrollada en PHP8.4 como ejercicio práctico de clase para el ciclo formativo de Desarrollo de Aplicaciones Web (2º DAW).

El objetivo principal del proyecto es poner en práctica los conceptos fundamentales del desarrollo web en el lado servidor, utilizando una arquitectura organizada y tecnologías habituales en entornos profesionales. Las vistas HTML se separan del código PHP mediante **Twig**, que actúa como motor de plantillas.

## Puesta en marcha

Cuando clones o descargues el repositorio, el siguiente paso es arrancar el entorno de desarrollo con Docker (por ejemplo con Docker Compose desde la carpeta raíz del proyecto, donde está el `docker-compose`). Así tendrás el servidor web, la base de datos y el resto de servicios alineados con lo que se usa en clase.

Después hace falta crear las tablas y cargar los datos iniciales. Para eso está el script SQL en la carpeta del proyecto: `todolist/todolist.sql`. Ejecútalo contra la base de datos del contenedor (desde phpMyAdmin, desde un cliente MySQL o como prefieras) y listo: la aplicación ya puede conectarse y mostrar datos de ejemplo.

### Servicios (Docker Compose)

| Servicio | URL | Puerto (host) |
|----------|-----|---------------|
| `web` | http://localhost:8080 | 8080 |
| `phpmyadmin` | http://localhost:8888 | 8888 |
| `db` (MySQL) | `localhost` | 3305 |

## Datos de acceso

- Usuario: `david@email.com`
- Contraseña: `123456`

## Patrones de diseño utilizados

- **MVC (Modelo-Vista-Controlador):** divide el software en tres capas: datos, presentación y coordinación, para que cada parte cambie con menos acoplamiento.
- **Front Controller:** una sola pieza recibe las peticiones y las encamina al código adecuado; es habitual en aplicaciones web y APIs.
- **Routing:** asocia rutas o nombres lógicos con acciones concretas, sin repetir URLs por todo el código.
- **Active Record:** el objeto que representa un registro también sabe guardarse, borrarse o buscarse; simplifica CRUDs en proyectos pequeños y medianos.
- **Template Method:** una clase base define el esqueleto de un proceso y las subclases rellenan o extienden pasos concretos.
- **Facade:** ofrece una interfaz simple frente a un subsistema más complejo (autenticación, peticiones HTTP, sesión, etc.).
