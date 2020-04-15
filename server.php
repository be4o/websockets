<?php
$host = "127.0.0.1";
$port = 20205;
set_time_limit(0);
$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die('could not create socket');
$res = socket_bind($sock, $host, $port) or die('could not bind to socket');
$res = socket_listen($sock, 4) or die('could not bind to listen');

echo "listening to connection";

class Chat
{
    function readline()
    {
        return rtrim(fgets(STDIN));
    }
}
do{
    $accept = socket_accept($sock) or die ("could not accept the socket");
    $msg = socket_read($accept, 1024) or die("could not read ");
    $msg = rtrim($msg);
    echo "Client says:\t".$msg."\n\n";
    $line = new Chat();
    echo "Enter reply:\t";
    $reply = $line->readline();
    socket_write($accept, $reply, strlen($reply)) or die("could not write");
}
while(true);
socket_close($accept, $sock);