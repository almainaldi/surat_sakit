$().ready(function() {
    $('#form').validate({
        rules: {
            nama_kar: {
                required: true,
                maxlength: 50,
            }
        },
        messages: {
            nama_kar: {
                required: "Nama tidak boleh kosong",
                maxlength: "Nama maksimal 50 karakter"
            }
        }
    });
});