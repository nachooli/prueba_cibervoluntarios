*********************************

PRUEBA CIBERVOLUNTARIOS

*********************************

La prueba consiste en crear una API Rest de motos, un CRUD simple utilizando API Platform.

Para ello lo primero será crear un proyecto Symfony 6.4, y posteriormente instalar las dependencias necesarias para probarlo en local.

Las dependencias a usar serán:
- ORM de doctrine
- API Platform
- PhpUnit y browser-kit symfony/http-client para pruebas
- Validator de symfony
- doctrine-fixtures-bundle para cargar las motos de prueba

-------------------------------------------
ENTIDADES

Para las entidades he creado la entidad Moto, que a su vez hereda de dos traits (dentro de la carpeta Commons), para el id y el versionable (updateUp).
Aunque en realidad no es necesario ya que solo estamos trabajando con una sola entidad Moto, siempre es una buena práctica.

También se creara una clase (MotoEnum) para enumerar los tipos de moto y así tenerlos en constantes. Aunque no haría
falta en realidad, siempre es buena práctica crear un Enum para los tipos.

Al estar usando la versión 6.4, se ha optado por usar atributos en vez de anotaciones, y también por que los atributos necesarios para API Platform en la entidad
dan problemas si se ponen como anotaciones de PHPDoc.

Se usan asserts junto con atributos ORM para definir los requerimientos de los campos de la entidad Moto.

------------------------------------------
BASE DE DATOS

Ya que se daba libertad para usar cualquier motor de bbdd, se ha optado por SQLite ya que no será necesario conectarse
ni crear ningún contenedor en docker específicopara la conexión, y como es una prueba, es la opción más sencilla y ligera.

-----------------------------------------
DOCKER

Para crear los contenedores e inicilaizarlos se hará uso de los make:

- init-project // Iniciar los contenedores y actualizar bbdd

- update-database-schema // Actuializar bbdd

- load-fixtures-data // Cargar motos de prueba

- run-tests // Lanzar tests

- clear-cache // Limpiar cache (aunque no se pida en la prueba)

Para la imagen se usará PHP 8.2 fpm y nginx por facilidad y rapidez.

-----------------------------------------
CARGAR DATOS

Para cargar datos se utiliza el "make load-fixtures-data, que hará por detrás un "doctrine:fixtures:load"
para cargar las motos en el AppFixtures. En este archivo se persistirán a bd 4 motos de ejemplo.

----------------------------------------
TESTS

Para las pruebas se utilizará phpunit, en una clase MotoTest donde habrá un método de test por cada método del CRUD.



Si surge alguna duda no dudéis en preguntarme!


