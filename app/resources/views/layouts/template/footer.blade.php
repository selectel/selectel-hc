<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
       <b>Ver:</b> {{ file_get_contents(base_path() . '/VERSION') }}
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020-{{date("Y")}} <a href="https://github.com/vasyakrg">RealManual</a>.</strong> All rights reserved.
</footer>
