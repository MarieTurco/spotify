<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Artist;
use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * Artist policy
 */
class ArtistPolicy
{
    /**
     * Check if $user can add Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canAdd(IdentityInterface $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can edit Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canEdit(IdentityInterface $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can delete Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canDelete(IdentityInterface $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can view Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canView(): bool
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
