<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 */
?>
<div class="row">
    <div class="column column-100">
        <div class="albums view content">
            <h3>💿 <?= h($album->name) ?> 💿</h3>

            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/<?= $album->spotify_url ?>?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

            <table>
                <tr>
                    <th><?= __('Artist') ?></th>
                    <td><?= $this->Html->link($album->artist->name, ['controller' => 'Artists', 'action' => 'view', $album->artist->id]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= $this->Text->autoParagraph(h($album->description)); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>
