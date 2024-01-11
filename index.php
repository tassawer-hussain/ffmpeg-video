<?php

require 'vendor/autoload.php';

$ffmpeg = FFMpeg\FFMpeg::create(
	array(
		// 'ffmpeg.binaries'  => '/opt/local/ffmpeg/bin/ffmpeg',. // use this path for linux environment
		// 'ffprobe.binaries' => '/opt/local/ffmpeg/bin/ffprobe',. // use this path for linux environment
		// 'ffmpeg.binaries'  => 'C:\ffmpeg\bin\ffmpeg.exe', // use this path for window environment
		// 'ffprobe.binaries' => 'C:\ffmpeg\bin\ffprobe.exe', // use this path for window environment
		'ffmpeg.binaries'  => './ffmpeg/bin/ffmpeg.exe', // or place the library files inside this directory. First unzip the files in the directory.
		'ffprobe.binaries' => './ffmpeg/bin/ffprobe.exe', // or place the library files inside this directory. First unzip the files in the directory.
		'timeout'          => 3600, // The timeout for the underlying process.
		'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use.
	)
);
$video  = $ffmpeg->open( 'video.mp4' );
$video
	->filters()
	->resize( new FFMpeg\Coordinate\Dimension( 320, 240 ) )
	->synchronize();
$video
	->frame( FFMpeg\Coordinate\TimeCode::fromSeconds( 10 ) )
	->save( 'frame.jpg' );
$video
	->save( new FFMpeg\Format\Video\X264(), 'export-x264.mp4' )
	->save( new FFMpeg\Format\Video\WMV(), 'export-wmv.wmv' )
	->save( new FFMpeg\Format\Video\WebM(), 'export-webm.webm' );
