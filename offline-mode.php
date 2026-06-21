<div class="container">
    <h1 style="color: #1A2A5E; text-align: center;">Offline Mode</h1>
    <p style="text-align: center;">Your data is safe. Your deliveries continue. Even when the power is out.</p>

    <!-- Offline Mode Status Card -->
    <div style="background: linear-gradient(135deg, #1A2A5E, #2A3A6E); border-radius: 16px; padding: 2rem; margin: 2rem 0; text-align: center; color: white;">
        <div style="font-size: 3rem;">📱 ↔️ ☁️</div>
        <h2 style="color: #D4AF37; margin: 0.5rem 0;">Offline Mode: ACTIVE</h2>
        <p>Your device is currently in offline mode. All data is being saved locally.</p>
        <div style="margin-top: 1rem; display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
            <div><span style="color: #D4AF37;">📦 156</span> records saved</div>
            <div><span style="color: #D4AF37;">🚚 12</span> deliveries tracked</div>
            <div><span style="color: #D4AF37;">💰 8</span> cost calculations</div>
        </div>
    </div>

    <!-- How Offline Mode Works -->
    <div class="grid-2">
        <div class="card">
            <h3>📥 When Offline (During Load Shedding)</h3>
            <ul style="text-align: left; margin-top: 1rem;">
                <li>✓ Scan barcodes - saved locally</li>
                <li>✓ Update inventory - saved locally</li>
                <li>✓ Record deliveries - saved locally</li>
                <li>✓ Calculate costs - saved locally</li>
                <li>✓ Track vehicle locations - cached locally</li>
            </ul>
            <p style="margin-top: 1rem; background-color: #fff3cd; padding: 0.5rem; border-radius: 8px;">⚡ No internet? No problem. Keep working.</p>
        </div>
        <div class="card">
            <h3>🔄 When Online (WiFi Returns)</h3>
            <ul style="text-align: left; margin-top: 1rem;">
                <li>✓ Automatic data synchronization</li>
                <li>✓ All records uploaded to cloud</li>
                <li>✓ Delivery statuses updated for customers</li>
                <li>✓ Reports generated with complete data</li>
                <li>✓ Real-time tracking resumes</li>
            </ul>
            <p style="margin-top: 1rem; background-color: #d4edda; padding: 0.5rem; border-radius: 8px;">🌐 WiFi restored. Data syncing automatically...</p>
        </div>
    </div>

    <!-- Sync Status Demo -->
    <div class="card" style="margin: 2rem 0;">
        <h3>📡 Sync Status</h3>
        <div style="background-color: #F0F4F8; border-radius: 10px; padding: 1rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span>📦 Inventory updates:</span>
                <span style="color: #28a745;">✓ Synced (23 records)</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span>🚚 Delivery records:</span>
                <span style="color: #28a745;">✓ Synced (12 records)</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span>💰 Cost calculations:</span>
                <span style="color: #ffc107;">⏳ Syncing... (8 pending)</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>📍 GPS tracking data:</span>
                <span style="color: #28a745;">✓ Synced (156 points)</span>
            </div>
        </div>
        <div style="margin-top: 1rem; text-align: center;">
            <button class="btn" onclick="alert('Manual sync initiated. All pending data will be synchronized.')">🔄 Sync Now (Manual)</button>
            <p style="font-size: 0.7rem; margin-top: 0.5rem;">Auto-sync every 30 seconds when WiFi is available</p>
        </div>
    </div>

    <!-- Benefits of Offline Mode -->
    <h3>✅ Why Offline Mode Matters for South Africa</h3>
    <div class="grid-3" style="margin-top: 1rem;">
        <div class="card">
            <div class="card-icon">⚡</div>
            <h3>No Data Loss</h3>
            <p>Every scan, every delivery, every cost calculation is saved to your device. Nothing is lost during load shedding.</p>
        </div>
        <div class="card">
            <div class="card-icon">🔄</div>
            <h3>Automatic Sync</h3>
            <p>When WiFi or mobile data returns, everything syncs automatically. No manual uploads needed.</p>
        </div>
        <div class="card">
            <div class="card-icon">📱</div>
            <h3>Continue Working</h3>
            <p>Your team keeps working during outages. No downtime. No excuses. No lost productivity.</p>
        </div>
    </div>

    <!-- Technical Explanation -->
    <div class="feature-box" style="margin-top: 2rem; background-color: #1A2A5E; color: white;">
        <p style="color: #D4AF37; font-weight: bold;">🔧 How It Works (Technical)</p>
        <p>LogiCost SA uses SQLite, a local database that lives on your device. When you scan a barcode or update inventory, the data is written to SQLite immediately. When the system detects an internet connection, a background service runs and syncs all pending changes to the central MySQL database. No user action required. No data conflicts. No duplicates.</p>
        <p style="margin-top: 0.5rem; font-size: 0.8rem;">Local storage: Up to 10,000 records | Sync queue: Unlimited | Conflict resolution: Last write wins</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>