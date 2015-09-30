
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/data-pengadaan.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lkpp/jquery.min.google.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lkpp/jqueryui.min.google.js"></script>
<style>
    .total{
        font-weight:bold;
    }
    td.container > div {overflow:hidden; }
    td.container { height: 10px; width: 300px; }
    
   
.sort:hover {
  text-decoration: none;
  cursor: pointer;
}

.sort:focus {
  outline:none;
}

.sort:after {
  display:inline-block;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid transparent;
  content:"";
  position: relative;
  top:-10px;
  right:-5px;
}
.sort.asc:after {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid #ff6e6d;
  content:"";
  position: relative;
  top:4px;
  right:-5px;
}
.sort.desc:after {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #ff6e6d;
  content:"";
  position: relative;
  top:-4px;
  right:-5px;
}
</style>
<script> 
    $(document).ready(function() {
        
        $('#togglePaketPagu').click(function(){
           $('.paket').toggle();            
           $('.pagu').toggle();            
        });
        
        $('.apbdBulan').click(function(){
            var tipe = $(this).attr('tipe'); 
            var tahun = $(this).attr('tahun'); 
            showApbnBulan(tipe, tahun, 0);
        });
        
        $('.apbnBulan').click(function(){
            var tipe = $(this).attr('tipe'); 
            var tahun = $(this).attr('tahun'); 
            showApbnBulan(tipe, tahun, 0);
        });
        
        getTotal();    
            
        
        /**
        var $table = $('table.demo');
        $table.dataTable({
            "bInfo": false,
            "iDisplayLength": 100,
            "bLengthChange": false
        });

        $table.floatThead({
           scrolling: pageTop //i need this because of my floating header
        });
        
        jQuery('.demo:visible:has(thead)').each(function () {
            jQuery(this).floatThead();
        });
        **/
    });
    
    function showAbout()
    {
       
        
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "down" };
        var duration = 400;
 
        $("#homer").toggle(effect, options, duration, function() {			    	
            $("#informasir").toggle(effect, options2, duration); 
        });
   
    }
    
    function closeAbout()
    {
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "down" };
        var duration = 400;
 
        $("#informasir").toggle(effect, options2, duration, function() {			    	
            $("#homer").toggle(effect, options, duration); 
        });
   
    }
    
    var enableInfo = false;
    function enableToInfo()
    {
        enableInfo = true;        
    }
    
    function showMonitoring()
    {
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "left" };
        var duration = 400;
        
        $("#monitoringBar").show();
        $("#formMonitoring").addClass("selected");
        $("#formEvaluasi").removeClass("selected");
            
        $("#laporanDiv").hide(); 
        $("#kinerjaPengadaanDiv").hide(); 
        $("#apbnDiv").hide();
        $("#dataPengadaanDiv").show();
        
        $("#kinerjaPengadaanDiv").html(""); 
        
       
         
    }
    
    function showEvaluasi()
    {
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "left" };
        var duration = 400;
        
        $("#monitoringBar").hide();
        $("#formMonitoring").removeClass("selected");
        $("#formEvaluasi").addClass("selected"); 
        
        $("#laporanDiv").hide();
        $("#dataPengadaanDiv").hide();
        $("#apbnDiv").hide();
        $("#kinerjaPengadaanDiv").show(); 
        
        $("#laporanDiv").html(""); 
        $('#kinerjaPengadaanDiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/public/images/loading2.gif'/>");
        $("#kinerjaPengadaanDiv").html(getRemote("index.php?r=indikatorKldi/listM2"))
        //$('#kinerjaPengadaanDiv').removeClass("loading");
        
         
    }
    
    function showLaporan()
    { 
         
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "right" };
        var duration = 400;
        
        $("#dataPengadaanDiv").toggle(effect, options, duration, function() {	
            
            if(laporanHtml == "")
            {
                $('#laporanDiv').show();
                $('#laporanDiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/public/images/loading2.gif'/>");
                laporanHtml = getRemote("index.php?r=beranda/remoteLaporan");
                $('#laporanDiv').hide();
                $("#laporanDiv").html(laporanHtml);
            }
            
            $("#dataPengadaanDiv").hide();
            $('#laporanDiv').hide();
            $("#laporanDiv").toggle(effect, options2, duration); 
            $("#dataPengadaanTabber").removeClass("aktip");
            $("#laporanTabber").addClass("aktip");
        
        });
         
   
    }
    var apbnHtml = "";
    function showApbn(sumber_dana, tahun)
    {
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "left" };
        var duration = 400;
        
        $("#dataPengadaanDiv").toggle(effect, options, duration, function() {	
              
            if(true || apbnHtml == "")
            {
               
                $('#apbnDiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/public/images/loading2.gif'/>"); 
                //apbnHtml = getRemote("index.php?r=beranda/remoteProfilAnggaran&sumber_dana=" + sumber_dana + "&tahun=" + tahun);
                apbnHtml = getRemote("index.php?r=profilAnggaran/rlist&initial=1&sumber_dana=" + sumber_dana + "&tahun=" + tahun);
                $("#apbnDiv").html(apbnHtml);
                
                
            }
            
            $("#dataPengadaanDiv").hide();
            $('#apbnDiv').hide();
            $("#apbnDiv").toggle(effect, options2, duration); 
            $('#apbnDiv').show(); 
        }); 
         
    }
    
    function showApbnPaging(sumber_dana, tahun, page)
    {
        //console.log("showApbnPaging sumber_dana " + sumber_dana);
        $('#apbnDiv').show();
        $('#apbnDiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/public/images/loading2.gif'/>"); 
        //apbnHtml = getRemote("index.php?r=beranda/remoteProfilAnggaran&sumber_dana=" + sumber_dana + "&tahun=" + tahun);
        apbnHtml = getRemote("index.php?r=profilAnggaran/rlist&initial=1&sumber_dana=" + sumber_dana + "&tahun=" + tahun+"&page=" + page);
        $("#apbnDiv").html(apbnHtml); 
         
    }
    
    function closeApbn()
    {
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "right" };
        var duration = 400;
        
        $("#apbnDiv").toggle(effect, options2, duration, function() {	
            
            $('#apbnDiv').hide();
            $("#dataPengadaanDiv").hide(); 
            $("#dataPengadaanDiv").toggle(effect, options, duration);  
        
        });
   
    }
    
    var apbnBulanHtml = "";
    function showApbnBulan(sumber_dana, tahun, page)
    {
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "left" };
        var duration = 400;
        
        $("#dataPengadaanDiv").toggle(effect, options, duration, function() {	
              
            if(true || apbnBulanHtml == "")
            {
               
                $('#apbnDiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/public/images/loading2.gif'/>"); 
                //apbnBulanHtml = getRemote("index.php?r=beranda/remoteProfilAnggaranBulan&sumber_dana=" + sumber_dana + "&tahun=" + tahun);
                apbnBulanHtml = getRemote("index.php?r=profilAnggaran/rlistBulan&initial=1&sumber_dana=" + sumber_dana + "&tahun=" + tahun + "&page=" + page);
                $("#apbnDiv").html(apbnBulanHtml);
            }
            
            $("#dataPengadaanDiv").hide();
            $('#apbnDiv').hide();
            $("#apbnDiv").toggle(effect, options2, duration); 
            $('#apbnDiv').show();
             
        }); 
         
    }
    
    function showApbnBulanPaging(sumber_dana, tahun, page)
    {
         
        $('#apbnDiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/public/images/loading2.gif'/>"); 
        //apbnBulanHtml = getRemote("index.php?r=beranda/remoteProfilAnggaranBulan&sumber_dana=" + sumber_dana + "&tahun=" + tahun);
        apbnBulanHtml = getRemote("index.php?r=profilAnggaran/rlistBulan&initial=1&sumber_dana=" + sumber_dana + "&tahun=" + tahun + "&page=" + page);

        $("#apbnDiv").html(apbnBulanHtml);
 
         
    }
    
    function closeApbnBulan()
    {
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "right" };
        var duration = 400;
        
        $("#apbnDiv").toggle(effect, options2, duration, function() {	
            
            $('#apbnDiv').hide();
            $("#dataPengadaanDiv").hide(); 
            $("#dataPengadaanDiv").toggle(effect, options, duration);  
        
        });
   
    }
    
    function showLaporan()
    { 
         
        var effect = 'slide'; 
        var options = { direction: "left" };
        var options2 = { direction: "right" };
        var duration = 400;
        
        $("#dataPengadaanDiv").toggle(effect, options, duration, function() {	
            
            if(laporanHtml == "")
            {
                $('#laporanDiv').show();
                $('#laporanDiv').html("<img src='<?php echo Yii::app()->request->baseUrl; ?>/public/images/loading2.gif'/>");
                laporanHtml = getRemote("index.php?r=beranda/remoteLaporan");
                $('#laporanDiv').hide();
                $("#laporanDiv").html(laporanHtml);
            }
            
            $("#dataPengadaanDiv").hide();
            $('#laporanDiv').hide();
            $("#laporanDiv").toggle(effect, options2, duration); 
            $("#dataPengadaanTabber").removeClass("aktip");
            $("#laporanTabber").addClass("aktip");
        
        });
         
   
    }
    function getRemote(urls) {
        return $.ajax({
            type: "GET",
            url: urls,
            async: false
        }).responseText;
    }
    
</script>

<script>
    function HapusKoma(num)
    {
        
	return (num.replace(/\./g,''));	
    }
    
    function numberWithCommas(x) 
    {
       return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    function getTotal(){
           //fungsi untuk mendapatkan total untuk tabel profil anggaran bulanan
           var i;
           for(i=1;i<=36;i++) //looping per kolom tabel
           {
                var paket1 = document.getElementById("paket"+i+"_1").innerHTML;
                var paket2 = document.getElementById("paket"+i+"_2").innerHTML;
                paket1 = HapusKoma(paket1);
                paket2 = HapusKoma(paket2);
                total_paket = eval(paket1) + eval(paket2);
                document.getElementById("total_paket_"+i).innerHTML = numberWithCommas(total_paket);
                
                var pagu1 = document.getElementById("pagu"+i+"_1").innerHTML;
                var pagu2 = document.getElementById("pagu"+i+"_2").innerHTML;
                pagu1 = HapusKoma(pagu1);
                pagu2 = HapusKoma(pagu2);
                total_pagu = eval(pagu1) + eval(pagu2);
                document.getElementById("total_pagu_"+i).innerHTML = numberWithCommas(total_pagu);
                
           }
      }
            
   
</script>

<div class="row-fluid" >
    <div class="span12">
            <ul class="tabrow">
                <li class="tabitem selected" id="formMonitoring" ><a href="#tab0" data-toggle="tab" onclick="return showMonitoring();">MONITORING</a></li>

                    <li class="tabitem " id="formEvaluasi"><a href="index.php?r=indikatorKldi/listM2&sumber=m1" xdata-toggle="tab"  xonclick="return showEvaluasi();">EVALUASI</a></li>

            </ul> 
            <br/>  
    </div> 
</div>
<div id="dataPengadaanDiv"  class="row-fluid" >
    <div class="span12" id="homer">
               
            <!--
            <div class="box box-gray">  
                    <div class="box-title" id="title3" style="height:45px;background:darkorange;color:#ffffff">
                        <div style="display:inline;float:left;"><i class="icon-chevron-up"></i>&nbsp;PROGRAM PRIORITAS</div>
                        <div style="float:right;">
                                 
                        </div>
                    </div>
                    <div class="box-content" style="height:160px;background:#ffffff;padding-bottom: 50px;"> 
                         
                         <div class="tableez" style="height:100px;background:none;margin-top:20px;">
                             <table class="table tablecenter" style="padding:10px;width:90%;margin:0px auto;">
                                 <tr>
                                     <th style="background:none;color:black;">Program</th>
                                     <th style="background:none;color:black;">Nasional</th>
                                     <th style="background:none;color:black;">Bidang</th>
                                 </tr>     
                                 <tr>
                                     <td>7</td>
                                     <td>17</td>
                                     <td>92</td>
                                 </tr>  
                             </table> 
                       </div>     
                    </div>
            </div>
            <div class="bayangan"> </div>
            --> 
            <div id="expandKldiEselon1Div" style="cursor:pointer;text-align: center;">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=beranda/m2&expand=1" target="_blank">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/lkpp/kchart.png" title="INFO" id="dakjTable" data-placement="top" data-toggle="popover" title="Informasi" data-content="Lihat Data Paket Semua K/L/D/I."/> Lihat Data Paket Semua K/L/D/I
                </a>
            </div>
            <div class="box box-gray">  
                    <div class="box-title" id="title1" style="height:45px;background:#ff6e6d;color:#ffffff">
                        <div style="display:inline;float:left;"><i class="icon-chevron-up"></i>&nbsp;PROFIL ANGGARAN</div>
                        <div style="float:right;">
                            <div style="margin-bottom: 0px;">
                                <form method="POST" action="index.php?r=beranda/m1">
                                    &nbsp;&nbsp;&nbsp;<?php echo CHtml::dropDownList('tahun', $tahun, $listTahun, array('style' => 'width:110px;font-size:12px;','class'=>'ddl')); ?>
                                    <input type="submit" value="Filter" class="m1filter" style="margin-bottom:10px;"/>
                                </form>
                                
                            </div>
                            &nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="box-content" style="min-height:250px;background:#ffffff;padding-bottom: 50px;"> 
                         
                       <div class="tableez" style="height:100px;background:none;margin-top:20px;">
                            <table class="table tablecenter" style="width:100%;margin:0px auto;">
                                <thead>
                                <tr>
                                    <th style="background:none;color:black;" rowspan="2">Sumber Dana</th>
                                    <th style="background:none;color:black;" rowspan="2">Pagu Total (Juta)</th>
                                    <th style="background:none;color:black;" colspan="3">Pagu Belanja Pengadaan</th>
                                    <th style="background:none;color:black;" rowspan="2">Pengumuman RUP (Juta)</th>
                                    <th style="background:none;color:black;" colspan="3">Realisasi</th>
                                    
                                </tr>     
                                <tr>
                                    <th>Barang/Jasa (Juta)</th>
                                    <th>Modal (Juta)</th>
                                    <th>Total (Juta)</th>
                                    
                                    <th>E-Tendering (Juta)</th>
                                    <th>Non E-Tendering (Juta)</th>
                                    <th>Total (Juta)</th>
                                </tr>  
                                </thead>
                                <tbody>
                                     <?php
                                            
                                            $counter = 1;
                                            $pembagi = 1000000;
                                            
                                            //init variable for total
                                            $total_pagu = 0;
                                            $total_barang = 0;
                                            $total_modal = 0;
                                            $total_pengadaan= 0;
                                            $total_pengumumanRUP = 0;
                                            $total_etendering = 0;
                                            $total_non_etendering = 0;
                                            $total_realisasi = 0;
                                            
                                            foreach ($listProfilAnggaran as $profilAnggaran) {
                                                $paguTotal = number_format($profilAnggaran['pagu_total']/$pembagi);
                                                $paguPengadaanBarangJasa = number_format($profilAnggaran['pagu_pengadaan_barang_jasa']/$pembagi);
                                                $paguPengadaanModal = number_format($profilAnggaran['pagu_pengadaan_modal']/$pembagi);
                                                $paguPengadaanTotal = number_format($profilAnggaran['pagu_pengadaan_total']/$pembagi);
                                                $pengumumanRUP = number_format($profilAnggaran['pengumuman_rup']/$pembagi);
                                                $realisasiETendering = number_format($profilAnggaran['realisasi_etendering']/$pembagi);
                                                $realisasiNonETendering  = number_format($profilAnggaran['realisasi_non_etendering']/$pembagi);
                                                $realisasiTotal = number_format($profilAnggaran['realisasi_total']/$pembagi);
                                                
                                                //loop total
                                                $total_pagu += $profilAnggaran['pagu_total'];
                                                $total_barang += $profilAnggaran['pagu_pengadaan_barang_jasa'];
                                                $total_modal += $profilAnggaran['pagu_pengadaan_modal'];
                                                $total_pengadaan += $profilAnggaran['pagu_pengadaan_total'];
                                                $total_pengumumanRUP += $profilAnggaran['pengumuman_rup'];
                                                $total_etendering += $profilAnggaran['realisasi_etendering'];
                                                $total_non_etendering += $profilAnggaran['realisasi_non_etendering'];
                                                $total_realisasi += $profilAnggaran['realisasi_total'];
                                                
                                                $line = "<td><a href='#' onclick=\"return showApbn('$profilAnggaran[sumber_dana]','$profilAnggaran[tahun]');\">$profilAnggaran[sumber_dana]</a></td>"
                                                        . "<td>$paguTotal</td>"
                                                        . "<td>$paguPengadaanBarangJasa</td>"
                                                        . "<td>$paguPengadaanModal</td>"
                                                        . "<td>$paguPengadaanTotal</td>"
                                                        . "<td>$pengumumanRUP</td>"
                                                        . "<td>$realisasiETendering</td>"
                                                        . "<td>$realisasiNonETendering</td>"
                                                        . "<td>$realisasiTotal</td>"
                                                        ;
                                                echo "<tr>$line</tr>";
                                                $counter++;
                                                 
                                            }
                                            //format total with coma and divide $pembagi
                                            $totPagu = number_format($total_pagu/$pembagi);
                                            $totBarang = number_format($total_barang/$pembagi);
                                            $totModal = number_format($total_modal/$pembagi);
                                            $totPengadaan = number_format($total_pengadaan/$pembagi);
                                            $totRUP = number_format($total_pengumumanRUP/$pembagi);
                                            $totEtendering = number_format($total_etendering/$pembagi);
                                            $totNonETendering= number_format($total_non_etendering/$pembagi);
                                            $totRealisasi = number_format($total_realisasi/$pembagi);
                                            //display total all field
                                            echo "<tr class='total'>";
                                            echo "<td>Total</td><td>$totPagu</td><td>$totBarang</td><td>$totModal</td><td>$totPengadaan</td><td>$totRUP</td><td>$totEtendering</td><td>$totNonETendering</td><td>$totRealisasi</td>";
                                        ?>   
                                </tbody>
                                    
                            </table> 
                      </div>     
 
                    </div>
            </div>
            
            <div class="box box-gray">  
                    <div class="box-title" id="title1" style="height:45px;background:#ff6e6d;color:#ffffff">
                        <div style="display:inline;float:left;"></i>&nbsp;PROFIL ANGGARAN BULANAN</div>
                        <div style="float:right;width:290px;">
                            <div class="button_filter" id="togglePaketPagu" style="float: left;">Paket/Pagu</div>
                            <div style="margin-bottom: 0px;">
                                <form method="POST" action="index.php?r=beranda/m1">
                                    &nbsp;&nbsp;&nbsp;<?php echo CHtml::dropDownList('tahun', $tahun, $listTahun, array('style' => 'width:110px;font-size:12px;','class'=>'ddl')); ?>
                                    <input type="submit" value="Filter" class="m1filter" style="margin-bottom:10px;"/>
                                </form>
                                
                            </div>
                            &nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="box-content" style="min-height:300px;background:#ffffff;padding-bottom: 50px;"> 
                         
                       <div class="tableez" style="height:300px;background:none;margin-top:20px;overflow-x: auto;width:100%;">
                           <span class="paket"><b><u>Informasi Jumlah Paket</u></b></span>
                           <span class="pagu" style="display:none;"><b><u>Informasi Jumlah Pagu</u></b></span>
                           <br/><br/>
                            <table class="table tablecenter demo2" style="width:100%;margin:0px auto;">
                                <thead>
                                <tr>
                                    <th style="background:none;color:black;" rowspan="2">Sumber Dana</th>
                                     <?php
                                        
                                        $bulanArr = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
                                        for($bulan = 0; $bulan <=11; $bulan++)
                                        {
                                            
                                            echo '<th style="background:none;color:black;" colspan="3">' . $bulanArr[$bulan] . '</th>';
                                        }
                                    ?>
                                    
                                </tr>     
                                <tr>
                                    <?php
                                          
                                        for($bulan = 1; $bulan <=12; $bulan++)
                                        {
                                            echo "<th>1 <span class='pagu' style='display:none'><br/>(Juta)</span></th>";
                                            echo "<th>2 <span class='pagu' style='display:none'><br/>(Juta)</span></th>";
                                            echo "<th>3 <span class='pagu' style='display:none'><br/>(Juta)</span></th>";
                                        }
                                    ?>
                                    
                                </tr>  
                                </thead>
                                <tbody>
                                  
                                  <?php
                                   $counter = 1;
                                   $pembagi = 1000000;

                                   $x=1;
                                   foreach ($listProfilAnggaranBulananNasional as $it)
                                   {
                                        
                                        $paket_bulan1_1 = 0;
                                        $paket_bulan1_2 = 0;
                                        $paket_bulan1_3 = 0;
                                        $paket_bulan2_1 = 0;
                                        $paket_bulan2_2 = 0;
                                        $paket_bulan2_3 = 0;
                                        $paket_bulan3_1 = 0;
                                        $paket_bulan3_2 = 0;
                                        $paket_bulan3_3 = 0;
                                        $paket_bulan4_1 = 0;
                                        $paket_bulan4_2 = 0;
                                        $paket_bulan4_3 = 0;
                                        $paket_bulan5_1 = 0;
                                        $paket_bulan5_2 = 0;
                                        $paket_bulan5_3 = 0;
                                        $paket_bulan6_1 = 0;
                                        $paket_bulan6_2 = 0;
                                        $paket_bulan6_3 = 0;
                                        $paket_bulan7_1 = 0;
                                        $paket_bulan7_2 = 0;
                                        $paket_bulan7_3 = 0;
                                        $paket_bulan8_1 = 0;
                                        $paket_bulan8_2 = 0;
                                        $paket_bulan8_3 = 0;
                                        $paket_bulan9_1 = 0;
                                        $paket_bulan9_2 = 0;
                                        $paket_bulan9_3 = 0;
                                        $paket_bulan10_1 = 0;
                                        $paket_bulan10_2 = 0;
                                        $paket_bulan10_3 = 0;
                                        $paket_bulan11_1 = 0;
                                        $paket_bulan11_2 = 0;
                                        $paket_bulan11_3 = 0;
                                        $paket_bulan12_1 = 0;
                                        $paket_bulan12_2 = 0;
                                        $paket_bulan12_3 = 0;

                                        $paket_bulan1_1 = $it["paket_bulan1_1"];
                                        $paket_bulan1_2 = $it["paket_bulan1_2"];
                                        $paket_bulan1_3 = $it["paket_bulan1_3"];

                                        $paket_bulan2_1 = $paket_bulan1_1 + $it["paket_bulan2_1"];
                                        $paket_bulan2_2 = $paket_bulan1_2 + $it["paket_bulan2_2"];
                                        $paket_bulan2_3 = $paket_bulan1_3 + $it["paket_bulan2_3"];

                                        $paket_bulan3_1 = $paket_bulan2_1 + $it["paket_bulan3_1"];
                                        $paket_bulan3_2 = $paket_bulan2_2 + $it["paket_bulan3_2"];
                                        $paket_bulan3_3 = $paket_bulan2_3 + $it["paket_bulan3_3"];

                                        $paket_bulan4_1 = $paket_bulan3_1 + $it["paket_bulan4_1"];
                                        $paket_bulan4_2 = $paket_bulan3_2 + $it["paket_bulan4_2"];
                                        $paket_bulan4_3 = $paket_bulan3_3 + $it["paket_bulan4_3"];

                                        $paket_bulan5_1 = $paket_bulan4_1 + $it["paket_bulan5_1"];
                                        $paket_bulan5_2 = $paket_bulan4_2 + $it["paket_bulan5_2"];
                                        $paket_bulan5_3 = $paket_bulan4_3 + $it["paket_bulan5_3"];

                                        $paket_bulan6_1 = $paket_bulan5_1 + $it["paket_bulan6_1"];
                                        $paket_bulan6_2 = $paket_bulan5_2 + $it["paket_bulan6_2"];
                                        $paket_bulan6_3 = $paket_bulan5_3 + $it["paket_bulan6_3"];

                                        $paket_bulan7_1 = $paket_bulan6_1 + $it["paket_bulan7_1"];
                                        $paket_bulan7_2 = $paket_bulan6_2 + $it["paket_bulan7_2"];
                                        $paket_bulan7_3 = $paket_bulan6_3 + $it["paket_bulan7_3"];

                                        $paket_bulan8_1 = $paket_bulan7_1 + $it["paket_bulan8_1"];
                                        $paket_bulan8_2 = $paket_bulan7_2 + $it["paket_bulan8_2"];
                                        $paket_bulan8_3 = $paket_bulan7_3 + $it["paket_bulan8_3"];

                                        $paket_bulan9_1 = $paket_bulan8_1 + $it["paket_bulan9_1"];
                                        $paket_bulan9_2 = $paket_bulan8_2 + $it["paket_bulan9_2"];
                                        $paket_bulan9_3 = $paket_bulan8_3 + $it["paket_bulan9_3"];

                                        $paket_bulan10_1 =$paket_bulan9_1 + $it["paket_bulan10_1"];
                                        $paket_bulan10_2 =$paket_bulan9_2 + $it["paket_bulan10_2"];
                                        $paket_bulan10_3 =$paket_bulan9_3 + $it["paket_bulan10_3"];

                                        $paket_bulan11_1 = $paket_bulan10_1 + $it["paket_bulan11_1"];
                                        $paket_bulan11_2 = $paket_bulan10_2 + $it["paket_bulan11_2"];
                                        $paket_bulan11_3 = $paket_bulan10_3 + $it["paket_bulan11_3"];

                                        $paket_bulan12_1 = $paket_bulan11_1 + $it["paket_bulan12_1"];
                                        $paket_bulan12_2 = $paket_bulan11_2 + $it["paket_bulan12_2"];
                                        $paket_bulan12_3 = $paket_bulan11_3 + $it["paket_bulan12_3"];
                                                    
                                        $paket_bulan1_1 = number_format($paket_bulan1_1, 0, ',', '.');
                                        $paket_bulan1_2 = number_format($paket_bulan1_2, 0, ',', '.');
                                        $paket_bulan1_3 = number_format($paket_bulan1_3, 0, ',', '.');
                                        $paket_bulan2_1 = number_format($paket_bulan2_1, 0, ',', '.');
                                        $paket_bulan2_2 = number_format($paket_bulan2_2, 0, ',', '.');
                                        $paket_bulan2_3 = number_format($paket_bulan2_3, 0, ',', '.');
                                        $paket_bulan3_1 = number_format($paket_bulan3_1, 0, ',', '.');
                                        $paket_bulan3_2 = number_format($paket_bulan3_2, 0, ',', '.');
                                        $paket_bulan3_3 = number_format($paket_bulan3_3, 0, ',', '.');
                                        $paket_bulan4_1 = number_format($paket_bulan4_1, 0, ',', '.');
                                        $paket_bulan4_2 = number_format($paket_bulan4_2, 0, ',', '.');
                                        $paket_bulan4_3 = number_format($paket_bulan4_3, 0, ',', '.');
                                        $paket_bulan5_1 = number_format($paket_bulan5_1, 0, ',', '.');
                                        $paket_bulan5_2 = number_format($paket_bulan5_2, 0, ',', '.');
                                        $paket_bulan5_3 = number_format($paket_bulan5_3, 0, ',', '.');
                                        $paket_bulan6_1 = number_format($paket_bulan6_1, 0, ',', '.');
                                        $paket_bulan6_2 = number_format($paket_bulan6_2, 0, ',', '.');
                                        $paket_bulan6_3 = number_format($paket_bulan6_3, 0, ',', '.');
                                        $paket_bulan7_1 = number_format($paket_bulan7_1, 0, ',', '.');
                                        $paket_bulan7_2 = number_format($paket_bulan7_2, 0, ',', '.');
                                        $paket_bulan7_3 = number_format($paket_bulan7_3, 0, ',', '.');
                                        $paket_bulan8_1 = number_format($paket_bulan8_1, 0, ',', '.');
                                        $paket_bulan8_2 = number_format($paket_bulan8_2, 0, ',', '.');
                                        $paket_bulan8_3 = number_format($paket_bulan8_3, 0, ',', '.');
                                        $paket_bulan9_1 = number_format($paket_bulan9_1, 0, ',', '.');
                                        $paket_bulan9_2 = number_format($paket_bulan9_2, 0, ',', '.');
                                        $paket_bulan9_3 = number_format($paket_bulan9_3, 0, ',', '.');
                                        $paket_bulan10_1 = number_format($paket_bulan10_1, 0, ',', '.');
                                        $paket_bulan10_2 = number_format($paket_bulan10_2, 0, ',', '.');
                                        $paket_bulan10_3 = number_format($paket_bulan10_3, 0, ',', '.');
                                        $paket_bulan11_1 = number_format($paket_bulan11_1, 0, ',', '.');
                                        $paket_bulan11_2 = number_format($paket_bulan11_2, 0, ',', '.');
                                        $paket_bulan11_3 = number_format($paket_bulan11_3, 0, ',', '.');
                                        $paket_bulan12_1 = number_format($paket_bulan12_1, 0, ',', '.');
                                        $paket_bulan12_2 = number_format($paket_bulan12_2, 0, ',', '.');
                                        $paket_bulan12_3 = number_format($paket_bulan12_3, 0, ',', '.');

                                        $pagu_bulan1_1 = 0;
                                        $pagu_bulan1_2 = 0;
                                        $pagu_bulan1_3 = 0;
                                        $pagu_bulan2_1 = 0;
                                        $pagu_bulan2_2 = 0;
                                        $pagu_bulan2_3 = 0;
                                        $pagu_bulan3_1 = 0;
                                        $pagu_bulan3_2 = 0;
                                        $pagu_bulan3_3 = 0;
                                        $pagu_bulan4_1 = 0;
                                        $pagu_bulan4_2 = 0;
                                        $pagu_bulan4_3 = 0;
                                        $pagu_bulan5_1 = 0;
                                        $pagu_bulan5_2 = 0;
                                        $pagu_bulan5_3 = 0;
                                        $pagu_bulan6_1 = 0;
                                        $pagu_bulan6_2 = 0;
                                        $pagu_bulan6_3 = 0;
                                        $pagu_bulan7_1 = 0;
                                        $pagu_bulan7_2 = 0;
                                        $pagu_bulan7_3 = 0;
                                        $pagu_bulan8_1 = 0;
                                        $pagu_bulan8_2 = 0;
                                        $pagu_bulan8_3 = 0;
                                        $pagu_bulan9_1 = 0;
                                        $pagu_bulan9_2 = 0;
                                        $pagu_bulan9_3 = 0;
                                        $pagu_bulan10_1 = 0;
                                        $pagu_bulan10_2 = 0;
                                        $pagu_bulan10_3 = 0;
                                        $pagu_bulan11_1 = 0;
                                        $pagu_bulan11_2 = 0;
                                        $pagu_bulan11_3 = 0;
                                        $pagu_bulan12_1 = 0;
                                        $pagu_bulan12_2 = 0;
                                        $pagu_bulan12_3 = 0;


                                        $pagu_bulan1_1 = $it["pagu_bulan1_1"];
                                        $pagu_bulan1_2 = $it["pagu_bulan1_2"];
                                        $pagu_bulan1_3 = $it["pagu_bulan1_3"];

                                        $pagu_bulan2_1 = $pagu_bulan1_1 + $it["pagu_bulan2_1"];
                                        $pagu_bulan2_2 = $pagu_bulan1_2 + $it["pagu_bulan2_2"];
                                        $pagu_bulan2_3 = $pagu_bulan1_3 + $it["pagu_bulan2_3"];

                                        $pagu_bulan3_1 = $pagu_bulan2_1 + $it["pagu_bulan3_1"];
                                        $pagu_bulan3_2 = $pagu_bulan2_2 + $it["pagu_bulan3_2"];
                                        $pagu_bulan3_3 = $pagu_bulan2_3 + $it["pagu_bulan3_3"];

                                        $pagu_bulan4_1 = $pagu_bulan3_1 + $it["pagu_bulan4_1"];
                                        $pagu_bulan4_2 = $pagu_bulan3_2 + $it["pagu_bulan4_2"];
                                        $pagu_bulan4_3 = $pagu_bulan3_3 + $it["pagu_bulan4_3"];

                                        $pagu_bulan5_1 = $pagu_bulan4_1 + $it["pagu_bulan5_1"];
                                        $pagu_bulan5_2 = $pagu_bulan4_2 + $it["pagu_bulan5_2"];
                                        $pagu_bulan5_3 = $pagu_bulan4_3 + $it["pagu_bulan5_3"];

                                        $pagu_bulan6_1 = $pagu_bulan5_1 + $it["pagu_bulan6_1"];
                                        $pagu_bulan6_2 = $pagu_bulan5_2 + $it["pagu_bulan6_2"];
                                        $pagu_bulan6_3 = $pagu_bulan5_3 + $it["pagu_bulan6_3"];

                                        $pagu_bulan7_1 = $pagu_bulan6_1 + $it["pagu_bulan7_1"];
                                        $pagu_bulan7_2 = $pagu_bulan6_2 + $it["pagu_bulan7_2"];
                                        $pagu_bulan7_3 = $pagu_bulan6_3 + $it["pagu_bulan7_3"];

                                        $pagu_bulan8_1 = $pagu_bulan7_1 + $it["pagu_bulan8_1"];
                                        $pagu_bulan8_2 = $pagu_bulan7_2 + $it["pagu_bulan8_2"];
                                        $pagu_bulan8_3 = $pagu_bulan7_3 + $it["pagu_bulan8_3"];

                                        $pagu_bulan9_1 = $pagu_bulan8_1 + $it["pagu_bulan9_1"];
                                        $pagu_bulan9_2 = $pagu_bulan8_2 + $it["pagu_bulan9_2"];
                                        $pagu_bulan9_3 = $pagu_bulan8_3 + $it["pagu_bulan9_3"];

                                        $pagu_bulan10_1 =$pagu_bulan9_1 + $it["pagu_bulan10_1"];
                                        $pagu_bulan10_2 =$pagu_bulan9_2 + $it["pagu_bulan10_2"];
                                        $pagu_bulan10_3 =$pagu_bulan9_3 + $it["pagu_bulan10_3"];

                                        $pagu_bulan11_1 = $pagu_bulan10_1 + $it["pagu_bulan11_1"];
                                        $pagu_bulan11_2 = $pagu_bulan10_2 + $it["pagu_bulan11_2"];
                                        $pagu_bulan11_3 = $pagu_bulan10_3 + $it["pagu_bulan11_3"];

                                        $pagu_bulan12_1 = $pagu_bulan11_1 + $it["pagu_bulan12_1"];
                                        $pagu_bulan12_2 = $pagu_bulan11_2 + $it["pagu_bulan12_2"];
                                        $pagu_bulan12_3 = $pagu_bulan11_3 + $it["pagu_bulan12_3"];
                                        
                                        $pagu_bulan1_1 = number_format($pagu_bulan1_1/1000000, 0, ',', '.');
                                        $pagu_bulan1_2 = number_format($pagu_bulan1_2/1000000, 0, ',', '.');
                                        $pagu_bulan1_3 = number_format($pagu_bulan1_3/1000000, 0, ',', '.');
                                        $pagu_bulan2_1 = number_format($pagu_bulan2_1/1000000, 0, ',', '.');
                                        $pagu_bulan2_2 = number_format($pagu_bulan2_2/1000000, 0, ',', '.');
                                        $pagu_bulan2_3 = number_format($pagu_bulan2_3/1000000, 0, ',', '.');
                                        $pagu_bulan3_1 = number_format($pagu_bulan3_1/1000000, 0, ',', '.');
                                        $pagu_bulan3_2 = number_format($pagu_bulan3_2/1000000, 0, ',', '.');
                                        $pagu_bulan3_3 = number_format($pagu_bulan3_3/1000000, 0, ',', '.');
                                        $pagu_bulan4_1 = number_format($pagu_bulan4_1/1000000, 0, ',', '.');
                                        $pagu_bulan4_2 = number_format($pagu_bulan4_2/1000000, 0, ',', '.');
                                        $pagu_bulan4_3 = number_format($pagu_bulan4_3/1000000, 0, ',', '.');
                                        $pagu_bulan5_1 = number_format($pagu_bulan5_1/1000000, 0, ',', '.');
                                        $pagu_bulan5_2 = number_format($pagu_bulan5_2/1000000, 0, ',', '.');
                                        $pagu_bulan5_3 = number_format($pagu_bulan5_3/1000000, 0, ',', '.');
                                        $pagu_bulan6_1 = number_format($pagu_bulan6_1/1000000, 0, ',', '.');
                                        $pagu_bulan6_2 = number_format($pagu_bulan6_2/1000000, 0, ',', '.');
                                        $pagu_bulan6_3 = number_format($pagu_bulan6_3/1000000, 0, ',', '.');
                                        $pagu_bulan7_1 = number_format($pagu_bulan7_1/1000000, 0, ',', '.');
                                        $pagu_bulan7_2 = number_format($pagu_bulan7_2/1000000, 0, ',', '.');
                                        $pagu_bulan7_3 = number_format($pagu_bulan7_3/1000000, 0, ',', '.');
                                        $pagu_bulan8_1 = number_format($pagu_bulan8_1/1000000, 0, ',', '.');
                                        $pagu_bulan8_2 = number_format($pagu_bulan8_2/1000000, 0, ',', '.');
                                        $pagu_bulan8_3 = number_format($pagu_bulan8_3/1000000, 0, ',', '.');
                                        $pagu_bulan9_1 = number_format($pagu_bulan9_1/1000000, 0, ',', '.');
                                        $pagu_bulan9_2 = number_format($pagu_bulan9_2/1000000, 0, ',', '.');
                                        $pagu_bulan9_3 = number_format($pagu_bulan9_3/1000000, 0, ',', '.');
                                        $pagu_bulan10_1 = number_format($pagu_bulan10_1/1000000, 0, ',', '.');
                                        $pagu_bulan10_2 = number_format($pagu_bulan10_2/1000000, 0, ',', '.');
                                        $pagu_bulan10_3 = number_format($pagu_bulan10_3/1000000, 0, ',', '.');
                                        $pagu_bulan11_1 = number_format($pagu_bulan11_1/1000000, 0, ',', '.');
                                        $pagu_bulan11_2 = number_format($pagu_bulan11_2/1000000, 0, ',', '.');
                                        $pagu_bulan11_3 = number_format($pagu_bulan11_3/1000000, 0, ',', '.');
                                        $pagu_bulan12_1 = number_format($pagu_bulan12_1/1000000, 0, ',', '.');
                                        $pagu_bulan12_2 = number_format($pagu_bulan12_2/1000000, 0, ',', '.');
                                        $pagu_bulan12_3 = number_format($pagu_bulan12_3/1000000, 0, ',', '.');
                                        $sumber = $it["sumber"];
                                        
                                        if($sumber == "APBN")
                                        {
                                            $col = "<a href='#' tipe='APBN' tahun='$tahun' class='apbnBulan' xonclick=\"return showApbnBulan('APBN','$tahun', '0');\">APBN</a>";
                                        }
                                        else if ($sumber == "APBD")
                                        {
                                            $col = "<a href='#' tipe='APBD' tahun='$tahun' class='apbdBulan' xonclick=\"return showApbnBulan('APBD','$tahun', '0');\">APBD</a>";
                                        }
                                        else
                                        {
                                            $col="";
                                        }
                                        echo "<tr>";
                                            $line = "<td>$col</td>"
                                                    ."<td><span id='paket1_$x' class='paket'>$paket_bulan1_1</span><span id='pagu1_$x' class='pagu' style='display:none;'>$pagu_bulan1_1</span></td>"
                                                    ."<td><span id='paket2_$x' class='paket'>$paket_bulan1_2</span><span id='pagu2_$x' class='pagu' style='display:none;'>$pagu_bulan1_2</span></td>"
                                                    ."<td><span id='paket3_$x' class='paket'>$paket_bulan1_3</span><span id='pagu3_$x' class='pagu' style='display:none;'>$pagu_bulan1_3</span></td>"

                                                    ."<td><span id='paket4_$x' class='paket'>$paket_bulan2_1</span><span id='pagu4_$x' class='pagu' style='display:none;'>$pagu_bulan2_1</span></td>"
                                                    ."<td><span id='paket5_$x' class='paket'>$paket_bulan2_2</span><span id='pagu5_$x' class='pagu' style='display:none;'>$pagu_bulan2_2</span></td>"
                                                    ."<td><span id='paket6_$x' class='paket'>$paket_bulan2_3</span><span id='pagu6_$x' class='pagu' style='display:none;'>$pagu_bulan2_3</span></td>"

                                                    ."<td><span id='paket7_$x' class='paket'>$paket_bulan3_1</span><span id='pagu7_$x' class='pagu' style='display:none;'>$pagu_bulan3_1</span></td>"
                                                    ."<td><span id='paket8_$x' class='paket'>$paket_bulan3_2</span><span id='pagu8_$x' class='pagu' style='display:none;'>$pagu_bulan3_2</span></td>"
                                                    ."<td><span id='paket9_$x' class='paket'>$paket_bulan3_3</span><span id='pagu9_$x' class='pagu' style='display:none;'>$pagu_bulan3_3</span></td>"

                                                    ."<td><span id='paket10_$x' class='paket'>$paket_bulan4_1</span><span id='pagu10_$x' class='pagu' style='display:none;'>$pagu_bulan4_1</span></td>"
                                                    ."<td><span id='paket11_$x' class='paket'>$paket_bulan4_2</span><span id='pagu11_$x' class='pagu' style='display:none;'>$pagu_bulan4_2</span></td>"
                                                    ."<td><span id='paket12_$x' class='paket'>$paket_bulan4_3</span><span id='pagu12_$x' class='pagu' style='display:none;'>$pagu_bulan4_3</span></td>"

                                                    ."<td><span id='paket13_$x' class='paket'>$paket_bulan5_1</span><span id='pagu13_$x' class='pagu' style='display:none;'>$pagu_bulan5_1</span></td>"
                                                    ."<td><span id='paket14_$x' class='paket'>$paket_bulan5_2</span><span id='pagu14_$x' class='pagu' style='display:none;'>$pagu_bulan5_2</span></td>"
                                                    ."<td><span id='paket15_$x' class='paket'>$paket_bulan5_3</span><span id='pagu15_$x' class='pagu' style='display:none;'>$pagu_bulan5_3</span></td>"

                                                    ."<td><span id='paket16_$x' class='paket'>$paket_bulan6_1</span><span id='pagu16_$x' class='pagu' style='display:none;'>$pagu_bulan6_1</span></td>"
                                                    ."<td><span id='paket17_$x' class='paket'>$paket_bulan6_2</span><span id='pagu17_$x' class='pagu' style='display:none;'>$pagu_bulan6_2</span></td>"
                                                    ."<td><span id='paket18_$x' class='paket'>$paket_bulan6_3</span><span id='pagu18_$x' class='pagu' style='display:none;'>$pagu_bulan6_3</span></td>"

                                                    ."<td><span id='paket19_$x' class='paket'>$paket_bulan7_1</span><span id='pagu19_$x' class='pagu' style='display:none;'>$pagu_bulan7_1</span></td>"
                                                    ."<td><span id='paket20_$x' class='paket'>$paket_bulan7_2</span><span id='pagu20_$x' class='pagu' style='display:none;'>$pagu_bulan7_2</span></td>"
                                                    ."<td><span id='paket21_$x' class='paket'>$paket_bulan7_3</span><span id='pagu21_$x' class='pagu' style='display:none;'>$pagu_bulan7_3</span></td>"

                                                    ."<td><span id='paket22_$x' class='paket'>$paket_bulan8_1</span><span id='pagu22_$x' class='pagu' style='display:none;'>$pagu_bulan8_1</span></td>"
                                                    ."<td><span id='paket23_$x' class='paket'>$paket_bulan8_2</span><span id='pagu23_$x' class='pagu' style='display:none;'>$pagu_bulan8_2</span></td>"
                                                    ."<td><span id='paket24_$x' class='paket'>$paket_bulan8_3</span><span id='pagu24_$x' class='pagu' style='display:none;'>$pagu_bulan8_3</span></td>"

                                                    ."<td><span id='paket25_$x' class='paket'>$paket_bulan9_1</span><span id='pagu25_$x' class='pagu' style='display:none;'>$pagu_bulan9_1</span></td>"
                                                    ."<td><span id='paket26_$x' class='paket'>$paket_bulan9_2</span><span id='pagu26_$x' class='pagu' style='display:none;'>$pagu_bulan9_2</span></td>"
                                                    ."<td><span id='paket27_$x' class='paket'>$paket_bulan9_3</span><span id='pagu27_$x' class='pagu' style='display:none;'>$pagu_bulan9_3</span></td>"

                                                    ."<td><span id='paket28_$x' class='paket'>$paket_bulan10_1</span><span id='pagu28_$x' class='pagu' style='display:none;'>$pagu_bulan10_1</span></td>"
                                                    ."<td><span id='paket29_$x' class='paket'>$paket_bulan10_2</span><span id='pagu29_$x' class='pagu' style='display:none;'>$pagu_bulan10_2</span></td>"
                                                    ."<td><span id='paket30_$x' class='paket'>$paket_bulan10_3</span><span id='pagu30_$x' class='pagu' style='display:none;'>$pagu_bulan10_3</span></td>"

                                                    ."<td><span id='paket31_$x' class='paket'>$paket_bulan11_1</span><span id='pagu31_$x' class='pagu' style='display:none;'>$pagu_bulan11_1</span></td>"
                                                    ."<td><span id='paket32_$x' class='paket'>$paket_bulan11_2</span><span id='pagu32_$x' class='pagu' style='display:none;'>$pagu_bulan11_2</span></td>"
                                                    ."<td><span id='paket33_$x' class='paket'>$paket_bulan11_3</span><span id='pagu33_$x' class='pagu' style='display:none;'>$pagu_bulan11_3</span></td>"

                                                    ."<td><span id='paket34_$x' class='paket'>$paket_bulan12_1</span><span id='pagu34_$x' class='pagu' style='display:none;'>$pagu_bulan12_1</span></td>"
                                                    ."<td><span id='paket35_$x' class='paket'>$paket_bulan12_2</span><span id='pagu35_$x' class='pagu' style='display:none;'>$pagu_bulan12_2</span></td>"
                                                    ."<td><span id='paket36_$x' class='paket'>$paket_bulan12_3</span><span id='pagu36_$x' class='pagu' style='display:none;'>$pagu_bulan12_3</span></td>";
                                            echo $line;
                                            echo "</tr>";
                                            $x++;
                                   }
                                   echo "<tr class='total'>";
                                   echo "<td><span id='sumber' class='paket'>Total</span><span class='pagu' style='display:none;'>Total</span></td>";
                                   echo "<td><span id='total_paket_1' class='paket'></span><span id='total_pagu_1' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_2' class='paket'></span><span id='total_pagu_2' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_3' class='paket'></span><span id='total_pagu_3' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_4' class='paket'></span><span id='total_pagu_4' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_5' class='paket'></span><span id='total_pagu_5' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_6' class='paket'></span><span id='total_pagu_6' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_7' class='paket'></span><span id='total_pagu_7' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_8' class='paket'></span><span id='total_pagu_8' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_9' class='paket'></span><span id='total_pagu_9' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_10' class='paket'></span><span id='total_pagu_10' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_11' class='paket'></span><span id='total_pagu_11' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_12' class='paket'></span><span id='total_pagu_12' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_13' class='paket'></span><span id='total_pagu_13' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_14' class='paket'></span><span id='total_pagu_14' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_15' class='paket'></span><span id='total_pagu_15' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_16' class='paket'></span><span id='total_pagu_16' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_17' class='paket'></span><span id='total_pagu_17' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_18' class='paket'></span><span id='total_pagu_18' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_19' class='paket'></span><span id='total_pagu_19' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_20' class='paket'></span><span id='total_pagu_20' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_21' class='paket'></span><span id='total_pagu_21' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_22' class='paket'></span><span id='total_pagu_22' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_23' class='paket'></span><span id='total_pagu_23' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_24' class='paket'></span><span id='total_pagu_24' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_25' class='paket'></span><span id='total_pagu_25' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_26' class='paket'></span><span id='total_pagu_26' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_27' class='paket'></span><span id='total_pagu_27' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_28' class='paket'></span><span id='total_pagu_28' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_29' class='paket'></span><span id='total_pagu_29' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_30' class='paket'></span><span id='total_pagu_30' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_31' class='paket'></span><span id='total_pagu_31' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_32' class='paket'></span><span id='total_pagu_32' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_33' class='paket'></span><span id='total_pagu_33' class='pagu' style='display:none;'></span></td>";
                                   
                                   echo "<td><span id='total_paket_34' class='paket'></span><span id='total_pagu_34' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_35' class='paket'></span><span id='total_pagu_35' class='pagu' style='display:none;'></span></td>";
                                   echo "<td><span id='total_paket_36' class='paket'></span><span id='total_pagu_36' class='pagu' style='display:none;'></span></td>";
                                   echo "</tr>"
                                   ?>
                                </tbody>
                                    
                            </table> 
<div style="font-size:12px;">
<br/>
				<b>1</b> : Jumlah Paket/Pagu RUP yang diumumkan di SIRUP <br/>
<b>2</b> : Jumlah Paket/Pagu yang Diumumkan di LPSE <br/>
<b>3</b> : Jumlah Paket/Pagu yang sudah ditetapkan Pemenangnya
</div>
                      </div>     
 
                    </div>
            </div>
           
             
            
    </div> 
</div>      
      <div class="box box-gray">  
                    <div class="box-title" id="title1" style="height:45px;background:#ff6e6d;color:#ffffff">
                        <div style="display:inline;float:left;">&nbsp;PAKET PRIORITAS</div>
                        <div style="float:right;">
                            <div style="margin-bottom: 0px;">
                                <form method="POST" action="index.php?r=beranda/m1">
                                    &nbsp;&nbsp;&nbsp;<?php echo CHtml::dropDownList('tahun', $tahun, $listTahun, array('style' => 'width:110px;font-size:12px;','class'=>'ddl')); ?>
                                    <input type="submit" value="Filter" class="m1filter" style="margin-bottom:10px;"/>
                                </form>
                                
                            </div>
                            &nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                
                    <div class="box-content" id="tableprioritas"> 
                            <input class="search" placeholder="Search" />
                            <table class="table tablecenter" style="width:100%;margin:0px auto;">
                                <thead class="TableHeader">
                                <tr>
                                    <th class="sort" data-sort="paket" rowspan="2" style="width:100%;margin:0px auto;">Nama Paket</th>
                                    <th class="sort" data-sort="satker" rowspan="2">Satker</th>
                                    <th style="background:none;color:black;" colspan="3">Perencanaan</th>
                                    <th style="background:none;color:black;" colspan="4">Realisasi</th>
                                </tr> 
                                <tr>
                                    <th class="sort" data-sort="pg">Pagu (Juta)</th>
                                    <th class="sort" data-sort="tgl_mulai">Tanggal Mulai Pengadaan</th>
                                    <th class="sort" data-sort="tgl_selesai">Tanggal Selesai Pengadaan</th>
                                    
                                    <th class="sort" data-sort="hps">HPS</th>
                                    <th class="sort" data-sort="nl_kontrak">Nilai Kontrak </th>
                                    <th class="sort" data-sort="tgl_mulaip">Tanggal Mulai Pengadaan</th>
                                    <th class="sort" data-sort="tgl_selesaip">Tanggal Selesai Pengadaan</th>
                                </tr>  
                                </thead>
                               <tbody class="list" id="tbl_pr">  
                                </tbody>
                            </table>
                            <ul class="pagination"> </ul> 
                      </div>     
 
                </div>
       

<div id="apbnDiv" style="width:1124px;text-align:center;overflow:hidden;display:none;" >
    
</div>

<div id="laporanDiv" style="width:1124px;text-align:center;overflow:hidden;display:none;" >
    
</div>

<div id="kinerjaPengadaanDiv" style="width:1124px;text-align:center;overflow:hidden;display:none;"  >
    
</div>


<script>
    
$(document).ready(function() {
        
        paketpr()
   
        
    });

function paketpr(){
        $.getJSON('<?= Yii::app()->baseUrl ?>/index.php?r=beranda/AdaPaketPrioritas&tahun=2014', {
           
        }, function(data){
            
            var content; 
            var isiTabel = $('#tbl_pr').empty();
            
            for(var i=0; i<data.length; i++)
            { 
                content += '<tr>\n'
                content += '<td class="container paket"><a href=http://localhost/monevng/index.php?r=beranda/detailPrioritas&id=360177>' + data[i][1] + "</td>"
                content += '<td class="container satker" >'+data[i][2]+'</td>\n';
                content += '<td class="container pg" >'+data[i][3]+'</td>\n';
                content += '<td class="container tgl_mulai" >'+data[i][4]+'</td>\n';
                content += '<td class="container tgl_selesai">'+data[i][5]+'</td>\n';
                content += '<td class="container hps" >'+data[i][6]+'</td>\n';
                content += '<td class="container nl_kontrak" >'+data[i][7]+'</td>\n';
                content += '<td class="container tgl_mulaip" >'+data[i][8]+'</td>\n';
                content += '<td class="container tgl_selesaip" >'+data[i][9]+'</td>\n';
                content += "</tr>\n";
            }
            isiTabel.append(content); 
            
             if (data.length == 0) {
                var kosong = '<td colspan="3" size="20">Data Tidak Tersedia </td>'
                isiTabel.append(kosong) 
            }
            
            else{
            //create pagnation using list.JS
             var pagong = new List('tableprioritas', {
                  valueNames: ['paket','satker','pg','tgl_mulai','tgl_selesai','hps','nl_kontrak','tgl_mulaip','tgl_selesaip'],
                  page: 3,
                  plugins: [ ListPagination({}) ] 
               });
            }
        })
    }

</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/listjs/list.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/listjs/list.pagination.min.js"></script>       