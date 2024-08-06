<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {

        //comentario de prueba
        $arrayDatos= $this->totalVendido();

        $array1= $this->cuentaClientes();

        $array2=  $this->ventaXsublinea();
        //return  $array2;
        return view('login.dashboard')->with('array', $arrayDatos)->with('array1', $array1)->with('array2', $array2);
    }
    public function arreglo()
    {
        $arrayDatos= $this->totalVendido();

        //return $this->totalVendido();
        return $arrayDatos;
    }


    public function totalVendido(){
        $datos =DB::select("SET NOCOUNT ON; select b.ped, b.SubTot_Imp,Emp from pedped a (nolock) left join peddet b (nolock) on a.num=b.cve where a.status<>'PC  '  ");
        $totaldatos = count($datos, COUNT_RECURSIVE);
        $total=0;
        $SubTCajas=0;
        $clietot=0;
        $porcliecomp=0;

        $clientes =DB::select("SET NOCOUNT ON; select cve from cxccli (nolock) where seg_mer = 'EXP'");
        $totclientes = count($clientes, COUNT_RECURSIVE);
        $arrayDatos=array();

        $clientescomprados = DB::select("SET NOCOUNT ON; select COUNT(distinct cte) [cte] from pedped (nolock) where  status<>'PC  ' and status not in ('CC  ')");
         $clietot=$clientescomprados[0]->cte;

        for( $i=0; $i< $totaldatos; $i++){
            $total+=$datos[$i]->SubTot_Imp;
            if($datos[$i]->Emp=="CJA"|| $datos[$i]->Emp=="BTO")
            $SubTCajas += $datos[$i]->ped;
        }
        //$numero_aleatorio = (100000 / rand(1, 100000))+100000;
        $totaPedidos=$this->cuentaPedidos();
        $totPaqConver=$this->convierteCajas();
        //$numero =  rand(1, 100);
        //$numero1 =  100000 / rand(1, 100000) + 100;
        $sum=round($SubTCajas+ $totPaqConver,2);
        $porVenta=($total*100)/70000000;
        $porPedidos=($totaPedidos*100)/1650;
        //$porCajas=($sum*100)/341882; 393,164
        $porCajas=($sum*100)/393165;
        $porcliecomp=($clietot*100)/400;

        $arrayDatos=array(
            'vtaTotal'=>round($total,2),//round($numero_aleatorio,2), //aqui va el total
            'vtaCajas'=>round($SubTCajas+ $totPaqConver,2),//$numero1,//round($SubTCajas+ $totPaqConver,2),//$SubTCajas+ $totPaqConver,
            'totalPedidos'=>$totaPedidos,//$numero, //$totaPedidos,
            'porVenta' =>$porVenta, //porcentaje de ventas con respecto a meta
            'porPedidos'=> $porPedidos, //porcentaje de pedidos con respecto a clientes
            'porCajas'=>$porCajas, //porcentaje de cajas con respecto a meta anterior 
            'clieComp'=>$clietot, //total de clientes comprados
            'porcliencomp'=>$porcliecomp, //total de clientes comprados
        );

        return $arrayDatos;
    }
    public function convierteCajas(){
        
        $datos =DB::select("SET NOCOUNT ON; select a.cve, a.par, a.r_par, a.cve_art,a.des,a.ped,a.fac_sal, b.fac_minimo
        from peddet a (nolock) inner join invars b (nolock)
        on a.cve_art=b.cve_art and a.cia=b.cia
         where a.Emp not in ('CJA','BTO')  and SUBSTRING(b.sub_alm, 4, 4) ='C' ");
         
         $array1 = json_decode(json_encode($datos), true);

         $suma=0;

        $groupCapas=array();

        foreach ($array1 as $k => $capa) {
            //prnt_r($capa['Proveedor']);
            $groupCapas[$capa['cve_art']][$k] =$capa;
        }
        $sumxart=array();
        foreach ($groupCapas as $k => $capa) {
            //$suma +=$capa->ped;
            foreach ($capa as $k => $c) {
                $suma +=$c['ped'];
            }
            if($c['fac_minimo']!=0)
            $sub= ($suma* $c['fac_sal'])/$c['fac_minimo'];

            $sumxart[$c['cve_art']]['subtotal'] =$sub;
            $sub=0;
            $suma=0;
        }
        $total=0;
        
            foreach ($sumxart as $k => $val) {
                $total +=$val['subtotal'];
                //$suma +=$c['ped'];
            } 

         return $total;


    }

    public function cuentaPedidos(){
        $datos =DB::select("SET NOCOUNT ON; select num from pedped (nolock) where status<>'PC  ' and status not in ('CC  ')");
        $totalpedidos = count($datos, COUNT_RECURSIVE);
        //$numero_aleatorio = rand(1,100);
        return $totalpedidos;
    }

    public function cuentaClientes(){

        $clietot=0;
        $clientescomprados = DB::select("SET NOCOUNT ON; select COUNT(distinct cte) [cte] from pedped (nolock) where  status<>'PC  ' and status not in ('CC  ')");
        $clietot=$clientescomprados[0]->cte;
        
        $clientes =DB::select("SET NOCOUNT ON; select cve from cxccli (nolock) where seg_mer = 'EXP'");
        $pedidos =DB::select("SET NOCOUNT ON; select distinct cte  from pedped a (nolock) inner join cxccli b  (nolock)
        on a.cte=b.cve where a.seg_mer = 'EXP'"); 
        $totclientes = count($clientes, COUNT_RECURSIVE);
        $totclicompra = count($pedidos, COUNT_RECURSIVE);
        
        $total = ($totclicompra*100)/584;
        $clieXcomprar= 100-$total;

        $arrayDatos=array(
            'porcentaje'=>round($total,2), //aqui va el porcentaje que compraron 
            'clixcomprar'=>round($clieXcomprar,2),//aqui va el porcentaje x comprar ,
        );


        return $arrayDatos ;
    }

    public function clientescomp(){

        $clietot=0;
        $clientescomprados = DB::select("SET NOCOUNT ON; select COUNT(distinct cte) [cte] from pedped (nolock) where  status<>'PC  ' and status not in ('CC  ')");
        $clietot=$clientescomprados[0]->cte;
        
        $porcliecomp=($clietot*100)/400;

        $arrayDatos=array(
            'cliente'=>$clietot, //aqui va el porcentaje que compraron 
            'porcliente'=>round($porcliecomp,2),//aqui va el porcentaje x comprar ,
        );


        return $arrayDatos ;
    }
    public function ventaXsublinea(){
        $datos =DB::select("SET NOCOUNT ON; select a.cve, a.cve_art, LTRIM(RTRIM(a.des)) [des], a.ped, a.fac_sal, b.s_lin,LTRIM(RTRIM(c.des))[nombre],a.Emp
        from peddet a (nolock)
        inner join inviar b (nolock)
        on a.cve_art=b.art
        inner join invsli c (nolock)
        on b.s_lin=c.cve
        inner join pedped d (nolock)
        on a.cve=d.num
        where a.status<>'PC ' ");
        
        $array1 = json_decode(json_encode($datos), true);
        $totaldatos = count($datos, COUNT_RECURSIVE);
        $groupCajas = array();
        $suma=0;
        foreach ($array1 as $k => $capa) {
            $groupCajas[$capa['nombre']][$k] =$capa;
        }
        $sumxart=array();
        foreach ($groupCajas as $k => $capa) {
            //$suma +=$capa->ped;
            foreach ($capa as $k => $c) {
                if($c['Emp']=="CJA"||$c['Emp']=="BTO")
                $suma +=$c['ped'];
            }
            

            $sumxart[$c['nombre']]['subtotal'] =$suma;
            $suma=0;
        }

        $arrayDatos=$sumxart;
        //return $arrayDatos;
        return $this->array_sort($arrayDatos, 'subtotal', SORT_DESC);
    }

    function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

    
}
