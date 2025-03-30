<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Favorites Controller
 *
 * @property \App\Model\Table\FavoritesTable $Favorites
 */
class FavoritesController extends AppController
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
        $user = $this->request->getAttribute('identity');

        $query = $this->Favorites->find()
            ->where(['user_id' => $user->id])
            ->contain(['Users', 'Albums', 'Artists']);

        $favorites = $this->paginate($query);
        $this->set(compact('favorites'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $favorite = $this->Favorites->get($id);

        if ($this->Favorites->delete($favorite)) {
            $this->Flash->success(__('The favorite has been deleted.'));
        } else {
            $this->Flash->error(__('The favorite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function toggle()
    {
        $this->request->allowMethod(['post']);

        $user = $this->Authentication->getIdentity();
        if (!$user) {
            return $this->response->withType('application/json')->withStringBody(json_encode([
                'success' => false,
                'error' => 'Vous devez être connecté pour gérer vos favoris.'
            ]));
        }

        $data = $this->request->getData();
        $targetId = $data['target_id'];
        $targetType = $data['target_type'];

        // Vérifie si le favori existe
        $favorite = $this->Favorites->find()
            ->where([
                'user_id' => $user->id,
                'target_id' => $targetId,
                'target_type' => $targetType
            ])
            ->first();
        try {
            if ($favorite) {
                $this->Favorites->delete($favorite);
                $isFavorited = false;
            } else {
                $favorite = $this->Favorites->newEntity([
                    'user_id' => $user->id,
                    'target_id' => $targetId,
                    'target_type' => $targetType
                ]);
                $this->Favorites->save($favorite);
                $isFavorited = true;
            }
            $response = ['success' => true, 'isFavorited' => $isFavorited];

        } catch (\Exception $e) {
            $response = ['success' => false, 'error' => $e->getMessage()];
        }
        return $this->response->withType('application/json')->withStringBody(json_encode($response));
    }
}
