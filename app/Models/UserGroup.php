<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Group $group
 * @property int $group_id
 * @property int $group_leader
 * @property User $user
 * @property int $user_id
 * @property int $user_pending
 */
class UserGroup extends Model
{
    protected $table = 'phpbb_user_group';
    public $timestamps = false;
    protected $primaryKeys = ['user_id', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
