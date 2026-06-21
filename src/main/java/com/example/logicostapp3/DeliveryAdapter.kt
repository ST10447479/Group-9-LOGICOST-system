package com.example.logicostapp3.ui.deliveries

import android.graphics.Color
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.ListAdapter
import androidx.recyclerview.widget.RecyclerView
import com.example.logicostapp3.databinding.ItemDeliveryBinding
import com.example.logicostapp3.model.Delivery

class DeliveryAdapter(
    private val onAssign: (Delivery) -> Unit,
    private val onComplete: (Delivery) -> Unit
) : ListAdapter<Delivery, DeliveryAdapter.ViewHolder>(DIFF) {

    companion object {
        private val DIFF = object : DiffUtil.ItemCallback<Delivery>() {
            override fun areItemsTheSame(a: Delivery, b: Delivery) = a.id == b.id
            override fun areContentsTheSame(a: Delivery, b: Delivery) = a == b
        }
    }

    inner class ViewHolder(private val b: ItemDeliveryBinding) :
        RecyclerView.ViewHolder(b.root) {

        fun bind(d: Delivery) {
            b.tvOrderNumber.text  = d.orderNumber
            b.tvDestination.text  = d.destination
            b.tvDriver.text       = d.driverName ?: "Unassigned"
            b.tvStatus.text       = "${d.statusEmoji} ${d.statusLabel}"

            val (bg, stroke) = when (d.status) {
                "pending"    -> Color.parseColor("#FFF8E1") to Color.parseColor("#FFD54F")
                "in_transit" -> Color.parseColor("#E3F2FD") to Color.parseColor("#64B5F6")
                "delivered"  -> Color.parseColor("#E8F5E9") to Color.parseColor("#81C784")
                else         -> Color.parseColor("#FFEBEE") to Color.parseColor("#EF9A9A")
            }
            b.cardRoot.setCardBackgroundColor(bg)
            b.cardRoot.strokeColor = stroke

            b.btnAssign.visibility   = if (d.status == "pending") View.VISIBLE else View.GONE
            b.btnComplete.visibility = if (d.status == "in_transit") View.VISIBLE else View.GONE

            b.btnAssign.setOnClickListener   { onAssign(d) }
            b.btnComplete.setOnClickListener { onComplete(d) }
        }
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val b = ItemDeliveryBinding.inflate(LayoutInflater.from(parent.context), parent, false)
        return ViewHolder(b)
    }

    override fun onBindViewHolder(h: ViewHolder, pos: Int) = h.bind(getItem(pos))
}
