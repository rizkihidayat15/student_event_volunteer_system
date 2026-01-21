<?php
// index.php - Homepage
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Event & Volunteer Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="cursor-glow"></div>
    <header>
        <nav>
            <div class="nav-container">
                <h1>Sistem Manajemen Event & Volunteer</h1>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
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
        <section class="banner">
            <div class="corak-batik"></div>
            <div class="glass-bg-container">
                <div class="color-effect"></div>
                <h1>Selamat Datang di Platform Manajemen Event & Volunteer Mahasiswa</h1>
            </div>
            <div class="code-editor">
                <div class="editor-header">
                    <div class="window-buttons">
                        <span class="button red"></span>
                        <span class="button yellow"></span>
                        <span class="button green"></span>
                    </div>
                    <span class="file-name">event-volunteer.js</span>
                </div>
                <div class="editor-content">
                    <div class="line-numbers">
                        <span>1</span>
                    </div>
                    <div class="code-area">
                        <span class="code-text comment" id="typed-text"></span><span class="cursor">|</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="batik-divider"></div>
        <section class="features">
            <div class="card">
                <div class="card-icon">🏆</div>
                <h3>Event Kompetisi</h3>
                <p>Tunjukkan kemampuanmu dalam berbagai kompetisi akademik dan non-akademik.</p>
                <a href="categories.php?type=kompetisi" class="btn-card">Lihat Event</a>
            </div>
            <div class="card">
                <div class="card-icon">🎓</div>
                <h3>Event Seminar</h3>
                <p>Perluas wawasan melalui seminar dan workshop inspiratif.</p>
                <a href="categories.php?type=seminar" class="btn-card">Lihat Event</a>
            </div>
            <div class="card">
                <div class="card-icon">🤝</div>
                <h3>Volunteer</h3>
                <p>Berkontribusi untuk masyarakat dan dapatkan pengalaman berharga.</p>
                <a href="categories.php?type=volunteer" class="btn-card">Lihat Job</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Sistem Manajemen Event & Volunteer Mahasiswa</p>
    </footer>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/animations.js"></script>
</body>
</html>
