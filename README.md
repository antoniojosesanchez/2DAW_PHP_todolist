# ToDo List

Este repositorio contiene una aplicación web de tipo ToDo List, desarrollada en PHP como ejercicio práctico de clase para el ciclo formativo de Desarrollo de Aplicaciones Web (2º DAW).

El objetivo principal del proyecto es poner en práctica los conceptos fundamentales del desarrollo web en el lado servidor, utilizando una arquitectura organizada y tecnologías habituales en entornos profesionales.

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
