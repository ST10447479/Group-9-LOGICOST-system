package com.example.logicostapp3.ui.register

import android.os.Bundle
import android.view.View
import android.widget.ArrayAdapter
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import com.example.logicostapp3.api.RetrofitClient
import com.example.logicostapp3.databinding.ActivityRegisterBinding
import com.example.logicostapp3.model.RegisterRequest
import kotlinx.coroutines.launch

class RegisterActivity : AppCompatActivity() {

    private lateinit var binding: ActivityRegisterBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityRegisterBinding.inflate(layoutInflater)
        setContentView(binding.root)

        // Role spinner
        val roles = arrayOf("warehouse", "manager", "driver")
        val roleLabels = arrayOf("Warehouse Staff", "Operations Manager", "Driver")
        val adapter = ArrayAdapter(this, android.R.layout.simple_spinner_item, roleLabels)
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
        binding.spinnerRole.adapter = adapter

        binding.btnRegister.setOnClickListener { attemptRegister(roles) }
        binding.tvLogin.setOnClickListener { finish() }
    }

    private fun attemptRegister(roles: Array<String>) {
        val fullname = binding.etFullname.text.toString().trim()
        val email    = binding.etEmail.text.toString().trim()
        val password = binding.etPassword.text.toString()
        val role     = roles[binding.spinnerRole.selectedItemPosition]

        if (fullname.isEmpty() || email.isEmpty() || password.isEmpty()) {
            Toast.makeText(this, "Please fill in all fields", Toast.LENGTH_SHORT).show()
            return
        }
        if (password.length < 6) {
            Toast.makeText(this, "Password must be at least 6 characters", Toast.LENGTH_SHORT).show()
            return
        }

        setLoading(true)
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.register(
                    RegisterRequest(fullname, email, password, role)
                )
                if (response.isSuccessful && response.body()?.success == true) {
                    Toast.makeText(this@RegisterActivity, "Registered successfully! Please log in.", Toast.LENGTH_LONG).show()
                    finish()
                } else {
                    showError(response.body()?.message ?: "Registration failed")
                }
            } catch (e: Exception) {
                showError("Network error: ${e.localizedMessage}")
            } finally {
                setLoading(false)
            }
        }
    }

    private fun setLoading(loading: Boolean) {
        binding.btnRegister.isEnabled = !loading
        binding.progressBar.visibility = if (loading) View.VISIBLE else View.GONE
    }

    private fun showError(msg: String) {
        binding.tvError.text = msg
        binding.tvError.visibility = View.VISIBLE
    }
}
