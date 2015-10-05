$(function()
    { 
		$.fn.styleTable = function (options) {
		        var defaults = {
		            css: 'ui-styled-table'
		        };
		        options = $.extend(defaults, options);

		        return this.each(function () {
		            $this = $(this);
		            $this.addClass(options.css);

		            $this.on('mouseover mouseout', 'tbody tr', function (event) {
		                $(this).children().toggleClass("ui-state-hover", event.type == 'mouseover');
		            });

		            $this.find("th").addClass("ui-state-active");
		            $this.find("td").addClass("ui-widget-content");
		            $this.find("tr:last-child").addClass("last-child");
		        });
		    };
		
		$(".tablesorter").tablesorter({sortList: [[0,0]]});
		$("table").styleTable();
    } 
); 