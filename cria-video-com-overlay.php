<?php

$defaultPath = str_replace(DIRECTORY_SEPARATOR, '/', getcwd());
$ffmpegPath = '/ffmpeg/bin/';

$videoPath = './public/files/';
$thumbnailPath = './public/thumbnails/';

$videoName = 'video';
$extension = 'mp4';
$message = "Para voce meu presente digital, um passeio de balão para se sentir entre as nuvens";

// gera um video de 10 segundos utilizando uma img.jpg
$command = $defaultPath . $ffmpegPath . "ffmpeg -r 1/10 -i " . $thumbnailPath . $videoName . "_thumbnail.png -c:v libx264 -vf fps=25,format=yuv420p " . $videoPath . $videoName . "_start." . $extension;
system($command);
echo '<br/>';
echo $command;

$command2 = $defaultPath . $ffmpegPath . 'ffmpeg -i ' . $videoPath . $videoName . "_start." . $extension . ' -i ' . $thumbnailPath . 'overlay.png -filter_complex "[0:v][1:v] overlay=0:0:enable=\'between(t,0,20)\'" -pix_fmt yuv420p -c:a copy ' . $videoPath . $videoName . "_overlay." . $extension;
system($command2);
echo '<br/>';
echo $command2;

// verifica se existe o arquivo temporario e exclui ele
if (!file_exists($defaultPath . $videoPath . '/video_start.mp4')) 
{                   
  if (mkdir($defaultPath,0777,false)) {
    echo "nao tem permissão na pasta";
  }
} else {
  unlink($defaultPath . $videoPath . '/video_start.mp4');
}

echo '<br/>';
echo "Video com overlay criado com sucesso";