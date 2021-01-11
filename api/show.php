<?php
include_once '../config/database.php';
include_once '../class/articles.php';
require "../vendor/autoload.php";

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$secret_key = "YOUR_SECRET_KEY";
$jwt = null;
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));


$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

$arr = explode(" ", $authHeader);


/*echo json_encode(array(
    "message" => "sd" .$arr[1]
));*/

$jwt = $arr[1];

if ($jwt) {

    try {

        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        // Access is granted. Add code of the operation here 

        $item = new Articles($db);

        $item->id = isset($_GET['id']) ? $_GET['id'] : die();

        $item->show();

        if ($item->title != null) {
            // create array
            $emp_arr = array(
                "id" =>  $item->id,
                "title" => $item->title,
                "body" => $item->body,
                "category" => $item->category
            );

            http_response_code(200);
            echo json_encode($emp_arr);
        } else {
            http_response_code(404);
            echo json_encode("Employee not found.");
        }

        
    } catch (Exception $e) {

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}
