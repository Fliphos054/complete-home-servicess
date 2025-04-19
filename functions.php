<?php
// functions.php
require_once 'config.php';

function getServices($featured_only = false) {
    global $conn;
    $sql = "SELECT * FROM services";
    if ($featured_only) {
        $sql .= " WHERE featured = TRUE";
    }
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getServiceById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getTestimonials($service_id = null) {
    global $conn;
    $sql = "SELECT * FROM testimonials";
    if ($service_id) {
        $sql .= " WHERE service_id = $service_id";
    }
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function saveContactSubmission($data) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO contact_submissions (name, email, phone, service_id, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $data['name'], $data['email'], $data['phone'], $data['service_id'], $data['message']);
    return $stmt->execute();
}
?>