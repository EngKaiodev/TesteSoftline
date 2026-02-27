<?php
session_start();

require_once '../../includes/config.php';
require_once '../../includes/auth.php';

$titulo = 'Lista de Clientes'; 

include __DIR__.'/../../includes/header.php';

$sql = "SELECT * FROM Clientes ORDER BY CODIGO";
$stmt = $pdo->query($sql);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<p><a href="<?= BASE_URL ?>/modules/clientes/cadastrar.php" class="btn">➕ Novo Cliente</a></p>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($clientes) >0) :?>
            <?php foreach($clientes as $cli): ?>
                <tr>
                    <td><?= htmlspecialchars($cli['Codigo']) ?></td>
                    <td><?= htmlspecialchars($cli['Nome']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/modules/clientes/visualizar.php?codigo=<?= $cli['Codigo'] ?>" title="Visualizar">👁️</a>
                        <a href="<?= BASE_URL ?>/modules/clientes/editar.php?codigo=<?= $cli['Codigo'] ?>" title="Editar">✏️</a>
                        <a href="<?= BASE_URL ?>/modules/clientes/deletar.php?codigo=<?= $cli['Codigo'] ?>" 
                           title="Excluir" 
                           onclick="return confirm('Tem certeza que deseja excluir este cliente?')">🗑️</a>
                    </td>
                    </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Nenhum cliente cadastrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Link para voltar ao menu principal -->
<p><a href="<?= BASE_URL ?>/menu.php">⬅ Voltar ao Menu</a></p>

<?php
// Inclui o rodapé padrão (fecha a div container e o HTML)
include __DIR__ . '/../../includes/footer.php';
?>

