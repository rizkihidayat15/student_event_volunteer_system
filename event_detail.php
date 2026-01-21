<?php
// event_detail.php - Event Detail Page
session_start();
require_once 'config/database.php';

$event_id = $_GET['id'] ?? 0;
$event = null;

if ($event_id) {
    $stmt = $conn->prepare("SELECT e.*, c.name as category_name FROM events e JOIN categories c ON e.category_id = c.id WHERE e.id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    $stmt->close();
}

if (!$event) {
    header('Location: index.php');
    exit;
}

// Fetch documentations
$docs = [];
$stmt = $conn->prepare("SELECT * FROM documentations WHERE event_id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $docs[] = $row;
}
$stmt->close();

// Fetch timelines
$timelines = [];
$stmt = $conn->prepare("SELECT * FROM event_timelines WHERE event_id = ? ORDER BY agenda_date ASC");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $timelines[] = $row;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['title']); ?> - Detail Event</title>
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
                        <li><a href="auth/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="auth/login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <?php if (!empty($event['logo_path'])): ?>
            <img src="<?php echo $event['logo_path']; ?>" alt="Logo Event" class="event-logo">
        <?php endif; ?>

        <div class="event-container">
            <h1><?php echo htmlspecialchars($event['title']); ?></h1>

            <div class="event-layout">
                <div class="event-cards-container">
                    <div class="event-card description-card">
                        <h2>📦 Deskripsi Kegiatan</h2>
                        <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                        <div class="event-info">
                            <p><strong>Kategori:</strong> <?php echo htmlspecialchars($event['category_name']); ?></p>
                            <p><strong>Tanggal Mulai:</strong> <?php echo $event['event_date']; ?></p>
                            <?php if (!empty($event['end_date'])): ?>
                                <p><strong>Tanggal Berakhir:</strong> <?php echo $event['end_date']; ?></p>
                            <?php endif; ?>
                            <p><strong>Lokasi:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                        </div>
                    </div>

                    <div class="event-card docs-card">
                        <h2>📄 Berkas Informasi</h2>
                        <?php if (!empty($docs)): ?>
                            <ul class="file-list">
                                <?php foreach ($docs as $doc): ?>
                                    <?php
                                    $file_path = $doc['file_path'];
                                    $file_name = basename($file_path);
                                    $is_pdf = strtolower(pathinfo($file_path, PATHINFO_EXTENSION)) === 'pdf';
                                    ?>
                                    <li>
                                        <?php if ($is_pdf): ?>
                                            <a href="<?php echo $file_path; ?>" target="_blank" class="pdf-link">📄 <?php echo $file_name; ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo $file_path; ?>" download class="download-link">📎 <?php echo $file_name; ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>Tidak ada berkas tersedia.</p>
                        <?php endif; ?>
                    </div>

                    <div class="event-card terms-card">
                        <h2>📋 Syarat dan Ketentuan</h2>
                        <p><?php echo nl2br(htmlspecialchars($event['terms'] ?? 'Syarat dan ketentuan acara akan diumumkan lebih lanjut.')); ?></p>
                    </div>
                </div>

                <div class="event-card timeline-card">
                    <h2>📅 Timeline Kegiatan</h2>
                    <?php if (!empty($timelines)): ?>
                        <div class="timeline-container">
                            <?php foreach ($timelines as $index => $timeline): ?>
                                <div class="timeline-item">
                                    <div class="timeline-date"><?php echo date('d M', strtotime($timeline['agenda_date'])); ?></div>
                                    <div class="timeline-content">
                                        <h3><?php echo htmlspecialchars($timeline['agenda_name']); ?></h3>
                                        <p><?php echo date('H:i', strtotime($timeline['agenda_date'])); ?></p>
                                    </div>
                                </div>
                                <?php if ($index < count($timelines) - 1): ?>
                                    <div class="timeline-connector">
                                        <div class="timeline-line"></div>
                                        <div class="timeline-dot"></div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Timeline kegiatan akan diumumkan lebih lanjut.</p>
                    <?php endif; ?>
                </div>


            </div>

                <div class="event-actions">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <button onclick="openModal(<?php echo $event['id']; ?>)" class="btn-card">Daftar Event</button>
                    <?php else: ?>
                        <p>Silakan <a href="auth/login.php">login</a> untuk mendaftar event.</p>
                    <?php endif; ?>
                    <a href="categories.php?type=all" class="btn-card">Kembali ke Kategori</a>
                </div>
        </div>
    </main>

    <!-- Modal for Event Registration -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Daftar Event: <?php echo htmlspecialchars($event['title']); ?></h3>
            <form method="POST" action="user/register_event.php">
                <input type="hidden" name="event_id" id="modalEventId">
                <label for="name">Nama:</label>
                <input type="text" name="name" id="name" required>
                <label for="faculty">Asal Fakultas:</label>
                <select name="faculty" id="faculty" required>
                    <option value="">Pilih Fakultas</option>
                    <option value="Fakultas Agama Islam (FAI)">Fakultas Agama Islam (FAI)</option>
                    <option value="Fakultas Ekonomi dan Bisnis (FEB)">Fakultas Ekonomi dan Bisnis (FEB)</option>
                    <option value="Fakultas Hukum (FH)">Fakultas Hukum (FH)</option>
                    <option value="Fakultas Ilmu Sosial dan Ilmu Politik (FISIP)">Fakultas Ilmu Sosial dan Ilmu Politik (FISIP)</option>
                    <option value="Fakultas Kedokteran / Kedokteran dan Ilmu Kesehatan (FKIK)">Fakultas Kedokteran / Kedokteran dan Ilmu Kesehatan (FKIK)</option>
                    <option value="Fakultas Keguruan dan Ilmu Pendidikan (FKIP)">Fakultas Keguruan dan Ilmu Pendidikan (FKIP)</option>
                    <option value="Fakultas Teknik (FATEK)">Fakultas Teknik (FATEK)</option>
                    <option value="Fakultas Pertanian (FAPERTA)">Fakultas Pertanian (FAPERTA)</option>
                    <option value="Fakultas Ilmu Komputer & Teknologi Informasi (FIKTI)">Fakultas Ilmu Komputer & Teknologi Informasi (FIKTI)</option>
                    <option value="Program Pascasarjana">Program Pascasarjana</option>
                </select>
                <label for="phone">No HP:</label>
                <input type="text" name="phone" id="phone" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <button type="submit" class="btn-card">Daftar</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Sistem Manajemen Event & Volunteer Mahasiswa</p>
    </footer>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/animations.js"></script>
</body>
</html>
