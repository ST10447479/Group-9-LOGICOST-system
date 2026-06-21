package com.example.logicostapp3.ui.inventory

import android.graphics.Color
import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.ListAdapter
import androidx.recyclerview.widget.RecyclerView
import com.example.logicostapp3.databinding.ItemInventoryBinding
import com.example.logicostapp3.model.InventoryItem

class InventoryAdapter(
    private val onUpdate: (InventoryItem, Int) -> Unit,
    private val onDelete: (InventoryItem) -> Unit
) : ListAdapter<InventoryItem, InventoryAdapter.ViewHolder>(DIFF) {

    companion object {
        private val DIFF = object : DiffUtil.ItemCallback<InventoryItem>() {
            override fun areItemsTheSame(a: InventoryItem, b: InventoryItem) = a.id == b.id
            override fun areContentsTheSame(a: InventoryItem, b: InventoryItem) = a == b
        }
    }

    inner class ViewHolder(private val b: ItemInventoryBinding) :
        RecyclerView.ViewHolder(b.root) {

        fun bind(item: InventoryItem) {
            b.tvProductName.text = item.productName
            b.tvUnit.text        = item.unit
            b.etQuantity.setText(item.quantity.toString())

            if (item.isLowStock) {
                b.tvStatus.text      = "⚠️ Low Stock"
                b.tvStatus.setTextColor(Color.parseColor("#D32F2F"))
                b.cardRoot.strokeColor = Color.parseColor("#FFCDD2")
            } else {
                b.tvStatus.text      = "✅ In Stock"
                b.tvStatus.setTextColor(Color.parseColor("#388E3C"))
                b.cardRoot.strokeColor = Color.parseColor("#C8E6C9")
            }

            b.btnUpdate.setOnClickListener {
                val qty = b.etQuantity.text.toString().toIntOrNull() ?: item.quantity
                onUpdate(item, qty)
            }
            b.btnDelete.setOnClickListener { onDelete(item) }
        }
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val b = ItemInventoryBinding.inflate(LayoutInflater.from(parent.context), parent, false)
        return ViewHolder(b)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        holder.bind(getItem(position))
    }
}
