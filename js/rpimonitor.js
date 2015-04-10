// This file is part of RPi-Monitor project
//
// Copyright 2013 - Xavier Berger - http://rpi-experiences.blogspot.fr/
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
var animate;
var statusautorefresh;
var refreshTimerId;
var clickId;
var active_rra;

function GetURLParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}

function SetProgressBarAnimate(){
  $('#animate').attr('checked', animate );
  if ( animate ) {
    $('.progress').addClass('active');
  }
  else{
    $('.progress').removeClass('active');
  }
}


function getData( name ){
  //if ( localStorage.getItem(name+'Version') == localStorage.getItem('version') ) {
  if ( 0 ) {
    return eval("(" + localStorage.getItem(name) + ')');
  }
  else
  {
    return $.ajax({
      url: '/www/web/' + name + '.json',
      dataType: 'json',
      async: false,
      success: function(data) {
        localStorage.setItem(name, JSON.stringify(data))
        localStorage.setItem(name+'Version', localStorage.getItem('version'))
        return data
      },
      fail: function () {
        $('#message').html("<b>Can not get information (<a href='"+name.json+"'>"+name+".json</a>) from RPi-Monitor server.</b>");
        $('#message').removeClass('hide');
        return null
      }
    }).responseJSON
  }
}

function getVersion(){
  $.ajax({
    url: 'version.json',
    dataType: 'json',
    async: false,
    success: function(data) {
        localStorage.setItem('version', data.version);
      }
    })
}

