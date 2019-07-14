function RankingField(settings) {

    var _ = this,
        $ = jQuery,
        oldCookie = [],
        selectors = this.initSelectors(),
        cookie = new SaveCookie();

    _.settings = $.extend({}, selectors, settings);
    _.selectors = _.settings.selector;


    _.init = function () {
         oldCookie = cookie.getCookie('ranking_field');
        _.hideIfRate(oldCookie , $);
        attachEvents();
    };

    function attachEvents() {
        $(_.selectors.radio).on('click', function () {
            updateRank($(this))
        });
    }

    function updateRank($context) {

        var $wrapper = $context.parents(_.selectors.rankingWrapper);

        oldCookie = cookie.getCookie('ranking_field');
        if (oldCookie.length == 0) {
            oldCookie = [];
        }
        if (oldCookie.indexOf($wrapper.data('nid')) == -1) {
            oldCookie.push($wrapper.data('nid'));
        }

        cookie.setCookie('ranking_field', JSON.stringify(oldCookie), 2);
        console.log(oldCookie);
        jQuery.get("/update-rank",
            {
                'table': $wrapper.data('field-name'),
                'nid': $wrapper.data('nid'),
                'stars': $context.val()
            }, function (data) {

            });
        _.hideIfRate(oldCookie, $);
    }

    _.init();
}

RankingField.prototype.hideIfRate = function (oldCookie, $) {
    $(this.selectors.rankingWrapper).each(function () {
        if (!(oldCookie.indexOf($(this).data('nid')) == -1)) {
            $(this).find('input').attr('disabled', true);
            $(this).removeClass('hover');
        }
    });
};

RankingField.prototype.initSelectors = function () {

    return {
        selector: {
            radio: '.ranking-field-wrapper input[type="radio"]',
            rankingWrapper: '.ranking-field-wrapper',
        },
        _prop: {},
        _eventsMain: {}
    }

};

jQuery(function () {

    new RankingField({});
});