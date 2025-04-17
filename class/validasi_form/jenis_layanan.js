$().ready(function() {
    $('#form').validate({
        rules: {
            nama: {
                required: true,
                maxlength: 50,
            }
        },
        messages: {
            nama: {
                required: "Jenis layanan tidak boleh kosong",
                maxlength: "Jenis layanan maksimal 50 karakter"
            }
        }
    });
});