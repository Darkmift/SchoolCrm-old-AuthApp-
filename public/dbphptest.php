<?php
$dbname = 'epiz_21822353_codecourse';
$dbuser = 'epiz_21822353';
$dbpass = 'RiYByFDH5F8T';
$dbhost = 'sql206.epizy.com';

// $dbname = 'schoolcrm';
// $dbuser = 'root';
// $dbpass = 'root12';
// $dbhost = 'localhost';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($connect, $dbname) or die("Could not open the db '$dbname'");
// $test_query = "SHOW TABLES FROM $dbname";
// $result = mysqli_query($connect, $test_query);
// $tblCnt = 0;
// while ($tbl = mysqli_fetch_array($result)) {
//     $tblCnt++;
//     #echo $tbl[0]."<br />\n";
// }
// if (!$tblCnt) {
//     echo "There are no tables<br />\n";
// } else {
//     echo "There are $tblCnt tables<br />\n";
// }

//ALTER PW
$password = password_hash("123456789", PASSWORD_DEFAULT);
$test_query = "UPDATE users SET password = '$password'";
echo $test_query."<hr>";

$result = mysqli_query($connect, $test_query);

if (!$result) {
    echo ("Error description: " . mysqli_error($connect));
}
