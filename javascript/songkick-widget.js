SongkickWidget = {};

SongkickWidget.Parameters = function(hash_str) {
  this.params = [];
  if (isNaN(parseInt(hash_str, 10))) { // Backwards compatibility for #artist_id
    var pairs = hash_str.split("&");
    for (var i = 0; i < pairs.length; i++) {
      var pair = pairs[i].split("=");
      this.params[unescape(pair[0])] = unescape(pair[1]);
    }
  } else {
    this.params.artist = hash_str;
  }

  this.getParameter = function (name, def) {
    if (this.params.hasOwnProperty(name)) {
      return this.params[name];
    } else if (def) {
      return def;
    } else {
      return null;
    }
  };
};
SongkickWidget.parameters = new SongkickWidget.Parameters(location.search.substring(1));

if (SongkickWidget.parameters.getParameter("xdm_e", "default" != "default")) {
  SongkickWidget.parameters = new SongkickWidget.Parameters(location.hash.substring(1));
}

SongkickWidget.API = {
  API_KEY: "2kPN9eFcrPY9pwv4",
  getCalendarURL: function(type, subject) {
    var urlArgs = {},
        protocol = (document.location.protocol == "https:") ? "https:" : "http:";
    var url = protocol + "//api.songkick.com/api/3.0/" + type + "/" + subject + "/calendar.json";

    urlArgs.apikey = this.API_KEY;
    urlArgs.per_page = 100;
    if (type == "users") { urlArgs.reason = "attendance"; }

    url += "?" + this.formatArgs(urlArgs);
    url += "&jsoncallback=?";
    return url;
  },
  formatArgs: function(args) {
    var parts = [];
    for (var name in args) {
      if (args.hasOwnProperty(name) && args[name]) {
        parts.push(name + "=" + escape(args[name]));
      }
    }
    return parts.join("&");
  },
  getCalendar: function(type, subject, success, error, complete) {
    $.ajax({
      url: this.getCalendarURL(type, subject),
      jsonpCallback: "jqueryJsonpCallback",
      dataType: "jsonp",
      timeout: 10000
    }).success(success)
     .error(error)
     .complete(complete);
  }
};

SongkickWidget.UI = {
  formatPerformances: function (performances, billing) {
    if(performances === undefined) { return ""; }

    if (billing) {
      performances = performances.filter(function(p) {
        return p.billing == billing;
      });
    }
    performances = performances.map(function(p) {
      return p.displayName;
    });

    if(billing === null && performances.length > SongkickWidget.Events.NUMBER_OF_OTHER_ARTISTS) {
      return performances.slice(0, SongkickWidget.Events.NUMBER_OF_OTHER_ARTISTS).join(", ") + " and more&hellip;";
    } else {
      return performances.join(", ");
    }
  },
  showEvents: function(events) {
    if(SongkickWidget.parameters.getParameter("other-artists")){
      $(".results").addClass('other-artists');
    }
    if(SongkickWidget.parameters.getParameter("username")){
      $(".results").addClass('user-events');
    }
    $(".results").directives({
        ".event":{
          'event <- event': {
            '@class': 'event #{event.status}',
            '.start .day':   function() { return SongkickWidget.DateFormat.print_date(this.start, "dow"); },
            '.start .date':  function() { return SongkickWidget.DateFormat.print_date(this.start, "d"); },
            '.start .month': function() { return SongkickWidget.DateFormat.print_date(this.start, "m"); },
            '.end .day':     function() { return SongkickWidget.DateFormat.print_date(this.end, "dow"); },
            '.end .date':    function() { return SongkickWidget.DateFormat.print_date(this.end, "d"); },
            '.end .month':   function() { return SongkickWidget.DateFormat.print_date(this.end, "m"); },
            '.end@class+':   function() {
              if (!this.end || this.end.date == this.start.date) {
                return " hide";
              }
              return "";
            },
            '.location@class': function() {
              return (SongkickWidget.parameters.getParameter("artist") || SongkickWidget.parameters.getParameter("username")) ?
                  "location" :
                  "location hide";
            },
            '.venue': function() {
              if (this.type == "Festival" && !SongkickWidget.parameters.getParameter("username")) {
                return this.displayName;
              }
              return this.venue.displayName;
            },
            '.city': 'event.location.city',
            '.artists@class': function() {
              return (SongkickWidget.parameters.getParameter("artist")) ?
                  "artists hide" :
                  "artists";
            },
            '.headline': function() {
              if (SongkickWidget.parameters.getParameter("artist")) {
                return "";
              }
              if (this.type == "Festival") { return this.displayName; }
              return SongkickWidget.UI.formatPerformances(this.performance, "headline");
            },
            '.support': function() {
              if (SongkickWidget.parameters.getParameter("artist")) {
                return "";
              }
              if (this.type == "Festival") {
                return SongkickWidget.UI.formatPerformances(this.performance, null);
              }
              return SongkickWidget.UI.formatPerformances(this.performance, "support");
            },
            '.others': function(){
              if(SongkickWidget.parameters.getParameter("other-artists")){
                var artists = SongkickWidget.Events.otherArtistsFor(this);
                return SongkickWidget.UI.toArtistString(artists);
              } else {
                return "";
              }
            },
            '.link@href': function() {
              if (SongkickWidget.parameters.getParameter('artist')) {
                return this.uri + '&utm_campaign=widget&utm_content=' + SongkickWidget.parameters.getParameter('artist');
              }
              return this.uri;
            }
          }
        },
        'div.no-events@class': function() {
          return this.event ? "no-events hide" : "no-events show";
        }
      })
      .render(events);
  },

  toArtistString: function(artists){
    if (artists.length === 0) {
      return "";
    } else {
      var artistString = "with " + artists[0].displayName;

      if(artists.length == 1){
        return artistString;
      } else if(artists.length == 2) {
        artistString += ' and ' + artists[1].displayName;
      } else if(artists.length > 2) {
        artistString += ', ';
        artistString += artists.slice(1, artists.length-1).map(function (artist) {
          return artist.displayName;
        }).join(', ');

        if(artists.length != SongkickWidget.Events.NUMBER_OF_OTHER_ARTISTS){
          artistString += ' and ' + artists[artists.length-1].displayName;
        } else {
          artistString += ' and more&hellip;';
        }
      }

      return artistString;
    }
  },

  showEventsFromAPI: function(json) {
    if (SongkickWidget.parameters.getParameter("username")) {
      var events = $.map(json.resultsPage.results.calendarEntry, function(val) {
        return val.event;
      });
      SongkickWidget.UI.showEvents({event: events});
    } else {
      SongkickWidget.UI.showEvents(json.resultsPage.results);
    }
  },
  showAPIError: function() {
    $('.api-error').removeClass("hide");
  },
  hideLoadingAnimation: function() {
    $('.loading').addClass("hide");
  },
  setTheme: function() {
    var theme = SongkickWidget.parameters.getParameter("theme", "light"),
        bgcolor = SongkickWidget.parameters.getParameter("background-color"),
        fgcolor = SongkickWidget.parameters.getParameter("font-color");

    $('body').addClass(theme);
    if (theme == "light") {
      $('div.loading img').attr("src", "/loading_animation_light.gif");
      $('div.powered img').attr("src", "/songkick-black.png");
    } else {
      $('div.loading img').attr("src", "/loading_animation_dark.gif");
      $('div.powered img').attr("src", "/songkick-white.png");
    }
    $('div.powered a').attr("href", "http://tourbox.songkick.com/?utm_medium=referral&utm_source=widget&utm_campaign=" + SongkickWidget.parameters.getParameter("artist"));
    if (bgcolor) { $('body').css("background-color", bgcolor); }
    if (fgcolor) { $('body').css("color", fgcolor); }
    $('#title').text(SongkickWidget.parameters.getParameter("header", "TOUR DATES"));
  },
  loadEvents: function() {
    var artist   = SongkickWidget.parameters.getParameter("artist"),
        username = SongkickWidget.parameters.getParameter("username"),
        venue    = SongkickWidget.parameters.getParameter("venue"),
        type = null, subject = null;

    if (artist) {
      type = "artists";
      subject = artist;
    } else if (username) {
      type = "users";
      subject = username;
    } else {
      type = "venues";
      subject = venue;
    }

    SongkickWidget.API.getCalendar(type, subject,
      SongkickWidget.UI.showEventsFromAPI,
      SongkickWidget.UI.showAPIError,
      function() {
        SongkickWidget.UI.hideLoadingAnimation();
        SongkickWidget.Events.fireHeightChanged();
      });
  },
  responsiveJs: function() {
    var MEDIUM = 505,
        NARROW = 320,
        width = $('html').width();

    if (width < MEDIUM) { $('body').addClass('medium'); }
    if (width < NARROW) { $('body').addClass('narrow'); }
    if (width > MEDIUM) { $('body').removeClass('medium'); }
    if (width > NARROW) { $('body').removeClass('narrow'); }
  }
};

SongkickWidget.Events = {
  NUMBER_OF_OTHER_ARTISTS: 4,

  notifyParent: function(message) {
    var socket = new easyXDM.Socket({
      swf: "/libs/easyxdm.swf",
      onReady:  function(){
        socket.postMessage(message);
      }
    });
  },
  fireHeightChanged: function() {
    var height = SongkickWidget.Events.documentHeight();
    SongkickWidget.Events.notifyParent(height + 30);
  },

  bodyLoaded: function() {
    SongkickWidget.UI.setTheme();
    SongkickWidget.UI.loadEvents();
    SongkickWidget.UI.responsiveJs();
  },

  bodyResized: function() {
    SongkickWidget.UI.responsiveJs();
    SongkickWidget.Events.fireHeightChanged();
  },

  documentHeight: function() {
     return ($('.listings-height').height());
  },

  otherArtistsFor: function(event){
    var artists = [];
    var find_more_artists = true;
    for(var i=0; i < event.performance.length && find_more_artists; i++){
      var artist = event.performance[i].artist;
      if (SongkickWidget.parameters.getParameter("artist") != artist.id){
        artists.push(artist);
        if(artists.length >= SongkickWidget.Events.NUMBER_OF_OTHER_ARTISTS){
          find_more_artists = false;
        }
      }
    }
    return artists;
  }
};

SongkickWidget.DateFormat = {
  MONTHS: ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE",
           "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"],
  DAYS_OF_WEEK: ["SUN", "MON", "TUE", "WED",
                 "THU", "FRI", "SAT"],
  print_date: function (date_el, field) {
    if (!date_el) { return null; }

    var date_str = date_el.date,
        parts = date_str.match(/(\d+)/g);

    var date = new Date(parts[0], parts[1] - 1, parts[2]);
    switch(field) {
      case "m":
        return SongkickWidget.DateFormat.MONTHS[date.getMonth()];
      case "d":
        return date.getDate();
      case "dow":
        return SongkickWidget.DateFormat.DAYS_OF_WEEK[date.getDay()];
    }
  }
};
