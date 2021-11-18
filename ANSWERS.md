RESPUESTAS

1) Por simplificar la respuesta se ha usado una colección de postman, en la cual faltan algunos métodos porque no se han
   implementado el 100% de los mismos.

       https://documenter.getpostman.com/view/779112/UVCCd3Yu#5a050ee0-b954-46d1-b32d-719d5e7066ea
 
   En el enlace de postman se pueden ver los diferentes endpoints con diferentes ejemplos de llamadas y respuestas, así
   como las requests y responses. Faltarían los endpoints de búsqueda de productos por categorías, pero serían con el
   mismo formato que la búsqueda de productos por nombre, en donde las respuestas pueden ser 0, 1 o varios productos.
   También faltaría añadir a la colección las llamadas de creación y edición de producto. Serían similares a las de
   categoría, pero en el body se le pasarían todos los parámetros necesarios.


2) Se decide implementar una estructura DDD como se muestra en el código.


3) Puntos que habría que seguir desarrollando:
    1) Añadir autenticación a los admin endpoints (crear/actualizar productos/categorías).
    2) Hacer que las entidades no se definan con annotations sino que se haga por fichero xml de doctrine
    3) Añadir tests de integración para asegurar las queries a infraestructura de base de datos
    4) Valorar si usar symfony-messenger para hacer algunos casos de uso asíncronos, o aunque sean síncronos, poder usar
       el patrón command y commandHandler de CQRS
