<?php
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $_SESSION['user_role'] ?? '';
?>
<header>
    <nav>
        <div class="logo">
            <h1>LogiCost SA</h1>
            <p>Smart manufacturing for South Africa</p>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="route-map.php">Route Map</a></li>
            <li><a href="load-shedding.php">Load Shedding Alerts</a></li>
            <li><a href="offline-mode.php">Offline Mode</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>