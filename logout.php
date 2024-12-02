<?php
// logout.php
session_start();
session_unset();  // Eliminar totes les variables de sessió
session_destroy();  // Destruir la sessió

header("Location: login.php");  // Redirigir a la pàgina d'inici de sessió
exit();
