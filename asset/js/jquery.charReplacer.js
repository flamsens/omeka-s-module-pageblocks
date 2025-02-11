/*
 *  Copyright 2013 Rameez Raja
 *  version 1.0
*/
(function () {
    $.fn.charReplacer = function (options) {
        var defaults = {
            replaceChar:' ',
            replaceWith: '-'
        };
        var settings = $.extend({}, defaults, options);
        this.keyup(function () {
            var val = $(this).val();
            if (val != "" || val != null) {
                if (($.isArray(settings.replaceChar) && $.isArray(settings.replaceWith)) && (settings.replaceChar.length == settings.replaceWith.length)) {
                    for (var i = 0; i < settings.replaceChar.length; i++) {
                        val = val.replace(new RegExp(settings.replaceChar[i], "gm"), settings.replaceWith[i]);
                    }
                } else {
                    val = val.replace(new RegExp(settings.replaceChar, "gm"), settings.replaceWith);
                }
            }
            $(this).val(val);
            val = '';
        })
    },
        // Extra utilities
        $.fn.maxChars = function (options) {
            var defaults = {
                maxChars: 100
            };
            var settings = $.extend({}, defaults, options);
            this.keyup(function () {
                var val = $(this).val();
                var count = (val != "" || val != null) ? val.length : 0 ;
                if (count >= settings.maxChars) {
                    $(this).val(val.substring(0, settings.maxChars));
                    alert("Max characters allowed :" + settings.maxChars);
                }
            })
        }
})(jQuery);

$(document).ready(function () {
    $("body").on("DOMNodeInserted", function() {
        $('input.anchor').charReplacer({
            replaceChar: ['[^a-zA-Z0-9_\\- ]', '\\s+', '^[-]+', '[-]+$'],
            replaceWith: ['', '-', '-', '-' ]
        })
    })

    $(document).on('input', 'input.anchor', function() {
        let slug = $(this).val();
        $(this).closest('.block-content').find('a').first().attr('id', slug).attr('name', slug)
    })
})
