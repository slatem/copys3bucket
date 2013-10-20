copys3bucket
============

Copy from an s3 bucket on 1 account to an s3 bucket on another

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

listBucket Example:
```
php listBucket.php -c ~/.credentials/config.json -b bucketname -f /storage/data/listbucket.txt
```

downloadBucket Example:
```
php downloadBucket.php -c ~/.credentials/config.json --directory /storage/data/ --bucket bucketname --concurrency 100 
```
uploadBucket Example
```
php downloadBucket.php -c ~/.credentials/config.json --directory /storage/data/ --bucket bucketname --concurrency 100 
```

on an hi1.4xlarge Ec2 Instance running Amazon AMI I was able to get concurrency up to 6000 with a 93% idle and 0% iowait. I'm sure it could be pushed further.
In order to achieve this I had to up the number of open files allowed by using the command:
```
ulimit -n 15360
```

Also had to run the command like this:
```
php -d memory_limit=2048M downloadBucket.php
```
to allow the process to use more memory
