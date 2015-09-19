<style>
    #overlay{
        opacity: 0.4;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 5000;
        background: #000 url('<?= Yii::getAlias('@web'); ?>/images/ajax-loader.png') no-repeat center center fixed;
    }
</style>

<div id="overlay" style="display: none;">
</div>

<script type="text/javascript">
    var overlay = true;

    $('document').ready(function () {
        var docHeight = $(document).height();
        $("#overlay").height(docHeight);


        $(document).ajaxStart(function () {
            if (overlay) {
                $("#overlay").show();
            }
        });

        $(document).ajaxStop(function () {
            $("#overlay").hide();
        });
    });
</script>