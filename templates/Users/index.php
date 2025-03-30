<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 * @var $currentUser
 */
?>
<div class="users index content">
    <?= $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('pseudo') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('Date d\'inscription') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->pseudo) ?></td>
                    <td><?= h($user->role) ?></td>
                    <td><?= h($user->created->i18nFormat('EEEE d MMMM yyyy', 'Europe/Paris', 'fr_FR'))  ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('👁️'), ['action' => 'view', $user->id]) ?>
                        <?php if ($currentUser->role === 'admin'): ?>
                            <?= $this->Html->link(__('✏️'), ['action' => 'edit', $user->id]) ?>
                            <?= $this->Form->postLink(
                                __('🗑️'),
                                ['action' => 'delete', $user->id],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Est-tu sûr de vouloir supprimer ?', $user->id),
                                ]
                            ) ?>
                        <?php endif; ?>
                    </td>
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
