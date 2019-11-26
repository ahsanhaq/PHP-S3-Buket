<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;

$s3 = new S3Client([
     'version' => 'latest',
     'region'  => 'your-region',
     'credentials' => [
         'key'    => 'your-key',
         'secret' => 'your-secret-key'
       ]

]);

$bucketName = 'bucketName';
$file_Path = 'logo.jpg';
$key = basename($file_Path);
try {

    $result = $s3->putObject([
         'Bucket' => $bucketName,
         'Key'    => $key,
         'Body'   => fopen($file_Path, 'r'),
          'ACL'    => 'public-read',

    ]);

    echo $result->get('ObjectURL');

} catch (Aws\S3\Exception\S3Exception $e) {

    echo "There was an error uploading the file.\n";

    echo $e->getMessage();

}
?>

