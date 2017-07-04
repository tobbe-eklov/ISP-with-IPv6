<?php
        $conn = new mysqli("localhost", "username", "password", "databasename") or die("cannot connect");
        $conn->query("SET NAMES utf8");
        ini_set('max_execution_time', 0);

        $date = date("Y-m-d");
        $scandir = "/usr/local/var/";
        $dirs = ["sverige"];
        foreach ($dirs as $loadedDir) {
                $files = scandir($scandir . $loadedDir . "/isp/result/ipv6/");
                $files = array_diff($files, array('.', '..'));

                $dns6 = array();
                $errdns6 = array();
                $truedns6 = array();
                $mx6 = array();
                $errmx6 = array();
                $truemx6 = array();
                $www6 = array();
                $errwww6 = array();
                $truewww6 = array();

                $columns = array("dns6","errdns6","truedns6","mx6","errmx6","truemx6","www6","errwww6","truewww6");

                foreach ($files as $loadedFile) {
                        $file = file($scandir . $loadedDir . "/isp/result/ipv6/" . $loadedFile);

                        $domain = array();
                        foreach ($file as $line) {
                                $domain = trim($line);
                                ${$loadedFile}[$domain] = 1;
                        }
                }

                $domains = array();
                foreach ($columns as $column) {
                        foreach (${$column} as $dom => $val) {
                                $varName = str_replace(".", "_", $dom);
                                if (!isset(${$varName})) {
                                        ${$varName} = array($column => $val);
                                } else {
                                        ${$varName}[$column] = $val;
                                }
                        $domains[$varName] = ${$varName};
                        }
                }

                foreach ($domains as $dom => $val) {
                        $domName = str_replace("_", ".", $dom);
                        foreach ($columns as $column) {
                                if(isset($val[$column])) ${"val" . $column} = 1; else ${"val" . $column} = 0;
                        }
                        $query = "INSERT INTO ispIpv6 (aiDomain, aiDns6, aiErrdns6, aiTruedns6, aiMx6, aiErrmx6, aiTruemx6, aiWww6, aiErrwww6, aiTruewww6, aiInsDate) VALUES ('$domName', '$valdns6', '$valerrdns6', '$valtruedns6', '$valmx6', '$valerrmx6', '$valtruemx6', '$valwww6', '$valerrwww6', '$valtruewww6', '$date')";
                        $conn->query($query) or die(mysqli_error($conn));
                        ${$dom} = null;
                }
        }

        $conn->close();
?>
