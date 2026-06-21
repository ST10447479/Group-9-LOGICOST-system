package com.example.logicostapp3.ui.inventory

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.appcompat.app.AlertDialog
import androidx.fragment.app.Fragment
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.logicostapp3.api.RetrofitClient
import com.example.logicostapp3.api.SessionManager
import com.example.logicostapp3.databinding.FragmentInventoryBinding
import com.example.logicostapp3.databinding.DialogAddInventoryBinding
import com.example.logicostapp3.model.AddInventoryRequest
import com.example.logicostapp3.model.InventoryItem
import com.example.logicostapp3.model.UpdateQuantityRequest
import kotlinx.coroutines.launch

class InventoryFragment : Fragment() {

    private var _binding: FragmentInventoryBinding? = null
    private val binding get() = _binding!!
    private lateinit var session: SessionManager
    private lateinit var adapter: InventoryAdapter

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
        _binding = FragmentInventoryBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        session = SessionManager(requireContext())

        adapter = InventoryAdapter(
            onUpdate = { item, qty -> updateQuantity(item, qty) },
            onDelete = { item -> confirmDelete(item) }
        )
        binding.rvInventory.layoutManager = LinearLayoutManager(requireContext())
        binding.rvInventory.adapter = adapter

        binding.fabAdd.setOnClickListener { showAddDialog() }
        binding.swipeRefresh.setOnRefreshListener { loadInventory() }
        loadInventory()
    }

    private fun loadInventory() {
        binding.swipeRefresh.isRefreshing = true
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.getInventory(session.getToken())
                if (response.isSuccessful && response.body()?.success == true) {
                    val items = response.body()!!.data ?: emptyList()
                    adapter.submitList(items)
                    binding.tvEmpty.visibility = if (items.isEmpty()) View.VISIBLE else View.GONE
                } else {
                    toast("Failed to load inventory")
                }
            } catch (e: Exception) {
                toast("Network error: ${e.localizedMessage}")
            } finally {
                binding.swipeRefresh.isRefreshing = false
            }
        }
    }

    private fun showAddDialog() {
        val dialogBinding = DialogAddInventoryBinding.inflate(layoutInflater)
        AlertDialog.Builder(requireContext())
            .setTitle("Add New Product")
            .setView(dialogBinding.root)
            .setPositiveButton("Add") { _, _ ->
                val name     = dialogBinding.etProductName.text.toString().trim()
                val quantity = dialogBinding.etQuantity.text.toString().toIntOrNull() ?: 0
                val unit     = dialogBinding.etUnit.text.toString().ifEmpty { "units" }
                val reorder  = dialogBinding.etReorderLevel.text.toString().toIntOrNull() ?: 50
                if (name.isNotEmpty()) addItem(name, quantity, unit, reorder)
                else toast("Product name is required")
            }
            .setNegativeButton("Cancel", null)
            .show()
    }

    private fun addItem(name: String, quantity: Int, unit: String, reorder: Int) {
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.addInventoryItem(
                    session.getToken(),
                    AddInventoryRequest(name, quantity, unit, reorder)
                )
                if (response.isSuccessful && response.body()?.success == true) {
                    toast("Product added successfully")
                    loadInventory()
                } else {
                    toast(response.body()?.message ?: "Failed to add product")
                }
            } catch (e: Exception) {
                toast("Network error: ${e.localizedMessage}")
            }
        }
    }

    private fun updateQuantity(item: InventoryItem, qty: Int) {
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.updateQuantity(
                    session.getToken(),
                    UpdateQuantityRequest(item.id, qty)
                )
                if (response.isSuccessful && response.body()?.success == true) {
                    toast("Quantity updated")
                    loadInventory()
                } else {
                    toast("Failed to update quantity")
                }
            } catch (e: Exception) {
                toast("Network error: ${e.localizedMessage}")
            }
        }
    }

    private fun confirmDelete(item: InventoryItem) {
        AlertDialog.Builder(requireContext())
            .setTitle("Delete Product")
            .setMessage("Delete '${item.productName}'?")
            .setPositiveButton("Delete") { _, _ -> deleteItem(item) }
            .setNegativeButton("Cancel", null)
            .show()
    }

    private fun deleteItem(item: InventoryItem) {
        lifecycleScope.launch {
            try {
                val response = RetrofitClient.instance.deleteInventoryItem(
                    session.getToken(),
                    mapOf("id" to item.id)
                )
                if (response.isSuccessful && response.body()?.success == true) {
                    toast("Product deleted")
                    loadInventory()
                } else {
                    toast("Failed to delete product")
                }
            } catch (e: Exception) {
                toast("Network error: ${e.localizedMessage}")
            }
        }
    }

    private fun toast(msg: String) =
        Toast.makeText(requireContext(), msg, Toast.LENGTH_SHORT).show()

    override fun onDestroyView() {
        super.onDestroyView()
        _binding = null
    }
}
