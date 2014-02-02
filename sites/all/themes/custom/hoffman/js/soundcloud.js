"use strict";
(function() {
  function setupPlayers(className,callback) {
    var waiting = $(className).length;
    $(className).each(function() {
      var requestUrl = $(this).data("soundcloud-url");
      var that = this;
      SC.oEmbed(requestUrl, options, function(data) {
        $(that).append(data.html);
        waiting--;
        if((waiting === 0) && callback) {
          callback(className);
        }
      });
    });
  }
  function configurePlaylist(className) {
    var parentContainers = $(className);
    var count = parentContainers.length;
    var players = [];
    $(parentContainers).each(function() {
      var position = $(this).data("track-no");
      var iframeEl = $(this).find("iframe").get(0);
      var widget = SC.Widget(iframeEl);
      players[position] = (widget);
      widget.bind(SC.Widget.Events.READY,function (){
        count--;
        if(count === 0) {
          console.log("all players ready. Begin linking.");
          addHandlers(players);
        }
      });
    });
  }
  function addHandlers(playerArray) {
    var players = playerArray;
    players.forEach(function(widget,index) {
      if(index != players.length -1) {
        widget.bind(SC.Widget.Events.FINISH, function() {
          players[index+1].play();
        });
      }
    });
  }
  var options = {
    auto_play:      false,
    color:          "4577FF",
    show_comments:  false,
    show_user:      false,
    download:       false,
    show_playcount: false,
    maxheight:      120,
  };
  var containerClass = ".soundcloud-contain";
  setupPlayers(containerClass,configurePlaylist);
})();