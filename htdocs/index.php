<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Países</title>
</head>
<body>
    <?php
        $url = 'https://restcountries.com/v3.1/all';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $paises = json_decode($response, true);

        usort($paises, function($a, $b) {
            return strcmp($a['name']['common'], $b['name']['common']);
        });
    ?>
    <table>
        <thead>
            <tr>
                <th>Lista de Paises</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($paises as $pais) : ?>
                <tr>
                    <td><?= htmlspecialchars($pais['name']['common']); ?></td>
                    <td><a href="paises.php?codigo=<?= htmlspecialchars($pais['cca2']); ?>">Informações</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
