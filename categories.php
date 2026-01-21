<?php
// categories.php - Categories page
session_start();
require_once 'config/database.php';

$type = $_GET['type'] ?? 'all';
$title = 'Kategori Event & Volunteer';

$events = [];
$volunteers = [];

if ($type == 'kompetisi' || $type == 'seminar' || $type == 'all') {
    $category_name = $type == 'kompetisi' ? 'Kompetisi' : ($type == 'seminar' ? 'Seminar' : '');
    $query = "SELECT e.*, c.name as category_name FROM events e JOIN categories c ON e.category_id = c.id WHERE e.status = 'active'";
    if ($category_name) {
        $query .= " AND c.name = '$category_name'";
    }
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

if ($type == 'volunteer' || $type == 'all') {
    $query = "SELECT * FROM volunteers WHERE status = 'open'";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $volunteers[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Manajemen Event & Volunteer</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav-container">
                <h1>Sistem Manajemen Event & Volunteer</h1>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="categories.php?type=all">Kategori</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="profile.php">Profil</a></li>
                        <li><a href="portfolio.php">Portofolio</a></li>
                        <li><a href="auth/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="auth/login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <h2><?php echo $title; ?></h2>

        <?php if (!empty($events)): ?>
            <section>
                <h3>Event</h3>
                <div class="features">
                    <?php foreach ($events as $event): ?>
                        <div class="card">
                            <?php if (!empty($event['logo_path'])): ?>
                                <img src="<?php echo $event['logo_path']; ?>" alt="Logo" style="max-width: 80px; max-height: 80px; object-fit: contain; border-radius: 10px; margin: 0 auto 20px; display: block;">
                            <?php else: ?>
                                <div class="card-icon">📅</div>
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($event['description'], 0, 100)); ?>...</p>
                            <p>Tanggal: <?php echo $event['event_date']; ?></p>
                            <p>Lokasi: <?php echo htmlspecialchars($event['location']); ?></p>
                            <a href="event_detail.php?id=<?php echo $event['id']; ?>" class="btn-card">Detail</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($volunteers)): ?>
            <section>
                <h3>Volunteer</h3>
                <div class="features">
                    <?php foreach ($volunteers as $vol): ?>
                        <div class="card" onclick="window.location.href='user/volunteer_detail.php?id=<?php echo $vol['id']; ?>'" style="cursor: pointer;">
                            <?php if (!empty($vol['logo_path'])): ?>
                                <img src="<?php echo $vol['logo_path']; ?>" alt="Logo" style="max-width: 80px; max-height: 80px; object-fit: contain; border-radius: 10px; margin: 0 auto 20px; display: block;">
                            <?php else: ?>
                                <div class="card-icon">🤝</div>
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($vol['title']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($vol['description'], 0, 100)); ?>...</p>
                            <p>Deadline: <?php echo $vol['deadline']; ?></p>
                            <a href="user/volunteer_detail.php?id=<?php echo $vol['id']; ?>" class="btn-card">Detail</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2023 Sistem Manajemen Event & Volunteer Mahasiswa</p>
    </footer>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/animations.js"></script>
</body>
</html>
