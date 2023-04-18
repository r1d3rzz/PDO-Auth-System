<?php
require "init.php";

query("delete from users");
echo "<script>alert('Delete Successfully')</script>";
echo "<script>location='/'</script>";
