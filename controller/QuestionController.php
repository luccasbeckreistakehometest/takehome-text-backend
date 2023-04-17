<?php

    $method = $_SERVER['REQUEST_METHOD'];
    $resource = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    $contains = file_get_contents('php://input');

    include('../model/QuestionModel.php');


    // var_dump($method);
    // var_dump($resource);
    // var_dump($contains);

    switch ($method) {

    case 'POST':
        $c = new Question();
        $c->setQuestion($_POST['question']);
        echo json_encode($c->create());
        break;
    case 'GET':
        if(!empty($resource[0])){
            $c = new Question();
            $c->setId($resource[0]);
            $c->read();
            echo json_encode($c->jsonMount());
        }else{
            echo json_encode(Question::list());
        }
        break;

    default:
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        die('{"msg": "Method not found."}');  
        break;
    }

?>