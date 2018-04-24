{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
{{-- FIXME: THE STYLES --}}
<div class="beatmap-discussion-post__user-container">
    <a class="beatmap-discussion-post__user-link" href="{{ route('users.modding.index', $user) }}">

    </a>
    <div class="beatmap-discussion-post__avatar">
        <div class="avatar avatar--full-rounded" style="background-image: url('{{$user->user_avatar}}');"></div>
    </div>
    <div class="beatmap-discussion-post__user">
        <span class="beatmap-discussion-post__user-text u-ellipsis-overflow">{!! link_to_user($user) !!}</span>
        {!! $slot !!}
    </div>
</div>
