<script>
    videojs( "<?php echo $player['id']; ?>", {
        techOrder: [ 'youtube' ],
        sources: [ {"type": "video/youtube", "src": "<?php echo $player['src']; ?>"} ],
        responsive: true,
        preload: "auto",
        controls: <?php echo $player['controls'] == 'yes' ? 'true' : 'false' ?>
    } );

    videojs( "<?php echo $player['id']; ?>" ).ready( function () {
        var myPlayer = this;
        myPlayer.currentTime( <?php echo $this->elapsed_seconds; ?> );
        <?php echo $player['autoplay'] == 'true' ? 'myPlayer.play();' : ''; ?>
    } );
</script>