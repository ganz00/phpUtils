# phpUtils
some php class that can be useful for your daily work

exemple :
```php
RestClient = new RestClient();
headers = array("Content-Type: application/json;");
RestClient->addOption(CURLOPT_HTTPAUTH/*107*/, /*CURLAUTH_BASIC*/1);
RestClient->addOption(CURLOPT_USERPWD/*10005*/, "user:password");
$result = RestClient->setUrl("www.exemple.com")->getMethod($headers);

return ($result->codeRetour == 200 ) ? echo $result->datas : echo "" ;
```
