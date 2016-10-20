<?php

if (isset($_GET['pwd']) && $_GET['pwd'] == 'joinusad') {
    putenv('LANG=zh_CN.UTF-8');
    header("Content-Type: text/html;charset=utf-8");
    function my_exec($cmd, $input = '')
    {
        $proc = proc_open($cmd, array(0 => array('pipe', 'r'), 1 => array('pipe', 'w'), 2 => array('pipe', 'w')), $pipes);
        fwrite($pipes[0], $input);
        fclose($pipes[0]);
        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);
        $rtn = proc_close($proc);
        return array('stdout' => $stdout,
            'stderr' => $stderr,
            'return' => $rtn
        );
    }

    $path = '/data/www/wx/wx/master-up/';
    $username = 'rkaupdate';
    $password = 'ws123456';
    $cmd = "svn update $path --username $username --password $password "
        . " --no-auth-cache --non-interactive --trust-server-cert; "
        . " chown -R nginx:nginx $path; "
        . " svn info $path;";
    $result = my_exec($cmd);
    print_r($result);
}

