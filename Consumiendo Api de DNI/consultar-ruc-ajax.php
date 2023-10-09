<?php
$token = 'apis-token-5667.TzQCqzEw11KguNArwGetcJRdvx8XRI9k';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dni = $_POST["dni"];

    if (strlen($dni) != 8 || !is_numeric($dni)) {
        $prueba = ["error" => "Número de DNI inválido. Debe contener exactamente 8 dígitos numéricos."];
    } else {
        $prueba = file_get_contents('https://api.apis.net.pe/v1/dni?numero=' . $dni);
    }

    echo json_encode($prueba);
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    $dni = '10547083';

    if (!is_numeric($dni) || strlen($dni) != 8) {
        die("Número de DNI inválido. Debe contener exactamente 8 dígitos numéricos.");
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 2,
      CURLOPT_TIMEOUT => 20,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Referer: https://apis.net.pe/consulta-dni-api',
        'Authorization: Bearer ' . $token
      ),
    ));

    $response = curl_exec($curl);
    if ($response === false) {
        die("Error en la solicitud a la API: " . curl_error($curl));
    }

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($httpCode != 200) {
        die(json_encode(["error" => "Error en la respuesta de la API. Código de estado: " . $httpCode]));
    }

    curl_close($curl);

    $persona = json_decode($response);

    if ($persona === null) {
        die(json_encode(["error" => "Error al decodificar la respuesta JSON de la API."]));
    }

    echo json_encode($persona, JSON_PRETTY_PRINT);
} else {
    die("Método no admitido.");
}
?>