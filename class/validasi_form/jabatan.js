$().ready(function() {
    $('#form').validate({
        rules: {
            jabatan: {
                required: true,
                maxlength: 50,
            }
        },
        messages: {
            jabatan: {
                required: "Jabatan tidak boleh kosong",
                maxlength: "Jabatan maksimal 50 karakter"
            }
        }
    });
});