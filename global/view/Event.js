Ext.onReady(function(){
//检索结果保存store
Ext.app.EventStore=new Ext.data.XmlStore({
	url: '?Data=Event',
	remoteSort: true,
	record: 'event',
	idPath: 'id',
	fields: ['id','regionnum','lat','long','starttime','endtime','eventtype'],
	totalProperty: 'count'
});
//检索框的定义和产生
var Regnum={
	width:100,
	forceSelection:true,
	xtype:"combo",
	fieldLabel: '太阳活动区号',
	name: 'regionnum',
	labelSeparator: ':',
	store: new Ext.data.XmlStore({
		url: '?Data=Regionnum',
		record: 'regnum',
		fields: ['value']
	}),
	emptyTetx:'Please choose',
	triggerAction: 'all',
	valueField:"value",
	displayField:'value'	
};
var Long={
	width:50,
	forceSelection:true,
	xtype:"combo",
	fieldLabel: '经度',
	name: 'long',
	labelSeparator: ':',
	store: new Ext.data.XmlStore({
		url: '?Data=Longitude',
		record: 'long',
		fields: ['value']
	}),
	emptyTetx:'Please choose',
	triggerAction: 'all',
	valueField:"value",
	displayField:'value'	
};
var Lat={
	width:50,
	forceSelection:true,
	xtype:"combo",
	fieldLabel: '纬度',
	name: 'lat',
	labelSeparator: ':',
	store: new Ext.data.XmlStore({
		url: '?Data=Latitude',
		record: 'lat',
		fields: ['value']
	}),
	emptyTetx:'Please choose',
	triggerAction: 'all',
	valueField:"value",
	displayField:'value'	
};
var StartTime={ 
	width:150,	
	xtype:"datefield",
	fieldLabel: '事件开始时间',
	name: 'starttime',
	labelSeparator: ':', 
	format: 'Y-m-d 00:00:00'
};
var EndTime={ 
	width:150,
	xtype:"datefield",
	fieldLabel: '事件结束时间',
	name: 'endtime',
	labelSeparator: ':',
	format: 'Y-m-d 23:59:59'
};
Ext.app.SearchForm=new Ext.form.FormPanel({
	title: '天文事件检索',
	frame: true,
	width: 984,
	items:[{
		layout:'column', 
		items:[{
			columnWidth:0.20,
			layout:'form',
			labelWidth:30,
			items:[Regnum]
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
		},{
			columnWidth:0.15,
			layout:'form',
			labelWidth:60,
			items:[Long]
		},{
			columnWidth:0.15,
			layout:'form',
			labelWidth:60,
			items:[Lat]
		}]
	}],
	buttons: [{
		text: "Search",
		handler: function(){
			var values=Ext.app.SearchForm.getForm().getValues();
			Ext.apply(Ext.app.EventStore.baseParams,values,{limit:10});
			Ext.app.EventStore.load();
		}
	}],
	renderTo:'SearchForm' 
});
//数据检索结果框
Ext.app.DataPaging=new Ext.PagingToolbar({
	store: Ext.app.EventStore,
	pageSize: 10,
	displayInfo: true
});
Ext.app.DataGrid=new Ext.grid.GridPanel({
	title: '天文事件检索结果',
	autoHeight: true,
	store: Ext.app.EventStore,
	sm: new Ext.grid.CheckboxSelectionModel(),
	cm: new Ext.grid.ColumnModel({
			defaults: {sortable: true},
			columns: [
				//new Ext.grid.CheckboxSelectionModel ({singleSelect : false}),
				{header:'序号',dataIndex:'id'},
				{header:'太阳活动区号',dataIndex:'regionnum'},
				{header:'经度',dataIndex:'long'},
				{header:'纬度',dataIndex:'lat'},
				{header:'事件开始时间',dataIndex:'starttime'},
				{header:'事件结束时间',dataIndex:'endtime'},
				{header:'事件类型',dataIndex:'eventtype'}
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
