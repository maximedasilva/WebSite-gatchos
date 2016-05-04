<?php $headers ='From: "Punchline"<maxdasilva@ensc.fr>'."\n";
$headers .='Reply-To: admin@punchline.fr'."\n";
$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
$headers .='Content-Transfer-Encoding: 8bit';
$message ='<html><head><title>Confirmation de votre inscription au site Punchline.fr</title></head>
                <body>Vous vous êtes récemment inscrit au site de RAP (www.punchline.fr).<br />Vous devez valider votre inscription dans les 24h.<br />Pour cela cliquer sur ce lien ">LIEN DE VALIDATION</a></body></html>';
$mail = mail("joeysssful@gmail.com", 'Inscription sur Punchline', $message, $headers);