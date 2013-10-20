<?php
namespace php;
require_once __DIR__."/../vendor/autoload.php";
use Aws\S3;
use Aws\ElasticBeanstalk\S3Client;
use Aws\Common\Aws;
use Aws\Common\Enum\Region;
use Aws\S3\Enum\CannedAcl;
date_default_timezone_set("America/Indianapolis");


$options = getopt("c:",array("directory:","bucket:","keyPrefix:","concurrency:"));

$config = $options['c'];
$aws = Aws::factory($config);
$client = $aws->get('s3');

if (empty($options['concurrency']))
	$options['concurrency'] = 10;

$client->downloadBucket($options['directory'],$options['bucket'],'',array("concurrency"=>$options['concurrency']));

?>
