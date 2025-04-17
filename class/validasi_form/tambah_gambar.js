$().ready(function(){
	$('#form').validate({
		rules:{
			gambar:{
				required:true,
				maxlength:50
			}
		},
		messages:{
			gambar:{
				required:"Gambar tidak boleh kosong",
				maxlength:"Gambar maksimal 50 karakter",
			}
		}
	});
});