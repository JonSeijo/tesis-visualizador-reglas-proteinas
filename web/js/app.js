(function(){
    var $body = $("body");

    var Highlights = (function () {
        var Colors = {};
        Colors.names = {
            aqua: "#00ffff",
            azure: "#f0ffff",
            beige: "#f5f5dc",
            cyan: "#00ffff",
            darkblue: "#00008b",
            darkcyan: "#008b8b",
            darkgreen: "#006400",
            darkmagenta: "#8b008b",
            darkred: "#8b0000",
            fuchsia: "#ff00ff",
            gold: "#ffd700",
            green: "#008000",
            indigo: "#4b0082",
            khaki: "#f0e68c",
            lightblue: "#add8e6",
            lightcyan: "#e0ffff",
            lightgreen: "#90ee90",
            lightgrey: "#d3d3d3",
            lightpink: "#ffb6c1",
            lightyellow: "#ffffe0",
            lime: "#00ff00",
            magenta: "#ff00ff",
            navy: "#000080",
            olive: "#808000",
            orange: "#ffa500",
            pink: "#ffc0cb",
            purple: "#800080",
            violet: "#800080",
            red: "#ff0000",
            silver: "#c0c0c0",
            white: "#ffffff",
            yellow: "#ffff00"
        };

        var data;

        var color = function() {
            var result;
            var count = 0;
            for (var prop in Colors.names) {
                if (Math.random() < 1/++count) {
                    result = prop;
                }
            }

            return result;
        };

        var matches = function(part, total) {
            var regexp = new RegExp("(?=("+part+"))", "gi");
            var m, mm = [];

            while ((m = regexp.exec(total)) !== null) {
                if (m.index === regexp.lastIndex) {
                    regexp.lastIndex++;
                }
                mm.push(m.index);
            }

            data.matches.push({value:part, occurrences:mm});
            return mm;
        };

        var replacements = function(parts, total) {
            //Initialize interval array
            var reps = [];
            for(var i = 0; i < total.length; i++) {
                reps.push(false);
            }

            if (parts instanceof Array) {
                for(var k = 0; k < parts.length; k++) {
                    mms = matches(parts[k], total);
                    if(mms.length > 0) {
                        for(var i = 0; i < mms.length; i++) {
                            var end = mms[i] + parts[k].length;
                            for(var j = mms[i]; j < end; j++) {
                                reps[j] = true;
                            }
                        }
                    }
                }
            }

            return reps;
        };

        var intervals = function(parts, total) {
            var intervals = [];
            var isInterval = false;
            var start,end = 0;
            var reps = replacements(parts, total);

            for(var i = 0; i < total.length; i++) {
                if(!isInterval && reps[i]) {
                    start = i;
                    isInterval = true;
                }

                if(isInterval && !reps[i]) {
                    end = i;
                    isInterval = false;
                    intervals.push({start:start, end:end});
                }
            }

            if(isInterval) {
                intervals.push({start:start, end:total.length})
            }

            return intervals;
        };


        var highlight = function(parts, total, color) {
            data = {matches: []};
            var elems = intervals(parts, total);
            var aux = total;
            for(var i = elems.length-1; i >= 0; i--) {
                var newContent = tag('span', aux.slice(elems[i].start, elems[i].end), style(color));
                aux = splice(aux, elems[i].start, elems[i].end, newContent);
            }

            return aux;
        };

        var tag = function(tag, content, options = "") {
            if(options.length > 0) {
                options = " " + options;
            }
            return "<"+tag + options +">"+content+"</"+tag+">";
        };

        var splice = function(str, start, end, add) {
            return str.slice(0, start).concat(add, str.slice(end));
        };

        var style = function(color) {
            return "style=\"background-color: "+color+";\"";
        };

        var displayData = function($target) {
            var summary = "";
            for (var i = 0, l = data.matches.length; i < l; i++) {
                var elem = data.matches[i];
                for (var j = 0; j < elem.occurrences.length; j++) {
                    elem.occurrences[j] = elem.occurrences[j]+1;
                }
                summary += elem.value + ": " + elem.occurrences.join(", ") + "<br/>";
            }
            $target.html(summary);
        };

        return {
            highlight: highlight,
            displayData: displayData,
            color: color
        };
    })();

    $body.on("click", ".rule-highlight", function(e) {
        var $this = $(this);
        var $enc = $("#encoding");
        var encoding = $enc.text().trim();
        var color = Highlights.color();
        var $summary = $("#summary");

        $(".rule-highlight").css("background-color", "transparent");
        $summary.html("");

        var parts = $this.data("parts").split(", ");
        $this.toggleClass("checked");
        if($this.hasClass("checked")) {
            $this.css("background-color", color);
            $enc.html(Highlights.highlight(parts, encoding, color));
            Highlights.displayData($summary);
        } else {
            $enc.html($enc.text());
        }
    });


})();