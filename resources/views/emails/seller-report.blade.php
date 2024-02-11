<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div>
        <h2>Relatório de vendas</h2>
        <p><b>Quantidade de vendas: </b> {{ $data["totalSales"] }} </p>
        <p><b>Valor total de vendas: </b> R$ {{ number_format($data["totalValue"], 2, ',', '.') }} </p>
        <p><b>Valor total de comissões: </b> R$ {{ number_format($data["totalCommission"], 2, ',', '.') }} </p>
    </div>
</body>
</html>
