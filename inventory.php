<?php
include 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle Add/Edit/Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $unit = $_POST['unit'];
        $reorder = $_POST['reorder_level'];
        $stmt = $conn->prepare("INSERT INTO inventory (product_name, quantity, unit, reorder_level) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi", $name, $quantity, $unit, $reorder);
        $stmt->execute();
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $conn->query("DELETE FROM inventory WHERE id = $id");
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $conn->query("UPDATE inventory SET quantity = $quantity WHERE id = $id");
    }
}

$inventory = $conn->query("SELECT * FROM inventory ORDER BY product_name");
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <h1 style="color: #1A2A5E;">Inventory Management</h1>
    
    <!-- Add Form -->
    <div class="card">
        <h3>Add New Product</h3>
        <form method="POST">
            <input type="text" name="product_name" placeholder="Product Name" required style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem;">
            <input type="number" name="quantity" placeholder="Quantity" required style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem;">
            <input type="text" name="unit" placeholder="Unit (e.g., units, kg, liters)" value="units" style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem;">
            <input type="number" name="reorder_level" placeholder="Reorder Level" value="50" style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem;">
            <button type="submit" name="add" class="btn">Add Product</button>
        </form>
    </div>

    <!-- Inventory Table -->
    <table class="data-table">
        <thead>
            <tr><th>Product</th><th>Quantity</th><th>Unit</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php while($row = $inventory->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['product_name']; ?></td>
                <td>
                    <form method="POST" style="display: flex; gap: 0.5rem;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" style="width: 80px;">
                        <button type="submit" name="update" class="btn" style="padding: 0.2rem 0.5rem;">Update</button>
                    </form>
                </td>
                <td><?php echo $row['unit']; ?></td>
                <td><?php echo ($row['quantity'] <= $row['reorder_level']) ? '⚠️ Low Stock' : '✅ In Stock'; ?></td>
                <td>
                    <form method="POST" onsubmit="return confirm('Delete this product?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete" class="btn" style="background-color: #dc3545; padding: 0.2rem 0.5rem;">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>