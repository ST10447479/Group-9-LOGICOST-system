<?php include 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <h1 style="color: #1A2A5E; text-align: center;">Live Fleet Tracking</h1>
    <p style="text-align: center; color: #666; margin-bottom: 2rem;">Real-time GPS monitoring | Works during load shedding</p>

    <!-- Professional Map Container -->
    <div style="background: linear-gradient(145deg, #e8f0e8 0%, #c8dcc8 100%); border-radius: 16px; padding: 0.5rem; box-shadow: 0 8px 20px rgba(0,0,0,0.15); margin-bottom: 2rem;">
        
        <!-- Map Area -->
        <div style="background: #a8c8a8; border-radius: 12px; height: 500px; position: relative; overflow: hidden; background-image: radial-gradient(circle at 10% 20%, rgba(100,140,80,0.3) 2%, transparent 2.5%), radial-gradient(circle at 80% 70%, rgba(100,140,80,0.3) 1.5%, transparent 2%); background-size: 40px 40px, 35px 35px;">
            
            <!-- Route Lines (Highways) -->
            <!-- N1 Highway (Main Route) -->
            <svg style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;">
                <!-- N1 - Johannesburg to Pretoria -->
                <line x1="15%" y1="55%" x2="75%" y2="30%" stroke="#FFD700" stroke-width="5" stroke-dasharray="8,4" opacity="0.8"/>
                <!-- N3 - Durban route -->
                <line x1="75%" y1="30%" x2="85%" y2="75%" stroke="#FFD700" stroke-width="4" stroke-dasharray="8,4" opacity="0.6"/>
                <!-- N2 - Cape Town route -->
                <line x1="15%" y1="55%" x2="10%" y2="80%" stroke="#FFD700" stroke-width="4" stroke-dasharray="8,4" opacity="0.5"/>
                
                <!-- Animated moving dot on N1 -->
                <circle r="6" fill="#FFD700" stroke="#1A2A5E" stroke-width="2">
                    <animateMotion dur="8s" repeatCount="indefinite" path="M15%,55% L75%,30%" />
                </circle>
            </svg>

            <!-- City Markers with Glow Effect -->
            <div style="position: absolute; bottom: 38%; left: 12%; text-align: center;">
                <div style="background: white; width: 14px; height: 14px; border-radius: 50%; margin: 0 auto; box-shadow: 0 0 0 4px rgba(26,42,94,0.3);"></div>
                <div style="background: #1A2A5E; color: white; padding: 0.2rem 0.8rem; border-radius: 20px; font-size: 0.75rem; font-weight: bold; margin-top: 0.3rem; white-space: nowrap;">🏙️ Johannesburg</div>
            </div>

            <div style="position: absolute; top: 25%; right: 18%; text-align: center;">
                <div style="background: white; width: 14px; height: 14px; border-radius: 50%; margin: 0 auto; box-shadow: 0 0 0 4px rgba(26,42,94,0.3);"></div>
                <div style="background: #1A2A5E; color: white; padding: 0.2rem 0.8rem; border-radius: 20px; font-size: 0.75rem; font-weight: bold; margin-top: 0.3rem; white-space: nowrap;">🏙️ Pretoria</div>
            </div>

            <div style="position: absolute; bottom: 18%; right: 12%; text-align: center;">
                <div style="background: white; width: 14px; height: 14px; border-radius: 50%; margin: 0 auto; box-shadow: 0 0 0 4px rgba(26,42,94,0.3);"></div>
                <div style="background: #1A2A5E; color: white; padding: 0.2rem 0.8rem; border-radius: 20px; font-size: 0.75rem; font-weight: bold; margin-top: 0.3rem; white-space: nowrap;">🏙️ Durban</div>
            </div>

            <div style="position: absolute; top: 35%; left: 38%; text-align: center;">
                <div style="background: white; width: 10px; height: 10px; border-radius: 50%; margin: 0 auto; box-shadow: 0 0 0 3px rgba(26,42,94,0.3);"></div>
                <div style="background: #1A2A5E; color: white; padding: 0.15rem 0.6rem; border-radius: 15px; font-size: 0.65rem; font-weight: bold; margin-top: 0.2rem; white-space: nowrap;">Midrand</div>
            </div>

            <!-- Vehicle Markers with Cards -->
            <!-- Truck #5 -->
            <div style="position: absolute; top: 40%; left: 30%; background: linear-gradient(135deg, #1A2A5E, #2A3A6E); border-radius: 12px; padding: 0.4rem 1rem; color: white; font-size: 0.75rem; font-weight: bold; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.2); border-left: 3px solid #D4AF37;">
                <span>🚛</span>
                <div>
                    <div>Truck #5 - Thabo Nkosi</div>
                    <div style="font-size: 0.6rem; opacity: 0.8;">Speed: 85 km/h | ETA: 45 min</div>
                </div>
            </div>

            <!-- Van #3 -->
            <div style="position: absolute; top: 33%; left: 48%; background: linear-gradient(135deg, #1A2A5E, #2A3A6E); border-radius: 12px; padding: 0.4rem 1rem; color: white; font-size: 0.75rem; font-weight: bold; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.2); border-left: 3px solid #D4AF37;">
                <span>🚐</span>
                <div>
                    <div>Van #3 - Sipho Dlamini</div>
                    <div style="font-size: 0.6rem; opacity: 0.8;">Speed: 72 km/h | ETA: 20 min</div>
                </div>
            </div>

            <!-- Truck #2 (Near Destination - Green) -->
            <div style="position: absolute; bottom: 20%; right: 22%; background: linear-gradient(135deg, #1a5e1a, #2a7e2a); border-radius: 12px; padding: 0.4rem 1rem; color: white; font-size: 0.75rem; font-weight: bold; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.2); border-left: 3px solid #D4AF37;">
                <span>✅</span>
                <div>
                    <div>Truck #2 - Priya Naidoo</div>
                    <div style="font-size: 0.6rem; opacity: 0.8;">Near Destination | ETA: 15 min</div>
                </div>
            </div>

            <!-- Van #7 (Pending - Orange) -->
            <div style="position: absolute; top: 20%; left: 15%; background: linear-gradient(135deg, #cc7a00, #e69500); border-radius: 12px; padding: 0.4rem 1rem; color: #1A2A5E; font-size: 0.75rem; font-weight: bold; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                <span>⏳</span>
                <div>
                    <div>Van #7 - James Mbeki</div>
                    <div style="font-size: 0.6rem;">Status: Pending Pickup</div>
                </div>
            </div>

            <!-- Live Tracking Badge -->
            <div style="position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.75); backdrop-filter: blur(4px); border-radius: 30px; padding: 0.4rem 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <span style="display: inline-block; width: 10px; height: 10px; background: #ff3333; border-radius: 50%; animation: pulse 1.5s infinite;"></span>
                <span style="color: white; font-size: 0.75rem; font-weight: bold;">LIVE TRACKING</span>
            </div>

            <!-- Map Overlay Info -->
            <div style="position: absolute; bottom: 15px; left: 15px; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); border-radius: 8px; padding: 0.3rem 0.8rem;">
                <span style="color: white; font-size: 0.7rem;">🗺️ N1 Highway Corridor | Last updated: Just now</span>
            </div>

            <!-- Pulse Animation for Live Badge -->
            <style>
                @keyframes pulse {
                    0% { opacity: 1; transform: scale(1); }
                    50% { opacity: 0.5; transform: scale(1.2); }
                    100% { opacity: 1; transform: scale(1); }
                }
            </style>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
        <div class="card" style="text-align: center; padding: 1.2rem;">
            <div style="font-size: 2rem;">🚚</div>
            <div style="font-size: 2rem; font-weight: bold; color: #1A2A5E;">12</div>
            <div style="color: #666;">Active Deliveries</div>
            <div style="font-size: 0.7rem; color: #28a745; margin-top: 0.3rem;">↑ 3 from yesterday</div>
        </div>
        <div class="card" style="text-align: center; padding: 1.2rem;">
            <div style="font-size: 2rem;">✅</div>
            <div style="font-size: 2rem; font-weight: bold; color: #28a745;">7</div>
            <div style="color: #666;">Completed Today</div>
            <div style="font-size: 0.7rem; color: #28a745;">↑ 2 from yesterday</div>
        </div>
        <div class="card" style="text-align: center; padding: 1.2rem;">
            <div style="font-size: 2rem;">🚚</div>
            <div style="font-size: 2rem; font-weight: bold; color: #D4AF37;">5</div>
            <div style="color: #666;">In Transit</div>
            <div style="font-size: 0.7rem; color: #ffc107;">On schedule</div>
        </div>
        <div class="card" style="text-align: center; padding: 1.2rem;">
            <div style="font-size: 2rem;">⏳</div>
            <div style="font-size: 2rem; font-weight: bold; color: #ffc107;">2</div>
            <div style="color: #666;">Pending Pickup</div>
            <div style="font-size: 0.7rem; color: #ffc107;">Awaiting dispatch</div>
        </div>
    </div>

    <!-- Detailed Delivery Table -->
    <h3 style="color: #1A2A5E; margin-bottom: 1rem;">📋 Active Delivery Details</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Vehicle</th>
                <th>Driver</th>
                <th>Current Location</th>
                <th>Destination</th>
                <th>Distance Left</th>
                <th>ETA</th>
                <th>Status</th>
                <th>Last Update</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-left: 3px solid #D4AF37;">
                <td>🚛 Truck #5 (GP 123-456)</td>
                <td>Thabo Nkosi</td>
                <td>Johannesburg CBD</td>
                <td>Pretoria</td>
                <td>32 km</td>
                <td>45 min</td>
                <td style="color: #D4AF37; font-weight: bold;">🚚 In Transit</td>
                <td>2 min ago</td>
             </tr>
            <tr style="border-left: 3px solid #D4AF37;">
                <td>🚐 Van #3 (GP 789-012)</td>
                <td>Sipho Dlamini</td>
                <td>Midrand</td>
                <td>Centurion</td>
                <td>15 km</td>
                <td>20 min</td>
                <td style="color: #D4AF37; font-weight: bold;">🚚 In Transit</td>
                <td>5 min ago</td>
             </tr>
            <tr style="border-left: 3px solid #28a745;">
                <td>🚛 Truck #2 (KZN 456-789)</td>
                <td>Priya Naidoo</td>
                <td>Durban Port</td>
                <td>Pinetown</td>
                <td>8 km</td>
                <td>15 min</td>
                <td style="color: #28a745; font-weight: bold;">✅ Near Destination</td>
                <td>1 min ago</td>
             </tr>
            <tr style="border-left: 3px solid #ffc107;">
                <td>🚐 Van #7 (WC 321-654)</td>
                <td>James Mbeki</td>
                <td>Cape Town Depot</td>
                <td>Stellenbosch</td>
                <td>55 km</td>
                <td>55 min</td>
                <td style="color: #ffc107; font-weight: bold;">⏳ Pending Pickup</td>
                <td>10 min ago</td>
             </tr>
        </tbody>
    </table>

    <!-- Offline Notice -->
    <div class="feature-box" style="text-align: center; margin-top: 2rem; background: linear-gradient(135deg, #1A2A5E, #2A3A6E); color: white; border-left-color: #D4AF37;">
        <p style="color: #D4AF37; font-weight: bold;">⚡ Works During Load Shedding</p>
        <p>This tracking system continues to operate offline. All vehicle positions are cached locally and sync automatically when power returns.</p>
        <p style="font-size: 0.8rem; margin-top: 0.5rem;">🚛 12 active vehicles | 📍 Real-time GPS | 🔄 Auto-sync enabled</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>