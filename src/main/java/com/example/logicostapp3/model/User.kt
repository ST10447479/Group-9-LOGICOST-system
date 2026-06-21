package com.example.logicostapp3.model

import com.google.gson.annotations.SerializedName

data class User(
    @SerializedName("id") val id: Int = 0,
    @SerializedName("fullname") val fullname: String = "",
    @SerializedName("email") val email: String = "",
    @SerializedName("role") val role: String = "",
    @SerializedName("created_at") val createdAt: String = ""
)

data class LoginRequest(
    @SerializedName("email") val email: String,
    @SerializedName("password") val password: String
)

data class RegisterRequest(
    @SerializedName("fullname") val fullname: String,
    @SerializedName("email") val email: String,
    @SerializedName("password") val password: String,
    @SerializedName("role") val role: String
)

data class AuthResponse(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String,
    @SerializedName("user") val user: User? = null,
    @SerializedName("token") val token: String? = null
)
