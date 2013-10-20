copys3bucket
============

This app provides command line tools to copy from an s3 bucket on 1 account to an s3 bucket on another. Can also of course copy from a bucket on the same account to another on the same account, but is probably less efficient that other methods in that regard.

Prerequisites:

```
mkdir vendor
php composer.phar install
```

config file format is json (-c config_filename) 
```
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
```

Listbucket will output a list of all objects in a bucket to a specified file.

listBucket Example:
```
php listBucket.php -c ~/.credentials/config.json -b bucketname -f /storage/data/listbucket.txt
```

DownloadBucket will download an entire buckets (or portion thereof) contents to a local directory.

downloadBucket Example:
```
php downloadBucket.php -c ~/.credentials/config.json --directory /storage/data/ --bucket bucketname --concurrency 100 
```

UploadBucket will upload an entire directory (or portion thereof) to an s3 bucket (or portion thereof) 

uploadBucket Example
```
php downloadBucket.php -c ~/.credentials/config.json --directory /storage/data/ --bucket bucketname --concurrency 100 --Expires 13 --ACL public-read 
```

The expires is the number of years of the Expires header. This will help keep the object from redownloading to the browser. The ACL allows you to control the permissions of the file.

On an hi1.4xlarge Ec2 Instance running Amazon Linux AMI I was able to get concurrency up to 6000 with a 93% idle and 0% iowait. I'm sure it could be pushed further.
In order to achieve this I had to up the number of open files allowed by using the command:
```
ulimit -n 15360
```

Also had to run the command like this:
```
php -d memory_limit=2048M downloadBucket.php
```
to allow the process to use more memory.
