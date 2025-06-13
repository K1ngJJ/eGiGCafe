@component('mail::message')
# {{ $type === 'out_of_stock' ? '🚨 Out of Stock Alert' : '⚠️ Low Stock Alert' }}

### Dear {{ $role === 'admin' ? 'Admin' : 'Staff' }},

The supply of **{{ $inventoryName }}**  
@if ($type === 'out_of_stock')
is **completely out of stock** and requires **immediate attention**.
@else
is **running low on stock** and needs **prompt restocking**.
@endif

---

### 📊 **Stock Details**:
@if ($type === 'low_stock')
- **Current Stock**: {{ $quantity }} units  
- **Stock Level**: {{ round(($quantity / $initialStock) * 100) }}%  
@endif
- **Initial Stock**: {{ $initialStock }} units  

---

@component('mail::button', ['url' => 'https://egigcafe.com/inventory'])
🔄 Restock Now
@endcomponent

Please take action as soon as possible to avoid any service interruptions.  

Thank you for your attention.  

Best regards,  
**The GiGCafe Team**

@endcomponent
