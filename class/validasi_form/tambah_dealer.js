$().ready(function(){
	$('#form').validate({
		rules:{
			nama:{
				required:true,
				maxlength:50, //Sesuai dengan data base
			},
			daerah:{
				required:true,
				maxlength:50,
			},
			type:{
				required:true,
				maxlength:10,
			}
		},
		messages:{
			nama:{
				required:"Nama Dealer tidak boleh kosong",
				maxlength:"Nama Dealer maksimal 50 karakter"
			},
			daerah:{
				required:"Tujuan tidak boleh kosong",
				maxlength:"Tujuan maksimal 50 karakter"
			},
			type:{
				required:"Plant tidak boleh kosong",
				maxlength:"Plant maksimal 10 karakter"
			}
		}
	});
});