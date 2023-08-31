@section('javascript')
<script type="module">
  var last_orders = [@foreach($last_orders as $order) {{ $order->id }}, @endforeach];

  console.log(last_orders);

  function showToast() 
  {
    const orderToast = document.getElementById('order_'+ last_orders[0]);

    const orderToastInstance = Toast.getOrCreateInstance(orderToast);
    orderToastInstance.show();
  }

  setInterval(() => {
    if (last_orders.length > 0) { 
      showToast(); 
      last_orders.shift();
    }
  }, 15000);
</script>
@append

<div class="toast-container position-fixed bottom-0 start-0 m-3">
  @foreach($last_orders as $order)
  <div class="toast fade mt-2" role="alert" aria-live="assertive" aria-atomic="true" id="order_{{ $order->id }}">
    <div class="toast-header">
      <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="red"></rect></svg>
      <strong class="me-auto">{{ explode(" ", $order->firstname)[0] }} de {{ $order->city }} </strong>
      
      <small> 
        @if ($order->diff_minutes > 1440) 
        hace {{ ceil($order->diff_minutes / 1440) }} días 
        @elseif ($order->diff_minutes > 60) 
        hace {{ ceil($order->diff_minutes / 60) }} horas 
        @else 
        hace {{ ceil($order->diff_minutes) }} minutos 
        @endif
      </small>
      
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>

    <div class="toast-body">
      Realizó una compra de <span class="fw-bold"> {{ $order->product }} </span>
    </div>
  </div>
  @endforeach
</div>