<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class DashboardsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);
        $this->Authorization->skipAuthorization();
        $this->Authentication->addUnauthenticatedActions(['index']);
    }

    public function index()
    {
        // Top 5 des artistes les plus suivis
        $favoritesTable = TableRegistry::getTableLocator()->get('Favorites');
        $topArtists = $favoritesTable->find()
            ->select(['target_id', 'Artists.name', 'follow_count' => 'COUNT(Favorites.id)'])
            ->where(['target_type' => 'artist'])
            ->group('Favorites.target_id')
            ->order(['follow_count' => 'DESC'])
            ->limit(5)
            ->contain(['Artists'])
            ->all();

        // Top 5 des artistes les moins suivis
        $leastFollowedArtists = $favoritesTable->find()
            ->select(['target_id',  'Artists.name', 'follow_count' => 'COUNT(Favorites.id)'])
            ->where(['target_type' => 'artist'])
            ->group(['Favorites.target_id'])
            ->order(['follow_count' => 'ASC'])
            ->limit(5)
            ->contain(['Artists'])
            ->all();

        // Top 5 des albums les plus suivis
        $topAlbums = $favoritesTable->find()
            ->select(['target_id', 'Albums.name', 'follow_count' => 'COUNT(Favorites.id)'])
            ->where(['target_type' => 'album'])
            ->group('Favorites.target_id')
            ->order(['follow_count' => 'DESC'])
            ->limit(5)
            ->contain(['Albums'])
            ->all();

        // Top 5 des albums les moins suivis
        $leastFollowedAlbums = $favoritesTable->find()
            ->select(['target_id', 'Albums.name', 'follow_count' => 'COUNT(Favorites.id)'])
            ->where(['target_type' => 'album'])
            ->group(['Favorites.target_id'])
            ->order(['follow_count' => 'ASC'])
            ->limit(5)
            ->contain(['Albums'])
            ->all();

        // Top 5 des utilisateurs avec le plus de favoris
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $topUsers = $usersTable->find()
            ->select(['id', 'pseudo', 'favorite_count' => 'COUNT(Favorites.user_id)'])
            ->leftJoinWith('Favorites')
            ->group('Users.id')
            ->order(['favorite_count' => 'DESC'])
            ->limit(5)
            ->all();

        $this->set(compact('topArtists', 'topAlbums', 'topUsers', 'leastFollowedAlbums', 'leastFollowedArtists'));
    }
}
