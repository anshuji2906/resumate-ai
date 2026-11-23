
<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "Please login first."]);
    exit;
}

require_once "includes/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$score = filter_var($data["score"] ?? null, FILTER_VALIDATE_INT);
$matched = filter_var($data["matched"] ?? 0, FILTER_VALIDATE_INT);
$missing = filter_var($data["missing"] ?? 0, FILTER_VALIDATE_INT);
$resume = trim($data["resume"] ?? "");
$job = trim($data["job"] ?? "");

if ($score === false || $score < 0 || $score > 100 || $resume === "" || $job === "") {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid analysis data."]);
    exit;
}

try {
    $stmt = $conn->prepare(
        "INSERT INTO analysis_history
        (user_id, ats_score, matched_count, missing_count, resume_text, job_description)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $_SESSION["user_id"],
        $score,
        max(0, $matched),
        max(0, $missing),
        $resume,
        $job
    ]);

    echo json_encode(["success" => true, "message" => "Analysis saved successfully."]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Could not save analysis."]);
}
?>
