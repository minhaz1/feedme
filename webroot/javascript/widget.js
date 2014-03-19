SongkickWidget = {};

SongkickWidget.Widget = {
  loadJS: function(path, callback) {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = path;

    if (callback) {
      script.onreadystatechange = function() {
        if (this.readyState == 'loaded' || this.readyState == 'complete') {
          callback();
        }
      };
      script.onload = callback;
    }

    var head = document.getElementsByTagName("head");
    head[0].appendChild(script);
  },
  getElementByTagNameAndClass: function(tagname, tagclass) {
    var candidates = document.getElementsByTagName(tagname);
    for (var i = 0; i < candidates.length; i++) {
      var candidate = candidates[i];
      if (!candidate.className) {
        continue;
      }
      var classes = candidate.className.split(/\s+/);
      for (var j = 0; j < classes.length; j++) {
        var cclass = classes[j];
        if (cclass == tagclass) {
          return candidate;
        }
      }
    }
    return null;
  },
  getCustomOptions: function(el) {
    var options = ["theme", "font-color", "background-color", 'other-artists'];
    var optString = "";
    for (var i = 0; i < options.length; i++) {
      var option = options[i];
      var attr = el.getAttribute("data-" + option);
      if (attr) {
        optString = optString + "&" + option + "=" + escape(attr);
      }
    }
    return optString;
  },
  getRequestInformation: function() {
    var skget = SongkickWidget.Widget.getElementByTagNameAndClass('a', 'songkick-widget');
    if (!skget) { return null; }
    var songkickUrl = skget.href;
    var regex = new RegExp("^https?://(staging.songkick.net|www.songkick.com)/(artists|users|venues)/([0-9a-zA-Z-\+\._]+|[0-9]+)$");
    var match = regex.exec(songkickUrl);
    if (match) {
      var targetDomain = (match[1] == "www.songkick.com") ? "widget.songkick.com" : "widget.staging.songkick.net",
          resourceType = null, resourceId = null;
      switch(match[2]) {
        case("venues"):
          resourceType = "venue";
          resourceId = match[3].match(/^\d+/)[0];
          break;
        case("users"):
          resourceType = "username";
          resourceId = match[3];
          break;
        case("artists"):
          resourceType = "artist";
          resourceId = match[3].match(/^\d+/)[0];
          break;
      }
      var response = { targetDomain: targetDomain,
                       resourceType: resourceType,
                       resourceId:   resourceId };
      return response;
    } else {
      return null;
    }
  },
  loadIFrame: function() {
    var skget = SongkickWidget.Widget.getElementByTagNameAndClass('a', 'songkick-widget');
    if (!skget) { return; }

    var requestInfo = SongkickWidget.Widget.getRequestInformation();
    if (!requestInfo) { return; }

    var skgetWidth = skget.style.width;
    if (!skgetWidth) { skgetWidth = "100%"; }

    var skgetText = skget.textContent || skget.innerText;
    if (skgetText === undefined) { skgetText = ""; }

    var iframe = document.createElement("div");
    skget.parentNode.replaceChild(iframe, skget);
    var resourceType   = requestInfo.resourceType;
    var resourceId     = requestInfo.resourceId;
    var targetProtocol = (document.location.protocol == "https:") ? "https:" : "http:";
    var targetDomain   = requestInfo.targetDomain;
    var url = targetProtocol + "//" + targetDomain + "/songkick-widget.html?" + resourceType + "=" + escape(resourceId) + "&header=" + escape(skgetText) + SongkickWidget.Widget.getCustomOptions(skget);
    new easyXDM.Socket({
      remote: url,
      container: iframe,
      hash: true,
      channel: resourceId + "_" + Math.floor((Math.random()*10000)+1),
      swf: targetProtocol + "//" + targetDomain + "/libs/easyxdm.swf",
      props: {
        className: "songkick-widget",
        style: {
          width: skgetWidth
        }
      },
      onMessage: function(message) {
        var iframe_el = iframe.firstChild;
        iframe_el.style.height = message + "px";
      }
    });
  }
};
var requestInfo = SongkickWidget.Widget.getRequestInformation();
if (requestInfo) {
  SongkickWidget.Widget.loadJS("//" + requestInfo.targetDomain + "/libs/easyXDM.min.js", SongkickWidget.Widget.loadIFrame);
}
