package com.example.logicostapp3.model

import com.google.gson.annotations.SerializedName

data class Delivery(
    @SerializedName("id") val id: Int = 0,
    @SerializedName("order_number") val orderNumber: String = "",
    @SerializedName("destination") val destination: String = "",
    @SerializedName("driver_id") val driverId: Int? = null,
    @SerializedName("driver_name") val driverName: String? = null,
    @SerializedName("status") val status: String = "pending",
    @SerializedName("assigned_at") val assignedAt: String? = null,
    @SerializedName("completed_at") val completedAt: String? = null,
    @SerializedName("created_at") val createdAt: String = ""
) {
    val statusEmoji: String get() = when (status) {
        "pending"    -> "⏳"
        "in_transit" -> "🚚"
        "delivered"  -> "✅"
        "cancelled"  -> "❌"
        else         -> "❓"
    }
    val statusLabel: String get() = when (status) {
        "pending"    -> "Pending"
        "in_transit" -> "In Transit"
        "delivered"  -> "Delivered"
        "cancelled"  -> "Cancelled"
        else         -> status
    }
}

data class DeliveryResponse(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String = "",
    @SerializedName("data") val data: List<Delivery>? = null
)

data class DeliveryActionResponse(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String
)

data class AddDeliveryRequest(
    @SerializedName("order_number") val orderNumber: String,
    @SerializedName("destination") val destination: String
)

data class AssignDriverRequest(
    @SerializedName("id") val id: Int,
    @SerializedName("driver_id") val driverId: Int
)

data class UpdateStatusRequest(
    @SerializedName("id") val id: Int,
    @SerializedName("status") val status: String
)
