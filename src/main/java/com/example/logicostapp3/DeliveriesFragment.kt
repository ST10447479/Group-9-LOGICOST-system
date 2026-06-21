package com.example.logicostapp3.ui.deliveries

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ArrayAdapter
import android.widget.Toast
import androidx.appcompat.app.AlertDialog
import androidx.fragment.app.Fragment
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.logicostapp3.api.RetrofitClient
import com.example.logicostapp3.api.SessionManager
import com.example.logicostapp3.databinding.DialogAddDeliveryBinding
import com.example.logicostapp3.databinding.DialogAssignDriverBinding
import com.example.logicostapp3.databinding.FragmentDeliveriesBinding
import com.example.logicostapp3.model.*
import kotlinx.coroutines.launch

class DeliveriesFragment : Fragment() {

    private var _binding: FragmentDeliveriesBinding? = null
    private val binding get() = _binding!!
    private lateinit var session: SessionManager
    private lateinit var adapter: DeliveryAdapter
    private var driversList: List<User> = emptyList()

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentDeliveriesBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        session = SessionManager(requireContext())

        adapter = DeliveryAdapter(
            onAssign   = { delivery -> showAssignDialog(delivery) },
            onComplete = { delivery -> completeDelivery(delivery) }
        )
        binding.rvDeliveries.layoutManager = LinearLayoutManager(requireContext())
        binding.rvDeliveries.adapter = adapter

        binding.fabAdd.setOnClickListener { showAddDialog() }
        binding.swipeRefresh.setOnRefreshListener { loadDeliveries() }
        loadDeliveries()
        loadDrivers()
    }

    private fun loadDeliveries() {
        binding.swipeRefresh.isRefreshing = true
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.getDeliveries(session.getToken())
                if (response.isSuccessful && response.body()?.success == true) {
                    val deliveries = response.body()!!.data ?: emptyList()
                    adapter.submitList(deliveries)
                    binding.tvEmpty.visibility = if (deliveries.isEmpty()) View.VISIBLE else View.GONE
                } else {
                    toast("Failed to load deliveries")
                }
            } catch (e: Exception) {
                toast("Network error: ${e.localizedMessage}")
            } finally {
                binding.swipeRefresh.isRefreshing = false
            }
        }
    }

    private fun loadDrivers() {
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.getDrivers(session.getToken())
                if (response.isSuccessful && response.body()?.success == true) {
                    driversList = response.body()!!.data ?: emptyList()
                }
            } catch (_: Exception) {}
        }
    }

    private fun showAddDialog() {
        val dialogBinding = DialogAddDeliveryBinding.inflate(layoutInflater)
        AlertDialog.Builder(requireContext())
            .setTitle("Create New Delivery")
            .setView(dialogBinding.root)
            .setPositiveButton("Create") { _, _ ->
                val order = dialogBinding.etOrderNumber.text.toString().trim()
                val dest  = dialogBinding.etDestination.text.toString().trim()
                if (order.isNotEmpty() && dest.isNotEmpty()) addDelivery(order, dest)
                else toast("All fields are required")
            }
            .setNegativeButton("Cancel", null)
            .show()
    }

    private fun addDelivery(order: String, dest: String) {
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.addDelivery(
                    session.getToken(),
                    AddDeliveryRequest(order, dest)
                )
                if (response.isSuccessful && response.body()?.success == true) {
                    toast("Delivery created")
                    loadDeliveries()
                } else {
                    toast(response.body()?.message ?: "Failed to create delivery")
                }
            } catch (e: Exception) {
                toast("Network error: ${e.localizedMessage}")
            }
        }
    }

    private fun showAssignDialog(delivery: Delivery) {
        if (driversList.isEmpty()) {
            toast("No drivers available")
            return
        }
        val dialogBinding = DialogAssignDriverBinding.inflate(layoutInflater)
        val driverNames = driversList.map { it.fullname }.toTypedArray()
        val spinnerAdapter = ArrayAdapter(
            requireContext(),
            android.R.layout.simple_spinner_item,
            driverNames
        )
        spinnerAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
        dialogBinding.spinnerDrivers.adapter = spinnerAdapter

        AlertDialog.Builder(requireContext())
            .setTitle("Assign Driver to ${delivery.orderNumber}")
            .setView(dialogBinding.root)
            .setPositiveButton("Assign") { _, _ ->
                val selectedDriver = driversList[dialogBinding.spinnerDrivers.selectedItemPosition]
                assignDriver(delivery, selectedDriver.id)
            }
            .setNegativeButton("Cancel", null)
            .show()
    }

    private fun assignDriver(delivery: Delivery, driverId: Int) {
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.assignDriver(
                    session.getToken(),
                    AssignDriverRequest(delivery.id, driverId)
                )
                if (response.isSuccessful && response.body()?.success == true) {
                    toast("Driver assigned")
                    loadDeliveries()
                } else {
                    toast("Failed to assign driver")
                }
            } catch (e: Exception) {
                toast("Network error: ${e.localizedMessage}")
            }
        }
    }

    private fun completeDelivery(delivery: Delivery) {
        AlertDialog.Builder(requireContext())
            .setTitle("Complete Delivery")
            .setMessage("Mark ${delivery.orderNumber} as delivered?")
            .setPositiveButton("Yes") { _, _ ->
                lifecycleScope.launch {
                    try {
                        val response = RetrofitClient.instance.updateDeliveryStatus(
                            session.getToken(),
                            UpdateStatusRequest(delivery.id, "delivered")
                        )
                        if (response.isSuccessful && response.body()?.success == true) {
                            toast("Delivery completed!")
                            loadDeliveries()
                        } else {
                            toast("Failed to update status")
                        }
                    } catch (e: Exception) {
                        toast("Network error: ${e.localizedMessage}")
                    }
                }
            }
            .setNegativeButton("Cancel", null)
            .show()
    }

    private fun toast(msg: String) =
        Toast.makeText(requireContext(), msg, Toast.LENGTH_SHORT).show()

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}
