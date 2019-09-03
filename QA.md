Q: axeadmin有什么意义？
	
	A: 作者使用过laravel-admin 和 voyager ,但是两个软件都存在学习成本高、扩展难度高、需要反复翻阅手册的问题
	
	axeadmin使用最贴近框架原生的方式来开发常用功能,可以帮助小型团队快速过渡创业初期,保证简洁的基础上不增加额外的学习成本
	
Q: axeadmin可以用于商业项目吗？

	A: 可以,但是请保留项目中layuiAdmin的源码头注释和出处。附:[layuiAdmin开源协议](https://fly.layui.com/jie/26280/)
	
	
Q: 要怎样修改视图文件？

	A: 所有的视图都保存在resources/views/axe中,可以自行更改
	
Q: 如何对原有功能进行二次开发？

	A: 
	1. 可以fork本项目,自行更改后上传到https://packagist.org,使用composer重新加载
	2. 可以下载项目到项目跟目录下,然后使用composer单独进行加载
	3. 直接复制src中的源代码到自己的项目中,并删除composer中对于axeadmin的依赖
	4. 直接修改vendor/kphcdr/axeadmin-laravel下的对应文件（不推荐）
