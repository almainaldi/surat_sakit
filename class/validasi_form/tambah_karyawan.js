$().ready(function(){
	$('#jabatan').select2({
	  	placeholder: 'Pilih Divisi',
	  	language: ""
	});
	$('#divisi').select2({
	  	placeholder: 'Pilih Jabatan',
	  	language: ""
	});

	$('#form').validate({
		rules:{
			nama_kar:{
				required:true,
				maxlength:50, //Sesuai dengan data base
			},
			jabatan:{
				required:true,
				maxlength:50,
			},
			divisi:{
				required:true,
				maxlength:50,
			}
		},
		messages:{
			nama_kar:{
				required:"Nama Karyawan tidak boleh kosong",
				maxlength:"Nama Karyawan maksimal 50 karakter"
			},
			jabatan:{
				required:"Divisi tidak boleh kosong",
				maxlength:"Divisi maksimal 50 karakter"
			},
			divisi:{
				required:"Jabatan tidak boleh kosong",
				maxlength:"Jabatan maksimal 50 karakter"
			}
		}
	});
});