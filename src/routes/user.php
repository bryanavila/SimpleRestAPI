<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/read', function(Request $req, Response $res){
    $db = new config();
    $db = $db->connection();

    $query = "SELECT * FROM tbltest";
    $stmnt = $db->query($query);

    $rows = $stmnt->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($rows);
});

$app->get('/read/{id}', function(Request $req, Response $res){
    $id = $req->getAttribute('id');
    
    $db = new config();
    $db = $db->connection();

    $query = "SELECT * FROM tbltest WHERE id=:id";
    $stmnt = $db->prepare($query);
    $stmnt->bindparam(":id", $id);
    $stmnt->execute();

    $rows = $stmnt->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($rows);
});

$app->post('/add', function(Request $req, Response $res){
    $username = $req->getParam('username');
    $userpass = $req->getParam('userpass');

    $db = new config();
    $db = $db->connection();

    $query = "INSERT INTO tbltest (username, userpass) VALUES (:username, :userpass)";
    $stmnt = $db->prepare($query);
    $stmnt->bindparam(":username", $username);
    $stmnt->bindparam(":userpass", $userpass);
    $stmnt->execute();

    echo "User added!";
});

$app->put('/edit/{id}', function(Request $req, Response $res){
    $id = $req->getAttribute('id');
    $username = $req->getParam('username');
    $userpass = $req->getParam('userpass');

    $db = new config();
    $db = $db->connection();

    $query = "UPDATE tbltest SET username=:username, userpass=:userpass WHERE id=:id";
    $stmnt = $db->prepare($query);
    $stmnt->bindparam(":id", $id);
    $stmnt->bindparam(":username", $username);
    $stmnt->bindparam(":userpass", $userpass);
    $stmnt->execute();

    echo "User Updated";
});

$app->delete('/delete/{id}', function(Request $req, Response $res){
    $id = $req->getAttribute('id');

    $db = new config();
    $db = $db->connection();

    $query = "DELETE FROM tbltest WHERE id=:id";

    $stmnt = $db->prepare($query);
    $stmnt->bindparam(":id", $id);
    $stmnt->execute();

    echo "User Deleted!";
});