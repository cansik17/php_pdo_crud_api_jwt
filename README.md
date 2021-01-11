# php_pdo_crud_api_jwt
 
* A rest api with jwt auth ( made with https://github.com/firebase/php-jwt )
* You can test with https://www.postman.com/downloads/ 

 # routes

* Method "POST" , http://your-domain.com/api/register.php  -------->>>   Create a new user
* Method "POST" , http://your-domain.com/api/login.php  -------->>>  Login and take the token (default time 1 hour )
* Method "GET"  , http://your-domain.com/api/index.php  -------->>>  Use Token
* Method "GET"  , http://your-domain.com/api/show.php?id={id}  -------->>> Use Token
* Method "POST" , http://your-domain.com/api/store.php  -------->>> Use Token and customize body raw json 
* Method "PUT" , http://your-domain.com/api/update.php  -------->>> Use Token and customize body raw json
* Method "DELETE" , http://your-domain.com/api/destroy.php  -------->>> Use Token and customize bhttp://your-domain.com
