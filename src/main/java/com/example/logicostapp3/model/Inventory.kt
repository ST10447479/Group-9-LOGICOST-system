package com.example.logicostapp3.model

import com.google.gson.annotations.SerializedName

data class InventoryItem(
    @SerializedName("id") val id: Int = 0,
    @SerializedName("product_name") val productName: String = "",
    @SerializedName("quantity") val quantity: Int = 0,
    @SerializedName("unit") val unit: String = "units",
    @SerializedName("expiry_date") val expiryDate: String? = null,
    @SerializedName("barcode") val barcode: String? = null,
    @SerializedName("reorder_level") val reorderLevel: Int = 50,
    @SerializedName("created_at") val createdAt: String = ""
) {
    val isLowStock: Boolean get() = quantity <= reorderLevel
}

data class InventoryResponse(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String = "",
    @SerializedName("data") val data: List<InventoryItem>? = null
)

data class InventoryActionResponse(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String
)

data class AddInventoryRequest(
    @SerializedName("product_name") val productName: String,
    @SerializedName("quantity") val quantity: Int,
    @SerializedName("unit") val unit: String,
    @SerializedName("reorder_level") val reorderLevel: Int
)

data class UpdateQuantityRequest(
    @SerializedName("id") val id: Int,
    @SerializedName("quantity") val quantity: Int
)
