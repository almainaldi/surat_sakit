$().ready(function() {
    $('#form').validate({
        rules: {
            username: {
                required: true,
                maxlength: 50,
            },
            password: {
                required: true,
                maxlength: 100,
            },
            nama: {
                required: true,
                maxlength: 50,
            }
        },
        messages: {
            username: {
                required: "username tidak boleh kosong",
                maxlength: "username maksimal 50 karakter"
            },
            password: {
                required: "password tidak boleh kosong",
                maxlength: "password maksimal 100 karakter"
            },
            nama: {
                required: "nama tidak boleh kosong",
                maxlength: "nama maksimal 50 karakter"
            }
        }
    });
});