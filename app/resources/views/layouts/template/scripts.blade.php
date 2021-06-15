<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
{{--<!-- jQuery UI 1.11.4 -->--}}
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

{{--<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->--}}
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
{{--<!-- Bootstrap 4 -->--}}
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{--<!-- ChartJS -->--}}
{{--<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>--}}
{{--<!-- Sparkline -->--}}
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
{{--<!-- JQVMap -->--}}
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
{{--<!-- jQuery Knob Chart -->--}}
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
{{--<!-- daterangepicker -->--}}
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
{{--<!-- Tempusdominus Bootstrap 4 -->--}}
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
{{--<!-- Summernote -->--}}
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
{{--<!-- overlayScrollbars -->--}}
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

{{--<!-- AdminLTE App -->--}}
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

{{--<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>--}}
{{--<script src="sweetalert2.all.min.js"></script>--}}
{{--<!-- AdminLTE dashboard demo (This is only for demo purposes) -->--}}
{{--<script src="{{ asset('dist/js/pages/dashboard.jsv') }}"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="{{ asset('dist/js/demo.js') }}"></script>--}}

{{--<!-- Tables -->--}}
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

{{--<!-- clipboard.js -->--}}
<script src="{{ asset('plugins/clipboard/clipboard.min.js') }}"></script>

<script>
    function sleep(milliseconds) {
        const date = Date.now();
        let currentDate = null;
        do {
            currentDate = Date.now();
        } while (currentDate - date < milliseconds);
    }

    function generatePassword(length) {
        var charset = "0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }

</script>
