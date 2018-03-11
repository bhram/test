<?php 
header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Headers: *');

$servername = "localhost";
$username = "u374132832_godd";
$password = "I636lC7vZPol";
$dbname = "u374132832_godd";

$_POST = json_decode(trim(file_get_contents('php://input')), true);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add-question'])){
    $topic_id = $_POST['topic_id'];
    $json  = json_encode($_POST['json']);
    $sql = "INSERT INTO questions (json, topic_id)
                            VALUES ($json, $topic_id)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo $conn->error;
    }           
}

if (isset($_POST['get-questions'])){
    $topic_id = $_POST['topic_id'];
    $sql = "SELECT * FROM questions where topic_id='$topic_id' ORDER BY RAND() LIMIT 7";
    if ($result = $conn->query($sql)){
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
}
if (isset($_GET['get'])){
    $sql = "SELECT * FROM questions ";
    if (isset($_GET['topic'])){
        $topic_id = $_GET['topic'];
        $sql = $sql . "where topic_id='$topic_id'";
    }
    $page_result = 10;
    $offset = 0;
    $page_value = 1;
    if (isset($_GET['page'])){
        $page_value = $_GET['page'];
    }
    if($page_value > 1)
    {	
        $offset = ($page_value - 1) * $page_result;
    }
    $sql = $sql . " ORDER BY 1 DESC limit $offset, $page_result ";
    
    if ($result = $conn->query($sql)){
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
}
if (isset($_POST['delete'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM questions where id='$id' ";
    $conn->query($sql);
}
$conn->close();

