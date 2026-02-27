<?php

session_start();

require_once __DIR__ . '/../../includes/config.php';

require_once __DIR__ . '/../../includes/auth.php';

$title = "Listar Produtos";

include __DIR__.'/../../includes/header.php';

$sql = "SELECT * FROM produtos ORDER BY Codigo";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<p><a href="<?= BASE_URL ?>/modules/produtos/cadastrar.php" class="btn">➕ Novo Produto</a></p>


<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Descrição</th>
           <!-- <th>Código de Barras</th>
            <th>Valor de Venda (R$)</th>
            <th>Peso Bruto (kg)</th>
            <th>Peso Líquido (kg)</th>-->
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($produtos) > 0):?>
            <?php foreach($produtos as $prod):?>
                <tr>
                    <td><?= htmlspecialchars($prod['Codigo']) ?></td>
                    <td><?= htmlspecialchars($prod['Descricao']) ?></td>
                    <!--<td><?= htmlspecialchars($prod['CodigoBarras']) ?></td>
                    //<td>R$ <?= number_format($prod['ValorVenda'], 2, ',', '.') ?></td>
                    //<td><?= number_format($prod['PesoBruto'], 3, ',', '.') ?> kg</td>
                    <td><?= number_format($prod['PesoLiquido'], 3, ',', '.') ?> kg</td>-->
                    <td>
                        <a href="<?=BASE_URL?>/modules/produtos/visualizar.php?codigo=<?=$prod['Codigo']?>" title="Visualizar">👁️</a>
                        <a href="<?=BASE_URL?>/modules/produtos/editar.php?codigo=<?=$prod['Codigo']?>" title="Editar">✏️</a>
                        <a href="<?=BASE_URL?>/modules/produtos/deletar.php?codigo=<?=$prod['Codigo']?>" title="Deletar" onclick="return confirm('Tem certeza que deseja deletar este produto?')">🗑️</a>
                    </td>
                    </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Nenhum produto cadastrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<p><a href="<?= BASE_URL ?>/menu.php">⬅ Voltar ao Menu</a></p>

<?php

include __DIR__ . '/../../includes/footer.php';
?>