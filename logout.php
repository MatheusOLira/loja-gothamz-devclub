<?php
session_start();

// remove todas as variáveis da sessão
session_unset();

// destrói a sessão
session_destroy();

// redireciona pro site
header("Location: index.php");
exit;