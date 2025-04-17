$( document ).ready(function() {
	$('#tujuan').select2({
  	placeholder: 'Pilih Tujuan',
  	language: "id_plant",
	});
	$('#type').select2({
	  	placeholder: 'Pilih Type',
	  	language: "id",
	});

	$('#plant').select2({
	  	placeholder: 'Pilih Plant',
	  	language: "id_plant",
	});
	
    $('#kendaraan').select2({
	  	placeholder: 'Pilih No Polisi',
	  	language: "id_kendaraan",
	});

	$('#jenis').select2({
	  	placeholder: 'Pilih Jenis Kendaraan',
	  	language: "id",
	});

	$('#supir').select2({
	  	placeholder: 'Pilih Supir',
	  	language: "id",
	}); 

    $("#jenis").change(function(){
	      $("img#load1").show();
	      var id = $(this).val(); 
	      $.ajax({
	         type: "POST",
	         dataType: "html",
	         url: "data-kendaraan2.php?jenis=kendaraan",
	         data: "id="+id,
	         success: function(msg){
	            $("select#kendaraan").html(msg);                                                       
	            $("img#load1").hide();                                                        
	         }
	      });                    
     });

    $("#plant").change(function(){
	      $("img#load1").show();
	      var id = $(this).val(); 
	      $.ajax({
	         type: "POST",
	         dataType: "html",
	         url: "data-tujuan.php?jenis=tujuan",
	         data: "id="+id,
	         success: function(msg){
	            $("select#tujuan").html(msg);                                                       
	            $("img#load1").hide();
	            //getAjaxKota();                                                        
	         }
	      });                    
     });
});

