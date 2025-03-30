<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Artist $artist
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="artists view content">
            <h3>🎵 <?= h($artist->name) ?> 🎵</h3>
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/<?= $artist->spotify_url ?>?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

            <div class="text">
                <strong><?= __('Bio') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($artist->bio)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Albums') ?></h4>
                <?php if (!empty($artist->albums)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                        </tr>
                        <?php foreach ($artist->albums as $album) : ?>
                            <tr>
                                <td>
                                    <?= $this->Html->link($album->name,
                                        ['controller' => 'Albums', 'action' => 'view', $album->id]
                                    )?>
                                </td>
                                <td>
                                    <?= h($album->description) ?>
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
