$().ready(function(){
	$('#form').validate({
		rules:{
			password:{
				maxlength:100,
			},
			nama:{
				required:true,
				maxlength:255,
			}
		},
		messages:{
			password:{
				maxlength:"password maksimal 100 karakter"
			},
			nama:{
				required:"nama tidak boleh kosong",
				maxlength:"nama maksimal 100 karakter"
			}
		}
	});
});