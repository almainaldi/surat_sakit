$().ready(function(){
	$('#form').validate({
		rules:{
			tujuan:{
				required:true,
				maxlength:50, //Sesuai dengan data base
			},
			plant:{
				required:true,
				maxlength:50,
			},
			type:{
				required:true,
				maxlength:10,
				
			},
			kendaraan:{
				required:true,
				maxlength:8,	
			},
			supir:{
				required:true,
				maxlength:50,
			}
		},
		messages:{
			tujuan:{
				required:"Nama Tujuan tidak boleh kosong",
				maxlength:"Nama Tujuan maksimal 10 karakter",
			},
			plant:{
				required:"Plant tidak boleh kosong",
				maxlength:"Plant maksimal 50 karakter"
			},
			type:{
				required:"Type tidak boleh kosong",
				maxlength:"Type maksimal 4 karakter",
				
			},
			kendaraan:{
				required:"No Kendaraan tidak boleh kosong",
				maxlength:"No Kendaraan maksimal 4 karakter",
				
			},
			supir:{
				required:"Nama Supir tidak boleh kosong",
				maxlength:"Jenis Kendaraan maksimal 4 karakter",
				
			},
		}
	});
});

