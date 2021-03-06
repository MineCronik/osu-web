# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, form, input, i } from 'react-dom-factories'
el = React.createElement

export class Uploader extends React.Component
  constructor: (props) ->
    super props
    @state =
      state: ''

  setOverlay: (state) ->
    return if @props.disabled
    @setState state: state

  componentDidMount: =>
    switch @props.contest.type
      when 'art'
        allowedExtensions = ['.jpg', '.jpeg', '.png']
        maxSize = 8*1024*1024

      when 'beatmap'
        allowedExtensions = ['.osu', '.osz']
        maxSize = 32*1024*1024

      when 'music'
        allowedExtensions = ['.mp3']
        maxSize = 16*1024*1024


    $dropzone = $('.js-contest-entry-upload--dropzone')
    $uploadButton = $ '<input>',
      class: 'js-contest-entry-upload fileupload__input'
      type: 'file'
      name: 'entry'
      accept: allowedExtensions.join(',')
      disabled: @props.disabled

    $(@uploadButtonContainer).append($uploadButton)

    $.subscribe 'dragenterGlobal.contest-upload', => @setOverlay('active')
    $.subscribe 'dragendGlobal.contest-upload', => @setOverlay('hidden')
    $(document).on 'dragenter.contest-upload', '.contest-userentry--uploader', => @setOverlay('hover')
    $(document).on 'dragleave.contest-upload', '.contest-userentry--uploader', => @setOverlay('active')

    @$uploadButton().fileupload
      url: laroute.route 'contest-entries.store'
      dataType: 'json'
      dropZone: $dropzone
      sequentialUploads: true
      formData:
        contest_id: @props.contest.id

      add: (e, data) =>
        return if @props.disabled

        file = data.files[0]
        extension = /(\.[^.]+)$/.exec(file.name)[1]

        if !_.includes(allowedExtensions, extension)
          osu.popup osu.trans("contest.entry.wrong_type.#{@props.contest.type}"), 'danger'
          return

        if file.size > maxSize
          osu.popup osu.trans('contest.entry.too_big', limit: osu.formatBytes(maxSize, 0)), 'danger'
          return

        data.submit()

      submit: ->
        $.publish 'dragendGlobal'

      done: (_e, data) ->
        $.publish 'contest:entries:update', data: data.result

      fail: osu.fileuploadFailCallback(@$uploadButton)

  componentWillUnmount: =>
    $.unsubscribe '.contest-upload'
    $(document).off '.contest-upload'

    @$uploadButton()
      .fileupload 'destroy'
      .remove()

  render: =>
    labelClass = [
      'fileupload',
      'contest-userentry',
      'contest-userentry--uploader',
      'disabled' if @props.disabled,
      'contest-userentry--dragndrop-active' if @state.state == 'active',
      'contest-userentry--dragndrop-hover' if @state.state == 'hover',
    ]

    div className: "contest-userentry contest-userentry--new#{if @props.disabled then ' contest-userentry--disabled' else ''}",
      div className: 'js-contest-entry-upload--dropzone',
        el 'label',
          className: labelClass.join(' ')
          ref: (el) => @uploadButtonContainer = el
          i className: 'fas fa-plus contest-userentry__icon'
          div {}, osu.trans('contest.entry.drop_here')


  $uploadButton: =>
    $(@uploadButtonContainer).find('.js-contest-entry-upload')
