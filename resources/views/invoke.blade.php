<h1>Invoice</h1>
<p>Table Number: {{ $order_data->table_id }}</p>
<p>Customer Name: {{ $order_data->customer->name}}</p>
<h2>Items Ordered:</h2>

@foreach($order_data->orderDetails->pluck('meal') as $meal)
<li>meal_description: {{ $meal->description }}: <h4> price</h4>: {{ $meal->price }}</li>
  
@endforeach

<p>Total Cost: {{ $order_data->total }}</p>
<button onclick="window.print()">Print Invoice</button>
