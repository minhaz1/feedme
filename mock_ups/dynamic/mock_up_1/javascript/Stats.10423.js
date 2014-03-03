
var StylightStatsQueue = function () {

	var pending = false;
	var products = {};
	var trackedProducts = {};
	var shownProducts = {};
	var trackedBuffer = [];
	var shownBuffer = [];
	var accessId;
	var pageId;
	var siteId;
	var buildId;
	var rankId;
	var userId;
    var feed = {
        shownBoards: [],
        shownProds:  [],
        shownBuffer: [],
    }

	// event handler for pushed actions
    this.push = function () {

    	for (var i = 0; i < arguments.length; i++) try {
            if (typeof arguments[i] === "function") arguments[i]();
            else {
            	// get function from function handler and call it with given arguments
            	fn[arguments[i][0]].apply(this, arguments[i].slice(1));
            }
        } catch (e) {}

    };

    // handles all functions
    var fn = {
    	// variable setters
		_setAccessId: function(id){
			accessId = id;
		},
		_setPageId: function(id){
			pageId = id;
		},
		_setSiteId: function(id){
			siteId = id;
		},
		_setBuildId: function(id){
			buildId = id;
		},
		_setRankId: function(id){
			rankId = id;
		},
		_setUserId: function(id){
			userId = id;
		},
		_trackClickout: function(productId, random, timestamp){
			var position = 0;
			if(productId in products){
				position = products[productId];
			}
			fn._trackUrl('/track/cl/' + pageId + '/' + accessId + '/' + siteId + '/' + buildId + '/' + rankId + '/' + productId + '/' + position + '/' + random + '/' + timestamp);
		},
		// track loaded products
		_trackAllProducts: function() {

        	var i = 0;

            $('#searchfeed .prd').each(function(o) {
                var productId = $(this).data('product-id');
                if (productId) {
                    products[productId] = i++;
                }
            });

            $.each(products, function(k, v) {
                if (!(k in trackedProducts)) {
                    trackedProducts[k] = true;
                    trackedBuffer.push(k + ',' + v);
                }
            });

            if (!pending && trackedBuffer.length > 0) {
                pending = true;
                setTimeout(fn._sendTracking, 350);
            }
        },
        // track viewed board
        _trackViewedBoard: function(id){
        	var parameters = "?pageId=" + pageId + "&sessionId=" + accessId + "&siteId=" + siteId + "&buildId=" + buildId + "&rankId=" + rankId + "&boardId=" + id;
        	if(userId){
        		parameters += "&userId=" + userId;
        	}
        	fn._trackUrl('/track/bv' + parameters);
        },
        // track hearted product
        _trackHeartedProduct: function(id){
        	fn._trackUrl('/track/h/' + pageId + '/' + accessId + '/' + siteId + '/' + buildId + '/' + rankId + '/' + id);
        },
        // track discovered product
        _trackDiscoveredProduct: function(id){
            fn._trackUrl('/track/c/' + pageId + '/' + accessId + '/' + siteId + '/' + buildId + '/' + rankId + '/' + id);
        },
        // track feed click
        _trackFeedClick: function(type, id){
        	fn._trackUrl('/track/f' + type + 'c/' + pageId + '/' + accessId + '/' + siteId + '/' + buildId + '/' + rankId + '/' + id);
        },
        // check page offset and track seen products
        _checkOffsets: function() {

        	var viewportHeight = $(window).height();

            var inViewport = function() {
                var $this = $(this),
                imgOffsetY = $this.offset().top - $(window).scrollTop() + $this.height();
                return imgOffsetY <= viewportHeight
            }

	        $('#searchfeed .prd').each(function(o) {
                if (inViewport.call(this)) {
                    var productId = $(this).data('product-id');
                    if (productId && !(productId in shownProducts)) {
                        shownProducts[productId] = true;
                        shownBuffer.push(productId + ',' + products[productId]);
                    }
                }
	       });

           $(HelperManager.getElem("hotitem")).each(function(o) {
                var $this = $(this)
                if (inViewport.call(this)) {
                    var hotItem = $this.data('hotitem').split(',')
                    var t = {
                        type: hotItem[0],
                        id:   hotItem[1],
                    }
                    if (t.type === "product") {
                        if (t.id && !(t.id in feed.shownProds)) {
                            feed.shownProds[t.id] = true;
                            feed.shownBuffer.push(t);
                        }
                    }
                    if (t.type === "board") {
                        if (t.id && !(t.id in feed.shownBoards)) {
                            feed.shownBoards[t.id] = true;
                            feed.shownBuffer.push(t);
                        }
                    }
                }

           })

	       if (!pending && shownBuffer.length || feed.shownBuffer.length) {
	    	   pending = true;
	           setTimeout(fn._sendTracking, 350);
	       }
	   },
	   // send tracked and seen products to db
	   _sendTracking: function() {
           pending = false;

           // loaded products
           if (trackedBuffer.length > 0) {
        	   fn._trackUrl('/track/i/' + pageId + '/' + accessId + '/' + siteId + '/' + buildId + '/' + rankId + '/' + trackedBuffer.join(';'));
               trackedBuffer = [];
           }

           // seen products
           if (shownBuffer.length > 0) {
               fn._trackUrl('/track/v/' + pageId + '/' + accessId + '/' + siteId + '/' + buildId + '/' + rankId + '/' + shownBuffer.join(';'));
               shownBuffer = [];
           }
           // seen items in feed
           if (feed.shownBuffer.length) {
                var prods = [],  boards = []
                for (var i = 0; i < feed.shownBuffer.length; i++) {
                    var item = feed.shownBuffer[i];
                    item.type === "product" ? prods.push(item.id) : boards.push(item.id)
                };
               fn._trackUrl('/track/fi/' + pageId + '/' + accessId + '/' + siteId + '/' + buildId + '/' + rankId + '/' + (boards.length ?  boards.join(',')  : 0 )+ '/' +( prods.length ?  prods.join(',')  : 0));
               feed.shownBuffer = [];
           }

       },
       // track a give url
       _trackUrl: function(url) {
    	   if(url){
    		   (new Image()).src = "//t.static-stylight.com" + url;
    	   }
       }


    };

};

// get the existing _sts array
var _old_sts = window._sts;

// create a new _sts object
window._sts = new StylightStatsQueue();

// execute all of the queued up events - apply() turns the array entries into individual arguments
window._sts.push.apply(window._sts, _old_sts);

