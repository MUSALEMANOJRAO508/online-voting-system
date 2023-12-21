<?php
echo'
<script>
alert("thank you for voting");
</script>';
session_start();
session_destroy();
header("location: ../OLVS/Registration.html");
?>