<?php
require_once('../../core/helpers/dashboard/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>
<br><br><br><br>

<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <canvas id="chart"></canvas>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <canvas id="chart2"></canvas>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <canvas id="chart3"></canvas>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <canvas id="chart4"></canvas>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <canvas id="chart5"></canvas>
    </div>
</div>


<?php
Commerce::footerTemplate('inicio.js');
?>