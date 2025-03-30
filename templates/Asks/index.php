<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ask> $asks
 */
?>
<div class="asks index content">
    <h3><?= __('Mes demandes') ?></h3>
    <!-- Section des albums -->
    <h4><?= __('Albums demandés') ?></h4>
    <div class="table-responsive">
        <?php if (count($asks) !== 0): ?>
            <table>
                <thead>
                <tr>
                    <?php if (isset($currentUser) && $currentUser->role === 'admin'): ?>
                        <th><?= __('Initiateur') ?></th>
                    <?php endif; ?>
                    <th><?= __('Message') ?></th>
                    <th><?= __('URL Spotify') ?></th>
                    <th><?= __('Status') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($asks as $ask): ?>
                    <?php if ($ask->target_type === 'album'): ?>
                        <tr>
                            <?php if (isset($currentUser) && $currentUser->role === 'admin'): ?>
                                <td>
                                    <?= $this->Html->link($ask->user->pseudo, ['controller' => 'Users', 'action' => 'view', $ask->user_id]) ?>
                                </td>
                            <?php endif; ?>
                            <td><?= h($ask->message) ?></td>
                            <td><?= h($ask->spotify_url) ?></td>
                            <td><?= h($ask->status) ?></td>
                            <td class="actions">
                                <?php if (isset($currentUser) && $currentUser->role === 'user'): ?>
                                    <?= $this->Html->link(__('✏️'), ['controller' => 'Asks', 'action' => 'edit', $ask->id]) ?>
                                <?php endif; ?>
                                <?php if (isset($currentUser) && $currentUser->role === 'admin' && isset($ask) && $ask->status === 'En attente'): ?>
                                    <?= $this->Html->link(__('✔️'), ['controller' => 'Asks', 'action' => 'valide', $ask->id]) ?>
                                    <?= $this->Html->link(__('❌'), ['controller' => 'Asks', 'action' => 'delete', $ask->id]) ?>
                                <?php endif ?>
                                <?= $this->Form->postLink(
                                    __('🗑'),
                                    ['action' => 'delete', $ask->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Est-tu sûr de vouloir supprimer # {0}?', $ask->id),
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
            Pas encore d'album demandé
        <?php endif; ?>
    </div>
    <!-- Section des artistes -->
    <h4><?= __('Artistes demandés') ?></h4>
    <div class="table-responsive">
        <?php if (count($asks) !== 0): ?>
            <table>
                <thead>
                <tr>
                    <?php if (isset($currentUser) && $currentUser->role === 'admin'): ?>
                        <th><?= __('Initiateur') ?></th>
                    <?php endif; ?>
                    <th><?= __('Message') ?></th>
                    <th><?= __('URL Spotify') ?></th>
                    <th><?= __('Status') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($asks as $ask): ?>
                    <?php if ($ask->target_type === 'artist'): ?>
                        <tr>
                            <?php if (isset($currentUser) && $currentUser->role === 'admin'): ?>
                                <td>
                                    <?= $this->Html->link($ask->user->pseudo, ['controller' => 'Users', 'action' => 'view', $ask->user_id]) ?>
                                </td>
                            <?php endif; ?>
                            <td><?= h($ask->message) ?></td>
                            <td><?= h($ask->spotify_url) ?></td>
                            <td><?= h($ask->status) ?></td>
                            <td class="actions">
                                <?php if (isset($currentUser) && $currentUser->role === 'user'): ?>
                                    <?= $this->Html->link(__('✏️'), ['controller' => 'Asks', 'action' => 'edit', $ask->id]) ?>
                                <?php endif; ?>
                                <?php if (isset($currentUser) && $currentUser->role === 'admin' && $ask->status === 'En attente'): ?>
                                    <?= $this->Html->link(__('✔️'), ['controller' => 'Asks', 'action' => 'valide', $ask->id]) ?>
                                    <?= $this->Form->postLink(__('❌'), ['controller' => 'Asks', 'action' => 'delete', $ask->id],
                                        [
                                            'method' => 'delete',
                                            'confirm' => __('Est-tu sûr de vouloir supprimer # {0}?', $ask->id),
                                        ]) ?>
                                <?php endif ?>
                                <?= $this->Form->postLink(
                                    __('🗑'),
                                    ['action' => 'delete', $ask->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Est-tu sûr de vouloir supprimer # {0}?', $ask->id),
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
            Pas encore d'artiste demandé
        <?php endif; ?>
        <?php if (isset($currentUser) && $currentUser->role === 'user'): ?>
            <div class="add-favorite">
                <?= $this->Html->link(__('Faire une nouvelle demande'), ['controller' => 'Asks', 'action' => 'add'], ['class' => 'button float-right']) ?>
            </div>
        <?php endif; ?>
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
