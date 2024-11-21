<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Cours</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Liste des Cours</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cours)) : ?>
                <?php foreach ($cours as $c) : ?>
                    <tr>
                        <td><?= htmlspecialchars($c['idc']) ?></td>
                        <td><?= htmlspecialchars($c['titre_c']) ?></td>
                        <td><?= htmlspecialchars($c['description_c']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">Aucun cours disponible.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
