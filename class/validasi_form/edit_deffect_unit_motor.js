$( document ).ready(function() {
	$('#form').validate({
		rules:{
			type_defect:{
				required:true,
				maxlength:50 
			},
			warna_defect:{
				required:true,
				maxlength:50 
			},
			no_engine:{
				required:true,
				maxlength:50 
			},
			sayap_l:{
				required:true,
				maxlength:3, 
				number:true
			},
			sayap_r:{
				required:true,
				maxlength:3, 
				number:true
			},
			spakbor_depan:{
				required:true,
				maxlength:3, 
				number:true
			},
			spakbor_belakang:{
				required:true,
				maxlength:3, 
				number:true
			},
			body_l:{
				required:true,
				maxlength:3, 
				number:true
			},
			body_r:{
				required:true,
				maxlength:3, 
				number:true
			},
			batok:{
				required:true,
				maxlength:3, 
				number:true
			},
			knalpot:{
				required:true,
				maxlength:3, 
				number:true
			},
			stang_l:{
				required:true,
				maxlength:3, 
				number:true
			},
			stang_r:{
				required:true,
				maxlength:3, 
				number:true
			},
			striping_l:{
				required:true,
				maxlength:3, 
				number:true
			},
			striping_r:{
				required:true,
				maxlength:3, 
				number:true
			},
			detail_part:{
				required:true,
				maxlength:255 
			},
			penyebab:{
				required:true,
				maxlength:255 
			},
		},
		messages:{
			type_defect:{
				required:"Type Defect tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
			},
			warna_defect:{
				required:"Warna Defect tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
			},
			no_engine:{
				required:"No Engine tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter",
			},
			sayap_l:{
				required:"Sayap L tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			sayap_r:{
				required:"Sayap R tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			spakbor_depan:{
				required:"Spakbor Depan tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			spakbor_belakang:{
				required:"Spakbor Belakang tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			body_l:{
				required:"Body L tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			body_r:{
				required:"Body R tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			batok:{
				required:"Batok tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			knalpot:{
				required:"Knalpot tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			stang_l:{
				required:"Stang L tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			stang_r:{
				required:"Stang R tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			striping_l:{
				required:"Striping L tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			striping_r:{
				required:"Striping R tidak boleh kosong",
				maxlength:"Maksimal 3 Karakter",
				number:"Inputan harus berupa angka"
			},
			detail_part:{
				required:"Detail Part tidak boleh kosong",
				maxlength:"Maksimal 255 Karakter"
			},
			penyebab:{
				required:"Penyebab tidak boleh kosong",
				maxlength:"Maksimal 255 Karakter"
			},
		}
	});
});

