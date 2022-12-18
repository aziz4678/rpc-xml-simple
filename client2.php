<?php

$request = xmlrpc_encode_request("method",array("nim"=>"18650200","nama"=>"Ahmad Hasan Alfarisi"));
$context = stream_context_create(array('http' => array(
'method' => "POST",
'header' => "Content-Type:text/xml;charset=UTF-8",
'content' => $request
)));

$file = file_get_contents("http://192.168.56.136/rpc-xml-simple/server.php?user=pengguna&password=pin",false,$context);

$response = xmlrpc_decode($file);
if($response && xmlrpc_is_fault($response)) {
trigger_error("xmlrpc : $response[faultString] ($response[faultCode])");
}else{
echo "<pre>";
print_r($response);
echo "</pre>";
echo "----------------------------------------";
echo "<br/>nim : ",$response[0]['nim'];
echo "<br/>nama : ",$response[0]['nama'];
}

?>