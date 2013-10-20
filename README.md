copys3bucket
============

Copy from an s3 bucket on 1 account to an s3 bucket on another

config file format is json (-c config_filename) 

{
  "includes": ["_aws"],
  "services": {
      "default_settings": {
          "params": {
              "key": "YOURAWSKEY",
              "secret": "YOURAWSSECRETKEY",
              "region": "us-east-1",
              "scheme": "https"
          }
      }
  }
}


listBucket Example:

php listBucket.php -c ~/.credentials/config.json -b bucketname -f /storage/data/listbucket.txt


downloadBucket Example:

php downloadBucket.php -c ~/.credentials/config.json --directory /storage/data/ --bucket bucketname --concurrency 100 

uploadBucket Example

php downloadBucket.php -c ~/.credentials/config.json --directory /storage/data/ --bucket bucketname --concurrency 100 
