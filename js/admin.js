/*
 * javascript for webadmin
 * created @2011-11-11
 * by lane
 * 
*/
(function() {
    var YUI = miniYUI, YUD = YUI.dom, YUE = YUI.event;
    var dTar, sTag, dLi,
        sCls = 'on',
        txtClose = '收起',
        txtOpen = '展开';
    var switchMenuInit = function(module) {
        var fnSwitch = function(dA) {
            dLi = dA.parentNode.parentNode;
            if (YUD.hasClass(dLi, sCls)) {
                YUD.removeClass(dLi, sCls);
                dA.title = txtOpen;
            }else {
                YUD.addClass(dLi, sCls);
                dA.title = txtClose;
            }
        };

        YUE.on(module, 'click', function(e) {
            dTar = YUE.getTarget(e);
            sTag = dTar.tagName.toLowerCase();
            if (sTag == 'a' && dTar.parentNode.tagName.toLowerCase() == 'h4') {
                YUE.stopEvent(e);
                fnSwitch(dTar);
            }
        });
    };
    
    YUI.doWhileExist('menu', switchMenuInit);
    
	// css计算
	var table_width_th = $(".state table tr").eq(0).text().length*6;
	var table_width_tr = $(".state table tr").eq(1).text().length*6 ;
	var table_width = 0;
	var win_width = $(window).width()-252;
	if(table_width_th > table_width_tr)
	{
		table_width = table_width_th > win_width? table_width_th : win_width;
	}
	else
	{
		table_width = table_width_tr > win_width? table_width_tr : win_width;
	}	
	$(".state>table").css("width",table_width);
	$(".state").css("overflow",'auto');
})();
