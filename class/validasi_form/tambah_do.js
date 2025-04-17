$().ready(function(){
	$('#form').validate({
		rules:{
			id_plant:{
				required:true,
				maxlength:10, //Sesuai dengan data base
			},
			tujuan:{
				required:true,
				maxlength:50,
			},
			jumlah_1:{
				required:true,
				maxlength:4,
				number:true,
			},
			jumlah_2:{
				required:true,
				maxlength:10,
				number:true,
			},
			jumlah_3:{
				required:true,
				maxlength:4,
				number:true,
			},
			jumlah_4:{
				required:true,
				maxlength:4,
				number:true,
			},
			jumlah_5:{
				required:true,
				maxlength:4,
				number:true,
			},
			jumlah_6:{
				required:true,
				maxlength:4,
				number:true,
			}
		},
		messages:{
			id_plant:{
				required:"Plant tidak boleh kosong",
				maxlength:"Plant maksimal 10 karakter",

			},
			tujuan:{
				required:"Tujuan tidak boleh kosong",
				maxlength:"Tujuan maksimal 50 karakter"
			},
			jumlah_1:{
				required:"Jumlah tidak boleh kosong",
				maxlength:"Jumlah maksimal 4 karakter",
				number:"Jumlah harus berupa angka"
			},
			jumlah_2:{
				required:"Jumlah tidak boleh kosong",
				maxlength:"Jumlah maksimal 4 karakter",
				number:"Jumlah harus berupa angka"
			},
			jumlah_3:{
				required:"Jumlah tidak boleh kosong",
				maxlength:"Jumlah maksimal 4 karakter",
				number:"Jumlah harus berupa angka"
			},
			jumlah_4:{
				required:"Jumlah tidak boleh kosong",
				maxlength:"Jumlah maksimal 4 karakter",
				number:"Jumlah harus berupa angka"
			},
			jumlah_5:{
				required:"Jumlah tidak boleh kosong",
				maxlength:"Jumlah maksimal 4 karakter",
				number:"Jumlah harus berupa angka"
			},
			jumlah_6:{
				required:"Jumlah tidak boleh kosong",
				maxlength:"Jumlah maksimal 4 karakter",
				number:"Jumlah harus berupa angka"
			}
		}
	});
});