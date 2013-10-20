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
