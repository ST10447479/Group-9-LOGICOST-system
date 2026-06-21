package com.example.logicostapp3.ui.dashboard

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.fragment.app.Fragment
import androidx.lifecycle.lifecycleScope
import com.example.logicostapp3.MainActivity
import com.example.logicostapp3.api.RetrofitClient
import com.example.logicostapp3.api.SessionManager
import com.example.logicostapp3.databinding.FragmentDashboardBinding
import kotlinx.coroutines.launch

class DashboardFragment : Fragment() {

    private var _binding: FragmentDashboardBinding? = null
    private val binding get() = _binding!!
    private lateinit var session: SessionManager

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentDashboardBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        session = SessionManager(requireContext())

        binding.tvWelcome.text = "Welcome, ${session.getUserName()}!"
        binding.tvRole.text    = "Role: ${session.getUserRole().replaceFirstChar { it.uppercaseChar() }}"

        binding.btnLogout.setOnClickListener {
            (activity as? MainActivity)?.logout()
        }

        binding.swipeRefresh.setOnRefreshListener { loadStats() }
        loadStats()
    }

    private fun loadStats() {
        binding.swipeRefresh.isRefreshing = true
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.getDashboardStats(session.getToken())
                if (response.isSuccessful && response.body()?.success == true) {
                    val stats = response.body()!!.data!!
                    binding.tvInventoryCount.text  = stats.inventoryCount.toString()
                    binding.tvDeliveryCount.text   = stats.deliveryCount.toString()
                    binding.tvPendingCount.text    = stats.pendingCount.toString()
                    binding.tvLowStockCount.text   = stats.lowStock.toString()
                    binding.tvInTransitCount.text  = stats.inTransitCount.toString()
                    binding.tvDeliveredCount.text  = stats.deliveredCount.toString()
                } else {
                    Toast.makeText(requireContext(), "Failed to load stats", Toast.LENGTH_SHORT).show()
                }
            } catch (e: Exception) {
                Toast.makeText(requireContext(), "Network error: ${e.localizedMessage}", Toast.LENGTH_SHORT).show()
            } finally {
                binding.swipeRefresh.isRefreshing = false
            }
        }
    }

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}
