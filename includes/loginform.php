<?php


/* FIle: loginform.php
 * 
 * Folder: includes
 * Author: Saqib
 * Date: 2018/7/3 10:09PM
 * 
 */


echo '<p>Login Form </p>';

echo ' <form name="loginForm" action="index.php" method="post">';
echo '<p> UserName ';
echo '<input type=text Name=username value = "" maxlength=16></p>';
echo '<p> Password   ';
echo '<input type=password Name=password value="" maxlength=16></p>';
echo '<input type=submit value="Login" />';

echo '</form>';

