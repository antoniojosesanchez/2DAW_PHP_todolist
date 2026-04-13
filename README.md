# ToDo List

Este repositorio contiene una aplicación web de tipo ToDo List, desarrollada en PHP8.4 como ejercicio práctico de clase para el ciclo formativo de Desarrollo de Aplicaciones Web (2º DAW).

El objetivo principal del proyecto es poner en práctica los conceptos fundamentales del desarrollo web en el lado servidor, utilizando una arquitectura organizada y tecnologías habituales en entornos profesionales. Las vistas HTML se separan del código PHP mediante **Twig**, que actúa como motor de plantillas.

## Enunciado del ejercicio

Los alumnos deben construir una aplicación web de **lista de tareas personales** con persistencia en **MySQL**. El trabajo se organiza en **arquitectura MVC**, con un **front controller** que centralice las peticiones y **Twig** para las plantillas; el detalle de clases y archivos concretos se deduce de ese planteamiento.

A nivel funcional, debe implementarse lo siguiente:

- **Autenticación:** pantalla de **inicio de sesión** con formulario (correo y contraseña), comprobación contra la base de datos (contraseña almacenada de forma segura) y uso de **sesión** para recordar al usuario. Debe existir forma de **cerrar sesión** y el acceso al resto de la aplicación debe quedar **restringido** a quien no esté identificado.
- **Tareas (usuario logueado):** **listado en formato tabla** con columnas coherentes (por ejemplo fecha, texto de la tarea y si está completada o no), **botones o enlaces de acción** por fila para **editar** y **borrar**, y mensaje o estado claro cuando **no haya tareas**. Las tareas deben ser **del usuario conectado**.
- **Alta y edición de tareas:** formularios que permitan crear tareas y modificarlas; en la práctica conviene incluir **categoría** (opcional o no según el diseño de la BD) y un **filtro** del listado por categoría (por ejemplo un desplegable y un botón de filtrar).
- **Categorías:** sección aparte con **listado de categorías** y operaciones habituales (**alta, edición y borrado**) mediante formularios y vistas acordes, con **navegación** sencilla entre la zona de tareas y la de categorías.
- **Interfaz:** presentación clara y usable (por ejemplo con **Bootstrap** u otro enfoque equivalente), coherente entre pantallas.

El script SQL del proyecto sirve para crear la base de datos, tablas y datos de partida; el entorno de desarrollo recomendado (servidor web, PHP y MySQL) puede alinearse con el uso de **Docker** descrito más abajo.

## Puesta en marcha

Cuando clones o descargues el repositorio, el siguiente paso es arrancar el entorno de desarrollo con Docker (por ejemplo con Docker Compose desde la carpeta raíz del proyecto, donde está el `docker-compose`). Así tendrás el servidor web, la base de datos y el resto de servicios alineados con lo que se usa en clase.

Después hace falta crear las tablas y cargar los datos iniciales. Para eso está el script SQL en la carpeta del proyecto: `todolist/todolist.sql`. Ejecútalo contra la base de datos del contenedor (desde phpMyAdmin, desde un cliente MySQL o como prefieras) y listo: la aplicación ya puede conectarse y mostrar datos de ejemplo.

### Servicios (Docker Compose)

| Servicio | URL | Puerto (host) |
|----------|-----|---------------|
| `web` | http://localhost:8080 | 8080 |
| `phpmyadmin` | http://localhost:8888 | 8888 |
| `db` (MySQL) | `localhost` | 3305 |

### Instalar Twig

Twig se instala con **Composer**, el gestor de dependencias de PHP. Si aún no lo tienes, puedes descargarlo en [getcomposer.org](https://getcomposer.org/).

Abre una terminal, entra en la carpeta `todolist` del proyecto y ejecuta:

```bash
composer install
```

Con eso se descarga Twig (y el resto de librerías que pide el proyecto) y la aplicación puede cargar las plantillas.

## Patrones de diseño utilizados

- **MVC (Modelo-Vista-Controlador):** divide el software en tres capas: datos, presentación y coordinación, para que cada parte cambie con menos acoplamiento.
- **Front Controller:** una sola pieza recibe las peticiones y las encamina al código adecuado; es habitual en aplicaciones web y APIs.
- **Routing:** asocia rutas o nombres lógicos con acciones concretas, sin repetir URLs por todo el código.
- **Active Record:** el objeto que representa un registro también sabe guardarse, borrarse o buscarse; simplifica CRUDs en proyectos pequeños y medianos.
- **Template Method:** una clase base define el esqueleto de un proceso y las subclases rellenan o extienden pasos concretos.
- **Facade:** ofrece una interfaz simple frente a un subsistema más complejo (autenticación, peticiones HTTP, sesión, etc.).

## Datos de acceso

- Usuario: `david@email.com`
- Contraseña: `123456`

Si este repo te resulta útil o te gusta para clase, déjale una estrella ⭐ en GitHub; se agradece un montón 🙌
