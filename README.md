# Videoclub-Seyte
Proyecto de prácticas Seyte 2023. La aplicación que se va a desarrollar consiste en un videoclub que permite ver películas, de manera online y mediante descarga, según el rol del usuario.

## Especificación elaborada (versión inicial)
#### Roles de usuarios

1. Usuario registrado: usuario autenticado vía email y password.
    * Puede acceder a toda la funcionalidad del usuario no registrado.
    * Puede acceder a todas las películas online de manera ilimitada, simplemente abonando la cuota de registro.
    * Puede realizar reseñas.
    * Tendrá un perfil con un registro de películas vistas
2. Usuario no registrado: usuario visitante sin cuenta.
    * No puede ver películas, sólo sus trailers.
    * Debe abonar una cantidad para alquilar una película (solo online y durante un tiempo limitado).
    * Puede consultar el catálogo de todas las películas.
    * Puede leer reseñas pero no publicarlas.
3. Administrador.
    * Puede realizar toda la funcionalidad de los usuarios anteriores.
    * Tiene todos los permisos para acceder a la base de datos, editar, eliminar y añadir usuarios y películas.

#### Descripción de los bocetos
1. Landing page:
    * Nombre de la aplicación
    * Barra de navegación con botones de login y buscador
    * Catálogo de películas disponibles
2. Página de película:
    * Nombre
    * Imagen (cartel)
    * Botón de descarga y visualización online (solo usuarios registrados)
    * Botón de compra (solo usuarios no registrados) -> redirección a paypal
    * Datos de la película
    * Reseñas
    * Formulario para introducir reseña
3. Página de usuario:
    * Tarjeta de usuario con la imagen del perfil y sus datos
    * Registro de películas vistas/descargadas
    * Reseñas hechas
    * Botón de edición de datos
4. Página de reproducción:
    * Título de la película
    * Reproductor
## Diagrama Entidad-Relación
   ````mermaid
      erDiagram
         USUARIO ||--o{ COMPRA : realiza
         COMPRA }o--|| PELICULA : contiene
         PELICULA ||--o{ RESENA : tiene
         USUARIO ||--O{ RESENA : escribe
