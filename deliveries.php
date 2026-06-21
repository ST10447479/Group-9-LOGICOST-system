<?php
include 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $order = $_POST['order_number'];
        $dest = $_POST['destination'];
        $stmt = $conn->prepare("INSERT INTO deliveries (order_number, destination) VALUES (?, ?)");
        $stmt->bind_param("ss", $order, $dest);
        $stmt->execute();
    } elseif (isset($_POST['assign'])) {
        $id = $_POST['id'];
        $driver = $_POST['driver_id'];
        $conn->query("UPDATE deliveries SET driver_id = $driver, status = 'in_transit', assigned_at = NOW() WHERE id = $id");
    } elseif (isset($_POST['complete'])) {
        $id = $_POST['id'];
        $conn->query("UPDATE deliveries SET status = 'delivered', completed_at = NOW() WHERE id = $id");
    }
}

$deliveries = $conn->query("SELECT d.*, u.fullname as driver_name FROM deliveries d LEFT JOIN users u ON d.driver_id = u.id ORDER BY d.created_at DESC");
$drivers = $conn->query("SELECT id, fullname FROM users WHERE role = 'driver'");
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <h1 style="color: #1A2A5E;">Delivery Management</h1>
    
    <div class="card">
        <h3>Create New Delivery</h3>
        <form method="POST">
            <input type="text" name="order_number" placeholder="Order Number (e.g., #1004)" required style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem;">
            <input type="text" name="destination" placeholder="Destination" required style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem;">
            <button type="submit" name="add" class="btn">Create Delivery</button>
        </form>
    </div>

    <table class="data-table">
        <thead>
            <tr><th>Order #</th><th>Destination</th><th>Driver</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php while($row = $deliveries->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['order_number']; ?></td>
                <td><?php echo $row['destination']; ?></td>
                <td><?php echo $row['driver_name'] ?? 'Unassigned'; ?></td>
                <td>
                    <?php
                    $status = $row['status'];
                    if ($status == 'pending') echo '⏳ Pending';
                    elseif ($status == 'in_transit') echo '🚚 In Transit';
                    else echo '✅ Delivered';
                    ?>
                </td>
                <td>
                    <?php if ($row['status'] == 'pending'): ?>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <select name="driver_id" required>
                                <option value="">Select Driver</option>
                                <?php $drivers->data_seek(0); while($d = $drivers->fetch_assoc()): ?>
                                    <option value="<?php echo $d['id']; ?>"><?php echo $d['fullname']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <button type="submit" name="assign" class="btn" style="padding: 0.2rem 0.5rem;">Assign</button>
                        </form>
                    <?php elseif ($row['status'] == 'in_transit'): ?>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="complete" class="btn" style="padding: 0.2rem 0.5rem;">Complete</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>