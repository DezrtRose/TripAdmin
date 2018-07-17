<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Trip Menu Manager
            <small>Control panel</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php flash() ?>
        <?php $this->load->view($sub_content) ?>

    </section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->