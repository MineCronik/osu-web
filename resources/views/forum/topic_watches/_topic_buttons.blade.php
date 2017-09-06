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
{{--
<a
    class="btn-circle btn-circle--topic-entry"
    href="#"
    data-remote="1"
    data-method="POST"
    data-confirm="{{ trans('forum.topic_watches.topic_buttons.mark_read.confirmation') }}"
    title="{{ trans('forum.topic_watches.topic_buttons.mark_read.title') }}"
>
    <i class="fa fa-check"></i>
</a>
--}}

<button
    type="button"
    class="btn-circle btn-circle--topic-entry"
    title="{{ trans('forum.topic_watches.topic_buttons.remove.title') }}"
    data-url="{{ route('forum.topics.watch', [
        $topic,
        'watch' => false,
        'page' => 'manage'
    ]) }}"
    data-remote="1"
    data-method="POST"
    data-confirm="{{ trans('forum.topic_watches.topic_buttons.remove.confirmation') }}"
>
    <span class="btn-circle__container">
        <i class="fa fa-trash"></i>
    </span>
</button>
