<div class="container-fluid order-view">
	<div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <br>
            <p><b>Payment method:</b> <?= $order->method ?></p>
            <p><b>Payment status:</b> <?= $order->status ?></p>
            <p><b>Payment method:</b> <?= $order->paidDatetime ?></p>
            <p><b>Payment method:</b> <?= $order->details_consumerName ?></p>
            <p><b>Payment method:</b> <?= $order->details_consumerAccount ?></p>
            <br>
        </div>
    </div>
</div>