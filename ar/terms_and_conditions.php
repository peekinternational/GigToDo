<?php
  session_start();
  require_once("includes/db.php");
  require_once("social-config.php");
  // if(!isset($_SESSION['seller_user_name'])){
    
  //  echo "<script>window.open('login','_self')</script>";
    
  // }

  $login_seller_user_name = $_SESSION['seller_user_name'];
  $select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
  $row_login_seller = $select_login_seller->fetch();
  $login_seller_id = $row_login_seller->seller_id;
  $login_seller_type = $row_login_seller->account_type;
  ?>
<!DOCTYPE html>
<html lang="en" class="ui-toolkit">
  <head>
    <title><?= $site_name; ?> - Terms and Conditions.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $site_desc; ?>">
    <meta name="keywords" content="<?= $site_keywords; ?>">
    <meta name="author" content="<?= $site_author; ?>">
    
    <!--====== Bootstrap css ======-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--====== PreLoader css ======-->
    <link href="assets/css/preloader.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <!--====== Fontawesome css ======-->
    <link href="assets/css/fontawesome.min.css" rel="stylesheet">
    <!--====== Owl carousel css ======-->
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
    <!--====== Nice select css ======-->
    <link href="assets/css/nice-select.css" rel="stylesheet">
    <!--====== Default css ======-->
    <link href="assets/css/default.css" rel="stylesheet">
    <!--====== Style css ======-->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style1.css" rel="stylesheet">
    <!--====== Responsive css ======-->
    <link href="assets/css/responsive.css" rel="stylesheet">
    <!-- <link href="styles/bootstrap.css" rel="stylesheet"> -->
    <!-- <link href="styles/styles.css" rel="stylesheet"> -->
    <!-- <link href="styles/categories_nav_styles.css" rel="stylesheet"> -->
    <!-- <link href="font_awesome/css/font-awesome.css" rel="stylesheet"> -->
    <!-- <link href="styles/owl.carousel.css" rel="stylesheet"> -->
    <!-- <link href="styles/owl.theme.default.css" rel="stylesheet"> -->
    <?php if(!empty($site_favicon)){ ?>
    <link rel="shortcut icon" href="<?= $site_url ?>/images/<?= $site_favicon; ?>" type="image/x-icon">
    <?php } ?>
    <link href="styles/sweat_alert.css" rel="stylesheet">
    <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
    <!-- <script src="js/ie.js"></script> -->
    <script type="text/javascript" src="js/sweat_alert.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
  </head>
  <body class="all-content">
    <!-- Preloader Start -->
    <div class="proloader">
      <div class="loader">
        <img src="assets/img/emongez_cube.png" />
      </div>
    </div>
    <!-- Preloader End -->
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
    <main class="emongez-content-main">
      <section class="container-fluid legal-page">
        <div class="row">
          <div class="container">
            <h3>الشروط و الأحكام</h3>
            <p>
              <span>الاتفاقية اتراجعت آخر مرة يوم 17 يونيو 2019</span>
              <span>موقع منجز بيرحب بيك</span>
              <span>احنا بنوفرلك الدخول لموقعنا (هنتكلم عنه تحت) حسب اتباع شروط الخدمة، اللي ممكن نحدثها من وقت للتاني من غير ما نبعتلك.</span>
              <span>من خلال تصفح الأماكن العامة أو الدخول للموقع و استخدامه، انت كدة بتعترف إنك قريت و فهمت و وافقت إنك تلتزم بالشروط و الأحكام بتاعت شروط الخدمة و كمان شروط و أحكام سياسة الخصوصية، اللي بيشملها المرجع (بشكل عام "الاتفاقية"). لو مش موافق على أي شرط من دول، من فضلك بلاش تستخدم الموقع.</span>
            </p>
            <h3>يلا نقدملك نفسنا !!!</h3>
            <ul class="list-style">
              <li>القبول : لما تستخدم الموقع أ, الخدمات بأي طريقة، لازم تلتزم بشروط الخدمة دي، بالإضافة لشروط الاتفاقية اللي ذكرناها فوق. لو مش موافق على الشروط دي بلاش تستخدم الموقع أو الخدمات. لو قبلت الشروط دي بالنيابة عن شركة أو منظمة أو هيئة حكومية أو أي كيان قانوني تاني، انت كدة بتمثل الجهة دي و بتضمن إنك:
                <ul>
                  <li>مفوض تعمل كدة</li>
                  <li>الكيان دة موافق إنه يلتزم بالشروط</li>
                  <li>ولا انت ولا الكيان هتتمنعوا من استخدام الخدمات أو قبول الشروط تحت سقف قوانين الاختصاص القضائي اللي ممكن تتطبق</li>
                </ul>
              </li>
              <li>المدى: الشروط دي بتحكم استخدامك للموقع و الخدمات. غير كدة، الشروط دي مش بتتطبق على منتجات و خدمات الطرف التالت اللي بتحكمها شروط الخدمات الخاصة بيهم.</li>
              <li>الأهلية: في خدمات معينة على الموقع مش مسموح بيها للأطفال تحت الـ13 سنة أو لأي مستخدم منعناه أو مسحناه من النظام لأي سبب كان. بالإضافة لكدة، المستخدمين ممنوعين من بيع حساباتهم أو التجارة فيها أو نقلها لأي طرف غيرهم.</li>
            </ul>
            <h3>ازاي نقدر نخدمك؟</h3>
            <p>
              <span>موقع منجز <a href="http://www.emongez.com/ar">www.eMongez.com</a> منصة أونلاين للمستخدمين عشان يبيعوا و يشتروا المهارات في شكل خدمات. وبيترتب على دة، مقدم الخدمة يقدر يبيع الخدمات و كمان المشتري يقدر يشتري الخدمات من خلال الموقع.</span>
              <span>الخدمات بتتقدم للنمستخدمين بطرق مختلفة زي الكوبونات و الإيصالات اللي يقدروا يستبدلوها بالخدمات المتنوعة.</span>
            </p>
            <h3>ازاي تقدر تشتري أي خدمة من الموقع؟</h3>
            <p>
              <span>طيب، انت هنا مشتري، و احنا بنشكرك على استخدامك لموقعنا، انت بتدور على فريلانسر ماهر أو محترف عشان يدعم البيزنس بتاعك و العلامة التجارية الخاصة بيك.</span>
              <span>تقدر تتصفح الموقع و تختار البائع أو مقدم الخدمة المناسب ليك، و عشان تحدد أي طلب و تشتري أي خدمة من الموقع دة بيتم بينك و بين موقع منجز. لما تيجي تطلب، و انت بتعرفنا بيياناتك لازم تكون مركز جدًا و تبقا ضامن إن البيانات اللي قدمتها دي صح و دقيقة.</span>
            </p>
            <p>
              <span>أونلاين: ادفع على موقع منجز باستخدام الكريديت كارد، أو كرات الخصم، أو حساب الـPayPal .</span>
              <span>موقع منجز بيقبل أي كريديت كارد أو كروت الخصم سواء كانت دولية أو حتى محلية و دة عن طريق استخدام الفيزا أو الماستر كارد الخاصة بيك.</span>
              <span>من فضلك تتأكد إن البنك اللي بتتعامل معاه بيسمح بالمعاملات أونلاين.</span>
            </p>
            <p>
              <span>محفظة الموبايل: ادفع علىموقع منجزباستخدام محفظة الموبايل بتاعتك.</span>
              <span>موقع منجز بيتعامل مع كل مقدمين الخدمات الخاصة بمحفظة الموبايل في مصر.</span>
              <span>اتأكد من إن محفظتك فيها فلوس كفاية عشان تشتري.</span>
              <span>لو عايز تملا محفظتك، من فضلك اتصل بمقدم الخدمة الخاصة بمحفظة الموبايل بتاعتك.</span>
            </p>
            <p>
              <span>كاش: اختار أي طريقة لدفع الفلوس كاش من موقع منجز.</span>
              <span>حابين نقولك إن شريكنا في مصر R2S  هيتواصل معاك عشان يوضحلك ازاي تدفع كاش.</span>
              <span>لازم تتأكد إنك كتبت عنوانك صح عشان تضمن تحصيل الفلوس في اليوم اللي بعده.</span>
            </p>
            <p>
              <span>الطريقة المحلية: ادفع على منجز من خلال أكبر شبكات نقط الكاش.</span>
              <span>ادفع في الوقت والمكان المفضلين ليك في جميع أنحاء مصر.</span>
              <span>تقدر تحققق من أقرب نقطة دفع لما تزور موقع مقدمين الخدمات.</span>
            </p>
            <p>
              <span>لما تختار خدمة معينة عايز تشتريها من المشترين الموجودين على الموقع، اضغط على زراز "أطلب" عشان تكمل عملية الشراء.</span>
              <span>الخدمات اللي بتشتريها من الموقع بتبقا مقصورة على استخدامك انت بس و كمان بتبقا ضامن إن أي خدمة بتشتريها مش هتبيعها تاني و إنك لازم تتصرف باعتبارك مالك مش وكيل لطرف معين عشان تستفيد بالخدمات دي.</span>
            </p>
            <p>
              <span>لمات يجي تشتري من الموقع ممكن يتطلب منك تفتح حساب مشتري و تدخل اسم المستخدم و كلمة لاسر. لازم تاخد بالك من تفاصيلك و ماتعرفش أي طرف التفاصيل دي.</span>
              <span>احنا بنقوم بكل الاهتمام اللي نقدر عليه عشان نحمي بياناتك و تفاصيل الدفع لكن احنا مش مسؤولينلو أي طرف تالت قدر يوصل للبيانات دي و انت كمان هتتعرض للخسارة.</span>
            </p>
            <p>
              <span>تقدر تحدد طلبك اللي بيخضع لوفرة الخدمة و موافقتنا الخاصة. بعد تحديد الطلب أونلاين، هتستقبل إيميل موافقة مننا. دة عبارة عن إيميل أوتوماتيك بالموافقة بيضمن إن طلبك اتأكد. لو استقبلت إيميل مواقة، دة مش معناه إننا هننفذ طلبك.</span>
            </p>
            <p>
              <span>أول ما بنبعت إيميل الموافقة هنتأكد من وجود الخدمة اللي طلبتها و ناخد إذن من الشركة صاحبة الكريديت كارد بتاعتك بسحب المبلغ المعين على الصفحة المختصرة و هنتواصل معاك بإيميل تاني. لو الخدمات متاحة و بيانات الطلب صح، الإيميل دة هيعتبر موافقة مننا على الطلب و هنحدد تفاصيل التسليم و نوافق على سعر الخدمة اللي اشتريتها.</span>
            </p>
            <p>
              <span><strong>ممكن نرفض تنفيذ طلبك لو:</strong></span>
            </p>
            <ul>
              <li>الخدمة اللي بطبتها مش موجودة أو وقفناها</li>
              <li>الكريديت كارد بتاعتك أو حساب الـPayPal مش بيدوا إذن بدفع مبلغ الشراء</li>
              <li>بتفتقد للأهلية الخاصة بالمعايير اللي وضحناها فوق</li>
            </ul>
            <p>
              <span>الطلبات ممكن تتلغي من جانب أي طرف حسب سياسة الموقع. لو في مشتري بيلغي الطلبات باستمرار أو بيرفع شكاوى كتير هنراقبه من قريب و ممكن نحذفه من الموقع خالص.</span>
              <span>كل الأسعار اللي على الموقع صح لكن احنا عندنا الحق في تغييرها في المستقبل. بردو عندنا الحق إننا نغير الخدمات المتاحة للبيع على الموقع و كمان ممكن نوقف أي خدمة.</span>
              <span>من خلال نظام الموقع المحكم بتاعنا تقدر تتواصل مع البائعين أو مقدمين الخدمة عشان تحسن خبراتك في البيع.</span>
            </p>
            <p>
              <span>المشترين ممكن مايكتبوش تعليق لكن يقدروا يقيموا الخدمة بتاعتك. بردو عندهم الحق مايسيبوش مراجعة او تقييم لخدمتك خالص. يعني زي ما المشترين عايزين. رسالة المرة الواحدة اللطيفة يعني إنك تطلب باحترام تقييم أو تعليق على خدمتك حاجة كويسة، عشان ردود الفعل على خدماتك مهمة في النهاية ! ماتزعجش المشترين إنهم يقيموا خدماتك. إزعاج قاعدة مجتمع العملاء حاجة مش كويسة و ضد الشروط، و بردو بتنعكس بالسلب على ملف البيزنس الشخصي بتاعك.</span>
            </p>
            <p>
              <span>احنا سعداء إننا ندعمك، لو في أي مشكلة تقدر تتواصل مع فريق المكتب الخلفي الخاص بينا لأي استفسار أو مشكلة.</span>
            </p>
            <h3>ازاي تقدر تقدم خدماتك و تكسب فلوس !</h3>
            <p>
              <span>باعتبارك بائع أو مقدم خدمة بيعرض بيع خدماته على الموقع، كل دة بيكون بينك (كمقدم خدمة) و بين موقع منجز. لما تيجي تقدم بيناتك لازم تاخد بالك و تضمن إن المعلومات اللي قولتها صح و دقيقة.</span>
              <span>أول ما تختار الخدمة اللي عايز تعرضها من خلال الموقع، بتبقا ملتزم إنك تبني سمعة و ملف شخصي و بيزنس أونلاين ناجحين باعتبارك مواطن رقمي عالمي.</span>
              <span>الخدمات اللي بتتعرض على الموقع بتتقدم من خلالك انت بس و بتكون ضامن لما تيجي تعرض خدمة تاني إنك تتصرف باعتبارك مالك مش وكيل لأي طرف غيرك.</span>
              <span>لما تشتري من الموقع هيتطلب منك تفتح حساب مشتري و تدخل اسم المستخدم و كلمة السر. لازم تحافظ على بياناتك و معلوماتك في أمان و ماتقولش لأي حد عليها.</span>
              <span>احنا بنقوم بكل الاهتمام اللي نقدر عليه عشان نحمي تفاصيل طلبك و بيانات الدفع لكن احنا مش مسؤولين لو أي طرف تالت قدر يوصل للبيانات دي و كمان انت هتتعرض للخسارة زينا.</span>
              <span>تقدر تعرض الخدمة من خلال إنك تعمل Gig حسب متطلبات الخدمة، و مواصفاتنا و موافقتنا الخاصة. لما تعمل عرض عشان تقدم الخدمات أونلاين، هنبعتلك إيميل نأكدد إننا وافقنا على عرضك لتقديم الخدمات.</span>
            </p>
            <p>
              <span><strong>ممكن نرفض تنفيذ طلبك لو:</strong></span>
            </p>
            <ul>
              <li>العرض اللي عملتهعشان تقدم الخدمة مخالف لقواعد و نظام الموقع</li>
              <li>بتفتقد للأهلية الخاصة بالمعايير اللي وضحناها فوق</li>
            </ul>
            <p>
              <span>عشان تسحب ربحك، لازم يبقا عندك حساب تم عليه على الأقل عملية سحب واحدة من خلال الموقع. حاليًا، تقدر تزود بيانات الـPayPal أو التحويل المصرفي على ملفك الشخصي.</span>
              <span>أقل مبلغ ممكن تسحبه هو 100 جنيه مصري. احنا حددنا المبلغ دة شان نقلل من استهلاك ربحك في تقييم المحادثات و رسوم عبور الحدود و كل الرسوم المالية التانية اللي بيفرضها مقدمين الخدمة من الطرف التالت. احنا بنشتغل باستمرار عشان نلاقي طرق تاخد بيها فلوسك أسرع، و بأقل رسوم ممكنة. الرسوم هتختلف حسب مقدَّم الدفع المرشح الخاص بيك.</span>
            </p>
            <p>
              <span>إجمالي الربح على محفظتك الافتراضية (بعد خصم رسوم الطرف التالت) هتتحول لحساب الدفع المرشح بتاعك. عمليات السحب بتكون نهائية و مفيش رجوع فيها. مش مسموح بترجيع الفلوس مرة تاني أو تغيير عملية السحب بمجرد ما تبدأ. الوقت اللي بيتاخد لتحويل الفلوس على حسابك المرشح بيعتمد على شركاء الدفع من الطرف التالت.</span>
            </p>
            <p>
              <span>احنا بشر. لو حالتك محتاجة اهتمام زيادة، من فضلك اتواصل مع فريق دعم الموقع من خلال إنك تراسل المركز و احنا هنعمل كل حاجة في وسعنا عشان نساعدك توصل للربح بتاعك. كل ما بنكبر في البيزنس، مفاوضاتنا هتكبر معانا من خلال مقدمين الدفع.</span>
            </p>
            <h3>ايه الرسوم اللي بنفرضها؟</h3>
            <p>
              <span>حاليًا مش بنفرض أي رسومخالص. أيوة، انت بتحتفظ بـ100% من أرباحك.</span>
              <span>موقع منجز هيعمل إيداع بـ100% من أرباحك في محفظتك الافتراضية</span>
            </p>
            <h3>ازاي ترجع فلوسك تاني؟</h3>
            <p>
              <span>نقدر نرجع فلوس طلباتك الملغية و نبعتهم تاني لمقدم الدفع الخاص بيك. في الأول، فلوس الطلب الملغي بترجع لمحفظة المشتري الافتراضية باعتبارها رصيد للي هيشتريه من الموقع في المستقبل. هيتخصم من الفلوس اللي هترجعلك رسوم المعالجة اللي اتدفعت.</span>
            </p>
            <h3>حقوقنا</h3>
            <p>
              <span>احنا بنحتفظ بالحق لكن مش الاعتراض، عشان نقلل من استخدام الخدمات أو الاستفادة منها من أي شخص، أو إقليم جغرافي، أو ولاية. ممكن نستخدم الحق دة حسب كل حالة. و عندنا الحق في وقف أو مسح أي خدمة في أي وقت.</span>
              <span>احنا مش بنضمن إن جودة الخدمات أو المعلومات اللي بتتقدملك هتحققلك توقعاتك أو هتسببلك مشكلة أو خلل ممكن يتصحح.</span>
            </p>
            <p>
              <span><strong>شوية شروط عاملة...من فضلك تابعها</strong></span>
            </p>
            <ul>
              <li>المفروض تستخدم الموقع لأهداف قانونية و تحترم كل القوانين اللي ممكن تتطبق خلال استخدام الموقع</li>
              <li>بلاش تحمل أي محتوى فيه الصفات دي:</li>
              <li>التشهير أو انتهاك أي علامة تجارية أو حقوق النشر أو حقوق الملكية لأي شخص أو يكون بيأثر على خصوصية أي حد، أو فيه عنف و خطابات كراهية أو فيه أي معلومات حساسة عن أي شخص.</li>
              <li>بلاش تراقب أي شخص أو تتنمر عليه أو تزعجه</li>
              <li>المفروض ماتبيعش أو تشتري حسابات المستخدمين</li>
              <li>احترم دايمًا آراء و طموحات و أهداف المستخدمين التانيين</li>
              <li>بلاش تدخل الموقع أو تستخدمه عشان تعمل بحث سوق عن أي منافس ليك في البيزنس</li>
              <li>اتعامل مع المستخدمين التانيين بطيبة و تواضع</li>
              <li>ماتحكمش على المستخدمين</li>
              <li>خليك نشيط و داعم و مساهم</li>
              <li>بلاش تشوه أو تدعي شخصية أي حد أو كيان معين لأهداف مش حقيقية ولا قانونية</li>
              <li>خلي عقلك واسع و اسمع للمشتركين و خليهم يسمعوا منك </li>
              <li>إوعى تستخدم أي فيروس أو أداة تهكير عشان تتدخل في إدارة الموقع أو البيانات و الملفات اللي عليه</li>
              <li>مش هتقدر تستخدم أي جهاز أو أداة تسرق بيها البيانات أو أي حاجة أوتوماتيكية عشان تدخل الموقع لأي هدف من غير إذن</li>
              <li>لازم تقولنا على أي محتوى مش مناسب أو تقولنا على أي حاجة تلاقيها مخالفة للقانون</li>
            </ul>
            <p>
              <span>احنا بنحتفظ بحقنا في الحرية المطلقة إننا نمنع أي مستخدم من الوصول للموقع أو أي جزء من الموقع سواء لاحظناه أو لا.</span>
            </p>
            <h3>لسة في مشكلة؟</h3>
            <p>
              <span>من فضلك اتواصل مع فريق الدعم الخاص بينا عشان يحللك مشكلتك بأفضل طريقة ممكنة. لو في أي أزمة أو مشكلة بخصوص الدفع أو الطلب، اتواصل معانا عن طريق الإيميل دة <a href="mailto:Support@eMongez.com">Support@eMongez.com</a></span>
              <span>ممكن ترفع شكوى بسبب أي عطل أو مشكلة في الطلب ، مثلا في حالة إن المشتري أو مقدم الخدمة مش بيردوا، أو بسبب أي أزمة أو مشكلة تانية.</span>
              <span>المشتري يقدر يتواصل مع مقدم الخدمة عشان يلاقوا حل للمشكلات من خلال مركز حل المشكلات و كمان يقدروا يتواصلوا معانا بخصوص الأمور اللي لسة ماتحلتش.</span>
            </p>
            <h3>تعريفات</h3>
            <ul>
              <li>"الاتفاقية" تعتبر مرجع الشروط و الأحكام و سياسة الخصوصية و استمارات الطلب و تعليمات الدفع اللي بتتقدملك.</li>
              <li>"سياسة الخصوصية" معناها <a href="http://www.emongez.com/ar">https://eMongez.com /</a> سياسة الخصوصية / السياسة اللي وضحناها على موقعنا اللي بتشرح بالتفاصيل ازاي بنجمع و نخزن بياناتك الشخصية.</li>
              <li>"البضاعة" أو "المنتجات" بتضم أي منتج أو بضاعة ممكن نعرضها للبيع على الموقع بتاعنا من وقت للتاني</li>
              <li>"الخدمة" أو "الخدمات" هي مرجع لأي خدمة هنتكلم عنها تحت، اللي ممكن احنا نوفرها و ممكن تطلبها من خلال موقعنا.</li>
              <li>"المستخدم" أو "انت" أو "المستخدم الخاص بيك" كل دة بيشير للشخص اللي بيدخل الوقع عشان يستفيد بيأي خدمة أو يعرض خدمة معينة من خلالنا سواء كان الشخص دة بائع (مقدم خدمة) أو مشتري. بردو المستخدم دة ممكن يبقا جماعة أو شركة أو تاجر عنده تجارته الخاصة بيه، أو شخص ، أو مؤسسة أو اتحاد بيستفيدوا من الخدمات على الموقع.</li>
              <li>"المشتري" هو المستخدم / الشخص اللي بيسجل نفسه على الموقع مشتري عشان يشتري الخدمات من خلال الموقع و بيوقع على اتفاقية المشترين مع الموقع.</li>
              <li>"اتفاقية المشترين" هي الاتفاقية اللي بتتوقع ما بين موقع منجز و المشتري</li>
              <li>"البائع" هو المستخدم / الشخص اللي بيسجل نفسه على الموقع بائع عشان يقدر يقدم خدماته و يبيعها من خلال الموقع و بيوقع على اتفاقية البائعين مع الموقع.</li>
              <li>"اتفاقية البائعين" هي الاتفاقية اللي ببتوقع ما بين موقع منجز <a href="http://www.emongez.com/ar">www.eMongez.com</a> و مقدم الخدمة </li>
              <li>"احنا" أو "عننا" أو "حاجتنا" أو "الشركة" كل دول بيشيروا لاسم الشركة و عنوانها</li>
              <li>"الموقع" هو  <a href="http://www.emongez.com/ar">www.eMongez.com</a> و بيضم تطبيقات الموبايل الخاصة بالشركة، و أي موقع أو تطبيقات تابعة، و أي موقع خاص بفروع الشركة أو أي قناة سمحت ليها الشركة إنها تشتغل</li>
              <li>"القانون اللي ممكن يتطبق" يعني احترام أي شخص، أي تشريع، و قانون، و سمعة، و إعلان،و قاعدة، و حكم، و قرار ، و اللائحة التنفيذية للقانون، و موافقة السلطة المعنية، و قرار الحكومة، و الطلب، و التوجيه، و الإرشادات و المتطلبات و القيود الحكومية، أو أي صيغة مشابهة سواء لقانون أو تفسير أو أو حكم ليه سلطة القانون على الحاجات اللي ذكرناها فوق، عن طريق أي سلطة معنية أو متطلبات تانية لأي سلطة حكومية أو تنظيمية اللي بيخضع ليها الفرد</li>
              <li>"الإعلان" هو الوسط اللي يقدر من خلاله البائع أو مقدم الخدمة إنه يعرض خدماته على الموقع</li>
              <li>"الصفقة" معناها إن المشتري يشتري إعلان مقدم الخدمة المتاح على الموقع</li>
              <li>"حساب البائع" و دة عبارة عن حساب إلكتروني بيفتحه المستخدم من خلال الموقع عشان يعرض عليه خدماته في الموقع</li>
              <li>"حساب المشتري" هو حساب إلكتروني بيفتحه المستخدم من خلال الموقع عشان يقدر يشتري الخدمات المعروضة من البائعين و مقدمين الخدمة المتنوعين على الموقع</li>
              <li>"المحفظة الافتراضية" عبارة عن محفظة بيحتفظ فيها الموقع بأرباح البائع</li>
            </ul>
            <h3>استبعاد المسئولية</h3>
            <p>
              <span>موقعمنجزمشهيتحمللاهوولامديرينهأوموظفينهأوشركاءهأووكلاءهأوموردينهأوالشركاتالتابعةليه،بأيحالمنالأحوال،أيأضرارغيرمباشرةأوعرضيةأوخاصةأوفيهاأحداثكتيرأو،ودةبيضمعلىسبيلالمثالمشالحصر،خسارةالأرباحأوالبياناتأوالاستخدامأوالنيةالحسنة،أوغيرهامنالخسائرالليمشملموسة اللي بتنتج عن :</span>
            </p>
            <ul>
              <li>وصولكللخدمةأواستخدامهاأوعجزكعنالوصولليهاأواستخدامها</li>
              <li>أيسلوكأومحتوىلأيطرفثالثعلىالخدمة</li>
              <li>أيمحتوىأخدتهمنالخدمة</li>
              <li>الوصولالليمشمصرحبيهأواستخدامأوتغييرعملياتالإرسالأوالمحتوىالخاصبيك،سواءكانحسبالضمانأوالعقدأوالخطأالمدني (الليبيشملالإهمال)</li>
            </ul>
            <p>
              <span>أوأينظريةقانونيةتانية،سواءكناعارفينإنالخطأدةاحتماليقعولالا،وحتىلوكانتمعالجةالمشكلةالمنصوصعليهافيالاتفاقيةديفشلتفيتحقيقالغرضالأساسيمنها.</span>
            </p>
            <h3>قيود الاستخدام</h3>
            <p>
              <span>الاتفاقيةديخاصةبالخدمات،وحسبالتفاقيةديمشهتاخدترخيصلأيبرنامج. مشمسموحلك،بشكلمباشرأوغيرمباشر: إنكتعملهندسةعكسيةأوتفكشفرةأوفكالعناصرأومحاولةاكتشافكودالمصدرأورمزالمادةأوالبنيةالأساسيةأوالأفكارأوالخوارزمياتالليبتشملهاالخدماتأوأيبرنامجأووثائقأوبياناتليهاعلاقةبالخدمات "البرامج" ؛أوتعديلأوترجمةأوتشكيلأعمالمشتقةحسبالخدماتأوأيبرنامج؛أونسخ (إلاالأغراضالأرشيفية) أوتوزيعأوتعهدأوتخصيصأونقلحقوقأوتحويلهالخدماتأولأيبرنامج؛أواستخدامالخدماتأوأيبرنامجعشانتحققأهدافمشاركةالوقتأوأهدافمكتبالخدمةوغيرهامنمصالحأيطرفثالث؛أومسحأيإشعاراتأوعلاماتملكية.</span>
            </p>
            <h3>تعديلاتعلىالخدمةوالأسعار</h3>
            <p>
              <span>احنابنحتفظبالحق،حسبتقديرالخدمةوالأسعار،إننانغيرأونعدلأونضيفأونشيلأجزاءمنالشروط (وبنشيرليهاباسم "التغييرات") فيأيوقت. ممكننبلغكبالتغييراتديعنطريقإننانبعتلكإيميلللعنوانالليمتحددفيحسابكأوعنطريقإنناننشرنسخةاتراعتمنالشروطالتيبتشملالتغييراتفيموقعها. استخدامكللموقعأوالخدماتبشكلمستمربعدإشعارالتغييرات (أونشرالشروطالتيبتضمالتغييراتفيحالةإنالإيميلمششغالأومحظورأومشبيستلمالإشعار) معناهإنكقبلتالتغييراتووافقتعليها. التغييراتديهتتطبقبأثررجعيمنأولتاريخنشرالتغييراتعلىالموقع.</span>
            </p>
            <h3>روابطالطرفالتالت</h3>
            <p>
              <span>الموقعممكنيضمروابطلمواقعالطرفالثالث ("المواقعالخارجية"). الروابطديبتتقدمعشانراحتكبس،مشتأييدمنناللمحتوىالموجودفيالمواقعالخارجية. المحتوىالليفيالمواقعالخارجيةبيتمتطويرهوتوفيرهمنناستانية. لازمتتواصلمعمديرالمواقعالخارجيةديأوالمسؤولعنهالوعندكأيقلقمنالروابطديأوأيمحتوىموجودعلىالمواقعالخارجية. احنامشمسؤولينعنمحتوىأيمواقعخارجيةمرتبطةولابنقدمأيتعهداتليهاعلاقةبمحتوىأودقةالموادالموجودةفيالمواقعالخارجية. لازمتاخدكلاحتياطاتكاللازمةلماتيجيتنزلملفاتمنكلالمواقععشانتحميجهازالكمبيوترالخاصبيكمنالفيروساتوغيرهامنالبرامجالمدمرة. لوخدتقراربدخولالمواقعالخارجيةالمرتبطةدي،القراربيكونعلىمسئوليتكالشخصيةلوحدك.</span>
            </p>
            <h3>المعلوماتالشخصيةوسياسةالخصوصية</h3>
            <p>
              <span>لماتستخدمالموقعدة،انتكدةبتسمحليناباستخدامأوتخزينأومعالجةمعلوماتكالشخصيةعشاننقدرنوفرلكخدماتالموقعولأهدافالتسويقوالتحكمفيالرصيد ("الغرض"). تقدرتلاقيمعلوماتأكترفيسياسةالخصوصيةالخاصةبينا.</span>
            </p>
            <h3>الأخطاءوغيابالدقةوعدمالتركيز</h3>
            <p>
              <span>احناحريصينإننانتأكدمنأنالمعلوماتالمتوفرةعلىالموقعدةصحومفيهاشأخطاء. احنابنعتذرعنأيخطأأوعدمتركيزممكنيحصل. احنامانقدرشنضمنإناستخدامالموقعهيكونخاليمنالأخطاءأوأنهمناسبللغرض،وفيالوقتالمناسب،أوإنالعيوبهتتصحح،أوإنالموقعأوالخادمالليبيخليهمتاحخاليمنالفيروساتأوالأخطاءأوبيمثلالوظيفةكاملةأوالدقة،الخاصةبمصداقيةالموقع،واحنامشبنقدمأيضمانمنأينوع،سواءضمانصريحأوضمني،ليهعلاقةبصلاحيةالغرضأودقته.</span>
            </p>
            <h3>إنكارالضمانات؛تحديدالمسؤولية</h3>
            <p>
              <span>الموقعوالمحتوىبيتقدمواعلىأساس "زيماهو" و "حسبوجوده" منغيرأيضماناتمنأينوع،وبكدةالموقعهيشتغلمنغيرأخطاءأوإنالموقعأوسيرفراتهأوالمحتوىمشموجودفيهمفيروساتأوتلوثمشابهأوخصائصمدمرة.</span>
            </p>
            <p>
              <span>احنابنتنازلعنكلالضمانات،ودةبيضم،علىسبيلالمثالمشالحصر : ضماناتالعنوان،والصلاحية،وعدمانتهاكحقوقالأطرافالثالثة،وملاءمةالأغراضالخاصةوأيأغراضبتنتجعنأيحاجةليهاعلاقةبأيضماناتأوعقودأودعاوىقضائيةمشتركة: </span>
            </p>
            <ul>
              <li>مشهنتحملمسؤوليةأيأضرارغيرمباشرةأوعرضيةأومتتابعةأوأيخسارةأوضررناتجعنالبياناتالمفقودةأونتيجةالأعمالالليهدفهاالوصولللموقعأوالمحتوىواستخدامه،حتىلوعرفناإمكانيةإنممكنيحصلحاجةزيالأضراردي.</li>
              <li>أيأضرارمباشرةممكنتتعرضليهانتيجةاستخدامكللموقعأوالمحتوىهيعتمدبسعلىالأموالالليدفعتهاليناعنطريقاتصالكباستخدامكللموقعفيالشهورالتلاتةالليبتسبقالأحداثالتيبتزودالمطالبعلىطول.</li>
            </ul>
            <p>
              <span>الموقعممكنيضممعلوماتفنيةغلطأوأخطاءمطبعيةأوعملياتحذف. لومااتطلبشمنناعنطريقالقوانينالمعمولبيها،احنامشمسؤولينعنأيخطأمطبعيأوتقنيأوأخطاءالتسعيرالموجودةعلىموقع. الموقعممكنيشملمعلوماتعنخدماتمعينة،ومشكلالمعلوماتالمتاحةفيكلالمواقع. الإشارةللخدمةعلىالمواقعمشمعناهاإنالخدمةديمتاحةأوهتكونمتاحةفيموقعك. احنانحتفظبالحقفيإجراءتغييراتو / أوتعديلاتو / أوتحسيناتعلىالموقعفيأيوقتمنغيرماتلاحظ.</span>
            </p>
            <h3>حقوقالطبعوالنشروالعلامةالتجارية</h3>
            <p>
              <span>الموقعبيضمموادزيالبرامجوالنصوصوالرسوماتوالصوروالتصميماتوالتسجيلاتالصوتيةوالمصنفاتالسمعيةالبصرية،وغيرهامنالموادالليبنقدمهاأوبتتقدمبالنيابةعننا (وديبنشيرليهاكلهاباسم "المحتوى"). والمحتوىدةملكليناأولأطرافتالتة. الاستخدامالليمشمصرحبيهللمحتوىممكنيخالفحقوقالطبعوالنشروالعلامةالتجاريةوالقوانينالتانية. انتمشبتمتلكأيحقوقفيالمحتوىأوتجاهالمحتوى،ومشهتقدرتستخدمالمحتوىإلافيالحالاتالمسموحبيهابسكلدةبيبقاحسبالاتفاقية. مشمسموحبأياستخدامتانيمنغيرماتاخدموافقةخطيةمكتوبةمننا. لازمتحافظعلىكلحقوقالنشروإشعاراتالملكيةالتانيةالموجودةفيالمحتوىالأصليفيأينسخةبتاخدهاللمحتوى. مشمسموحليكبيعأونقلأوتكليفأوترخيصأوإنكتعملترخيصفرعيأوتعديلللمحتوىأوتعيدإنتاجأوعرضأوأداءعلنيأوتبنينسخةمشتقةمنالمحتوىأوتوزيعهأواستخدامهبأيطريقةلأيغرضسواءعامأوتجاري. ممنوعبشكلصريحاستخدامأونشرالمحتوىعلىأيموقعتانيأوفيبيئةكمبيوترمتصلةببعضهالأيهدف.</span>
              <span>لوخالفتأيجزءمنالاتفاقيةدي،الإذنالليسمحنالكبيهتدخلو / أوتستخدمالمحتوىوالموقعهيتوقفتلقائيًاولازمتمسحكل النسخ اللينسختهامنالمحتوىفورًا.</span>
              <span>علاماتناالتجاريةوعلاماتالخدمةواللوجوهاتالمستخدمةوالمعروضةعلىالموقعهيعلاماتتجاريةمسجلةومشمسجلةأوعلاماتخدمةمننا. أسماءالشركاتأوالمنتجاتأوالخدماتالتانيةالموجودةعلىالموقعممكنتكونعلاماتتجاريةأوعلاماتخدمةمملوكةلأفرادمختلفين ("علاماتالأطرافالتالتةالتجارية" ،ومعانابشكلكلي "العلاماتالتجارية"). مشلازمأيحاجةعلىالموقعتتفسرإنهابتديبأيحالمنالأحوال،أيترخيصأوحقفياستخدامالعلاماتالتجارية،بشكلضمني،أومشمصرحبيهلاستخدامالعلاماتالتجارية،منغيرإذنمكتوبمننابالاستخدام. مشمسموحإنكترجعأيمحتوىمرةتانيةمنغيرموافقةمكتوبةصريحةمننافيأيحالةوكلحالة.</span>
            </p>
            <h3>التعويض</h3>
            <p>
              <span>أنتبتوافقعلىالدفاععنناوتعويضناوإنكتتحملنااحناوالموظفينوالمديرينوالتابعينوالمرخصينبتوعناوإنكتمنعالضررعنأوضدأيدعاوىأوإجراءاتأومطالب،ودةبيضمعلىسبيلالمثالمشالحصر،الرسومالقانونيةوالمحاسبيةالمعقولة،الليبتكونناتجةعنمخالفتكللاتفاقيةأوسوءاستخدامكللمحتوىأوالموقع. لازمنبعتلكإخطاربأيمطالبةأودعوىأوإجراءمنالنوعدةوهنساعدكبسعلىنفقتكالخاصة،فيالدفاععنأيمطالبةأودعوىأوإجراء. احنابنحتفظبالحق،علىنفقتكالخاصة،فيإننانبقامسئولينعنالدفاعوالسيطرةالحصريةعلىأيمسألةبتخضعللتعويضحسبالقسمدة. فيالحالةدي،أنتبتوافقإنكتتعاونمعأيطلباتمعقولةهتساعدنافيالدفاععنالمسألةدي.</span>
            </p>
            <h3>إمكانيةالفصل</h3>
            <p>
              <span>لوفيأيبندمنالشروطديمشممكنيتنفذأومشمظبوط،هيتمتقييدالبنددةأوهيتلغيللحدالأدنىالضروريبحيثيفضلمفعولالبنودساريوتقبلإنهاتتنفذ.</span>
            </p>
            <h3>وقف الخدمات</h3>
            <p>
              <span>دةشرط. الخدمات الليهتتقدملكدي ممكنتتلغيأوتتوقف. احناممكننوقفالخدماتديفيأيوقت،بسببأومنغيرسبب،ودةبيتمعنطريقتنبيهمكتوب. مشهنتحملأيمسؤوليةتجاهكأوتجاهأيطرفتالتبسببالوقفدة. استبعادالشروطديهينتجعنهإننانوقفجميعاشتراكاتالخدماتالخاصةبيك.</span>
              <span>تأثيروقف الخدمات. لمايتماستبعادالشروطديلأيسببمنالأسباب،أوإلغاءأوانتهاءصلاحيةخدماتك:</span>
            </p>
            <ul>
              <li>هنوقفتقديمالخدمات</li>
              <li>مشهيبقامسموحلكتاخدأيرسوممستردةأورسوماستخدامأوأيرسومتانية،بشكلنسبيأوحاجةتانية؛</li>
              <li>أيرسومليكعندناهتاخدهافورًاوهندفعهالكبالكامل</li>
              <li>مسموحلينانمسحبياناتكالمحفوظةعندناخلال 30 يوم.</li>
            </ul>
            <p>
              <span>كلأقسامالشروطالتيبتنصبشكلصريحعلىإنهاتفضل،أوبطبيعتهاأنهالازمتبقاموجودة،مفعولهاهيفضلساريحتىبعدمايتمإلغاءالشروط،ودةبيضمعلىسبيلالمثالمشالحصر،التعويض،التنازلعنمسئوليةالضمان،وحدودالمسؤولية.</span>
            </p>
            <h3>الاتفاقيةالكاملة</h3>
            <p>
              <span>الشروطديهيالبيانالكاملوالحصريللتفاهمالمشتركبينالأطرافوالشروطديبتحلمحلأوتلغيكلالاتفاقياتالخطيةوالشفويةاللياتوقعتقبلكدةوالاتصالاتوغيرهامنالتفاهماتالليليهاعلاقةبموضوعالشروط،ولازمتكونأيتعديلاتفيشكلتوقيعاتمكتوبةمنالطرفين،إلالوفينصهنابيقولغيركدةهنا.</span>
            </p>
            <h3>القانونالحاكموالرجوعللقضاء</h3>
            <p>
              <span>الشروطالموجودةفيالقوانينبتخضعوتتفسرحسبقوانينجمهوريةمصرالعربيةمنغيرتفعيلأيمبادئأوتعارضاتفيالقانون. المحاكمالمصريةالمختصةليهاسلطةقضائيةحصريةعلىأينزاعبيحصلنتيجةاستخدامالموقع.</span>
            </p>
            <h3>الظروفالقهرية</h3>
            <p>
              <span>مشهنتحملأيمسؤوليةتجاهكأوتجاهالمستخدمينأوأيطرفتالتخاصةبأيإخفاقفيتنفيذنالالتزاماتناحسبالشروطفيحالةإنالأداء يقفبسببحدثخارجعنإرادتنا،زيعلىسبيلالمثالمشالحصر :حربأوإرهاب،أوكارثةطبيعية،أوعطل في التيارالكهربائي،أوأعمالشغب،أواضطراباتمدنية،أوفتنةداخليةأوغيرهامنالظروفالقهرية.</span>
            </p>
            <h3>التفسير</h3>
            <ul>
              <li>كلحاجةبتشيرلصيغةالمفردبتشملالجمعوالعكسصحيحوكلمة "يشمل" لازمتتفسرعلىإنها "علىسبيلالمثالمشالحصر".</li>
              <li>الكلماتالليبتشملجنسمعينلازمتشملكلالأنواعالتانية.</li>
              <li>الإشارةلأيتشريعأومرسومأوقانونتانيبيشملكلاللوائحوالأدواتوكلعملياتالدمجأوالتعديلاتأوإعادةالتشريعأوالتبديلاتالليبتحصلفيالوقتالحالي.</li>
              <li>• كلالعناوين،الكتابةالعريضةوالمايلة (لوموجودة) دخلناهاعلىالموقععشاننسهلالرجوعليهابسومشبتحددولابتأثرعلىمعنىأوتفسيرشروطالاتفاقيةدي.</li>
            </ul>
            <h3>خدمات الاستضافة</h3>
            <p>
              <span>لقد دخلنا في ترتيبات مع طرف ثالث أو أكثر لخدمات الاستضافة التي تعتبر ضرورية للخدمات ، والتي تم دمجها في الخدمات والتي بدونها لا يمكن تقديم الخدمات لك.</span>
            </p>
            <h3>مهمة</h3>
            <p>
              <span>يحق للشركة تعيين / نقل هذه الهدايا إلى أي طرف ثالث بما في ذلك الشركة القابضة والشركات التابعة والشركات التابعة والزميلة وشركات المجموعة ، دون أي موافقة من المستخدم.</span>
            </p>
            <h3>معلومات التواصل</h3>
            <p>
              <span>لو عندك أي أسئلة عن الشروط دي، من فضلك اتواص معانا عن طريق الإيميل <a href="mailto:Support@eMongez.com">Support@eMongez.com</a>.</span>
            </p>
          </div>
        </div>
      </section>

    </main>

    <!-- <div class="container-fluid mt-5 mb-5">
      <div class="row mb-4">
        <div class="col-md-12 text-center">
          <h1>Our Policies</h1>
          <p class="lead pb-4"> Terms & Conditions, Refund Policy, Pricing & Promotion Policy. </p>
        </div>
      </div>
      <div class="row terms-page" style="<?=($lang_dir == "right" ? 'direction: rtl;':'')?>">
        <div class="col-md-3 mb-3">
          <div class="card">
            <div class="card-body">
              <ul class="nav nav-pills flex-column mt-2">
                <?php
                  $get_terms = $db->query("select * from terms where language_id='$siteLanguage' LIMIT 0,1");
                  while($row_terms = $get_terms->fetch()){
                      $term_title = $row_terms->term_title;
                      $term_link = $row_terms->term_link;
                  ?>
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="pill" href="#<?= $term_link; ?>">
                  <?= $term_title; ?>
                  </a>
                </li>
                <?php } ?>
                <?php
                  $count_terms = $db->count("terms",array("language_id" => $siteLanguage));
                  $get_terms = $db->query("select * from terms where language_id='$siteLanguage' LIMIT 1,$count_terms");
                  while($row_terms = $get_terms->fetch()){
                      $term_title = $row_terms->term_title;
                      $term_link = $row_terms->term_link;
                  ?>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#<?= $term_link; ?>">
                  <?= $term_title; ?>
                  </a>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <div class="tab-content">
                <?php
                  $get_terms = $db->query("select * from terms where language_id='$siteLanguage' LIMIT 0,1");
                  while($row_terms = $get_terms->fetch()){
                      $term_title = $row_terms->term_title;
                      $term_link = $row_terms->term_link;
                      $term_description = $row_terms->term_description;
                  ?>
                <div id="<?= $term_link; ?>" class="tab-pane fade show active">
                  <h2 class="mb-4"><?= $term_title; ?></h2>
                  <p class="text-justify">
                    <?= $term_description; ?>
                  </p>
                </div>
                <?php } ?>
                <?php
                  $get_terms = $db->query("select * from terms where language_id='$siteLanguage' LIMIT 1,$count_terms");
                  while($row_terms = $get_terms->fetch()){
                      $term_title = $row_terms->term_title;
                      $term_link = $row_terms->term_link;
                      $term_description = $row_terms->term_description;
                  ?>
                <div id="<?= $term_link; ?>" class="tab-pane fade ">
                  <h1 class="mb-4"><?= $term_title; ?></h1>
                  <p class="text-justify">
                    <?= $term_description; ?>
                  </p>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <?php require_once("includes/footer.php"); ?>
  </body>
</html>