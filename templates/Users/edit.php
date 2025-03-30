<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $albums
 * @var string[]|\Cake\Collection\CollectionInterface $artists
 */
?>
<div class="row">
    <div class="column column-100">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Modifier le profil') ?></legend>
                <?php
                    echo $this->Form->control('pseudo');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
