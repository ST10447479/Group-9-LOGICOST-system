<?php include 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <div class="hero">
        <h1>South African Manufacturers Are Losing Money Every Day</h1>
        <p>Load shedding stops production. Rising fuel costs eat profits. Manual costing creates pricing errors. LogiCost SA solves all three.</p>
        <a href="route-map.php" class="btn">View Live Route Tracking</a>
        <a href="load-shedding.php" class="btn btn-outline">Check Load Shedding Status</a>
    </div>

    <h2 style="text-align: center; color: #1A2A5E;">The Three Problems We Solve</h2>
    <div class="grid-3">
        <div class="card">
            <div class="card-icon">⚡</div>
            <h3>Load Shedding</h3>
            <p>Power outages stop production and delay deliveries. Every outage costs thousands in lost productivity.</p>
            <p><strong>Our solution:</strong> Offline app that works when the power is out. <a href="load-shedding.php">View alerts →</a></p>
        </div>
        <div class="card">
            <div class="card-icon">⛽</div>
            <h3>Rising Fuel Costs</h3>
            <p>Transport is expensive. Without smart route planning, companies overpay for fuel by up to 15%.</p>
            <p><strong>Our solution:</strong> Route optimization that saves fuel and time. <a href="route-map.php">See live tracking →</a></p>
        </div>
        <div class="card">
            <div class="card-icon">📝</div>
            <h3>Manual Costing Errors</h3>
            <p>Excel spreadsheets lead to typos and wrong pricing. One mistake means losing money on every sale.</p>
            <p><strong>Our solution:</strong> Automated costing engine that calculates accurately every time. <a href="offline-mode.php">Learn about offline sync →</a></p>
        </div>
    </div>

    <div class="feature-box" style="text-align: center; background-color: #1A2A5E; color: white;">
        <p style="color: #D4AF37; font-size: 1.2rem;">One person. One app. Everything controlled.</p>
        <p>What used to take four people and three spreadsheets now takes one person and LogiCost SA. Works during load shedding. Syncs automatically when WiFi returns.</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>