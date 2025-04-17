$( document ).ready(function() {
	$('#form').validate({
		rules:{
			jumlah_unit:{
				required:true,
				maxlength:3, //Sesuai dengan data base
				number:true
			},
			jumlah:{
				required:true,
				maxlength:3, //Sesuai dengan data base
				number:true
			},
		},
		messages:{
			jumlah_unit:{
				required:"Jumlah Motor tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Jumlah Unit motor harus berupa angka"
			},
			jumlah:{
				required:"Jumlah Motor tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Jumlah Unit motor harus berupa angka"
			},
		}
	});
});

