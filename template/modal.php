<?php 
ob_start();
session_start();
?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.tanggal').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd' //2020-01-20
        //format:'DD, dd-MM-yy' //Monday, 20 January 2020
        //format: 'dd-mm-yyyy' //20-01-2020
        //format:'DD, dd-mm-yyyy'
      });
    });
  </script>
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(150, 0).slideUp(150, function() {
        $($this).remove();
      });
    }, 1500)
  </script>

  <!-- Select2 -->
  <script>
    $(function() {
      $('.select2').select2()
    });
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>