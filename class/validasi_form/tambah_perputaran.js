$( document ).ready(function() {
	$('#size').select2({
	  	placeholder: 'Pilih Size',
	  	language: "size"
	});

	$('#kegiatan').select2({
	  	placeholder: 'Pilih Jenis Kegiatan',
	  	language: "kegiatan"
	});

	$('#pelayaran').select2({
	  	placeholder: 'Pilih Jenis Pelayaran',
	  	language: "kegiatan"
	});

	$('#no_ken').select2({
	  	placeholder: 'Pilih Nomor Kendaraan',
	  	language: ""
	});

	$('#supir').select2({
	  	placeholder: 'Pilih Nama Supir',
	  	language: ""
	});

	$('#tujuan').select2({
	  	placeholder: 'Pilih Tujuan',
	  	language: ""
	});

	$('#form').validate({
		rules:{
			no_con:{
				required:true,
				maxlength:50, //Sesuai dengan data base
				//placeholder: 'Pilih No Polisi',
			},
			/*no_ken:{
				required:true,
				maxlength:50,
				//placeholder: 'Pilih Jenis Kendaraan'
			},
			supir:{
				required:true,
				maxlength:50, //Sesuai dengan data base
				//number:true,
			},*/
			pelayaran:{
				required:true,
				maxlength:50, //Sesuai dengan data base
				//number:true,
			},
			tujuan:{
				required:true,
				maxlength:50, //Sesuai dengan data base
				//number:true,
			},
			size:{
				required:true,
				maxlength:50, //Sesuai dengan data base
				//number:true,
			},
			kegiatan:{
				required:true,
				maxlength:50, //Sesuai dengan data base
				//number:true,
			},
			ket:{
				required:true,
				maxlength:255, //Sesuai dengan data base
				//number:true,
			},
			
		},
		messages:{
			no_con:{
				required:"Nomor Container tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
			},
			/*no_ken:{
				required:"Nomor Kendaraan tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
			},
			supir:{
				required:"Nama Supir tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
				//number:"Kilometer harus berupa angka"
			},*/
			pelayaran:{
				required:"Nama pelayaran tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
			},
			tujuan:{
				required:"Tujuan tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
			},
			size:{
				required:"Size tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
				//number:"Kilometer harus berupa angka"
			},
			kegiatan:{
				required:"Kegiatan tidak boleh kosong",
				maxlength:"Maksimal 50 Karakter"
				//number:"Kilometer harus berupa angka"
			},
			ket:{
				required:"Keterangan tidak boleh kosong",
				maxlength:"Maksimal 255 Karakter"
				//number:"Kilometer harus berupa angka"
			},
		}
	});
});

