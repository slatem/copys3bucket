<?php
namespace php;
require_once __DIR__."/../vendor/autoload.php";
use Aws\S3;
use Aws\ElasticBeanstalk\S3Client;
use Aws\Common\Aws;
use Aws\Common\Enum\Region;
use Aws\S3\Enum\CannedAcl;
date_default_timezone_set("America/Indianapolis");


$options = getopt("c:f:b:",array());

$config = $options['c'];
$bucket = $options['b'];
$file = $options['f'];
$aws = Aws::factory($config);
$client = $aws->get('s3');

$iterator = $client->getIterator('listObjects',array(
		'Bucket'=>$bucket
	));
$handle = fopen($file, 'w+');
foreach($iterator as $object){
    if (fwrite($handle, $object['Key']."\n") === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }
}
fclose($handle);


?>
