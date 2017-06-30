<div class="container">
	<div class="row">
        <div class="col-md-4">
            
        </div>
        <div class="col-md-8">
            <!--<pre><?php var_dump($views); ?></pre>-->
            <svg viewBox="0 0 500 100" class="chart">
            <polyline
                fill="none"
                stroke="#0074d9"
                stroke-width="2"
                points="
                <?php for ($i=0;$i<14;$i++) : ?>
                    <?=$i*20 ?>,<?=$views[$i] ?>
                <?php endfor; ?>
                "
            />
            </svg>
        </div>
    </div>
</div>