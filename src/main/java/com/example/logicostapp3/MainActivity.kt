package com.example.logicostapp3

import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.navigation.fragment.NavHostFragment
import androidx.navigation.ui.setupWithNavController
import com.example.logicostapp3.api.SessionManager
import com.example.logicostapp3.databinding.ActivityMainBinding
import com.example.logicostapp3.ui.login.LoginActivity

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding
    private lateinit var session: SessionManager

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        Toast.makeText(this, "MainActivity Loaded", Toast.LENGTH_LONG).show()

        session = SessionManager(this)

        if (!session.isLoggedIn()) {
            startActivity(Intent(this, LoginActivity::class.java))
            finish()
            return
        }

        val navHostFragment =
            supportFragmentManager.findFragmentById(R.id.nav_host_fragment)

        if (navHostFragment == null) {
            Toast.makeText(
                this,
                "nav_host_fragment not found",
                Toast.LENGTH_LONG
            ).show()
            return
        }

        val navController =
            (navHostFragment as NavHostFragment).navController

        binding.bottomNav.setupWithNavController(navController)
    }

    fun logout() {
        session.logout()
        startActivity(Intent(this, LoginActivity::class.java))
        finish()
    }
}