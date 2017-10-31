<?php

	function createData(){
		$courseData	=
				array(
						array('name' => 'Xây dựng website responsive với Bootstrap'	, 'image' => 'bootstrap.jpg'	, 'description' => 'Đây là một trong những CSS framework lớn nhất và thông dụng nhất hiện nay. Bootstrap framework sẽ giúp các bạn xây dựng nhanh giao diện web theo đúng chuẩn của w3C và ngoài ra hỗ trợ bạn làm web trên mọi thiết bị khác nhau như laptop, tablet, smartphone (web responsive'),
						array('name' => 'Xây dựng website tĩnh với Dreamweaver'		, 'image' => 'html.jpg'			, 'description' => 'Như chúng ta đã biết website đã trở thành một thành phần không thể thiếu của thời đại công nghệ thông tin ngày nay. Một tổ chức, một doanh nghiệp, một cơ quan hay thậm chí một cá nhân đều cần một website cho công việc của mình. Mặt khác việc có thể xây dựng một website lại là một vấn đề không đơn giản, nó đòi hỏi người xây dựng phải có kiến thức về thiết kế và lập trình web.'),
						array('name' => 'Lập trình Joomla 2.5'						, 'image' => 'joomla.jpg'		, 'description' => 'Joomla CMS là một hệ thống quản lý dữ liệu được đánh giá rất cao hiện nay, Joomla rất dễ sử dụng để xây dựng một website và rất thân thiện với người sử dụng. Nhưng để lập trình tạo ra các thành phần mở rộng như Component, Module, Plugin, Template... cho nó thì không đơn giản một chút nào vì cấu trúc Joomla CMS khá '),
						array('name' => 'Khóa học lập trình jQuery (jQuery Master)'	, 'image' => 'jquery.jpg'		, 'description' => 'Nếu nói đến lập trình web, chúng ta nghĩ ngay đến một ngôn ngữ lập trình không thể thiếu trong một website đó là Javascript. Javascript giúp chúng ta thực hiện nhưng thao tác, hiệu ứng mà các ngôn ngữ lập web như PHP, ASP, JSP… khó mà thực hiện được.'),
						array('name' => 'Xây dựng web chat với NodeJS'				, 'image' => 'node.jpg'			, 'description' => 'Khóa học jQuery này cũng bổ xung thêm cho các bạn một Javascript framework khác đó là NodeJS qua một ví dụ thực tế là ứng dụng Web chat. Với kiến thức và ví dụ của NodeJS các bạn có thể dễ dàng làm phần Chat support trên website của chính mình'),
						array('name' => 'Khóa học lập trình PHP'					, 'image' => 'php.jpg'			, 'description' => 'PHP đã và đang trở thành một ngôn ngữ lập trình phổ biến trong các ứng dụng web ngày nay. Với các ưu điểm như miễn phí, dễ đọc, thao tác tốt với các hệ quản trị cơ sở dữ liệu, cộng đồng sử dụng rộng rãi, thư viện phong phú ... PHP ngày càng phát triển và việc học PHP đã trở nên đặc biệt cần thiết đối với bất kỳ lập trình '),
						array('name' => 'Khóa học lập trình Wordpress'				, 'image' => 'wordpress.jpg'	, 'description' => 'WordPress là một mã nguồn web mở để quản trị nội dung (CMS – Content Management System ) và cũng là một nền tảng blog (Blog Platform) được viết trên ngôn ngữ PHP sử dụng hệ quản trị cơ sở dữ liệu MySQL được phát hành đầu tiên vào ngày 27/5/2003 bởi Matt Mullenweg và Mike Little.'),
						array('name' => 'Khóa học lập trình Zend Framework 1.X'		, 'image' => 'zend.jpg'			, 'description' => 'Zend Framework là một thư viện các lớp được xây dựng trên nền tảng ngôn ngữ PHP, theo hướng OOP và được công ty Zend phát triển. Zend Framework được định hướng theo mô hình MVC và là một PHP framework ra đời khá trễ, chính vì vậy ZF đã thừa hưởng những tinh hoa của các framework khác và tránh khỏi những sai '),
				);
		return $courseData;
	}
	
	
	function getElements($arrData, $position, $totalItems){
		$newArray = array_slice($arrData, $position, $totalItems);
		return $newArray;
	}
