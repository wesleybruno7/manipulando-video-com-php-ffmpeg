<?php

    $defaultPath = str_replace(DIRECTORY_SEPARATOR, '/', getcwd());
    $ffmpegPath = './ffmpeg/bin/';
    $videoPath = './public/files/';
    $thumbnailPath = './public/thumbnails/';
    $videoName = 'video';
    $videoExtension = 'mp4';

    if (isset($_POST["submit"]))
    {
        $video = $_FILES["video"]["name"];
        $tmp_name = $_FILES["video"]["tmp_name"];

        // move o video enviado para a pasta files
        move_uploaded_file($tmp_name, $videoPath . $videoName . ".$videoExtension");

        $video = $videoPath  .$videoName . ".$videoExtension";
        $thumbnail = $thumbnailPath . $videoName . '_thumbnail.png';
         
        // gera a thumbnail do video (pega o primeira frame)
        $command = $defaultPath . $ffmpegPath . 'ffmpeg -i ' . $video . ' -vf thumbnail -frames:v 1 ' . $thumbnail;
        system($command);
      
        echo "Thumbnail has been generated";
    }
?>

<link rel="stylesheet" href="bootstrap-darkly.min.css">
 
<div class="container" style="margin-top: 200px;">
    <div class="offset-md-4 col-md-4">
        <form method="POST" enctype="multipart/form-data" action="upload.php">
            <div class="form-group">
                <label>Select video</label>
                <input type="file" name="video" accept="video/*" class="form-control" required>
            </div>
 
            <input type="submit" class="btn btn-primary" name="submit" value="Generate">
        </form>
    </div>
</div>