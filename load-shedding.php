<?php include 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <h1 style="color: #1A2A5E; text-align: center;">Load Shedding Alerts</h1>
    <p style="text-align: center;">Real-time load shedding status and schedule impact</p>

    <!-- Current Stage Alert -->
    <div style="background: linear-gradient(135deg, #dc3545, #b02a37); border-radius: 12px; padding: 1.5rem; margin: 2rem 0; text-align: center; color: white;">
        <div style="font-size: 3rem;">⚠️⚡</div>
        <h2 style="color: white; margin: 0.5rem 0;">Stage 2 Load Shedding Active</h2>
        <p style="margin: 0;">Expected to continue until 22:00 today. Your deliveries have been automatically rescheduled.</p>
        <div style="margin-top: 1rem;">
            <span style="background: rgba(255,255,255,0.2); padding: 0.3rem 1rem; border-radius: 20px; font-size: 0.8rem;">Next outage: 14:00 - 16:30</span>
            <span style="background: rgba(255,255,255,0.2); padding: 0.3rem 1rem; border-radius: 20px; font-size: 0.8rem; margin-left: 0.5rem;">Affected zones: 3, 5, 8</span>
        </div>
    </div>

    <!-- Load Shedding Schedule -->
    <h3>📅 Today's Load Shedding Schedule</h3>
    <table class="data-table">
        <thead>
            <tr><th>Time Slot</th><th>Stage</th><th>Affected Zones</th><th>Impact on Deliveries</th><th>Status</th></tr>
        </thead>
        <tbody>
            <tr style="background-color: #fff3cd;">
                <td>06:00 - 08:30</td><td>Stage 2</td><td>Zones 1, 4, 7</td><td>Delays in Johannesburg area</td><td>✅ Completed</td>
            </tr>
            <tr style="background-color: #f8d7da;">
                <td>10:00 - 12:30</td><td>Stage 2</td><td>Zones 2, 5, 8</td><td>Delays in Pretoria area</td><td>⚠️ In Progress</td>
            </tr>
            <tr>
                <td>14:00 - 16:30</td><td>Stage 2</td><td>Zones 3, 6, 9</td><td>Delays in Midrand area</td><td>⏳ Upcoming</td>
            </tr>
            <tr>
                <td>18:00 - 20:30</td><td>Stage 1</td><td>Zones 1, 4</td><td>Minor delays expected</td><td>⏳ Upcoming</td>
            </tr>
        </tbody>
    </table>

    <!-- Alerts and Notifications -->
    <div class="grid-2" style="margin-top: 2rem;">
        <div class="card">
            <h3>🔔 Active Alerts</h3>
            <div style="margin-bottom: 1rem; padding: 0.5rem; background-color: #fff3cd; border-radius: 8px;">
                <p><strong>⚠️ Zone 5:</strong> Load shedding from 10:00 - 12:30. Truck #5 rerouted.</p>
            </div>
            <div style="margin-bottom: 1rem; padding: 0.5rem; background-color: #fff3cd; border-radius: 8px;">
                <p><strong>⚠️ Zone 8:</strong> Load shedding from 10:00 - 12:30. Van #3 delayed by 15 min.</p>
            </div>
            <div style="padding: 0.5rem; background-color: #d4edda; border-radius: 8px;">
                <p><strong>✅ Zone 1:</strong> Power restored at 08:30. Deliveries resuming.</p>
            </div>
        </div>
        <div class="card">
            <h3>📱 How LogiCost SA Helps</h3>
            <p><strong>✅ Offline mode:</strong> The app continues to work during power outages.</p>
            <p><strong>✅ Automatic rescheduling:</strong> Deliveries are rerouted around affected zones.</p>
            <p><strong>✅ Real-time alerts:</strong> Drivers receive notifications before outages begin.</p>
            <p><strong>✅ Data sync:</strong> All records are saved locally and sync when power returns.</p>
            <div style="margin-top: 1rem; background-color: #1A2A5E; padding: 0.8rem; border-radius: 8px; text-align: center;">
                <p style="color: #D4AF37; margin: 0;">⚡ "No data lost. No delivery missed."</p>
            </div>
        </div>
    </div>

    <!-- Load Shedding Tips -->
    <div class="feature-box" style="margin-top: 2rem;">
        <h3>💡 Tips During Load Shedding</h3>
        <ul>
            <li>Keep your device charged before scheduled outages</li>
            <li>The app works offline - continue scanning and recording deliveries</li>
            <li>Data will sync automatically when WiFi/power returns</li>
            <li>Drivers receive route updates via SMS before outages</li>
        </ul>
    </div>
</div>

<?php include 'includes/footer.php'; ?>