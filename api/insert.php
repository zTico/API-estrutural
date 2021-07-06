<?php


require_once('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'post') {

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($title && $body){

        $sql = $pdo->prepare("INSERT INTO notes (title, body) VALUES (:title, :body)");
        $sql->bindValue(':title', $title);
        $sql->bindValue(':body', $body);
        $sql->execute();

        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];

    } else {
        $array['error'] = 'Campos não enviados';
    }


} else {

    $array['error'] = 'Metado não permitido. Apenas POST';

}


require_once('../return.php');

