$().ready(function() {
    $('#form').validate({
        rules: {
            klinik: {
                required: true,
                maxlength: 50,
            }
        },
        messages: {
            klinik: {
                required: "Klinik tidak boleh kosong",
                maxlength: "Klinik maksimal 50 karakter"
            }
        }
    });
});