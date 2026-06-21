<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $message = $_POST['message'];
    
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, company, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $company, $message);
    
    if ($stmt->execute()) {
        $success = "Thank you! We will contact you within 24 hours.";
    } else {
        $error = "Message could not be sent. Please try again.";
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <h1 style="color: #1A2A5E; text-align: center;">Contact Us</h1>
    
    <?php if (isset($success)): ?>
        <div class="alert-banner" style="background-color: #d4edda; color: #155724;"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <div class="alert-banner" style="background-color: #f8d7da; color: #721c24;"><?php echo $error; ?></div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <div class="card">
            <h3>Send us a message</h3>
            <form method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" name="company">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
        <div class="card">
            <h3>Contact Information</h3>
            <p><strong>Email:</strong> info@logiscost.co.za</p>
            <p><strong>Phone:</strong> +27 11 123 4567</p>
            <p><strong>Address:</strong> Rosebank College, Johannesburg</p>
            <p><strong>Office Hours:</strong> Mon-Fri, 8am-5pm</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>