<?php
/** @var \Exception $exception */
?>
<div class="error-page">
    <h1><?= __('Erreur - Accès interdit') ?></h1>
    <p><?= __('Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.') ?></p>
    <p><?= __('Retour à la') ?> <?= $this->Html->link(__('page d\'accueil'), '/favorites') ?></p>
</div>
