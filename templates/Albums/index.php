<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Album> $albums
 *  @var $currentUser
 */
?>
<div class="albums index content">
    <?php if (isset($currentUser) && $currentUser->role === 'user') : ?>
        <?= $this->Html->link(__('Ajouter'), ['controller' => 'Asks', 'action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>

    <?php if (isset($currentUser) && $currentUser->role === 'admin') : ?>
        <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Albums disponibles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('artist_id') ?></th>
                    <?php if (isset($currentUser)): ?><th class="actions"><?= __('Actions') ?></th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($albums as $album):?>
                    <tr>
                        <td><?= h($album->name) ?></td>
                        <td><?= $album->hasValue('artist') ? $this->Html->link($album->artist->name, ['controller' => 'Artists', 'action' => 'view', $album->artist->id]) : '' ?></td>
                        <?php if (isset($currentUser)): ?>
                            <td class="actions">
                                <div class="actions-container">
                                    <div class="favorite-icon">
                                        <i class="fas fa-star star-icon"
                                           data-id="<?= $album->id ?>"
                                           data-type="album"
                                           data-is-favorited="<?= $album->isFavorited ?>"
                                           style="color: <?= $album->isFavorited ? 'gold' : 'gray'; ?>; cursor: pointer;">
                                        </i>
                                    </div>
                                    <div class="action-links">
                                        <?= $this->Html->link(__('👁️'), ['action' => 'view', $album->id]) ?>
                                        <?php if ($currentUser->role === 'admin'): ?>
                                            <?= $this->Html->link(__('✏️'), ['action' => 'edit', $album->id]) ?>
                                            <?= $this->Form->postLink(
                                                __('🗑️'),
                                                ['action' => 'delete', $album->id],
                                                [
                                                    'method' => 'delete',
                                                    'confirm' => __('Est-tu sûr de vouloir supprimer # {0}?', $album->id),
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
