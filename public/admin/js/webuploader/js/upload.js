$(function() {
	var $wrap = $('#uploader'),
		// 图片容器
		$queue = $( '<ul class="filelist"></ul>' ).appendTo( $wrap.find( '.queueList' ) ),
		// 状态栏，包括进度和控制按钮
		$statusBar = $wrap.find( '.statusBar' ),
		// 文件总体选择信息。
		$info = $statusBar.find( '.info' ),
		// 上传按钮
		$upload = $wrap.find( '.uploadBtn' ),
		// 没选择文件之前的内容。
		$placeHolder = $wrap.find( '.placeholder' ),
		$progress = $statusBar.find( '.progress' ).hide(),
		// 添加的文件数量
		fileCount = 0,
		// 添加的文件总大小
		fileSize = 0,
		// 优化retina, 在retina下这个值是2
		ratio = window.devicePixelRatio || 1,
		// 缩略图大小
		thumbnailWidth = 110 * ratio,
		thumbnailHeight = 110 * ratio,
		// 可能有pedding, ready, uploading, confirm, done.
		state = 'pedding',
		// 所有文件的进度信息，key为file id
		percentages = {},
		// 判断浏览器是否支持图片的base64
		isSupportBase64 = ( function() {
			var data = new Image();
			var support = true;
			data.onload = data.onerror = function() {
				if( this.width != 1 || this.height != 1 ) {
					support = false;
				}
			}
			data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
			return support;
		} )(),
		// 检测是否已经安装flash，检测flash的版本
		flashVersion = ( function() {
			var version;
			try {
				version = navigator.plugins[ 'Shockwave Flash' ];
				version = version.description;
			} catch ( ex ) {
				try {
					version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
							.GetVariable('$version');
				} catch ( ex2 ) {
					version = '0.0';
				}
			}
			version = version.match( /\d+/g );
			return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
		} )(),
		supportTransition = (function(){
			var s = document.createElement('p').style,
				r = 'transition' in s ||
						'WebkitTransition' in s ||
						'MozTransition' in s ||
						'msTransition' in s ||
						'OTransition' in s;
			s = null;
			return r;
		})(),
		// WebUploader实例
		uploader;
	if ( !WebUploader.Uploader.support('flash') && WebUploader.browser.ie ) {
		// flash 安装了但是版本过低。
		if (flashVersion) {
			(function(container) {
				window['expressinstallcallback'] = function( state ) {
					switch(state) {
						case 'Download.Cancelled':
							alert('您取消了更新！')
							break;
						case 'Download.Failed':
							alert('安装失败')
							break;
						default:
							alert('安装已成功，请刷新！');
							break;
					}
					delete window['expressinstallcallback'];
				};
				var swf = 'js/expressInstall.swf';
				// insert flash object
				var html = '<object type="application/' +
						'x-shockwave-flash" data="' +  swf + '" ';
				if (WebUploader.browser.ie) {
					html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
				}
				html += 'width="100%" height="100%" style="outline:0">'  +
					'<param name="movie" value="' + swf + '" />' +
					'<param name="wmode" value="transparent" />' +
					'<param name="allowscriptaccess" value="always" />' +
				'</object>';
				container.html(html);
			})($wrap);
		// 压根就没有安转。
		} else {
			$wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
		}
		return;
	} else if (!WebUploader.Uploader.support()) {
		alert( '您的浏览器不支持上传！');
		return;
	}
	function webuploader(opts){
		var defaults = {
			fileNumLimit: 300,
			fileSizeLimit: 200 * 1024 * 1024,    // 200 M
			fileSingleSizeLimit: 50 * 1024 * 1024,    // 50 M
			dnd: '#dndArea',
			paste: '#uploader',
			chunked: false,
			chunkSize: 512 * 1024,
			//禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
			disableGlobalDnd: true
		};
		opts = $.extend(defaults, opts);
		//申明全局变量
		window.$_obj = opts.obj;
		window.filediv=parent.$('.'+$_obj).parent().parent();
		window.filenum=opts.fileNumLimit;
		// 实例化
		uploader = WebUploader.create(opts);
		// 拖拽时不接受 js, txt 文件。
		uploader.on( 'dndAccept', function( items ) {
			var denied = false,
				len = items.length,
				i = 0,
				// 修改js类型
				unAllowed = 'text/plain;application/javascript ';
			for ( ; i < len; i++ ) {
				// 如果在列表里面
				if ( ~unAllowed.indexOf( items[ i ].type ) ) {
					denied = true;
					break;
				}
			}
			return !denied;
		});
		uploader.addButton({
			id: '#filePicker2',
			label: '继续添加',
			name : opts.pick.name
		});
		uploader.on('ready', function() {
			window.uploader = uploader;
		});
		// 当有文件添加进来时执行，负责view的创建
		function addFile( file ) {
			uploader.fileList = uploader.fileList || [];
			uploader.fileList.push(file);
			var $li = $( '<li id="' + file.id + '">' +
					'<p class="title">' + file.name + '</p>' +
					'<p class="imgWrap"></p>'+
					'<p class="progressl"><span></span></p>' +
					'</li>' ),
				$btns = $('<div class="file-panel">' +
					'<span class="cancel">删除</span>' +
					'<span class="rotateRight">向右旋转</span>' +
					'<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
				$prgress = $li.find('p.progressl span'),
				$wrap = $li.find( 'p.imgWrap' ),
				//$info = $('<p class="error"></p>'),
				$info = $('<p class="error"></p>').hide().appendTo($li),
				showError = function( code ) {
					switch( code ) {
						case 'exceed_size':
							text = '文件大小超出';
							break;
						case 'interrupt':
							text = '上传暂停';
							break;
						default:
							text = '上传失败，请重试';
							break;
					}
					//$info.text( text ).appendTo( $li );
					$info.text(text).show();
				};
			if ( file.getStatus() === 'invalid' ) {
				showError( file.statusText );
			} else {
				// @todo lazyload
				$wrap.text( '预览中' );
				uploader.makeThumb( file, function( error, src ) {
					
					var img;
					if ( error ) {
						// 处理不同类型文件代表的图标
						var fileImgSrc = "/statics/js/webuploader/images/";
						var fileext = file.ext;
						if(fileext=='txt'){
							src = fileImgSrc + "text.png";
						}else if(fileext=='zip'){
							src = fileImgSrc + "zip.png";
						}else if(fileext=='docx'){
							src = fileImgSrc + "docx.png";
						}else if(fileext=='pptx'){
							src = fileImgSrc + "pptx.png";
						}else if(fileext=='xlk'){
							src = fileImgSrc + "xlsx.png";
						}else{
							src = fileImgSrc + "settings.png";
						}
						//$wrap.text( '没有预览图123' );
						//return;
					}
					img = $('<img src="'+src+'">');
					$wrap.empty().append( img );
				}, thumbnailWidth, thumbnailHeight );
				percentages[ file.id ] = [ file.size, 0 ];
				file.rotation = 0;
			}
			file.on('statuschange', function( cur, prev ) {
				if ( prev === 'progress' ) {
					$prgress.hide().width(0);
				} else if ( prev === 'queued' ) {
					$li.off( 'mouseenter mouseleave' );
					$btns.remove();
				}
				// 成功
				if ( cur === 'error' || cur === 'invalid' ) {
					console.log( file.statusText );
					showError( file.statusText );
					percentages[ file.id ][ 1 ] = 1;
				} else if ( cur === 'interrupt' ) {
					showError( 'interrupt' );
				} else if ( cur === 'queued' ) {
					percentages[ file.id ][ 1 ] = 0;
				} else if ( cur === 'progress' ) {
					$info.hide();
					$prgress.css('display', 'block');
				} else if ( cur === 'complete' ) {
					//$li.append( '<span class="success"></span>' ); 
				}
				$li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
			});
			$li.on( 'mouseenter', function() {
				$btns.stop().animate({height: 30});
			});
			$li.on( 'mouseleave', function() {
				$btns.stop().animate({height: 0});
			});
			$btns.on( 'click', 'span', function() {
				var index = $(this).index(),
					deg;
				switch ( index ) {
					case 0:
						uploader.removeFile( file );
						return;
					case 1:
						file.rotation += 90;
						break;
					case 2:
						file.rotation -= 90;
						break;
				}
				if ( supportTransition ) {
					deg = 'rotate(' + file.rotation + 'deg)';
					$wrap.css({
						'-webkit-transform': deg,
						'-mos-transform': deg,
						'-o-transform': deg,
						'transform': deg
					});
				} else {
					$wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
				}
			});
			$li.appendTo( $queue );
		}
		// 负责view的销毁
		function removeFile( file ) {
			var arr = [];
			for(var i = 0; i < uploader.fileList.length; i++){
				if(file.id != uploader.fileList[i].id) arr.push(uploader.fileList[i]);
			};
			uploader.fileList = arr;
			var $li = $('#'+file.id);
			delete percentages[ file.id ];
			updateTotalProgress();
			$li.off().find('.file-panel').off().end().remove();
		}
		function updateTotalProgress() {
			var loaded = 0,
				total = 0,
				spans = $progress.children(),
				percent;
			$.each( percentages, function( k, v ) {
				total += v[ 0 ];
				loaded += v[ 0 ] * v[ 1 ];
			} );
			percent = total ? loaded / total : 0;
			spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
			spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
			updateStatus();
		}
		function updateStatus() {
			var text = '', stats;
			if ( state === 'ready' ) {
				text = '选中' + fileCount + '个文件，共' +
						WebUploader.formatSize( fileSize ) + '。';
			} else if ( state === 'confirm' ) {
				stats = uploader.getStats();
				if ( stats.uploadFailNum ) {
					text = '已成功上传' + stats.successNum+ '，个文件'+
						stats.uploadFailNum + '个文件上传失败，<a class="retry" href="#">重新上传</a>失败个文件或<a class="ignore" href="#">忽略</a>'
				}
			} else {
				stats = uploader.getStats();
				text = '共' + fileCount + '个文件（' +
						WebUploader.formatSize( fileSize )  +
						'），已上传' + stats.successNum + '个文件';
				if ( stats.uploadFailNum ) {
					text += '，失败' + stats.uploadFailNum + '个文件';
				}
			}
			$info.html( text );
		}
		function setState( val ) {
			var file, stats;
			if ( val === state ) {
				return;
			}
			$upload.removeClass( 'state-' + state );
			$upload.addClass( 'state-' + val );
			state = val;
			switch ( state ) {
				case 'pedding':
					$placeHolder.removeClass( 'element-invisible' );
					$queue.hide();
					$statusBar.addClass( 'element-invisible' );
					uploader.refresh();
					break;
				case 'ready':
					$placeHolder.addClass( 'element-invisible' );
					$( '#filePicker2' ).removeClass( 'element-invisible');
					$queue.show();
					$statusBar.removeClass('element-invisible');
					uploader.refresh();
					break;
				case 'uploading':
					$( '#filePicker2' ).addClass( 'element-invisible' );
					$progress.show();
					$upload.text( '暂停上传' );
					break;
				case 'paused':
					$progress.show();
					$upload.text( '继续上传' );
					break;
				case 'confirm':
					$progress.hide();
					$( '#filePicker2' ).removeClass( 'element-invisible' );
					$upload.text( '开始上传' );
					stats = uploader.getStats();
					if ( stats.successNum && !stats.uploadFailNum ) {
						setState( 'finish' );
						return;
					}
					break;
				case 'finish':
					stats = uploader.getStats();
					if ( stats.successNum ) {
						Manager.uploadComplete(uploader.fileList);
					} else {
						// 没有成功的图片，重设
						state = 'done';
						location.reload();
					}
					break;
			}
			updateStatus();
		}
		uploader.on('uploadSuccess', function (file,res) {
			var stats = uploader.getStats();
			stats.successNum;//成功上传的 
			 var $file = $('#' + file.id);
			 try {
				if (res.state == 'SUCCESS') {
					var fileurl=res.url;
					if(filenum=='1'){
						//window.$_obj = opts.obj;
						//window.filediv=parent.$('.'+$_obj).parent().parent();
						//window.filenum=opts.fileNumLimit;
						filediv.find("input").val("").val(fileurl);
						$file.append('<span class="success"></span>');
						closelayer();
					}else{
						url=file_ext(file,res);
						var html='<li><img src="'+url+'" data-name="'+res.title+'"><input name="pics[]" value="'+url+'" type="hidden"><i class="fa fa-close" data-name="'+res.title+'" data-url="'+fileurl+'" onclick="delfile(this)"></i></li>';
						filediv.parent().find('.pics > ul').append(html);
						 $file.append('<span class="success"></span>');
						if(stats.successNum==fileCount){
							closelayer();	 
						}
					} 
				} else {
					$file.find('.error').text(res.state).show();
				}
			} catch (e) {
				$file.find('.error').text(res.state).show();
			}
		});
		//判断文件格式
		function file_ext(file,response){
			var fileImgSrc = "/statics/js/webuploader/images/";
			var fileext = file.ext;
			if(fileext=='txt'){
				src = fileImgSrc + "text.png";
			}else if(fileext=='zip'){
				src = fileImgSrc + "zip.png";
			}else if(fileext=='docx'){
				src = fileImgSrc + "docx.png";
			}else if(fileext=='pptx'){
				src = fileImgSrc + "pptx.png";
			}else if(fileext=='xlk'){
				src = fileImgSrc + "xlsx.png";
			}else{
				src = response.url;
			}	
			return src;
		}
		/*uploader.onUploadAccept=function(file, response){
			stats = uploader.getStats();
			if(response.errcode==0){
				alert(response.errmsg);
				return false; 
			}else{
				alert(stats.successNum);
				//按钮class名称
				/*var _obj=opts.obj;
				var div=parent.$('.'+_obj).parent().parent();
				if(opts.fileNumLimit=='1'){
					div.find("input").val("").val(response.fileurl);
					closelayer();
				}else{
					var html='<li><img src="'+response.fileurl+'"><input name="pics[]" value="'+response.fileurl+'" type="hidden"><i class="fa fa-close"></i></li>';
					addElementImg(html);
					function addElementImg(html){
						var pics=div.parent().find('.pics').children('ul');
						pics.append(html);
					}
					closelayer()
				}
				
			}
		}*/
		function closelayer(){
			var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
			parent.layer.close(index)		
		}
		
		uploader.onUploadProgress = function( file, percentage ) {
			var $li = $('#'+file.id),
				$percent = $li.find('.progressl span');
			$percent.css( 'width', percentage * 100 + '%' );
			percentages[ file.id ][ 1 ] = percentage;
			updateTotalProgress();
		};
		uploader.onFileQueued = function( file ) {
			fileCount++;
			fileSize += file.size;
			if ( fileCount === 1 ) {
				$placeHolder.addClass( 'element-invisible' );
				$statusBar.show();
			}
			addFile( file );
			setState( 'ready' );
			updateTotalProgress();
		};
		uploader.onFileDequeued = function( file ) {
			fileCount--;
			fileSize -= file.size;
			if ( !fileCount ) {
				setState( 'pedding' );
			}
			removeFile( file );
			updateTotalProgress();
		};
		uploader.on( 'all', function( type ) {
			var stats;
			switch( type ) {
				case 'uploadFinished':
					setState( 'confirm' );
					break;
				case 'startUpload':
					setState( 'uploading' );
					break;
				case 'stopUpload':
					setState( 'paused' );
					break;
			}
		});
		uploader.onError = function( code ) {
			alert( '提示: ' + code );
		};
		$upload.on('click', function() {
			if ( $(this).hasClass( 'disabled' ) ) {
				return false;
			}
			if ( state === 'ready' ) {
				uploader.upload();
			} else if ( state === 'paused' ) {
				uploader.upload();
			} else if ( state === 'uploading' ) {
				uploader.stop();
			}
		});
		$info.on( 'click', '.retry', function() {
			uploader.retry();
		} );
		$info.on( 'click', '.ignore', function() {
			alert( 'todo' );
		} );
		$upload.addClass( 'state-' + state );
		updateTotalProgress();
	};
	window.Manager = {
		init : function(){
			var __self = this;
			var $manageArea = $('#manage_area'),
				$searchArea = $('#search_area');
			$('#upload_tab,#manage_tab,#search_tab').click(function(){
				var $this = $(this), 
					$par = $this.parent(), 
					id = $this.attr('id'),
					$curArea = $('div.area-checked'),
					$now;
				if($this.hasClass('checked')) return;
				$par.find('li.checked').removeClass('checked');
				$this.addClass('checked');
				if(id == 'upload_tab') $now = $('#upload_area');
				else if(id == 'manage_tab'){
					Manager.showList();
					$now = $manageArea;
				}else{
					Manager.showSearch();
					$now = $searchArea;
				}
				$curArea.fadeOut('fast', function(){
					$curArea.removeClass('area-checked');
					$now.fadeIn('fast').addClass('area-checked');
				});
			});
			$('ul.choose-btns > li.sure').click(function(){
				var $checkedFile = $(this).parents('div.area').find('div.file-list li.checked');
				if($checkedFile.length < 1){
					alert('请选择文件');
				}else __self.sure($checkedFile);
			});
			$('ul.choose-btns > li.cancel').click(function(){
				__self.cancel();
			});
			$searchArea.find('input.submit').click(function(){
				var key = $(this).prev('input:text').val();
				__self.showSearch(key);
			});
			$searchArea.find('input.key').keyup(function(e){
				if(e.keyCode == 13) $(this).next('input.submit').click();
			});
		},
		upload : function(opts){
			this.opts = opts, par = window.parent, type = this.opts.type;
			//判断是否有逗号分隔的
			if(type.indexOf(",")!=-1){
				types=type.split(","); //字符分割
				var typearr= new Array(); //定义一数组 
				for (i=0;i<types.length ;i++ ){
					typearr+="."+types[i]+","; //分割后的字符输出
				}
				this.opts.accept = {
					title : '上传文件',
					extensions : type,
					mimeTypes : typearr
				}
			}else{
				if(type == 'image'){
					this.opts.accept = {
						title : '图片',
						extensions : 'gif,jpg,jpeg,bmp,png',
						mimeTypes : 'image/*'
					}
				}else{
					//所有文件	
				}
			}
			if(Object.prototype.toString.call(this.opts.formData) != '[object Object]') this.opts.formData = {};
			if(par && par.hidoger && par.hidoger.fileManager && typeof par.hidoger.fileManager.additionalData == 'object'){
				this.opts.formData = $.extend(this.opts.formData, par.hidoger.fileManager.additionalData);
			}
			webuploader(opts);
			this.uploader = uploader;
			return this;
		},
		showList : function(){
			if(this.lock1) return;
			this.lock1 = true;
			this.showFiles({type : this.opts.type}, $('#file_all_list'))
		},
		showSearch : function(key){
			if(this.lock2) return;
			this.lock2 = true;
			var data = {};
			if(key) data.key = key;
			data.type = this.opts.type;
			this.showFiles(data, $('#file_search_list'))
		},
		//显示文件列表
		showFiles : function(data, $container){
			var __self = this;
			$container.empty().parents('div.area').addClass('loading');
			data = typeof data == 'object' && data != null ? data : {};
			data = $.extend(data, this.opts.formData);
			$.ajax({
				url : __self.opts.filelistPah,
				data : data,
				dataType : 'json',
				success : function(data){
					var $html = __self.createFile(data);
					if(typeof $html == 'string') $container.append($html);
					else{
						for(var i = 0; i < $html.length; i++) $container.append($html[i]);
					}
				},
				complete : function(){
					__self.lock1 = false;
					__self.lock2 = false;
					$container.parents('div.area').removeClass('loading');
				}
			});
		},
		//生成单个文件
		createFile : function(data){
			var __self = this, str = '<li class="nofile">没有文件</li>';
			if(data && data.list && data.list.length > 0){
				var arr = [], li, i = 0, t, file, ext;
				for(; i < data.list.length; i++){
					t = data.list[i];
					ext = t.name.split('.');
					ext = ext[ext.length - 1];
					file = '<div class="img" title="' + t.name + '"><img width="100%" src="' + t.url + '" /><span class="icon"></span></div>';
					if(!/png|jpg|jpeg|gif|bmp/.test(ext)) file = '<div class="img file-global file-' + ext + '" title="' + t.name + '"><span class="icon"></span></div>';
					$li = $('<li class="file"><div class="file-panel"><span class="cancel">删除</span></div>' + file + '<div class="desc">' + t.name + '</div></li>');
					$li.click(function(){
						__self.checkFile($(this));
					}).data('file', {name : t.name, url : t.url, mtime : t.mtime, list : data.list});
					$li.find('span.cancel').click(function(){
						__self.delFile($(this).parents('li'));
						return false;
					});
					$li.find('div.img').dblclick(function(){
						__self.sure($(this).parent());
					});
					arr.push($li);
				}
				return arr;
			}
			return str;
		},
		checkFile : function($file){
			if(this.$curFile) this.cancelFile(this.$curFile);
			$file.addClass('checked');
			this.$curFile = $file;
		},
		delFile : function($file){
			if(!confirm('确定删除吗?')) return false;
			var file = $file.data('file');
			$file.find('div.file-panel').css('display', 'none');
			var data = {url : file.url, name : file.name, mtime : file.mtime};
			data = $.extend(data, this.opts.formData);
			$.ajax({
				url : this.opts.delPath,
				data : data,
				success : function(data){
					if(data == 1){
						$file.fadeOut(function(){
							$(this).remove();
						});
					}else{
						alert('删除失败');
					}
				},
				complete : function(){
					$file.find('div.file-panel').css('display', 'block');
				}
			});
		},
		cancelFile : function($file){
			if(!$file) $file = this.$curFile;
			if($file) $file.removeClass('checked');
		},
		//选中文件
		sure : function($file){
			var data = $file.data('file'),par = window.parent;
			var filename=data.url.replace(/.*(\/|\\)/, ""); 
			var fileExt=(/[.]/.exec(filename)) ? /[^.]+$/.exec(filename.toLowerCase()) : '';  
			par.fileActive(data,filediv,filenum,fileExt);
			/*var _obj=opts.obj;
			alert(opts.obj);
			var div=parent.$('.'+_obj).parent().parent();
			if(opts.fileNumLimit=='1'){
				div.find("input").val("").val(data.url);
				closelayer();
			}else{
				var html='<li><img src="'+data.url+'"><input name="pics[]" value="'+data.url+'" type="hidden"><i class="fa fa-close"></i></li>';
				div.parent().find('.pics > ul').append(html);
			}*/
			/*if(par && par.hidoger && par.hidoger.fileManager && typeof par.hidoger.fileManager.fileActive == 'function'){
				par.hidoger.fileManager.fileActive(data.url, data.name, data.list);
			}*/
		},
		cancel : function(){
			var par = window.parent;
			if(par && par.hidoger && par.hidoger.fileManager && typeof par.hidoger.fileManager.hide == 'function'){
				par.hidoger.fileManager.hide();
			}
		},
		uploadComplete : function(list){
			var par = window.parent;
			if(par && par.hidoger && par.hidoger.fileManager && typeof par.hidoger.fileManager.complete == 'function'){
				par.hidoger.fileManager.complete(list);
			}
		}
	};
	Manager.init();
});