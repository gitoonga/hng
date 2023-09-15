<?php
$method = $_SERVER['REQUEST_METHOD'];
include "./database.php";
include "./person.php";
include "./Phone.php";

function getUserid()
{
    $requesturl = $_SERVER['REQUEST_URI'];
    $url = explode('/', $requesturl);
    return end($url);
}

if ($method === 'PUT') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $phone = new phone();

    $data['phone'] = $phone->formatphone($data['phone']);

    $p = new Person();
    $person = $p->createPerson($data);

    if ($person) {
        http_response_code(201);
        echo json_encode(['message' => 'Person created successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Failed to create person']);
    }
}

if ($method === 'PATCH') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    $requesturl = $_SERVER['REQUEST_URI'];
    $url = explode('/', $requesturl);
    $userid = end($url);

    $toupdate = [
        'name' => null,
        'phone' => null,
        'email' => null,
    ];

    if (isset($data['name'])) {
        $toupdate['name'] = $data['name'];
    }

    if (isset($data['phone'])) {
        $toupdate['phone'] = $data['phone'];
    }

    if (isset($data['email'])) {
        $toupdate['email'] = $data['email'];
    }
    
    $p = new Person();

    $personUpdated = $p->updatePerson($userid, $toupdate);
    if ($personUpdated) {
        http_response_code(200);
        echo json_encode(['message' => 'Person updated successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Failed to update person']);
    }
}

if ($method === 'GET')
{
    $userid = getUserid();

    if($userid == "")
    {
        http_response_code(400);
        echo json_encode(['message' => 'Please pass a Parameter to get a person\'s details']);
        return;
    }

    $p = new Person();

    $person = $p->getPerson($userid);
    
    if ($person) {
        http_response_code(200);
        echo json_encode(['person' => $person]);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Failed to get person']);
    }
}

if ($method === 'DELETE')
{
    $userid = getUserid();

    $p = new Person();

    $person = $p->deletePerson($userid);
    if ($person) {
        http_response_code(204);
        echo json_encode(['message' => 'Person Deleted']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Failed to delete person']);
    }
}
