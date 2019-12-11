/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import DispatcherAction from 'actions/dispatcher-action';
import NotificationJson from 'interfaces/notification-json';
import { fromJson, NotificationIdentity, NotificationIdentityJson } from 'notifications/notification-identity';

export interface NotificationEventLogoutJson {
  event: 'logout';
}

export interface NotificationEventNewJson {
  data: NotificationJson;
  event: 'new';
}

export interface NotificationEventReadJson {
  data: {
    notifications: NotificationIdentityJson[],
    read_count: number,
  };
  event: 'read';
}

export class NotificationEventRead implements DispatcherAction {
  constructor(readonly data: NotificationIdentity[], readonly readCount: number) {}

  static fromJson(eventData: NotificationEventReadJson): NotificationEventRead {
    const data = eventData.data.notifications.map((json) => fromJson(json));
    return new NotificationEventRead(data, eventData.data.read_count);
  }
}

export interface NotificationEventVerifiedJson {
  event: 'verified';
}
