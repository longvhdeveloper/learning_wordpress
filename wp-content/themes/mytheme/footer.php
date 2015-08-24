</div>
</div>
<div class="col-md-2 visible-md visible-lg">
    <!-- WIDGET -->

    <?php
    get_sidebar();
    ?>

    <!-- END WIDGET -->
</div>
</div>
</div>

<?php
$footer_color = get_theme_mod('qhtheme_footer_color') ? get_theme_mod('qhtheme_footer_color') : '#333';
?>
<div class="jumbotron qh-footer" style="background-color:<?php echo $footer_color; ?> ;">
    <div class="container">
        <div class="row">
            <!-- FOOTER -->
            <?php
            get_sidebar('footer');
            ?>
        </div>
        <!-- END FOOTER -->
    </div>
</div>
<?php echo wp_footer(); ?>
</body>
</html>