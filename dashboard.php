<?php
include 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get counts for dashboard
$inventory_count = $conn->query("SELECT COUNT(*) as count FROM inventory")->fetch_assoc()['count'];
$delivery_count = $conn->query("SELECT COUNT(*) as count FROM deliveries")->fetch_assoc()['count'];
$pending_count = $conn->query("SELECT COUNT(*) as count FROM deliveries WHERE status = 'pending'")->fetch_assoc()['count'];
$low_stock = $conn->query("SELECT COUNT(*) as count FROM inventory WHERE quantity <= reorder_level")->fetch_assoc()['count'];
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <h1 style="color: #1A2A5E;">Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p>Role: <?php echo ucfirst($_SESSION['user_role']); ?></p>

    <div class="grid-3">
        <div class="card">
            <div class="card-icon">📦</div>
            <h3><?php echo $inventory_count; ?></h3>
            <p>Total Products</p>
        </div>
        <div class="card">
            <div class="card-icon">🚚</div>
            <h3><?php echo $delivery_count; ?></h3>
            <p>Total Deliveries</p>
        </div>
        <div class="card">
            <div class="card-icon">⏳</div>
            <h3><?php echo $pending_count; ?></h3>
            <p>Pending Deliveries</p>
        </div>
        <div class="card">
            <div class="card-icon">⚠️</div>
            <h3><?php echo $low_stock; ?></h3>
            <p>Low Stock Alerts</p>
        </div>
    </div>

    <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 2rem;">
        <a href="inventory.php" class="btn">Manage Inventory</a>
        <a href="deliveries.php" class="btn">Manage Deliveries</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>