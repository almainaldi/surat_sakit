$(document).ready(function() {
    $('#nama').select2({
        placeholder: 'Pilih Karyawan',
        language: "id_dealer"
    });

    $('#jabatan').select2({
        placeholder: 'Pilih Jabatan',
        language: "id"
    });

    $('#tujuan').select2({
        placeholder: 'Pilih Klinik / R.S',
        language: "id"
    });

    $("#nama").change(function() {
        //$("img#load1").show();
        var id = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "data-karyawan.php?jenis=jabatan",
            data: "id=" + id, // nama_kar
            success: function(msg) {
                $("select#jabatan").html(msg);
                //$("img#load1").hide();
            }
        });
    });
});