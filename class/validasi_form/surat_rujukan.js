$().ready(function() {
    $('#form').validate({
        rules: {
            nama: {
                required: true,
            },
            keluhan: {
                required: true,
                maxlength: 1000,
            }
        },
        messages: {
            nama: {
                required: "Nama Karyawan Harus Dipilih"
            },
            keluhan: {
                required: "Keluhan tidak boleh kosong",
                maxlength: "Keluhan maksimal 1000 karakter"
            }
        }
    });
});