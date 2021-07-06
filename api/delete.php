<?php


require_once('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);


if($method === 'delete') {

    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null;

    if($id) {
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            $array['result'] = [
                'id' => $id,
                'deletado' => true
            ];
        } else {
            $array['error'] = 'ID não encontrado';
        }
    }

} else {

    $array['error'] = 'Metado não permitido. Apenas DELETE';

}


require_once('../return.php');

