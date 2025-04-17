$( document ).ready(function() {
	$('#tujuan_req').select2({
	  	placeholder: 'Pilih Tujuan',
	  	language: "id_plant"
	});
	$('#type_req').select2({
	  	placeholder: 'Pilih Type',
	  	language: "id"
	});

	$('#plant_req').select2({
	  	placeholder: 'Pilih Plant',
	  	language: "id_plant"
	});

    $('#kendaraan').select2({
	  	placeholder: 'Pilih No Polisi',
	  	language: "id_kendaraan"
	});

	$('#jenis_req').select2({
	  	placeholder: 'Pilih Jenis Kendaraan',
	  	language: "id"
	});                   

    $("#plant_req").change(function(){
	      $("img#load1").show();
	      var id = $(this).val(); 
	      $.ajax({
	         type: "POST",
	         dataType: "html",
	         url: "data-request_kendaraan.php?jenis=tujuan_req",
	         data: "id="+id,
	         success: function(msg){
	            $("select#tujuan_req").html(msg);                                                       
	            $("img#load1").hide();                                                        
	         }
	      });                    
     });


    $("#plant_req").change(function(){
	      $("img#load1").show();
	      var id = $(this).val(); 
	      $.ajax({
	         type: "POST",
	         dataType: "html",
	         url: "data-request_kendaraan.php?jenis=jumlah_req",
	         data: "id="+id,
	         success: function(msg){
	            $("select#jumlah_req").html(msg);                                                       
	            $("img#load1").hide();                                                        
	         }
	      });                    
     });
});

