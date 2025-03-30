<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Album;
use Authorization\IdentityInterface;

/**
 * Album policy
 */
class AlbumPolicy
{
    /**
     * Check if $user can add Album
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Album $album
     * @return bool
     */
    public function canAdd(IdentityInterface $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can edit Album
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Album $album
     * @return bool
     */
    public function canEdit(IdentityInterface $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can delete Album
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Album $album
     * @return bool
     */
    public function canDelete(IdentityInterface $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can view Album
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Album $album
     * @return bool
     */
    public function canView()
    {
        return true;
    }

    /**
     * Checks if the user has the admin role
     *
     * @param \Authorization\IdentityInterface $user
     * @return bool
     */
    protected function isAdmin(IdentityInterface $user): bool
    {
        $userEntity = $user->getOriginalData();
        return $userEntity->role === 'admin';
    }
}
