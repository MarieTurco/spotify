<h3>Top 5 des artistes les plus suivis</h3>
<table class="table">
    <thead>
    <tr>
        <th>Artiste</th>
        <th>Nombre de suivis</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($topArtists as $artist): ?>
        <tr>
            <td><?= h($artist->artist->name) ?></td>
            <td><?= $artist->follow_count ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h3>Top 5 des artistes les moins suivis</h3>
<table class="table">
    <thead>
    <tr>
        <th>Artiste</th>
        <th>Nombre de suivis</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($leastFollowedArtists as $artist): ?>
        <tr>
            <td><?= h($artist->artist->name) ?></td>
            <td><?= $artist->follow_count ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h3>Top 5 des albums les plus suivis</h3>
<table class="table">
    <thead>
    <tr>
        <th>Album</th>
        <th>Nombre de suivis</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($topAlbums as $album): ?>
        <tr>
            <td><?= h($album->album->name) ?></td>
            <td><?= $album->follow_count ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h3>Top 5 des albums les moins suivis</h3>
<table class="table">
    <thead>
    <tr>
        <th>Album</th>
        <th>Nombre de suivis</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($leastFollowedAlbums as $album): ?>
        <tr>
            <td><?= h($album->album->name) ?></td>
            <td><?= $album->follow_count ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h3>Top 5 des utilisateurs avec le plus de favoris</h3>
<table class="table">
    <thead>
    <tr>
        <th>Utilisateur</th>
        <th>Nombre de favoris</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($topUsers as $user): ?>
        <tr>
            <td><?= h($user->pseudo) ?></td>
            <td><?= $user->favorite_count ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
