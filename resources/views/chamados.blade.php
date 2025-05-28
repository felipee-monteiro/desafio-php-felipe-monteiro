<!DOCTYPE html>
<html>
<head>
    <title>Chamados</title>
    <style>
        body { font-family: sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Prioridade</th>
                <th>Responsável</th>
                <th>
                    <p>Criado em / Atualizado em</p>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($chamados as $chamado)
            <tr>
                <td>{{ $chamado['titulo'] }}</td>
                <td>{{ $chamado['descricao'] }}</td>
                <td>{{ $chamado['categoria']['name'] }}</td>
                <td>{{ $chamado['status']['name'] }}</td>
                <td>{{ $chamado['prioridade']['name'] }}</td>
                <td>{{ $chamado['responsavel']['name'] }}</td>
                <td>{{ $chamado['created_at'] }} / {{ $chamado['updated_at'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
