<?php
error_reporting(E_ERROR);
include_once('views/head.php');
include_once('views/navbar.php');
?>
<section id="caja">
  <div class="col-xs-0 col-sm-0 col-md-0 col-lg-0 well">
    <table style="width:100%">
      <form id="formulario">
        <tr>
          <td style="width:50%" valign="top">
            <fieldset>
              <legend>Ingreso / Egreso</legend>
              Cantidad $
              <input type="number" id="dinero" name="dinero" >
              <br>
              <br>
              Observación:
              <input type="text" id="observacion" name="observacion" size="50">

              <div id="navegador"></div>
            </fieldset>
          </td>
          <td style="width:50%" valign="top">
            <fieldset>
              <legend>Formulario Venta</legend>
              <table>
                <tr>
                  <td><b>fecha:</b></td>
                  <td><input type="date" name="anti" placeholder="dd/mm/aaaa" id="fecha" value="<?php echo date("Y-m-d");?>" readonly="readonly"></td>
                </tr>
                <tr>
                  <td><b>Direccion de extracción/ingreso: </b></td>
                  <td><input type="text" name="dir" id="dir" value="Local Conercial" ></td>					<!--lugar de emision -->
                </tr>
                <tr>
                  <td><b>Tipo de extracción (cheque/banco/efectivo)</b></td>
                  <td><input type="text" name="formapago" value="efectivo" id="formapago" ></td>
                </tr>
              </table>
              <input type="button" value="Limpiar"  onclick="limpiar();" />
              <input type="button" value="Extraer dinero" onclick="extraer_dinero();" />
              <input type="button" value="Ingresar dinero" onclick="ingreso_dinero();" />
            </form>
          </fieldset>
        </td>
      </tr>
    </table>
    <script type="text/javascript">
    </script>
    <div class="col-xs-100 col-sm-12 col-md-12 col-lg-100" id="mensaje" align="center"></div>
  </div>
</section>
<script type="text/javascript">
// funcion que se inicia luego de cargar la pagina
$(function () {
  location.href="#caja";
})
</script>


<?php
include_once('views/footer.php');
?>
