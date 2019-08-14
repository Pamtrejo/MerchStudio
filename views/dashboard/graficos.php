<?php
require_once('../../core/helpers/dashboard/commerce.php');
Commerce::headerTemplate('MerchStudio');
?>

<form id="form-producto" method="post">
        <div class="row">
          <div class="col s12 m12">
            <canvas id="myChart"></canvas>
              <select class="select" id="sucursal" value="">
                  </select>
            <button type="submit" class="btn green accent-4">Generar</button>
          </div>
        </div>
      </form>

      <br><br><br><br><br><br><br><br><br>
<?php
Commerce::footerTemplate('inicio.js');
?>