package com.example.logicostapp3.api

import com.example.logicostapp3.model.*
import retrofit2.Response
import retrofit2.http.*

interface ApiService {

    // ── Auth ──────────────────────────────────────────────────────────────
    @POST("login.php")
    suspend fun login(@Body request: LoginRequest): Response<AuthResponse>

    @POST("register.php")
    suspend fun register(@Body request: RegisterRequest): Response<AuthResponse>

    // ── Dashboard ─────────────────────────────────────────────────────────
    @GET("dashboard.php")
    suspend fun getDashboardStats(
        @Header("Authorization") token: String
    ): Response<DashboardResponse>

    // ── Inventory ─────────────────────────────────────────────────────────
    @GET("inventory.php")
    suspend fun getInventory(
        @Header("Authorization") token: String
    ): Response<InventoryResponse>

    @POST("inventory.php")
    suspend fun addInventoryItem(
        @Header("Authorization") token: String,
        @Body request: AddInventoryRequest
    ): Response<InventoryActionResponse>

    @PUT("inventory.php")
    suspend fun updateQuantity(
        @Header("Authorization") token: String,
        @Body request: UpdateQuantityRequest
    ): Response<InventoryActionResponse>

    @HTTP(method = "DELETE", path = "inventory.php", hasBody = true)
    suspend fun deleteInventoryItem(
        @Header("Authorization") token: String,
        @Body body: Map<String, Int>
    ): Response<InventoryActionResponse>

    // ── Deliveries ────────────────────────────────────────────────────────
    @GET("deliveries.php")
    suspend fun getDeliveries(
        @Header("Authorization") token: String
    ): Response<DeliveryResponse>

    @POST("deliveries.php")
    suspend fun addDelivery(
        @Header("Authorization") token: String,
        @Body request: AddDeliveryRequest
    ): Response<DeliveryActionResponse>

    @PUT("deliveries.php")
    suspend fun assignDriver(
        @Header("Authorization") token: String,
        @Body request: AssignDriverRequest
    ): Response<DeliveryActionResponse>

    @PATCH("deliveries.php")
    suspend fun updateDeliveryStatus(
        @Header("Authorization") token: String,
        @Body request: UpdateStatusRequest
    ): Response<DeliveryActionResponse>

    // ── Users (drivers list) ──────────────────────────────────────────────
    @GET("users.php")
    suspend fun getDrivers(
        @Header("Authorization") token: String
    ): Response<DriversResponse>
}

data class DriversResponse(
    val success: Boolean,
    val data: List<com.example.logicostapp3.model.User>? = null
)
