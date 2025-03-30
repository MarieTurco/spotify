<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserAlbum Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AlbumsTable&\Cake\ORM\Association\BelongsTo $Albums
 *
 * @method \App\Model\Entity\UserAlbum newEmptyEntity()
 * @method \App\Model\Entity\UserAlbum newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\UserAlbum> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserAlbum get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\UserAlbum findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\UserAlbum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\UserAlbum> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserAlbum|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\UserAlbum saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\UserAlbum>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserAlbum>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserAlbum>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserAlbum> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserAlbum>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserAlbum>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserAlbum>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserAlbum> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersAlbumsTable extends Table
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

        $this->setTable('users_albums');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Albums', [
            'foreignKey' => 'album_id',
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
            ->notEmptyString('album_id');

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
        $rules->add($rules->existsIn(['album_id'], 'Albums'), ['errorField' => 'album_id']);

        return $rules;
    }
}
