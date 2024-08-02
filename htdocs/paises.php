<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do País</title>
</head>
<body>
    <?php
        $continentesTraduzidos = ['Africa' => 'África','Asia' => 'Ásia','Europe' => 'Europa','Oceania' => 'Oceania','America' => 'América','Antarctica' => 'Antártica'];
        $codigoPais = $_GET['codigo'];

        $url = 'https://restcountries.com/v3.1/alpha/'.urlencode($codigoPais);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $pais = json_decode($response, true);

        $pais = $pais[0];
        $nome = htmlspecialchars($pais['name']['common']);
        $continente = htmlspecialchars($pais['region']);
        $continente_traduzido = isset($continentesTraduzidos[$continente]) ? $continentesTraduzidos[$continente] : $continente;
        $populacao = isset($pais['population'])?number_format($pais['population']):'N/A';
        $bandeira = isset($pais['flags']['png'])?htmlspecialchars($pais['flags']['png']):'';
    ?>

    <h1><?php echo $nome; ?></h1>
    <p><strong>Continente:</strong> <?php echo $continente_traduzido; ?></p>
    <p><strong>População:</strong> <?php echo $populacao; ?></p>
    <p><strong>Bandeira:</strong></p>
    <?php if ($bandeira): ?>
        <img src="<?php echo $bandeira; ?>" alt="Bandeira de <?php echo $nome; ?>" style="width: 200px; height: auto;">
    <?php else: ?>
        <p>Bandeira não disponível </p>
    <?php endif; ?>
    <br><br>
    <a href="index.php">Voltar para a lista de países</a>
</body>
</html>
