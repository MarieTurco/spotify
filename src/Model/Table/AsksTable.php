<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Asks Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Ask newEmptyEntity()
 * @method \App\Model\Entity\Ask newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Ask> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ask get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Ask findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Ask patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Ask> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ask|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Ask saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Ask>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ask>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ask>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ask> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ask>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ask>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ask>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ask> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AsksTable extends Table
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

        $this->setTable('asks');
        $this->setDisplayField('target_type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER',
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
            ->notEmptyString('user_id');

        $validator
            ->scalar('target_type')
            ->maxLength('target_type', 255)
            ->requirePresence('target_type', 'create')
            ->notEmptyString('target_type');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->inList('target_type', ['album', 'artist'], 'Rôle invalide');

        $validator
            ->inList('status', ['En attente', 'Validée', 'Refusée'], 'Statut invalide');

        $validator
            ->scalar('spotify_url')
            ->maxLength('spotify_url', 255)
            ->notEmptyString('spotify_url');

        $validator
            ->scalar('message')
            ->maxLength('message', 255)
            ->notEmptyString('message');

        $validator
            ->allowEmptyString('artist_id');



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
        $rules->add($rules->existsIn(['artist_id'], 'Artists'), ['errorField' => 'artist_id']);

        return $rules;
    }
}
