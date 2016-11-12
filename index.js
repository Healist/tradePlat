$(document).ready(function () {

    var url1;
    $("body").on('click', '[data-action]', function () {
        var actionName = $(this).data('action');
        switch (actionName) {
            case 'a-newPublic':
                url1="http://localhost/tradePlat/api/source/1/10000";
                getSource(url1);
                break;
            case 'a-shuma':
                url1 = "http://localhost/tradePlat/api/type/2/1/100";
                getSource(url1);
                break;
            case 'a-daibu':
                url1 = "http://localhost/tradePlat/api/type/1/1/100";
                getSource(url1);
                break;
            case 'a-dianqi':
                url1 = "http://localhost/tradePlat/api/type/1/1/100";
                getSource(url1);
                break;
            case 'a-tushu':
                url1 = "http://localhost/tradePlat/api/type/1/1/100";
                getSource(url1);
                break;
            case 'a-mzyw':
                url1 = "http://localhost/tradePlat/api/type/1/1/100";
                getSource(url1);
                break;
            case 'a-sportsQ':
                url1 = "http://localhost/tradePlat/api/type/1/1/100";
                getSource(url1);
                break;
            case 'a-other':
                url1 = "http://localhost/tradePlat/api/type/1/1/100";
                getSource(url1);
                break;
        }
    })
})