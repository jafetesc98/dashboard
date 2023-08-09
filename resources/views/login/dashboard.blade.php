@extends('../layout/' . $layout)

@section('head')
    <title>Dashboard</title>
    <script src="dist/js/graficando.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-core.min.js"></script>
<script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-circular-gauge.min.js"></script>
@endsection

@section('content')
<div class="col-span-12 ">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5" style="color: white;"> Reporte General Expo 2023</h2>
                        
                    </div>
                    <div class="grid grid-cols-12 gap-6 ">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-3">
                                    <div class="flex ">
                                        <i data-lucide="file-text" class="report-box__icon text-pending" style="height: 50px !important; width: 50px !important;"></i>
                                        <div class="ml-auto">
                                            <div id="aupedidos" class="report-box__indicator bg-success tooltip cursor-pointer" title="% de Pedidos en aumento ">
                                            <?php echo number_format( $array['porPedidos'],2) ?>% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ped" style="font-size: 50px !important;" class="p-5 text-3xl font-medium leading-8 mt-3">
                                        <?php echo  $array['totalPedidos'] ?>
                                    </div>
                                    <div class="text-base text-slate-500 mt-10">Pedidos</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-3">
                                    <div class="flex">
                                        <i data-lucide="box" class="report-box__icon text-pending" style="height: 50px !important; width: 50px !important;"></i>
                                        <div class="ml-auto">
                                            <div id="aucajas" class="report-box__indicator bg-success tooltip cursor-pointer" title="% de cajas en aumento ">
                                            <?php echo number_format( $array['porCajas'],2) ?>% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="caj" style="font-size: 50px !important;" class="text-3xl font-medium leading-8 mt-3 py-5">
                                        <?php echo number_format( $array['vtaCajas'],2) ?>
                                    </div>
                                    <div class="text-base text-slate-500 mt-10">Cajas vendidas</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-3">
                                    <div class="flex">
                                        <i data-lucide="banknote" class="report-box__icon text-warning" style="height: 50px !important; width: 50px !important;"></i>
                                        <div class="ml-auto">
                                            <div id="audinero" class="report-box__indicator bg-success tooltip cursor-pointer" title="% de ingresos en aumento">
                                            <?php echo number_format( $array['porVenta'],2) ?>% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="vta" style="font-size: 37px !important;" class="text-3xl font-medium leading-8 mt-3 py-5">
                                        $<?php echo number_format( $array['vtaTotal'],2) ?> 
                                    </div>
                                    
                                    <div class="text-base text-slate-500 mt-10">Total de ventas</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-2">
                                    <div class="flex font-medium">
                                    <i data-lucide="trending-up" class="report-box__icon text-success" ></i>
                                    
                                        <div class="ml-auto">
                                            
                                            <div id="auclientes" class="report-box__indicator bg-success tooltip cursor-pointer" title="% de cubrimiento de clientes">
                                            <?php echo number_format( $array1['porcentaje'],2) ?>%
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-none ml-auto relative">
                                        <div class="">
                                        <div id="veloci"></div>
                                         <!-- <canvas id="oilChart">  --> 
                                        </div>
                                    </div>
                                    <div class="text-base text-slate-500 mt-1">Cubrimiento</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- BEGIN: General Statistic -->
                <div class="intro-y box col-span-12 my-6">
                    <div class="flex items-center px-5   border-b ">
                        <h2 class="font-medium text-base mr-auto">Ventas por sublineas</h2>
                    </div>
                    <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 ">
                       
                        <div class="2xl:col-span-5 w-full">
                            <div class="">
                                <div class="">
                                    <canvas id="densityChart" width="3500" height="1250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Statistic -->
                <style>
                    #oilChart{
                        max-width: 500px;
                        margin: auto !important;
                        height: 47px ! important;
                        width: 240px ! important;
                    }

                    #veloci {
                    width: 100%;
                    height: 100% ! important;
                    margin: 0;
                    padding: 0;
                    }
                    .anychart-credits{
                        display:none !important;
                    }
                    
                </style>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
     var array = {{Js::from($array)}};
     var array1 = {{Js::from($array1)}};
     var array2 = {{Js::from($array2)}};
     const sublineas = Object.keys(array2);

     

  //Cuando la página esté cargada completamente
  window.addEventListener("load", function(){
    //console.log(array1);
    repetirventa();
    repetirclientes();
    repetirgrafica();
    
        });
        

let identificadorIntervaloDeTiempo;

function repetirventa() {
  identificadorIntervaloDeTiempo = setInterval(actualizaVentas, 30000);
}
function actualizaVentas() {
  //console.log("Ha pasado 1 segundo.");
  $.ajax(
       {
           url: 'dashboard1',               
           data: "",
           contentType: 'json; charset=utf-8',
           type: 'GET',
           success: function (data) {
               //console.log("se ejecuta cada minuto");
               $(data).each(function (i, row) {                  
                       //console.log(row['totalPedidos']);

                        var valPedidos = document.getElementById("ped").innerHTML;
                        var sumaPed=0;
                        if(Number(valPedidos)===Number(row['totalPedidos'])){
                            sumaPed=valPedidos;
                            //document.getElementById("aupedidos").innerHTML = "0%";
                        }else{
                            var resta=Number(row['totalPedidos'])-valPedidos;
                            var porped = (resta*100)/valPedidos;

                            document.getElementById("aupedidos").innerHTML = (Number(row['porPedidos'].toFixed(2)))+"%";
                            //console.log("valor en aumento: "+ (Number(porped.toFixed(2))));
                            //console.log("valor de la resta: "+resta);
                        //console.log("suma total: "+sumaTotal);  
                            sumaPed= sumaPed +  Number(row['totalPedidos']);
                        }
                        
                        ///este es para pedidos
                        function uno() {
                            function one() {
                                 
                                if (valPedidos >= sumaPed  ) {
                                document.getElementById("ped").innerHTML =sumaPed;
                                clearInterval(cambiopedidos) //detiene el incremento cuando llega a 300
                                } else {
                                //console.log(va++)
                                    document.getElementById("ped").innerHTML =  valPedidos++;
                                }
                            }
                            let cambiopedidos = setInterval(one, 50); //velocidad de animacion
                            }
                            setTimeout(uno, 100) //primer delay


                    //aqui empieza la suma del total de cajas vendidas
                    var totcaja = document.getElementById("caj").innerHTML;
                        var totalcajas= Number(totcaja.replace(/[^0-9\.]+/g,""));

                        var sumaCajas=0;
                        if(totalcajas===row['vtaCajas']){
                            sumaCajas=totalcajas;
                            //document.getElementById("aucajas").innerHTML = "0%";
                        }else{
                            var resta=Number(row['vtaCajas'])-totalcajas;
                            var porcaj = (resta*100)/totalcajas;

                            document.getElementById("aucajas").innerHTML = (Number(row['porCajas'].toFixed(2)))+"%";
                            //console.log("valor en aumento cajas: "+ (Number(porcaj.toFixed(2))));
                            //console.log("valor de la resta cajas: "+resta);


                            sumaCajas=  sumaCajas + parseFloat(row['vtaCajas']);
                            function uno2() {
                            function one2() {
                                tot=0;
                                if(sumaCajas==0){
                                    document.getElementById("caj").innerHTML =separator(Number(row['vtaCajas'].toFixed(2)));
                                }else{
                                if ( totalcajas >= sumaCajas) {
                                    document.getElementById("caj").innerHTML =separator(Number(sumaCajas.toFixed(2)));
                                clearInterval(cambiocajas) //detiene el incremento cuando llega a 300
                                } else {
                                    document.getElementById("caj").innerHTML =totalcajas=(Number(totalcajas)+ Number(1.01)).toFixed(2);
                                }
                            }
                                
                            }
                            let cambiocajas = setInterval(one2, 10); //velocidad de animacion
                            }
                            setTimeout(uno2, 100)
                        }
                        
                        ///este es para total de cajas
                    


                            //aqui empieza ela suma del total de venta en dinero
                        var totVta = document.getElementById("vta").innerHTML;
                        var totalVenta= Number(totVta.replace(/[^0-9\.]+/g,""));

                        var sumaTotal=0;
                        if(parseFloat(totalVenta)===parseFloat(row['vtaTotal'])){
                            sumaTotal=totalVenta;
                            //document.getElementById("audinero").innerHTML = "0%";
                            //document.getElementById("vta").innerHTML ="$"+ separator(Number(totalVenta.toFixed(2)));
                        }else{
                            var resta=Number(row['vtaTotal'])-totalVenta;
                            var pordinero = (resta*100)/totalVenta;

                            document.getElementById("audinero").innerHTML = (Number(row['porVenta'].toFixed(2)))+"%";
                            
                            sumaTotal=  Number((sumaTotal)+ parseFloat(row['vtaTotal']));
                            ///este es para total de vent
                        function uno1() {
                            function one1() {
                                 if ( totalVenta>=sumaTotal) {
                                    document.getElementById("vta").innerHTML ="$"+ separator(Number(sumaTotal.toFixed(2)));
                                    clearInterval(cambioprecio);
                                } else {
                                    document.getElementById("vta").innerHTML = totalVenta =(Number(totalVenta)+ Number(51.01)).toFixed(2);
                                }
                            
                            }  
                            let cambioprecio = setInterval(one1, 0.000000000000000001); //velocidad de animacion
                            
                            }
                            setTimeout(uno1,100);
                        } 
                        

                    
                    });
               
           },
       });
}

/* var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var oilData = {
    labels: ["Clientes cubiertos", "Clientes faltantes"],
    datasets: [
        {
            data: [array1['porcentaje'], array1['clixcomprar']],
            backgroundColor: [
        'rgba(21,101,192,1)',//color azul
        'rgba(255,0,1,1)', //color rojo
        //'rgba(231,231,231,1)', //color rojo
            ],
            borderColor: "black",
            borderWidth: 2
        }]
};

var chartOptions = {
  rotation: -Math.PI,
  cutoutPercentage: 30,
  circumference: Math.PI,
  legend: {
    position: 'null'
  },
  animation: {
    animateRotate: false,
    animateScale: true
  }
};

var pieChart = new Chart(oilCanvas, {
  type: 'doughnut',
  
  data: oilData,
  options: chartOptions
}); */

let identificadorIntervaloDeTiempo1;

function repetirclientes() {
  identificadorIntervaloDeTiempo1 = setInterval(actualizaClientes, 30000);
}


var grafi = anychart.onDocumentReady(function () {
    
    // create data set on our data
    var dataSet = anychart.data.set([array1['porcentaje']]); //valores para la grafica
    console.log("vALOR DEL DATO INICIAL DE LA GRAFICA: "+array1['porcentaje']);
    // set the gauge type
var gauge = anychart.gauges.circular();

    // gauge settings
 gauge.data(dataSet);
gauge.padding("10%");
gauge.startAngle(270);
gauge.sweepAngle(180);
/*gauge.fill(["blue", "grey"], .5, .5, null, 1, 0.5, 0.9);
 */
    // axis settings
var axis = gauge.axis()
.radius(95)
.width(0);

    // scale settings
axis.scale()
.minimum(0)
.maximum(100)
.ticks({interval: 10})
.minorTicks({interval: 1});

    // ticks settings
axis.ticks()
.type("trapezium")
.fill("white")
.length(9);

    // minor ticks settings
axis.minorTicks()
.enabled(true)
.fill("red")
.length(1.5);

// labels settings
/* axis.labels()
.fontSize("24px")
.fontColor("black"); */

// second axis settings
var axis_1 = gauge.axis(1)
.radius(55)
.width(0);

    // second scale settings
/* axis_1.scale()
.minimum(0)
.maximum(150000)
.ticks({interval: 100})
.minorTicks({interval: 20}); */

    // second ticks settings
axis_1.ticks()
.type("trapezium")
.length(15);

    // second minor ticks settings
/* axis_1.minorTicks()
.enabled(true)
.length(5); */

// labels 2 settings
axis_1.labels()
.fontSize("0px")
.fontColor("white"); 

// needle
gauge.needle(0)
.enabled(true)
.startRadius("0%")
.endRadius("80%")
.middleRadius(0)
.startWidth("1%")
.endWidth("1%")
.fill("black")
.stroke("none")
.middleWidth("1%");

// marker
gauge.marker(0)
.axisIndex(1)
.dataIndex(1)
.size(7)
.type("triangle-down")
.position("outside")
.radius(55);

// bar
gauge.bar(0)
.axisIndex(1)
.position("inside")
.dataIndex(1)
.width(3)
.radius(60)
.zIndex(10);

// gap
gauge.cap()
.radius("3%");

// gauge label
gauge.label()
.text("Cientes")
.anchor("center") // set the position of the label
.adjustFontSize(true)
.hAlign("center")
.offsetY("15%")
.offsetX("50%")
.width("50%")
.height("10%")
.zIndex(10);


// range
gauge.range({
  from: 0,
  to: 120,
  fill: {keys: ["green", "yellow", "orange" , "red"]},
  position: "inside",
  radius: 100,
  endSize: "3%",
  startSize:"3%",
  zIndex: 10
});

    // draw the chart
gauge.container("veloci").draw();
});
function actualizaClientes() {
  //console.log("Ha pasado 1 segundo.");

  $.ajax(
       {
           url: 'clientes',               
           data: "",
           contentType: 'json; charset=utf-8',
           type: 'GET',
           success: function (data) {
               console.log("se ejecuta cada minuto");
               $(data).each(function (i, row) {   
                console.log("vALOR DEL DATO ACTUALIZADO DE LA GRAFICA: "+Number(row['porcentaje'].toFixed(2)));
                document.getElementById("veloci").innerHTML = "";
                document.getElementById("auclientes").innerHTML = Number(row['porcentaje'].toFixed(2))+"%";
  
anychart.onDocumentReady(function () {
    
    // create data set on our data
    var dataSet = anychart.data.set([Number(row['porcentaje'].toFixed(2))]); //valores para la grafica
    // set the gauge type
var gauge1 = anychart.gauges.circular();

    // gauge settings
 gauge1.data(dataSet);
gauge1.padding("10%");
gauge1.startAngle(270);
gauge1.sweepAngle(180);
/*gauge.fill(["blue", "grey"], .5, .5, null, 1, 0.5, 0.9);
 */
    // axis settings
var axis = gauge1.axis()
.radius(95)
.width(0);

    // scale settings
axis.scale()
.minimum(0)
.maximum(100)
.ticks({interval: 10})
.minorTicks({interval: 1});

    // ticks settings
axis.ticks()
.type("trapezium")
.fill("white")
.length(9);

    // minor ticks settings
axis.minorTicks()
.enabled(true)
.fill("red")
.length(1.5);

// labels settings
/* axis.labels()
.fontSize("24px")
.fontColor("black"); */

// second axis settings
var axis_1 = gauge1.axis(1)
.radius(55)
.width(0);

    // second scale settings
/* axis_1.scale()
.minimum(0)
.maximum(150000)
.ticks({interval: 100})
.minorTicks({interval: 20}); */

    // second ticks settings
axis_1.ticks()
.type("trapezium")
.length(15);

    // second minor ticks settings
/* axis_1.minorTicks()
.enabled(true)
.length(5); */

// labels 2 settings
axis_1.labels()
.fontSize("0px")
.fontColor("white"); 

// needle
gauge1.needle(0)
.enabled(true)
.startRadius("0%")
.endRadius("80%")
.middleRadius(0)
.startWidth("1%")
.endWidth("1%")
.fill("black")
.stroke("none")
.middleWidth("1%");

// marker
gauge1.marker(0)
.axisIndex(1)
.dataIndex(1)
.size(7)
.type("triangle-down")
.position("outside")
.radius(55);

// bar
gauge1.bar(0)
.axisIndex(1)
.position("inside")
.dataIndex(1)
.width(3)
.radius(60)
.zIndex(10);

// gap
gauge1.cap()
.radius("3%");

// gauge label
gauge1.label()
.text("Cientes")
.anchor("center") // set the position of the label
.adjustFontSize(true)
.hAlign("center")
.offsetY("15%")
.offsetX("50%")
.width("50%")
.height("10%")
.zIndex(10);


// range
gauge1.range({
  from: 0,
  to: 120,
  fill: {keys: ["green", "yellow", "orange" , "red"]},
  position: "inside",
  radius: 100,
  endSize: "3%",
  startSize:"3%",
  zIndex: 10
});

    // draw the chart
gauge1.container("veloci").draw();
});

            });
           },
       });
}


let identificadorIntervaloDeTiempo2;

function repetirgrafica() {
  identificadorIntervaloDeTiempo2 = setInterval(actualizaGrafica, 300000);
}
function actualizaGrafica() {
  //console.log("Ha pasado 1 segundo.");
  $.ajax(
       {
           url: 'grafica',               
           data: "",
           contentType: 'json; charset=utf-8',
           type: 'GET',
           success: function (data) {
               console.log("se ejecuta cada 5 minutos");
               $(data).each(function (i, row) {      
                const sublineas = Object.keys(data); 
                var densityCanvas = document.getElementById("densityChart");

Chart.defaults.global.defaultFontFamily='Roboto'
Chart.defaults.global.defaultFontColor = 'black';
var densityData = {

  label: 'Venta de cajas por sublinea',

  data: [array2[sublineas[0]]['subtotal'],array2[sublineas[1]]['subtotal'],array2[sublineas[2]]['subtotal'],array2[sublineas[3]]['subtotal'],array2[sublineas[4]]['subtotal'],
  array2[sublineas[5]]['subtotal'],array2[sublineas[6]]['subtotal'],array2[sublineas[7]]['subtotal'],array2[sublineas[8]]['subtotal'],array2[sublineas[9]]['subtotal'],
  array2[sublineas[10]]['subtotal'],array2[sublineas[11]]['subtotal'],array2[sublineas[12]]['subtotal'],array2[sublineas[13]]['subtotal'],array2[sublineas[14]]['subtotal'],
  array2[sublineas[15]]['subtotal'],array2[sublineas[16]]['subtotal'],array2[sublineas[17]]['subtotal'],array2[sublineas[18]]['subtotal'],array2[sublineas[19]]['subtotal']],
  backgroundColor:'rgba(21,101,192,1)',
  
    
};

var barChart = new Chart(densityCanvas, {
  type: 'bar',
  data: {
    
     labels: [sublineas[0],sublineas[1],sublineas[2],sublineas[3],sublineas[4],
     sublineas[5],sublineas[6],sublineas[7],sublineas[8],sublineas[9],
    sublineas[10],sublineas[11],sublineas[12],sublineas[13],sublineas[14],
    sublineas[15],sublineas[16],sublineas[17],sublineas[18],sublineas[19]],
    
    datasets: [densityData],
   
  },
  options: {
        scales: {
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    maxRotation: 60,
                    minRotation: 60,
                    
                }
            }]
        },
        
    },
    
});

barChart.options.scales.xAxes[0].ticks.fontSize = 12 ;
barChart.options.scales.xAxes[0].ticks.font='Roboto';
barChart.update();

            });
               
           },
       });
}
var densityCanvas = document.getElementById("densityChart");

Chart.defaults.global.defaultFontFamily='Roboto'
Chart.defaults.global.defaultFontColor = 'black';
var densityData = {

  label: 'Venta de cajas por sublinea',

  data: [array2[sublineas[0]]['subtotal'],array2[sublineas[1]]['subtotal'],array2[sublineas[2]]['subtotal'],array2[sublineas[3]]['subtotal'],array2[sublineas[4]]['subtotal'],
  array2[sublineas[5]]['subtotal'],array2[sublineas[6]]['subtotal'],array2[sublineas[7]]['subtotal'],array2[sublineas[8]]['subtotal'],array2[sublineas[9]]['subtotal'],
  array2[sublineas[10]]['subtotal'],array2[sublineas[11]]['subtotal'],array2[sublineas[12]]['subtotal'],array2[sublineas[13]]['subtotal'],array2[sublineas[14]]['subtotal'],
  array2[sublineas[15]]['subtotal'],array2[sublineas[16]]['subtotal'],array2[sublineas[17]]['subtotal'],array2[sublineas[18]]['subtotal'],array2[sublineas[19]]['subtotal']],
  backgroundColor:'rgba(21,101,192,1)',
  
    
};

var barChart = new Chart(densityCanvas, {
  type: 'bar',
  data: {
    
     labels: [sublineas[0],sublineas[1],sublineas[2],sublineas[3],sublineas[4],
     sublineas[5],sublineas[6],sublineas[7],sublineas[8],sublineas[9],
    sublineas[10],sublineas[11],sublineas[12],sublineas[13],sublineas[14],
    sublineas[15],sublineas[16],sublineas[17],sublineas[18],sublineas[19]],
    
    datasets: [densityData],
   
  },
  options: {
        scales: {
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    maxRotation: 60,
                    minRotation: 60,
                    
                }
            }]
        },
        
    },
    
});

barChart.options.scales.xAxes[0].ticks.fontSize = 12 ;
barChart.options.scales.xAxes[0].ticks.font='Roboto';
barChart.update();


function separator(numb) {
    var str = numb.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return str.join(".");
}



</script>
@endsection
