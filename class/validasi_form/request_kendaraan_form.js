$().ready(function(){
	$('#form').validate({
		rules:{
			tujuan_req:{
				required:true,
				maxlength:50, //Sesuai dengan data base
			},
			plant_req:{
				required:true,
				maxlength:50,
			},
			type_req:{
				required:true,
				maxlength:10,
				
			},
			jenis_req:{
				required:true,
				maxlength:8,	
			},
			supir_req:{
				required:true,
				maxlength:50,
				
			},
			jumlah_req:{
				required:true,
				maxlength:10,
				number:true,
			}
		},
		messages:{
			tujuan_req:{
				required:"Nama Tujuan tidak boleh kosong",
				maxlength:"Nama Tujuan maksimal 10 karakter",
			},
			plant_req:{
				required:"Plant tidak boleh kosong",
				maxlength:"Plant maksimal 50 karakter"
			},
			type_req:{
				required:"Type tidak boleh kosong",
				maxlength:"Type maksimal 4 karakter",
				
			},
			jenis_req:{
				required:"No Kendaraan tidak boleh kosong",
				maxlength:"No Kendaraan maksimal 4 karakter",
				
			},
			supir_req:{
				required:"Nama Supir tidak boleh kosong",
				maxlength:"Jenis Kendaraan maksimal 4 karakter",
				
			},
			jumlah_req:{
				required:"Jumlah Unit motor tidak boleh kosong",
				maxlength:"Jumlah Unit motor maksimal 10 karakter",
				number:"Jumlah Unit motor harus berupa angka"
			},
		}
	});
});

