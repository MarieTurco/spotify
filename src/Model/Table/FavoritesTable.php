<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Favorites Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Favorite newEmptyEntity()
 * @method \App\Model\Entity\Favorite newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Favorite> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Favorite get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Favorite findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Favorite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Favorite> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Favorite|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Favorite saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Favorite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Favorite>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Favorite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Favorite> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Favorite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Favorite>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Favorite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Favorite> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FavoritesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('favorites');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Albums', [
            'foreignKey' => 'target_id',
            'conditions' => ['Favorites.target_type' => 'album'],
            'propertyName' => 'album'
        ]);

        $this->belongsTo('Artists', [
            'foreignKey' => 'target_id',
            'conditions' => ['Favorites.target_type' => 'artist'],
            'propertyName' => 'artist'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('user_id')
            ->maxLength('user_id', 255)
            ->notEmptyString('user_id');

        $validator
            ->requirePresence('target_id', 'create')
            ->notEmptyString('target_id');

        $validator
            ->scalar('target_type')
            ->maxLength('target_type', 255)
            ->requirePresence('target_type', 'create')
            ->notEmptyString('target_type');

        $validator
            ->inList('target_type', ['album', 'artist'], 'Rôle invalide');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
