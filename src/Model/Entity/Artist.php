<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Artist Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $bio
 * @property string|null $picture
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Album[] $albums
 * @property \App\Model\Entity\User[] $users
 */
class Artist extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'bio' => true,
        'picture' => true,
        'spotify_url' => true,
        'created' => true,
        'modified' => true,
        'albums' => true,
        'users' => true,
    ];

    public function _getPicturepath(){

        if(empty($this->picture))
            return 'default.jpg';
        else
            return 'artist/'.$this->picture;
    }
}
