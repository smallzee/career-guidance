</div>
<footer class="main-footer">
    <!-- <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div> -->
    <span>Copyright &copy; 2020 - <?= date('Y'); ?>  <a href="<?= base_url()  ?>" target="_blank"><?= WEB_TITLE ?></a>.</span> All rights
    reserved.
</footer>
</div>

<!-- /.control-sidebar -->
<!-- jQuery 3 -->
<script src="<?= HTML_TEMPLATE ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= HTML_TEMPLATE ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= HTML_TEMPLATE ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- PACE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= HTML_TEMPLATE ?>bower_components/PACE/pace.min.js"></script>
<script src="<?= HTML_TEMPLATE  ?>dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Morris.js charts -->
<script src="<?= HTML_TEMPLATE ?>bower_components/raphael/raphael.min.js"></script>
<script src="<?= HTML_TEMPLATE ?>bower_components/morris.js/morris.min.js"></script>
<!-- DataTables -->
<script src="<?= HTML_TEMPLATE ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= HTML_TEMPLATE ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= HTML_TEMPLATE ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- Slimscroll -->
<script src="<?= HTML_TEMPLATE ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= HTML_TEMPLATE ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= HTML_TEMPLATE ?>dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="<?= HTML_TEMPLATE ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= HTML_TEMPLATE ?>dist/js/demo.js"></script>
<!-- fullCalendar -->
<script src="<?= HTML_TEMPLATE ?>bower_components/moment/moment.js"></script>
<script src="<?= HTML_TEMPLATE ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Page specific script -->

<script type="text/javascript">
    $(function (e) {
       $("#example1").dataTable();

       $("#occupation").change(function () {
           if ($(this).val() == 'fpe staff'){
               $(".school-fee-deduction").removeClass('hide');
               return;
           }

           $(".school-fee-deduction").addClass('hide');
       })


    });

    function  update_class(id,name,amount) {
        $(".show-modal").click();
        $("#name").val(name);
        $("#amount").val(amount);
        $("#id").val(id);
    }

    function delete_class(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url :  '<?= base_url('class.php') ?>',
                    type : 'post',
                    dataType : 'json',
                    data : {
                        'delete' : '',
                        'class_id' : id
                    },
                    success : function (response) {
                        if (response.error == 1){
                            swal("Deleted",response.msg,"success");
                            setTimeout(function () {
                                window.location.href ='<?= base_url('class.php') ?>';
                            }, 2000);
                        }
                    },
                    error : function (err) {
                        // console.log(err.responseText);
                        toast_alert("No internet connection, try again","error");
                    }
                });
                return;
            }
            swal("Cancelled","cant be deleted","error");

        });
    }

</script>
</body>
</html>