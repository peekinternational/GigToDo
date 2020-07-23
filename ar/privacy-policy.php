<?php
session_start();
require_once("includes/db.php");
// if(!isset($_SESSION['seller_user_name'])){
	
// echo "<script>window.open('login','_self')</script>";

// }
$login_seller_user_name = $_SESSION['seller_user_name'];
$select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
$row_login_seller = $select_login_seller->fetch();
$login_seller_id = $row_login_seller->seller_id;
$login_seller_type = $row_login_seller->account_type;
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar" class="ui-toolkit">
	<head>
		<title><?= $site_name; ?> - Privacy Policy</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="keywords" content="<?= $site_keywords; ?>">
		<meta name="author" content="<?= $site_author; ?>">
		<?php if(!empty($site_favicon)){ ?>
		<link rel="shortcut icon" href="images/<?= $site_favicon; ?>" type="image/x-icon">
		<?php } ?>
		<!--====== Favicon Icon ======-->
		<?php if(!empty($site_favicon)){ ?>
			<link rel="shortcut icon" href="<?= $site_url; ?>/images/<?= $site_favicon; ?>" type="image/x-icon">
		<?php } ?>
		<!--====== Bootstrap css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/bootstrap.min.css" rel="stylesheet">
		<!--====== PreLoader css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/preloader.css" rel="stylesheet">
		<!--====== Animate css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/animate.min.css" rel="stylesheet">
		<!--====== Fontawesome css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/fontawesome.min.css" rel="stylesheet">
		<!--====== Owl carousel css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/owl.carousel.min.css" rel="stylesheet">
		<!--====== Nice select css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/nice-select.css" rel="stylesheet">
		<!--====== Nice select css ======-->
	  <link href="<?= $site_url; ?>/ar/assets/css/tagsinput.css" rel="stylesheet">
		<!--====== Range Slider css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/ion.rangeSlider.min.css" rel="stylesheet">
		<!--====== Default css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/default.css" rel="stylesheet">
		<!--====== Style css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/style.css" rel="stylesheet">
		<link href="<?= $site_url; ?>/ar/assets/css/style1.css" rel="stylesheet">
		<!--====== Responsive css ======-->
		<link href="<?= $site_url; ?>/ar/assets/css/responsive.css" rel="stylesheet">
		<!-- <link href="styles/bootstrap.css" rel="stylesheet"> -->
		<!-- <link href="styles/custom.css" rel="stylesheet">  -->
		<!-- Custom css code from modified in admin panel --->
		<link href="<?= $site_url; ?>/ar/styles/styles.css" rel="stylesheet">
		<link href="styles/user_nav_styles.css" rel="stylesheet">
		<link href="font_awesome/css/font-awesome.css" rel="stylesheet">
		<link href="styles/owl.carousel.css" rel="stylesheet">
		<link href="styles/owl.theme.default.css" rel="stylesheet">
		<script type="text/javascript" src="js/jquery.min.js"></script>
	</head>
	<body class="all-content">
		<?php
	    if(!isset($_SESSION['seller_user_name'])){
	      require_once("includes/header_with_categories.php");
	    }else{
	    	if($login_seller_type == 'buyer'){
	      	require_once("includes/buyer-header.php");
	    	}else{
	    		require_once("includes/user_header.php");
	    	}
	    } 
	  ?>
		<!-- Preloader Start -->
		<div class="proloader">
			<div class="loader">
				<img src="<?= $site_url; ?>/assets/img/emongez_cube.png" />
			</div>
		</div>
		<!-- Preloader End -->
		<main class="emongez-content-main">

			<section class="container-fluid legal-page">
				<div class="row">
					<div class="container">
						<h3>سياسة الخصوصية</h3>
						<p>
							<span>نحن نتعامل مع خصوصية بياناتك بجدية. تشرح هذه السياسة المعلومات التي نجمعها ، ولماذا نجمعها وكيف نستخدمها. نقوم بتخزين المستخدم أو معلوماتك بشكل آمن ولن نشاركها مع أي شخص. يمكنك تغيير تفضيلاتك في أي وقت.</span>
							<span>موقع منجز اللي هو "احنا" نعتبر المشرفين على المواقع بتاعتنا و تطبيقات الموبايل  اللي بتجمع المعلومات عشان تساعد في تقديم خدمات أفضل ليك و لكل المستخدمين. المعلومات دي ممكن تضم شوية بيانات تقدر تميزك، لكن مش بتبقا دقيقة أوي. الهدف من السياسة دي هو إننا نساعدك تقدر تفهم الأحكام و الشروط اللي بتحكم عملية جمع المعلومات دي و استخدامها.</span>
							<span>هدف السياسة دي : إن منجز بقا "موقع"</span>
							<span>كلمة "موقع" أو "منصة" بتضم منجز،تطبيقات الموبايل، أي موقع أو تطبيقات تابعة لمنجز، أي موقع ليه علاقة بموقع منجز أو أي قناة مسموح ليها بالعمل من موقع منجز.</span>
						</p>
						<h3>1.    احنا مين</h3>
						<p>
							<span><a href="http://www.emongez.com/ar">www.eMongez.com</a> منجز عبارة عن منصة أونلاين يقدر من خلالها المستخدمين يبيعوا و يشتروا المهارات المختلفة على شكل خدمات. عشان كدة، يقدر مقدم الخدمة يبيع الخدمات و كمان يقدر المشتري إنه يشتري الخدمات دي من خلال الموقع.</span>
							<span>بيتم عرض الخدمات دي للمستخدمين بطرق و وسائل مختلفة، زي الكوبونات و الإيصالات اللي ممكن تتبدل بالخدمات المتنوعة.</span>
							<span>ايه البيانات اللي ممكن نجمعها</span>
							<span>بيانات التعريف الشخصية</span>
							<span>لما تشترك عشان تستقبل التحديثات الجديدة بتاعتنا، و دعوات الحدث، و الإيميلات التانية، هتتسأل عن المعلومات الشخصية الأساسية اللي بتميزك، زي اسمك و إيميلك و المنظمة اللي بتنتمي ليها و بلد الإقامة. لو قدمت لوظيفة على موقع منجز، هيتطلب منك شوية معلومات زي اللي موجودة سيرتك الذاتية.</span>
							<span>احنا بنجمع بس المعلومات الشخصية منك عشان نقدر قدملك الخدمة اللي طلبتها. بياناتك الشخصية هتفضل معانا لحد ما تلغي اشتراكك في قايمة الإيميلات الخاصة بينا.</span>
							<span>في أي وقت، تقدر توقف استقبال الإيميلات مننا عن طريق إنك تضغط على رابط "إلغاء الاشتراك" الموجود تحت كل الإيميلات بتاعتنا، أو تتواصل معانا عن طريق الإيميل دة <a href="mailto:info@emongez.com">info@emongez.com</a> . كمان تقدر تطلب مننا نعدل بياناتك الشخصية أو نمسحها خالص.</span>
						</p>
						<h3>بيانات التعريف غير الشخصية</h3>
						<p>
							<span>لما تدخل الموقع عشان تتصفح عامةً، مش بنجمع أي معلومات شخصية منك. المعلومات اللي بنجمعها بس هي الـIP (عنوان بروتوكل الانترنت) نوع المتصفح، نظام التشغيل، الملفات اللي بتحملها، الصفحات اللي بتزورها، و مواعيد و أوقات زيارتك للصفحات دي. المعلومات دي مش بتميزك ولا تعرفك بالتحديد. بيتم استخدام المعلومات دي لتحليل مرور المتصفحين على الموقع عشان نقدر نطور موقعنا، بالإضافة لإننا بنتعامل مع البيانات دي بسرية تامة.</span>
						</p>
						<h3>الكوكيز</h3>
						<p>
							<span>الكوكي دة عبارة عن ملف مكتوب صغير بيحتفظ بيه أي موقع على موبايلك أو الكمبيوتر الخاص بيك لما تزور الموقع دة. عامةً، الكوكيز ليها هدفين، أول هدف هو تطوير خبراتك في التصفح عن طريق إنها تفتكر أفعالك و أولوياتك، أما الهدف التاني هو إنها تساعدنا في تحليل مرور المتصفحين على موقعنا.</span>
							<span>احنا بنستخدم الكوكيز عشان تساعدنا في تحليل مرور المتصفحين على موقعنا، و تساعدنا إننا نطور أداء الموقع و استخدامه، و كمان عشان نقدر نأمن الموقع أكتر. الكوكيز من نوع الطرف التالت بتساعدنا نستخدم تحليلات جوجل عشان نعد و نتابع و نحلل الزيارات على موقعنا. دة بيساعدنا نفهم و نعرف ازاي الناس بيستخدوا الموقع بتاعنا و ايه الأماكن اللي محتاجة تطوير. الكوكيز دي من نوع الطرف التالت مش بتميزك ولا تعرفك بالتحديد.</span>
						</p>
						<h3>اتحكم في الكوكيز</h3>
						<p>
							<span>انت حر على طول إنك تمسح الكوكيز اللي على جهاز الكمبيوتر بتاعك عن طريق إعدادات المتصفح الخاص بيك، و تقدر تمنع المتصفحات التانية من إضافة الكوكيز على الكمبيوتر بتاعك. لكن، لو عملت كدة ممكن تتمنع من استخدام ميزات معينة على الموقع.</span>
						</p>
						<h3>عناوين الـIP</h3>
						<p>
							<span>بالإضافة لكل اللي فات، احنا بنسجل عنوان الـIP بتاعك، اللي بيعتبر عنوان الانترنت بتاع الكمبيوتر الخاص بيك، و بنسجل شوية معلومات زي نوع المتصفح و نظام التشغيل. المعلومات دي بتساعدنا نعرف التوزيع الجغرافي لزوار الموقع بتاعنا و نوع التكنولوجيا اللي بيستخدموها عشان يدخلوا الموقع.</span>
							<span>مثلًا، مسابقات الصور و الفيديو اللي بنعملها بتسمح لعنوان IP معين إنه يصوت مرة واحدة بس و دة بيساعدنا نضمن عدالة المسابقات اللي بننظمها و إن كل متنافس ياخد فرصة متساوية مع باقي المتنافسين. مثال تاني و هو نظام الاشتراك المدفوع الخاص بتحميل النشر اللي بيستخدم عنوان الـIP بتاعك عشان يراقب عملية توزيع النشر الخاصة بينا.</span>
						</p>
						<h3>مواقع التواصل الاجتماعي</h3>
						<p>
							<span>لو شاركت محتوانا على الفيسبوك أو تويتر أو أي حساب ليك على مواقع التواصل الاجتماعي التانية، ممكن نراقب نوع المحتوى بتاعنا اللي بتشاركه. دة بيساعدنا نطور اتصالنا بمواقع التواصل الاجتماعي.</span>
						</p>
						<h3>2. ازاي هنستخدم بياناتك</h3>
						<p>
							<span>احنا مش بنشارك بياناتك مع أي طرف تالت ناوي يستخدمها لأغراض التسويق المباشر، إلا إذا انت قدمت موافقة معينة ليها علاقة بالأمر دة.</span>
							<span>الموقع ممكن يشارك بياناتك الشخصية مع أطراف تالتة لأغراض تانية، لكن دة بيتم في الظروف دي:</span>
						</p>
						<h4>I.	بموافقتك انت</h4>
						<p>
							<span>هنشارك بياناتك الشخصية مع أطراف تالتة برة الموقع لما ناخد الموافقة منك على دة. احنا هنطلب موافقة صريحة بمشاركة أي معلومات شخصية حساسة.</span>
						</p>
						<h4>II. لمصالح مشروعة</h4>
						<p>
							<span>هنشارك بياناتك الشخصية اللي بتعتمد على المصالح القانونية.مثلًا، لما تسجل في واحد من الأحداث بتاعتنا، فيما عدا المصالح اللي بتيجي بعد مصالحك القانونية و حقوقك الأساسية، في الحالة دي هنطلب موافقتك المباشرة.</span>
						</p>
						<h4>III. لمعالجة مكاتب الموقع في مناطق أخرى</h4>
						<p>
							<span>بنوفر بياناتك الشخصية لمكاتب الموقع بتاعنا في المناطق التانية لأغراض قانونية ليها علاقة بالبيزنس، و دة بيكون على أساس إننا عايزين نعرفها بس مش أكتر، بالاعتماد على التعليمات بتاعتنا و الخضوع لسياسة الخصوصية و أي معايير مناسبة ليها علاقة بالتأمين و السرية.</span>
						</p>
						<h4>IV. للمعالجة الخارجية (مقدمو الخدمة)</h4>
						<p>
							<span>ممكن نشغل مقدمين الخدمة و الوكلاء أو المتعاقدين عشان يقدموا الخدمات بالنيابة عننا، و دة بيشمل إدارة الموقع و الخدمات المتاحة ليك. الأطراف التالتة دي ممكن تتدخل أو تعالج بياناتك الشخصية خلال تقديم الخدمات دي.</span>
							<span>الموقع بيحتاج أطراف تالتة من النوع دة،و ممكن يبقوا برة البلد اللي انت دخلت منها الموقع أو استمتعت بالخدمات فيها و كل دة الهدف منه إننا نراعي كل قوانين حماية البيانات و متطلبات الأمان اللي ليها علاقة ببياناتك الشخصية و دة عادةً بيتم عن طريق موافقة مكتوبة.</span>
						</p>
						<h4>V. الامتثال للقوانين</h4>
						<p>هنشارك بياناتك الشخصية مع أطراف تالتة برة الموقع إذا كان عندنا سبب كويس يخلينا نصدق إن الوصول لبياناتك الشخصية أو استخدامها أو حفظها أو الكشف عنها حاجات ضرورية لـ:</p>
						<ul>
							<li>مقابلة أي طلب حكومي إلزامي مقبول ليه علاقة بالقانون و النظام و التشغيل القانوني</li>
							<li>فرض شروط الاستخدام المعمول بها ، بما في ذلك التحقيق في الانتهاكات المحتملة</li>
							<li>اكتشاف أو منع أو معالجة الأنشطة الاحتيالية أو المشكلات الأمنية أو الفنية</li>
							<li>الحماية ضد الإضرار بحقوق أو ملكية أو سلامة الموقع أو مستخدمينا أو الجمهور كما هو مطلوب أو يسمح به القانون</li>
						</ul>
						<h3>3.     ازاي هنحمي بياناتك الشخصية</h3>
						<p>
							<span>احنا مش بنخزن بياناتك الشخصية على موبايلك أو الكمبيوتر بتاعك. احنا بنخزن كل بياناتك الشخصية - و اللي بتضم كل معلوماتك الأساسية و و بياناتك الشخصية التانية – على سيرفرات متأمنة كويس.</span>
							<span>لما تختار كلمة السر اللي بتسمحلك تدخل أجزاء معينة في التطبيق بتاعك، كدة بتكون مسئول عن إنك تحافظ على كلمة السر في سرية تامة. و احنا بنطلب منك بلاش تعرف حد كلمة السر دي.</span>
							<span>بنشفر البيانات اللي بتتنقل من التطبيق أو للتطبيق. بمجرد ما بنستلم بياناتك، هنستخدم إجراءات صارمة و مواصفات الأمان عشان نمنع أي محاولة غير قانونية من الوصول لبياناتك. هناخد كل الخطوات بشكل منطقي لأن دة ضروري عشان نضمن إن بياناتك بتتعامل بأمان و بطريقة مطابقة سياسة الخصوصية.</span>
							<span>بياناتك هتتعالج أو تتخزن برة البلد، لكن دايما هيكون دة مطابق لقوانين الحماية، و بيضم عمليات نقل البيانات بشكل قانوني من خلال الحدود، و دة بيكون خاضع لمعايير الأمن و السلامة.</span>
						</p>
						<h3>4.    ازاي تقدر توصل لبياناتك أو تتواصل معانا؟</h3>
						<p>
							<span>زي ما قولنا فوق، في أي وقت نعتمد على موافقتك لمعالجة بياناتك، بيبقا ليك الحق في سحب موافقتك في الوقت اللي تحبه عن طريق الدخول لإعدادات الموقع أو تطبيقات الموبايل.</span>
							<span>كمان انت ليك حقوق معينة زي:</span>
						</p>
						<ul>
							<li>لما نعالج البيانات اللي بتعتدم على موافقت في أي وقت، تقدر تسحب الموافقة دي في الوقت اللي تحبه. ممكن تعمل كدة عن طريق قسم الخصوصية اللي في التطبيق أو على الموقع.</li>
							<li>تقدر تفهم و تطلب نسخة من بياناتك اللي معانا. المعلومات و الملاحظات اللي معانا ممكن توصل لها من خلال الموقع. عشان تعرف معلومات تانية تطلب دة من خلال الإيميل.</li>
							<li>اطلب تعديل أو مسح البيانات بتاعتك اللي معانا، اللي بتخضع بقيود ليها علاقة بالتزامنا بتخزين التسجيلات لفترات محددة</li>
							<li>اطلب منا تقييد معالجة بياناتك الشخصية أو اعترض على طريقة المعالجة دي</li>
							<li>اطلب إن بياناتك تتوفر على قواعد محمولة</li>
						</ul>
						<p>لو عندك أسئلة تانية، أو استفسارات أو شكاوي خاصة بسياسة الخصوصية ، أو لو حبيت تعمل أي توصيات أو تعليقات عشان نطور الجودة الخاصة بسياسة الخصوصية، من فضلك اتواص معانا عن طريق الإيميل <a href="mailto:info@emongez.com">info@emongez.com</a>.</p>
					</div>
				</div>
			</section>

		</main>

		<?php require_once("includes/footer.php"); ?>
	</body>
</html>