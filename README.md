Documentación de la API

Integrantes:
    Francisco Wenceslao Fernandez
    Martin Urbistondo

Endpoints
  
  GETS:
    
GET usuarios/token/
        
        El endpoint GET/usuarios/token se utiliza para validar la autenticidad de un usuario 
        mediante la presentación de un token. tiene una duración limitada, lo que significa que 
        solo es válido durante un período específico de tiempo.
      Detalles del Endpoint:
        Método HTTP: GET
        Ruta: /usuarios/token
        Parámetros de la Solicitud
        Este endpoint requiere que se incluya el token en la URL o en la cabecera de la 
        solicitud.
      Respuestas Posibles:
        Éxito (200 OK): Si el token es válido y aún está dentro de su período de vigencia, el 
        servidor puede responder con un estado 200 OK, indicando que la validación fue exitosa.
        Error de Autenticación (401 Unauthorized): Si el token no es válido, expiró o no se 
        proporcionó, el servidor puede devolver un estado 401 Unauthorized,indicando que la 
        autenticación ha fallado.
  
GET /productos/ 
    
    Este endpoint permite acceder a la colección completa de productos.
    Ejemplo de Respuesta:
![image](https://github.com/user-attachments/assets/c83f57e9-a69a-4e07-a46e-8b478fbdaa24)

GET /productos/?Filtro=
        
        Este endpoint permite filtrar la colección de productos según una condición     
        especificada.
        Parámetros de la Solicitud:
        Filtro:	Condición por la cual filtrar los productos. Puede ser cualquier campo de la 
        base de datos.
        Cuando se filtra por nombre=... hay que utilizar las "...." 
      Ejemplo de Uso:
![image](https://github.com/user-attachments/assets/a38274ee-37cb-49da-b0eb-dd3185a041a3)
![image](https://github.com/user-attachments/assets/38bc568e-c118-448d-8625-dfe1c7eeb4e6)

GET /productos/?Orden&Sort
        
        Este endpoint permite ordenar la colección de productos de manera ascendente o 
        descendente según un campo específico.
        Parámetros de la Solicitud:
        Sort: Campo por el cual ordenar los productos (puede ser cualquier campo de la base de 
        datos).
        Orden: Dirección de la ordenación (por defecto, es descendente). Puede ser ASC para 
        ascendente o DESC para descendente.
        Ejemplo de endpoint:
![image](https://github.com/user-attachments/assets/db0dcbf5-39fa-403d-8687-82de3435323a)
     
GET /productos/:ID
        
        Se permite acceder a un determinado producto dado por su ID.
      Respuestas Posibles
        Éxito (200 OK): si el producto con el id existe;
        (404 not found): el producto con el id no existe;
      Ejemplo de Respuesta:
    
GET /categorias :
        
        Este endpoint permite acceder a la colección completa de categorias.
        Ejemplo de Respuesta:
![image](https://github.com/user-attachments/assets/a8382515-857c-445c-ae87-8364ae3bd319)

GET /categorias/?Filtro=
        
        Este endpoint permite filtrar la colección de categorias según una condición     
        especificada.
        Parámetros de la Solicitud:
        Filtro:	Condición por la cual filtrar las categorias. Puede ser cualquier campo de la 
        base de datos.
        Cuando se filtra por nombre=... hay que utilizar las "...." 
      Ejemplo de Uso:
![image](https://github.com/user-attachments/assets/c9e9e8cf-dcfb-49fd-8373-fee3fec2ed82)
![image](https://github.com/user-attachments/assets/4d16f9ba-2f81-41f4-9bb8-d610eba1cbb1)

GET /categorias/?Orden&Sort
        
        Este endpoint permite ordenar la colección de categorias de manera ascendente o 
        descendente según un campo específico.
        Parámetros de la Solicitud:
        Sort: Campo por el cual ordenar las categorias (puede ser cualquier campo de la base 
        de datos).
        Orden: Dirección de la ordenación (por defecto, es descendente). Puede ser ASC para 
        ascendente o DESC para descendente.
        Ejemplo de endpoint:
![image](https://github.com/user-attachments/assets/a82d8550-53ae-477d-88a4-52f842f72b4d)
      
GET /categorias/:ID
        
        Se permite acceder a una determinada categoria dada por su ID.

  POSTS:
    
POST /productos
        
        Este endpoint permite agregar un nuevo producto. La acción se realiza mediante el 
        cuerpo (BODY) de la solicitud POST. Es importante destacar que se requiere
        validación mediante token para realizar esta acción.
      Parámetros del Cuerpo (BODY):
        Se deben proporcionar los detalles del nuevo producto en el cuerpo de la solicitud en 
        formato JSON.
      Ejemplo del cuerpo de la solicitud:

      Posibles Respuestas:
        Éxito (201 Created) : La solicitud de agregar el nuevo producto fue exitosa.El 
          servidor responderá con un estado 201 Created y, posiblemente, con detalles
          adicionales sobre el producto recién creado.
        Error de Autenticación (401 Unauthorized): Si la validación del token falla,el 
          servidor responderá con un estado 401 Unauthorized, indicando que la acción no está 
          autorizada.
    
POST /categorias:
        
        Se permite agregar una nueva  categoria. Esta accion se realiza mediante el BODY de 
        POSTMAN.

PUTS:
    
PUT /productos/:ID :
        
        Se permite actualizar un producto mediante su ID. Esta accion se realiza mediante el 
        BODY de POSTMAN.
      Parámetros del Cuerpo (BODY):
        Se deben proporcionar los detalles del nuevo producto en el cuerpo de la solicitud en 
        formato JSON.
      Ejemplo del cuerpo de la solicitud:
![image](https://github.com/user-attachments/assets/964ae2fe-80b7-48d1-a0fe-473aec87d7dd)

    
PUT /categorias/:ID :
        
        Se permite actualizar una categoria mediante su ID. Esta accion se realiza mediante 
        el BODY de POSTMAN.
