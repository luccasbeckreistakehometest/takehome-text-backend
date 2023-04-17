<?php

    $method = $_SERVER['REQUEST_METHOD'];
    $resource = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    $contains = file_get_contents('php://input');

    include('../model/AnswerModel.php');


    // var_dump($method);
    // var_dump($resource);
    // var_dump($contains);

    switch ($method) {

    case 'POST':
        $c = new Answer();
        $c->setUserID($_POST['user']);
        $c->setQuestionId($_POST['questionIndex']);
        $c->setAnswer($_POST['answer']);
        echo json_encode($c->create());
        break;

    default:
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        die('{"msg": "Method not found."}');  
        break;
    }

?>