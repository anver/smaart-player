<script>
    videojs( "<?php echo $player['id']; ?>", {
        techOrder: [ 'html5', 'flash' ],
        sources: [ {"type": "application/x-mpegURL", "src": "<?php echo $player['src']; ?>"} ],
        responsive: true,
        preload: "auto",
        controls: <?php echo $player['controls'] == 'yes' ? 'true' : 'false' ?>,
        autoplay: <?php echo $player['autoplay'] == 'true' ? 'true' : 'false' ?>
    } );

    videojs( "<?php echo $player['id']; ?>" ).ready( function () {
        var myPlayer = this;
        myPlayer.one( 'loadeddata', function () {
            myPlayer.currentTime( <?php echo $this->elapsed_seconds; ?> );
        } );
    } );

</script>