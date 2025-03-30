<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Favorite> $favorites
 */
?>
<div class="favorites index content">
    <h3><?= __('Mes favoris') ?></h3>
    <!-- Section des albums favoris -->
    <h4><?= __('Albums favoris') ?></h4>
    <div class="table-favorites">
        <?php if (count($favorites) !== 0): ?>
            <table>
                <thead>
                <tr>
                    <th><?= __('Album') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($favorites as $favorite): ?>
                        <?php if ($favorite->target_type === 'album'): ?>
                            <tr>
                                <td>
                                    <?php echo $this->Html->link($favorite->album->name, ['controller' => 'Albums', 'action' => 'view', $favorite->album->id]); ?>
                                </td>
                                <td class="actions">
                                    <?= $this->Form->postLink(
                                        __('🗑'),
                                        ['action' => 'delete', $favorite->id],
                                        [
                                            'method' => 'delete',
                                            'confirm' => __('Est-tu sûr de vouloir supprimer # {0}?', $favorite->id),
                                        ]
                                        )
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            Pas encore d'album favori
        <?php endif; ?>
        <div class="add-favorite">
            <?= $this->Html->link(__('Ajouter un Album'), ['controller' => 'Albums', 'action' => 'index'], ['class' => 'button float-right']) ?>
        </div>
    </div>
    <!-- Section des artistes favoris -->
    <h4><?= __('Artistes favoris') ?></h4>
    <div class="table-favorites">
        <?php if (count($favorites) !== 0): ?>
            <table>
                <thead>
                <tr>
                    <th><?= __('Artiste') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($favorites as $favorite): ?>
                    <?php if ($favorite->target_type === 'artist'): ?>
                        <tr>
                            <td>
                                <?php
                                    $artist = $favorite->artist;
                                    echo $this->Html->link($artist->name, ['controller' => 'Artists', 'action' => 'view', $artist->id]);
                                ?>
                            </td>
                            <td class="actions">
                                 <?= $this->Form->postLink(
                                    __('🗑'),
                                    ['action' => 'delete', $favorite->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Est-tu sûr de vouloir supprimer # {0}?', $favorite->id),
                                    ]
                                )
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            Pas encore d'artiste favori
        <?php endif; ?>
        <div class="add-favorite">
            <?= $this->Html->link(__('Ajouter un Artiste'), ['controller' => 'Artists', 'action' => 'index'], ['class' => 'button float-right']) ?>
        </div>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
