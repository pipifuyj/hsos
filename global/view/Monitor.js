store2json=function(store) {
        var list = [];
        for(var i=0;i<store.getTotalCount();i++) {list.push(store.getAt(i).data);}
	return list;
};
Ext.onReady(function(){
    Ext.QuickTips.init(); 
    images = new Ext.Panel({
	id:"images",
        title: '虚拟太阳监控',
	frame:true,
	width:"750",
	height:"400",
	layout:'fit'
    });
   tpl=new Ext.XTemplate(
		'<tpl for=".">',
			'<tpl if="path">',
				'<div class="picture">',
				'<H5>{name}</H5>',
				'<img src="{path}" height="100px" title="{name}"/>',
				'<H6>{starttime}</H6>',
				'</div>',
			'</tpl>',
		'</tpl>'
    );
    data=new Ext.data.XmlStore({
		url: '?Monitor=Data',
		remoteSort: true,
		record: 'file',
		idPath: 'id',
		fields: ['id','name','path','starttime','endtime'],
		listeners: {
			load:function(store,records){
				tpl.overwrite(Ext.get("images"),store2json(store));
			}
		}
    });
//    images.render("Monitor");
    data.load();
//产生Layout，把images添加到layout，并输出到页面
   layout = new Ext.Panel({
        layout: 'border',        
        width:980,
	height:300,
        items: [images]
    });
    layout.render('Monitor');
});

