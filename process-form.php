<?php
/**
 * ICS 2102: Web Development Mini Project - Form Processing
 * Handles member registration and inquiry form submission.
 * Validates data on the server side and stores record in the database.
 */

require_once __DIR__ . '/db.php';

$errors = [];
$success = false;
$insertedId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize input data
    $fullName = trim(filter_input(INPUT_POST, 'full_name', FILTER_DEFAULT) ?? '');
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '');
    $studentId = trim(filter_input(INPUT_POST, 'student_id', FILTER_DEFAULT) ?? '');
    $position = trim(filter_input(INPUT_POST, 'position', FILTER_DEFAULT) ?? 'General Member');
    $membershipType = trim(filter_input(INPUT_POST, 'membership_type', FILTER_DEFAULT) ?? 'Player');
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_DEFAULT) ?? '');

    // 2. Validate input fields
    if (empty($fullName) || strlen($fullName) < 2) {
        $errors[] = "Please provide your valid full name (minimum 2 characters).";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please provide a valid email address.";
    }

    if (empty($studentId)) {
        $errors[] = "Please provide your student ID.";
    }

    // 3. Save to database if no validation errors
    if (empty($errors)) {
        try {
            $pdo = getDatabaseConnection();
            $stmt = $pdo->prepare("
                INSERT INTO members (full_name, email, student_id, position, membership_type, message, created_at)
                VALUES (:full_name, :email, :student_id, :position, :membership_type, :message, datetime('now'))
            ");

            // For MySQL compat, use standard NOW() or pass ISO timestamp
            $timestamp = date('Y-m-d H:i:s');
            $stmt = $pdo->prepare("
                INSERT INTO members (full_name, email, student_id, position, membership_type, message, created_at)
                VALUES (:full_name, :email, :student_id, :position, :membership_type, :message, :created_at)
            ");

            $stmt->execute([
                ':full_name' => $fullName,
                ':email' => $email,
                ':student_id' => $studentId,
                ':position' => $position,
                ':membership_type' => $membershipType,
                ':message' => $message,
                ':created_at' => $timestamp
            ]);

            $insertedId = $pdo->lastInsertId();
            $success = true;
        } catch (Exception $e) {
            $errors[] = "Database error: Unable to record registration. " . $e->getMessage();
        }
    }
} else {
    // Redirect if visited directly via GET
    header('Location: contact.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HIT Hoopers | Application Status</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="JS/script.js" defer></script>
</head>
<body class="response-page">
  <main class="response-card">
    <?php if ($success): ?>
      <!-- Celebratory Basketball Animation -->
      <div class="congrats-ball-wrapper" id="congrats-ball-interactive" title="Click the ball for a victory spin!">
        <span class="congrats-sparkle congrats-sparkle-1">✦</span>
        <span class="congrats-sparkle congrats-sparkle-2">✦</span>
        <span class="congrats-sparkle congrats-sparkle-3">★</span>
        <span class="congrats-sparkle congrats-sparkle-4">★</span>
        <div class="congrats-basketball" id="congrats-basketball" aria-label="Celebratory animated basketball">
          <div class="congrats-ball-shine"></div>
          <div class="congrats-ball-line congrats-line-one"></div>
          <div class="congrats-ball-line congrats-line-two"></div>
          <div class="congrats-ball-line congrats-line-three"></div>
        </div>
        <div class="congrats-ball-shadow"></div>
      </div>

      <p class="eyebrow" style="color: #4ade80;">APPLICATION ACCEPTED · REF #<?php echo str_pad((string)$insertedId, 4, '0', STR_PAD_LEFT); ?></p>
      <h1>Congratulations!</h1>
      <p style="font-size: 1.25rem; color: #fff; font-weight: 600; margin-top: -10px; margin-bottom: 18px;">
        You have successfully joined our community!
      </p>
      <p>
        Welcome to the squad, <strong><?php echo htmlspecialchars($fullName); ?></strong>! Your membership application as a <strong><?php echo htmlspecialchars($membershipType); ?></strong>
        (Preferred Role: <em><?php echo htmlspecialchars($position); ?></em>) has been recorded in our official database.
      </p>

      <div style="background: #171717; border: 1px solid #383838; border-radius: 8px; padding: 20px; margin: 25px 0; text-align: left;">
        <h3 style="color: #f47a20; margin-bottom: 12px; font-size: 1.1rem;">Registration Summary</h3>
        <p style="margin: 6px 0; color: #ded8d0;"><strong>Student ID:</strong> <?php echo htmlspecialchars($studentId); ?></p>
        <p style="margin: 6px 0; color: #ded8d0;"><strong>Email Address:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p style="margin: 6px 0; color: #ded8d0;"><strong>Date Registered:</strong> <?php echo htmlspecialchars($timestamp); ?></p>
        <?php if (!empty($message)): ?>
          <p style="margin: 6px 0; color: #aaa39b;"><strong>Your Note:</strong> “<?php echo htmlspecialchars($message); ?>”</p>
        <?php endif; ?>
      </div>

      <p style="color: #aaa39b; font-size: 0.95rem; margin-bottom: 25px;">
        A confirmation has been logged. Training takes place every Tuesday and Thursday at 5:00 PM at the Main Sports Hall.
      </p>

      <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
        <a class="button" href="members.php">View Registered Members →</a>
        <a class="button" href="index.html" style="background: #343434; color: #fff;">Back to Home</a>
      </div>

    <?php else: ?>
      <p class="eyebrow" style="color: #ef4444;">SUBMISSION ERROR</p>
      <h1>Registration <span>Incomplete</span></h1>
      <p>There was a problem processing your form submission:</p>

      <ul style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444; color: #fca5a5; padding: 15px 25px; margin: 20px 0; text-align: left; list-style-position: inside;">
        <?php foreach ($errors as $error): ?>
          <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
      </ul>

      <div style="margin-top: 25px;">
        <a class="button" href="contact.html">← Return to Form & Try Again</a>
      </div>
    <?php endif; ?>
  </main>
</body>
</html>
