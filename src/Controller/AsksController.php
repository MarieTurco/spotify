<?php
declare(strict_types=1);

namespace App\Controller;

use http\Env\Response;

/**
 * Asks Controller
 *
 * @property \App\Model\Table\AsksTable $Asks
 */
class AsksController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $currentUser = $this->request->getAttribute('identity');

        if (isset($currentUser)) {
            switch ($currentUser->role) {
                case 'admin':
                    $query = $this->Asks->find()
                        ->contain(['Users']);
                    break;
                case 'user':
                    $query = $this->Asks->find()
                        ->where(['user_id' => $currentUser->id])
                        ->contain(['Users']);
                    break;
            }
            $asks = $this->paginate($query);
            $this->set(compact('asks', 'currentUser'));
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $currentUser = $this->request->getAttribute('identity');

        $ask = $this->Asks->newEmptyEntity();
        if ($this->request->is('post')) {
            $ask = $this->Asks->patchEntity($ask, $this->request->getData());
            if ($this->Asks->save($ask)) {
                $this->Flash->success(__('The ask has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ask could not be saved. Please, try again.'));
        }

        $artists = $this->getTableLocator()->get('Artists')
            ->find()
            ->select(['id', 'name']) // Sélectionne l'id et le name
            ->order(['name' => 'ASC']) // Optionnel : trie par ordre alphabétique
            ->all()
            ->combine('id', 'name') // Crée un tableau associatif [id => name]
            ->toArray();

        $targets = ['album' => 'Album', 'artist' => 'Artist'];
        $this->set(compact('ask', 'currentUser', 'targets', 'artists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ask id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $currentUser = $this->request->getAttribute('identity');

        $ask = $this->Asks->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ask = $this->Asks->patchEntity($ask, $this->request->getData());
            if ($this->Asks->save($ask)) {
                $this->Flash->success(__('The ask has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ask could not be saved. Please, try again.'));
        }
        $users = $this->Asks->Users->find('list', limit: 200)->all();
        $targets = ['album' => 'Album', 'artist' => 'Artist'];
        $this->set(compact('ask', 'currentUser', 'targets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ask id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ask = $this->Asks->get($id);
        if ($this->Asks->delete($ask)) {
            $this->Flash->success(__('The ask has been deleted.'));
        } else {
            $this->Flash->error(__('The ask could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function valide($id = null)
    {
        $ask = $this->Asks->get($id);

        $user = $this->Authentication->getIdentity();
        if (!$user || (isset($user) && $user->role !== 'admin')) {
            return $this->response->withType('application/json')->withStringBody(json_encode([
                'success' => false,
                'error' => 'Vous devez être admin pour gérer les demandes.'
            ]));
        }
        if ($ask->target_type === 'album') {
            $albumTable = $this->getTableLocator()->get('Albums');

            $existingAlbum = $albumTable->find()
                ->where([
                    'Albums.name' => $ask->message,
                    'Albums.artist_id' => $ask->artist_id
                ])
                ->first();

            if ($existingAlbum) {
                $this->Flash->error('Cet album existe déjà pour cet artiste.');
                return $this->redirect(['Controller' => 'Asks', 'action' => 'add']);
            }

            $this->addAlbum($albumTable, $ask);

        } elseif ($ask->target_type === 'artist') {
            $artistTable = $this->getTableLocator()->get('Artists');

            $existingArtist = $artistTable->find()
                ->where(['Artists.name' => $ask->message]) // Assuming "album" field contains artist name
                ->first();

            if ($existingArtist) {
                $this->Flash->error('Cet artiste existe déjà.');
                return $this->redirect(['Controller' => 'Asks', 'action' => 'add']);
            }

            $newArtist = $artistTable->newEmptyEntity();
            $ask->artist_id = $newArtist->id;
            $this->Asks->save($ask);
            $this->addArtist($artistTable, $ask);
        }
    }


    private function addAlbum($albumTable, $ask): void
    {
        $album = $albumTable->newEmptyEntity();
        $album->artist_id = $ask->artist_id;
        $album->name = $ask->message;
        $album->spotify_url = $ask->spotify_url;
        $ask->status = 'Validée';
        $this->getTableLocator()->get('Asks')->save($ask);
        $this->getTableLocator()->get('Albums')->save($album);
    }

    private function addArtist($artistTable, $ask): void
    {
        $artist = $artistTable->newEmptyEntity();
        $artist->name = $ask->message;
        $artist->spotify_url = $ask->spotify_url;
        $ask->status = 'Validée';
        $this->getTableLocator()->get('Asks')->save($ask);
        $this->getTableLocator()->get('Artists')->save($artist);
    }
}
