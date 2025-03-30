<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column column-100">
        <div class="users view content">
            <h3>Profil de <?= h($user->pseudo) ?></h3>
            <table>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date d\'inscription') ?></th>
                    <td><?= h($user->created->i18nFormat('EEEE d MMMM yyyy', 'Europe/Paris', 'fr_FR')) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Asks') ?></h4>
                <?php if (!empty($user->asks)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Target Id') ?></th>
                            <th><?= __('Target Type') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->asks as $ask) : ?>
                        <tr>
                            <td><?= h($ask->id) ?></td>
                            <td><?= h($ask->user_id) ?></td>
                            <td><?= h($ask->target_id) ?></td>
                            <td><?= h($ask->target_type) ?></td>
                            <td><?= h($ask->status) ?></td>
                            <td><?= h($ask->created) ?></td>
                            <td><?= h($ask->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Asks', 'action' => 'view', $ask->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Asks', 'action' => 'edit', $ask->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Asks', 'action' => 'delete', $ask->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Est-tu sûr de vouloir supprimer # {0}?', $ask->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
