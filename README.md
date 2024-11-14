Documentación de la API
Integrantes:
    Francisco Wenceslao Fernandez
    Martin Urbistondo

Endpoints
  GETS:
    GET usuarios/token/
        El endpoint GET/usuarios/token se utiliza para validar la autenticidad de un usuario mediante la presentación de un token. tiene una duración limitada, lo que significa que solo es válido durante un período específico de tiempo.
      Detalles del Endpoint
        Método HTTP: GET
        Ruta: /usuarios/token
        Parámetros de la Solicitud
        Este endpoint requiere que se incluya el token en la URL o en la cabecera de la solicitud.
      Respuestas Posibles
        Éxito (200 OK): Si el token es válido y aún está dentro de su período de vigencia, el servidor puede responder con un estado 200 OK, indicando que la validación fue exitosa.
        Error de Autenticación (401 Unauthorized): Si el token no es válido, expiró o no se proporcionó, el servidor puede devolver un estado 401 Unauthorized,indicando que la autenticación ha fallado.
      Ejemplo de Uso
  
    GET /productos/ 
        Este endpoint permite acceder a la colección completa de productos.
      Ejemplo de Respuesta:
  
    GET /productos/?filtar=
        Este endpoint permite filtrar la colección de productos según una condición especificada.
      Parámetros de la Solicitud:
        Filtro:	Condición por la cual filtrar los productos. Puede ser cualquier campo de la base de datos.
      Ejemplo de Uso:
        
    GET /productos/:ID
        Se permite acceder a un determinado producto dado por su ID.
      Respuestas Posibles
        Éxito (200 OK): si el producto con el id existe;
        (404 not found): el producto con el id no existe;
      Ejemplo de Respuesta:

    
    GET /categorias :
        Se permite acceder a la coleccion entera de categorias.

    GET /categorias/:ID
        Se permite acceder a una determinadac ategoria dada por su ID.

  POSTS:
    POST /productos
        Este endpoint permite agregar un nuevo producto. La acción se realiza mediante el cuerpo (BODY) de la solicitud POST. Es importante destacar que se requiere
        validación mediante token para realizar esta acción.
      Parámetros del Cuerpo (BODY):
        Se deben proporcionar los detalles del nuevo producto en el cuerpo de la solicitud en formato JSON.
      Ejemplo del cuerpo de la solicitud:

      Posibles Respuestas:
        Éxito (201 Created) : La solicitud de agregar el nuevo producto fue exitosa.El servidor responderá con un estado 201 Created y, posiblemente, con detalles
        adicionales sobre el producto recién creado.
        Error de Autenticación (401 Unauthorized): Si la validación del token falla,el servidor responderá con un estado 401 Unauthorized, indicando que la acción no está autorizada.
    
    POST /categorias:
        Se permite agregar una nueva  categoria. Esta accion se realiza mediante el BODY de POSTMAN.

  PUTS:
    PUT /productos/:ID :
        Se permite actualizar un producto mediante su ID. Esta accion se realiza mediante el BODY de POSTMAN.
      Parámetros del Cuerpo (BODY):
        Se deben proporcionar los detalles del nuevo producto en el cuerpo de la solicitud en formato JSON.
      Ejemplo del cuerpo de la solicitud:
    
    PUT /categorias/:ID :
        Se permite actualizar una categoria mediante su ID. Esta accion se realiza mediante 
        el BODY de POSTMAN.