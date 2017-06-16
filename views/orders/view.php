<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <br>
            <p><b>Payment method:</b> <?= $order->method ?></p>
            <p><b>Payment status:</b> <?= $order->status ?></p>
            <p><b>Payment method:</b> <?= $order->paidDatetime ?></p>
            <p><b>Payment method:</b> <?= $order->details_consumerName ?></p>
            <p><b>Payment method:</b> <?= $order->details_consumerAccount ?></p>
        </div>
    </div>
</div>