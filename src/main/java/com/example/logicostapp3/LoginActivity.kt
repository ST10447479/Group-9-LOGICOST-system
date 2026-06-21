package com.example.logicostapp3.ui.login

import android.content.Intent
import android.os.Bundle
import android.view.View
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import com.example.logicostapp3.MainActivity
import com.example.logicostapp3.api.RetrofitClient
import com.example.logicostapp3.api.SessionManager
import com.example.logicostapp3.databinding.ActivityLoginBinding
import com.example.logicostapp3.model.LoginRequest
import com.example.logicostapp3.ui.register.RegisterActivity
import kotlinx.coroutines.launch

class LoginActivity : AppCompatActivity() {

    private lateinit var binding: ActivityLoginBinding
    private lateinit var session: SessionManager

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityLoginBinding.inflate(layoutInflater)
        setContentView(binding.root)

        session = SessionManager(this)
        if (session.isLoggedIn()) {
            goToDashboard()
            return
        }

        binding.btnLogin.setOnClickListener { attemptLogin() }
        binding.tvRegister.setOnClickListener {
            startActivity(Intent(this, RegisterActivity::class.java))
        }

        // Demo shortcut
        binding.tvDemo.setOnClickListener {
            binding.etEmail.setText("demo@logiscost.co.za")
            binding.etPassword.setText("demo123")
        }
    }

    private fun attemptLogin() {
        val email    = binding.etEmail.text.toString().trim()
        val password = binding.etPassword.text.toString()

        if (email.isEmpty() || password.isEmpty()) {
            Toast.makeText(this, "Please fill in all fields", Toast.LENGTH_SHORT).show()
            return
        }

        setLoading(true)
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.login(LoginRequest(email, password))
                if (response.isSuccessful) {
                    val body = response.body()
                    if (body?.success == true && body.user != null) {
                        session.saveSession(
                            token = body.token ?: "",
                            id    = body.user.id,
                            name  = body.user.fullname,
                            email = body.user.email,
                            role  = body.user.role
                        )
                        goToDashboard()
                    } else {
                        showError(body?.message ?: "Login failed")
                    }
                } else {
                    showError("Server error: ${response.code()}")
                }
            } catch (e: Exception) {
                showError("Network error: ${e.localizedMessage}")
            } finally {
                setLoading(false)
            }
        }
    }

    private fun goToDashboard() {
        startActivity(Intent(this, MainActivity::class.java))
        finish()
    }

    private fun setLoading(loading: Boolean) {
        binding.btnLogin.isEnabled = !loading
        binding.progressBar.visibility = if (loading) View.VISIBLE else View.GONE
    }

    private fun showError(msg: String) {
        binding.tvError.text = msg
        binding.tvError.visibility = View.VISIBLE
    }
}
