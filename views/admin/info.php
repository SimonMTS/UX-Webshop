<div class="container">
	<div class="row">
        <div class="col-lg-4">
            <h3><?=$game->name ?></h3>
        </div>
        <div class="col-lg-8 hidden-sm hidden-xs">
            <div class="graf">
                <span><h1>Views </h1></span>
                <svg class="graph">
                    <g class="grid x-grid" id="xGrid">
                        <line x1="40" x2="40" y1="10" y2="380"></line>
                        <line x1="140" x2="140" y1="10" y2="380"></line>
                        <line x1="240" x2="240" y1="10" y2="380"></line>
                        <line x1="340" x2="340" y1="10" y2="380"></line>
                        <line x1="440" x2="440" y1="10" y2="380"></line>
                        <line x1="540" x2="540" y1="10" y2="380"></line>
                        <line x1="640" x2="640" y1="10" y2="380"></line>
                    </g>
                    <g class="grid y-grid" id="yGrid">
                        <line x1="40" x2="637" y1="10" y2="10"></line>
                        <line x1="40" x2="637" y1="68" y2="68"></line>
                        <line x1="40" x2="637" y1="126" y2="126"></line>
                        <line x1="40" x2="637" y1="185" y2="185"></line>
                        <line x1="40" x2="637" y1="243" y2="243"></line>
                        <line x1="40" x2="637" y1="301" y2="301"></line>
                        <line x1="40" x2="637" y1="360" y2="360"></line>
                    </g>
                    <g class="first_set points" data-setname="Our first data set">
                        <circle cx="40" cy="<?=$views[date("Y-m-d", strtotime("-6 days"))]+10 ?>" data-value="8.1" r="5"></circle>
                        <circle cx="140" cy="<?=$views[date("Y-m-d", strtotime("-5 days"))]+10 ?>" data-value="8.1" r="5"></circle>
                        <circle cx="240" cy="<?=$views[date("Y-m-d", strtotime("-4 days"))]+10 ?>" data-value="8.1" r="5"></circle>
                        <circle cx="340" cy="<?=$views[date("Y-m-d", strtotime("-3 days"))]+10 ?>" data-value="8.1" r="5"></circle>
                        <circle cx="440" cy="<?=$views[date("Y-m-d", strtotime("-2 days"))]+10 ?>" data-value="8.1" r="5"></circle>
                        <circle cx="540" cy="<?=$views[date("Y-m-d", strtotime("-1 days"))]+10 ?>" data-value="8.1" r="5"></circle>
                        <circle cx="640" cy="<?=$views[date("Y-m-d")]+10 ?>" data-value="8.1" r="5"></circle>
                    </g>
                    <g class="surfaces">
                        <path class="first_set" d="M40,360 
                            L40,<?=$views[date("Y-m-d", strtotime("-6 days"))]+10 ?> 
                            L140,<?=$views[date("Y-m-d", strtotime("-5 days"))]+10 ?> 
                            L240,<?=$views[date("Y-m-d", strtotime("-4 days"))]+10 ?> 
                            L340,<?=$views[date("Y-m-d", strtotime("-3 days"))]+10 ?> 
                            L440,<?=$views[date("Y-m-d", strtotime("-2 days"))]+10 ?> 
                            L540,<?=$views[date("Y-m-d", strtotime("-1 days"))]+10 ?> 
                            L640,<?=$views[date("Y-m-d")]+10 ?> 
                            L640,360 
                            Z"></path>
                    </g>
                    <use class="grid double" xlink:href="#xGrid" style=""></use>
                    <use class="grid double" xlink:href="#yGrid" style=""></use>
                    <g class="labels x-labels">
                        <text x="40" y="400"><?=date("l", strtotime("-6 days")) ?></text>
                        <text x="240" y="400"><?=date("l", strtotime("-4 days")) ?></text>
                        <text x="440" y="400"><?=date("l", strtotime("-2 days")) ?></text>
                        <text x="640" y="400"><?=date("l") ?></text>
                    </g>
                    <g class="labels y-labels">
                        <text x="30" y="15"><?=$max ?></text>
                        <text x="30" y="131"><?=round($max*0.666) ?></text>
                        <text x="30" y="248"><?=round($max*0.333) ?></text>
                        <text x="30" y="365">0</text>
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>