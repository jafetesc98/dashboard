@extends('../layout/' . $layout)

@section('head')
    <title>Dashboard</title>
    <script src="dist/js/graficando.js"></script>
@endsection

@section('content')
<div class="col-span-12 ">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5" style="color: white;"> Reporte General Expo 2023</h2>
                        
                    </div>
                    <div class="grid grid-cols-12 gap-6 ">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-2">
                                    <div class="flex">
                                        <i data-lucide="file-text" class="report-box__icon text-pending"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="% de Pedidos en aumento ">
                                                12% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ped" style="font-size: 50px !important;" class="text-3xl font-medium leading-8 mt-3">
                                        <?php echo  $array['totalPedidos'] ?>
                                    </div>
                                    <div class="text-base text-slate-500 mt-2 ">Pedidos</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-2">
                                    <div class="flex">
                                        <i data-lucide="box" class="report-box__icon text-pending"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="% de cajas en aumento ">
                                                25% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="caj" style="font-size: 50px !important;" class="text-3xl font-medium leading-8 mt-3">
                                        <?php echo number_format( $array['vtaCajas'],2) ?>
                                    </div>
                                    <div class="text-base text-slate-500 mt-2 ">Cajas vendidas</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-2">
                                    <div class="flex">
                                        <i data-lucide="banknote" class="report-box__icon text-warning"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="% de ingresos en aumento">
                                                35% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="vta" style="font-size: 37px !important;" class="text-3xl font-medium leading-8 mt-3">
                                        $<?php echo number_format( $array['vtaTotal'],2) ?> 
                                    </div>
                                    
                                    <div class="text-base text-slate-500 mt-2 ">Total de ventas</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-2">
                                    <div class="flex font-medium">
                                    <i data-lucide="trending-up" class="report-box__icon text-success" ></i>
                                    <div class="ml-auto"><?php echo number_format( $array1['porcentaje'],2) ?>%</div>
                                    
                                        <div class="ml-auto">
                                            
                                            <div  class="report-box__indicator bg-success tooltip cursor-pointer" title="% de cubrimiento de clientes">
                                                22% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-none ml-auto relative">
                                        <div class="">
                                        <canvas id="oilChart">
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
                        height: 47px ! important;
                        width: 240px ! important;
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
  identificadorIntervaloDeTiempo = setInterval(actualizaVentas, 300000);
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
                        }else{
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
                        }else{
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
                            //document.getElementById("vta").innerHTML ="$"+ separator(Number(totalVenta.toFixed(2)));
                        }else{
                            sumaTotal=  Number((sumaTotal)+ parseFloat(row['vtaTotal']));
                            ///este es para total de venta
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
                        console.log("valor anterior venta: "+ totalVenta);
                        console.log("valor nuevo venta: "+row['vtaTotal']);
                        console.log("suma total: "+sumaTotal);  

                    
                    });
               
           },
       });
}

var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var oilData = {
    labels: ["Clientes cubiertos", "Clientes faltantes"],
    datasets: [
        {
            data: [array1['porcentaje'], array1['clixcomprar']],
            backgroundColor: [
        'rgba(21,101,192,1)',//color azul
        'rgba(255,0,0,1)', //color rojo
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
});

let identificadorIntervaloDeTiempo1;

function repetirclientes() {
  identificadorIntervaloDeTiempo1 = setInterval(actualizaClientes, 300000);
}
function actualizaClientes() {
  //console.log("Ha pasado 1 segundo.");
  $.ajax(
       {
           url: 'clientes',               
           data: "",
           contentType: 'json; charset=utf-8',
           type: 'GET',
           success: function (data) {
               //console.log("se ejecuta cada minuto");
               $(data).each(function (i, row) {       
                //console.log("valor nuevo del cliente: "+row['porcentaje']);

                datosIngresos = {
                data: [row['porcentaje'], 0, row['clixcomprar']], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
                // Ahora debería haber tantos background colors como datos, es decir, para este ejemplo, 4
                backgroundColor: [
                    'rgba(21,101,192,1)',//color azul
                    'rgba(255,165,0,1)', //color naranja
                    'rgba(255,0,0,1)', //color rojo
                ],// Color de fondo
                borderColor: [
                    'rgba(0,0,0,1)',
                    'rgba(0,0,0,1)',
                    'rgba(0,0,0,1)',
                ],// Color del borde
                borderWidth: 0.2,// Ancho del borde
            };
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
