<?php

$defaultPath = str_replace(DIRECTORY_SEPARATOR, '/', getcwd());
$ffmpegPath = '/ffmpeg/bin/';

$videoPath = './public/files/';
$thumbnailPath = './public/thumbnails/';

$videoName = 'video';
$extension = 'mp4';
$message = "Para voce meu presente digital, um passeio de balão para se sentir entre as nuvens";

$command = $defaultPath . $ffmpegPath . 'ffmpeg -i ' . $videoPath . $videoName . "_overlay." . $extension . ' -filter_complex "subtitles=subtitle.srt:force_style=\'Alignment=10,Outline=0\'" -c:a copy ' . $videoPath . $videoName . '_final.mp4';
system($command);
echo '<br/>';
echo $command;

echo '<br/>';
echo "Video criado";


// verifica se existe o arquivo temporario e exclui ele
if (!file_exists($defaultPath . $videoPath . '/video_overlay.mp4')) 
{                   
  if (mkdir($defaultPath,0777,false)) {
    echo "nao tem permissão na pasta";
  }
} else {
  unlink($defaultPath . $videoPath . '/video_overlay.mp4');
}

// Link da documentacao oficial
//http://ffmpeg.org/ffmpeg-filters.html#drawtext-1

// Outras referencias pesquisadas
// https://stackoverflow.com/questions/24961127/how-to-create-a-video-from-images-with-ffmpeg
// https://ottverse.com/ffmpeg-drawtext-filter-dynamic-overlays-timecode-scrolling-text-credits/
