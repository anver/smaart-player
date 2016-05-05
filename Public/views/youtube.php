<?php
$ratio = $height && $width ? $height / $width * 100 : 56.25; //Set the aspect ratio (default 16:9)
$maxwidth = $width ? "max-width:{$width}px" : ""; //Set the max-width
?>
<!-- Begin webby video responsive wrapper -->
<div class="webby-video-wrapper" style="<?php echo $maxwidth; ?>">
    <div class="webby-video-content" style="padding-bottom:<?php echo $ratio; ?>%;">
        <video 
            id="<?php echo $this->player_id; ?>" 
            class="video-js vjs-default-skin" 
            width="<?php echo $width; ?>" 
            height="<?php echo $height; ?>"
            poster="<?php echo $poster; ?>">
        </video>
    </div>
</div>
<!-- End webby video responsive wrapper -->