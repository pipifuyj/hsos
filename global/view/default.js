Ext.onReady(function(){
//检索结果保存store
Ext.app.DataStore=new Ext.data.XmlStore({
	url: '?Data=Index',
	remoteSort: true,
	record: 'file',
	idPath: 'id',
	fields: ['id','name','path','starttime','endtime'],
	totalProperty: 'count'
});
//检索框的定义和产生
var Type={
	width:280,
	allowBlank:false,
	forceSelection:true,
	xtype:"combo",
	fieldLabel: '望远镜类型',
	name: 'dataset',
	labelSeparator: ':',
	store: new Ext.data.XmlStore({url: '?Data=Dataset',remoteSort:true,idPath:'id',record: 'dataset',fields: ['equip','table']}),
	emptyTetx:'不允许为空',
	editable:false,
	triggerAction: 'all',
	valueField: 'table',
	displayField:'table'	
};
var StartTime={ 
	width:140,	
	xtype:"datefield",
	fieldLabel: '观测开始时间',
	name: 'starttime',
	labelSeparator: ':', 
	format: 'Y-m-d 00:00:00'
};
var EndTime={ 
	width:140,
	xtype:"datefield",
	fieldLabel: '观测结束时间',
	name: 'endtime',
	labelSeparator: ':',
	format: 'Y-m-d 23:59:59'
};
Ext.app.SearchForm=new Ext.form.FormPanel({
	title: '请检索您的数据',
	frame: true,
	width: 984,
	items:[{
		layout:'column', 
		items:[{
			columnWidth:0.35,
			layout:'form',
			labelWidth:30,
			items:[Type]
		},{
			columnWidth:0.25,
			layout:'form',
			labelWidth:60,
			items:[StartTime]
		},{
			columnWidth:0.25,
			layout:'form',
			labelWidth:60,
			items:[EndTime]
		}]
	}],
	buttons: [{
		text: "Search",
		handler: function(){
			var values=Ext.app.SearchForm.getForm().getValues();
			if(values.dataset){
				Ext.apply(Ext.app.DataStore.baseParams,values,{limit:10});
				Ext.app.DataStore.load();
			}else Ext.Msg.alert("警告","你必须指定一个望远镜类型!");
		}
	}],
	renderTo:'SearchForm' 
});
//数据检索结果框
Ext.app.DataPaging=new Ext.PagingToolbar({
	store: Ext.app.DataStore,
	pageSize: 10,
	displayInfo: true
});
Ext.app.Linker=function(val){
	return "<a href='"+val+"' target='_blank'>点击下载</a>";
}
Ext.app.DataGrid=new Ext.grid.GridPanel({
	title: '数据检索结果',
	autoHeight: true,
	store: Ext.app.DataStore,
	sm: new Ext.grid.CheckboxSelectionModel(),
	cm: new Ext.grid.ColumnModel({
			defaults: {sortable: true},
			columns: [
				//new Ext.grid.CheckboxSelectionModel ({singleSelect : false}),
				{header:'序号',dataIndex:'id'},
				{header:'名字',dataIndex:'name'},
				{header:'观测开始时间',dataIndex:'starttime'},
				{header:'观测结束时间',dataIndex:'endtime'},
				{header:'下载',dataIndex:'path',renderer:Ext.app.Linker}
		]}),
	viewConfig: {forceFit:true},
	bbar: Ext.app.DataPaging,
	listeners: {
		rowclick: function(grid,index,e){
		}
	},
	renderTo: 'SearchResult'
});
})
