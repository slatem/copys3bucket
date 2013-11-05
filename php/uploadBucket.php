<?php
namespace php;
require_once __DIR__."/../vendor/autoload.php";
use Aws\S3;
use Aws\ElasticBeanstalk\S3Client;
use Aws\Common\Aws;
use Aws\Common\Enum\Region;
use Aws\S3\Enum\CannedAcl;
date_default_timezone_set("America/Indianapolis");


$options = getopt("c:",array("directory:","bucket:","keyPrefix:","concurrency:","baseDir:","Expires:","ACL:"));

$config = $options['c'];
$aws = Aws::factory($config);
$client = $aws->get('s3');

if (empty($options['concurrency']))
	$options['concurrency'] = 10;
if (!empty($options['Expires']) && is_numeric($options['Expires'])){
	$params = array(
		'Expires' => gmdate('D, d M Y H:i:s T', strtotime("+$options[Expires] years")),
		'CacheControl' => 'maxage=31536000',
	     );
}
if (!empty($options['ACL']))
	$params['ACL'] = $options['ACL'];

$client->uploadDirectory($options['directory'],$options['bucket'],'',array("concurrency"=>$options['concurrency'],
									"base_dir"=>$options['baseDir'],
									"params"=>$params
									));

?>
