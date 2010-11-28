pro map
entry_device=!d.name
set_plot,'Z'
xsize=640
ysize=512
device,z_buffering=0,set_resolution=[xsize,ysize],set_color=!d.table_size,set_character_size=[10,12]
lon=randomu(-100L,100)*360.0-180.0
lat=randomu(-200L,100)*180.0-90
map_set,0,135,/orthographic,/isotropic,/horizon
map_grid
oplot,lon,lat,psym=1
image=tvrd()
write_image, "a.png",'png',image
end
