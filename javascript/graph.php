

<div style="text-align: center">
        <span style="font-size:12px;">Tahun Anggaran &nbsp;&nbsp;</span>
        <?= MoHtml::dropDownList('tahunAnggaranUkp4', $currentTahun, $tahunOptions, array('style' => 'width:110px;font-size:12px;')) ?>

        <span style="font-size:12px;">Pelaksanaan &nbsp;&nbsp;</span>
        <?= MoHtml::dropDownList('listProgres', 'keuangan', $listProgres, array('style' => 'width:110px;font-size:12px;')) ?>

        <span style="font-size:12px;">Pelaksana &nbsp;&nbsp;</span>
        <?= MoHtml::dropDownList('listKLDI', null,$listKLDI,array('style' => 'width:110px;font-size:12px;')) ?>

        <span id="bungkusProv" style="font-size:12px;display: none;">Provinsi &nbsp;&nbsp;
                                                                <?php 
                echo
                     CHtml::dropDownList('listProv', $select = array()
                    ,CHtml::listData($listProv, 'id', 'nama')
                    ,array('prompt'=>'select ','style' => 'width:110px;font-size:12px;','prompt' => 'Semua')); 
            ?></span>
        <span style="font-size:12px;">Kinerja &nbsp;&nbsp;</span>
        <?= MoHtml::dropDownList('listIndikator', null, $listIndikator,array('style' => 'width:110px;font-size:12px;')) ?>
        </span>
    </div>




    <div class="row">
    <div class="span12" style="border-bottom:2px solid; margin-top:50px; margin-bottom: -20px;"></div>
    <div class="span12"><br/><br/>
    <h3  style="text-align: center;">Kinerja Realisasi <span id="fisikOrKeu"></span> <span id="pilihanKldi"></span> <span id="pilihanTahun"></span> <span id="pilihanIndikator"></span> (%)</h3>
    
                                               
    <div class="span8"></div><br/>
    <div id="grafikProgres" style="height: 900px; max-width: 900px; margin-left: 20px;"></div>
    </div>

    </div>
    <div class="row" >
    <div class="span12">
    <br/><br/>    
    
    <div class="row" style="text-align: center">
        <div style="margin-left: 50px;">
<div id='submitId' class='btn btn-primary' style='opacity:1;' onclick="javascript:prev()">Prev</div>
<div id='submitId' class='btn btn-primary' style='opacity:2;' onclick="javascript:next();">Next</div>
    </div>
<div style="float: right; margin-right: 20px; margin-bottom: 20px; margin-top: -30px;">
<span style="font-size:12px;">Jumlah Baris Ditampilkan : &nbsp;&nbsp;</span>
    <?= MoHtml::dropDownList('jumlahBaris', 10, $jumlahBaris, array('style' => 'width:110px;font-size:12px;')) ?>
     </div>
    <div class="span12" style="border-bottom:2px solid; margin-bottom: 20px;"></div>
</div>
    
<script>

    var from =0;
    var to = 10;
    var jumlahBarisTerpilih = 10; 
    var jumlahBarisTampil = 10;
    var tinggi =800;
    
    var tahunAnggaranUkp4    = $('#tahunAnggaranUkp4')
    var listProgres    = $('#listProgres')
    var listKLDI    = $('#listKLDI')
    var listIndikator    = $('#listIndikator')
    var jumlahBaris = $('#jumlahBaris')
    var divGrafik = $('#grafikProgres')
    var listProv = $('#listProv')
     
    $(document).ready(function(){
             
        getProgres(from, to)
        var changeUkp4 = function(){
            
           
            //progress  memangil grafik 
             
            getProgres(from, to)
        }
        
        tahunAnggaranUkp4.change(changeUkp4)
        listProgres.change(changeUkp4)
        listKLDI.change(pilihProv)
        listProv.change(changeUkp4)
        listIndikator.change(changeUkp4)
        jumlahBaris.change(gantiJumlahBaris)
         
    });
    
    function pilihProv(){
        if(listKLDI.val() == 'kl' || listKLDI.val() == 'p')
            {
                getProgres(from, to)
                $('#bungkusProv').hide();
            }
        else if(listKLDI.val() == 'k')
            {
                $('#bungkusProv').show();
                getProgres(from, to);
            }
    }
    
    function gantiJumlahBaris(){
        jumlahBarisTerpilih = jumlahBaris.val();
        from =0;
        to = jumlahBarisTerpilih;
        getProgres(from, to);
    }
    function getProgres(from,to){ 
        rubahJudul();
        $.getJSON('<?= Yii::app()->baseUrl ?>/tepra/GetRekapProgres', { 
            progres:listProgres.val(),
            tahun:tahunAnggaranUkp4.val(),
            kelompok:listKLDI.val(),
            indikator:listIndikator.val(),
            provinsi:listProv.val()
        }, function(data){ 
            var content; 
            var isiTabel = $('#progresKeuangan').empty();
            var sum = new Array(0,0,0,0,0);
            var tambah = new Array(data.length);
            var n = 0;
            
        //mengitung rata-rata
        for(var i=0;i<data.length; i++){
              tambah[i] = parseFloat(data[i][2]);
             if (!data[i][2] || data[i][2] == -999999)
                 tambah[i]  = 0;
                 n = n+tambah[i];
       }
       
         var rata = n/data.length;
         
           if(data.length < 1)
            {
                $('#grafikProgres').empty();
                $('#grafikProgres').html("data tidak tersedia");
            }
         
            data = data.slice(from,to);
            jumlahBarisTampil = data.length;
            grafikProgres(data,rata);
            
        })
                
    }

    function numberWithCommas(n) {
        var parts=n.toString().split(".");
        return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".") + (parts[1] ? "," + parts[1] : "");
    }
    
    function grafikProgres(data,rata){ 
       
        divGrafik.height(parseInt(jumlahBarisTampil)*35);
        
        var keuTarget = new Array(data.length); 
        var keuRealisasi = new Array(data.length);
              
        for(var i=0; i<data.length; i++){

            keuTarget[i] = (data[i][1]);
        }
                  
        for(var i=0; i<data.length; i++){
          
            keuRealisasi[i] = parseFloat(data[i][2]); 
        }
         
        $.jqplot.config.enablePlugins = true;
        //value dari KLDI
        var s1 = keuRealisasi;
        //nama KLDI
        var ticks = keuTarget;
        $('#grafikProgres').empty();
        
        plot1 = $.jqplot('grafikProgres', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {
                    barDirection: 'horizontal'
                },
                pointLabels: { show: true }
            },
            axes: {
                
                xaxis:{
                    renderer: $.jqplot.DateAxisRenderer,
                    max:100, 
                    tickOptions:{formatString:'%.1f %'}
                    },
                yaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks:ticks
                    }
            },
            highlighter: { show: true },
            
            canvasOverlay: {
	         show: true,
	         objects: [
	             {verticalLine: {
	                 name: 'Rata-Rata',
	                 x: rata,
	                 lineWidth: 2,
	                 color: 'red',
	                 shadow: false
	             }}
	        ]
	     }
            
        });
    }
    
    function next(){ 
        from = parseInt(from) + parseInt(jumlahBarisTerpilih);
        to = parseInt(to) + parseInt(jumlahBarisTerpilih);
        
        getProgres(from, to)
    }
    function prev(){
        
        if(from < parseInt(jumlahBarisTerpilih))
            return 0;
        else if (to < from + parseInt(jumlahBarisTerpilih))
            return 0;
        else
            {
                from = parseInt(from) - parseInt(jumlahBarisTerpilih);
                to = parseInt(to) - parseInt(jumlahBarisTerpilih);
                getProgres(from, to)
            }
        
    }
    
    function rubahJudul(){
        
        var textFisikOrKeu = "";
        var textPilihanKldi = "";
        var textPilihanTahun = "";
        var textPilihanIndikator = "";
    
        if ($('#listKLDI').find(":selected").val() == "semua")
            textPilihanKldi = " Semua K/L/D ";
        else if ($('#listKLDI').find(":selected").val() == "kl")
            textPilihanKldi = " Kementerian/Lembaga ";
        else if ($('#listKLDI').find(":selected").val() == "p")
            textPilihanKldi = " Provinsi ";
        else if ($('#listKLDI').find(":selected").val() == "k")
            textPilihanKldi = " Kabupaten/Kota di Provinsi " + $('#listProv').find(":selected").text();
        else
            textPilihanKldi = "";
        
        if ($('#listProgres').find(":selected").val() == "keuangan")
            textFisikOrKeu = "Keuangan";
        else if ($('#listProgres').find(":selected").val() == "fisik")
            textFisikOrKeu = "Fisik";
        else
            textFisikOrKeu = "";
        
        if ($('#listIndikator').find(":selected").val() == "semua")
            textPilihanIndikator = "";
        else if ($('#listIndikator').find(":selected").val() == "baik")
            textPilihanIndikator = "dengan Kinerja Tergolong Baik";
        else if ($('#listIndikator').find(":selected").val() == "sedang")
            textPilihanIndikator = "dengan Kinerja Tergolong Sedanga";
        else if ($('#listIndikator').find(":selected").val() == "buruk")
            textPilihanIndikator = "dengan Kinerja Tergolong Buruk";
        else
            textPilihanIndikator = "";
        
        textPilihanTahun = "pada Tahun " + tahunAnggaranUkp4.find(":selected").val();
    
        $("#fisikOrKeu").html(textFisikOrKeu);
         $("#pilihanKldi").html(textPilihanKldi);
         $("#pilihanTahun").html(textPilihanTahun);
         $("#pilihanIndikator").html(textPilihanIndikator);
         
    }
    
    function asliperubahankldi(flag){
        if(flag == 1)
            {
                $('#tombol').empty()
                window.open('<?= Yii::app()->baseUrl ?>/tepraperubahan/graph?instansi=<?php echo $instansi ?>&tahun=<?php echo $tahun ?>', "_self") 
            }
    }
  
    
</script>

<link rel="stylesheet" media="all" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/jquery.jqplot.css">
<!--Switcher css-->
<link rel="stylesheet" media="all" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/cssswitcher.css">
	
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/akunting.js"> </script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/excanvas.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/jquery.jqplot.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.barRenderer.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.canvasTextRenderer.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.canvasAxisTickRenderer.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.canvasOverlay.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.highlighter.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.cursor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/dist/plugins/jqplot.pointLabels.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/public/js/wz_jsgraphics.js"></script>
