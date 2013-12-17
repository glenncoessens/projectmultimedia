<?php


if ($_GET) {
    if ($_GET['action'] == 'getRoutes') {
        $query = "SELECT * FROM route order by sequence ASC ";
        $result = db_connection($query);

        $routes = array();

        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            array_push($routes, array('id' => $row['id'], 'name' => $row['name'],
                'subject' => $row['subject'], 'routedescription' => $row['routedescription'], 
                'floorplan' => $row['floorplan']));
        }
        echo json_encode(array("routes" => $routes));
        exit;
    }
    if ($_GET['action'] == 'getObjects') {
        $Id = $_GET['id'];
        $query = "SELECT id, name, description, sequence, audio FROM object where route_id=" . $Id  . " order by sequence";
        $result = db_connection($query);
        $objects = array();

        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            array_push($objects, array('id' => $row['id'], 'name' => $row['name'],
                'description' => $row['description'], 'sequence' => $row['sequence'],'audio'=>$row['audio']));
        }
        echo json_encode(array("objects" => $objects));
        exit;
    }
    if ($_GET['action'] == 'getReflectie') {
        $Id = $_GET['id'];
        $query = "SELECT id, question FROM reflect where route_id=" . $Id;
        $result = db_connection($query);
        $reflectie = array();

        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            array_push($reflectie, array('id' => $row['id'],'question'=>$row['question']));
        }
        echo json_encode(array("reflectie" => $reflectie));
        exit;
    }
}

function db_connection($query) {
    $con = mysql_connect('localhost', 'root', 'root') OR die(fail('Could not connect to database.'));
    mysql_set_charset('utf8',$con);
    mysql_select_db('jrr');

    return mysql_query($query);
}

function fail($message) {
    die(json_encode(array('status' => 'fail', 'message' => $message)));
}

function success($message) {
    die(json_encode(array('status' => 'success', 'message' => $message)));
}

?>