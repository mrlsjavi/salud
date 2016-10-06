<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<STYLE TYPE="text/css">
	
	.boton {color:blue;}

	.centrar
	{
		position: absolute;
		/*nos posicionamos en el centro del navegador*/
		top:50%;
		left:50%;
		/*determinamos una anchura*/
		width:150px;
		/*indicamos que el margen izquierdo, es la mitad de la anchura*/
		margin-left:-75px;
		/*determinamos una altura*/
		height:50px;
		/*indicamos que el margen superior, es la mitad de la altura*/
		margin-top:-25px;
		
		padding:5px;
	}

	.box{
	    background: rgba(0,94,165,0.1);
	    border: 2px solid rgba(0,94,165,0.6);
	    margin: 5px;
	    min-height: 50px;
	    padding: 5px;
	    min-width: 250px;
	    display: table; 
     	vertical-align: middle;
	}

	.inputStyle{
		width:30px;
		text-align: center;
		display: table-cell;
	  	vertical-align: middle;
	}

	.labelStyle{
	 display: table-cell;
	  vertical-align: middle;
	}

	.city {display:none;}

	.circles {
	  margin-bottom: -10px;
	}

	.circle {
	  width: 100px;
	  margin: 6px 6px 20px;
	  display: inline-block;
	  position: relative;
	  text-align: center;
	  line-height: 1.2;
	}

	.circle canvas {
	  vertical-align: top;
	}

	.circle strong {
	  position: absolute;
	  top: 30px;
	  left: 0;
	  width: 100%;
	  text-align: center;
	  line-height: 40px;
	  font-size: 30px;
	}

	.circle strong i {
	  font-style: normal;
	  font-size: 0.6em;
	  font-weight: normal;
	}

	.circle span {
	  display: block;
	  color: #aaa;
	  margin-top: 12px;
	}

	.titulos {
		display: block;
	  	color: #aaa;
	  	margin-top: 12px;
	}

	
</STYLE>

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-border-blue", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-blue";
}
</script>





<div class="w3-row">
  <a href="#" onclick="openCity(event, 'Vivo');" >
    <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding">Vivo</div>
  </a>
  <a href="#" onclick="openCity(event, 'Historial');">
    <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding">Historial</div>
  </a>
 
</div>

<div id="Vivo" class="w3-container city">

</div>

<div id="Historial" class="w3-container city">
    <h2>Historial</h2>
    <div id="dv_select">
    	<label>Sensor:</label>
    	<select id="slt_sensor">
  
    	</select>
    	<label>Mes</label>
    	<select id="slt_mes">
    		<option>Enero</option>
    		<option>Febrero</option>
    		<option>Marzo</option>
    		<option>Abril</option>
    		<option>Mayo</option>
    		<option>Junio</option>
    		<option>Julio</option>
    		<option>Agosto</option>
    		<option>Septiembre</option>
    		<option>Octubre</option>
    		<option>Noviembre</option>
    		<option>Diciembre</option>
    	</select>
    	<label>year</label>
    	<select>
    		<option>2016</option>
    	</select>
    </div>
  	<br/>
  	<br/>

  	<div id="dv_tabla">


	</div>
	<br/>
	<br/>
	<div id="dv_graficas">
		


	</div>



 	

</div>





<div class="centrar" style="display:none" id="dv_cargando">
	<progress></progress>
</div>


