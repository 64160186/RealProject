<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Establishing connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลกิจกรรมจากฐานข้อมูล
$sql = "SELECT task_id, start_date, end_date, floor_id FROM task";
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    $tasks = array();
    // วนลูปเพื่อดึงข้อมูลทั้งหมดและสร้าง array ของกิจกรรม
    while ($row = $result->fetch_assoc()) {
        // กำหนดรูปแบบของกิจกรรมเพื่อให้รับรู้ได้ถูกต้องโดย FullCalendar
        $event = array();
        $event['id'] = $row['task_id'];
        $event['start'] = $row['start_date'];
        $event['end'] = $row['end_date'];
        $event['floor_id'] = $row['floor_id'];

        // เพิ่มกิจกรรมเข้าใน array ที่เก็บข้อมูลกิจกรรมทั้งหมด
        array_push($tasks, $event);
    }
    // แปลง array ของกิจกรรมเป็นรูปแบบ JSON และส่งกลับ
    echo json_encode($tasks);
} else {
    // ถ้าไม่มีข้อมูล ส่งกลับเป็น array ว่าง
    echo json_encode(array());
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>
