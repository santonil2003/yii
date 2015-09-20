<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
    function initialize() {
        var mapProp = {
            center: new google.maps.LatLng(-33.871464, 151.204796),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div class="site-about">
    <div id="googleMap" style="height:380px;"></div>
</div>
