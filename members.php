<?php
/**
 * ICS 2102: Web Development Mini Project - Database Retrieval
 * Displays the roster of students who submitted applications to join the club.
 * Demonstrates:
 * - Querying records from a database (MySQL / SQLite) via PDO
 * - Data display using an accessible HTML table
 * - Aggregation and statistical metrics
 */

require_once __DIR__ . '/db.php';

try {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->query("SELECT * FROM members ORDER BY created_at DESC");
    $members = $stmt->fetchAll();
    $totalMembers = count($members);

    // Calculate quick stats
    $competitiveCount = 0;
    $socialCount = 0;
    foreach ($members as $m) {
        if (stripos($m['membership_type'] ?? '', 'Competitive') !== false) {
            $competitiveCount++;
        } else {
            $socialCount++;
        }
    }
} catch (Exception $e) {
    $members = [];
    $totalMembers = 0;
    $errorMessage = "Error retrieving member records: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HIT Hoopers | Registered Members</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="JS/script.js" defer></script>
</head>
<body>
  <header class="site-header">
    <nav class="navigation">
      <a class="logo" href="index.html">HIT <span>HOOPERS</span></a>
      <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="events.html">Events</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="contact.html">Join Us</a></li>
        <li><a class="active" href="members.php">Members</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="page-banner reveal">
      <p class="eyebrow">OFFICIAL CLUB ROSTER</p>
      <h1>Registered <span>Members</span></h1>
      <p>Live student roster populated from our backend database.</p>
    </section>

    <!-- Club Database Statistics -->
    <section class="content-section reveal" style="padding-bottom: 20px;">
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div class="purpose-card" style="background: #242424; padding: 25px; border-top: 4px solid #f47a20;">
          <p class="eyebrow" style="margin-bottom: 8px;">DATABASE TOTAL</p>
          <h2 style="font-size: 2.6rem; color: #fff;"><?php echo $totalMembers; ?></h2>
          <p style="color: #aaa39b; font-size: 0.9rem;">Registered Club Members</p>
        </div>
        <div class="purpose-card" style="background: #242424; padding: 25px; border-top: 4px solid #4ade80;">
          <p class="eyebrow" style="margin-bottom: 8px; color: #4ade80;">TEAM PLAYERS</p>
          <h2 style="font-size: 2.6rem; color: #fff;"><?php echo $competitiveCount; ?></h2>
          <p style="color: #aaa39b; font-size: 0.9rem;">Competitive Varsity Squad</p>
        </div>
        <div class="purpose-card" style="background: #242424; padding: 25px; border-top: 4px solid #60a5fa;">
          <p class="eyebrow" style="margin-bottom: 8px; color: #60a5fa;">COMMUNITY & SOCIAL</p>
          <h2 style="font-size: 2.6rem; color: #fff;"><?php echo $socialCount; ?></h2>
          <p style="color: #aaa39b; font-size: 0.9rem;">Social / Fitness / Volunteers</p>
        </div>
      </div>

      <!-- Live Search & Action Bar -->
      <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 25px;">
        <div>
          <label for="member-search" class="eyebrow" style="display: block; margin-bottom: 6px;">FILTER MEMBERS</label>
          <input type="text" id="member-search" placeholder="Search by name, ID or role..." 
                 style="background: #171717; border: 1px solid #444; color: #fff; padding: 10px 14px; border-radius: 4px; min-width: 280px;">
        </div>
        <a class="button" href="contact.html">+ Add New Registration</a>
      </div>

      <!-- Members Data Table -->
      <div class="table-wrapper">
        <table id="members-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Student Name</th>
              <th>Student ID</th>
              <th>Preferred Role / Position</th>
              <th>Membership Type</th>
              <th>Registered Date</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($members)): ?>
              <?php foreach ($members as $index => $row): ?>
                <tr>
                  <td><?php echo (int)($row['id'] ?? ($index + 1)); ?></td>
                  <td style="font-weight: bold; color: #fff;"><?php echo htmlspecialchars($row['full_name']); ?></td>
                  <td><code><?php echo htmlspecialchars($row['student_id']); ?></code></td>
                  <td><?php echo htmlspecialchars($row['position']); ?></td>
                  <td>
                    <span style="background: rgba(244, 122, 32, 0.15); color: #f47a20; padding: 4px 10px; border-radius: 12px; font-size: 0.82rem; font-weight: bold;">
                      <?php echo htmlspecialchars($row['membership_type']); ?>
                    </span>
                  </td>
                  <td style="color: #aaa39b; font-size: 0.88rem;">
                    <?php echo htmlspecialchars(substr($row['created_at'], 0, 16)); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" style="text-align: center; padding: 30px; color: #aaa39b;">
                  No members found in the database yet. <a href="contact.html" style="color: #f47a20;">Be the first to join!</a>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <p>&copy; 2026 HIT Hoopers Basketball Club · Harare Institute of Technology</p>
  </footer>
</body>
</html>
