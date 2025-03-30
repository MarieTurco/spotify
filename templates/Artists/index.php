<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Artist> $artists
 * @var $currentUser
 */
?>
<div class="artists index content">
    <?php if (isset($currentUser) && $currentUser->role === 'user') : ?>
        <?= $this->Html->link(__('Ajouter'), ['controller' => 'Asks', 'action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>

    <?php if (isset($currentUser) && $currentUser->role === 'admin') : ?>
        <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Liste des artistes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('#') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <?php if (isset($currentUser)): ?><th class="actions"><?= __('Actions') ?></th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artists as $artist):?>
                <tr>
                    <td><?= $this->Number->format($artist->id) ?></td>
                    <td><?= $this->Html->link(__($artist->name), ['action' => 'view', $artist->id]) ?></td>
                    <?php if (isset($currentUser)): ?>
                        <td class="actions">
                            <div class="actions-container">
                                <div class="favorite-icon">
                                    <i class="fas fa-star star-icon"
                                       data-id="<?= $artist->id ?>"
                                       data-type="artist"
                                       data-is-favorited="<?= $artist->isFavorited ?>"
                                       style="color: <?= $artist->isFavorited ? 'gold' : 'gray'; ?>; cursor: pointer;">
                                    </i>
                                </div>
                                <div class="action-links">
                                    <?= $this->Html->link(__('👁️'), ['action' => 'view', $artist->id]) ?>
                                    <?php if ($currentUser->role === 'admin'): ?>
                                        <?= $this->Html->link(__('✏️'), ['action' => 'edit', $artist->id]) ?>
                                        <?= $this->Form->postLink(
                                            __('🗑️'),
                                            ['action' => 'delete', $artist->id],
                                            [
                                                'method' => 'delete',
                                                'confirm' => __('Est-tu sûr de vouloir supprimer # {0}?', $artist->id),
                                            ]
                                        ) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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

<?= $this->element('favorites') ?>

