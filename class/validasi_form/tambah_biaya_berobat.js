$().ready(function() {
    $('#form').validate({
        rules: {
            dokter: {
                required: true,
                // maxlength: 50, //Sesuai dengan data base
            },
            jenis: {
                required: true,
                // maxlength: 50,
            },
            kasbon: {
                required: true,
                // maxlength: 10,
                Number: true,
            },
        },
        messages: {
            dokter: {
                required: "Dokter Tujuan tidak boleh kosong",
                // maxlength: "Dokter Tujuan maksimal 10 karakter",
            },
            jenis: {
                required: "Jenis Penyakit tidak boleh kosong",
                // maxlength: "Plant maksimal 50 karakter"
            },
            kasbon: {
                required: "Type tidak boleh kosong",
                maxlength: "Type maksimal 4 karakter",
                Number: "kasbon harus angka"
            },
        }
    });
});