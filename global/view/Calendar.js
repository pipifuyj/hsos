Ext.app.dataset="h_alpha_jpg";
Ext.app.year;
Ext.app.month;
curryear=function(){
	date=new Date();
	return date.getYear()+1900;
}
store2json=function(store) {
        var list = [];
        for(var i=0;i<store.getTotalCount();i++) {list.push(store.getAt(i).data);}
	return list;
};
Ext.onReady(function(){
    Ext.QuickTips.init(); 
    images = new Ext.Panel({
	id:"images",
        title: '全日面太阳观测图',
        region:'west',
	frame:true,
	width:"750",
	height:"400",
	layout:'fit'
    });
   tpl=new Ext.XTemplate(
		'<tpl for=".">',
			'<tpl if="path">',
				'<div class="picture">',
				'<H5>{day}天</H5>',
				'<img src="{path}" height="100px" title="{name}"/>',
				'</div>',
			'</tpl>',
		'</tpl>'
    );
    data=new Ext.data.XmlStore({
		url: '?Calendar=Data',
		remoteSort: true,
		record: 'file',
		idPath: 'id',
		fields: ['id','name','path','day'],
		listeners: {
			load:function(store,records){
				tpl.overwrite(Ext.get("images"),store2json(store));
			}
		}
    });
//产生导航树
    tree = new Ext.tree.TreePanel({
         rootVisible:true,
	 frame:true,
         region:'center',
         width:100,
	 height:300,
         split:true,
         title:'日历导航',
	 autoScroll:true
    });
    root = new Ext.tree.TreeNode({
	id:curryear(),
        text: curryear()+'年',
        allowDrag:false,
        allowDrop:false
    });
    tree.setRootNode(root);
    for(var i=1; i<=12; i++){
	root.appendChild(new Ext.tree.TreeNode({
		id:i,
		text:i+'月',
		allowDrag:false,
		listeners: {
			click: function(node,e){
			        Ext.apply(data.baseParams,{month:node.id,year:node.parentNode.id,dataset:Ext.app.dataset});
				data.load();
			}
		}
	}));
    }
    Year={ 
	allowBlank:false,
	xtype:"numberfield",
	autoWidth:true,
	fieldLabel: '请选择年份(格式如：2010)',
	name: 'year',
	labelSeparator: ':'
    }
    Type={
	allowBlank:false,
	forceSelection:true,
	xtype:"combo",
	fieldLabel: '望远镜类型',
	name: 'dataset',
	labelSeparator: ':',
	store: new Ext.data.XmlStore({url: '?Data=JpgDataset',remoteSort:true,idPath:'id',record: 'dataset',fields: ['equip','table']}),
	emptyTetx:'不允许为空',
	editable:false,
	triggerAction: 'all',
	valueField: 'table',
	displayField:'table'	
    };
    form=new Ext.form.FormPanel({
	title: '日历导航',
	height:150,
	frome:true,
        region:'north',
	items: [{
		layout:'column', 
		items:[{
			columnWidth:0.34,
			layout:'form',
			labelWidth:80,
			items:[Type]
		},{
			columnWidth:0.36,
			layout:'form',
			labelWidth:150,
			items:[Year]
		}]
	}],
        buttons: [{
		text: "日历检索",
		handler: function(){
			var values=form.getForm().getValues();
			if(!values.year) Ext.Msg.alert("警告","你必须输入年份!");
			else if(!values.dataset) Ext.Msg.alert("警告","你必须选择望远镜类型!");
			else{
				Ext.app.dataset=values.dataset;
				Ext.app.year=values.year;
				root = new Ext.tree.TreeNode({
					id:values.year,
				        text: values.year+'年',
				        allowDrag:false,
				        allowDrop:false
	    			});
				tree.setRootNode(root);
				for(var i=1; i<=12; i++){
					root.appendChild(new Ext.tree.TreeNode({
						id:i,
						text:i+'月',
						allowDrag:false,
						listeners: {
							click: function(node,e){
								Ext.app.month=node.id;
								Ext.apply(data.baseParams,{month:node.id,year:node.parentNode.id,dataset:Ext.app.dataset});
								data.load();
							}
						}
					}));
    				}
				root.expand();
			}
		}
	}]
    });
//产生Layout，把tree和images添加到layout，并输出到页面
    layout = new Ext.Panel({
        layout: 'border',        
        width:950,
        height:600,
        items: [tree, images,form],
	listeners:{
		afterrender:function(viewport, e){
			root.expand();
		}
	}
    });
    layout.render('Calendar');
});

