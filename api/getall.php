<?php


require_once('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get') {

    $sql = $pdo->query("SELECT * FROM notes");
    if($sql->rowCount() > 0){
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data as $item) {
            $array['result'][] = [
             'id' => $item['id'],
             'title' => $item['title']
            ];
        }
    }

} else {

    $array['error'] = 'Metado não permitido. Apenas GET';

}


require_once('../return.php');

