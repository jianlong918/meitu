function upload_single(choose_id,file_classname,input_class,server,pic_width,pic_height){
	var uploader = WebUploader.create({

		// 选完文件后，是否自动上传。
		auto: true,

		// swf文件路径
		swf: '__PUBLIC__/js/Uploader.swf',

		// 文件接收服务端。
		server: server,

		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: {id : choose_id,
			//只能选择一个文件上传
			multiple: false},

		// 只允许选择图片文件。
		accept: {
			title: 'Images',
            extensions: 'jpg,jpeg,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        }


	});


	// 当有文件添加进来的时候
	uploader.on( 'fileQueued', function( file ) {
		$('.'+file_classname).find('div').css('display','');
		$('.'+file_classname).find('div').html(file.name);
		$img=$('.'+file_classname).find('img');

		// 创建缩略图
		// 如果为非图片文件，可以不用调用此方法。
		// thumbnailWidth x thumbnailHeight 为 100 x 100
		var thumbnailWidth=pic_width
		var thumbnailHeight=pic_height
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>不能预览</span>');
				return;
			}

			$img.attr( 'src', src );
			$img.attr( 'src', src );
			$img.attr( 'src', src );
		}, thumbnailWidth, thumbnailHeight );
	});

	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
			$percent = $li.find('.progress span');

		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<p class="progress"><span></span></p>')
				.appendTo( $li )
				.find('span');
		}

		$percent.css( 'width', percentage * 100 + '%' );
	});

	// 文件上传成功，给item添加成功class, 添加成功后路径的隐藏域，用样式标记上传成功。
	uploader.on( 'uploadSuccess', function(file,response) {
		var str_path=response.filepath
		if(str_path){
			$('.'+input_class).val(str_path)
		}

		$( '#'+file.id ).addClass('upload-state-done');
	});

	// 文件上传失败，显示上传出错。
	uploader.on( 'uploadError', function( file ) {
		var $li = $( '#'+file.id ),
			$error = $li.find('div.error');

		// 避免重复创建
		if ( !$error.length ) {
			$error = $('<div class="error"></div>').appendTo( $li );
		}

		$error.text('上传失败');
	});

	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on( 'uploadComplete', function( file ) {
		$( '#'+file.id ).find('.progress').remove();
	});
}











