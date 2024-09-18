-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 20, 2023 at 11:06 AM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otrixcommerce_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Application Home Page Slider', 1, '2022-01-08 10:16:15', '2022-01-08 04:46:15', NULL),
(13, 'Application Banners', 1, '2023-07-05 05:39:17', '2023-07-05 05:39:17', NULL),
(14, 'WebSlider', 1, '2023-08-14 19:41:23', '2023-08-14 19:41:23', NULL),
(15, 'web-homepage-sub-banners', 1, '2023-08-11 07:02:34', '2023-08-11 07:02:34', NULL),
(16, 'web-left-slider', 1, '2023-07-13 00:49:43', '2023-07-13 00:49:43', NULL),
(17, 'web-right-slider', 1, '2023-07-13 00:50:15', '2023-07-13 00:50:15', NULL),
(18, 'web-three-column-banner', 1, '2023-07-13 00:51:50', '2023-07-13 00:51:50', NULL),
(19, 'web-two-column-banner', 1, '2023-07-13 00:52:46', '2023-07-13 00:52:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner_image`
--

DROP TABLE IF EXISTS `banner_image`;
CREATE TABLE IF NOT EXISTS `banner_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `text_color_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banner_id` (`banner_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner_image`
--

INSERT INTO `banner_image` (`id`, `banner_id`, `language_id`, `title`, `link`, `image`, `sort_order`, `created_at`, `updated_at`, `deleted_at`, `description`, `text_color_code`) VALUES
(1, 1, NULL, '50% off', 'product-1', '16472862101.jpg', 1, '2023-07-09 00:32:27', '2023-07-09 00:32:27', NULL, NULL, NULL),
(2, 1, NULL, '10% OFF', 'product-2', '16472862102.jpg', 2, '2023-07-09 00:32:27', '2023-07-09 00:32:27', NULL, NULL, NULL),
(3, 1, NULL, 'Banner', 'cateogry-1', '16472862103.jpg', 3, '2023-07-09 00:32:27', '2023-07-09 00:32:27', NULL, NULL, NULL),
(4, 1, NULL, 'Banner', 'brand-6', '16472862104.jpg', 4, '2023-07-09 01:04:15', '2023-07-09 01:04:15', NULL, NULL, NULL),
(23, 13, NULL, 'Banner-3', 'product-89', '1688868219banner2.jpg', 2, '2023-07-09 02:03:39', '2023-07-09 02:03:39', NULL, NULL, NULL),
(22, 13, NULL, 'Banner 2', 'category-32', '16888687374481084_18713 (1).jpg', 3, '2023-07-09 02:12:17', '2023-07-09 02:12:17', NULL, NULL, NULL),
(21, 13, NULL, 'Sale', 'product-411', '168886873710474790_18731150 (1).jpg', 1, '2023-07-09 02:12:17', '2023-07-09 02:12:17', NULL, NULL, NULL),
(24, 14, NULL, NULL, NULL, '16892288361680180245Main Banner 2.jpg', 1, '2023-07-13 06:15:28', '2023-07-13 00:45:28', NULL, NULL, NULL),
(25, 14, NULL, NULL, NULL, '168924257016545127231877.jpg', 2, '2023-07-13 10:02:50', '2023-07-13 04:32:50', NULL, NULL, NULL),
(26, 14, NULL, NULL, NULL, '1689243020Black Yellow Bold Bag Fashion Sale Banner (2).png', 3, '2023-07-13 10:10:20', '2023-07-13 04:40:20', NULL, NULL, NULL),
(27, 15, NULL, NULL, NULL, '16892290171680175511image 2 (1).png', 1, '2023-07-13 06:16:57', NULL, NULL, NULL, NULL),
(28, 15, NULL, NULL, NULL, '16892290171680180059side banner 2.jpg', 2, '2023-07-13 06:16:57', NULL, NULL, NULL, NULL),
(29, 16, NULL, NULL, NULL, '1689229183167756189514931.jpg', 1, '2023-07-13 06:19:43', NULL, NULL, NULL, NULL),
(30, 17, NULL, NULL, NULL, '16892292151677561938SL-101819-24230-06.jpg', 1, '2023-07-13 06:20:15', NULL, NULL, NULL, NULL),
(31, 18, NULL, NULL, NULL, '16892293101679915850image 6.png', 1, '2023-07-13 06:21:50', NULL, NULL, NULL, NULL),
(32, 18, NULL, NULL, NULL, '16892293101679915851image 8.png', 2, '2023-07-13 06:21:50', NULL, NULL, NULL, NULL),
(33, 18, NULL, NULL, NULL, '16892293101679915851image 7.png', 3, '2023-07-13 06:21:50', NULL, NULL, NULL, NULL),
(34, 19, NULL, NULL, NULL, '16892293661680523123Group 431.png', 1, '2023-07-13 06:22:46', NULL, NULL, NULL, NULL),
(35, 19, NULL, NULL, NULL, '16892293661680523123Group 430.png', 2, '2023-07-13 06:22:46', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `views` int(11) DEFAULT '1',
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `image`, `views`, `author`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, '66946.png', 7, 'Admin', '2023-08-16 04:41:09', '2023-08-16 04:59:30', NULL),
(8, '77236.png', 1, 'Admin', '2023-08-16 04:44:44', '2023-08-16 04:44:44', NULL),
(9, '53089.png', 1, 'Admin', '2023-08-16 04:48:07', '2023-08-16 04:48:07', NULL),
(10, '97327.png', 1, 'Admin', '2023-08-16 04:50:47', '2023-08-16 04:50:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_description`
--

DROP TABLE IF EXISTS `blog_description`;
CREATE TABLE IF NOT EXISTS `blog_description` (
  `blog_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_description`
--

INSERT INTO `blog_description` (`blog_id`, `language_id`, `title`, `short_description`, `description`) VALUES
(7, 4, 'Benefits of Indoor Plants - A Natural Addition to Your Home', 'Discover the numerous benefits of indoor plants and why they make a natural addition to your home. From improving air quality and reducing stress levels to boosting productivity and enhancing overall well-being, these green companions offer a simple yet effective way to create a healthier and more vibrant living space.', '<p>Benefits of Indoor Plants - A Natural Addition to Your Home</p>\r\n\r\n<h1>Benefits of Indoor Plants - A Natural Addition to Your Home</h1>\r\n\r\n<p>Date: October 15, 2022</p>\r\n\r\n<hr />\r\n<h2>The Power of Indoor Plants</h2>\r\n\r\n<p>Adding indoor plants to your living spaces not only enhances the aesthetic appeal but also brings numerous health benefits. These green companions have a remarkable ability to lift moods, improve air quality, and create a more relaxed atmosphere.</p>\r\n\r\n<h3>Purifying Air Quality</h3>\r\n\r\n<p>Indoor air pollution can be a serious concern as it affects our respiratory health. However, indoor plants act as natural filters by absorbing harmful pollutants and releasing oxygen. They efficiently remove toxins such as benzene, formaldehyde, and carbon monoxide from the air, improving its quality and reducing the risk of respiratory issues.</p>\r\n\r\n<h3>Mood Enhancement</h3>\r\n\r\n<p>The presence of indoor plants has been linked to improved mood and mental well-being. Studies have shown that being around nature-like elements can reduce stress levels and increase productivity. Indoor plants provide a sense of calmness and tranquility, making them an ideal addition to any home or workspace.</p>\r\n\r\n<p><!-- Can add more points about reducing noise level --></p>\r\n\r\n<h3>Elevating Aesthetics</h3>\r\n\r\n<p>In addition to their health benefits, indoor plants add beauty and freshness to any indoor environment. They come in various shapes, sizes, and colors, enabling you to personalize your space according to your preferences. Whether you choose small succulents, cascading ivy, or tall palms, these natural elements create visually appealing focal points.</p>\r\n\r\n<hr />\r\n<p>&copy; 2022 YourBlogName.com | All rights reserved.</p>'),
(7, 5, 'فوائد النباتات المنزلية - إضافة طبيعية لمنزلك', 'هل تعلم أن وجود النباتات المنزلية له فوائد عديدة؟ إضافة النباتات إلى منزلك ليست مجرد زخرفة جميلة، بل تساهم في تحسين جودة الهواء وتقديم جو هادئ وصحي. اكتشف في هذا المقال فوائد النباتات المنزلية وكيف يمكن أن تصبح إضافة طبيعية رائعة لديكور منزلك.', '<p>فوائد النباتات المنزلية - إضافة طبيعية لمنزلك</p>\r\n\r\n<h1>فوائد النباتات المنزلية - إضافة طبيعية لمنزلك</h1>\r\n\r\n<p>النباتات المنزلية تُضفي جمالاً وحياة على منزلك، بالإضافة إلى فوائدها العديدة على صحتك الجسدية والعقلية. يتمتعون بقدرة فريدة على تحسين جودة الهواء في الأماكن المغلقة وخفض مستوى التوتر والإجهاد، وتحسين مستوى التركيز وآداء الذاكرة.</p>\r\n\r\n<p>إليك بعض الفوائد المذهلة للنباتات المنزلية:</p>\r\n\r\n<ul>\r\n	<li><strong>تحسين جودة الهواء:</strong> تعمل النباتات على امتصاص ثاني أكسيد الكربون المتراكم في الهواء وإطلاق كميات كافية من الأكسجين. كما تعمل على امتصاص المواد الكيميائية الضارة وتحسين جودة الهواء المحيط بك.</li>\r\n	<li><strong>تقليل التوتر والإجهاد:</strong> يعزز التواجد في محيط أخضر من النباتات المشاعر الإيجابية ويساعد على تقليل مستوى التوتر والإجهاد. فهي تُنشط حواسك وتخلق شعورًا بالسكينة والانتعاش.</li>\r\n	<li><strong>زيادة التركيز:</strong> تُظهر دراسات أن الأشخاص الذين يعملون في مكان به نباتات منزلية يظهرون مستوى أفضل من التركيز والإبداع في عملهم. فإذا كان هناك نبات في غُرفة عملك، قد يسهم في زيادة إنتاجيتك.</li>\r\n	<li><strong>تحسن الصحة:</strong> تُظهر بعض الأبحاث أن الأشخاص الذي لديهم نباتات داخل المنزل يُصابون بأقل عدد من الأمراض ويتعافون بشكل أسرع عند المرض.</li>\r\n</ul>\r\n\r\n<p>إن إضافة النباتات المنزلية إلى منزلك لا تعطيه فقط مظهرًا جماليًا، بل تقدم لك فوائد مذهلة تحسِّن صحتك وجودتك في الحياة. استثمر في نباتات داخل المنزل واستمتع بجمال طبيعة خضراء حولك.</p>'),
(8, 4, 'Best Sport Shoes For Multi Gender.', 'Looking for the perfect sport shoes that cater to all genders? Look no further! Our blog post highlights the best sport shoes that are not only stylish and comfortable but also designed to fit and support diverse foot shapes. Don\'t miss out on finding your perfect pair!', '<p>Best Sport Shoes For Multi Gender</p>\r\n\r\n<h1>Best Sport Shoes For Multi Gender</h1>\r\n\r\n<p>When it comes to choosing sport shoes that can cater to individuals of all genders, several factors need to be considered such as comfort, style, durability, and versatility. Sports shoes should provide adequate support for various physical activities while also reflecting personal fashion preferences. Below are some top recommendations:</p>\r\n\r\n<h2>Nike Air Zoom Pegasus</h2>\r\n\r\n<p>The Nike Air Zoom Pegasus is a favorite among athletes of all genders. It offers lightweight cushioning and breathability, making it ideal for running or any aerobic exercise.</p>\r\n\r\n<h2>New Balance Fresh Foam Roav</h2>\r\n\r\n<p>These shoes come in versatile designs suitable for both men and women. They are crafted with innovative technology to deliver luxurious comfort and optimal performance during workouts.</p>\r\n\r\n<h2>Adidas Ultraboost</h2>\r\n\r\n<p>Adidas Ultraboost is known for its responsiveness and energy return. Designed with a gender-neutral design approach, these shoes offer great flexibility, stability, and support.</p>\r\n\r\n<h2>Puma Men&#39;s Ignite XT Graphic Cross Training Shoe</h2>\r\n\r\n<p>Puma provides multi-gender sport shoe options that combine style and function. The Ignite XT Graphic Cross Training Shoe offers excellent traction, durability, and responsive cushioning.</p>\r\n\r\n<h2>Asics Women&#39;s Gel Nimbus Lite Running Shoe</h2>\r\n\r\n<p>This shoe caters specifically to women, providing superior comfort and stability. With gel cushioning and lightweight properties, it is perfect for intense training sessions or casual exercising.</p>\r\n\r\n<h2>Conclusion</h2>\r\n\r\n<p>When looking for sport shoes suitable for individuals of all genders, these options, among many others available on the market today, provide the necessary features and qualities required. Remember to consider personal needs and preferences when making a final decision for the best sports shoes to elevate your athletic performance and style.</p>'),
(8, 5, 'أفضل أحذية رياضية للجنس.', 'في هذا المقال، سنستعرض أفضل أحذية رياضية للجنس. سنتحدث عن التصميمات المبتكرة والمواد العالية الجودة التي توفر الدعم والراحة للأقدام أثناء ممارسة الرياضة. اكتشف مجموعة متنوعة من الخيارات المثالية لتلبية احتياجاتك الشخصية وتحسين أدائك في التمارين الرياضية.', '<p>أفضل أحذية رياضية للجنس</p>\r\n\r\n<h1>أفضل أحذية رياضية للجنس</h1>\r\n\r\n<p>مهما كان نوع الرياضة التي تمارسها، فإن ارتداء الأحذية الرياضية المناسبة يُعتبر من العوامل المهمة في تجربتك وأدائك. توفر لك الأحذية الصحيحة الدعم والثبات أثناء ممارستك للتمارين، مما يقلل من خطر الإصابات ويزودك بالشعور بالراحة.</p>\r\n\r\n<p>هنا سنستعرض بعضًا من أفضل أحذية التدريب المتوفرة في السوق لكلا الجنسين:</p>\r\n\r\n<ul>\r\n	<li>Nike Air Zoom Pegasus: تُقدِّم هذه الأحذية دعمًا عاليًا وثباتًا ممتازًا. إنها مصممة بتقنية توفير التهوية والخفة.</li>\r\n	<li>Adidas Ultraboost: تتميز هذه الأحذية بإحساسها المريح وتصميمها الأنيق. تعتبر مناسبة للجري والتدريبات الخفيفة.</li>\r\n	<li>Reebok CrossFit Nano: إذا كنت تمارس رياضة CrossFit، فإن هذه الأحذية هي اختيارك المثالي. توفر الثبات والدعم لحركات متعددة الاتجاهات.</li>\r\n</ul>\r\n\r\n<p>لا تنسَ أن يكون اختيار الأحذية المثلى يعتمد على نوعية التمارين التي تقوم بها وشكل قدمك. قد يكون من الأفضل استشارة خبير في مجال الأحذية للحصول على نصائح إضافية قبل شراءها.</p>'),
(9, 4, 'Best Furniture Product On OtrixWeb.', 'Discover the ultimate guide to finding the best furniture products on OtrixWeb. From stylish sofas to elegant dining sets, this blog post highlights top-rated items that will enhance your home\'s aesthetic and functionality. Explore the latest trends and make informed decisions when shopping for furniture online.', '<p>Best Furniture Product On OtrixWeb</p>\r\n\r\n<h1>Best Furniture Product On OtrixWeb</h1>\r\n\r\n<p>When it comes to furnishing our homes, finding the perfect piece of furniture can be a daunting task. However, with OtrixWeb&#39;s extensive collection and superior quality products, your search may finally come to an end. Here, we take a closer look at one of the best furniture products available on OtrixWeb.</p>\r\n\r\n<h2>The XYZ Sofa</h2>\r\n\r\n<p><img alt=\"XYZ Sofa\" src=\"xyz_sofa.jpg\" /></p>\r\n\r\n<p>The XYZ Sofa manufactured by OtrixWeb is a true masterpiece that combines both style and comfort. Its modern design with clean lines and sleek upholstery makes it a versatile addition to any living room or office space.</p>\r\n\r\n<p>Made from high-quality materials, the XYZ Sofa guarantees durability and longevity. The cushions are filled with premium foam, ensuring optimal support and supreme comfort for those lazy evenings spent binge-watching Netflix or entertaining guests.</p>\r\n\r\n<p>What sets the XYZ Sofa apart from its competitors is its customizability. With OtrixWeb&#39;s user-friendly interface, you can choose from a wide range of stunning fabric options in various colors to match your existing d&eacute;cor seamlessly.</p>\r\n\r\n<p>Investing in the XYZ Sofa not only adds style and elegance to your space but also assures you of great value for your money. This furniture piece not only enhances the aesthetics but also elevates your overall living experience.</p>\r\n\r\n<p>In conclusion, when searching for the perfect furniture product, look no further than the XYZ Sofa available on OtrixWeb. Its exceptional design, superior quality, and customizable options make it a top choice for anyone looking to enhance their interior space.</p>\r\n\r\n<p>Visit OtrixWeb today and embark on your journey towards creating a beautiful and comfortable home with their impressive range of furniture products.</p>'),
(9, 5, 'أفضل منتج أثاث على OtrixWeb.', 'في هذا المقال، سنستعرض أفضل منتجات الأثاث المتوفرة على موقع OtrixWeb. سنقدم لكم تشكيلة متنوعة من الأثاث ذو الجودة العالية والتصاميم الأنيقة التي ستضفي لمسة فخامة على منزلك. اكتشفوا أحدث صيحات الموضة في عالم الأثاث واستمتعوا بتجربة تسوق مريحة وسهلة عبر OtrixWeb.', '<p>أفضل منتج أثاث على OtrixWeb</p>\r\n\r\n<h1>أفضل منتج أثاث على OtrixWeb</h1>\r\n\r\n<p>مرحبًا بكم في مدونة OtrixWeb! اليوم سنستعرض لكم أفضل منتجات الأثاث التي يوفرها موقعنا. نحن نسعى دائمًا لتلبية احتياجات عملائنا وتقديم المنتجات ذات الجودة العالية والتصاميم الرائعة.</p>\r\n\r\n<h2>كرسي استرخاء فخم</h2>\r\n\r\n<p><img alt=\"كرسي استرخاء فخم\" src=\"chair.jpg\" /></p>\r\n\r\n<p>إذا كنت تبحث عن راحة وأناقة، فإن كرسي الاسترخاء الفخم هذا هو اختيارك المثالي. صُنع هذا الكرسي بأقصى درجات الدقة والإبداع، حيث يوفِّر لك رغبة لانهائية في الجلوس والاسترخاء. تصميمه الحديث والأنيق يتناسب مع أي غرفة ويعزز جمالها.</p>\r\n\r\n<h2>طاولة الطعام المودرن</h2>\r\n\r\n<p><img alt=\"طاولة الطعام المودرن\" src=\"table.jpg\" /></p>\r\n\r\n<p>تُعد طاولة الطعام المودرن من أفضل المنتجات التي نقدمها على OtrixWeb. بفضل تصميمها الأنيق والألوان الجذابة، تضفي هذه الطاولة لمسةً خاصة على أي غرفة طعام. صُنعت بأجود أنواع الخشب لتكون متينة وتدوم طويلًا، كما يسهل تنظيفها والحفاظ على نظافتها.</p>\r\n\r\n<p>OtrixWeb هو المكان المثالي لشراء منتجات الأثاث عبر الإنترنت. نحافظ دائمًا على جودة منتجاتنا، بالإضافة إلى خدمة التوصيل الموثوق بها والدعم الفوري للزبائن. تعالوا وتسوقوا منتجاتنا الآن!</p>\r\n\r\n<p>&copy; 2022 OtrixWeb. كل الحقوق محفوظة.</p>'),
(10, 4, 'Why People Addict With Smart Worlds.', 'In this blog post, we explore the reasons behind people\'s addiction to smart worlds. From the convenience and connectivity they offer to the allure of virtual experiences, we delve into how these technological advancements have captivated and consumed our lives.', '<p>Why People Become Addicted to Smart Worlds</p>\r\n\r\n<h1>Why People Become Addicted to Smart Worlds</h1>\r\n\r\n<p>In today&#39;s modern age, it is not uncommon to see people glued to their smartphones, engrossed in the virtual worlds they provide. This addiction to smart worlds can be attributed to several factors.</p>\r\n\r\n<h2>Social Media Engagement</h2>\r\n\r\n<p>One reason for the addiction is the constant engagement offered by social media platforms. These platforms allow individuals to stay connected with friends and family, share experiences, and consume a vast amount of information. The need for social validation and fear of missing out (FOMO) drives users to constantly check notifications, scroll through news feeds, and engage in online conversations.</p>\r\n\r\n<h2>Gaming and Entertainment</h2>\r\n\r\n<p>The gaming industry has experienced exponential growth with the advent of smartphones. Mobile games offer immersive experiences that captivate users for hours on end. Additionally, streaming services provide convenient access to a vast array of entertainment content such as movies, TV shows, and music. Constant availability of these forms of entertainment makes it easy for individuals to become addicted.</p>\r\n\r\n<h2>Addictive Design Elements</h2>\r\n\r\n<p>Smart world applications are designed with addictive features. The use of infinite scrolling, autoplay videos, push notifications, and personalized recommendations keeps users engaged and hooked on these platforms.</p>\r\n\r\n<h2>Increase in Remote Work</h2>\r\n\r\n<p>The COVID-19 pandemic has accelerated the shift towards remote work. With increased screen time for professional purposes, individuals find themselves easily transitioning from work-related usage to recreational activities on their devices without realizing how much time they spend within smart worlds.</p>\r\n\r\n<p>In conclusion, the addiction to smart worlds can be attributed to the social engagement offered by platforms, captivating gaming and entertainment experiences, addictive design elements used in applications, and increased screen time due to remote work. It is essential for individuals to be aware of these factors and find a balance in their smartphone usage to maintain a healthy lifestyle.</p>'),
(10, 5, 'لماذا يدمن الناس العوالم الذكية.', 'في هذا المقال سنتطرق إلى الأسباب التي تجعل الناس يدمنون العوالم الذكية. سنستكشف كيف توفر هذه الأجهزة مستوى عالٍ من الراحة والتسهيل في حياتنا، وكيف أصبحت جزءًا لا يتجزأ من روتيننا اليومي. كما سنتحدث عن التحديات المحتملة والآثار السلبية للاستخدام المفرط للعوالم الذكية.', '<p>لماذا يدمن الناس العوالم الذكية؟</p>\r\n\r\n<h1>لماذا يدمن الناس العوالم الذكية؟</h1>\r\n\r\n<p>إن عصر التكنولوجيا المتقدِّمة قد غطَّى على حياتنا بشكل كبير، وأحد الأشياء التي أصبحت جزءًا لا يتجزأ من حياتنا هي العوالم الذكية. فهذه المنصات تعد مرحلة تطور للاستخدام التقليدي للإعلام والاتصالات.</p>\r\n\r\n<p>تُعتبر هذه العوالم مثيرة بسبب عدة أسباب. أولًا، فإنها توفر سهولة في وصول المعلومات. من خلال هذه الأجهزة، يُصبح من الممكن استعراض مختلف المصادر المثيرة للاهتمام باستخدام شاشة واحدة فقط، بدلًا من الحاجة إلى استخدام جهاز متعدد أو البحث بشكل يدوي في وسائل الإعلام التقليدية.</p>\r\n\r\n<p>ثانيًا، فإن لهذه العوالم تأثيرًا كبيرًا على الترفيه. حيث تساعد في خلق عوالم افتراضية تأخذ المستخدمين إلى مغامرات غير مسبوقة وتجارب شيقة فائقة. هذا التأثير يُبرز رغبة الأفراد في استكشاف أشياء جديدة والابتعاد عن الروتين الحالي.</p>\r\n\r\n<p>أخيرًا، فإن العوالم الذكية قادرة على تسهيل حياتنا بطرق عديدة. فمن خلال استخدام هذه التقنية، يُصبح بإمكاننا إجراء المزيد من المهام بشكل مؤكَّد وفعَّال. يُلاحظ أن هؤلاء الأفراد يستغلون هذه التقنية لتسهيل عملية التسوُّق، قضاء وقت ممتع في التواصل مع الآخرين، وتحقيق أهداف شخصية أخرى دون عناء إضافي.</p>\r\n\r\n<p>بشكل عام، يحمل الإدمان على العوالم الذكية فوائد كبيرة، لأنها تساهم في تحسين نوعية حياتنا والاستفادة من التقنية المتطورة بشكل أفضل. ومع ذلك، يجب ألا نغفل استخدام هذه التكنولوجيا بشكل مُفرِط لدرجة إدمانها المُضرَّة بالصحة الجسدية والعقلية.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `colour_id` int(50) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `option` text,
  `quantity` int(5) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `base_price` double(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `cart_id` (`customer_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `top` tinyint(1) DEFAULT NULL,
  `column` int(3) DEFAULT NULL,
  `sort_order` int(3) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `image`, `parent_id`, `top`, `column`, `sort_order`, `status`, `seller_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1687952767image_9-removebg-preview (1).png', 0, NULL, NULL, 2, 1, NULL, '2023-08-20 09:08:51', '2023-08-20 03:38:51', NULL),
(2, '1687952789image_10-removebg-preview (1).png', 0, NULL, NULL, 2, 1, NULL, '2023-06-28 11:46:29', '2023-06-28 06:16:29', NULL),
(3, '16879533704-2-shoes-free-download-png 1.png', 0, NULL, NULL, 3, 1, NULL, '2023-06-28 11:56:10', '2023-06-28 06:26:10', NULL),
(4, '168795297541624-7-groceries-hd-download-hd-png 1.png', 0, NULL, NULL, 10, 1, NULL, '2023-07-15 07:27:14', '2023-07-15 07:27:14', NULL),
(5, '16879529674-2-luggage-free-png-image 1.png', 0, NULL, NULL, 5, 1, NULL, '2023-06-28 11:49:27', '2023-06-28 06:19:27', NULL),
(6, '1687952951pngwing 1.png', 0, NULL, NULL, 6, 1, NULL, '2023-06-28 11:49:11', '2023-06-28 06:19:11', NULL),
(7, '168795285932767-2-axe-spray-transparent-background_1-removebg-preview (1).png', 0, NULL, NULL, 1, 1, NULL, '2023-07-14 06:00:50', '2023-07-14 00:30:50', NULL),
(8, '169087055784395-removebg-preview.png', 0, NULL, NULL, 3, 1, NULL, '2023-08-01 06:15:57', '2023-08-01 00:45:57', NULL),
(9, '1687952912dress-shirt.png', 1, NULL, NULL, 2, 1, NULL, '2023-06-28 11:48:32', '2023-06-28 06:18:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_description`
--

DROP TABLE IF EXISTS `category_description`;
CREATE TABLE IF NOT EXISTS `category_description` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `name` (`name`),
  KEY `category_id` (`category_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_description`
--

INSERT INTO `category_description` (`category_id`, `language_id`, `name`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 4, 'Women Fashion', NULL, 'Women Fashion', 'Women Fashion', 'Women Fashion', '2023-06-28 06:16:29', '2023-06-28 06:16:29', NULL),
(3, 5, 'أحذية', NULL, 'أحذية', 'أحذية', 'أحذية', '2023-06-28 06:26:10', '2023-06-28 06:26:10', NULL),
(4, 4, 'Grocery', NULL, 'Grocery', 'Grocery', 'Grocery', '2023-07-15 07:27:14', '2023-07-15 07:27:14', NULL),
(4, 5, 'خضروات', NULL, 'خضروات', 'خضروات', 'خضروات', '2023-07-15 07:27:14', '2023-07-15 07:27:14', NULL),
(5, 5, 'يسافر', NULL, 'يسافر', 'يسافر', 'يسافر', '2023-06-28 06:19:27', '2023-06-28 06:19:27', NULL),
(5, 4, 'Travel', NULL, 'Travel', 'Travel', 'Travel', '2023-06-28 06:19:27', '2023-06-28 06:19:27', NULL),
(6, 4, 'Kids Wear', NULL, 'Kids Wear', 'Kids Wear', 'Kids Wear', '2023-06-28 06:19:11', '2023-06-28 06:19:11', NULL),
(6, 5, 'ملابس الاطفال', NULL, 'ملابس الاطفال', 'ملابس الاطفال', 'ملابس الاطفال', '2023-06-28 06:19:11', '2023-06-28 06:19:11', NULL),
(7, 5, 'إلكترونيات', NULL, 'إلكترونيات', 'إلكترونيات', 'إلكترونيات', '2023-07-14 00:31:21', '2023-07-14 00:31:21', NULL),
(8, 4, 'Furniture', NULL, 'Furniture', 'Furniture', 'Furniture', '2023-08-01 05:26:45', '2023-08-01 05:26:45', NULL),
(9, 5, 'قميص', NULL, 'قميص', 'قميص', 'قميص', '2023-06-28 06:18:32', '2023-06-28 06:18:32', NULL),
(7, 4, 'Electronics', NULL, 'Electronics', 'Electronics', 'Electronics', '2023-07-14 00:31:21', '2023-07-14 00:31:21', NULL),
(2, 5, 'أزياء نسائية', NULL, 'أزياء نسائية', 'أزياء نسائية', 'أزياء نسائية', '2023-06-28 06:16:29', '2023-06-28 06:16:29', NULL),
(1, 5, 'أزياء الرجال', NULL, 'أزياء الرجال', 'أزياء الرجال', 'أزياء الرجال', '2023-08-20 03:38:51', '2023-08-20 03:38:51', NULL),
(9, 4, 'Shirt', NULL, 'Shirt', 'Shirt', 'Shirt', '2023-06-28 06:18:32', '2023-06-28 06:18:32', NULL),
(3, 4, 'Shoes', NULL, 'Shoes', 'Shoes', 'Shoes', '2023-06-28 06:26:10', '2023-06-28 06:26:10', NULL),
(8, 10, 'Furniture-estonia', NULL, 'Furniture-estonia', 'Furniture-estonia', 'Furniture-estonia', '2023-08-01 05:26:45', '2023-08-01 05:26:45', NULL),
(1, 4, 'Men Fashion', NULL, 'Men Fashion', 'Men Fashion', 'Men Fashion', '2023-08-20 03:38:51', '2023-08-20 03:38:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatgpt_config`
--

DROP TABLE IF EXISTS `chatgpt_config`;
CREATE TABLE IF NOT EXISTS `chatgpt_config` (
  `enable` tinyint(1) NOT NULL DEFAULT '0',
  `api_key` text,
  `product_description_text` text,
  `blog_words_count` int(11) DEFAULT NULL,
  `product_description_words_count` int(11) DEFAULT NULL,
  `blog_description_text` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatgpt_config`
--

INSERT INTO `chatgpt_config` (`enable`, `api_key`, `product_description_text`, `blog_words_count`, `product_description_words_count`, `blog_description_text`) VALUES
(1, 'sk-sadsadsadsadsadsadsa', 'Write a description for a  PRODUCT_NAME', 200, 200, 'Write a blog post about BLOG_TITLE');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

DROP TABLE IF EXISTS `contactus`;
CREATE TABLE IF NOT EXISTS `contactus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_price_table`
--

DROP TABLE IF EXISTS `cost_price_table`;
CREATE TABLE IF NOT EXISTS `cost_price_table` (
  `cost_price_table_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost_price` decimal(15,4) NOT NULL,
  `pp` decimal(15,4) NOT NULL,
  `shipping_value` decimal(15,4) NOT NULL,
  PRIMARY KEY (`cost_price_table_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(50) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text,
  `postcode_required` char(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=253 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `iso_code_2`, `iso_code_3`, `address_format`, `postcode_required`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'Abdullah', 'AU', 'AUS', 'Fatehpura ,dohad', '389172', 0, '2023-08-20 09:09:40', '2023-08-20 03:39:40', '2023-08-20 03:39:40'),
(19, 'Bangladesh', 'BD', 'BGD', NULL, '880', 1, '2023-08-14 14:31:52', NULL, NULL),
(40, 'Canada', 'CA', 'CAN', NULL, '1', 1, '2023-08-14 14:31:52', NULL, NULL),
(103, 'India', 'IN', 'IND', NULL, '91', 1, '2023-08-14 14:31:52', NULL, NULL),
(121, 'Kuwait', 'KW', 'KWT', NULL, '965', 1, '2023-08-14 14:31:52', NULL, NULL),
(197, 'Saudi Arabia', 'SA', 'SAU', NULL, '966', 1, '2023-08-14 14:31:52', NULL, NULL),
(231, 'Turkey', 'TR', 'TUR', NULL, '90', 1, '2023-08-14 14:31:52', NULL, NULL),
(237, 'United Arab Emirates', 'AE', 'ARE', NULL, '971', 1, '2023-08-14 14:31:52', NULL, NULL),
(238, 'United Kingdom', 'GB', 'GBR', NULL, '44', 1, '2023-08-14 14:31:52', NULL, NULL),
(239, 'United States', 'US', 'USA', NULL, '1', 1, '2023-08-14 14:31:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` varchar(20) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=percentage,2=fixed',
  `discount` decimal(15,4) NOT NULL,
  `uses_total` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `name`, `code`, `type`, `discount`, `uses_total`, `status`, `date_added`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test', '123', 1, '10.0000', NULL, 1, NULL, '2023-08-10', '2023-11-30', '2023-08-13 14:21:14', '2023-08-13 14:21:14', NULL),
(2, 'Fix', '456', 2, '10.0000', NULL, 1, NULL, '2023-08-11', '2023-11-30', '2023-08-14 04:23:46', '2023-08-14 04:23:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_history`
--

DROP TABLE IF EXISTS `coupon_history`;
CREATE TABLE IF NOT EXISTS `coupon_history` (
  `coupon_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_type` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT '1',
  `order_done` tinyint(1) NOT NULL DEFAULT '0',
  `coupon_code` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`coupon_history_id`),
  KEY `coupon_id` (`coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `currency_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(12) NOT NULL,
  `symbol_right` varchar(12) NOT NULL,
  `decimal_place` char(1) NOT NULL,
  `value` double(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) DEFAULT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `country_code` char(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `cart` text,
  `wishlist` text,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `custom_field` text,
  `ip` varchar(40) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `code` varchar(40) DEFAULT NULL,
  `code_sendon` datetime DEFAULT NULL,
  `otp_token` text,
  `image` text,
  `firebase_token` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `creation` enum('D','G','F','A') DEFAULT NULL,
  `social_id` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

DROP TABLE IF EXISTS `customer_address`;
CREATE TABLE IF NOT EXISTS `customer_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) DEFAULT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `type` enum('delivery','billing') NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`id`, `customer_id`, `name`, `address_1`, `address_2`, `city`, `postcode`, `country_id`, `state_id`, `session_id`, `type`, `email`, `mobile`, `created_at`) VALUES
(1, NULL, 'Abdullah patel', 'ahemdabad\nahemdabad', 'null', 'ahmedabad', '380001', 239, 4675, 'ugOqqQHGIqX4payacd0tvxbvB7ramyMsy5Je55eI', 'billing', 'abdullah.retrun@gmail.com', 9898989898, '2023-08-18 13:25:33'),
(2, NULL, 'Abdullah patel', 'ahemdabad\nahemdabad', NULL, 'ahmedabad', '380001', 103, 1609, 'Uh2MVnvRRot12DEcJesjYeV0H5Q1S7jy2FaeozAC', 'billing', 'abdullah.retrun@gmail.com', 9898989898, '2023-08-18 13:35:39'),
(3, NULL, 'Abdullah patel', 'ahemdabad\nahemdabad', NULL, 'ahmedabad', '380001', 103, 1609, 'Uh2MVnvRRot12DEcJesjYeV0H5Q1S7jy2FaeozAC', 'delivery', 'abdullah.retrun@gmail.com', 9898989898, '2023-08-18 13:35:47'),
(4, NULL, 'Abdullah patel', 'ahemdabad\nahemdabad', NULL, 'ahmedabad', '380001', 238, 4428, 'Uh2MVnvRRot12DEcJesjYeV0H5Q1S7jy2FaeozAC', 'delivery', 'abdullah.retrun@gmail.com', 9898989898, '2023-08-18 13:36:11'),
(29, 1, 'Abdullah patel', 'ahemdabad\nahemdabad', NULL, 'ahmedabad', '380001', 103, 1609, '', 'billing', NULL, NULL, '2023-08-19 08:41:57'),
(30, 1, 'Abdullah patel', 'Pachhla plot faliya\nFatehpura', NULL, 'Dahod', '389172', 40, 682, '', 'billing', NULL, NULL, '2023-08-19 08:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `customer_transaction`
--

DROP TABLE IF EXISTS `customer_transaction`;
CREATE TABLE IF NOT EXISTS `customer_transaction` (
  `customer_transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_wishlist`
--

DROP TABLE IF EXISTS `customer_wishlist`;
CREATE TABLE IF NOT EXISTS `customer_wishlist` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`product_id`),
  KEY `customer_id` (`customer_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` text NOT NULL,
  `device_type` enum('android','ios') NOT NULL,
  `clear_cache` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dod`
--

DROP TABLE IF EXISTS `dod`;
CREATE TABLE IF NOT EXISTS `dod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dod`
--

INSERT INTO `dod` (`id`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, '2023-08-16 06:13:35', NULL, NULL),
(2, 9, '2023-08-16 06:13:35', NULL, NULL),
(3, 10, '2023-08-16 06:13:35', NULL, NULL),
(4, 14, '2023-08-16 06:13:35', NULL, NULL),
(5, 36, '2023-08-16 06:13:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `featured_products`
--

DROP TABLE IF EXISTS `featured_products`;
CREATE TABLE IF NOT EXISTS `featured_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `featured_products`
--

INSERT INTO `featured_products` (`id`, `product_id`) VALUES
(1, 65),
(2, 14),
(3, 9),
(4, 4),
(5, 2),
(6, 28),
(7, 26);

-- --------------------------------------------------------

--
-- Table structure for table `geo_zone`
--

DROP TABLE IF EXISTS `geo_zone`;
CREATE TABLE IF NOT EXISTS `geo_zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `geo_zone`
--

INSERT INTO `geo_zone` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Asia', 'asd', '2023-08-13 07:34:48', '2023-08-13 07:35:03', '2023-08-13 07:35:03'),
(10, 'ASIA Vat', 'this is asia vat zone', '2023-08-13 07:35:51', '2023-08-13 07:35:51', NULL),
(11, 'UK Shipping', 'UK Shipping', '2023-08-14 05:24:43', '2023-08-14 05:24:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `geo_zone_countries`
--

DROP TABLE IF EXISTS `geo_zone_countries`;
CREATE TABLE IF NOT EXISTS `geo_zone_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zone_id` (`zone_id`,`country_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `geo_zone_countries`
--

INSERT INTO `geo_zone_countries` (`id`, `zone_id`, `country_id`, `state_id`) VALUES
(66, 11, 238, 4544),
(67, 11, 238, 4428),
(68, 11, 239, 0),
(69, 10, 103, 0),
(70, 10, 19, 350);

-- --------------------------------------------------------

--
-- Table structure for table `homepage_categories`
--

DROP TABLE IF EXISTS `homepage_categories`;
CREATE TABLE IF NOT EXISTS `homepage_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homepage_categories`
--

INSERT INTO `homepage_categories` (`id`, `category_id`, `sort_order`) VALUES
(1, 5, 0),
(2, 7, 0),
(3, 8, 0),
(4, 2, 0),
(5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) NOT NULL,
  `code` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `default_lang` tinyint(1) DEFAULT NULL,
  `language_flag` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language_name`, `code`, `status`, `default_lang`, `language_flag`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Arabic', 'ar', 1, 0, '1681024972sa.png', 0, '2022-04-16 03:58:11', '2023-08-17 06:01:21', NULL),
(4, 'English', 'en', 1, 1, '1681024962us.png', 2, '2022-04-16 03:53:24', '2023-08-17 06:01:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `length_class`
--

DROP TABLE IF EXISTS `length_class`;
CREATE TABLE IF NOT EXISTS `length_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `unit` varchar(4) NOT NULL,
  `value` decimal(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `image`, `sort_order`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gucci', '1687950976App-Icon-Light-removebg-preview.png', 1, 1, '2023-05-20 04:10:44', '2023-06-28 05:46:16', NULL),
(2, 'Levi\'s', '16879509544834108_2525949-removebg-preview.png', 2, 1, '2023-05-20 04:11:07', '2023-06-28 05:45:54', NULL),
(3, 'Zara', '1687950934Tradesy-01-removebg-preview.png', 3, 1, '2023-05-20 04:11:18', '2023-06-28 05:45:34', NULL),
(4, 'Chanel', '1687950911825159_preview-removebg-preview (1).png', 3, 1, '2023-05-20 04:11:35', '2023-06-28 05:45:11', NULL),
(5, 'Louis Vuitton', '1687950862preview-removebg-preview.png', 4, 1, '2023-05-20 04:12:24', '2023-06-28 05:44:22', NULL),
(6, 'A Com', '1687950829Vector.png', 5, 1, '2023-05-20 04:12:51', '2023-06-28 05:43:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(15) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(15) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`) USING BTREE,
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(9, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `molie_payment_tracking`
--

DROP TABLE IF EXISTS `molie_payment_tracking`;
CREATE TABLE IF NOT EXISTS `molie_payment_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newslatter`
--

DROP TABLE IF EXISTS `newslatter`;
CREATE TABLE IF NOT EXISTS `newslatter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` varchar(100) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `notifiable_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) DEFAULT NULL,
  `invoice_prefix` varchar(26) DEFAULT 'INV',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `customer_group_id` int(11) DEFAULT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `shipping_name` varchar(32) NOT NULL,
  `shipping_address_1` varchar(128) DEFAULT NULL,
  `shipping_address_2` varchar(128) DEFAULT NULL,
  `shipping_city` varchar(128) NOT NULL,
  `shipping_postcode` varchar(10) DEFAULT NULL,
  `shipping_country_id` int(11) DEFAULT NULL,
  `comment` text,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `order_status_id` int(11) DEFAULT NULL,
  `commission` decimal(15,4) DEFAULT NULL,
  `tax_amount` decimal(15,2) DEFAULT '0.00',
  `discount` decimal(15,2) DEFAULT '0.00',
  `shipping_charge` decimal(15,2) DEFAULT '0.00',
  `payment_method` varchar(50) NOT NULL,
  `shipping_method` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(150) DEFAULT '',
  `grand_total` decimal(15,2) NOT NULL,
  `tracking` varchar(64) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `forwarded_ip` varchar(40) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `accept_language` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `billing_name` varchar(255) NOT NULL,
  `billing_address_1` text NOT NULL,
  `billing_address_2` text,
  `billing_city` varchar(255) NOT NULL,
  `billing_postcode` varchar(255) NOT NULL,
  `billing_country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `deleted_at` (`deleted_at`),
  KEY `total` (`total`),
  KEY `id` (`id`,`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_additional_field`
--

DROP TABLE IF EXISTS `order_additional_field`;
CREATE TABLE IF NOT EXISTS `order_additional_field` (
  `order_additional_field_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `cost` decimal(15,4) NOT NULL,
  `pp` decimal(15,4) NOT NULL,
  `ship` decimal(15,4) NOT NULL,
  `delivery` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `tracking` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order_custom` int(11) NOT NULL,
  `tracknum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_expected` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_additional_field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

DROP TABLE IF EXISTS `order_history`;
CREATE TABLE IF NOT EXISTS `order_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE IF NOT EXISTS `order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `special` decimal(15,2) DEFAULT '0.00',
  `image` varchar(150) DEFAULT NULL,
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `options` text,
  `reward` int(8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_shipment`
--

DROP TABLE IF EXISTS `order_shipment`;
CREATE TABLE IF NOT EXISTS `order_shipment` (
  `order_shipment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `shipping_courier_id` varchar(255) NOT NULL DEFAULT '',
  `tracking_number` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_shipment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `language_id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Pending', 1, '2022-06-03 10:05:17', '2022-06-03 10:05:17', NULL),
(2, NULL, 'Completed', 1, '2022-06-03 10:05:25', '2022-06-03 10:05:25', NULL),
(3, NULL, 'Shipped', 1, '2022-06-03 10:05:32', '2022-06-03 10:05:32', NULL),
(4, NULL, 'Denied', 1, '2022-06-03 10:05:40', '2022-06-03 10:05:40', NULL),
(5, NULL, 'Processing', 1, '2022-06-03 10:05:51', '2022-06-03 10:05:51', NULL),
(6, NULL, 'Refunded', 1, '2022-06-03 10:05:59', '2022-06-03 10:05:59', NULL),
(7, NULL, 'Canceled', 1, '2022-06-03 10:06:06', '2022-06-03 10:06:06', NULL),
(8, NULL, 'InComplete', 1, '2022-06-03 10:06:12', '2022-06-03 10:06:12', NULL),
(9, NULL, 'Delivered', 1, '2022-10-15 05:51:47', '2022-10-15 05:51:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_tax`
--

DROP TABLE IF EXISTS `order_tax`;
CREATE TABLE IF NOT EXISTS `order_tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `tax_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_amount` double(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_total`
--

DROP TABLE IF EXISTS `order_total`;
CREATE TABLE IF NOT EXISTS `order_total` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sort_order` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `heading`, `image`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Privacy Policy', 'Privacy Policy', NULL, '<p><strong>Privacy Policy</strong></p>\r\n\r\n<p><strong>It is hereby informed to every individuals who are using Otrixweb E-commerce Business platform, Otrixweb Business shall not be responsible for any lost delivery, false delivery, false delivery of product, broken delivery, permanent or temporary loss of product, only delivery partners are answerable for above terms. We at (original ecommerce) respect the trust you place in us and recognize the importance of secure transactions and information privacy. here our Privacy Policy illustrate that how Otrixweb E-commerce business Private Limited and its affiliates (collectively &ldquo;Otrixweb business, we, our, us&rdquo;) collect, use, share or otherwise process your personal information through Otrixweb website www.Otrixwebbusiness.com, its mobile application, and m-site (hereinafter referred to as the &ldquo;Platform&rdquo;).</strong></p>\r\n\r\n<p><strong>By visiting our Platform, you agree in providing your information or availing our product/service, you agree to be bound by the terms and conditions of this Privacy Policy, the Terms of Use and the applicable service/product terms and conditions. If you do not agree, please do not access or use our Platform.</strong></p>\r\n\r\n<p><strong>1. Collection and storage of Your Information</strong></p>\r\n\r\n<p><strong>&nbsp;Except making our platform easy, user friendly, interactive and transparent, &nbsp;we outsource most of the operations (like payments, delivery, buying, selling, advertising, etc. ) to third party vendors hence we are not responsible for any kind of conflicts, disputes, disagreement, any kind of visible or invisible issue or loss faced by anyone. When you chose to use our Platform, we collect and store your information which is provided by you from time to time. In general, you can browse the Platform without telling us who you are or revealing any personal information about yourself. Once you give us your personal information, you are the part of family to us. we indicate which fields are required and which fields are optional. You always have the option not to provide information by choosing not to use a particular service, product or feature on the Platform.</strong></p>\r\n\r\n<p><strong>at Otrixweb service we may track your buying habits, preferences, and other information that you choose to provide on our Platform. We use this information to do internal research on our users- interests, and habits to better understand, protect and serve you better. This information is compiled and analyzed on an aggregated basis. This information may include the URL that you just came from (whether this URL is on our Platform or not), which URL you next go to (whether this URL is on our Platform or not), your computer browser information, and your IP address. our service also &nbsp;collects personal information (such as email address, delivery address, name, phone number, credit card/debit card and other payment instrument details) from you when you set up an account or transact with us. While you can browse some sections of our Platform without being a registered member, certain activities (such as placing an order or consuming our online content &nbsp;or services) do require registration. We do use your contact information to send you offers based on your previous orders and your interests.</strong></p>\r\n\r\n<p><strong>If you choose to post messages on our message boards, chat rooms or other message areas or leave feedback or if you use voice commands to shop on the Platform, we will collect that information you provide to us. We retain this information as necessary to resolve disputes, provide customer support and troubleshoot problems as permitted by law.</strong></p>\r\n\r\n<p><strong>If you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities or postings on the Platform, we may collect such information into a file specific to you.</strong></p>\r\n\r\n<p><strong>If you are eligible into our O-Coins Loyalty Program, we will collect and store your personal information such as name, contact number, email address, communication address, date of birth, gender, zip code, lifestyle information, demographic and work details etc. which is provided by you to Otrixweb E- commerce business private ltd &nbsp;or a third-party business partner that operates online/offline establishments or platforms where you can earns O-Coins for purchase of goods and services, and redeem O-Coins. We will also collect your information related to your transactions on Otrixweb business platform and such third-party business partner platforms. When such a third-party business partner collects your personal information directly from you, you will be governed by their privacy policies. Otrixweb e-commerce shall not be responsible for the third-party business partner&rsquo;s privacy practices or the content of their privacy policies, and we request you to read their privacy policies prior to disclosing any information.</strong></p>\r\n\r\n<p><strong>Otrixweb has onboarded certain third-party business partners on the Platform who specialize in the categories like travel ticket reservations, booking online movie tickets, paying online bills and more (Ultra-Partners). If you use the services of Ultra-Partners, you will be redirected to Ultra-Partners websites/applications and your entry to Ultra-Partners websites/applications will be based on your Otrixweb login credentials after seeking your permissions to share the data further. Otrixweb shall not be responsible for the Ultra-Partner&rsquo;s privacy practices or the content of their privacy policies, and we request you to read their privacy policies prior to disclosing any information.</strong></p>\r\n\r\n<p><strong>2. Use of Demographic / Profile Data / Your Information</strong></p>\r\n\r\n<p><strong>We at Otrixweb business E- commerce private limited uses your personal information to provide the product and services you request. To the extent we use your personal information to market to you, we will provide you the ability to opt-out of such uses. We use your personal information to assist sellers and business partners in handling and fulfilling orders; enhancing customer experience; resolve disputes; troubleshoot problems; help promote a safe service; collect money; measure consumer interest in our products and services; inform you about online and offline offers, products, services, and updates; customize and enhance your experience; detect and protect us against error, fraud and other criminal activity; enforce our terms and conditions; and as otherwise described to you at the time of collection of information.</strong></p>\r\n\r\n<p><strong>With your consent, we will have access to your SMS, contacts in your directory, location and device information. We may also request you to provide your PAN, GST Number, Government issued ID cards/number and Know-Your-Customer (KYC) details to:</strong></p>\r\n\r\n<p><strong>&nbsp;(1.) check your eligibility for certain products and services including but not limited to credit and payment products;</strong></p>\r\n\r\n<p><strong>&nbsp;(2.) issue GST invoice for the products and services purchased for your business requirements;&nbsp;</strong></p>\r\n\r\n<p><strong>(3.) enhance your experience on the Platform and provide you access to the products and services being offered by us, sellers, affiliates or lending partners. You understand that your access to these products/services may be affected in the event consent is not provided to us.</strong></p>\r\n\r\n<p><strong>In our efforts to continually improve our product and service offerings, we and our affiliates collect and analyze demographic and profile data about our users&#39; activity on our Platform. We identify and use your IP address to help diagnose problems with our server, and to administer our Platform. Your IP address is also used to help identify you and to gather broad demographic information.</strong></p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>We will occasionally ask you to participate in optional surveys conducted either by us or through a third party market research agency. These surveys may ask you for personal information, contact information, date of birth, demographic information (like zip code, age, or income level), attributes such as your interests, household or lifestyle information, your purchasing habits or history, preferences, and other such information that you may choose to provide. The surveys may involve collection of voice data or video recordings, the participation of which would purely be voluntary in nature. We use this data to tailor your experience at our Platform, providing you with content that we think you might be interested in and to display content according to your preferences.</strong></p>\r\n\r\n<p><strong>3. Cookies</strong></p>\r\n\r\n<p><strong>We use data collection devices such as &quot;cookies&quot; on certain pages of the Platform to help analyze our web page flow, measure promotional effectiveness, and promote trust and safety. &quot;Cookies&quot; are small files placed on your hard drive that assist us in providing our services. Cookies do not contain any of your personal information. We offer certain features that are only available through the use of a &quot;cookie&quot;. We also use cookies to allow you to enter your password less frequently during a session. Cookies can also help us provide information that is targeted to your interests. Most cookies are &quot;session cookies,&quot; meaning that they are automatically deleted from your hard drive at the end of a session. You are always free to decline/delete our cookies if your browser permits, although in that case you may not be able to use certain features on the Platform and you may be required to re-enter your password more frequently during a session. Additionally, you may encounter &quot;cookies&quot; or other similar devices on certain pages of the Platform that are placed by third parties. We do not control the use of cookies by third parties. We use cookies from third-party partners such as Google Analytics for marketing and analytical purposes. Google Analytics help us understand how our customers use the site. You can read more about how Google uses your Personal Information. You can also opt-out of Google Analytics.</strong></p>\r\n\r\n<p><strong>4. Sharing of personal information</strong></p>\r\n\r\n<p><strong>We may share personal information with our other corporate entities and affiliates for purposes of providing products and services offered by them, such as, the deferred payment options at Otrixweb through its lending partners. These entities and affiliates may share such information with their affiliates, business partners and other third parties for the purpose of providing you their products and services, and may market to you as a result of such sharing unless you explicitly opt-out.</strong></p>\r\n\r\n<p><strong>We may disclose your personal information to third parties, such as sellers, business partners. This disclosure may be required for us to provide you access to our products and services; for fulfilment of your orders; for enhancing your experience; for providing feedback on products; to collect payments from you; to comply with our legal obligations; to conduct market research or surveys; to enforce our Terms of Use; to facilitate our marketing and advertising activities; to analyze data; for customer service assistance; to prevent, detect, mitigate, and investigate fraudulent or illegal activities related to our product and services. We do not disclose your personal information to third parties for their marketing and advertising purposes without your explicit consent.</strong></p>\r\n\r\n<p><strong>We may disclose personal information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to respond to subpoenas, court orders, or other legal process. We may disclose personal information to law enforcement agencies, third party rights owners, or others in the good faith belief that such disclosure is reasonably necessary to: enforce our Terms of Use or Privacy Policy; respond to claims that an advertisement, posting or other content violates the rights of a third party; or protect the rights, property or personal safety of our users or the general public.</strong></p>\r\n\r\n<p><strong>We and our affiliates will share / sell some or all of your personal information with another business entity should we (or our assets) plan to merge with, or be acquired by that business entity, or re-organization, amalgamation, restructuring of business. Should such a transaction occur that other business entity (or the new combined entity) will be required to follow this Privacy Policy with respect to your personal information.</strong></p>\r\n\r\n<p><strong>5. Links to Other Sites</strong></p>\r\n\r\n<p><strong>Our Platform may provide links to other websites or application that may collect personal information about you. We are not responsible for the privacy practices or the content of those linked websites.</strong></p>\r\n\r\n<p><strong>6. Security Precautions</strong></p>\r\n\r\n<p><strong>We maintain reasonable physical, electronic and procedural safeguards to protect your information. Whenever you access your account information, we offer the use of a secure server. Once your information is in our possession we adhere to our security guidelines to protect it against unauthorized access. However, by using the Platform, the users accept the inherent security implications of data transmission over the internet and the World Wide Web which cannot always be guaranteed as completely secure, and therefore, there would always remain certain inherent risks regarding use of the Platform. Users are responsible for ensuring the protection of login and password records for their account.</strong></p>\r\n\r\n<p><strong>7. Choice/Opt-Out</strong></p>\r\n\r\n<p><strong>We provide all users with the opportunity to opt-out of receiving non-essential (promotional, marketing-related) communications after setting up an account with us. If you do not wish to receive promotional communications from us then please login into the Notification Preference page of Platform to unsubscribe/opt-out.</strong></p>\r\n\r\n<p><strong>8. Advertisements on Platform</strong></p>\r\n\r\n<p><strong>We use third-party advertising companies to serve ads when you visit our Platform. These companies may use information (not including your name, address, email address, or telephone number) about your visits to this and other websites in order to provide advertisements about goods and services of interest to you.</strong></p>\r\n\r\n<p><strong>9. Children Information</strong></p>\r\n\r\n<p><strong>We do not knowingly solicit or collect personal information from children under the age of 18 and use of our Platform is available only to persons who can form a legally binding contract under the Indian Contract Act, 1872. If you are under the age of 18 years then you must use the Platform, application or services under the supervision of your parent, legal guardian, or any responsible adult.</strong></p>\r\n\r\n<p><strong>10. Data Retention</strong></p>\r\n\r\n<p><strong>We retain your personal information in accordance with applicable laws, for a period no longer than is required for the purpose for which it was collected or as required under any applicable law. However, we may retain data related to you if we believe it may be necessary to prevent fraud or future abuse or if required by law or for other legitimate purposes. We may continue to retain your data in anonymized form for analytical and research purposes.</strong></p>\r\n\r\n<p><strong>11. Your Consent</strong></p>\r\n\r\n<p><strong>By visiting our Platform or by providing your information, you consent to the collection, use, storage, disclosure and otherwise processing of your information (including sensitive personal information) on the Platform in accordance with this Privacy Policy. If you disclose to us any personal information relating to other people, you represent that you have the authority to do so and to permit us to use the information in accordance with this Privacy Policy.</strong></p>\r\n\r\n<p><strong>You, while providing your personal information over the Platform or any partner platforms or establishments, consent to us (including our other corporate entities, affiliates, lending partners, technology partners, marketing channels, business partners and other third parties) to contact you through SMS, instant messaging apps, call and/or e-mail for the purposes specified in this Privacy Policy.</strong></p>\r\n\r\n<p><strong>12. Changes to this Privacy Policy</strong></p>\r\n\r\n<p><strong>Please check our Privacy Policy periodically for changes. We may update this Privacy Policy to reflect changes to our information practices. We will alert you to significant changes by posting the date our policy got last updated, placing a notice on our Platform, or by sending you an email when we are required to do so by applicable law.</strong></p>\r\n\r\n<p><strong>14. Queries</strong></p>\r\n\r\n<p><strong>If you have any query, issue, concern, or complaint in relation to collection or usage of your personal information under this Privacy Policy, please contact us at the contact information provided above.</strong></p>', '2021-12-14 01:38:01', '2023-03-14 00:36:28', NULL),
(2, 'Terms and Conditions', 'Terms and Conditions', NULL, '<p><strong>Terms &amp; Conditions</strong></p>\n\n<p><strong>1. It is hereby informed to every individuals who are using Otrixweb E-commerce Business platform, Otrixweb Business shall not be responsible for any lost delivery, false delivery, false delivery of product, broken delivery, permanent or temporary loss of product, only delivery partners are answerable for above terms.</strong></p>\n\n<p><strong>2. It is hereby informed that neither we at Otrixweb E-commerce Business are manufacturer nor we are trader we are only providing the platform from where anyone globally make a purchasing request for their wished product manufacturer and we are a bridge between seller and customer.</strong></p>\n\n<p><strong>3. Here at Otrixweb E-commerce Business we try our best to establish a transparent relation between customers and sellers in order to maintain the dignity of original products deliver to you.</strong></p>\n\n<p><strong>4. Except making our platform easy, user friendly, interactive and transparent, &nbsp;we outsource most of the operations (like payments, delivery, buying, selling, advertising, etc. ) to third party vendors hence we are not responsible for any kind of conflicts, disputes, disagreement, any kind of visible or invisible issue or loss faced by anyone.</strong></p>\n\n<p><strong>5. We reserve all direct and indirect rights related to Otrixweb E-commerce Business with us, hence we emphasis on policy i.e. at Otrixweb E-commerce Business we can modify or discontinue any privacy policy, any agreements, contracts, terms and conditions with any partner, collaborations with any third party vendor, partner or costumers without any prior notice, in case of misuse noticed. It is entirely the responsibility of our partners, collaborations, and our customers to follow our terms and condition, privacy policies and contract update regularly.</strong></p>\n\n<p><strong>6. Sharing of personal information</strong></p>\n\n<p><strong>We may share personal information with our other corporate entities and affiliates for purposes of providing products and services offered by them, such as, the deferred payment options at Otrixweb through its lending partners. These entities and affiliates may share such information with their affiliates, business partners and other third parties for the purpose of providing you their products and services, and may market to you as a result of such sharing unless you explicitly opt-out.</strong></p>\n\n<p><strong>7.We may disclose your personal information to third parties, such as sellers, business partners. This disclosure may be required for us to provide you access to our products and services; for fulfilment of your orders; for enhancing your experience; for providing feedback on products; to collect payments from you; to comply with our legal obligations; to conduct market research or surveys; to enforce our Terms of Use; to facilitate our marketing and advertising activities; to analyze data; for customer service assistance; to prevent, detect, mitigate, and investigate fraudulent or illegal activities related to our product and services. We do not disclose your personal information to third parties for their marketing and advertising purposes without your explicit consent.</strong></p>\n\n<p><strong>8. We respect, follow and adhere the law and order of all the states, territories and nationwide but &nbsp;we shall not be responsible for any legal actions or allegation taking against Otrixweb E-commerce Business Private LTD, in or at the spot of allegation or difficulty faced by any company, partners, or customers in their home town. We respond each and every legal queries or complaint filled against us and will be entertained only in law and order body operational in capital of India &nbsp;at origin of our headquarters, only in the case when our customer handling team unable to solve the allegations or any difficulties faced by anyone across.</strong></p>', '2021-12-14 01:46:43', '2022-03-09 02:08:41', NULL);
INSERT INTO `pages` (`id`, `title`, `heading`, `image`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Return & Refund Policy', 'Return & Refund Policy', NULL, '<div class=\"content\"><p>Return policy Otrixweb</p><p><br></p><h1 dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: center;background-color:#ffffff;margin-top:15pt;margin-bottom:0pt;padding:0pt 0pt 4pt 0pt;\"><span style=\"font-size:16.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Returns Policy</span></h1><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:7pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Returns is a scheme provided by respective sellers directly under this policy in terms of which the option of exchange, replacement and/ or refund is offered by the respective sellers to you. All products listed under a particular category may not have the same returns policy. For all products, the returns/replacement policy provided on the product page shall prevail over the general returns policy. Do refer the respective item\'s applicable return/replacement policy on the product page for any exceptions to this returns policy and the table below</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The return policy is divided into three parts; Do read all sections carefully to understand the conditions and cases under which returns will be accepted.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Part 1 – Category, Return Window and Actions possible</span></p><div dir=\"ltr\" style=\"margin-left:0pt;\" align=\"left\"><table style=\"border:none;border-collapse:collapse;\"><colgroup><col width=\"168\"><col width=\"423\"></colgroup><tbody><tr style=\"height:39.75pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Category</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Returns Window, Actions Possible and Conditions (if any)</span></p></td></tr><tr style=\"height:213pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Lifestyle: Kid’s (Capri, Shorts &amp; Tops), Men’s (Ethnic Wear, Shirt, Formals, Jeans, Clothing Accessory), Women’s (Ethnic Wear, Fabric, Blouse, Jean, Skirt, Trousers, Bra), Bags, Raincoat, Sunglass, Belt, Frame, Backpack, Suitcase, Luggage</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Refund, replacement or exchange</span></p></td></tr><tr style=\"height:287.25pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Lifestyle: Jewelry, Footwear Accessories, Travel Accessories, Watch Accessories, Winter Wear (Blazer, Sweatshirt, Scarf, Shawl, Jacket, Coat, Sweater, Thermal, Kid’s Thermal, Track Pant, Shrugs)</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Home: Pet Supplies &amp; Rest of Home. (Except Home décor, Furnishing, Home Improvement Tools, Household Items)</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Refund or replacement</span></p></td></tr><tr style=\"height:66.75pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Watch, Footwear and Rest of Lifestyle</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Refund, replacement or exchange</span></p></td></tr><tr style=\"height:66.75pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Medicine (Allopathy &amp; Homeopathy)</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Refund</span></p></td></tr><tr style=\"height:87pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Home: Home Improvement Tools, Household Items, Home décor, Furnishing</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Refund or replacement</span></p></td></tr><tr style=\"height:246.75pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Books (All books)</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Sports Equipment (Racquet, ball, support, gloves, bags etc.)&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Exercise &amp; Fitness Equipment (Home Gym combos, dumbbell etc.)</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Auto Accessories - Car and Bike accessories (helmets, car kit, media players etc.)</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days Replacement only</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Free replacement will be provided within 3 days if the product is delivered in defective/damaged condition or different from the ordered item.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Please keep the product intact, with original accessories, user manual and warranty cards in the original packaging at the time of returning the product.&nbsp;</span></p></td></tr><tr style=\"height:246.75pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Toys (Remote controlled toys, Learning toys, Stuffed toys etc.)</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Stationary (Pens, Diary notebooks, Calculators etc.)</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Musical Instruments (Microphones &amp; Accessories, Guitars, Violins etc.)</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3&nbsp; days Replacement only</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Free replacement will be provided within 10 days if the product is delivered in defective/damaged condition or different from the ordered item.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Please keep the product intact, with original accessories, user manual and warranty cards in the original packaging at the time of returning the product.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Non Returnable- All Wind Instruments (Harmonicas, Flutes etc.) This item is non-returnable due to hygiene and personal wellness. In case these products are delivered in damaged/defective condition or different from the ordered item, we will provide a free replacement.</span></p></td></tr><tr style=\"height:267pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">All Mobiles (except Apple / Google phones),</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Electronics - (except Apple / Beats, Google, Realme, Samsung, JBL or Infinity, Epson, HP, Dell, Canon, MI Products (Tablets, Laptops, Smart Watches)</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">All Small Home Appliances (Except Chimney, Water Purifier, Fan, Geyser)</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Replacement only</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">In order to help you resolve issues with your product, we may troubleshoot your product either through online tools, over the phone, and/or through an in-person technical visit.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">If a defect is determined within the Returns Window, a replacement of the same model will be provided at no additional cost. If no defect is confirmed or the issue is not diagnosed within 3 days of delivery, you will be directed to a brand service centre to resolve any subsequent issues.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">In any case, only one replacement shall be provided.</span></p></td></tr><tr style=\"height:935.25pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Mobile - Apple &amp; Google.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Electronics - Apple / Beats, Google, Realme, Samsung, JBL &amp; Infinity, Epson, HP, Dell, Canon &amp; MI Products (Tablets, Laptops, Smart Watches)</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">For any other issues with the product you may contact the concerned brand’s support.</span></p></td></tr><tr style=\"height:316.5pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Furniture, Large appliances</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Rest of Small Home Appliances - Chimney, Water Purifier, Fan, Geyser only</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Replacement only</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">For products requiring installation, returns shall be eligible only when such products are installed by the brand\'s authorized personnel.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">In order to help you resolve issues with your product, we may troubleshoot your product either through online tools, over the phone, and/or through an in-person technical visit.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">If a defect is determined within the Returns Window, a replacement of the same model will be provided at no additional cost. If no defect is confirmed or the issue is not diagnosed within 3 days of delivery or Installation wherever applicable, you will be directed to a brand service centre to resolve any subsequent issues.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">In any case, only one replacement shall be provided.</span></p></td></tr><tr style=\"height:71.25pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Grocery - (Dairy, Bakery, Fruits and Vegetables)</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2 Days Refund Only</span></p></td></tr><tr style=\"height:172.5pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Grocery - (Remaining items under grocery)</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Refund only</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Fruits and Vegetables ordered would be delivered only in the first attempt. In order to ensure that you get fresh fruits and vegetables, we will not be making reattempts to deliver your fruits and veggies in case you miss your slot. Rest of grocery items from Supermarket would be delivered through reattempt in case you miss your slot.</span></p></td></tr><tr style=\"height:183.75pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Try &amp; Buy</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3 days</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Refund only</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">This policy shall be applicable selectively (geographical coverage, product, customer and time periods).</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Try &amp; Buy benefits shall be applicable only if the product was bought when the item was on Try &amp; Buy. Else normal category policy shall apply on the order. In any case, only one replacement shall be provided.</span></p></td></tr><tr style=\"height:98.25pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">No Returns categories</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Some products in the above categories are not returnable due to their nature or other reasons. For all products, the policy on the product page shall prevail.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">You can view the complete list of non-returnable products.</span></p></td></tr></tbody></table></div><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Part 2 - Returns Pick-Up and Processing</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">In case of returns where you would like item(s) to be picked up from a different address, the address can only be changed if pick-up service is available at the new address</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">During pick-up, your product will be checked for the following conditions:</span></p><div dir=\"ltr\" style=\"margin-left:0pt;\" align=\"left\"><table style=\"border:none;border-collapse:collapse;\"><colgroup><col width=\"94\"><col width=\"497\"></colgroup><tbody><tr style=\"height:39.75pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Category</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Conditions</span></p></td></tr><tr style=\"height:55.5pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Correct Product</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">IMEI/ name/ image/ brand/ serial number/ article number/ bar code should match and the MRP tag should be undetached and clearly visible.</span></p></td></tr><tr style=\"height:71.25pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Complete Product</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">All in-the-box accessories (like remote control, starter kits, instruction manuals, chargers, headphones, etc.), freebies and combos (if any) should be present.</span></p></td></tr><tr style=\"height:102.75pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Unused Product</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The product should be unused, unwashed, unsoiled, without any stains and with non-tampered quality check seals/return tags/warranty seals (wherever applicable). Before returning a Mobile/ Laptop/ Tablet, the device should be formatted and Screen Lock (Pin, Pattern or Fingerprint) must be disabled. iCloud lock must be disabled for Apple devices.</span></p></td></tr><tr style=\"height:55.5pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Undamaged Product</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The product (including SIM trays/ charging port/ headphone port, back-panel etc.) should be undamaged and without any scratches, dents, tears or holes.</span></p></td></tr><tr style=\"height:55.5pt\"><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Undamaged Packaging</span></p></td><td style=\"border-left:solid #000000 0.75pt;border-right:solid #000000 0.75pt;border-bottom:solid #000000 0.75pt;border-top:solid #000000 0.75pt;vertical-align:top;background-color:#ffffff;padding:6pt 6pt 6pt 6pt;overflow:hidden;overflow-wrap:break-word;\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Product\'s original packaging/ box should be undamaged.</span></p></td></tr></tbody></table></div><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The field executive will refuse to accept the return if any of the above conditions are not met.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">For any products for which a refund is to be given, the refund will be processed once the returned product has been received by the seller.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Part 3 - General Rules for a successful Return</span></p><ol style=\"margin-top:0;margin-bottom:0;padding-inline-start:48px;\"><li dir=\"ltr\" style=\"list-style-type:decimal;font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">In certain cases where the seller is unable to process a replacement for any reason whatsoever, a refund will be given.</span></p></li><li dir=\"ltr\" style=\"list-style-type:decimal;font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">During open box deliveries, while accepting your order, if you received a different or a damaged product, you will be given a refund (on the spot refunds for cash-on-delivery orders). Once you have accepted an open box delivery, no return request will be processed, except for manufacturing defects. In such cases, this category-specific replacement/return general conditions will be applicable.</span></p></li><li dir=\"ltr\" style=\"list-style-type:decimal;font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;\" role=\"presentation\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">For products where installation is provided by Otrixweb Ecommerce\'s service partners, do not open the product packaging by yourself. Otrixweb Ecommerce authorized personnel shall help in unboxing and installation of the product.</span></p></li><li dir=\"ltr\" style=\"list-style-type:decimal;font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;\" aria-level=\"1\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 6pt 0pt;\" role=\"presentation\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">For Furniture, any product related issues will be checked by an authorized service personnel (free of cost) and attempted to be resolved by replacing the faulty/ defective part of the product. Full replacement will be provided only in cases where the service personnel opines that replacing the faulty/defective part will not resolve the issue.</span></p></li></ol><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:11pt;margin-bottom:0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Wrong Delivery - (Customer received delivery message, product not delivered):</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;padding:11pt 0pt 0pt 0pt;\"><span style=\"font-size:10.5pt;font-family:Roboto,sans-serif;color:#212121;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">\'In case the product was not delivered and you received a delivery confirmation email/SMS, report the issue within 3 days from the date of delivery confirmation for the seller to investigate.\'</span></p><p><span id=\"docs-internal-guid-4e0e88e7-7fff-71a6-1506-f50041705a39\"></span></p><p dir=\"ltr\" style=\"line-height:1.656;background-color:#ffffff;margin-top:0pt;margin-bottom:0pt;\">&nbsp;</p></div>', '2022-03-09 00:48:07', '2022-03-09 03:26:03', NULL);
INSERT INTO `pages` (`id`, `title`, `heading`, `image`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Shipping & Delivery Policy', 'Shipping & Delivery Policy', NULL, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2022-03-09 00:48:36', '2022-03-09 01:59:09', NULL),
(6, 'About Us', 'About Us', NULL, '<div class=\"post-entry post-entry-type-page post-entry-19\"><div class=\"entry-content-wrapper clearfix\"><div class=\"flex_column av_one_full  flex_column_div first  nConfig-builder-el-0  nConfig-builder-el-no-sibling  \"><section class=\"av_textblock_section \" itemscope=\"itemscope\" itemtype=\"https://schema.org/CreativeWork\"><div class=\"nConfig_textblock  \" itemprop=\"text\"><div>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>\r\n<div>\r\n<div>\r\n<div>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div></div>\r\n</div>\r\n</div>\r\n<div></div>\r\n</div></section></div>\r\n</div></div>', '2023-02-21 08:25:10', '2023-02-21 08:25:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_key` text COLLATE utf8mb4_unicode_ci,
  `payment_secret` text COLLATE utf8mb4_unicode_ci,
  `payment_mode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'sandbox',
  `payment_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) DEFAULT NULL,
  `merchant_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `payment_key`, `payment_secret`, `payment_mode`, `payment_logo`, `payment_code`, `is_active`, `sort_order`, `merchant_email`, `payment_url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cash On Delivery', NULL, NULL, 'sandbox', '1690611045cod.png', 'cod', 1, 1, NULL, NULL, '2023-07-29 06:14:34', '2023-07-29 06:14:34', NULL),
(2, 'Pay Using Stripe', 'pk_test_51KZB5mSFKb7Drzdn9UVkwWXD8akrnKLm7sPgqLTak8T1n2vCV5L7KbrU3HW3UCboHAxan7Mj578KjjHDWAAHvqje00QqxIzh52', 'sk_test_51KZB5mSFKb7DrzdnNPXXTkVPd06LDXEMGOijnyPQ8e61KEZFt4WuwIMWUDbwLonW6mCwS2n7DuvDIwsvKDu8CwIx00mmfcOP2T', 'sandbox', 'stripe.png', 'stripe', 1, 2, NULL, NULL, '2023-07-29 09:41:13', '2023-07-29 09:41:13', NULL),
(3, 'Pay Using Razorpay', 'rzp_test_qhgjTZvUnR2zBo', 'VfEyVCSQJ4lo0VnSfZOPdZVZ', 'sandbox', 'razorpay.png', 'razorpay', 1, 3, NULL, NULL, '2023-07-29 05:40:15', NULL, NULL),
(4, 'Pay Using Mollie', 'test_gd7Jkx62UPFbMSEWHaFkEKe8B2y2cn', NULL, 'sandbox', 'mollie.png', 'mollie', 1, 4, NULL, NULL, '2023-07-29 05:42:09', NULL, NULL),
(5, 'Pay Using Paypal', 'AVOKzy6fM4RO9a5NhhV5FaR7rXAusAvwLH7DIfs1_dqd0RIF6tziSfhzGHWSTrso5dz3DOZGjLAeN_MY', 'EJnW1djG0R1mM5IbgrBk24Z-QtCuwm_8DHVnsy6DX2t0v8kp48B7rMEKoR6yorMoRAUhRaKBwfqzvVaK', 'sandbox', 'paypal.png', 'paypal', 1, 5, NULL, NULL, '2023-07-29 05:43:07', NULL, NULL),
(6, 'Pay Using Pay Stack', 'pk_test_8e4f507010a05f4626cb2316a267dc6d88d1e9d4', 'sk_test_67b1e4c6a8b92a5014b0ff214b9d0a9c613c173f', 'sandbox', 'paystack-2.svg', 'paystack', 1, 6, 'abdullah.return@gmail.com', NULL, '2023-08-07 13:15:06', NULL, NULL),
(7, 'Pay Using Instamojo', 'test_4216589105cd74e46523fce583a', 'test_64c42fb0257ba5bb86dfae439fb', 'sandbox', 'instamojo.png', 'instamojo', 1, 7, NULL, 'https://test.instamojo.com/api/1.1/', '2023-08-08 11:36:36', '2023-08-08 06:06:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'customer.add', 'Add', 'web', '2021-07-07 03:37:38', '2021-07-07 05:27:28'),
(2, 'customer.edit', 'Edit', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(3, 'customer', 'List', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(4, 'customer.delete', 'Delete', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(5, 'category.add', 'Add', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(6, 'category.edit', 'Edit', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(7, 'category', 'List', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(8, 'category.delete', 'Delete', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(9, 'banner.add', 'Add', 'web', '2021-07-07 05:47:44', '2021-07-07 05:47:44'),
(10, 'banner.edit', 'Edit', 'web', '2021-07-07 05:47:44', '2021-07-07 05:47:44'),
(11, 'banner', 'List', 'web', '2021-07-07 05:47:44', '2021-07-07 05:47:44'),
(12, 'banner.delete', 'Delete', 'web', '2021-07-07 05:47:44', '2021-07-07 05:47:44'),
(15, 'permission', 'List', 'web', '2021-07-07 06:03:37', '2021-07-07 06:03:37'),
(17, 'role.add', 'Add', 'web', '2021-07-07 06:03:37', '2021-07-07 06:03:37'),
(19, 'role', 'List', 'web', '2021-07-07 06:03:37', '2021-07-07 06:03:37'),
(20, 'role.delete', 'Delete', 'web', '2021-07-07 06:03:37', '2021-07-07 06:03:37'),
(21, 'product.add', 'Add', 'web', '2021-07-07 14:49:34', '2021-07-07 14:49:34'),
(22, 'product.edit', 'Edit', 'web', '2021-07-07 14:49:34', '2021-07-07 14:49:34'),
(23, 'product', 'List', 'web', '2021-07-07 14:49:34', '2021-07-07 14:49:34'),
(24, 'product.delete', 'Delete', 'web', '2021-07-07 14:49:34', '2021-07-07 14:49:34'),
(25, 'length-class.add', 'Add', 'web', '2021-07-07 15:23:07', '2021-07-07 15:23:07'),
(26, 'length-class.edit', 'Edit', 'web', '2021-07-07 15:23:07', '2021-07-07 15:23:07'),
(27, 'length-class', 'List', 'web', '2021-07-07 15:23:07', '2021-07-07 15:23:07'),
(28, 'length-class.delete', 'Delete', 'web', '2021-07-07 15:23:07', '2021-07-07 15:23:07'),
(29, 'role.edit', 'Edit', 'web', '2021-07-07 16:02:26', '2021-07-07 16:02:26'),
(30, 'country.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(31, 'country.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(32, 'country', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(33, 'country.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(34, 'tax-rate.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(35, 'tax-rate.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(36, 'tax-rate', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(37, 'tax-rate.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(38, 'stock-status.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(39, 'stock-status.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(40, 'stock-status', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(41, 'stock-status.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(42, 'weight-class.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(43, 'weight-class.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(44, 'weight-class', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(45, 'weight-class.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(46, 'review', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(47, 'manufacturer.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(48, 'manufacturer.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(49, 'manufacturer.review', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(50, 'manufacturer.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(51, 'order-status.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(52, 'order-status.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(53, 'order-status', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(54, 'order-status.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(55, 'order.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(56, 'order.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(57, 'order', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(58, 'order.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(59, 'coupon.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(60, 'coupon.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(61, 'coupon', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(62, 'coupon.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(63, 'product-option.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(64, 'product-option.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(65, 'product-option', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(66, 'product-option.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(67, 'setting.add', 'Add', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(68, 'setting.edit', 'Edit', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(69, 'setting', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(70, 'setting.delete', 'Delete', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(71, 'user.add', 'Add', 'web', '2021-07-08 08:29:04', '2021-07-08 08:29:04'),
(72, 'user.edit', 'Edit', 'web', '2021-07-08 08:29:04', '2021-07-08 08:29:04'),
(73, 'user', 'List', 'web', '2021-07-08 08:29:04', '2021-07-08 08:29:04'),
(74, 'user.delete', 'Delete', 'web', '2021-07-08 08:29:04', '2021-07-08 08:29:04'),
(75, 'product-attribute-group.add', 'Add', 'web', '2021-07-10 02:29:04', '2021-07-10 02:29:04'),
(76, 'product-attribute-group.edit', 'Edit', 'web', '2021-07-10 02:29:04', '2021-07-10 02:29:04'),
(77, 'product-attribute-group', 'List', 'web', '2021-07-10 02:29:04', '2021-07-10 02:29:04'),
(78, 'product-attribute-group.delete', 'Delete', 'web', '2021-07-10 02:29:04', '2021-07-10 02:29:04'),
(79, 'product-attribute.add', 'Add', 'web', '2021-07-10 03:51:59', '2021-07-10 03:51:59'),
(80, 'product-attribute.edit', 'Edit', 'web', '2021-07-10 03:51:59', '2021-07-10 03:51:59'),
(81, 'product-attribute', 'List', 'web', '2021-07-10 03:51:59', '2021-07-10 03:51:59'),
(82, 'product-attribute.delete', 'Delete', 'web', '2021-07-10 03:51:59', '2021-07-10 03:51:59'),
(85, 'seller', 'List', 'web', NULL, NULL),
(86, 'permission.add', 'Add', 'web', '2021-07-07 06:03:37', '2021-07-07 06:03:37'),
(87, 'manufacturer', 'List', 'web', '2021-07-07 16:19:02', '2021-07-07 16:19:02'),
(88, 'pages.add', 'Add', 'web', '2021-07-07 03:37:38', '2021-07-07 05:27:28'),
(89, 'pages.edit', 'Edit', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(90, 'pages', 'List', 'web', '2021-07-07 05:27:28', '2021-07-07 05:27:28'),
(91, 'trending_dod', 'Trending And DOD  List Permissions', 'web', NULL, NULL),
(92, 'trending_dod.add', 'Trending And DOD Add', 'web', NULL, NULL),
(93, 'trending_dod.edit', 'Trending And DOD Update', 'web', NULL, NULL),
(94, 'shipping', 'List Shipping', 'web', NULL, NULL),
(95, 'shipping.add', 'Add Shipping', 'web', NULL, NULL),
(96, 'shipping.edit', 'Edit Shipping', 'web', NULL, NULL),
(97, 'shipping.delete', 'Shipping Delete', 'web', NULL, NULL),
(98, 'order.view', 'Order View', 'web', NULL, NULL),
(99, '234', '234', 'web', NULL, NULL),
(100, 'language', 'Language List', 'web', NULL, NULL),
(101, 'language.add', 'Language Add', 'web', NULL, NULL),
(102, 'language.edit', 'Language Update', 'web', NULL, NULL),
(103, 'language.delete', 'Language Delete', 'web', NULL, NULL),
(104, 'notifications', 'Notification Vieww', 'web', NULL, NULL),
(105, 'notifications.add', 'Create Notification', 'web', NULL, NULL),
(106, 'newslatter.add', 'News Latter Add', 'web', NULL, NULL),
(107, 'newslatter.send', 'Newslatter Send', 'web', NULL, NULL),
(108, 'emailmarketing.add', 'Email marketing Add', 'web', NULL, NULL),
(109, 'emailmarketing.send', 'Email Marketing Send', 'web', NULL, NULL),
(110, 'smsmarketing.add', 'Sms Marketing', 'web', NULL, NULL),
(111, 'smsmarketing.send', 'Sms Marketing Send', 'web', NULL, NULL),
(112, 'contact-us', 'View Contact us', 'web', NULL, NULL),
(113, 'featured-product', 'featured-product', 'web', NULL, NULL),
(114, 'setting.general', 'General Setting', 'web', NULL, NULL),
(115, 'setting.email', 'Email Setting', 'web', NULL, NULL),
(116, 'setting.emailtemplate', 'Email Template', 'web', NULL, NULL),
(117, 'setting.seo', 'Seo Setting', 'web', NULL, NULL),
(118, 'setting.socialmedia', 'Social Media Setting', 'web', NULL, NULL),
(119, 'blog', 'Blog List', 'web', NULL, NULL),
(120, 'blog.add', 'Blog Add', 'web', NULL, NULL),
(121, 'blog.edit', 'Blog Edit', 'web', NULL, NULL),
(122, 'blog.delete', 'Blog Delete', 'web', NULL, NULL),
(123, 'homepage_category', 'Home page category product', 'web', NULL, NULL),
(124, 'setting.label', 'Label Settting', 'web', NULL, NULL),
(125, 'payment-methods', 'List Payment Method', 'web', NULL, NULL),
(126, 'payment-methods.add', 'Add Payment Method', 'web', NULL, NULL),
(127, 'payment-methods.edit', 'Edit Payment Method', 'web', NULL, NULL),
(128, 'payment-methods.delete', 'Delete payment methods', 'web', NULL, NULL),
(129, 'order.downloadpdf', 'Download PDF', 'web', NULL, NULL),
(130, 'user.changePassword', 'Change Admin Password', 'web', NULL, NULL),
(131, 'setting.sms', 'SMS Setting', 'web', NULL, NULL),
(132, 'setting.websiteTheme', 'Website theme setting', 'web', NULL, NULL),
(133, 'geozone', 'List Geo Zone', 'web', NULL, NULL),
(134, 'geozone.add', 'Geo Zone Add', 'web', NULL, NULL),
(135, 'geozone.delete', 'Geo Zone Delete', 'web', NULL, NULL),
(136, 'geozone.edit', 'Edit Geo Zone', 'web', NULL, NULL),
(137, 'tax-class', 'List Tax Class', 'web', NULL, NULL),
(138, 'tax-class.add', 'Add Tax Class', 'web', NULL, NULL),
(139, 'tax-class.edit', 'Edit Tax Class', 'web', NULL, NULL),
(140, 'tax-class.delete', 'Delete Tax Class', 'web', NULL, NULL),
(141, 'state', 'List State', 'web', NULL, NULL),
(142, 'state.add', 'Add State', 'web', NULL, NULL),
(143, 'state.edit', 'Edit State', 'web', NULL, NULL),
(144, 'state.delete', 'Delete State', 'web', NULL, NULL),
(145, 'review.delete', 'Delete Review', 'web', NULL, NULL),
(146, 'review.edit', 'Edit Review', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `jan` varchar(13) DEFAULT NULL,
  `isbn` varchar(17) DEFAULT NULL,
  `mpn` varchar(64) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `quantity` int(6) NOT NULL DEFAULT '0',
  `stock_status_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `shipping` enum('Yes','No') DEFAULT 'No',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `points` int(8) DEFAULT '0',
  `tax_rate_id` int(11) DEFAULT NULL,
  `date_available` date DEFAULT NULL,
  `weight` decimal(15,4) DEFAULT '0.0000',
  `weight_class_id` int(11) DEFAULT '0',
  `length` decimal(15,4) DEFAULT '0.0000',
  `width` decimal(15,4) DEFAULT '0.0000',
  `height` decimal(15,4) DEFAULT '0.0000',
  `length_class_id` int(11) DEFAULT '0',
  `subtract` tinyint(1) DEFAULT '1',
  `minimum` int(11) DEFAULT '1',
  `sort_order` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `viewed` int(5) DEFAULT '0',
  `sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `seller_id`, `model`, `jan`, `isbn`, `mpn`, `location`, `quantity`, `stock_status_id`, `image`, `manufacturer_id`, `shipping`, `price`, `points`, `tax_rate_id`, `date_available`, `weight`, `weight_class_id`, `length`, `width`, `height`, `length_class_id`, `subtract`, `minimum`, `sort_order`, `status`, `viewed`, `sku`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, NULL, 'SMART-512', NULL, NULL, NULL, NULL, 4947, NULL, '168795383627-running-shoes-png-image 1 (1).png', 4, 'No', '50.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'smarsads', '2023-05-01 06:33:56', '2023-08-19 09:22:35', NULL),
(2, 7, NULL, 'Headphone', NULL, NULL, NULL, NULL, 4938, NULL, '1689405160168796277032767-2-axe-spray-transparent-background_1__1_-removebg-preview.png', 6, 'No', '60.00', 0, 5, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'jghjbvyhead', '2023-05-01 09:02:50', '2023-08-19 09:22:37', NULL),
(3, 1, NULL, 'TSHIR', NULL, NULL, NULL, NULL, 49980, NULL, '16894050301687963110image_11-removebg-preview (1).png', 3, 'No', '90.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'tshirtfsr3', '2023-05-01 09:08:30', '2023-08-19 09:19:39', NULL),
(4, 6, NULL, 'BABY50', NULL, NULL, NULL, NULL, 3992, NULL, '16894050161687963375image_12-removebg-preview.png', 1, 'No', '30.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'fhgc65', '2023-05-01 09:12:55', '2023-08-19 09:13:14', NULL),
(5, 1, NULL, 'TSHI66', NULL, NULL, NULL, NULL, 4989, NULL, '168796400217-dress-shirt-png-image 1.png', 3, 'No', '80.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'cvghc55', '2023-05-01 09:23:22', '2023-08-19 09:13:15', NULL),
(6, 2, NULL, 'PARTY10', NULL, NULL, NULL, NULL, 904, NULL, '16894050021687963375image_13-removebg-preview.png', 2, 'No', '69.00', 0, 5, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'a53d', '2023-05-01 09:27:40', '2023-08-19 08:57:30', NULL),
(7, 3, NULL, 'NIKE-99', NULL, NULL, NULL, NULL, 1000, 0, '168797944432-running-shoes-png-image 1 (1).png', 5, 'No', '99.00', 0, 0, '2023-06-28', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sdfgf99', '2023-05-01 13:40:44', '2023-06-28 19:15:01', '2023-06-28 13:45:01'),
(8, 3, NULL, 'NIKE-99', NULL, NULL, NULL, NULL, 9996, NULL, '168797967232-running-shoes-png-image 1 (1).png', 5, 'No', '99.00', 0, NULL, '2023-06-28', '50.0000', 1, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'niscl', '2023-05-01 13:44:23', '2023-08-19 08:57:33', NULL),
(9, 7, NULL, 'HEADPHONE-21', NULL, NULL, NULL, NULL, 5992, NULL, '1689404981168797984127019-3-female-shoes-file_1__1_-removebg-preview.png', 4, 'No', '59.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '56asdsa', '2023-05-01 13:47:21', '2023-08-19 08:55:34', NULL),
(10, 2, NULL, 'PARTY-W50', NULL, NULL, NULL, NULL, 4994, NULL, '16894051281687963375image_14-removebg-preview.png', 1, 'No', '50.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sadasd50', '2023-05-01 13:50:37', '2023-08-19 08:56:26', NULL),
(11, 2, NULL, 'SHOESW', NULL, NULL, NULL, NULL, 697, NULL, '16894049681687980206image_15-removebg-preview.png', 4, 'No', '69.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'shocx23', '2023-05-01 13:53:26', '2023-08-19 08:56:27', NULL),
(12, 1, NULL, 'AXE-19', NULL, NULL, NULL, NULL, 1998, 0, '168798037332767-2-axe-spray-transparent-background 1.png', 2, 'No', '19.00', 0, 0, '2023-06-28', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'hgleroc', '2023-05-01 13:56:13', '2023-08-19 08:56:29', NULL),
(13, 3, NULL, 'HEELS-99', NULL, NULL, NULL, NULL, 9997, NULL, '168798082027019-3-female-shoes-file 1.png', 5, 'No', '99.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'fghew', '2023-05-01 14:03:40', '2023-08-19 08:58:49', NULL),
(14, 1, NULL, 'HAT-45', NULL, NULL, NULL, NULL, 45677, NULL, '1687981308Product_11.jpg', 1, 'No', '45.00', 0, NULL, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sadxz5w6', '2023-05-01 14:11:48', '2023-08-19 08:58:49', NULL),
(15, 8, NULL, 'CHAIRYE-899', NULL, NULL, NULL, NULL, 9994, NULL, '16894049381688031671image_19-removebg-preview.png', 5, 'No', '899.00', 0, 5, '2023-06-28', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'asdgdret55', '2023-05-01 14:14:57', '2023-08-19 08:58:50', NULL),
(16, 8, NULL, 'CHAIRG-88', NULL, NULL, NULL, NULL, 8022, NULL, '16894050921688031363image_22-removebg-preview.png', 5, 'No', '88.00', 0, 5, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '1saasd56', '2023-05-01 04:06:03', '2023-08-14 18:56:52', NULL),
(17, 8, NULL, 'PILLOW-56', NULL, NULL, NULL, NULL, 56000, NULL, '16894050791688031363image_20-removebg-preview.png', 5, 'No', '560.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'wewrreer', '2023-05-01 04:11:11', '2023-07-15 07:11:19', NULL),
(18, 8, NULL, 'STUDY-4565', NULL, NULL, NULL, NULL, 5688, NULL, '16894050651687981497image_24-removebg-preview (1).png', 5, 'No', '560.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'tyubnwda', '2023-05-01 04:18:21', '2023-07-15 07:11:05', NULL),
(19, 1, NULL, 'PERFUME-52', NULL, NULL, NULL, NULL, 454545, NULL, '1688032725Product_18-removebg-preview.png', 1, 'No', '30.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '5sdfdsewr', '2023-05-01 04:27:48', '2023-06-29 09:58:45', NULL),
(20, 7, NULL, 'LAPTOP-2000', NULL, NULL, NULL, NULL, 2000, 0, '1688033137joshua-aragon-FGXqbqbGt5o-unsplash-removebg-preview-removebg-preview.png', 6, 'No', '2000.00', 0, 0, '2023-06-29', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '15fnjnsd', '2023-05-01 04:35:37', '2023-07-15 12:15:40', NULL),
(21, 7, NULL, 'MOBILE-799', NULL, NULL, NULL, NULL, 4560, 0, '1688033572francesco-de-tommaso-1bBCtUAUMFI-unsplash-removebg-preview.png', 6, 'No', '799.00', 0, 0, '2023-06-29', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'asdgreedfx', '2023-05-01 04:42:52', '2023-06-29 10:12:52', NULL),
(22, 5, NULL, 'BAG-56', NULL, NULL, NULL, NULL, 5655, 0, '1688034061thumnail03.png', 2, 'No', '560.00', 0, 0, '2023-06-29', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'fgfdgfdg', '2023-05-01 04:51:01', '2023-06-29 10:21:01', NULL),
(23, 6, NULL, 'BOY-455', NULL, NULL, NULL, NULL, 8333, NULL, '1688036075pexels-luis-zambrano-16438724-removebg-preview.png', 2, 'No', '45.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '4asdfge', '2023-05-01 05:24:35', '2023-07-15 07:43:27', NULL),
(24, 6, NULL, 'GIRL-889', NULL, NULL, NULL, NULL, 855, 0, '1688036254pexels-cottonbro-studio-3662980.jpg', 3, 'No', '89.00', 0, 0, '2023-06-29', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'ghjghkghj', '2023-05-01 05:27:34', '2023-06-29 10:57:34', NULL),
(25, 6, NULL, 'BOYY-49', NULL, NULL, NULL, NULL, 54894, NULL, '1688036397terricks-noah-n9R0MN3XGvY-unsplash (1).jpg', 3, 'No', '29.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'savcxv', '2023-05-01 05:29:57', '2023-07-15 07:43:45', NULL),
(26, 3, NULL, 'PUMMA-19', NULL, NULL, NULL, NULL, 18889, 0, '168803666927-running-shoes-png-image 1.png', 2, 'No', '199.00', 0, 0, '2023-06-29', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'cvbgfder', '2023-05-01 05:34:29', '2023-06-29 11:04:29', NULL),
(27, 1, NULL, 'GLASS-34', NULL, NULL, NULL, NULL, 8485, 0, '1688036980Product_19-removebg-preview.png', 1, 'No', '15.00', 0, 0, '2023-06-29', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'uioyret', '2023-05-01 05:39:40', '2023-07-10 11:45:27', NULL),
(28, 5, NULL, 'LAPBAG-50', NULL, NULL, NULL, NULL, 5000, NULL, '1688037249Product_24.jpg', 1, 'No', '50.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'uiolkjdas', '2023-05-01 05:44:09', '2023-06-29 11:14:38', NULL),
(29, 4, NULL, 'VEG-50', NULL, NULL, NULL, NULL, 5000, NULL, '1688040024basket-full-vegetables.jpg', 5, 'No', '50.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'ertytrer', '2023-05-02 06:30:24', '2023-06-29 12:00:42', NULL),
(30, 7, NULL, 'DRONE-599', NULL, NULL, NULL, NULL, 59256, NULL, '1688040676pexels-inmortal-producciones-336232-removebg-preview.png', 6, 'No', '599.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'gfhgkrtsdf', '2023-05-01 06:33:51', '2023-07-02 01:11:19', '2023-07-01 19:41:19'),
(31, 8, NULL, 'GAMING-39', NULL, NULL, NULL, NULL, 8888, NULL, '16894048891688032101image_26-removebg-preview.png', 5, 'No', '39.00', 0, NULL, '2023-06-29', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'ghjnbgh', '2023-06-29 06:37:22', '2023-07-15 07:08:09', NULL),
(32, 7, NULL, 'CAM-56', NULL, NULL, NULL, NULL, 56889, 0, '1688040635pexels-pixabay-274973-removebg-preview.png', 6, 'No', '56.00', 0, 0, '2023-06-29', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'etrtyr', '2023-06-29 06:40:35', '2023-06-29 12:10:35', NULL),
(33, 7, NULL, 'REAL-699', NULL, NULL, NULL, NULL, 9000, NULL, '168826330111542954_12608-removebg-preview.png', 6, 'No', '699.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'tyhlkfdx', '2023-07-01 20:31:41', '2023-07-02 02:02:54', NULL),
(34, 7, NULL, 'IPHO-799', NULL, NULL, NULL, NULL, 3983, NULL, '16882636093576506_65968-removebg-preview.png', 6, 'No', '799.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'lkiojhy', '2023-07-01 20:36:49', '2023-08-19 09:15:38', NULL),
(35, 7, NULL, 'MOTO-40', NULL, NULL, NULL, NULL, 3999, NULL, '16882639136208024_3215461-removebg-preview.png', 6, 'No', '400.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'tyosslwd', '2023-07-01 20:41:53', '2023-08-19 08:49:04', NULL),
(36, 7, NULL, 'INFNITE-60', NULL, NULL, NULL, NULL, 800, NULL, '16882641401386068_OYHKDO0-removebg-preview.png', 6, 'No', '180.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'tgbfred', '2023-07-01 20:45:40', '2023-07-10 11:13:58', NULL),
(37, 7, NULL, 'KPPPO-15', NULL, NULL, NULL, NULL, 500, 0, '16882645521162384_ORH9DV0-removebg-preview.png', 6, 'No', '250.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'wqazsr', '2023-07-01 20:52:32', '2023-07-02 02:22:32', NULL),
(38, 6, NULL, 'BAB-56', NULL, NULL, NULL, NULL, 590, NULL, '1688264810interior-kids-room-decoration-with-clothes-removebg-preview.png', 3, 'No', '59.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'trcgssxz', '2023-07-01 20:56:50', '2023-07-15 07:45:27', NULL),
(39, 6, NULL, 'WHITE-39', NULL, NULL, NULL, NULL, 3825, 0, '1688264972white-baby-clothes-pink-background-copy-space-removebg-preview.png', 3, 'No', '39.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'uynnfs', '2023-07-01 20:59:32', '2023-07-02 02:29:32', NULL),
(40, 6, NULL, 'SW-3', NULL, NULL, NULL, NULL, 100, 0, '1688265196knitted-baby-clothes-accessories-blue-background-removebg-preview.png', 3, 'No', '20.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '1asdewewr', '2023-07-01 21:03:16', '2023-07-02 02:33:16', NULL),
(41, 2, NULL, 'BAG-Women', NULL, NULL, NULL, NULL, 1925, 0, '1688265499beautiful-elegance-luxury-fashion-green-handbag-removebg-preview.png', 1, 'No', '199.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '1asd455', '2023-07-01 21:08:19', '2023-07-10 14:56:10', NULL),
(42, 5, NULL, 'LEATHER-50', NULL, NULL, NULL, NULL, 8005, 0, '1688266866beautiful-men-fashion-with-leather-messenger-bag-removebg-preview.png', 2, 'No', '89.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'fbnmqaz3d', '2023-07-01 21:31:06', '2023-07-10 14:56:14', NULL),
(43, 5, NULL, 'MENBAG', NULL, NULL, NULL, NULL, 9991, NULL, '16882670481162308_ORH7W20-removebg-preview.png', 1, 'No', '99.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'tgbnhji34s1', '2023-07-01 21:34:08', '2023-07-15 07:45:56', NULL),
(44, 7, NULL, 'CANON-45', NULL, NULL, NULL, NULL, 9854, NULL, '1688267364camera-equipment-capturing-single-macro-object-generative-ai-removebg-preview.png', 6, 'No', '450.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'asdas31rew', '2023-05-31 21:39:24', '2023-07-15 07:46:03', NULL),
(45, 7, NULL, 'SONY-1445', NULL, NULL, NULL, NULL, 15689, 0, '16882677153947903_13130-removebg-preview.png', 6, 'No', '149.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '1sader651', '2023-05-31 21:45:15', '2023-07-02 03:15:15', NULL),
(46, 7, NULL, 'PANA-99', NULL, NULL, NULL, NULL, 1565, 0, '1688267882photo-camera-balancing-with-yellow-background-removebg-preview.png', 6, 'No', '99.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '99sa1q23s', '2023-05-31 21:48:02', '2023-07-02 03:18:02', NULL),
(47, 2, NULL, 'DPURPL', NULL, NULL, NULL, NULL, 8256, 0, '1688268068beautiful-fashion-woman-purple-long-dress-hairstyle-with-pigtails-design-poses-studio-removebg-preview.png', 2, 'No', '89.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sad56wf41as', '2023-05-31 21:51:08', '2023-07-02 03:21:08', NULL),
(48, 2, NULL, 'HEAD44', NULL, NULL, NULL, NULL, 4545, 0, '1688268280pretty-red-head-woman-yellow-dress-posing-yellow-summer-mood-removebg-preview.png', 2, 'No', '44.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'asdc321sd1', '2023-05-31 21:54:40', '2023-07-02 03:24:40', NULL),
(49, 2, NULL, 'DRE543', NULL, NULL, NULL, NULL, 5925, NULL, '1688269603young-woman-beautiful-red-dress-removebg-preview.png', 3, 'No', '59.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'fs6489sdf516', '2023-05-31 22:16:43', '2023-07-15 07:46:24', NULL),
(50, 2, NULL, 'WOMEN34', NULL, NULL, NULL, NULL, 1234, 0, '1688269726fashion-woman-with-clothes-removebg-preview.png', 3, 'No', '32.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '1asr4554', '2023-05-31 22:18:46', '2023-07-10 13:33:04', NULL),
(51, 2, NULL, 'BLAKC3', NULL, NULL, NULL, NULL, 3561, 0, '1688269902valerie-elash-gsKdPcIyeGg-unsplash-removebg-preview.png', 2, 'No', '30.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sae1356sa', '2023-07-01 22:21:42', '2023-07-11 05:54:19', NULL),
(52, 7, NULL, 'DRONE324', NULL, NULL, NULL, NULL, 4555, NULL, '16882702101353722_172509-OW8YYF-93__1_-removebg-preview.png', 6, 'No', '54.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '454adcfd', '2023-05-31 22:26:50', '2023-07-02 03:57:08', NULL),
(53, 7, NULL, 'DROMM14', NULL, NULL, NULL, NULL, 1545, 0, '16882704331609218_P2PDDV0-removebg-preview.png', 6, 'No', '899.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sda45w3r45', '2023-05-31 22:30:33', '2023-07-02 04:00:33', NULL),
(54, 7, NULL, 'DRON32', NULL, NULL, NULL, NULL, 45112, NULL, '16882706043888755_11872-removebg-preview.png', 6, 'No', '456.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sa4ew41c', '2023-05-31 22:33:24', '2023-07-15 07:46:54', NULL),
(55, 7, NULL, 'HEADpho', NULL, NULL, NULL, NULL, 5958, 0, '16882708181002029_OILHK60-removebg-preview.png', 6, 'No', '59.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sdf4vx54wa', '2023-05-31 22:36:58', '2023-07-02 04:06:58', NULL),
(56, 7, NULL, 'LAPI699', NULL, NULL, NULL, NULL, 8552, 0, '16882711621162367_ORH91S0-removebg-preview.png', 6, 'No', '699.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sa1515wa55', '2023-05-31 22:42:42', '2023-07-02 04:12:42', NULL),
(57, 7, NULL, 'ASUS599', NULL, NULL, NULL, NULL, 5995, 0, '16882713771191276_OSXDCD0-removebg-preview.png', 6, 'No', '599.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sadd15we165', '2023-05-31 22:46:17', '2023-07-02 04:16:17', NULL),
(58, 7, NULL, 'DELL220', NULL, NULL, NULL, NULL, 5329, NULL, '1688271616laptop-wooden-table-removebg-preview.png', 6, 'No', '399.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 's1wqe1sa', '2023-07-01 22:50:16', '2023-08-19 06:43:03', NULL),
(59, 1, NULL, 'SHIRT23', NULL, NULL, NULL, NULL, 3245, 0, '1688271843handsome-man-wearing-sunglasses-standing-grey-wall-removebg-preview.png', 3, 'No', '25.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sad51e1', '2023-07-01 22:54:03', '2023-07-02 04:24:03', NULL),
(60, 1, NULL, 'FORM2', NULL, NULL, NULL, NULL, 5568, NULL, '1688272047portrait-handsome-confident-model-sexy-stylish-man-dressed-shirt-jeans-fashion-hipster-male-posing-near-blue-wall-studio-sunglasses-removebg-preview.png', 2, 'No', '35.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 's1e31jhjoio', '2023-07-01 22:57:27', '2023-07-15 07:47:26', NULL),
(61, 1, NULL, 'SHIPu3q', NULL, NULL, NULL, NULL, 255, NULL, '1688272217vertical-shot-concentrated-businessman-listening-carefully-with-crossed-hands-removebg-preview.png', 3, 'No', '25.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '5sad1r', '2023-07-01 23:00:17', '2023-07-11 07:40:42', NULL),
(62, 1, NULL, 'SHIRTT22', NULL, NULL, NULL, NULL, 12651, NULL, '1688272411young-handsome-hipster-man-standing-talking-phone-removebg-preview.png', 2, 'No', '21.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'gf33423sdf', '2023-07-01 23:03:31', '2023-07-15 07:47:39', NULL),
(63, 1, NULL, 'CASUAL34', NULL, NULL, NULL, NULL, 5149, 0, '1688272855young-spanish-man-with-tattoos-posing-street-removebg-preview.png', 3, 'No', '15.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sf4erds', '2023-07-01 23:10:55', '2023-07-11 09:07:10', NULL),
(64, 3, NULL, 'WHITE52', NULL, NULL, NULL, NULL, 32420, NULL, '1688278322one-white-sneaker-shoe-isolated-white-removebg-preview.png', 5, 'No', '50.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'fsd14sad1', '2023-07-02 00:42:02', '2023-08-19 11:47:02', NULL),
(65, 3, NULL, 'DWANEW', NULL, NULL, NULL, NULL, 1411, 0, '1688278474one-black-sneaker-shoe-isolated-white-removebg-preview.png', 5, 'No', '39.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sd51sad51', '2023-06-08 00:44:34', '2023-07-02 06:14:34', NULL),
(66, 3, NULL, 'HUST15', NULL, NULL, NULL, NULL, 1464, NULL, '1688278656pair-trainers-removebg-preview.png', 5, 'No', '55.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sd4asd4we4', '2023-06-19 00:47:36', '2023-07-15 07:47:59', NULL),
(67, 7, NULL, 'APPLW32', NULL, NULL, NULL, NULL, 1562, NULL, '1688278856803760_21458-NTQL9F-removebg-preview.png', 6, 'No', '109.00', 0, NULL, '2023-07-02', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'sds15c5a', '2023-06-20 00:50:56', '2023-07-02 06:21:24', NULL),
(68, 7, NULL, 'Sam32', NULL, NULL, NULL, NULL, 4555, 0, '1688279036866884_O6CCQR0-removebg-preview.png', 6, 'No', '40.00', 0, 0, '2023-07-02', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, 'fsd4sdf654', '2023-06-22 00:53:56', '2023-08-19 09:36:29', NULL),
(69, 1, NULL, 'asd', NULL, NULL, NULL, NULL, 234, 0, '1690626543female-shoes.png', 1, 'No', '234.00', 0, 0, '2023-07-29', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '234', '2023-07-29 10:29:03', '2023-08-01 06:15:40', '2023-08-01 00:45:40'),
(70, 2, NULL, 'sad', NULL, NULL, NULL, NULL, 233, 0, NULL, 2, 'No', '324.00', 0, 0, '2023-08-01', '0.0000', 0, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, NULL, '2023-08-01 02:38:26', '2023-08-02 21:37:48', '2023-08-02 16:07:48'),
(71, 8, NULL, 'TAX-1', NULL, NULL, NULL, NULL, 4438, NULL, '16919197821687981497image_25-removebg-preview.png', 5, 'No', '50.00', 0, 5, '2023-08-13', '0.0000', NULL, '0.0000', '0.0000', '0.0000', 0, 1, 1, 1, 1, 0, '50A', '2023-08-13 09:43:02', '2023-08-19 11:48:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE IF NOT EXISTS `product_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `group_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '2023-05-20 04:24:43', '2023-05-20 04:24:43', NULL),
(2, 2, 1, '2023-05-20 04:25:04', '2023-05-20 04:25:04', NULL),
(3, 1, 1, '2023-05-20 04:25:21', '2023-05-20 04:25:21', NULL),
(4, 1, 1, '2023-05-20 04:25:39', '2023-05-20 04:25:39', NULL),
(5, 1, 1, '2023-05-20 04:25:59', '2023-05-20 04:25:59', NULL),
(6, 1, 1, '2023-05-20 04:26:15', '2023-05-20 04:26:15', NULL),
(7, 2, 1, '2023-05-20 04:26:33', '2023-05-20 04:26:33', NULL),
(8, 3, 1, '2023-05-20 04:26:50', '2023-05-20 04:26:50', NULL),
(9, 3, 1, '2023-05-20 04:27:05', '2023-05-20 04:27:05', NULL),
(10, 4, 1, '2023-05-20 04:27:22', '2023-05-20 04:27:22', NULL),
(11, 3, 1, '2023-05-20 04:27:44', '2023-05-20 04:27:44', NULL),
(12, 4, 1, '2023-05-20 04:27:59', '2023-05-20 04:27:59', NULL),
(13, 4, 1, '2023-05-20 04:28:14', '2023-05-20 04:28:14', NULL),
(14, 4, 1, '2023-05-20 04:28:31', '2023-05-20 04:28:31', NULL),
(15, 4, 1, '2023-05-20 04:28:46', '2023-05-20 04:28:46', NULL),
(16, 4, 1, '2023-05-20 04:29:02', '2023-05-20 04:29:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_description`
--

DROP TABLE IF EXISTS `product_attribute_description`;
CREATE TABLE IF NOT EXISTS `product_attribute_description` (
  `language_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `attribute_id` (`attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attribute_description`
--

INSERT INTO `product_attribute_description` (`language_id`, `attribute_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, 'Primary Clock Speed', '2023-05-20 04:24:43', '2023-05-20 04:24:43', NULL),
(5, 1, 'سرعة الساعة الأساسية', '2023-05-20 04:24:43', '2023-05-20 04:24:43', NULL),
(4, 2, 'Processor Core', '2023-05-20 04:25:04', '2023-05-20 04:25:04', NULL),
(5, 2, 'نواة المعالج', '2023-05-20 04:25:04', '2023-05-20 04:25:04', NULL),
(4, 3, 'Memory Card Slot Type', '2023-05-20 04:25:21', '2023-05-20 04:25:21', NULL),
(5, 3, 'نوع فتحة بطاقة الذاكرة', '2023-05-20 04:25:21', '2023-05-20 04:25:21', NULL),
(4, 4, 'Supported Memory Card Type', '2023-05-20 04:25:39', '2023-05-20 04:25:39', NULL),
(5, 4, 'نوع بطاقة الذاكرة المدعومة', '2023-05-20 04:25:39', '2023-05-20 04:25:39', NULL),
(4, 5, 'Expandable Storage', '2023-05-20 04:25:59', '2023-05-20 04:25:59', NULL),
(5, 5, 'تخزين قابل للتوسيع', '2023-05-20 04:25:59', '2023-05-20 04:25:59', NULL),
(4, 6, 'Internal Storage', '2023-05-20 04:26:15', '2023-05-20 04:26:15', NULL),
(5, 6, 'التخزين الداخلي', '2023-05-20 04:26:15', '2023-05-20 04:26:15', NULL),
(4, 7, 'Operating System', '2023-05-20 04:26:33', '2023-05-20 04:26:33', NULL),
(5, 7, 'نظام التشغيل', '2023-05-20 04:26:33', '2023-05-20 04:26:33', NULL),
(4, 8, 'Display Colors', '2023-05-20 04:26:50', '2023-05-20 04:26:50', NULL),
(5, 8, 'ألوان العرض', '2023-05-20 04:26:50', '2023-05-20 04:26:50', NULL),
(4, 9, 'Display Type', '2023-05-20 04:27:05', '2023-05-20 04:27:05', NULL),
(5, 9, 'نوع العرض', '2023-05-20 04:27:05', '2023-05-20 04:27:05', NULL),
(4, 10, 'Resolution Type', '2023-05-20 04:27:22', '2023-05-20 04:27:22', NULL),
(5, 10, 'نوع القرار', '2023-05-20 04:27:22', '2023-05-20 04:27:22', NULL),
(4, 11, 'Display Size', '2023-05-20 04:27:44', '2023-05-20 04:27:44', NULL),
(5, 11, 'عرض الحجم', '2023-05-20 04:27:44', '2023-05-20 04:27:44', NULL),
(4, 12, 'Touchscreen', '2023-05-20 04:27:59', '2023-05-20 04:27:59', NULL),
(5, 12, 'شاشة لمسية', '2023-05-20 04:27:59', '2023-05-20 04:27:59', NULL),
(4, 13, 'SIM Type', '2023-05-20 04:28:14', '2023-05-20 04:28:14', NULL),
(5, 13, 'نوع بطاقة SIM', '2023-05-20 04:28:14', '2023-05-20 04:28:14', NULL),
(4, 14, 'Color', '2023-05-20 04:28:31', '2023-05-20 04:28:31', NULL),
(5, 14, 'اللون', '2023-05-20 04:28:31', '2023-05-20 04:28:31', NULL),
(4, 15, 'Model Number', '2023-05-20 04:28:46', '2023-05-20 04:28:46', NULL),
(5, 15, 'رقم الموديل', '2023-05-20 04:28:46', '2023-05-20 04:28:46', NULL),
(10, 16, 'In The Box -esto', '2023-08-01 09:00:27', '2023-08-01 09:00:27', NULL),
(4, 16, 'In The Box', '2023-08-01 09:00:27', '2023-08-01 09:00:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_groups`
--

DROP TABLE IF EXISTS `product_attribute_groups`;
CREATE TABLE IF NOT EXISTS `product_attribute_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attribute_groups`
--

INSERT INTO `product_attribute_groups` (`id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2023-05-20 04:21:55', '2023-05-20 04:21:55', NULL),
(2, 1, '2023-05-20 04:23:36', '2023-05-20 04:23:36', NULL),
(3, 1, '2023-05-20 04:23:50', '2023-05-20 04:23:50', NULL),
(4, 1, '2023-05-20 04:24:04', '2023-05-20 04:24:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_group_description`
--

DROP TABLE IF EXISTS `product_attribute_group_description`;
CREATE TABLE IF NOT EXISTS `product_attribute_group_description` (
  `language_id` int(11) NOT NULL,
  `attribute_group_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `language_id` (`language_id`,`attribute_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attribute_group_description`
--

INSERT INTO `product_attribute_group_description` (`language_id`, `attribute_group_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, 'Memory & Storage Features', '2023-05-20 04:21:55', '2023-05-20 04:21:55', NULL),
(5, 1, 'ميزات الذاكرة والتخزين', '2023-05-20 04:21:55', '2023-05-20 04:21:55', NULL),
(4, 2, 'Os & Processor Features', '2023-05-20 04:23:36', '2023-05-20 04:23:36', NULL),
(5, 2, 'نظام التشغيل وخصائص المعالج', '2023-05-20 04:23:36', '2023-05-20 04:23:36', NULL),
(4, 3, 'Display Features', '2023-05-20 04:23:50', '2023-05-20 04:23:50', NULL),
(5, 3, 'ميزات العرض', '2023-05-20 04:23:50', '2023-05-20 04:23:50', NULL),
(10, 4, 'Generale', '2023-08-01 08:58:00', '2023-08-01 08:58:00', NULL),
(4, 4, 'General', '2023-08-01 08:58:00', '2023-08-01 08:58:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_description`
--

DROP TABLE IF EXISTS `product_description`;
CREATE TABLE IF NOT EXISTS `product_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `short_description` text,
  `tag` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `product_id` (`product_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=276 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_description`
--

INSERT INTO `product_description` (`id`, `product_id`, `language_id`, `name`, `description`, `short_description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(58, 1, 5, 'ساعة سامسونج الذكية باللون الأسود', '<p>وصف ساعة سامسونج الذكية باللون الأسود</p>\r\n\r\n<h1>ساعة سامسونج الذكية باللون الأسود</h1>\r\n\r\n<p>تعد ساعة سامسونج الذكية باللون الأسود من أحدث التقنيات في عالم الأجهزة القابلة للارتداء. تتميز هذه الساعة بتصميم أنيق ورائع يضفي لمسات جمالية على مظهر المستخدم.</p>\r\n\r\n<p>تتضمن هذه الساعة مجموعة واسعة من الميزات والوظائف التي تجعلها رفيقًا مثاليًا لأنشطتك اليومية. فهي تحتوي على شاشة عرض AMOLED ذات دقة عالية تظهر المحتوى بشكل واضح وحاد، كما أنها قابلة للتخصيص حسب احتياجاتك.</p>\r\n\r\n<p>بفضل نظام التشغيل Tizen OS، يُمكنك الوصول إلى مجموعة كبيرة من التطبيقات والخدمات المتاحة على الساعة. يمكنك تنزيل التطبيقات المفضلة لديك ومراقبة أنشطتك الرياضية، وتلقي إشعارات الهاتف، وإدارة المكالمات، وتتبع نومك، وأكثر من ذلك بكثير.</p>\r\n\r\n<p>تُعد ساعة سامسونج الذكية قابلة للماء والغبار، مما يجعلها مثالية للاستخدام في جميع الظروف. كما تحتوي على بطارية قوية تستطيع الصمود طوال اليوم دون الحاجة إلى إعادة شحن مستمرة.</p>\r\n\r\n<p>إذا كنت تبحث عن ساعة ذكية تجمع بين التصميم الأنيق والأداء المتفوق، فإن ساعة سامسونج الذكية باللون الأسود هي خيار رائع لك. احصل على هذه الساعة الآن وانغمس في عالم التقنية الذكية.</p>', 'ساعة سامسونج الذكية باللون الأسود هي جهاز مبتكر يجمع بين التصميم الأنيق والوظائف المتقدمة. تتضمن هذه الساعة شاشة عالية الدقة، وإمكانية تتبع اللياقة البدنية والصحة، وإشعارات الهاتف، والتحكم في الموسيقى، وغير ذلك من المزايا التي تجعلها رفيقًا مثاليًا لحياتك اليومية.', NULL, NULL, NULL, NULL),
(57, 1, 4, 'Samsung Smart Watch Black', '<p>Samsung Smart Watch Black</p>\r\n\r\n<h1>Samsung Smart Watch Black</h1>\r\n\r\n<p>The Samsung Smart Watch Black is a sleek and stylish wearable device that combines advanced technology with a sophisticated design. It features a black-colored body made of high-quality materials, ensuring durability and comfort for everyday use.</p>\r\n\r\n<p>This smart watch offers a wide range of features to enhance your daily life. With its built-in fitness tracking capabilities, it allows you to monitor your heart rate, track your steps, and measure various activities such as running, cycling, and swimming. It also provides personalized coaching to help you achieve your health and fitness goals.</p>\r\n\r\n<p>In addition to fitness tracking, this smart watch keeps you connected throughout the day. You can receive notifications from your smartphone directly on the watch&#39;s vibrant display, allowing you to stay updated on incoming calls, messages, emails, and social media alerts without having to reach for your phone.</p>\r\n\r\n<p>The Samsung Smart Watch Black also supports contactless payments through Samsung Pay, making it convenient for you to make purchases on the go without needing to carry cash or cards.</p>\r\n\r\n<p>With its long-lasting battery life and water resistance up to 50 meters, this smart watch is suitable for all-day wear and can withstand various environmental conditions.</p>\r\n\r\n<p>Overall, the Samsung Smart Watch Black is a versatile and reliable companion that seamlessly integrates into your lifestyle while keeping you connected and motivated towards achieving a healthier and more productive life.</p>', 'The Samsung Smart Watch Black is a sleek and stylish wearable device that seamlessly integrates with your smartphone. It offers a range of features such as fitness tracking, notifications, and music control. With its black color, it exudes elegance and sophistication, making it the perfect accessory for any occasion.', NULL, 'Samsung Smart Watch Black - Sleek Design, Advanced Features | Shop Now', NULL, 'Samsung smartwatch black, wearable device, sleek design, advanced features, connectivity, fitness tracking, app integration'),
(268, 2, 4, 'Black Headphone', '<p> </p>\r\n\r\n<h1>Black Headphone</h1>\r\n\r\n<p>A black headphone is a stylish and sleek audio device designed to provide an immersive listening experience. It is a popular choice among music enthusiasts, gamers, and professionals who value high-quality sound reproduction.</p>\r\n\r\n<p>The black color of the headphones adds a touch of elegance and sophistication, making it a fashionable accessory that complements any outfit or style. Whether you\'re using them for personal entertainment or professional purposes, these headphones are sure to make a statement.</p>\r\n\r\n<p>Featuring advanced technology and superior sound engineering, black headphones deliver crystal-clear audio with deep bass and crisp treble. They are equipped with noise-canceling capabilities that block out external distractions, allowing you to focus on your favorite music or immerse yourself in gaming adventures without interruptions.</p>\r\n\r\n<p>These headphones are designed for comfort, with adjustable headbands and cushioned ear cups that provide a snug fit over extended periods of use. The lightweight construction ensures that they can be worn for hours without causing discomfort or fatigue.</p>\r\n\r\n<p>With built-in microphones and controls conveniently placed on the ear cups, black headphones allow you to easily switch between music playback and taking calls on your smartphone. Some models even offer voice assistant integration for hands-free control.</p>\r\n\r\n<p>In conclusion, a black headphone combines style, comfort, and exceptional audio performance into one sleek package. Whether you\'re enjoying music at home or on the go, these headphones provide an immersive listening experience that will elevate your audio enjoyment to new heights.</p>', 'Introducing our sleek and stylish black headphones, designed to deliver exceptional sound quality and comfort. With their adjustable headband and cushioned ear cups, these headphones are perfect for long listening sessions. Whether you\'re enjoying music or taking calls, our black headphones offer a premium audio experience with a touch of sophistication.', NULL, 'Premium Black Headphone - Immerse Yourself in High-Quality Audio', NULL, NULL),
(269, 2, 5, 'سماعة سوداء', '<p>وصف سماعة سوداء</p>\r\n\r\n<h1>وصف سماعة سوداء</h1>\r\n\r\n<p>سماعة الأذن السوداء هي جهاز استماع محمول يتم وضعه في الأذن للاستمتاع بالصوت على شكل مقطوعات موسيقية أو محادثات أخرى. تتميز هذه السماعة بلونها الأسود الجذاب والأنيق، مما يجعلها تتناسب مع أغلب المظاهر والإطلالات.</p>\r\n\r\n<p>تأتي سماعة الأذن السوداء بتصميم صغير وخفيف الوزن، مما يجعلها سهلة التنقل بها وارتدائها لفترات طويلة دون أي إزعاج. كما تحتوي على كابل طويل يضمن حرية الحركة أثناء استخدامها.</p>\r\n\r\n<p>بفضل التكنولوجيات المتقدمة المستخدمة في تصنيعها، توفر سماعة الأذن السوداء جودة صوت عالية وواضحة. يمكن للمستخدم أن يشعر بروعة التفاصيل الصوتية والإيقاعات الموسيقية بشكل مثالي.</p>\r\n\r\n<p>تحتوي هذه السماعة على ميزات إضافية مثل إلغاء الضجيج، مما يساعد على تقليل الضوضاء المحيطة والانغماس في التجربة الصوتية بشكل أفضل. كما تحتوي على زر للتحكم في مستوى الصوت وزر لإيقاف/تشغيل المقطع الصوتي.</p>\r\n\r\n<p>بفضل سهولة استخدامها وجودة صوتها المدهشة، فإن سماعة الأذن السوداء هي اختيار رائع للاستماع إلى الموسيقى أو مشاركة المحادثات بطريقة مريحة وأنيقة.</p>', 'سماعة سوداء هي جهاز صوتي محمول يستخدم للاستماع إلى الموسيقى أو الاتصالات الهاتفية. تتميز بتصميمها الأنيق ولونها الأسود الجذاب، وتحتوي على مكبرات صوت عالية الجودة لتوفير تجربة صوتية رائعة. مناسبة للاستخدام في المنزل أو أثناء التنقل.', NULL, NULL, NULL, NULL),
(185, 3, 4, 'T-Shirt for Men', '<p>Men&#39;s T-Shirt Description</p>\r\n\r\n<h1>Men&#39;s T-Shirt Description</h1>\r\n\r\n<p><strong>Product Name:</strong>T-Shirt for Men</p>\r\n\r\n<p><strong>Description:</strong></p>\r\n\r\n<p>[Insert a detailed description of the men&#39;s t-shirt here.]</p>\r\n\r\n<ul>\r\n	<li><strong>Material:</strong> [Material used in the t-shirt]</li>\r\n	<li><strong>Fit:</strong> [Slim fit/Regular fit/Loose fit]</li>\r\n	<li><strong>Color Options:</strong> [List available colors]</li>\r\n	<li><strong>Sizes Available:</strong> [List available sizes]</li>\r\n	<li><strong>Care Instructions:</strong> [Instructions for washing and maintaining the t-shirt]</li>\r\n</ul>\r\n\r\n<p><!-- Add a button to add the t-shirt to cart -->Add to CartNote: Please replace the placeholder values within square brackets ([ ]) with actual information specific to your men&#39;s t-shirt product.T</p>', 'This stylish and comfortable men\'s t-shirt is a wardrobe essential. Made from soft, breathable fabric, it features a classic crew neck and short sleeves for a casual yet timeless look. The versatile design makes it perfect for everyday wear or dressing up with your favorite accessories.', NULL, NULL, NULL, NULL),
(186, 3, 5, 'تي شيرت رجالي', '<p>تي شيرت رجالي</p>\r\n\r\n<h1>تي شيرت رجالي</h1>\r\n\r\n<p>هذا التصميم المذهل من تي شيرت رجالي هو اختيار مثالي لأولئك الذين يرغبون في الحصول على مظهر أنيق وعصري. يعد هذا التصميم مناسبًا للارتداء اليومي والمناسبات العادية.</p>\r\n\r\n<p>هذا التي شيرت مصنوع من قماش عالي الجودة يضمن الراحة طوال الوقت. يسمح التصميم بحرية الحركة ولا يسبب أية إزعاج أثناء ارتدائه. كما أنه سهل العناية به وقابل للغسيل في الغسالة.</p>\r\n\r\n<p>إضافة إلى ذلك، فإن تفاصيل التصميم تجعل هذا التشيرت فريدًا وأنيقًا. يأتي بقَصَّة مستقيمة تُبرز جسدك بشكل جذاب ومناسب لجميع الأشكال. يتميز برقبة مستديرة تضفي لمسة عصرية وأنيقة.</p>\r\n\r\n<p>هذا التي شيرت الرجالي متوفر في مجموعة من الألوان المختلفة لتناسب ذوقك الشخصي. كما أنه يأتي بأحجام مختلفة لضمان الاحتواء على جميع المقاسات. سواء كنت تبحث عن قطعة فردية أنيقة أو تود شراءها كهدية، فإن هذا التصميم هو خيار رائع.</p>\r\n\r\n<p>لا تفوّت فرصة اقتناء هذا التصميم المثالي لإضافته إلى خزانة ملابسك. استعد لإطلالات رائعة وثقة عالية في نفسك بهذا التشيرت الرجالي الأنيق!</p>', 'تي شيرت رجالي بتصميم عصري وأنيق يضفي لمسة من الأناقة على إطلالتك. مصنوع من خامات عالية الجودة تضمن الراحة والمتانة. مثالي للاستخدام اليومي أو في المناسبات غير الرسمية. يمكن تنسيقه بسهولة مع مختلف أنواع الملابس لإطلالة عصرية وأنيقة.', NULL, NULL, NULL, NULL),
(183, 4, 4, 'Combo Pack for Baby Girls', '<p>Combo Pack for Baby Girls</p>\r\n\r\n<h1>Combo Pack for Baby Girls</h1>\r\n\r\n<p>Introducing our exclusive Combo Pack for Baby Girls, designed to provide everything you need to dress up your little princess in style and comfort. This combo pack is perfect for parents who want a convenient and affordable solution to their baby girl&#39;s wardrobe needs.</p>\r\n\r\n<p>The combo pack includes a variety of essential clothing items that are carefully selected to cater to the needs of your baby girl. It consists of adorable dresses, rompers, onesies, leggings, socks, and headbands, all made from high-quality materials that are gentle on your baby&#39;s delicate skin.</p>\r\n\r\n<p>Our combo pack offers a range of sizes suitable for newborns up to 24 months old, ensuring that your baby girl can enjoy these stylish outfits as she grows. Each item is designed with attention to detail and features cute prints, vibrant colors, and comfortable fits that will make your little one look even more adorable.</p>\r\n\r\n<p>In addition to being fashionable and comfortable, all the clothing items in this combo pack are easy to care for. They can be machine washed without losing their shape or color, allowing busy parents to spend more time enjoying precious moments with their little bundle of joy.</p>\r\n\r\n<p>Don&#39;t miss out on this amazing offer! Our Combo Pack for Baby Girls is the perfect choice for parents who want quality clothing at an affordable price. Order now and give your baby girl the stylish wardrobe she deserves!</p>', 'The Combo Pack for Baby Girls is the perfect bundle of essentials for your little princess. It includes a soft and cozy onesie, a cute and stylish dress, and a pair of adorable socks. Made with love and care, this combo pack is sure to keep your baby girl comfortable and looking fashionable.', NULL, 'Adorable Combo Pack for Baby Girls - Perfect Gift Set for Your Little Princess', NULL, NULL),
(184, 4, 5, 'عبوة كومبو للفتيات الصغيرات', '<p>عبوة كومبو للفتيات الصغيرات</p>\r\n\r\n<h1>عبوة كومبو للفتيات الصغيرات</h1>\r\n\r\n<p>تُعد عبوة كومبو للفتيات الصغيرات منتجًا مثاليًا للأطفال الصغار، حيث تحتوي على مجموعة من المنتجات الترفيهية والتعليمية التي تساهم في تنمية قدراتهم وإشراكهم في أنشطة مسلية.</p>\r\n\r\n<p>تحظى هذه العبوة بشعبية كبيرة بين الآباء والأمهات، حيث يستخدمونها لإسعاد وترفيه أطفالهم في المنزل أو خلال السفر. يحتوي هذا المنتج على مجموعة مختارة من الألعاب التقليدية والإبداعية، بالإضافة إلى كتاب تلوين وقصص قصيرة مصورة.</p>\r\n\r\n<p>إضافةً إلى ذلك، فإن هذه العبوة تحتوي أيضًا على لعبة تعليمية مصممة خصيصًا لتطوير المهارات اللغوية والرياضية للأطفال. يتم استخدام هذه اللعبة كأداة تعليمية فعّالة في المدارس وروضات الأطفال.</p>\r\n\r\n<p>تتميز عبوة كومبو للفتيات الصغيرات بجودتها العالية وسهولة استخدامها، حيث يستطيع الأطفال التلاعب بها بسهولة وراحة. كما أن المنتج مصنوع من مواد آمنة وغير سامة، مما يجعله مناسبًا للاستخدام من قِبَل الأطفال دون أي مخاطر صحية.</p>\r\n\r\n<p>إذا كنت تبحث عن هدية مثالية لابنتك أو ابنة أحد أقاربك، فإن عبوة كومبو للفتيات الصغيرات هي خيارك المثلى. اشترِ هذه العبوة الآن وشارك طفلك في التجربة المسلية والتعليمية التي ستستمتع بها بالتأكيد!</p>', 'عبوة كومبو للفتيات الصغيرات هي مجموعة تحتوي على منتجات متنوعة ومثالية للاستخدام اليومي. تشمل العبوة أدوات التجميل والإكسسوارات والألعاب، كلها مصممة خصيصًا لإرضاء ذوق الفتيات الصغيرات وتعزيز إبداعهن وترفيههن. ستكون هذه العبوة هدية رائعة لأية فتاة صغيرة تحب المرح والجمال.', NULL, NULL, NULL, NULL),
(242, 5, 5, 'قميص رسمي سادة ذو قصة عادية للرجال', '<p>وصف القميص الرسمي سادة ذو قصة عادية للرجال</p>\r\n\r\n<h1>وصف القميص الرسمي سادة ذو قصة عادية للرجال</h1>\r\n\r\n<p>هذا القميص هو قميص رسمي سادة مثالي للرجال. يتميز بقصته العادية التي تناسب جميع أشكال الجسم وتضفي مظهرًا أنيقًا وأنثويًا في نفس الوقت.</p>\r\n\r\n<p>تم تصنيع هذا القميص باستخدام أجود أنواع الأقمشة المتاحة، حيث يتكون من خامات عالية الجودة تضفي على الملابس مظهرًا فخمًا وأنثويًا. كما أنه يوفر راحة فائقة طوال فترة ارتدائه.</p>\r\n\r\n<p>بفضل تفاصيله البسيطة والأنظار التى لاتُشد إلى نفسه بإزعاج، يمكن ارتداء هذا القميص في أي مناسبة رسمية، مثل الحفلات والاجتماعات العملية وحفلات الزفاف. يضفي هذا القميص لمسة من الأناقة على أي إطلالة.</p>\r\n\r\n<p>هذا القميص متوفر بعدة ألوان رائعة تناسب جميع الأذواق والأنساق. سواء كنت تفضل الألوان التقليدية مثل الأبيض والأزرق والأسود، أو ترغب في التجديد بالألوان المشرقة مثل الأحمر والوردي، فإن هذا القميص سيرضي جميع اختياراتك.</p>\r\n\r\n<p>لا تفوت فرصة اقتناء هذا القميص المثالي لإطلالة رسمية سادة ذات قصة عادية. احصل على قطعتك المفضلة منه الآن!</p>', 'قميص رسمي سادة ذو قصة عادية للرجال هو قميص يتميز بتصميمه الكلاسيكي والأنيق. مصنوع من قماش عالي الجودة يضفي مظهرًا أنيقًا ورسميًا. مثالي للحفلات والمناسبات الرسمية، حيث يعطي للرجال إطلالة أنيقة وأنثوية في نفس الوقت.', NULL, NULL, NULL, NULL),
(274, 6, 4, 'White Partywear Dress', '<p>White Partywear Dress</p>\r\n\r\n<h1>White Partywear Dress</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The White Partywear Dress is an elegant and stylish choice for any special occasion or formal event. Made from high-quality materials, it features a flattering silhouette that accentuates your curves and enhances your feminine charm.</p>\r\n\r\n<p>This dress boasts a beautiful white color that exudes sophistication and purity. The clean and crisp shade makes it a versatile option that can be easily accessorized with various colors and styles.</p>\r\n\r\n<p>The design of this dress is carefully crafted to provide both comfort and style. It features a fitted bodice with delicate lace detailing, adding a touch of romance to the overall look. The flowing skirt gracefully drapes down to create a stunning visual effect as you move.</p>\r\n\r\n<p>Whether you&#39;re attending a wedding, cocktail party, or any other formal gathering, this dress will make you stand out from the crowd. Its timeless appeal ensures that you&#39;ll look effortlessly chic and glamorous.</p>', 'This elegant white partywear dress is the epitome of sophistication and grace. With its delicate lace detailing and flattering silhouette, it is perfect for any special occasion. The dress exudes timeless beauty, making you the center of attention wherever you go.', NULL, 'Elegant White Partywear Dress for a Stunning Look | Shop Now', NULL, 'white partywear dress, elegant dress, stunning look, high-quality materials, latest fashion trends'),
(275, 6, 5, 'فستان أبيض للحفلات', '<p>فستان أبيض للحفلات</p>\r\n\r\n<h1>فستان أبيض للحفلات</h1>\r\n\r\n<p>هذا الفستان الأبيض المذهل هو خيار مثالي لأي مناسبة خاصة، سواء كانت حفلة زفاف، حفلة تخرج، حفلة عشاء رسمية، أو أية مناسبة احتفالية. إنه فستان يبرز جمالك وأناقتك بطريقة مدهشة.</p>\r\n\r\n<p>صُنع هذا الفستان باستخدام أجود أنواع الأقمشة وأعلى معايير التصميم. يتميز بقَصَّته المثيرة والمنسدلة التي تضفي على جسدك طابعًا فريدًا من الرقة والجاذبية. يأتي بتصميم بسيط وأنثوي في نفس الوقت، حيث يتم تزوّده بخط رقبة عريض وأكمام قصيرة مزخرفة بالدانتيل.</p>\r\n\r\n<p>إن تطريزات الدانتيل الأنيقة والمتقنة تضفي لمسة من الجمال والرقي على هذا الفستان. كما يحتوي على تنورة طويلة واسعة مصنوعة من الشيفون الخفيف، حيث تتحرك بأناقة مع خطواتك، مما يجعلك تبدين كأميرة أثناء سيرك.</p>\r\n\r\n<p>إذا كنت تبحثين عن فستان يجذب جميع الأعين إليك في أية مناسبة، فإن هذا الفستان الأبيض هو اختيارك المثالي. ارتديه مع بعض المجوهرات الأنيقة وحذاء ذو كعب عالٍ لإطلالة رائعة تلفت أنظار الجميع.</p>\r\n\r\n<p>لا شك أن هذا الفستان سيرسم ابتسامة جميلة على وجهك وسيرافقك في لحظات لا تُنسى. استعدِّ للحصول على إطلالة استثنائية بهذا التصميم المدهش!</p>', 'فستان أبيض للحفلات هو قطعة أنيقة وجذابة تصلح للمناسبات الخاصة. يتميز بتصميمه الراقي والأنثوي، مع تفاصيل رائعة مثل الدانتيل أو الخرز. يضفي هذا الفستان لمسة من التألق والأناقة على صاحبته، مما يجعلها محط الأنظار في أي حفلة.', NULL, NULL, NULL, NULL),
(18, 7, 5, 'نايك حذاء رياضي برتقالي ورمادي', '<p>وصف حذاء رياضي نايك برتقالي ورمادي</p>\r\n\r\n<h1>نايك حذاء رياضي برتقالي ورمادي</h1>\r\n\r\n<p>هذا الحذاء الرياضي من نايك هو قطعة أنيقة وعصرية تجمع بشكل مثالي بين الأداء العالي والمظهر الجذاب. يتمتع هذا الحذاء بلون برتقالي جميل مع تفاصيل رمادية، مما يضفي عليه لمسة من التألق والأناقة.</p>\r\n\r\n<p>صُنع هذا الحذاء باستخدام أحدث التقنيات في صناعة الأحذية الرياضية، حتى يوفر لك أقصى درجات الراحة والأداء المثلى أثناء ممارسة التمارين أو الأنشطة البدنية المختلفة. يتم تصميمه بشكل يوفر دعمًا فائقًا للقدم وتوفير تهوية مثالية للحفاظ على قدميك جافة ومنتعشة طوال الوقت.</p>\r\n\r\n<p>بغض النظر عن نشاطك الرياضي المفضل، سواء كان ركضًا أو تمارين في الصالة الرياضية أو حتى المشي العادي، فإن هذا الحذاء يعد خيارًا مثاليًا. يتميز بنعل مطاطي متين يوفر ثباتًا استثنائيًا على مختلف الأسطح، بالإضافة إلى تصميمه المرن وخفة وزنه التي تجعل من السهل ارتداؤه والحركة به بسلاسة.</p>\r\n\r\n<p>بفضل تصميمه المبتكر وجودة صُنعه، يُعَدُّ حذاء نايك الرياضي بالألوان البرتقالية والرمادية خيارًا رائعًا لأولئك الذين يبحثون عن التميز والأداء المستدام في حذاء رسمى. احصل على هذا الحذاء الرياضي الرائع وانطلق في تحقيق أهدافك الرياضية بثقة وأناقة.</p>', 'حذاء رياضي برتقالي ورمادي من نايك هو قطعة أنيقة وعصرية لعشاق الألوان الزاهية. مصنوع من مواد عالية الجودة، يتميز بتصميم مريح وخفيف الوزن، مما يجعله مثاليًا للأنشطة الرياضية والارتداء اليومي. إنه خيار رائع لإضافة لمسة من الحيوية والأناقة إلى إطلالتك.', NULL, NULL, NULL, NULL),
(201, 8, 5, 'نايك حذاء رياضي برتقالي ورمادي', NULL, 'حذاء نايك الرياضي باللونين البرتقالي والرمادي هو خيار مثالي لعشاق الأداء الرياضي. يتميز بتصميم عصري وجودة عالية، مما يجعله مثاليًا للأنشطة الرياضية المختلفة. يوفر هذا الحذاء الراحة والدعم المطلوب للقدم أثناء التحرك، مع إظهار الأناقة في آنٍ واحد.', NULL, NULL, NULL, NULL),
(202, 8, 4, 'Nike Sneaker Orange & Gray', '<p>Nike Sneaker Orange &amp; Gray</p>\r\n\r\n<h1>Nike Sneaker Orange &amp; Gray</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Nike Sneaker in Orange &amp; Gray is a stylish and comfortable footwear option for both men and women. With its vibrant orange and gray color combination, this sneaker stands out from the crowd and adds a pop of color to any outfit.</p>\r\n\r\n<p>Designed with performance in mind, this Nike sneaker features a lightweight and breathable upper that keeps your feet cool and dry during intense workouts or everyday activities. The durable construction ensures long-lasting wear, making it suitable for various sports activities or casual wear.</p>\r\n\r\n<p>The shoe&#39;s cushioned midsole provides excellent shock absorption, reducing the impact on your feet and joints while providing all-day comfort. The rubber outsole offers reliable traction on various surfaces, allowing you to move with confidence.</p>\r\n\r\n<p>Featuring Nike&#39;s iconic Swoosh logo on the sides, these sneakers showcase the brand&#39;s commitment to quality and style. The lace-up closure allows for a secure fit and easy adjustments according to your preference.</p>\r\n\r\n<p>Whether you&#39;re hitting the gym, going for a run, or simply running errands around town, the Nike Sneaker in Orange &amp; Gray is a versatile choice that combines fashion and functionality effortlessly.</p>', 'The Nike Sneaker Orange & Gray is a stylish and vibrant shoe perfect for sports and casual wear. With its bold orange and gray color scheme, it catches attention immediately. It offers comfort through its cushioned sole and showcases the iconic Nike logo, making it a must-have footwear for any sneaker enthusiast.', NULL, 'Nike sneaker', NULL, 'Nike sneaker, orange sneaker, gray sneaker, stylish footwear, comfortable shoes, men\'s sneakers, women\'s sneakers'),
(179, 9, 5, 'سماعة ابل ابيض', '<p>وصف سماعة ابل الأبيضة</p>\r\n\r\n<h1>سماعة ابل الأبيضة</h1>\r\n\r\n<p>تُعد سماعة ابل الأبيضة واحدة من أكثر السماعات شهرةً وشعبيةً في عالم التكنولوجيا. تتميز هذه السماعات بتصميم أنيق وجودة صوت عالية، مما يجعلها خيارًا مثاليًا للاستخدام الشخصي أو أثناء التنقل.</p>\r\n\r\n<p>تأتي سماعة ابل باللون الأبيض، مما يُضفي عليها طابعًا جذابًا وأنيقًا. تتطابق هذه السماعات مع مختلف إصدارات هواتف ابل، بدءً من iPhone حتى iPad وMacBook.</p>\r\n\r\n<p>إحدى المزايا المهمة لسماعة ابل هي سهولة الاقتران مع الأجهزة المحمولة. بفضل تقنية Bluetooth، يمكن للمستخدمين ربطها بسهولة مع هواتفهم الذكية أو أجهزتهم اللوحية والاستمتاع بالصوت عالي الجودة.</p>\r\n\r\n<p>تتضمن سماعة ابل ميكروفونًا مدمجًا يسمح للمستخدمين بإجراء المكالمات والدردشة عبر تطبيقات الاتصال، كما أنه يدعم خاصية إلغاء الضوضاء، مما يساعد في منح المستخدم تجربة استخدام سلسة وخالية من التشويش.</p>\r\n\r\n<p>بفضل تقنية شحن سريع، يُعَدُّ شحن سماعة ابل سريعًا وفعَّالًا. تتيح لك هذه التقنية قضاء وقت أطول في الإستخدام دون قلق من نفاد البطارية.</p>', 'سماعة آبل الأبيض هي جهاز استماع صغير وعصري يتم توصيله بأجهزة آبل مثل الآيفون أو الآيباد. تتميز بجودة صوت عالية وتصميم أنيق وسادات أذن مريحة. تضمن السماعة تجربة استماع مذهلة للأغاني والمكالمات الصوتية في أي مكان وفي أي وقت.', NULL, NULL, NULL, NULL),
(180, 9, 4, 'Apple Headphone White', '<p>Apple Headphone White</p>\r\n\r\n<h1>Apple Headphone White</h1>\r\n\r\n<p>The Apple Headphone White is a sleek and stylish audio accessory that provides an excellent sound experience for users. Designed by Apple, it offers high-quality audio output and is compatible with various devices such as iPhones, iPads, MacBooks, and more.</p>\r\n\r\n<p>The headphones feature a classic white color that complements the aesthetics of Apple products. They are lightweight and comfortable to wear for extended periods, making them ideal for daily use or during travel. The ergonomic design ensures a secure fit, preventing them from falling out during physical activities or movement.</p>\r\n\r\n<p>The Apple Headphone White comes with built-in controls that allow users to adjust volume levels, play/pause music, skip tracks, answer/end calls, and activate voice assistants conveniently. The integrated microphone ensures clear voice transmission during phone calls or voice commands.</p>\r\n\r\n<p>These headphones utilize advanced audio technology to deliver rich and immersive sound quality. Whether you enjoy listening to music, podcasts, audiobooks, or watching movies on your device, the Apple Headphone White enhances your overall audio experience with crisp highs and deep bass.</p>\r\n\r\n<p>In addition to their exceptional performance, these headphones are also durable and long-lasting. The high-quality materials used in their construction ensure longevity even with regular use.</p>\r\n\r\n<p>Overall, the Apple Headphone White offers a perfect combination of style, comfort, durability, and superior sound quality. It is an essential accessory for anyone seeking an enjoyable audio experience while using their Apple devices.5</p>', 'The Apple Headphone White is a sleek and stylish audio accessory that offers high-quality sound reproduction. With its ergonomic design and comfortable fit, it allows for an immersive music listening experience. The white color adds a touch of elegance while maintaining the signature Apple aesthetic.', NULL, 'Apple Headphone White - High-Quality Wired Earbuds for Enhanced Audio Experience', NULL, 'Apple headphone white, wired earbuds, high-quality audio, clear sound, immersive experience, music lovers, audiophiles, comfortable fit, convenient controls'),
(195, 10, 5, 'فستان أزرق للحفلات', '<p>وصف فستان أزرق للحفلات</p>\r\n\r\n<h1>فستان أزرق للحفلات</h1>\r\n\r\n<p>يعتبر الفستان الأزرق المثالي للحفلات خيارًا رائعًا لإطلالة مميزة وأنيقة في المناسبات الخاصة. يتميز هذا الفستان بتصميمه الجذاب والجميل، حيث يجمع بين الأناقة والأنوثة في آن واحد.</p>\r\n\r\n<p>تتميز قصة هذا الفستان بطوله المتوسط ​​وخامته العالية الجودة التي تضمن راحة مثالية أثناء ارتدائه. صُمم هذا الفستان بشكل فضفاض على شكل A ، مما يسهّل حركتك ويربط بشكل جذاب على منطقة الخصر، مما يبرز جمال قامتك.</p>\r\n\r\n<p>بالإضافة إلى ذلك، يتميز هذا الفستان بلونه الأزرق الجميل والساحر، والذي يعد لونًا مناسبًا للحفلات والمناسبات الرسمية. يضفي اللون الأزرق تأثيرًا مشرقًا وأنيقًا على المظهر العام، مما يجعلك تبرز في أي حفلة تحضرها.</p>\r\n\r\n<p>إذا كنت تبحثين عن فستان رائع للاستخدام في المناسبات الخاصة، فإن هذا الفستان الأزرق سيكون اختيارًا مثاليًا. اجذبي أنظار جميع الحضور بإطلالتك المدهشة بهذا التصميم المبهج والجذاب.</p>', 'فستان أزرق للحفلات هو تصميم رائع وجذاب يناسب جميع المناسبات الخاصة والحفلات. يتميز بقصته الأنيقة ولونه الجذاب، مما يضفي على الارتداء إطلالة مميزة وأنثوية. فستان أزرق للحفلات هو اختيار مثالي لإبراز أناقة المرأة في المناسبات.', NULL, NULL, NULL, 'فستان، أزرق، حفلات، تصميم، جذاب، رائع، أنوثة، إطلالة ساحرة'),
(196, 10, 4, 'Blue Party Wear Dress', '<p>Blue Party Wear Dress</p>\r\n\r\n<h1>Blue Party Wear Dress</h1>\r\n\r\n<p>A blue party wear dress is a stunning and elegant outfit that is perfect for various special occasions and events. It is designed to make you stand out in the crowd and exude confidence and style.</p>\r\n\r\n<p>This dress features a beautiful shade of blue that complements different skin tones and adds a touch of sophistication. The color blue symbolizes serenity, calmness, and trust, making it an ideal choice for parties where you want to create a lasting impression.</p>\r\n\r\n<p>The design of this party wear dress is carefully crafted to enhance your feminine charm. It may include intricate details such as sequins, lacework, or embroidery that add a glamorous touch to the overall look. The silhouette of the dress can vary, ranging from A-line, sheath, mermaid, or ballgown styles to suit different body types.</p>\r\n\r\n<p>The fabric used for this dress is typically high-quality and comfortable to wear. It may be made of luxurious materials like silk, satin, chiffon, or velvet that give it an opulent feel. The dress may also have additional features like ruffles, pleats, or drapes that enhance its visual appeal.</p>\r\n\r\n<p>To complete your party look with this blue dress, you can pair it with matching accessories such as silver or gold jewelry, high heels or sandals in complementary colors. Consider styling your hair in an elegant updo or leaving it loose with soft curls to further enhance the overall appearance.</p>\r\n\r\n<p>Overall, a blue party wear dress is a timeless and versatile choice that allows you to make a fashion statement while feeling confident and beautiful at any special occasion.</p>', 'This stunning blue party wear dress is the epitome of elegance. Its exquisite design features a flattering silhouette and intricate embellishments that add a touch of glamour. Perfect for any special occasion, this dress will make you feel like the belle of the ball.', NULL, '\"Shop the Stunning Blue Party Wear Dress at Affordable Prices | Perfect for Any Occasion\"', NULL, 'blue party wear dress, stunning dress, affordable prices, special occasion outfit, fashionable attire'),
(177, 11, 4, 'Pink Sport Shoes for women', '<p>Pink Sport Shoes for Women</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Introducing our stylish and comfortable Pink Sport Shoes designed exclusively for women. These shoes are perfect for all your athletic activities, whether it&#39;s running, jogging, or hitting the gym.</p>\r\n\r\n<p>The vibrant pink color adds a touch of femininity to your sporty look while providing the necessary support and functionality. Made with high-quality materials, these shoes ensure durability and long-lasting performance.</p>\r\n\r\n<p>Featuring a lightweight design, these sport shoes offer excellent flexibility and agility during physical activities. The cushioned insoles provide superior comfort and reduce the impact on your feet, allowing you to perform at your best without any discomfort or pain.</p>\r\n\r\n<p>The breathable mesh upper allows proper air circulation to keep your feet cool and dry throughout your workout sessions. Additionally, the non-slip rubber outsole offers great traction on various surfaces, ensuring stability and preventing any accidental slips or falls.</p>\r\n\r\n<p>Our Pink Sport Shoes are available in multiple sizes to cater to different foot shapes and provide an optimal fit. With their trendy design and exceptional performance features, these shoes are not only functional but also fashionable.</p>\r\n\r\n<p>Elevate your athletic style with our Pink Sport Shoes for women today! Order now and experience the perfect blend of comfort, support, and fashion-forward design.0</p>', 'These vibrant pink sport shoes for women combine style and functionality. Designed with a breathable and lightweight material, they offer great comfort during workouts or casual outings. The trendy pink color adds a pop of color to any outfit, making them perfect for active women looking to stand out from the crowd.', NULL, 'Women Shoes', NULL, 'pink shoes.women'),
(178, 11, 5, 'حذاء رياضي وردي للنساء', '<p>حذاء رياضي وردي للنساء</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>نقدم لك حذاء رياضي وردي أنيق ومريح مصمم حصريًا للنساء. هذا الحذاء مثالي لجميع أنشطتك الرياضية ، سواء كان ذلك الجري أو الركض أو الذهاب إلى صالة الألعاب الرياضية.</p>\r\n\r\n<p>يضيف اللون الوردي النابض بالحياة لمسة من الأنوثة إلى مظهرك الرياضي مع توفير الدعم والوظائف اللازمة. صُنع هذا الحذاء من مواد عالية الجودة ، مما يضمن المتانة والأداء طويل الأمد.</p>\r\n\r\n<p>يتميز بتصميم خفيف الوزن ، يوفر هذا الحذاء الرياضي مرونة وخفة حركة ممتازة أثناء الأنشطة البدنية. يوفر النعل الداخلي المبطّن راحة فائقة ويقلل من التأثير على قدميك ، مما يسمح لك بأداء أفضل ما لديك دون أي إزعاج أو ألم.</p>\r\n\r\n<p>يسمح الجزء العلوي الشبكي القابل للتنفس بتدوير الهواء بشكل مناسب للحفاظ على برودة قدميك وجفافهما خلال جلسات التمرين. بالإضافة إلى ذلك ، يوفر النعل الخارجي المطاطي غير القابل للانزلاق ثباتًا كبيرًا على الأسطح المختلفة ، مما يضمن الثبات ويمنع أي انزلاق أو سقوط عرضي.</p>\r\n\r\n<p>تتوفر أحذيتنا الرياضية باللون الوردي بأحجام متعددة لتلائم أشكال القدم المختلفة وتوفر المقاس الأمثل. مع تصميمها العصري وميزات الأداء الاستثنائية ، فإن هذه الأحذية ليست عملية فحسب ، بل إنها عصرية أيضًا.</p>\r\n\r\n<p>ارتقي بأسلوبك الرياضي مع الأحذية الرياضية الوردية للنساء اليوم! اطلب الآن واستمتع بمزيج مثالي من الراحة والدعم والتصميم العصري</p>', 'تجمع هذه الأحذية الرياضية ذات اللون الوردي النابض بالحياة بين الأناقة والعملية. صُممت من مادة خفيفة الوزن تسمح بمرور الهواء ، وتوفر راحة كبيرة أثناء التدريبات أو النزهات غير الرسمية. يضيف اللون الوردي العصري لمسة من الألوان إلى أي جماعة ، مما يجعلها مثالية للنساء النشيطات اللواتي يبحثن عن التميز عن الآخرين.', NULL, NULL, NULL, NULL),
(31, 12, 4, 'Axe Long Lasting Bodyspray', '<p>Axe Long Lasting Bodyspray</p>\r\n\r\n<h1>Axe Long Lasting Bodyspray</h1>\r\n\r\n<p>The Axe Long Lasting Bodyspray is a high-quality body spray designed to keep you smelling fresh and confident throughout the day. With its long-lasting formula, this bodyspray provides an invigorating fragrance that will leave you feeling revitalized and ready to take on any challenge.</p>\r\n\r\n<p>Featuring a unique blend of masculine scents, the Axe Long Lasting Bodyspray offers a captivating aroma that appeals to both men and women. Its refreshing fragrance is perfect for everyday use, whether you&#39;re heading to work, hitting the gym, or going out with friends.</p>\r\n\r\n<p>Not only does this bodyspray provide an alluring scent, but it also helps control body odor by keeping sweat and bacteria at bay. Its advanced formula ensures long-lasting protection against unwanted odors, allowing you to feel confident and fresh all day long.</p>\r\n\r\n<p>The convenient aerosol can design makes it easy to apply the bodyspray evenly across your body. Simply hold the can about 6 inches away from your skin and spray in short bursts for optimal coverage.</p>\r\n\r\n<p>Experience the confidence-boosting power of Axe Long Lasting Bodyspray today and enjoy its irresistible fragrance that lingers on your skin for hours. Make a lasting impression wherever you go with this exceptional body spray!</p>', 'The Axe Long Lasting Bodyspray is created for the modern man who wants to stay fresh and confident all day long. Its irresistible fragrance leaves a lasting impression, while its powerful formula keeps sweat and body odor at bay. Achieve long-lasting freshness with this essential grooming product.', NULL, 'Axe Long Lasting Bodyspray - Stay Fresh and Confident All Day', NULL, 'Axe, bodyspray, long-lasting fragrance, fresh scent, confidence boost'),
(32, 12, 5, 'بخاخ الجسم طويل الأمد من فأس', '<p>بخاخ الجسم طويل الأمد من فأس</p>\r\n\r\n<h1>بخاخ الجسم طويل الأمد من فأس</h1>\r\n\r\n<p>بخاخ الجسم طويل الأمد من فأس هو منتج مبتكر يهدف إلى تزويدك برائحة جذابة وانتعاش دائم على مدار اليوم. يعتبر هذا البخاخ أحدث ابتكار في مجال رائحة الجسم، حيث يقدم تغطية طويلة الأمد للحفاظ على إحساسك بالانتعاش والثقة.</p>\r\n\r\n<p>صُنع بخاخ الجسم طويل الأمد من فأس باستخدام تركيبة فريدة تضفي على بشرتك رائحة رائعة ولا تقاوم. كل رذاذ ينقلك إلى عالَمٍ مليءٍ بالزهور والفواكه والروائح المنعشة، لتستمتع بإحساسٍ مدهشٍ طوال اليوم.</p>\r\n\r\n<p>يتميز بخاخ الجسم طويل الأمد من فأس بتصميمه المريح والعصري، مما يجعله سهل الاستخدام والحمل في حقيبتك أثناء التنقل. كما يأتي بغطاء قابل للإغلاق بإحكام لضمان عدم تسرب السائل أو التبخير غير المرغوب فيه.</p>\r\n\r\n<p>استخدام هذا البخاخ سهل جدًا، فقط قُم برش الكمية المناسبة على جسمك للاستفادة من تأثيره طويل الأمد. يعد بخاخ الجسم طويل الأمد من فأس اختيارًا مثاليًا لك إذا كنت تبحث عن رائحة فريدة وانتعاش دائم يعزز ثقتك وجاذبيتك.</p>', 'بخاخ الجسم طويل الأمد من فأس هو مستحضر للعناية بالجسم يوفر رائحة منعشة تدوم طويلاً. يحتوي على تركيبة فعالة تعمل على إزالة الروائح الغير مرغوب فيها وتثبيت الروائح الجميلة على الجسم. مناسب للاستخدام اليومي وخفيف على البشرة.', NULL, NULL, NULL, NULL),
(205, 13, 4, 'Queen Red High Heels', '<p>Queen Red High Heels are the epitome of glamour and sophistication. These stunning statement shoes feature a bold red color that demands attention and exudes confidence. With their high stiletto heel and luxurious design, they are perfect for any special occasion or a night out on the town. Feel like royalty in these Queen Red High Heels.</p>', 'Queen Red High Heels are the epitome of glamour and sophistication. These stunning statement shoes feature a bold red color that demands attention and exudes confidence. With their high stiletto heel and luxurious design, they are perfect for any special occasion or a night out on the town. Feel like royalty in these Queen Red High Heels.', NULL, 'Shop the Elegant Queen Red High Heels - Perfect for Any Occasion', NULL, 'queen red high heels, elegant high heels, red stiletto shoes, women\'s fashion footwear, luxurious heels, stylish party shoes'),
(206, 13, 5, 'الملكة الحمراء عالية الكعب', '<p>الملكة الحمراء عالية الكعب</p>\r\n\r\n<h1>الملكة الحمراء عالية الكعب</h1>\r\n\r\n<p>تُعد الملكة الحمراء عالية الكعب واحدة من أشهر وأبرز أنواع الأحذية للنساء في عالم الموضة. تتميز هذه الأحذية بتصميمها الفريد وجودتها العالية، ما يجعلها خيارًا مثاليًا للسيدات اللواتي يسعين لإطلالة أنيقة وجذابة.</p>\r\n\r\n<p>تُصنَّع الملكة الحمراء عالية الكعب باستخدام مواد فاخرة وعصرية، مثل جلد طبيعي عالي الجودة وقماش ناعم. تتناسب هذه المواد مع شكل قدم المرأة، ما يضفي راحة استثنائية أثناء ارتدائها.</p>\r\n\r\n<p>تأتي الملكة الحمراء عالية الكعب بأشكال وألوان متنوعة، تلبي جميع الأذواق والمناسبات. سواء كنت ترغب في ارتداء حذاء أسود أنيق لحفلة أو حذاء باللون الأحمر الجريء لإضافة لمسة من الجاذبية إلى إطلالتك، فإن الملكة الحمراء عالية الكعب هي خيار رائع.</p>\r\n\r\n<p>لا يُمكن إنكار أهمية الملكة الحمراء عالية الكعب في صناعة الموضة. فهي قطعة رائعة تضفي لمسة من التألق والثقة على شخصية المرأة التي تختار ارتدائها. بغض النظر عن مستوى ثقافتها في مجال الموضة، فإن ارتداء هذا الحذاء يُظهِر جانبًا مختلفًا من أناقتها وروحها المغامرة.</p>', 'الملكة الحمراء عالية الكعب هو حذاء أنيق وجذاب يتميز بكعبه العالي ولونه الأحمر الجذاب. يضفي هذا الحذاء لمسة من التألق والشخصية على إطلالة المرأة، مما يجعلها تشعر بالثقة والجاذبية في كل مكان تذهب إليه.', NULL, NULL, NULL, NULL),
(203, 14, 4, 'Blue Sun Hat', '<p>Blue Sun Hat</p>\r\n\r\n<h1>Blue Sun Hat</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Blue Sun Hat is a stylish and functional accessory that will keep you protected from the sun while adding a pop of color to your outfit. Made from high-quality materials, this hat offers both comfort and durability.</p>\r\n\r\n<p>The hat features a wide brim that provides excellent shade, shielding your face and neck from harmful UV rays. Whether you&#39;re lounging at the beach, gardening in your backyard, or enjoying outdoor activities, this hat will ensure you stay cool and protected.</p>\r\n\r\n<p>The vibrant blue color of the hat adds a refreshing touch to any ensemble. It complements various summer outfits, making it a versatile accessory for both casual and dressier occasions. The hat&#39;s design includes a decorative band around the base, adding an extra element of style.</p>\r\n\r\n<p>This Blue Sun Hat is also adjustable, allowing you to customize the fit according to your preference. It is suitable for both men and women with its unisex design.</p>\r\n\r\n<p>Invest in this Blue Sun Hat today and elevate your sun protection game while staying fashion-forward!</p>', 'This stylish blue sun hat is the perfect accessory to shield yourself from harsh rays while enhancing your outfit. Made with high-quality materials, it offers comfort and durability. The wide brim provides excellent sun protection, making it ideal for outdoor adventures or relaxing days at the beach.', NULL, '\"Stay Cool and Stylish with our Blue Sun Hat | Shop Now\"', NULL, 'blue sun hat, stylish sun hat, sun protection, beach accessories, outdoor fashion'),
(204, 14, 5, 'قبعة الشمس الزرقاء', '<p>وصف قبعة الشمس الزرقاء</p>\r\n\r\n<h1>وصف قبعة الشمس الزرقاء</h1>\r\n\r\n<p>تُعدّ قبعة الشمس الزرقاء منتجًا فريدًا وأنيقًا يوفر حماية فائقة من أشعة الشمس ويضيف لمسة أنيقة إلى مظهرك. تم تصميم هذه القبعة بأحدث التقنيات والخامات عالية الجودة لتلبية احتياجاتك في فصل الصيف.</p>\r\n\r\n<p>تتميز قبعة الشمس بلونها الزرقاء المذهل، حيث يضفي ذلك لونًا جذابًا ولافتًا على رأسك. كما تأتي بتصميم عصري وأنيق يناسب جميع الأذواق، مستوحى من أحدث صيحات الموضة. ستلاحظ أنها تُضفِّر بشكل رائع عند ارتدائها، مما يجعلك تبدين أنيقة ومحافظة في آن واحد.</p>\r\n\r\n<p>توفر قبعة الشمس الزرقاء حماية فائقة لوجهك وعينيك من أشعة الشمس الضارة. فهي مصنوعة من خامات عالية الجودة تحجز الأشعة فوق البنفسجية بنسبة عالية، مما يحافظ على صحة بشرتك ويقلل من خطر التعرض لأضرار أشعة الشمس.</p>\r\n\r\n<p>بالإضافة إلى ذلك، تتميز قبعة الشمس بخفتها وسهولة حملها. يُمكن طيها بسهولة لتصغير حجمها ووضعها في حقيبتك دون أخذ مساحة كبيرة. هذه الميزة تجعل قبعتك رفيقًا مثاليًا للسفر والخروجات في فصل الصيف.</p>\r\n\r\n<p>لا تُضِفْ فقط قبعة شمس زرقاء إلى إطلالتك الصيفية، بل احرص على حماية نفسك من أشعة الشمس الضارة. احصل على قبعة الشمس الزرقاء الآن واستمتع بإشراقة صيفية آمنة وأنيقة.</p>', 'قبعة الشمس الزرقاء هي قبعة أنيقة وعصرية مصنوعة من قماش عالي الجودة بلون أزرق جميل. تتميز بحافتها الواسعة التي توفر حماية فعالة من أشعة الشمس، مثالية للاستخدام في الأيام المشمسة وفصل الصيف. تضفي هذه القبعة لمسة رائعة إلى إطلالتك وتحافظ على جمال بشرتك.', NULL, NULL, NULL, '\"قبعة، شمس، زرقاء، حماية، تصميم، جودة، استخدام، مناسبات\"'),
(272, 15, 4, 'Yellow Chair With Pillow', '<p>Yellow Chair With Pillow</p>\r\n\r\n<h1>Yellow Chair With Pillow</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Yellow Chair With Pillow is a stylish and comfortable seating option that adds a pop of color to any room. The chair features a vibrant yellow upholstery that instantly brightens up the space and creates a cheerful atmosphere. Its modern design with clean lines and sleek curves gives it a contemporary look, making it suitable for various interior styles.</p>\r\n\r\n<p>The chair comes with a matching pillow that provides additional comfort and support for your back. The pillow is made from soft and plush materials, ensuring a cozy seating experience. It can be easily adjusted or removed according to your preference.</p>\r\n\r\n<p>Constructed with high-quality materials, the Yellow Chair With Pillow is built to last. It has a sturdy frame that ensures stability and durability over time. The cushioning is firm yet comfortable, allowing you to sit for extended periods without feeling any discomfort.</p>\r\n\r\n<p>Whether placed in the living room, bedroom, or office, this yellow chair will effortlessly complement your existing furniture and decor. Its eye-catching color makes it an excellent accent piece that adds visual interest to the space.</p>\r\n\r\n<p>Overall, the Yellow Chair With Pillow combines style, comfort, and functionality in one package. It is perfect for anyone looking to add a touch of vibrancy and relaxation to their living space.</p>', 'This bright and cheerful yellow chair brings a pop of color to any room. Complete with a soft and comfortable pillow, it\'s the perfect spot to relax and unwind. Whether used as an accent piece or a cozy reading nook, this chair adds style and comfort to any space.', NULL, '\"Comfortable and Stylish Yellow Chair with Pillow | Perfect Addition to Any Living Space\"', NULL, 'yellow chair, pillow, comfortable seating, stylish furniture, home decor, living room furniture'),
(273, 15, 5, 'كرسي أصفر مع وسادة', '<p>وصف كرسي أصفر مع وسادة</p>\r\n\r\n<h1>وصف كرسي أصفر مع وسادة</h1>\r\n\r\n<p>كرسي أصفر مع وسادة هو قطعة أثاث فريدة من نوعها تضفي لمسة جمالية رائعة على أي مكان توضع فيه. يتميز هذا الكرسي بلونه الأصفر الزاهي الجذاب الذي يضفي إشراقًا وحيوية على المكان.</p>\r\n\r\n<p>تأتي الوسادة المصاحبة للكرسي بلون متناسق يعزز جمالية التصميم، كما تضمن راحة استثنائية للجالس. تُضاف الوسادة إلى ظهر الكرسي لتقديم دعم إضافي للظهر والأكتاف، مما يجعل تجربة الجلوس على هذا الكرسي أكثر راحة وإستدامة.</p>\r\n\r\n<p>بالإضافة إلى جودته المتفوقة، يتميز هذا الكرسي بتصميمه المعاصر والأنيق. فهو يناسب مختلف أنماط الديكور والمساحات، سواء كان ذلك في المنزل أو في مكاتب العمل أو حتى في الفنادق والمطاعم.</p>\r\n\r\n<p>إذا كنت تبحث عن قطعة أثاث تضفي لمسة من الألوان والأناقة على مساحتك، فإن كرسي أصفر مع وسادة هو خيار رائع لك. اجعل من جلستك تجربة مريحة وجميلة بهذا الكرسي المدهش.</p>', 'كرسي أصفر مع وسادة هو قطعة أثاث عصرية ومريحة تضفي لمسة جمالية إلى أي منزل. يتميز بلونه الزاهي ووجود وسادة ناعمة توفر الدعم للظهر والأرجل. مثالي للاستخدام في غرف المعيشة أو غرف النوم، حيث يجمع بين التصميم الجذاب والراحة المدهشة.', NULL, NULL, NULL, NULL),
(266, 16, 4, 'Gray Comfort Chair', '<p>Gray Comfort Chair</p>\r\n\r\n<h1>Gray Comfort Chair</h1>\r\n\r\n<p> </p>\r\n\r\n<p>The Gray Comfort Chair is the perfect addition to any living space or office, providing exceptional comfort and style. With its sleek and modern design, this chair effortlessly blends into any decor, adding a touch of elegance to your room.</p>\r\n\r\n<p>Made with high-quality materials, the Gray Comfort Chair ensures durability and longevity. Its sturdy frame provides stability while the plush cushioning offers a cozy seating experience. The chair\'s ergonomic design supports your body in all the right places, promoting proper posture and reducing strain on your back and neck.</p>\r\n\r\n<p>The gray upholstery adds a sophisticated touch to the chair, making it versatile enough to complement any color scheme. Whether you prefer a minimalist or contemporary aesthetic, this chair will effortlessly fit in with your existing furniture.</p>\r\n\r\n<p>Whether you\'re curling up with a good book or working long hours at your desk, the Gray Comfort Chair is designed for ultimate relaxation. Its wide seat and padded armrests provide ample space for you to unwind and find comfort after a long day.</p>\r\n\r\n<p>Invest in the Gray Comfort Chair today and experience the perfect blend of style and comfort in your home or office.</p>', 'The Gray Comfort Chair is a stylish and practical addition to any living space. With its plush cushioning and ergonomic design, it offers ultimate comfort and relaxation. The neutral gray color seamlessly blends with any decor style, making it a versatile and timeless piece of furniture for your home.', NULL, '\"Gray Comfort Chair - Stylish and Relaxing Seating for Your Home\"', NULL, 'gray comfort chair, stylish seating, relaxing chair, home furniture, comfortable seating, elegant design'),
(267, 16, 5, 'كرسي مريح رمادي', '<p>وصف كرسي مريح رمادي</p>\r\n\r\n<h1>وصف كرسي مريح رمادي</h1>\r\n\r\n<p>كرسي المريح الرمادي هو قطعة أثاث عالية الجودة وذات تصميم أنيق وعصري. يتمتع بألوان هادئة وجذابة، ما يجعله مناسبًا لأغلب ديكورات المنزل.</p>\r\n\r\n<p>تتميز هذه الكرسي بوجود مسند ظهر عالٍ ومقعد واسع يوفر الدعم والراحة المثلى للجسم. إضافة إلى ذلك، فإن الكرسي مصنوع من خامات عالية الجودة تضمن متانته وطول عمره.</p>\r\n\r\n<p>بشكل عام، يُعَدُّ هذا الكرسي مناسبًا للاستخدام في غرف المعيشة أو غرف الاستقبال أو حتى في غرف النوم. فهو يضفي لمسة أنيقة وعصرية على أي مكان يتم وضعه فيه.</p>\r\n\r\n<p>إذا كنت تبحث عن قطعة أثاث تجمع بين الأناقة والراحة، فإن كرسي المريح الرمادي هو الخيار المثالي لك. استمتع بلحظات الاسترخاء والجلوس المريحة مع هذا الكرسي الأنيق.</p>', 'كرسي مريح رمادي هو قطعة أثاث عصرية وأنيقة تضفي لمسة ذوق راقية على أي منزل. صُمم الكرسي بألوان ناعمة واحترافية، مع وسادة ناعمة لدعم الظهر والجسم. يوفر هذا الكرسي راحة فائقة للاستمتاع بالجلوس والاسترخاء في الأوقات الهادئة.', NULL, NULL, NULL, NULL),
(191, 17, 4, 'Rounded Table With 3 Pillows', '<p>Rounded Table With 3 Pillows</p>\r\n\r\n<h1>Rounded Table With 3 Pillows</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A rounded table with three pillows is a versatile and stylish addition to any living space or outdoor area. This unique furniture piece combines functionality with aesthetic appeal, providing both comfort and visual interest.</p>\r\n\r\n<p>The rounded table is designed to create a cozy and intimate atmosphere, perfect for gatherings or casual conversations. Its curved shape allows for easy interaction among individuals seated around it, promoting a sense of inclusivity and connection.</p>\r\n\r\n<p>The three pillows accompanying the table add an extra layer of comfort. Placed strategically along the inner curve of the table, they provide support and cushioning for those seated. The pillows are made from high-quality materials, ensuring durability and long-lasting use.</p>\r\n\r\n<p>This rounded table with three pillows comes in various colors and designs, allowing you to choose the one that best matches your existing decor or personal style. Whether you prefer neutral tones for a minimalist look or vibrant hues for a pop of color, there is an option available to suit your preferences.</p>\r\n\r\n<p>With its compact size, this rounded table can fit well in small apartments or rooms without overwhelming the space. It can be used as a coffee table in the living room, a dining table in the kitchenette, or even as an outdoor seating arrangement on a patio or balcony.</p>', 'This rounded table is an elegant addition to any living space or patio. Its smooth, curved design adds a touch of sophistication, while the three accompanying pillows offer both comfort and style. Perfect for gathering with friends or enjoying some quiet relaxation time.', NULL, 'Stylish Rounded Table with 3 Pillows for Modern Living Spaces', 'ish Rounded Table with 3 Pillows for Modern Living Spaces', 'rounded table, 3 pillows, modern living spaces, stylish furniture, versatile design'),
(192, 17, 5, 'مائدة مستديرة مع 3 وسائد', '<p>وصف مائدة مستديرة مع 3 وسائد</p>\r\n\r\n<h1>وصف مائدة مستديرة مع 3 وسائد</h1>\r\n\r\n<p>تعتبر المائدة المستديرة مع الوسائد الثلاث من أهم القطع التي تضفي جمالاً وأناقة على أي غرفة نوم أو صالة جلوس. تتميز هذه المائدة بتصميمها المستدير الذي يضفي لمسة من الانسجام والاتساق على الديكور العام للغرفة.</p>\r\n\r\n<p>تأتي المائدة بحجم مناسب يناسب أغلب المساحات، حيث يمكن وضعها في زواية من الغرفة أو في وسطها. تأتي بثلاث وسائد رقيقة ومريحة، تضفي لمسة من الراحة على جلوسك.</p>\r\n\r\n<p>إن شكل المائدة والوسائد يتناسبان تمامًا مع الألوان المحيطة، حيث يمكن اختيارها بألوان متناسقة مع بقية الديكور في الغرفة. بالإضافة إلى ذلك، يمكن تغيير وسائد المائدة بألوان وتصاميم جديدة حسب رغبتك لإضفاء لمسة من التجديد والتغيير على الديكور.</p>\r\n\r\n<p>تعد المائدة المستديرة مع الوسائد خيارًا مثاليًا لأولئك الذين يبحثون عن أثاث عصري وعملي في نفس الوقت. فهذه المائدة لا تشغل مساحة كبيرة ولا تشوش على التصميم العام للغرفة، بل تضفي شعورًا بالراحة والهدوء في كل زاوية من زواياها.</p>', 'مائدة مستديرة مع 3 وسائد هي قطعة ديكور أنيقة وفعالة لتجهيز مساحات المعيشة. تتميز بتصميمها الأنثوي المميز وبثلاث وسائد ناعمة للراحة. تضفي هذه المائدة جوًا من الأناقة والرحابة على أية زوايا في البيت، مثالية للاسترخاء أثناء التجمعات العائلية أو الأنشطة الترفيهية.', NULL, NULL, NULL, NULL);
INSERT INTO `product_description` (`id`, `product_id`, `language_id`, `name`, `description`, `short_description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(189, 18, 4, 'Modern Study Chair', '<p>Modern Study Chair</p>\r\n\r\n<h1>Modern Study Chair</h1>\r\n\r\n<p>The modern study chair is a stylish and ergonomic piece of furniture designed to enhance comfort and productivity during study or work sessions. With its sleek and contemporary design, it not only serves as a functional seating solution but also adds aesthetic appeal to any modern interior.</p>\r\n\r\n<p>This chair features a sturdy frame made of high-quality materials such as metal or wood, ensuring durability and longevity. The seat and backrest are ergonomically shaped to provide optimal support for the user&#39;s posture, reducing strain on the back, neck, and shoulders. Some models may also include adjustable features such as height, tilt, or lumbar support to cater to individual preferences.</p>\r\n\r\n<p>The modern study chair often incorporates cushioning or padding in the seat and backrest for added comfort during long study sessions. It may be upholstered with premium fabrics or leather for a luxurious touch. Additionally, the chair may have armrests that offer extra support while working.</p>\r\n\r\n<p>Furthermore, this chair typically includes a swivel base that allows easy movement and rotation without having to get up from the seat. It is equipped with smooth-rolling casters that enable effortless mobility across different flooring surfaces.</p>\r\n\r\n<p>In summary, the modern study chair combines style and functionality, providing a comfortable and supportive seating option for studying or working. Its contemporary design, ergonomic features, and adjustable options make it an ideal choice for individuals seeking both comfort and aesthetic appeal in their study or workspace.</p>', 'The modern study chair is a sleek and functional piece of furniture designed to provide comfort and support during long study sessions. Featuring an ergonomic design, adjustable height and backrest, it promotes good posture and reduces strain on the body. Its contemporary style adds a touch of sophistication to any study or workspace.', NULL, 'Modern Study Chair - Stylish and Ergonomic Chairs for Ultimate Comfort', 'rn Study Chair - Stylish and Ergonomic Chairs for Ultimate Comfort', 'modern study chair, stylish chairs, ergonomic design, comfortable seating, contemporary study furniture'),
(190, 18, 5, 'كرسي الدراسة الحديث', '<p>وصف كرسي الدراسة الحديث</p>\r\n\r\n<h1>كرسي الدراسة الحديث</h1>\r\n\r\n<p>كرسي الدراسة الحديث هو قطعة أثاث مصممة خصيصًا لتلبية احتياجات وراحة طالب أثناء دراسته. يعتبر هذا الكرسي جزءًا هامًا من بيئة التعلم المنزلية أو المكتبية، حيث يقضي الطلاب ساعات طويلة فيه لإكمال واجباتهم المدرسية والدروس.</p>\r\n\r\n<p>تصميم كرسي الدراسة الحديث يضم عناصر عديدة تهدف إلى تعزيز التركيز والانتباه أثناء الدراسة. فهو يأتي بظهر عالٍ ومقعد مبطّن لضمان دعم صحي لظهر وجسم الطالب. كذلك، يُضاف إلى التصميم مساند قابلة للتعديل للذراعَيْن والظهر، مما يسهم في توفير وضعية مريحة للجسم أثناء الجلوس.</p>\r\n\r\n<p>بالإضافة إلى ذلك، يتميز كرسي الدراسة الحديث بقاعدة قوية ومستقرة، مصنوعة من مواد عالية الجودة. يُضاف إلى ذلك نظام للتحكم في ارتفاع المقعد، حتى يتناسب مع احتياجات كل فرد. كما يأتي بعجلات لسهولة التنقل والانتقال بين المكانات المختلفة داخل الغرفة أو المكتب.</p>\r\n\r\n<p>بشكل عام، فإن كرسي الدراسة الحديث هو قطعة أثاث عصرية ومريحة، تهدف إلى تحسين تجربة التعلم وزيادة إنتاجية الطالب. فهو يوفِّر دعمًا صحيًا لظهر وجسم الطالب، ويرفِّه عن التوتر والإجهاد أثناء ساعات الدراسة.</p>', 'كرسي الدراسة الحديث يتميز بتصميمه المبتكر والعصري، حيث يوفر راحة ودعم للظهر للطلاب أثناء الدراسة. يتميز بقابلية التعديل لضبطه وفقًا لارتفاع المكتب، كما يوفر جودة عالية في التصنيع والمواد. إنه خيار مثالي لجعل تجربة الدراسة أكثر سهولة ومرونة.', NULL, NULL, NULL, NULL),
(49, 19, 4, 'Wild Stone Ultra Sensual Perfume Spray for men', '<p>Wild Stone Ultra Sensual Perfume Spray</p>\r\n\r\n<h1>Wild Stone Ultra Sensual Perfume Spray for Men</h1>\r\n\r\n<p>The Wild Stone Ultra Sensual Perfume Spray for Men is a captivating fragrance that exudes charm and sophistication. Designed specifically for the modern man, this perfume spray offers a unique blend of notes that creates an irresistible aura around you.</p>\r\n\r\n<p>With its long-lasting fragrance, this perfume spray ensures you stay fresh and confident throughout the day. The top notes of bergamot and lemon provide a refreshing burst of citrus, while the heart notes of lavender and rosemary add a touch of elegance. The base notes of musk and ambergris give it a sensual and masculine undertone.</p>\r\n\r\n<p>The Wild Stone Ultra Sensual Perfume Spray comes in an attractive bottle that is sleek and easy to carry. Its convenient spray mechanism allows for effortless application, making it perfect for daily use or special occasions.</p>\r\n\r\n<p>This perfume spray is suitable for all seasons and occasions, whether it&#39;s a formal event or a casual outing. It complements your style and personality, leaving a lasting impression wherever you go.</p>\r\n\r\n<p>Elevate your grooming routine with the Wild Stone Ultra Sensual Perfume Spray for Men and experience the ultimate blend of sensuality and sophistication.</p>', 'Wild Stone Ultra Sensual Perfume Spray for men is an invigorating fragrance that exudes confidence and allure. Its enchanting blend of aromatic notes creates a captivating aura that lingers all day. Perfect for the modern man, this perfume spray will make heads turn wherever you go, leaving a lasting impression.', NULL, 'Wild Stone Ultra Sensual Perfume Spray for Men | Long-lasting Fragrance', 'Stone Ultra Sensual Perfume Spray for Men | Long-lasting Fragrance', 'Wild Stone, Ultra Sensual, Perfume Spray, Men\'s Fragrance, Long-lasting scent'),
(50, 19, 5, 'عطر وايلد ستون الترا سينسوال بخاخ للرجال', '<p>وصف عطر وايلد ستون الترا سينسوال بخاخ للرجال</p>\r\n\r\n<h1>عطر وايلد ستون الترا سينسوال بخاخ للرجال</h1>\r\n\r\n<p>عطر وايلد ستون الترا سينسوال بخاخ للرجال هو عبارة عن رائحة فريدة تم تصميمها خصيصًا للرجل العصري الذي يبحث عن الأناقة والجاذبية. يعكس هذا العطر الفخامة والقوة في آن واحد، ممزوجًا بروائح حارة وغامضة تضفي جوًّا من التشويق والإثارة.</p>\r\n\r\n<p>تفتتح نغماته العليا بانتعاش البرغموت المشرق، ممزوجًا بروائح حارة من فلفل سيشوان المثير. يأتي قلب العطر مزودًا بروائح خشبية دافئة من أوركانوكس، ممزجًا بأوراق الباتشولي والجلد لإضفاء لمسة رجولية على العطر. أما قاعدة العطر، فتحتوي على نفحات من خشب الصندل والبخور، مما يضفي لمسة غامضة وجذابة تستمر طوال اليوم.</p>\r\n\r\n<p>يأتي هذا العطر في زجاجة بخاخ أنيقة وعصرية، تحمل شعار وايلد ستون المميز. يعتبر عطر وايلد ستون الترا سينسوال بخاخ للرجال رفيقًا مثاليًّا للسهرات المسائية والمناسبات الخاصة، حيث يضفي لمسة من التألق والأناقة على إطلالتك.</p>\r\n\r\n<p>انغمس في عبير هذا العطر المغرٍّ واسكب جاذبيةً فوريةً في كل خطوة تخطوها. احصل على عطر وايلد ستون الترا سينسوال بخاخ للرجال الآن وانغمس في رائحته المدهشة التي ستأسر الجميع حولك.</p>', 'عطر وايلد ستون الترا سينسوال بخاخ للرجال هو عطر مغري ومدهش يجمع بين الأصالة والحداثة. يتميز بمزيج فريد من الروائح الحارة والشرقية مع لمسة خشبية. يضفي هذا العطر الجديد رائحة غامضة وغير قابلة للنسيان تبرز شخصية صاحبه وتترك انطباعًا قويًا في كل من حوله.', NULL, NULL, NULL, '- عطور رجالية- عطور فاخرة- Wild Stone Ultra Sensual- بخاخ عطور رجالية- Wild Stone perfume for men'),
(51, 20, 4, 'HP Victus Gaming Latest 12th Gen Intel Core i5 12450H Processor 15.6 inch', '<p>HP Victus Gaming Laptop</p>\r\n\r\n<h1>HP Victus Gaming Laptop</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The HP Victus Gaming laptop is a powerful device designed for gamers and professionals seeking high performance in a portable package. It features the latest 12th Gen Intel Core i5 12450H Processor, offering exceptional processing power for smooth multitasking and immersive gaming experiences.</p>\r\n\r\n<p>The laptop boasts a vibrant 15.6-inch display, providing crisp visuals with its Full HD resolution. Whether you&#39;re gaming, streaming movies, or working on creative projects, the display delivers stunning clarity and detail.</p>\r\n\r\n<p>In terms of graphics capabilities, the HP Victus Gaming laptop is equipped with an NVIDIA GeForce GTX graphics card. This ensures smooth gameplay and allows you to tackle demanding tasks such as video editing or graphic design with ease.</p>\r\n\r\n<p>With ample storage space provided by its solid-state drive (SSD), you can store all your games, files, and applications without worrying about running out of space. The laptop also features fast boot-up times and quick access to your data.</p>\r\n\r\n<p>In addition to its impressive performance, the HP Victus Gaming laptop offers a sleek and modern design. Its durable construction ensures it can withstand the rigors of daily use while remaining lightweight enough to carry on-the-go.</p>\r\n\r\n<p>Overall, the HP Victus Gaming laptop is a reliable choice for gamers and professionals alike who require a powerful device that can handle intensive tasks while providing an immersive visual experience.</p>', 'Introducing the HP Victus Gaming Laptop equipped with the latest 12th Gen Intel Core i5 12450H Processor. With its powerful performance and 15.6-inch display, this laptop is perfect for gamers and professionals alike. Experience seamless multitasking, stunning visuals, and smooth gameplay in a sleek and stylish design.', NULL, 'HP Victus Gaming Laptop | 12th Gen Intel Core i5 12450H Processor | 15.6 inch', 'ctus Gaming Laptop | 12th Gen Intel Core i5 12450H Processor | 15.6 inch', 'HP Victus Gaming Laptop, 12th Gen Intel Core i5 12450H Processor, 15.6 inch, gaming laptop, high-performance gaming, immersive visuals, seamless gameplay'),
(52, 20, 5, 'HP Victus Gaming أحدث معالج Intel Core i5 12450H من الجيل الثاني عشر مقاس 15.6 بوصة', '<p>وصف لجهاز HP Victus Gaming</p>\r\n\r\n<h1>وصف لجهاز HP Victus Gaming</h1>\r\n\r\n<p>يُعد جهاز HP Victus Gaming من أحدث الأجهزة المحمولة التي تم إطلاقها من قبل شركة HP. يتميز هذا الجهاز بالعديد من الميزات والمواصفات التقنية التي تسهم في تحسين تجربة الألعاب والأداء العام.</p>\r\n\r\n<p>يتمتع جهاز HP Victus Gaming بمعالج Intel Core i5 12450H من الجيل الثاني عشر، والذي يقدم أداءً متفوقًا وسرعة استجابة فائقة. يُعد هذا المعالج مثاليًا للألعاب ذات الطلبات المرتفعة وبرامج التصميم والإنتاجية.</p>\r\n\r\n<p>بشاشة بحجم 15.6 بوصة، يُظهر جهاز HP Victus Gaming صورًا حادّة وواضحة بدقة عالية. يمكن للمستخدمين الاستمتاع بتجربة مشاهدة مثالية أثناء اللعب أو مشاهدة الأفلام.</p>\r\n\r\n<p>إلى جانب ذلك، يتميز هذا الجهاز بتصميم أنيق وأنابيب تبريد فعّالة للحفاظ على درجات حرارة منخفضة أثناء استخدامه لفترات طويلة. كما يحتوي على نظام صوت قوي يعزز تجربة الصوت المحيطية.</p>\r\n\r\n<p>لا يُقدِّم جهاز HP Victus Gaming فقط أداءً قويًا وسلاسة في التشغيل، بل يأتي أيضًا ببطارية تدوم طويلًا، مما يسمح للمستخدم باللعب لفترات طويلة دون الحاجة إلى شحن مستمر.</p>\r\n\r\n<p>إذا كنت تبحث عن جهاز حاسوب محمول قادر على تشغيل الألعاب والأداء المطور، فإن جهاز HP Victus Gaming هو الخيار المثالي لك.</p>', 'HP Victus Gaming هو جهاز كمبيوتر محمول حديث يأتي بأحدث معالج Intel Core i5 12450H من الجيل الثاني عشر. يتميز بشاشة قياس 15.6 بوصة، وهو مثالي للاستخدام في ألعاب الفيديو والأداء المتعدد المهام. تصميمه الفريد وأدائه القوي يجعلانه خيارًا مثاليًا للاعبين ومحترفي التصميم.', NULL, NULL, NULL, NULL),
(53, 21, 4, 'Samsung Galaxy M14 5G (ICY Silver, 6GB, 128GB Storage)', '<p>Samsung Galaxy M14 5G (ICY Silver, 6GB, 128GB Storage)</p>\r\n\r\n<h1>Samsung Galaxy M14 5G (ICY Silver, 6GB, 128GB Storage)</h1>\r\n\r\n<p>The Samsung Galaxy M14 5G is a powerful smartphone that combines sleek design with impressive features. It comes in the stunning ICY Silver color option and offers a generous storage capacity of 128GB along with 6GB of RAM for smooth multitasking.</p>\r\n\r\n<p>Equipped with the latest 5G technology, this phone ensures lightning-fast internet connectivity and allows you to enjoy seamless streaming, gaming, and browsing experiences. The device features a large display that measures XX inches diagonally, providing an immersive viewing experience for your favorite movies and games.</p>\r\n\r\n<p>The Samsung Galaxy M14 boasts a high-resolution rear camera setup that captures stunning photos and videos. With advanced features like autofocus and image stabilization, you can capture sharp and clear images even in challenging conditions. T2he front-facing camera is perfect for taking selfies or making video calls.</p>\r\n\r\n<p>In terms of performance, the Samsung Galaxy M14 is powered by a powerful processor that delivers fast and efficient performance. It runs on the latest Android operating system, ensuring a smooth user experience and access to a wide range of apps from the Google Play Store.</p>\r\n\r\n<p>With its sleek design, impressive features, and reliable performance, the Samsung Galaxy M14 5G is a great choice for those looking for a high-quality smartphone that offers both style and functionality.</p>', 'The Samsung Galaxy M14 5G in ICY Silver is a powerful smartphone offering a smooth and efficient experience. With 6GB RAM and ample 128GB storage, enjoy seamless multitasking and store all your files effortlessly. Its stylish design combined with the latest 5G technology makes it an excellent choice for fast connectivity.', NULL, 'Samsung Galaxy M14 5G (ICY Silver, 6GB RAM, 128GB Storage) - Latest Smartphone with High-Speed Connectivity', 'ng Galaxy M14 5G (ICY Silver, 6GB RAM, 128GB Storage) - Latest Smartphone with High-Speed Connectivity', 'Samsung Galaxy M14, 5G smartphone, ICY Silver color, high-speed connectivity, 6GB RAM, 128GB storage'),
(54, 21, 5, 'Samsung Galaxy M14 5G (ICY Silver، 6GB، 128GB Storage)', '<p>وصف سامسونج جالاكسي M14 5G</p>\r\n\r\n<h1>وصف سامسونج جالاكسي M14 5G (ICY Silver، 6GB، 128GB تخزين)</h1>\r\n\r\n<p>سامسونج جالاكسي M14 5G هو هاتف ذكي متطور يدعم تقنية الجيل الخامس للاتصالات المتقدمة. يأتي بتصميم أنيق ولون فضي مثير يضفي لمسة عصرية على الهاتف.</p>\r\n\r\n<p>بفضل ذاكرة الوصول العشوائي (RAM) سعة 6 جيجابايت، يعمل الهاتف بشكل سلس ويتمتع بأداء قوي وفعال. كما يحتوي على مساحة تخزين داخلية تبلغ 128 جيجابايت، مما يتيح لك حفظ كافة صورك ومقاطع الفيديو المفضلة بشكل آمن وبدون قلق من نفاد المساحة.</p>\r\n\r\n<p>شاشة العرض الكبيرة بحجم 6.5 بوصة توفر تجربة مشاهدة مذهلة وواضحة. كما يتميز الهاتف بتقنية 5G التي تعزز سرعة الاتصال وتمكنك من تنزيل الملفات وتصفح الإنترنت بسرعة فائقة.</p>\r\n\r\n<p>يأتي جالاكسي M14 5G مزودًا بكاميرا خلفية رئيسية بدقة 48 ميجابكسل، حيث يمكنك التقاط صور عالية الدقة وتسجيل فيديوهات ذات جودة استثنائية. كما يحتوي على كاميرا أمامية بدقة 16 ميجابكسل لالتقاط صور سيلفي رائعة وإجراء مكالمات فيديو عالية الجودة.</p>\r\n\r\n<p>بطارية قوية سعتها 5000 ميللي أمبير في الساعة تضمن لك استخدامًا طويلًا دون الحاجة إلى إعادة شحن متكررة. كما يعمل الهاتف بنظام تشغيل أندرويد لضمان سهولة الاستخدام ووجود العديد من التطبيقات المفيدة.</p>', 'سامسونج جالاكسي M14 5G (ICY Silver، ذاكرة وصول عشوائي بحجم 6 جيجابايت، سعة تخزين بحجم 128 جيجابايت) هاتف ذكي مبتكر يدعم شبكات الجيل الخامس. يأتي بلون فضّي رائع وذاكرة واسعة لتخزين الملفات والصور. يوفر أداءً مدهشًا وقوة تحمل استثنائية للمستخدم في تجاربه اليومية.', NULL, NULL, NULL, NULL),
(55, 22, 4, 'Good Luggage Bags', '<p>Good Luggage Bags</p>\r\n\r\n<h1>Good Luggage Bags</h1>\r\n\r\n<p>Luggage bags are an essential travel accessory for anyone who wants to make their journey convenient and hassle-free. A good luggage bag is not only stylish but also durable, spacious, and functional. Here, we present a collection of top-quality luggage bags that meet all your travel needs.</p>\r\n\r\n<h2>Durability</h2>\r\n\r\n<p>Our luggage bags are made from high-quality materials such as polycarbonate, nylon, or polyester. These materials ensure the bags are resistant to wear and tear, making them perfect for frequent travelers or those who tend to pack heavy.</p>\r\n\r\n<h2>Spaciousness</h2>\r\n\r\n<p>The bags come in various sizes and designs to accommodate different packing requirements. Multiple compartments and pockets provide ample space for organizing your belongings efficiently. Whether you&#39;re going on a short weekend trip or a long vacation, our luggage bags have got you covered.</p>\r\n\r\n<h2>Functionality</h2>\r\n\r\n<p>Our luggage bags feature smooth-rolling wheels and telescopic handles for easy maneuverability. They also come with sturdy zippers and TSA-approved locks to keep your belongings secure during transit. Some models even offer expandable compartments for extra storage space.</p>\r\n\r\n<h2>Style</h2>\r\n\r\n<p>We understand that style matters when it comes to travel accessories. Our luggage bags are available in a range of trendy designs and colors, allowing you to express your personal style while traveling in confidence.</p>\r\n\r\n<p>Investing in a good luggage bag is investing in stress-free travel experiences. Choose from our collection of high-quality luggage bags to ensure your next journey is comfortable, organized, and stylish!</p>', 'These good luggage bags are designed to make your travel experience easy and convenient. With durable materials and sturdy construction, they can withstand the rigors of travel. They offer ample storage space and various compartments to keep your belongings organized. Stylishly designed, these bags are perfect for any journey.', NULL, 'Premium Luggage Bags for Travelers | Durable and Stylish Options', 'um Luggage Bags for Travelers | Durable and Stylish Options', 'luggage bags, travel bags, premium luggage, durable luggage, stylish luggage, spacious storage, travel essentials'),
(56, 22, 5, 'حقائب أمتعة جيدة', '<p>حقائب أمتعة جيدة</p>\r\n\r\n<p>حقائب أمتعة جيدة<br />\r\nتعد حقائب الأمتعة من الملحقات الأساسية للسفر لأي شخص يرغب في جعل رحلتك مريحة وخالية من المتاعب. حقيبة الأمتعة الجيدة ليست فقط أنيقة ولكنها أيضًا متينة وواسعة وعملية. هنا ، نقدم مجموعة من حقائب الأمتعة عالية الجودة التي تلبي جميع احتياجات السفر الخاصة بك.</p>\r\n\r\n<p>متانة<br />\r\nحقائب الأمتعة الخاصة بنا مصنوعة من مواد عالية الجودة مثل البولي كربونات أو النايلون أو البوليستر. تضمن هذه المواد أن الأكياس مقاومة للاهتراء ، مما يجعلها مثالية للمسافرين الدائمين أو أولئك الذين يميلون إلى حزم الأشياء الثقيلة.</p>\r\n\r\n<p>اتساع<br />\r\nتأتي الأكياس بأحجام وتصاميم مختلفة لتلائم متطلبات التعبئة المختلفة. توفر الحجرات والجيوب المتعددة مساحة واسعة لتنظيم متعلقاتك بكفاءة. سواء كنت ذاهبًا في رحلة قصيرة في عطلة نهاية الأسبوع أو في إجازة طويلة ، فإن حقائب الأمتعة لدينا توفر لك الحماية.</p>\r\n\r\n<p>وظائف<br />\r\nتتميز حقائب الأمتعة لدينا بعجلات تدور بسلاسة ومقابض تلسكوبية لسهولة المناورة. كما أنها تأتي مع سحابات متينة وأقفال معتمدة من إدارة أمن المواصلات (TSA) للحفاظ على متعلقاتك آمنة أثناء النقل. تقدم بعض الطرز مقصورات قابلة للتوسيع لتوفير مساحة تخزين إضافية.</p>\r\n\r\n<p>أسلوب<br />\r\nنحن نتفهم أن الأسلوب مهم عندما يتعلق الأمر بإكسسوارات السفر. تتوفر حقائب الأمتعة الخاصة بنا بمجموعة من التصاميم والألوان العصرية ، مما يتيح لك التعبير عن أسلوبك الشخصي أثناء السفر بثقة.</p>\r\n\r\n<p>الاستثمار في حقيبة أمتعة جيدة هو الاستثمار في تجارب سفر خالية من الإجهاد. اختر من بين مجموعتنا من حقائب الأمتعة عالية الجودة لضمان أن تكون رحلتك القادمة مريحة ومنظمة وأنيقة!</p>', 'تم تصميم حقائب الأمتعة الجيدة هذه لتجعل تجربة سفرك سهلة ومريحة. بفضل المواد المتينة والبناء القوي ، يمكنها تحمل مصاعب السفر. إنها توفر مساحة تخزين واسعة ومقصورات متنوعة للحفاظ على متعلقاتك منظمة. هذه الحقائب المصممة بأناقة مثالية لأي رحلة.', NULL, NULL, NULL, NULL),
(211, 23, 4, 'Boys Shirt White Color', '<p>Boys Shirt - White Color</p>\r\n\r\n<h1>Boys Shirt - White Color</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A white shirt is a classic and versatile piece of clothing that every boy should have in his wardrobe. This boys shirt in white color is perfect for various occasions, from casual to formal events.</p>\r\n\r\n<p>The shirt is made from high-quality cotton fabric, ensuring comfort and breathability throughout the day. It features a regular fit with a button-down collar and long sleeves, providing a polished look. The white color adds a touch of elegance and sophistication to any outfit.</p>\r\n\r\n<p>This boys shirt can be easily paired with jeans or chinos for a casual look, or with dress pants for more formal occasions such as weddings or family gatherings. It can also be layered under sweaters or jackets during colder seasons.</p>\r\n\r\n<p>The shirt is easy to care for, as it is machine washable and resistant to wrinkles. It maintains its shape and color even after multiple washes.</p>\r\n\r\n<p>Whether your little one needs a stylish outfit for school, a special event, or simply wants to look sharp and put-together, this boys shirt in white color is an excellent choice. It offers both style and comfort, making it a must-have item in his wardrobe.</p>', 'This boys\' shirt in a classic white color is perfect for any occasion. Made from high-quality fabric, it features a comfortable fit and stylish design. It can be easily paired with jeans or shorts, making it a versatile addition to any young boy\'s wardrobe.', NULL, 'Boys Shirt - White Color | Stylish and Comfortable Clothing for Boys', 'Shirt - White Color | Stylish and Comfortable Clothing for Boys\"', 'boys shirt, white color, stylish clothing, comfortable shirts, boys fashion, kids clothing'),
(212, 23, 5, 'قميص ولادي لون ابيض', '<p>وصف قميص ولادي لون أبيض</p>\r\n\r\n<h1>وصف قميص ولادي لون أبيض</h1>\r\n\r\n<p>قميص الأولاد هو قطعة ملابس رائعة تتميز بأناقتها وجودتها. هذا القميص الولادي مصنوع من نسيج عالي الجودة يضمن الراحة والمتانة طوال فترة الارتداء.</p>\r\n\r\n<p>قماش القميص مصنوع من 100٪ قطن ناعم، مما يجعله مثاليًا للاستخدام اليومي. يسهل ارتداء هذا القميص وخلعه بفضل أزرار الإغلاق في المقدمة.</p>\r\n\r\n<p>اللون الأبيض المحايد يجعل هذا القميص سهل التنسيق مع أغلب الملابس. يُعَدُّ مناسبًا لأية مناسبة، سواء كان ذلك لارتداءه في المدرسة، أثناء التجول، في حفلات عائلية، أو في المناسبات الرسمية.</p>\r\n\r\n<p>تصميم هذا القميص يتميز بقصة كلاسيكية وأناقة خالدة. يحتوي على ياقة مستديرة وأكمام طويلة تضفي لمسة من الجاذبية على الإطلالة. يُعَدُّ قميصًا مثاليًا للأولاد الذين يهتمون بالأناقة ويرغبون في الظهور بشكل أنيق وجذاب.</p>\r\n\r\n<p>انعم بإطلالة رائعة لولدك مع هذا القميص الأبيض المدهش! احصل على قطعتك الآن وامنح طفلك إطلالة فريدة تبرز جماله وثقته في نفسه.</p>', 'قميص ولادي لون أبيض هو قطعة ملابس أنيقة وجذابة للأولاد. يتميز بتصميمه الكلاسيكي ولونه الأبيض الجميل، مما يمنح طفلك مظهرًا رائعًا في جميع المناسبات. مصنوع من خامات عالية الجودة لضمان الراحة والدفء طوال الوقت.', NULL, NULL, NULL, NULL),
(61, 24, 4, 'Dresses Cotton Blend Printed One Piece Jumpsuit For Girls', '<p>Dresses Cotton Blend Printed One Piece Jumpsuit For Girls</p>\r\n\r\n<h1>Dresses Cotton Blend Printed One Piece Jumpsuit For Girls</h1>\r\n\r\n<p>This cotton blend printed one-piece jumpsuit is the perfect outfit for girls who want to look stylish and feel comfortable at the same time. Made from a high-quality cotton blend fabric, this jumpsuit offers a soft and breathable feel against the skin, ensuring maximum comfort throughout the day.</p>\r\n\r\n<p>The jumpsuit features a trendy and eye-catching print that adds a fun and playful touch to any girl&#39;s wardrobe. The vibrant colors and patterns make it suitable for various occasions such as casual outings, parties, or even special events. The one-piece design makes dressing up hassle-free and convenient, allowing girls to effortlessly put together a fashionable outfit in no time.</p>\r\n\r\n<p>With its loose fit and adjustable waist tie, this jumpsuit provides a flattering silhouette while offering freedom of movement for active girls. It also has practical side pockets, perfect for storing small essentials or keeping hands warm during chilly days.</p>\r\n\r\n<p>Whether it&#39;s paired with sneakers for a casual look or dressed up with sandals or flats for a more formal occasion, this cotton blend printed one-piece jumpsuit is versatile and can be easily styled according to individual preferences.</p>\r\n\r\n<p>Overall, this jumpsuit combines style, comfort, and convenience in one piece. It is an excellent addition to any girl&#39;s wardrobe that will surely make her stand out with its fashionable design.</p>', 'This adorable one-piece jumpsuit is perfect for fashion-forward girls. Made with a comfortable cotton blend fabric, it features a fun and vibrant print that will surely catch everyone\'s attention. With its easy to wear design, this jumpsuit is the perfect outfit for any casual occasion.', NULL, '\"Shop Stylish and Comfortable Cotton Blend Printed One Piece Jumpsuit for Girls\"', 'Stylish and Comfortable Cotton Blend Printed One Piece Jumpsuit for Girls\"', 'dresses, cotton blend jumpsuit, printed jumpsuit, girls\' clothing, stylish attire, comfortable outfit'),
(62, 24, 5, 'فساتين جمبسوت قطني مطبوع من قطعة واحدة للبنات', '<p>وصف فستان جمبسوت قطني مطبوع من قطعة واحدة للبنات</p>\r\n\r\n<h1>فستان جمبسوت قطني مطبوع من قطعة واحدة للبنات</h1>\r\n\r\n<p>هذا الفستان المميز هو فستان جمبسوت مثالي للفتيات الصغيرات. يتميز بقماشه القطني عالي الجودة، وهو مريح جدًا للارتداء طوال اليوم.</p>\r\n\r\n<p>الفستان مصمم بأسلوب أنيق وعصري، حيث يأتي في تصميم من قطعة واحدة، مما يجعله سهل الارتداء والخلع. كما أنه يضفي مظهرًا رائعًا على الفتاة التي ترتديه.</p>\r\n\r\n<p>القطعة المطبوعة على الفستان تضفي لمسة فرح وحيوية على المظهر العام. يتميز التصميم بألوان زاهية ونقوش مبهجة، مما يضفي لمسة من الأناقة والجاذبية على الفستان.</p>\r\n\r\n<p>بفضل تصميمه المرح والعصري، يعد هذا الفستان المثالي للارتداء في المناسبات الكاجوال أو حتى في الحفلات الخاصة. يمكن تنسيقه مع صندل أو حذاء رياضي لإطلالة عصرية ومريحة.</p>\r\n\r\n<p>لا تترددي في اقتناء هذا الفستان المدهش لابنتك، فهو سيرافقها في جميع مناسباتها وسيلفت الأنظار إليها بأسلوبه الرائع وجودته الممتازة.</p>', 'فساتين جمبسوت قطنية مطبوعة من قطعة واحدة تعتبر خيارًا رائعًا للفتيات. مصنوعة من القطن ذو الجودة العالية، وتأتي بتصاميم مطبوعة جذابة. فهي تمنح الراحة والأناقة في نفس الوقت، مثالية للمناسبات المختلفة وللاستخدام اليومي كذلك.', NULL, NULL, NULL, NULL),
(213, 25, 4, 'Boys Shirt black Color', '<p>Boys Shirt - Black Color</p>\r\n\r\n<h1>Boys Shirt - Black Color</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This black boys shirt is a stylish and versatile piece for any young boy&#39;s wardrobe. Made from high-quality fabric, it offers comfort and durability throughout the day.</p>\r\n\r\n<p>The shirt features a classic design with a pointed collar and long sleeves that can be rolled up for a more casual look. It has a button-down front closure, allowing easy dressing and undressing. The black color adds a touch of sophistication to the overall appearance.</p>\r\n\r\n<p>Perfect for both formal and informal occasions, this shirt can be paired with jeans or dress pants to create various outfits. It can be worn to school, family gatherings, parties, or any other special events.</p>\r\n\r\n<p>The shirt is available in different sizes to ensure the perfect fit for boys of all ages. It is also machine washable, making it convenient for busy parents who want an easy-to-care-for garment.</p>\r\n\r\n<p>Add this black boys shirt to your little one&#39;s wardrobe today and let them showcase their style with confidence!Y</p>', 'This handsome black shirt for boys is the epitome of style and sophistication. Crafted with care, it features a classic collar and button-down design, making it perfect for both formal occasions or casually stylish outfits. Made with high-quality fabric, this shirt ensures comfort and durability without compromising on class.', NULL, '\"Boys Shirt in Black Color - Stylish and Comfortable Shirts for Boys\"', 'Shirt in Black Color - Stylish and Comfortable Shirts for Boys\"', 'boys shirt, black color, stylish shirts, comfortable shirts, boys clothing'),
(214, 25, 5, 'قميص ولادي لون أسود', '<p>وصف قميص ولادي لون أسود</p>\r\n\r\n<h1>قميص ولادي لون أسود</h1>\r\n\r\n<p>هذا القميص الولادي هو قطعة أنيقة وعصرية تتميز بلونها الأسود الجذاب. يعتبر اللون الأسود مناسبًا لجميع المناسبات، سواء كانت رسمية أو غير رسمية، مما يجعل هذا القميص خيارًا مثاليًا لأولادك.</p>\r\n\r\n<p>تم تصنيع هذا القميص باستخدام خامات عالية الجودة، مما يضمن راحة طفلك طوال فترة ارتدائه. كما أنه مصنوع من نسيج ناعم وخفيف يسهل حركة طفلك به بشكل طبيعي.</p>\r\n\r\n<p>تتضمن تفاصيل التصميم على هذا القميص جيب صغير على الصدر، وأزرار للإغلاق على الأمام. يتميز بقصة مريحة وعصرية تناسب جسم طفلك بشكل مثالي.</p>\r\n\r\n<p>هذا القميص المذهل سيضفي لمسة أناقة إلى إطلالة طفلك، سواء ارتديته مع بنطال جينز أو شورت. يمكن استخدامه في المناسبات الخاصة أو في الحياة اليومية.</p>\r\n\r\n<p>احرص على غسل هذا القميص وفقًا لتعليمات الغسيل الموجودة على التسمية، لضمان استدامته وظهوره بشكل جديد لفترة أطول.</p>', 'قميص الأولاد لونه أسود، يتميز بتصميمه العصري والأنيق. مصنوع من خامة عالية الجودة تضمن الراحة والمتانة. يعد هذا القميص خيارًا مثاليًا للإطلالات اليومية أو المناسبات الخاصة، حيث يضفي طابعًا رائعًا وأناقة لإطلالة صغيرك.', NULL, NULL, NULL, NULL),
(65, 26, 4, 'Puma Blue Running Shoes', '<p>Puma Blue Running Shoes</p>\r\n\r\n<h1>Puma Blue Running Shoes</h1>\r\n\r\n<p>The Puma Blue Running Shoes are designed to provide maximum comfort and performance to runners. These shoes are perfect for both casual joggers and professional athletes who require top-notch footwear.</p>\r\n\r\n<p>With a sleek and stylish design, the Puma Blue Running Shoes are not only functional but also fashionable. The blue color adds a vibrant touch to your running gear, making you stand out from the crowd. Whether you&#39;re hitting the track or going for a morning run in the park, these shoes will make you look and feel great.</p>\r\n\r\n<p>These running shoes feature advanced technology that enhances your running experience. The cushioned midsole provides excellent shock absorption, reducing the impact on your feet and joints. This ensures a comfortable stride even during long-distance runs. The breathable upper mesh allows for proper ventilation, keeping your feet cool and dry throughout your workout.</p>\r\n\r\n<p>The rubber outsole offers exceptional traction on various surfaces, giving you stability and preventing slips or falls. The lightweight construction of these shoes makes them easy to wear for extended periods without causing fatigue.</p>\r\n\r\n<p>Invest in the Puma Blue Running Shoes today and take your running game to new heights. Experience unparalleled comfort, style, and performance with these high-quality shoes that are built to last.</p>', 'The Puma Blue Running Shoes are perfect for anyone looking for a combination of style and performance. With their sleek design and comfortable fit, these shoes provide ultimate support during your daily runs. Whether you\'re hitting the pavement or the gym, these blue running shoes will help you reach your fitness goals.', NULL, '\"Shop the Latest Collection of Puma Blue Running Shoes - Lightweight and Stylish\"', 'the Latest Collection of Puma Blue Running Shoes - Lightweight and Stylish\"', '\"Puma blue running shoes, lightweight running shoes, stylish trainers, comfortable athletic footwear, durable sports shoes\"'),
(66, 26, 5, 'حذاء الجري أزرق من بوما', '<p>وصف حذاء الجري أزرق من بوما</p>\r\n\r\n<h1>حذاء الجري أزرق من بوما</h1>\r\n\r\n<p>حذاء الجري الأزرق من بوما هو حذاء رياضي مثالي لعشاق الجري والأنشطة الرياضية. يتميز هذا الحذاء بتصميمه المبتكر والعصري، وهو مثالي للأشخاص الذين يبحثون عن تجربة جديدة وممتعة في ممارسة التمارين الرياضية.</p>\r\n\r\n<p>تتمتع هذه الأحذية بخفة وزنها وسهولة ارتدائها، مما يجعلها مثالية للجري على المسارات أو في صالات الألعاب الرياضية. تأتي بنسخة زرقاء جذابة تضفي لمسة من التفرد على إطلالتك.</p>\r\n\r\n<p>بفضل تقنية التهوية المتقدمة في الحذاء، ستشعر بالراحة والانتعاش أثناء ممارسة التمارين الرياضية. يمتاز هذا الحذاء بنعله المطاطي المرن والمصمم خصيصًا لتوفير ثبات مثلى على الأسطح المختلفة.</p>\r\n\r\n<p>بغض النظر عن مستوى لياقتك البدنية، فإن حذاء الجري الأزرق من بوما سيكون شريكًا مثاليًا لك في رحلة تحسين أدائك والوصول إلى أهدافك الرياضية. احصل على هذه الأحذية الآن وابدأ رحلتك نحو لياقة صحية وأفضل نسخة من نفسك.</p>', 'حذاء الجري الأزرق من بوما هو حذاء رياضي مصمم بشكل أنيق وعصري. يتميز بتقنية تهوية مناسبة لتوفير راحة أثناء الجري. يحتوي على نعل مطاطي مرن لامتصاص الصدمات وتقليل الإجهاد على القدمين. إضافة إلى ذلك، يعزز تشكيلتك باللون الزاهي والتفاصيل المميزة التى تبرز مظهره.', NULL, NULL, NULL, NULL),
(67, 27, 4, 'Men Sun Glasses', '<p>Men Sun Glasses</p>\r\n\r\n<h1>Men Sun Glasses</h1>\r\n\r\n<p>Introducing our stylish and functional collection of men&#39;s sunglasses! These sunglasses are designed to not only protect your eyes from harmful UV rays but also elevate your style quotient.</p>\r\n\r\n<p>Our men&#39;s sun glasses are crafted with precision using high-quality materials, ensuring durability and long-lasting performance. The frames are made from lightweight yet sturdy materials like stainless steel, acetate, or a combination of both. This provides the perfect balance between comfort and strength.</p>\r\n\r\n<p>The lenses of our sunglasses are polarized to reduce glare and enhance clarity. Polarized lenses also offer superior UV protection, safeguarding your eyes from the harmful effects of the sun&#39;s rays. Whether you&#39;re driving, playing sports, or simply enjoying a sunny day at the beach, our sunglasses will provide optimal vision and protection.</p>\r\n\r\n<p>We offer a wide range of styles to suit every man&#39;s taste. From classic aviators to trendy wayfarers, we have something for everyone. Our collection includes various frame colors and lens shades, allowing you to find the perfect pair that matches your personal style.</p>\r\n\r\n<p>In addition to their functionality and style, our men&#39;s sunglasses come with adjustable nose pads and temple tips for a customized fit. This ensures maximum comfort even during extended wear.</p>\r\n\r\n<p>Invest in a pair of our men&#39;s sun glasses today and experience the perfect blend of fashion and function. Protect your eyes while looking effortlessly cool!</p>', 'Stay stylish while protecting your eyes from the sun with these men\'s sunglasses. The sleek frames and color options make these sunglasses a versatile accessory for any outfit or occasion. With UV protection and polarized lenses, these sunglasses offer both fashion and function.', NULL, 'Trendy Men\'s Sunglasses for Ultimate Style and Protection | Shop Now', 'y Men\'s Sunglasses for Ultimate Style and Protection | Shop Now', 'men sunglasses, stylish eyewear for men, UV protection sunglasses, trendy shades for men, aviator sunglasses, wayfarer sunglasses, sporty sunglasses'),
(68, 27, 5, 'نظارات شمسية رجالية', '<p>ابقَ أنيقًا مع حماية عينيك من أشعة الشمس مع هذه النظارات الشمسية الرجالية. تجعل الإطارات الأنيقة وخيارات الألوان من هذه النظارات الشمسية إكسسوارًا متعدد الاستخدامات لأي جماعة أو مناسبة. مع الحماية من الأشعة فوق البنفسجية والعدسات المستقطبة ، توفر هذه النظارات الشمسية كلاً من الموضة والوظيفة.</p>', 'ابقَ أنيقًا مع حماية عينيك من أشعة الشمس مع هذه النظارات الشمسية الرجالية. تجعل الإطارات الأنيقة وخيارات الألوان من هذه النظارات الشمسية إكسسوارًا متعدد الاستخدامات لأي جماعة أو مناسبة. مع الحماية من الأشعة فوق البنفسجية والعدسات المستقطبة ، توفر هذه النظارات الشمسية كلاً من الموضة والوظيفة.', NULL, NULL, NULL, NULL),
(215, 28, 4, 'Medium 25 L Laptop Backpack for Office', '<p>Medium 25 L Laptop Backpack</p>\r\n\r\n<h1>Medium 25 L Laptop Backpack for Office/College/School/Travel (Black, Yellow)</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Medium 25 L Laptop Backpack is a versatile and stylish backpack suitable for various purposes such as office, college, school, and travel. It comes in a sleek design with a combination of black and yellow colors, adding a trendy touch to your everyday look.</p>\r\n\r\n<p>This backpack offers ample storage space with its capacity of 25 liters. It features a dedicated laptop compartment that can comfortably fit laptops up to 15 inches in size, providing secure protection for your valuable device during transportation. The main compartment is spacious enough to accommodate books, notebooks, folders, and other essentials you may need throughout the day.</p>\r\n\r\n<p>The backpack also includes multiple interior pockets and compartments for organizing smaller items like pens, keys, wallets, and mobile devices. Additionally, it has side mesh pockets that are perfect for carrying water bottles or umbrellas.</p>\r\n\r\n<p>Made from durable materials, this backpack ensures long-lasting use. Its padded shoulder straps provide comfort even when carrying heavy loads. The adjustable straps allow you to customize the fit according to your preference.</p>\r\n\r\n<p>Whether you&#39;re heading to the office, attending classes at college or school, or embarking on a weekend getaway, the Medium 25 L Laptop Backpack is designed to meet your needs while keeping your belongings safe and organized.</p>', 'The Medium 25 L Laptop Backpack is crafted for the modern urbanite, perfect for daily commutes or globetrotting adventures. Its sleek black and yellow design adds a touch of style to any outfit, while its spacious interior comfortably accommodates laptops up to 15.6 inches. Ideal for office, college, school, or travel.', NULL, '\"Medium 25 L Laptop Backpack for Office/College/School/Travel - Black/Yellow\"', 'um 25 L Laptop Backpack for Office/College/School/Travel - Black/Yellow\"', '\"laptop backpack, medium size backpack, office backpack, college backpack, school backpack, travel backpack, black and yellow backpack\"'),
(216, 28, 5, 'حقيبة كمبيوتر محمول متوسطة 25 لترًا للمكتب / الكلية / المدرسة / السفر (أسود ، أصفر)', '<p>وصف حقيبة الكمبيوتر المحمول</p>\r\n\r\n<h1>حقيبة كمبيوتر محمول متوسطة 25 لترًا للمكتب / الكلية / المدرسة / السفر (أسود ، أصفر)</h1>\r\n\r\n<p>هذه الحقيبة هي اختيار مثالي لأولئك الذين يحتاجون إلى حمل أجهزة الكمبيوتر المحمولة والأغراض الشخصية بشكل يومي إلى المكتب، الكلية، المدرسة أو أثناء السفر. تأتي بسعة 25 لترًا تقريبًا، مما يعني أنه يمكنها استيعاب جهاز كمبيوتر محمول قد يصل إلى 15 بوصة بشكل آمن وسهل.</p>\r\n\r\n<p>الحقيبة مصنوعة من مادة عالية الجودة وقابلة للمط والتمدد، مما يجعلها متينة ومقاومة للخدوش والتلف. تصميمها الأنيق والعصري يجعلها مناسبة لكلا الجنسين وتتوفر باللونين الأسود والأصفر.</p>\r\n\r\n<p>تحتوي الحقيبة على عدة جيوب وجزء مخصص لحمل الكمبيوتر المحمول بأمان، بالإضافة إلى جيوب أخرى لحفظ المستندات، الهاتف المحمول، قارئ البطاقات، قلم الكتابة، زجاجة الماء وغيرها من الأغراض الشخصية. كما تحتوي على حزام كتف قابل للتعديل لضمان راحة حاملها أثناء التنقل.</p>\r\n\r\n<p>سواء كنت طالبًا في الكلية أو مديرًا في المكتب أو مسافرًا بشكل منتظم، فإن هذه الحقيبة ستكون رفيقًا مثاليًا لك. احصل على حقائب التخزين الأنيقة والعملية التي تحتاجها لتلبية احتياجاتك اليومية.</p>', 'حقيبة كمبيوتر محمول متوسطة الحجم بسعة 25 لترًا، مثالية للإستخدام في المكتب أو الكلية أو المدرسة أو حتى أثناء السفر. تأتي باللونين الأسود والأصفر، وتتميز بتصميم عصري وعملي يضمن سهولة حفظ جهاز الكمبيوتر المحمول وإكسسوراته بشكل آمن ومريح.', NULL, NULL, NULL, NULL),
(76, 29, 5, 'بالاك 250 جم + اصابع السيدات 500 جم + خيار 1 كجم + فليفلة 500 جم + زجاجة قرع 1 قطعة', NULL, 'سلة التسوق تحتوي على بالاك 250 جم واصابع السيدات 500 جم وخيار 1 كجم وفليفلة 500 جم، بالإضافة إلى زجاجة قرع محبوبة بحجم 1 قطعة. هذه المنتجات مثالية لإعداد وجبات شهية ومتنوعة، مع توفير نكهات رائعة وقيم غذائية عالية.', NULL, NULL, NULL, NULL),
(75, 29, 4, 'Palak 250g+Ladies’ Fingers 500g', '<p>Palak 250g+Ladies&rsquo; Fingers 500g+Cucumber 1kg+Capsicum500g+Bottle Gourd 1pc</p>\r\n\r\n<h1>Palak 250g+Ladies&rsquo; Fingers 500g+Cucumber 1kg+Capsicum500g+Bottle Gourd 1pc</h1>\r\n\r\n<p>This package includes a variety of fresh and nutritious vegetables to enhance your meals and provide you with essential nutrients.</p>\r\n\r\n<h2>Palak (Spinach) - 250g</h2>\r\n\r\n<p>Palak, also known as spinach, is a leafy green vegetable that is rich in vitamins A, C, and K. It is low in calories and high in fiber, making it a healthy addition to your diet. Palak can be used in various dishes such as salads, soups, stir-fries, or even as a side dish.</p>\r\n\r\n<h2>Ladies&#39; Fingers (Okra) - 500g</h2>\r\n\r\n<p>Ladies&#39; fingers, also known as okra or bhindi, are green elongated vegetables with a unique texture. They are packed with vitamins A and C and are a good source of dietary fiber. Ladies&#39; fingers can be cooked in numerous ways including stir-frying, saut&eacute;ing, or adding them to curries and stews.</p>\r\n\r\n<h2>Cucumber - 1kg</h2>\r\n\r\n<p>Cucumbers are refreshing vegetables that add crunch and hydration to your meals. They are low in calories and high in water content, making them an excellent choice for staying hydrated. Cucumbers can be sliced and added to salads, used as a refreshing snack, or even blended into smoothies.</p>\r\n\r\n<h2>Capsicum (Bell Pepper) - 500g</h2>\r\n\r\n<p>Capsicums, also known as bell peppers, come in various colors such as red, green, and yellow. They are rich in antioxidants and vitamin C. Capsicums can be used in salads, stir-fries, stuffed with fillings, or roasted for a delicious side dish.</p>\r\n\r\n<h2>Bottle Gourd - 1pc</h2>\r\n\r\n<p>Bottle gourd is a versatile vegetable that is commonly used in Indian cuisine. It is low in calories and high in fiber, making it beneficial for digestion. Bottle gourd can be cooked in curries, soups, or even made into a refreshing juice.</p>\r\n\r\n<p>Overall, this package offers a combination of nutritious vegetables that can be incorporated into various dishes to enhance your culinary experience and promote a healthy lifestyle.VEG</p>', 'This package includes fresh and nutritious vegetables such as 250g of Palak (spinach), 500g of Ladies’ Fingers (okra), 1kg of Cucumber, 500g of Capsicum (bell peppers), and 1 piece of Bottle Gourd. Perfect for cooking a delicious and healthy meal!', NULL, 'Fresh and Nutritious Vegetable Combo Pack - Palak 250g, Ladies\' Fingers 500g, Cucumber 1kg, Capsicum 500g, Bottle Gourd 1pc', 'and Nutritious Vegetable Combo Pack - Palak 250g, Ladies\' Fingers 500g, Cucumber 1kg, Capsicum 500g, Bottle Gourd 1pc', 'Vegetable combo pack, fresh vegetables, nutritious produce, Palak (Spinach), Ladies\' Fingers (Okra), Cucumber, Capsicum, Bottle Gourd'),
(87, 30, 5, 'HOMOZE HX-750 طائرة بدون طيار قابلة لإعادة الشحن يتم التحكم فيها عن بعد مع شفرات غير قابلة للكسر', NULL, NULL, NULL, NULL, NULL, NULL),
(172, 31, 5, 'كرسي ألعاب مريح', '<p>كرسي ألعاب مريح هو كرسي تصميمه خاص للاعبين المحترفين والهواة. يتميز بقوامه المبطن والمريح والمجهز بوسائد قابلة للتعديل لدعم الظهر والرأس. يضمن هذا الكرسي تجربة لعب ممتعة ومثالية دون الشعور بالتعب أثناء احتكاك طويل.</p>', '\"كرسي ألعاب مريح هو كرسي تصميمه خاص للاعبين المحترفين والهواة. يتميز بقوامه المبطن والمريح والمجهز بوسائد قابلة للتعديل لدعم الظهر والرأس. يضمن هذا الكرسي تجربة لعب ممتعة ومثالية دون الشعور بالتعب أثناء احتكاك طويل.\"', NULL, NULL, NULL, NULL),
(171, 31, 4, 'Comfortable Gaming Chair', '<p>Comfortable Gaming Chair</p>\r\n\r\n<h1>Comfortable Gaming Chair</h1>\r\n\r\n<p>A comfortable gaming chair is an essential piece of furniture for any avid gamer. Whether you are a casual player or spend hours immersed in virtual worlds, having a chair that provides comfort and support is crucial for an enjoyable gaming experience.</p>\r\n\r\n<p>This gaming chair is designed with ergonomics in mind, ensuring that your body is properly supported during long gaming sessions. It features a high backrest that supports your spine and neck, reducing the risk of discomfort or strain. The adjustable headrest and lumbar support pillow provide additional comfort and help maintain proper posture.</p>\r\n\r\n<p>The chair is built using high-quality materials such as premium leather or breathable fabric, which not only adds to its durability but also enhances its overall aesthetics. The cushioning is plush and firm, offering a perfect balance between softness and support. The armrests are also adjustable to cater to individual preferences.</p>\r\n\r\n<p>In terms of functionality, this gaming chair offers various features such as a 360-degree swivel function, smooth-rolling casters for easy mobility, and a reclining mechanism that allows you to adjust the backrest angle according to your preference. Some models even come with built-in speakers and vibration motors for an immersive gaming experience.</p>\r\n\r\n<p>Overall, this comfortable gaming chair combines style, functionality, and ergonomic design to provide gamers with the ultimate seating solution. With its superior comfort and support features, it ensures that you can focus on your gameplay without any distractions or discomfort.</p>', 'The comfortable gaming chair is designed to provide the ultimate gaming experience. With its ergonomic design and plush cushioning, it offers exceptional comfort and support during long gaming sessions. The chair also features adjustable armrests, a reclining backrest, and a swivel base for added convenience.', NULL, 'Elevate Your Gaming Experience with a Comfortable Gaming Chair', 'ate Your Gaming Experience with a Comfortable Gaming Chair', 'gaming chair, comfortable chair, ergonomic design, enhanced gameplay, reduced fatigue'),
(83, 32, 4, 'DSLR Camera', '<p>DSLR Camera Description</p>\r\n\r\n<h1>DSLR Camera</h1>\r\n\r\n<p>A DSLR (Digital Single Lens Reflex) camera is a popular type of digital camera that combines the optics and mechanisms of a single-lens reflex camera with a digital imaging sensor. It provides photographers with advanced features, control, and image quality that surpasses many other types of cameras.</p>\r\n\r\n<p>DSLR cameras are known for their versatility and ability to produce high-quality photographs. They offer interchangeable lenses, allowing photographers to choose the best lens for different shooting situations, such as wide-angle lenses for landscapes or telephoto lenses for wildlife photography. This flexibility makes DSLRs suitable for various genres of photography, including portrait, sports, nature, and more.</p>\r\n\r\n<p>One of the key advantages of DSLR cameras is their larger image sensors compared to compact or smartphone cameras. The larger sensor size enables better light sensitivity, improved dynamic range, and reduced noise levels in images. This results in sharper details, vibrant colors, and better low-light performance.</p>\r\n\r\n<p>DSLRs also provide manual control over settings like aperture, shutter speed, and ISO sensitivity. This allows photographers to have full creative control over their images and achieve desired effects such as shallow depth-of-field or freezing fast-moving subjects.</p>\r\n\r\n<p>In addition to still photography capabilities, many DSLR cameras also offer video recording features with high-definition resolution options. They often have external microphone inputs for capturing superior audio quality during video shoots.</p>\r\n\r\n<p>In conclusion, a DSLR camera is a powerful tool that empowers photographers with exceptional image quality, versatility, and creative control. Whether you are a professional photographer or an enthusiast, a DSLR camera can help you capture stunning photos and videos with unmatched precision.</p>', 'A DSLR camera is a powerful tool for photography enthusiasts and professionals. Offering exceptional image quality and versatility, it features interchangeable lenses, manual controls, and advanced shooting modes. With its large sensor and optical viewfinder, it allows users to capture stunning photos with precise detail, depth, and dynamic range.', NULL, '\"Professional DSLR Camera for Stunning Photography | High-Resolution Images\"', 'essional DSLR Camera for Stunning Photography | High-Resolution Images\"', 'DSLR camera, professional photography, high-resolution images, advanced features, autofocus technology, versatile shooting modes'),
(84, 32, 5, 'كاميرا DSLR', '<p>وصف كاميرا DSLR</p>\r\n\r\n<h1>كاميرا DSLR</h1>\r\n\r\n<p>تعد الكاميرا DSLR (الأحادية العدسة ذات العاكس الرقمي) من أنواع الكاميرات المتقدمة التي تستخدم في التصوير الفوتوغرافي والفيديو. تم تصميمها لتلبية احتياجات المصورين المحترفين والهواة المتطورين، حيث تقدم صور عالية الجودة وإمكانيات مذهلة.</p>\r\n\r\n<p>تأتي كاميرا DSLR بعدسات قابلة للتغيير، مما يسمح للمستخدم بضبط التركيز وزواية الرؤية حسب رغبته. كما تحتوي على مستشعر رقمي يسجل الصور بجودة عالية وبدقة عالية أيضًا.</p>\r\n\r\n<p>بفضل نظام المرآة المستخدم في هذه الكاميرات، يُظهَر صورة مباشرة في المنظار البصري، مما يسمح للمصور برؤية الإطار وتركيزه بدقة قبل التقاط الصورة. هذا يجعلها خيارًا مثاليًا للتصوير في ظروف إضاءة صعبة أو عند تصوير سريع.</p>\r\n\r\n<p>تحتوي كاميرات DSLR على العديد من الميزات الإضافية مثل التحكم في الغالق والفتحة والتعرض، ووجود شاشات LCD لعرض الصور الملتقطة. بالإضافة إلى ذلك، فإنها تدعم تسجيل الفيديو بجودة عالية.</p>\r\n\r\n<p>بفضل التكنولوجيا المتقدمة المستخدمة في كاميرات DSLR، يُمكن استخدامها للتصوير في مختلف المجالات مثل التصوير الفوتوغرافي للأشخاص والحفلات والمناظر الطبيعية وغيرها. كما يُمكن استخدامها أيضًا في صناعة الأفلام والإعلانات التجارية.</p>\r\n\r\n<p>باختصار، فإن الكاميرا DSLR هي أداة قوية ومتعددة الاستخدامات تلبي احتياجات المصورين المحترفين والهواة المتطورين. سواء كنت مهتمًا بالتصوير الفوتوغرافي أو صناعة الأفلام، فإن كاميرا DSLR ستكون خيارًا مثاليًا لك للحصول على صور وفيديوهات ذات جودة استثنائية.</p>', 'كاميرا DSLR هي كاميرا رقمية متطورة توفر جودة صور عالية وأداء استثنائي في التصوير. تتميز بعدسات قابلة للتبديل وإعدادات يمكن تخصيصها، مما يتيح للمصور الاستفادة من المزيد من التحكم والإبداع في التقاط الصور. هذه الكاميرا الرائعة تعد خيارًا مثاليًا للهواة والمحترفين في عالم التصوير.', NULL, NULL, NULL, 'اميرا DSLR - أفضل جودة صور وتصوير احترافيMeta description: تسوق كاميرا DSLR عالية الجودة لتحقيق صور مذهلة وتجربة تصوير احترافية. استمتع بأداء ممتاز وخيارات تحكم متقدمة في التصوير. اشترِ الآن واستكشف عالم التصوير الفوتوغرافي!Meta keywords: كاميرا DSLR، تصو');
INSERT INTO `product_description` (`id`, `product_id`, `language_id`, `name`, `description`, `short_description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(217, 33, 5, 'Realme GT 2 (أبيض ، 128 جيجابايت) (8 جيجابايت رام)', '<p>وصف Realme GT 2</p>\r\n\r\n<h1>Realme GT 2 (أبيض ، 128 جيجابايت) (8 جيجابايت رام)</h1>\r\n\r\n<p>Realme GT 2 هو هاتف ذكي متطور يقدم أداءً قويًا وتصميمًا جذابًا. يأتي بلون أبيض رائع وسعة تخزين داخلية تبلغ 128 جيجابايت مع ذاكرة وصول عشوائية بحجم 8 جيجابايت.</p>\r\n\r\n<p>هذا الهاتف مزود بشاشة AMOLED كبيرة بحجم &rlm;6.5 بوصة، تعرض الألوان بشكل حاد وحقيقي، مما يمنحك تجربة مشاهدة رائعة للصور والفيديوهات. كما يحافظ نظام التشغيل Android على سلاسة استخدام الهاتف وتناسق التطبيقات.</p>\r\n\r\n<p>Realme GT 2 مزود بمعالج قوي يضمن تشغيل التطبيقات والألعاب بسرعة فائقة. كما يحتوي على بطارية طويلة الأمد تصل سعتها إلى 5000 مللي أمبير، مما يضمن استخدامًا طويلًا للهاتف دون الحاجة إلى شحن متكرر.</p>\r\n\r\n<p>بالإضافة إلى ذلك، يأتي Realme GT 2 بكاميرا خلفية مزدوجة عالية الدقة، تساعدك في التقاط صور رائعة وتسجيل فيديوهات واضحة. كما يحتوي على كاميرا أمامية بدقة عالية لالتقاط صور سيلفي جميلة.</p>\r\n\r\n<p>بشكل عام، Realme GT 2 هو هاتف ذكي رائع يجمع بين التصميم الأنيق والأداء المذهل. إذا كنت تبحث عن هاتف يوفر سرعة وأداءً قويًا، فإن Realme GT 2 هو الخيار المثالي لك.</p>', 'Realme GT 2 (أبيض ، 128 جيجابايت) (8 جيجابايت رام) هو هاتف ذكي مذهل يأتي بشاشة عالية الدقة ومعالج قوي لتجربة استخدام سلسة. كما يتميز بسعة تخزين كبيرة لحفظ الملفات والصور، وذاكرة رام سريعة لإدارة التطبيقات المتعددة. تصميم أنيق ومواصفات قوية، هذا الهاتف مثالي للأشخاص الذين يبحثون عن الأداء العالي.', NULL, NULL, NULL, NULL),
(218, 33, 4, 'Real Phone 2 (White, 128 GB)  (8 GB RAM)', '<p>Realme GT 2 (White, 128 GB) (8 GB RAM)</p>\r\n\r\n<h1>Realme GT 2 (White, 128 GB) (8 GB RAM)</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Realme GT 2 is a powerful and stylish smartphone that offers a seamless user experience. It comes in an elegant white color with a glossy finish that adds to its premium look and feel.</p>\r\n\r\n<h2>Key Features:</h2>\r\n\r\n<ul>\r\n	<li><strong>Display:</strong> The Realme GT 2 features a stunning AMOLED display with a resolution of Full HD+ for vibrant and immersive visuals.</li>\r\n	<li><strong>Performance:</strong> Powered by an octa-core processor and equipped with 8 GB of RAM, this phone delivers smooth performance and allows for multitasking without any lag.</li>\r\n	<li><strong>Storage:</strong> With a generous internal storage capacity of 128 GB, you can store all your photos, videos, apps, and files without worrying about running out of space.</li>\r\n	<li><strong>Camera:</strong> Capture stunning photos and videos with the high-resolution rear camera setup. The front-facing camera ensures great selfies.</li>\r\n	<li><strong>Battery:</strong> The device is backed by a long-lasting battery that keeps you connected throughout the day. It also supports fast charging technology for quick power-ups.</li>\r\n	<li><strong>User Interface:</strong> Realme UI provides a clean and intuitive interface, offering a user-friendly experience.</li>\r\n</ul>\r\n\r\n<h2>Conclusion:</h2>\r\n\r\n<p>The Realme GT 2 is a feature-packed smartphone that offers impressive performance, ample storage, and an excellent camera setup. Its sleek design and stunning display make it a stylish choice for users who value both aesthetics and functionality. Whether you are a multitasker or an avid photographer, this phone is designed to meet your needs. With its long-lasting battery and fast charging capabilities, you can stay connected on the go without worrying about running out of power. Experience the best of technology with the Realme GT 2.1</p>', 'The Realme GT 2 (White, 128 GB) is a powerful smartphone with a sleek design. It boasts 8 GB RAM and 128 GB of storage, allowing for seamless multitasking and ample room for apps and files. The phone offers a fast and smooth user experience, perfect for gaming or everyday use.', NULL, 'Realme GT 2 (White, 128 GB) - 8 GB RAM | Latest Smartphone with Powerful Performance', 'e GT 2 (White, 128 GB) - 8 GB RAM | Latest Smartphone with Powerful Performance', 'Realme GT 2, White color, 128 GB storage, 8 GB RAM, powerful performance, latest smartphone'),
(220, 34, 5, 'APPLE iPhone 13 (Starlight، 128 جيجا بايت)', '<p>وصف آيفون 13 من أبل</p>\r\n\r\n<h1>آيفون 13 من أبل (ستارلايت، 128 جيجا بايت)</h1>\r\n\r\n<p>آيفون 13 هو هاتف ذكي متطور يأتي من شركة أبل، وهو الإصدار الثالث عشر في سلسلة الآيفون. يأتي باللون ستارلايت وذاكرة تخزين داخلية بحجم 128 جيجابايت.</p>\r\n\r\n<p>هذا الهاتف يقدم تجربة استخدام فائقة بفضل شاشته المقاس 6.1 بوصة Super Retina XDR التي تعرض صورًا وألوانًا حادة وواقعية. كما يحافظ على دقة عالية مع درجة وضوح 2532 &times; 1170 بكسل.</p>\r\n\r\n<p>مزود بمعالج A15 Bionic فائق السرعة، يضمن أداءً قويًا وسلاسة في تشغيل التطبيقات والألعاب. كما يدعم هذا الهاتف تقنية 5G لتجربة اتصال سريعة وموثوقة.</p>\r\n\r\n<p>كاميرا آيفون 13 محسّنة بشكل كبير، حيث تأتي بنظام كاميرات مزدوجة بدقة 12 ميجابكسل تعمل بتقنية التثبيت البصري للصورة. يمكنك التقاط صور رائعة وتسجيل فيديوهات عالية الدقة.</p>\r\n\r\n<p>الآيفون 13 مزود أيضًا ببطارية قوية تدوم طويلًا، وهو مقاوم للغبار والماء بفضل تصنيف IP68. يحتوي على نظام التشغيل iOS 15 الأحدث من أبل، الذي يضم العديد من المزايا والخصائص المحسّنة.</p>\r\n\r\n<p>إذا كُنتَ تبحث عن هاتف ذكي قوي وأنيق، فإن آيفون 13 هو خيار رائع. احصل على أداء مذهل وتجربة مستخدم مميزة مع هذا الهاتف من أبل.</p>', 'آيفون 13 من آبل بلون ستارلايت وسعة تخزين 128 جيجابايت، يأتي بمزايا مذهلة. شاشة Super Retina XDR بحجم 6.1 بوصة، كاميرات احترافية مطورة، أداء قوي بفضل معالج A15 Bionic، وبطارية تدوم طويلاً. مثالي للاستخدام اليومي وتجربة هاتف ذكي مدهشة.', NULL, NULL, NULL, NULL),
(219, 34, 4, 'APPLEL iPhone 13 (Starlight, 128 GB)', '<p>Apple iPhone 13 (Starlight, 128 GB)</p>\r\n\r\n<h1>Apple iPhone 13 (Starlight, 128 GB)</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Apple iPhone 13 in Starlight color with a storage capacity of 128 GB is a sleek and powerful smartphone that offers an exceptional user experience. With its stunning design and advanced features, it sets a new standard for smartphones.</p>\r\n\r\n<h2>Key Features:</h2>\r\n\r\n<ul>\r\n	<li>Display: The iPhone 13 boasts a vibrant and immersive Super Retina XDR display with ProMotion technology, offering a smooth and responsive visual experience.</li>\r\n	<li>Camera: Equipped with a dual-camera system including a wide and ultra-wide lens, the iPhone captures stunning photos and videos with enhanced low-light performance.</li>\r\n	<li>A15 Bionic Chip: Powered by the A15 Bionic chip, this device delivers lightning-fast performance and efficient power management for seamless multitasking.</li>\r\n	<li>iOS: Running on the latest iOS operating system, the iPhone provides a secure and intuitive interface along with access to a wide range of apps through the App Store.</li>\r\n	<li>Battery Life: The iPhone 13 offers all-day battery life, ensuring you can stay connected without worrying about running out of power.</li>\r\n	<li>Face ID: With Face ID technology, your device is protected by advanced facial recognition for secure authentication and Apple Pay transactions.</li>\r\n</ul>\r\n\r\n<h2>Package Includes:</h2>\r\n\r\n<ul>\r\n	<li>Apple iPhone 13 (Starlight, 128 GB)</li>\r\n	<li>USB-C to Lightning Cable</li>\r\n	<li>Documentation</li>\r\n</ul>\r\n\r\n<p>Experience the future of smartphones with the Apple iPhone 13. Get yours today and enjoy a seamless blend of style, performance, and innovation.</p>', 'The iPhone 13 in Starlight color is a high-performance device with 128 GB of storage, offering ample space for your apps, photos, and files. It boasts advanced features, including a powerful A15 Bionic chip, improved camera system, vibrant 6.1-inch Super Retina XDR display, and all-day battery life.', NULL, '\"Buy APPLE iPhone 13 (Starlight, 128 GB) - Latest Model | Best Price\"', 'APPLE iPhone 13 (Starlight, 128 GB) - Latest Model | Best Price\"', '\"APPLE iPhone 13, Starlight color, 128 GB, latest model, best price, cutting-edge technology, powerful performance\"'),
(222, 35, 5, 'MOTOROLA e13 (Aurora Green، 64 GB) (4 GB RAM)', '<p>وصف MOTOROLA e13 (Aurora Green، 64 GB) (4 GB RAM)</p>\r\n\r\n<h1>وصف MOTOROLA e13 (Aurora Green، 64 GB) (4 GB RAM)</h1>\r\n\r\n<p>يعتبر هاتف موتورولا e13 (الأخضر أورورا، سعة تخزين داخلية 64 جيجابايت، ذاكرة وصول عشوائية 4 جيجابايت) من الهواتف الذكية المميزة التي تقدمها شركة موتورولا. يأتي الهاتف بلون أورورا الأخضر الجميل الذي يضفي لمسة من الأناقة والجمال على التصميم.</p>\r\n\r\n<p>بفضل سعة التخزين الداخلية التي تبلغ 64 جيجابايت، يمكن للمستخدم حفظ كافة الملفات والتطبيقات المهمة بسهولة وسلاسة. كما يحتوى على ذاكرة وصول عشوائية بحجم 4 جيجابايت لتوفير أداء سريع وسلس للهاتف أثناء تشغيل التطبيقات المختلفة.</p>\r\n\r\n<p>الهاتف مزود بشاشة عالية الدقة تبلغ حجمها ... (أكمل الوصف بالمعلومات المتعلقة بحجم الشاشة، الكاميرا، وأي مزايا أخرى ترغب في ذكرها).</p>\r\n\r\n<p>بالإضافة إلى ذلك، يأتي هذا الهاتف بنظام تشغيل قوي يسمح للمستخدم بالاستمتاع بتجربة استخدام سلسة وسهلة. كما يحتوي على بطارية قوية تضمن استخدامًا طويلًا دون الحاجة إلى إعادة شحن متكررة.</p>\r\n\r\n<p>بفضل مزيج من التصميم الأنيق والأداء المذهل، فإن هاتف MOTOROLA e13 (Aurora Green، 64 GB) (4 GB RAM) هو خيار رائع لأولئك الذين يبحثون عن هاتف ذكي قوي وموثوق يلبي احتياجاتهم اليومية.</p>', 'محمول موتورولا e13 (باللون الأخضر اللامع، ذاكرة 64 جيجابايت) (رام 4 جيجابايت) يقدم تجربة قوية وفعالة في استخدام التطبيقات والألعاب. يتميز بشاشة كبيرة وواضحة للاستمتاع بالصور والفيديوهات، مع بطارية قوية تدوم طويلًا للاستخدام المكثف.', NULL, NULL, NULL, NULL),
(221, 35, 4, 'MOTOR e13 (Aurora Green, 64 GB)  (4 GB RAM)', '<p>MOTOR e13 (Aurora Green, 64 GB)</p>\r\n\r\n<h1>MOTOR e13 (Aurora Green, 64 GB)</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The MOTOR e13 in Aurora Green is a sleek and stylish smartphone that offers an exceptional user experience. With a storage capacity of 64 GB, you can store all your photos, videos, and files without worrying about running out of space.</p>\r\n\r\n<p>Equipped with 4 GB RAM, the MOTOR e13 ensures smooth multitasking and efficient performance. Whether you&#39;re browsing the web, streaming videos, or playing games, this device can handle it all without any lag.</p>\r\n\r\n<p>The Aurora Green color adds a touch of elegance to the phone&#39;s design. It features a stunning display that brings your content to life with vibrant colors and sharp details. The large screen size provides an immersive viewing experience for movies, games, and more.</p>\r\n\r\n<p>In terms of camera capabilities, the MOTOR e13 boasts a high-quality rear camera that captures stunning photos even in low light conditions. With various shooting modes and features like HDR and panorama, you can unleash your creativity and capture beautiful moments effortlessly.</p>\r\n\r\n<p>Additionally, this smartphone offers advanced security features such as facial recognition and fingerprint sensor for convenient unlocking and enhanced privacy protection.</p>\r\n\r\n<p>The MOTOR e13 also supports fast charging technology to ensure that you spend less time connected to a charger and more time using your phone. Its long-lasting battery allows you to stay connected throughout the day without worrying about running out of power.</p>\r\n\r\n<p>Overall, the MOTOR e13 (Aurora Green, 64 GB) with 4 GB RAM is a powerful and stylish smartphone that offers a seamless user experience, excellent camera performance, and ample storage capacity.</p>', 'The MOTOR e13 in Aurora Green offers a powerful performance with its 4 GB RAM and 64 GB storage capacity. It features a sleek design and reliable functionality, making it an ideal choice for those seeking a stylish and efficient smartphone experience.', NULL, 'MOTOR e13 (Aurora Green, 64 GB) - 4 GB RAM | High-performance Smartphone', 'e13 (Aurora Green, 64 GB) - 4 GB RAM | High-performance Smartphone', 'MOTOR e13, Aurora Green, 64 GB storage, 4 GB RAM, high-performance smartphone'),
(169, 36, 4, 'Infinite Smart 7 HD (Green Apple, 64 GB)  (2 GB RAM)', '<p>Infinite Smart 7 HD (Green Apple, 64 GB)</p>\r\n\r\n<h1>Infinite Smart 7 HD (Green Apple, 64 GB)</h1>\r\n\r\n<p>The Infinite Smart 7 HD is a high-quality smartphone that offers an exceptional user experience. With its stunning Green Apple color and sleek design, it stands out from the crowd. The device comes with a generous internal storage capacity of 64 GB, allowing you to store all your important files, photos, and videos without worrying about running out of space.</p>\r\n\r\n<p>Equipped with 2 GB RAM, the Infinite Smart 7 HD ensures smooth multitasking and efficient performance. Whether you&#39;re browsing the web, playing games, or running multiple apps simultaneously, this smartphone can handle it all with ease.</p>\r\n\r\n<p>The display on the Infinite Smart 7 HD is a high-definition screen that provides vibrant colors and sharp details. Whether you&#39;re watching movies or scrolling through social media feeds, you&#39;ll enjoy an immersive visual experience.</p>\r\n\r\n<p>This smartphone also boasts a powerful camera system that allows you to capture stunning photos and videos. With its advanced features and image stabilization technology, you can take professional-quality shots even in low-light conditions.</p>\r\n\r\n<p>In addition to its impressive hardware specifications, the Infinite Smart 7 HD also runs on the latest operating system, ensuring a smooth and intuitive user interface. It supports various connectivity options including Wi-Fi, Bluetooth, and GPS for seamless communication and navigation.</p>\r\n\r\n<p>Overall, the Infinite Smart 7 HD (Green Apple, 64 GB) is a reliable and feature-packed smartphone that offers excellent performance, ample storage space, and a stunning design. It is perfect for individuals who value both style and functionality in their mobile devices.</p>', 'The Infinite Smart 7 HD is a cutting-edge smartphone that offers stunning performance and an immersive viewing experience with its high-definition display. With a generous storage capacity of 64 GB, you can store all your important files and memories. The device is powered by a powerful 2 GB RAM for smooth multitasking.', NULL, 'Infinite Smart 7 HD (Green Apple, 64 GB) - High-Performance Smartphone with 2 GB RAM', 'ite Smart 7 HD (Green Apple, 64 GB) - High-Performance Smartphone with 2 GB RAM', 'Infinite Smart 7 HD, Green Apple smartphone, 64 GB storage, 2 GB RAM, high-performance device'),
(170, 36, 5, 'Infinite Smart 7 HD (Green Apple, 64 GB)  (2 GB RAM)', '<p>وصف الهاتف الذكي Infinite Smart 7 HD (التفاحة الخضراء، 64 جيجابايت) (2 جيجابايت رام)</p>\r\n\r\n<h1>وصف الهاتف الذكي Infinite Smart 7 HD (التفاحة الخضراء، 64 جيجابايت) (2 جيجابايت رام)</h1>\r\n\r\n<p>إن هاتف Infinite Smart 7 HD هو هاتف ذكي ممتاز يقدم تجربة استخدام مدهشة وأداء قوي. يأتي بلون التفاحة الخضراء المميز وسعة تخزين داخلية كبيرة تبلغ 64 جيجابايت.</p>\r\n\r\n<p>هذا الهاتف مزود بذاكرة وصول عشوائية سعة 2 جيجابايت للسماح بالأداء الممتع والسلاسة في التعامل مع التطبيقات والألعاب.</p>\r\n\r\n<p>شاشة HD لهاتف Infinite Smart 7 تأتي بحجم كبير يبلغ 5.5 بوصة، حقق صورًا واضحة وحقيقية بدقة عالية. يمكن للمستخدمين الاستمتاع بتجربة مشاهدة رائعة للأفلام والصور ومقاطع الفيديو.</p>\r\n\r\n<p>بالإضافة إلى ذلك، يأتي هاتف Infinite Smart 7 HD بكاميرا خلفية عالية الدقة تبلغ 13 ميجابكسل تسمح بالتقاط صور مذهلة وتسجيل فيديوهات عالية الجودة. كما يحتوي على كاميرا أمامية بدقة 5 ميجابكسل لالتقاط صور السيلفي وإجراء مكالمات الفيديو.</p>\r\n\r\n<p>بفضل نظام التشغيل Android المثبت على هذا الهاتف، يمكن للمستخدمين الوصول إلى الملايين من التطبيقات المختلفة في متجر Google Play. كما يدعم هذا الهاتف اتصال Wi-Fi و Bluetooth، بالإضافة إلى منفذ USB لنقل البيانات.</p>\r\n\r\n<p>بإجمالي سعر ذاكرة التخزين الداخلية الكبيرة والأداء القوي، يعتبر هاتف Infinite Smart 7 HD (التفاحة الخضراء، 64 جيجابايت) (2 جيجابايت رام) خيارًا ممتازًا لأولئك الذين يبحثون عن هاتف ذكي عالي الجودة.</p>', 'إنفنيت سمارت 7 اتش دي (جرين ابل، ٦٤ جيجابايت) (٢ جيجابايت رام) هاتف ذكي يعمل بنظام اندرويد. يأتي بشاشة عالية الدقة وذاكرة تخزين كبيرة لحفظ الملفات. يوفر أداء سريع وسلس وقوة معالج قوية. تصميم فائق الأناقة وطويل الأمد.', NULL, NULL, NULL, NULL),
(99, 37, 4, 'KPPO Reno8T 5G (Sunrise Gold, 128 GB)  (8 GB RAM)', '<p>KPPO Reno8T 5G (Sunrise Gold, 128 GB) (8 GB RAM)</p>\r\n\r\n<h1>KPPO Reno8T 5G (Sunrise Gold, 128 GB) (8 GB RAM)</h1>\r\n\r\n<p>The KPPO Reno8T 5G is a stylish and powerful smartphone that offers an exceptional user experience. It comes in a stunning Sunrise Gold color, which adds a touch of elegance to its design. With a storage capacity of 128 GB, you can store all your photos, videos, and files without worrying about running out of space.</p>\r\n\r\n<p>This smartphone is equipped with 8 GB RAM, ensuring smooth multitasking and seamless performance. Whether you&#39;re browsing the internet, playing graphic-intensive games, or running multiple apps simultaneously, the KPPO Reno8T can handle it all without any lag or slowdowns.</p>\r\n\r\n<p>One of the standout features of this phone is its 5G connectivity. With support for the latest generation network technology, you can enjoy ultra-fast download and upload speeds, enabling you to stream high-quality videos, video chat with friends and family without interruptions.</p>\r\n\r\n<p>The KPPO Reno8T also boasts a large display that measures X inches diagonally. The Full HD+ resolution ensures vibrant colors and sharp details while watching movies or playing games.</p>\r\n\r\n<p>In terms of photography capabilities, this smartphone doesn&#39;t disappoint. It features a high-resolution X MP primary camera along with additional lenses for wide-angle shots and depth sensing. Capture stunning photos in various lighting conditions and take professional-looking portraits with ease.</p>\r\n\r\n<p>In conclusion, the KPPO Reno8T 5G is a feature-packed smartphone that combines style with performance. Its ample storage capacity, powerful RAM configuration, fast connectivity options, and impressive camera system make it an excellent choice for tech enthusiasts and photography enthusiasts alike.</p>', 'The KPPO Reno8T 5G in Sunrise Gold offers a stunning display and powerful performance. With 128GB of storage and 8GB RAM, it allows for seamless multitasking. Equipped with 5G connectivity, this smartphone ensures ultra-fast browsing and downloading speeds. Its sleek design adds a touch of elegance to your everyday mobile experience.', NULL, '\"Buy KPPO Reno8T 5G (Sunrise Gold, 128 GB) with 8 GB RAM Online - Best Price\"', 'KPPO Reno8T 5G (Sunrise Gold, 128 GB) with 8 GB RAM Online - Best Price\"', '\"KPPO Reno8T, Sunrise Gold, 128 GB, 8 GB RAM, smartphone, buy online, best price, 5G connectivity\"'),
(100, 37, 5, 'KPPO Reno8T 5G (Sunrise Gold ، 128 جيجابايت) (8 جيجابايت من ذاكرة الوصول العشوائي)', '<p>وصف KPPO Reno8T 5G (Sunrise Gold ، 128 جيجابايت) (8 جيجابايت من ذاكرة الوصول العشوائي)</p>\r\n\r\n<h1>KPPO Reno8T 5G (Sunrise Gold ، 128 جيجابايت) (8 جيجابايت من ذاكرة الوصول العشوائي)</h1>\r\n\r\n<p>هاتف KPPO Reno8T 5G هو هاتف ذكي مبتكر يدعم تقنية الجيل الخامس والذي يأتي بلون Sunrise Gold المذهل. يحتوي على سعة تخزين داخلية تبلغ 128 جيجابايت، مما يمنحك مساحة كافية لتخزين كافة صورك ومقاطع الفيديو والتطبيقات المفضلة لديك.</p>\r\n\r\n<p>بالإضافة إلى ذلك، فإن هذا الهاتف مزود بذاكرة وصول عشوائية بحجم 8 جيجابايت، مما يسهل عليه تشغيل التطبيقات والألعاب بسلاسة وبدون تأخير. ستتمكن من تجربة أداء رائع وسرعة استجابة فائقة مع هذا الهاتف.</p>\r\n\r\n<p>يتميز KPPO Reno8T 5G بشاشة عالية الدقة وحجم 6.5 بوصة، مما يوفر لك تجربة مشاهدة مذهلة للصور ومقاطع الفيديو. كما يأتي الهاتف بكاميرا خلفية رباعية بدقة 64 ميجابكسل، مما يسمح لك بالتقاط صور استثنائية ذات جودة عالية.</p>\r\n\r\n<p>لا يقتصر دعم الاتصال في هذا الهاتف على تقنية 5G فحسب، بل يتضمن أيضًا اتصال WiFi وبلوتوث و NFC. ستستطيع التواصل مع الآخرين ونقل الملفات بسهولة باستخدام هذه التقنيات المتطورة.</p>\r\n\r\n<p>إذا كنت تبحث عن هاتف ذكي يجمع بين أداء قوي وسعة تخزين كبيرة وكاميرا رائعة، فإن KPPO Reno8T 5G هو الخيار المثالي لك. احصل على هذا الهاتف الرائع واستمتع بتجربة استخدام متمي</p>', 'KPPO Reno8T 5G هاتف ذكي يدعم الجيل الخامس بلون Sunrise Gold وسعة تخزين 128 جيجابايت. يتميز بذاكرة وصول عشوائية بحجم 8 جيجابايت، مما يوفر أداءً سريعًا وسلاسة في التعامل مع التطبيقات. هاتف عالي الأداء لتلبية احتیاجاتك الیومیة.', NULL, 'Reno8T 5G (ذهبي شروق، 128 جيجابايت) (8 جيجابايت رام) - هاتف متطور بتقنية الجيل الخامس', 'T 5G (ذهبي شروق، 128 جيجابايت) (8 جيجابايت رام) - هاتف متطور بتقنية الجيل الخامس', 'KPPO Reno8T 5G، هاتف ذكي، ذهبي شروق، تخزين 128 جيجابايت، رام 8 جيجابايت، تكنولوجية الجيل الخامس'),
(223, 38, 4, 'Baby Girls Midi/Knee Length Party Dress  (White, Full Sleeve)', '<p>Baby Girls Midi/Knee Length Party Dress</p>\r\n\r\n<h1>Baby Girls Midi/Knee Length Party Dress</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This adorable Baby Girls Midi/Knee Length Party Dress in white is perfect for any special occasion or party. Made with high-quality materials, this dress ensures utmost comfort and style for your little one.</p>\r\n\r\n<p>The dress features a knee-length design, providing a cute and elegant look. The full sleeves add an extra touch of sophistication while keeping your baby girl warm during cooler weather. The white color adds purity and innocence to the overall appearance of the dress.</p>\r\n\r\n<p>With its midi length, this party dress allows easy movement and play for your active baby girl. The soft fabric ensures a gentle feel against her delicate skin, preventing any discomfort or irritation.</p>\r\n\r\n<p>Whether it&#39;s a birthday celebration, wedding event, or any other special gathering, this dress will make your baby girl stand out from the crowd. Its timeless design and classic white color make it versatile for various occasions.</p>\r\n\r\n<p>Available in different sizes, you can choose the perfect fit for your little princess. Pair it with cute accessories like a headband or matching shoes to complete the adorable look.</p>\r\n\r\n<p>Order now and make your baby girl shine in this beautiful Baby Girls Midi/Knee Length Party Dress!</p>', 'This adorable baby girl\'s party dress is the perfect combination of elegance and comfort. Made with a knee-length style and full sleeves, it features a stunning white color that will make your little one stand out. Suitable for any special occasion, this midi dress is sure to make her feel like a princess.', NULL, '\"Baby Girls Midi/Knee Length Party Dress - White, Full Sleeve | Perfect Outfit for Special Occasions\"', 'Girls Midi/Knee Length Party Dress - White, Full Sleeve | Perfect Outfit for Special Occasions\"', 'Baby girls party dress, midi length dress, knee length dress, white party dress, full sleeve dress, special occasion outfit'),
(224, 38, 5, 'فستان حفلات متوسط ​​الطول / الركبة للفتيات الصغيرات (أبيض ، كم طويل)', '<p>فستان حفلات متوسط ​​الطول / الركبة للفتيات الصغيرات (أبيض ، كم طويل)</p>\r\n\r\n<h1>فستان حفلات متوسط ​​الطول / الركبة للفتيات الصغيرات (أبيض ، كم طويل)</h1>\r\n\r\n<p>هذا الفستان هو اختيار رائع للفتيات الصغيرات في حفلات المناسبات والحفلات. يأتي بقصة متوسطة الطول تصل إلى مستوى الركبة، وهذا يجعله مناسبًا للاحتفال بأناقة وراحة.</p>\r\n\r\n<p>مصنوع من قماش عالي الجودة، فإن فستان الحفلات هذا يضمن راحة فائقة أثناء ارتدائه. يسمح التصميم بحرية الحركة ولا يقيّد حركة الطفلة أثناء لعبها أو رقصها.</p>\r\n\r\n<p>اللون الأبيض المشع يضيف لمسة من الأناقة والجمال إلى هذا الفستان. يتميز بأكمام طويلة تضفي لمسة أنثوية رقيقة، كما يعزز التصميم البسيط جاذبية الفستان.</p>\r\n\r\n<p>هذا الفستان مثالي للحفلات المسائية والحفلات الرسمية، حيث يتناسب مع أجواء الاحتفال ويركز على جمال الطفلة. ستشعر بالثقة والرشاقة عند ارتداء هذا الفستان المدهش.</p>\r\n\r\n<p>لا تدعي فرصة اقتناء هذا الفستان تضيع! استعدي لإبراز جمال صغيرتك في أي مناسبة خاصة بهذه التحفة المذهلة.</p>', 'هذا الفستان المتوسط ​​الطول / الركبة مصمم خصيصًا للفتيات الصغيرات. يأتي بلون أبيض رائع ويتميز بأكمام طويلة. إنه فستان مثالي لحفلات الأعياد والمناسبات الرسمية، يعكس جمال وجاذبية صغيرتك في كل حفلة تحضرها.', NULL, NULL, NULL, NULL),
(103, 39, 4, 'baby girl dress t shirt', '<p>Baby Girl Dress T-Shirt</p>\r\n\r\n<h1>Baby Girl Dress T-Shirt</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Introducing our adorable baby girl dress t-shirt! This charming and comfortable dress is perfect for your little one&#39;s everyday wear or special occasions.</p>\r\n\r\n<p>Made from high-quality, soft cotton fabric, this dress t-shirt is gentle on your baby&#39;s delicate skin. It features a cute and vibrant design with playful patterns and colors that will surely catch everyone&#39;s attention.</p>\r\n\r\n<p>The dress comes with short sleeves, providing ease of movement for your active baby girl. The loose fit ensures maximum comfort, allowing her to play and explore without any restrictions.</p>\r\n\r\n<p>With its convenient pull-on style, dressing up your little princess has never been easier. The dress t-shirt also includes snap buttons at the back for quick and hassle-free diaper changes.</p>\r\n\r\n<p>This versatile piece can be paired with leggings or worn on its own during warmer seasons. It is suitable for both casual outings and formal events, making it a must-have addition to your baby girl&#39;s wardrobe.</p>\r\n\r\n<p>Care instructions: Machine washable for easy cleaning. Please follow the recommended washing instructions to maintain the quality and longevity of this lovely dress t-shirt.</p>', '\"Adorable baby girl dress t-shirt with delicate floral prints, perfect for any occasion. Made with soft and breathable fabric to ensure the utmost comfort for your little one. This charming piece features a cute bow detail on the collar, making it an absolute must-have in your baby girl\'s wardrobe.\"', NULL, '\"Adorable Baby Girl Dress T-Shirt | Stylish and Comfortable Clothing for Infants\"', 'able Baby Girl Dress T-Shirt | Stylish and Comfortable Clothing for Infants\"', 'baby girl dress t-shirt, infant clothing, stylish baby clothes, comfortable baby dress, cute toddler outfit'),
(104, 39, 5, 'طفلة اللباس تي شيرت', NULL, 'تي شيرت طفلة اللباس هو قطعة ملابس جميلة وأنيقة مصممة خصيصًا للبنات الصغيرات. يتميز بتصميمه المرح والألوان الزاهية، مع تفاصيل رائعة مثل الرسومات والشخصيات المحببة. يضفي هذا التي شيرت أناقة فريدة على إطلالة الطفلة ويضمن راحتها طوال اليوم.', NULL, NULL, NULL, NULL),
(105, 40, 4, 'Baby Boys & Baby Girls Solid Hooded Neck White Sweater', '<p>Baby Sweater Description</p>\r\n\r\n<h1>Baby Boys &amp; Baby Girls Solid Hooded Neck White Sweater</h1>\r\n\r\n<p>This adorable baby sweater is perfect for both baby boys and baby girls. Made from high-quality materials, it provides warmth and comfort to your little one during colder seasons.</p>\r\n\r\n<p>The sweater features a solid white color, making it versatile and easy to match with any outfit. The hooded neck adds an extra layer of coziness and protection against chilly winds. It also adds a touch of cuteness to your baby&#39;s look.</p>\r\n\r\n<p>The design of this sweater is simple yet stylish, suitable for everyday wear or special occasions. The soft fabric ensures gentle contact with your baby&#39;s delicate skin, preventing any irritations or discomfort.</p>\r\n\r\n<p>With its durable construction, this sweater is made to withstand the active movements of babies. It is easy to put on and take off, thanks to the convenient buttons or snaps closure on the front.</p>\r\n\r\n<p>Whether you&#39;re dressing up your little one for a family gathering or going out for a stroll in the park, this hooded white sweater will keep them warm and fashionable. It also makes a great gift for baby showers or birthdays.</p>\r\n\r\n<p>Invest in this Baby Boys &amp; Baby Girls Solid Hooded Neck White Sweater today and ensure your little bundle of joy stays cozy and stylish throughout the year!</p>', 'This adorable baby sweater features a hooded neck design and comes in a stylish solid white color. Made with soft and cozy material, it provides warmth and comfort for your little one. Perfect for both baby boys and baby girls, this sweater is a must-have addition to their winter wardrobe.', NULL, '\"Shop the Cozy Baby Boys & Baby Girls Solid Hooded Neck White Sweater\"', 'the Cozy Baby Boys & Baby Girls Solid Hooded Neck White Sweater\"', 'baby boys sweater, baby girls sweater, solid white sweater, hooded neck sweater, cozy baby clothes'),
(106, 40, 5, 'كنزة بيضاء للرضع والأولاد والبنات', '<p>وصف كنزة بيضاء للرضع والأولاد والبنات</p>\r\n\r\n<h1>وصف كنزة بيضاء للرضع والأولاد والبنات</h1>\r\n\r\n<p>تُعد الكنزة البيضاء المثالية خيارًا رائعًا للرضع والأولاد والبنات على حد سواء. تتميز هذه الكنزة بتصميمها الجذاب ولونها الأبيض الجميل، مما يجعلها قطعة أساسية في خزانة ملابس طفلك.</p>\r\n\r\n<p>تتميز هذه الكنزة بجودتها العالية، حيث تصنع من مواد ناعمة وقابلة للتمدد، مثل القطن أو الصوف، لتوفير أقصى درجات الراحة لطفلك. كما تسمح هذه المواد بامتصاص التعرق وإبقاء جسده جافًا طوال فترة ارتدائها.</p>\r\n\r\n<p>تأتي الكنزة بتصميم مرن وملائم لجسم الطفل، مع أكمام طويلة وياقة عالية تحافظ على دفء جسده في الأيام الباردة. يمكن ارتداء هذه الكنزة في المناسبات الرسمية أو اليومية، حيث يُضفي لونها الأبيض المشرق لمسة من الأناقة على إطلالة طفلك.</p>\r\n\r\n<p>بفضل تصميمها المتعدد الجنسيات، يُعتبر هذا الملابس مناسبًا للرضع والأولاد والبنات. كما يُعد هذا التصميم مثاليًا للاستخدام كقطعة ملابس خارجية خفيفة أو قطعة أساسية تحت سترات أخرى في فصول الشتاء.</p>\r\n\r\n<p>بإضافة كنزة بيضاء إلى خزانة ملابس طفلك، ستحصل على قطعة رائعة تجعل طفلك يظهر بأناقة ويرتاح في نفس الوقت. اختر هذه الكنزة البيضاء لتكملة إطلالة طفلك بأناقة وأن تكون قطعة أساسية في مجموعته الملابس.</p>', 'كنزة بيضاء للرضع والأولاد والبنات هي قطعة ملابس عصرية ومريحة. صُنعت من خامات عالية الجودة لا تهيج بشرة الطفل، مما يجعلها مثالية للاستخدام اليومي. تتميز بقَصَّة أنيقة وأسلوب عصري يضفي لمسة جذابة على إطلالة طفلك، وتناسب جميع الأوقات والمناسبات.', NULL, NULL, NULL, NULL),
(107, 41, 4, 'Luxury Shopping Bag For Women', '<p>Luxury Shopping Bag For Women</p>\r\n\r\n<h1>Luxury Shopping Bag For Women</h1>\r\n\r\n<p>A luxury shopping bag for women is an exquisite and stylish accessory designed to enhance the shopping experience of discerning ladies. Crafted with utmost attention to detail, these bags are made from high-quality materials that exude elegance and sophistication.</p>\r\n\r\n<p>The design of a luxury shopping bag for women is often sleek and timeless, incorporating elements such as fine leather, intricate stitching, and luxurious hardware accents. These bags come in various shapes and sizes to cater to different preferences, whether it be a spacious tote or a compact clutch.</p>\r\n\r\n<p>What sets luxury shopping bags apart is not just their aesthetic appeal but also their functionality. They feature multiple compartments and pockets to keep belongings organized while on the go. Some bags even come with detachable straps or handles for versatility in carrying options.</p>\r\n\r\n<p>These bags are meticulously crafted by renowned fashion houses known for their expertise in creating luxurious accessories. The attention to detail extends to every aspect of the bag, including its lining, zippers, and closures.</p>\r\n\r\n<p>A luxury shopping bag for women serves as more than just a practical item; it is a statement piece that complements any outfit and showcases one&#39;s refined taste. Whether used for everyday errands or special occasions, these bags elevate the shopping experience while adding a touch of glamour to any ensemble.</p>', 'Introducing our exquisite luxury shopping bag for women, crafted with the finest materials and impeccable attention to detail. This elegant accessory embodies sophistication, featuring a spacious interior to accommodate all your essentials while making a statement of opulence. Elevate your shopping experience with this luxurious blend of style and practicality.', NULL, '\"Elegant and Stylish Luxury Shopping Bag for Women | Shop Now\"', 'ant and Stylish Luxury Shopping Bag for Women | Shop Now\"', 'luxury shopping bag, women\'s handbag, stylish tote bag, designer shopping bag, high-end fashion accessory'),
(108, 41, 5, 'حقيبة تسوق فاخرة للنساء', '<p>وصف حقيبة تسوق فاخرة للنساء</p>\r\n\r\n<h1>حقيبة تسوق فاخرة للنساء</h1>\r\n\r\n<p>تعتبر حقيبة التسوق الفاخرة للنساء من أهم الإكسسوارات التي تضفي لمسة أناقة ورفاهية على إطلالة المرأة. تجمع هذه الحقيبة بين الجمال والعملية، مما يجعلها رفيقًا مثاليًا لأغراض التسوق اليومية.</p>\r\n\r\n<p>تصميم هذه الحقائب يتميز بالدقة والجودة العالية في التفصيل، حيث يتم اختيار أجود أنواع المواد مثل الجلد الطبيعي أو المخمل أو النسيج المتين لإضافة طابع فخامة وأناقة. كما تأتي بأشكال وأحجام مختلفة لتناسب احتياجات كل امرأة.</p>\r\n\r\n<p>تتميز الحقيبة بعدة مميزات تجعلها الخيار المثالي للنساء، فهي تحتوي على جيوب وأقسام مختلفة لتنظيم أغراض التسوق بشكل منظم وسهولة الوصول إليها. كما تحتوي على مقابض قوية وحزام كتف قابل للتعديل لراحة حملها وسهولة استخدامها.</p>\r\n\r\n<p>إضافةً إلى ذلك، يأتي التصميم بأناقة فريدة وألوان جذابة تناسب جميع الأذواق والإطلالات. ستكون هذه الحقيبة رفيقًا مثاليًا في المناسبات الخاصة أو في نزهاتك الشخصية.</p>\r\n\r\n<p>فلا شك أن حقائب التسوق الفاخرة للنساء هي استثمار رائع يستحق الانتباه. فهذه الحقائب لن تضفِ جمالًا فحسب، بل ستوفر أيضًا الراحة والعملية في حمل مشترياتك اليومية بأناقة لا مثيل لها.</p>', 'حقيبة تسوق فاخرة للنساء هي قطعة أنيقة وفريدة من نوعها تعكس الذوق الرفيع والأناقة. مصنوعة من مواد عالية الجودة بتصميم جذاب ومتطور، تأتي هذه الحقيبة بحجم واسع يسهل حملها أثناء التسوق، بالإضافة إلى مساحات داخلية واسعة لتخزين المشتريات بأمان وسهولة.', NULL, NULL, NULL, NULL),
(109, 42, 4, 'Men fashion with leather bag', '<p>Men&#39;s Fashion with Leather Bag</p>\r\n\r\n<h1>Men&#39;s Fashion with Leather Bag</h1>\r\n\r\n<p>When it comes to men&#39;s fashion, a leather bag is an essential accessory that adds style and functionality to any outfit. The timeless appeal of leather combined with its durability makes it a perfect choice for men who value both fashion and practicality.</p>\r\n\r\n<p>A leather bag can elevate any look, whether it&#39;s a casual or formal attire. It effortlessly exudes a sense of sophistication and class, making it suitable for various occasions. Whether you&#39;re heading to the office, going on a weekend getaway, or simply running errands around town, a leather bag is a versatile companion that complements your overall style.</p>\r\n\r\n<p>In terms of design, there are numerous options available in the market to suit different preferences and needs. From classic briefcases to messenger bags and backpacks, there is a wide range of styles to choose from. Additionally, leather bags come in various colors such as black, brown, tan, or even bold shades like burgundy or navy blue, allowing you to find the perfect match for your personal taste.</p>\r\n\r\n<p>Besides being fashionable accessories, leather bags also provide functionality and convenience. They offer ample space to carry essentials such as laptops, documents, wallets, phones, and more. The sturdy construction ensures that your belongings remain safe and secure while on the go.</p>\r\n\r\n<p>In conclusion, incorporating a leather bag into your men&#39;s fashion ensemble not only enhances your overall appearance but also provides practicality and versatility. Its timeless appeal combined with its durability makes it a must-have accessory for any modern man.</p>', 'Upgrade your style with our men\'s leather bag. Made from high-quality leather, it adds sophistication to your ensemble and offers plenty of space for all your essentials. Whether you\'re heading to the office or out for a night on the town, this bag is the perfect accessory for any occasion.', NULL, '\"Shop Stylish Men\'s Leather Bags for Fashionable and Functional Accessories\"', 'Stylish Men\'s Leather Bags for Fashionable and Functional Accessories\"', 'men fashion, leather bags, stylish accessories, fashionable bags, functional bags'),
(110, 42, 5, 'لكن الموضة مع حقيبة جلدية', '<p>وصف حقيبة جلدية مع الموضة</p>\r\n\r\n<h1>لكن الموضة مع حقيبة جلدية</h1>\r\n\r\n<p>تُعد الحقائب الجلدية إكسسوارًا أساسيًا في عالم الموضة، فهي تضفي لمسة أناقة وجمال على إطلالتك. تتميز حقائب الجلد بأنها متينة وعملية وتستطيع أن تخدمك لفترة طويلة من الزمن، كما أنها تتحسّن مع استخدامك لها.</p>\r\n\r\n<p>إذا كنت ترغب في ارتداء ملابس رائجة وأنيقة، فإن حقيبة جلدية ستكون خيارًا مثاليًا. يُعتبر التصميم الكلاسيكي والأصيل لحقائب الجلد مناسبًا لأغلب المظهرات، سواء كان ذلك في المؤتمرات الرسمية أو في المشاركات الاجتماعية الأخرى. بفضل تنوع ألوان الجلود المتاحة، يُمكنك اختيار اللون الذي يتناسب مع تفضيلاتك والمظهر العام.</p>\r\n\r\n<p>بالإضافة إلى ذلك، فإن حقائب الجلد تُظهر شخصيتك وذوقك في الموضة. يمكن أن تساعد حقيبة جلدية على إبراز هويتك وإطلاق بريقٍ خاص على إطلالتك. ستشعر بالثقة والأناقة عند حمل هذه الحقيبة، مما سيؤثر إيجابًا على ثقتك بالنفس وطريقة تفاعل الآخرين معك.</p>\r\n\r\n<p>لا تُستغرب إذا كان لديك حساسية للاستثمار في حقيبة جلدية فائقة الجودة، فهذه الحقائب قطع استثمارية رائعة. باستدامتها وجودتها، سوف تظل قطعًا أساسية في خزانة ملابسك لسنوات قادمة. احرص على الاهتمام بالجلد وتنظيفه وترطيبه بانتظام للحفاظ على مظهرها الأصيل.</p>', 'لكن الموضة مع حقيبة جلدية هي تحفة رائعة تجمع بين الأناقة والعصرية. تتميز هذه الحقيبة بتصميمها الراقي وجودتها العالية من الجلد، ما يجعلها اختيارًا مثاليًا لإضافة لمسة فخامة إلى أي إطلالة. ستكون رفيقًا مثاليًا في كل مناسباتك!', NULL, NULL, NULL, NULL),
(225, 43, 4, 'Medium 25 L Laptop Backpack for Office/College/Travel  (Black, Yellow)', '<p>Medium Laptop Backpack</p>\r\n\r\n<h1>Medium 25 L Laptop Backpack</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Medium 25 L Laptop Backpack is a versatile and stylish backpack suitable for office, college, and travel purposes. With its sleek design and durable construction, it offers both functionality and comfort.</p>\r\n\r\n<h2>Features:</h2>\r\n\r\n<ul>\r\n	<li>Spacious main compartment with a padded laptop sleeve to securely hold laptops up to 15 inches in size.</li>\r\n	<li>Multiple interior pockets for organizing your belongings such as notebooks, textbooks, pens, cables, and more.</li>\r\n	<li>Front zippered pocket for quick access to essentials like your phone, wallet or keys.</li>\r\n	<li>Ergonomically designed shoulder straps with padding for comfortable carrying even when the backpack is fully loaded.</li>\r\n	<li>Durable polyester material that is water-resistant to protect your belongings from light rain or accidental spills.</li>\r\n	<li>Top handle for easy grabbing or hanging the backpack when not in use.</li>\r\n	<li>Available in a classic black color with vibrant yellow accents for a modern touch.</li>\r\n</ul>\r\n\r\n<h2>Specifications:</h2>\r\n\r\n<ul>\r\n	<li>Capacity: 25 liters</li>\r\n	<li>Fits laptops up to: 15 inches</li>\r\n</ul>\r\n\r\n<p>The Medium Laptop Backpack is perfect for professionals, students, or frequent travelers who need a reliable and stylish backpack to carry their essentials. Its spacious compartments, comfortable straps, and durable construction make it a reliable companion for your daily commute or weekend getaways.</p>', 'The Medium 25 L Laptop Backpack is a versatile and functional backpack ideal for office, college, and travel. With its sleek black and yellow design, it offers ample storage space for your laptop, books, and other essentials. It provides comfort with its padded shoulder straps and is perfect for everyday use.', NULL, '\"Medium 25 L Laptop Backpack for Office/College/Travel (Black, Yellow) - Stylish and Durable\"', 'um 25 L Laptop Backpack for Office/College/Travel (Black, Yellow) - Stylish and Durable\"', 'laptop backpack, medium size backpack, office backpack, college backpack, travel backpack, black and yellow backpack'),
(226, 43, 5, 'حقيبة كمبيوتر محمول متوسطة 25 لترًا للمكتب / الكلية / السفر (أسود ، أصفر)', '<p>وصف حقيبة الكمبيوتر المحمول</p>\r\n\r\n<h1>حقيبة كمبيوتر محمول متوسطة 25 لترًا للمكتب / الكلية / السفر (أسود ، أصفر)</h1>\r\n\r\n<p>تعد حقيبة الكمبيوتر المحمول هذه خيارًا مثاليًا للأشخاص الذين يعملون في المكاتب أو يدرسون في الجامعة أو يسافرون بشكل منتظم. تأتي هذه الحقيبة بحجم متوسط ​​، بحجم 25 لترًا، وهي مناسبة جدًا للاستخدام اليومي.</p>\r\n\r\n<p>إن التصميم الأنيق والعصري لهذه الحقيبة يضفي على مظهرك إطلالة عصرية وأنيقة. تأتي باللون الأسود والأصفر، ما يجعلها قطعة فريدة من نوعها ولافتة للانتباه.</p>\r\n\r\n<p>تحتوي الحقيبة على جيوب متعددة تساعدك في تنظيم أغراضك بشكل مناسب. يمكنك وضع كمبيوتر محمول بحجم 15 بوصة في الجزء المخصص له، بالإضافة إلى جيوب للهاتف المحمول والأقلام والمستندات وغيرها من اللوازم الأساسية.</p>\r\n\r\n<p>تتميز هذه الحقيبة بجودتها العالية والمتانة، حيث تصنع من مواد قوية ومتينة تضمن استخدامًا طويل الأمد. كذلك، فإن حزام الكتف المبطن يجعل حملها سهلاً ومريحًا على طول رحلاتك أو أثناء التنقل.</p>\r\n\r\n<p>بإجمال، فإن حقيبة الكمبيوتر المحمول هذه هي رفيق مثالية لأولئك الذين يرغبون في نقل أجهزة الكمبيوتر المحمولة بهدف استخدامها في المكاتب، أو خلال فترات دراسية، أو حتى أثناء السفر. احصل على حقيبة الكمبيوتر المحمول هذه الآن واجعل حياتك المهنية والأكاديمية والشخصية مريحة وأنيقة.</p>', 'حقيبة كمبيوتر محمول متوسطة الحجم بسعة 25 لترًا، تصلح للاستخدام في المكتب أو الكلية أو حتى أثناء السفر. تأتي بلونين هما الأسود والأصفر، وتحتوي على جيوب متعددة لتخزين الأغراض المختلفة. فهي تجمع بين التصميم العصري والأداء المتين لتلبية احتياجاتك الشخصية والعملية.', NULL, NULL, NULL, NULL),
(227, 44, 4, 'Canon EOS 3000D DSLR Camera 1 Camera Body, 18 - 55 mm Lens  (Black)', '<p>Canon EOS 3000D DSLR Camera</p>\r\n\r\n<h1>Canon EOS 3000D DSLR Camera</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Canon EOS 3000D is a powerful entry-level DSLR camera that offers excellent image quality and versatility. It comes with a black camera body and an included 18 - 55 mm lens, providing you with a wide range of focal lengths to capture stunning photos and videos.</p>\r\n\r\n<p>This camera features a high-resolution 18-megapixel APS-C CMOS sensor, allowing you to capture detailed images with vibrant colors and sharpness. The DIGIC 4+ image processor ensures fast performance and accurate color reproduction.</p>\r\n\r\n<p>The Canon EOS 3000D offers an ISO range of up to 6400 (expandable to ISO 12800), enabling you to shoot in various lighting conditions without compromising on image quality. Its nine-point autofocus system helps you achieve precise focus on your subject, even in challenging situations.</p>\r\n\r\n<p>This camera also supports Full HD video recording at up to 30 frames per second, allowing you to capture high-quality videos with ease. The built-in Wi-Fi and NFC connectivity enable seamless sharing of your photos and videos to compatible devices or social media platforms.</p>\r\n\r\n<p>With its intuitive interface and user-friendly controls, the Canon EOS 3000D is suitable for beginners as well as experienced photographers who want a reliable and affordable DSLR camera.</p>\r\n\r\n<p>Whether you&#39;re capturing beautiful landscapes, portraits, or action shots, the Canon EOS 3000D DSLR camera is a reliable companion that delivers impressive results.</p>', 'The Canon EOS 3000D DSLR Camera is a versatile camera that offers high-quality images and easy controls. It comes with a 18 - 55 mm lens, allowing you to capture stunning photos and videos. With its sleek black design, this camera is perfect for all photography enthusiasts.', NULL, 'Canon EOS 3000D DSLR Camera 1 Camera Body, 18 - 55 mm Lens (Black) | High-Quality Photography Equipment', 'EOS 3000D DSLR Camera 1 Camera Body, 18 - 55 mm Lens (Black) | High-Quality Photography Equipment', 'Canon EOS 3000D, DSLR Camera, Camera Body, 18 - 55 mm Lens, Black, Photography Equipment'),
(228, 44, 5, 'Canon EOS 3000D DSLR Camera 1 Camera Body، 18-55 mm Lens (Black)', '<p>وصف كاميرا Canon EOS 3000D DSLR</p>\r\n\r\n<h1>كانون إي أو إس 3000دي دي أس إل آر</h1>\r\n\r\n<p>تعد كاميرا Canon EOS 3000D DSLR واحدة من الكاميرات المهنية عالية الجودة التي تقدم صورًا استثنائية. تأتي هذه الكاميرا بجسم وعدسة قابلة للتبديل بطول 18-55 مم، مما يجعلها مثالية لتصوير مختلف المشاهد بدقة ووضوح فائقين.</p>\r\n\r\n<p>تأتي هذه الكاميرا بمستشعر APS-C CMOS بدقة 18 ميجابكسل، مما يضمن تفاصيل ووضوح رائعين في الصور. كما تتميز بأداء سريع وفعال بفضل معالج DIGIC 4+، مما يسمح لك بالتقاط صور عالية الجودة حتى في ظروف الإضاءة المنخفضة.</p>\r\n\r\n<p>بالإضافة إلى ذلك، تحتوي كاميرا Canon EOS 3000D DSLR على شاشة LCD مقاس 2.7 بوصة تعرض الصور وتسهل عملية التحكم والتبديل بين الإعدادات. كما توفر خيارات تصوير متعددة مثل التقاط الصور المستمرة وتسجيل فيديو عالي الدقة.</p>\r\n\r\n<p>تأتي هذه الكاميرا أيضًا مع مجموعة من الميزات والوظائف المبتكرة، مثل نظام التركيز التلقائي بـ 9 نقاط، وخاصية Wi-Fi المدمجة لنقل الصور بسهولة إلى أجهزة أخرى، والتحكم عن بُعد من خلال تطبيق Canon Camera Connect.</p>\r\n\r\n<p>بشكل عام، فإن كاميرا Canon EOS 3000D DSLR هي اختيار رائع لأولئك الذين يرغبون في دخول عالم التصوير المحترف. سواء كنت مبتدئًا أو هاوٍ في التصوير، فإن هذه الكاميرا ستساعدك في تحقيق صور رائعة والتقاط لحظاتك المميزة بسهولة وجودة عالية.</p>', 'كانون إي أو إس 3000دي هي كاميرا دي إس إل آر فائقة الجودة، تشمل الطقم البلاستيكي والعدسة 18-55 مم. تتميز بأداء فائق وتفاصيل رائعة للصور. تحتوي داخل الصندوق كاميرا وعدسة، مثالية للهواة المبتدئين الذين يرغبون في التصوير على نحو احترافي.', NULL, NULL, NULL, NULL),
(115, 45, 4, 'SONY Alpha Full Frame IN5 Mirrorless Camera Body with 28 - 70 mm Lens', '<p>SONY Alpha Full Frame ILCE-7M2K/BQ IN5 Mirrorless Camera</p>\r\n\r\n<h1>SONY Alpha Full Frame ILCE-7M2K/BQ IN5 Mirrorless Camera Body with 28 - 70 mm Lens</h1>\r\n\r\n<p>The SONY Alpha Full Frame ILCE-7M2K/BQ IN5 is a high-performance mirrorless camera that offers exceptional image quality and versatility. It features a full-frame sensor, which allows for stunningly detailed photos with excellent low-light performance. The camera body is compact and lightweight, making it perfect for travel or everyday use.</p>\r\n\r\n<p>This camera comes with a versatile 28-70mm lens, providing a wide range of focal lengths suitable for various photography styles such as landscape, portrait, and street photography. The lens delivers sharp and clear images with minimal distortion.</p>\r\n\r\n<p>The ILCE-7M2K/BQ IN5 boasts advanced autofocus capabilities with 117 phase-detection points and 25 contrast-detection points, ensuring fast and accurate focusing even in challenging conditions. It also offers continuous shooting at up to 5 frames per second, allowing you to capture fast-moving subjects effortlessly.</p>\r\n\r\n<p>With its built-in Wi-Fi and NFC connectivity, you can easily transfer your photos to your smartphone or tablet for quick sharing on social media platforms or remote control of the camera. Additionally, the camera has a tiltable LCD screen that enables easy framing from different angles.</p>\r\n\r\n<p>Overall, the SONY Alpha Full Frame ILCE-7M2K/BQ IN5 Mirrorless Camera Body with 28 - 70 mm Lens is an excellent choice for both amateur photographers looking to upgrade their gear and professionals seeking a reliable and versatile camera system.</p>', 'The SONY Alpha ILCE-7M2K/BQ IN5 is a high-performance mirrorless camera that features a full-frame sensor for exceptional image quality. It comes with a 28 - 70 mm lens, allowing for versatile shooting options. With its advanced technology and compact design, this camera is perfect for both amateur and professional photographers.', NULL, 'SONY Alpha Full Frame IN5 Mirrorless Camera Body with 28 - 70 mm Lens | High-Quality Photography Equipment', 'Alpha Full Frame IN5 Mirrorless Camera Body with 28 - 70 mm Lens | High-Quality Photography Equipment', 'SONY Alpha, Full Frame, IN5, Mirrorless Camera Body, 28 - 70 mm Lens, High-Quality Photography Equipment'),
(116, 45, 5, 'هيكل كاميرا سوني ألفا كامل الإطار IN5 بدون مرآة مع عدسة 28-70 ملم', '<p>وصف هيكل كاميرا سوني ألفا كامل الإطار IN5 بدون مرآة مع عدسة 28-70 ملم</p>\r\n\r\n<h1>هيكل كاميرا سوني ألفا كامل الإطار IN5 بدون مرآة مع عدسة 28-70 ملم</h1>\r\n\r\n<p>هيكل كاميرا سوني ألفا كامل الإطار IN5 بدون مرآة هو جهاز تصوير احترافي يجمع بين التقنية المتقدمة والأداء العالي. يأتي هذا الهيكل بتصميم فائق الجودة وخفيف الوزن، وهو مناسب للاستخدام في جميع أنواع التصوير من المشاهد الطبيعية إلى التصوير الفوتوغرافي.</p>\r\n\r\n<p>تتضمن هذه الكاميرا عدسة قابلة للتغيير من نوع 28-70 ميلّم، والتي تسمح لك بتصوير مجموعة واسعة من المشاهد بدقة ووضوح عاليين. تم تصميم العدسة لتلبية احتياجات المصورين المحترفين، حيث توفر أداءً استثنائيًا في التركيز التلقائي والتقاط الصور السريعة.</p>\r\n\r\n<p>بفضل تقنية كاميرا سوني ألفا كامل الإطار IN5 بدون مرآة، يمكنك التقاط صور ذات جودة عالية وألوان غنية بفضل الاستشعار CMOS ذو الـ 24.3 ميغابكسل. كما يتميز هذا الهيكل بأداء سريع ودقة فائقة في تجسيد التفاصيل، مما يجعله خيارًا مثاليًا للاحتراف.</p>\r\n\r\n<p>بالإضافة إلى ذلك، يحتوى هذا الهيكل على شاشة LCD قابلة للانقسام، وظهر إلكترونى عالى الدقة، وخاصية تثبيت الصورة للتصوير اليدوي بدون اهتزاز. كما يتميز بنظام تركيز تلقائي سريع ودقيق، ومجموعة واسعة من الميزات الإضافية التى تساعد على تحسين الأداء.</p>', 'هيكل كاميرا سوني ألفا كامل الإطار IN5 بدون مرآة مع عدسة 28-70 ملم هو جهاز تصوير احترافي يتميز بجودة عالية وتقنية فائقة. يعتبر هذا الجهاز مناسبًا لعشاق التصوير الفوتوغرافي، حيث يتضمن هيكلًا مدمجًا وخفيف الوزن لسهولة حمله واستخدامه في أي مكان.', NULL, 'هيكل كاميرا سوني ألفا كامل الإطار IN5 بدون مرآة مع عدسة 28-70 ملم - تقنية التصوير المتقدمة', 'را سوني ألفا كامل الإطار IN5 بدون مرآة مع عدسة 28-70 ملم\r\n\r\nMeta Title: هيكل كاميرا سوني ألفا كامل الإطار IN5 بدون مرآة مع عدسة 28-70 ملم - تقنية التصوير المتقدمة', 'هيكل, كاميرا, سوني, ألفا, كامل الإطار, بدون مرآة, عدسة 28-70 ملم, تقنية التصوير المتقدمة');
INSERT INTO `product_description` (`id`, `product_id`, `language_id`, `name`, `description`, `short_description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(117, 46, 4, 'Panasonic HC V785 Camcorder  (Black)', '<p>Panasonic HC V785 Camcorder (Black)</p>\r\n\r\n<h1>Panasonic HC V785 Camcorder (Black)</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Panasonic HC V785 Camcorder is a versatile and high-performance device designed for capturing stunning videos and photos. With its sleek black design, it exudes elegance and professionalism.</p>\r\n\r\n<p>This camcorder features a powerful 1/2.3-inch BSI MOS sensor that allows you to capture vibrant and detailed footage even in low-light conditions. It supports Full HD video recording at up to 1080p resolution, ensuring crystal-clear visuals with excellent color reproduction.</p>\r\n\r\n<p>Equipped with a Leica Dicomar lens, the HC V785 offers a remarkable zoom range of up to 50x optical zoom, allowing you to get closer to your subjects without sacrificing image quality. Its built-in five-axis Hybrid O.I.S.+ (Optical Image Stabilizer Plus) effectively reduces camera shake, resulting in steady and smooth footage.</p>\r\n\r\n<p>The HC V785 also boasts advanced shooting features such as slow motion video recording, time-lapse recording, and high-speed burst shooting. Additionally, it offers Wi-Fi connectivity for easy sharing and remote control via your smartphone or tablet.</p>\r\n\r\n<p>With its intuitive touchscreen interface and ergonomic design, this camcorder ensures effortless operation and comfortable handling. It also features a built-in microphone for capturing clear audio and an HDMI output for connecting to external displays.</p>\r\n\r\n<p>Whether you&#39;re a professional videographer or an enthusiast, the Panasonic HC V785 Camcorder is a reliable and feature-packed device that will help you capture and preserve your precious memories in stunning detail.</p>', 'The Panasonic HC V785 Camcorder in Black is a versatile and user-friendly device designed to capture high-quality videos and photos. Its powerful zoom capabilities, advanced image stabilization, and brilliant low-light performance make it perfect for capturing memories during travel, events, or everyday moments with exceptional clarity and color accuracy.', NULL, 'Panasonic HC V785 Camcorder (Black) - High-Quality Video Recording and Advanced Features', 'onic HC V785 Camcorder (Black) - High-Quality Video Recording and Advanced Features', 'Panasonic HC V785 Camcorder, black camcorder, high-quality video recording, advanced features, optical image stabilization, built-in Wi-Fi connectivity'),
(118, 46, 5, 'كاميرا فيديو باناسونيك HC V785 (أسود)', '<p>وصف كاميرا فيديو باناسونيك HC V785 (أسود)</p>\r\n\r\n<h1>كاميرا فيديو باناسونيك HC V785 (أسود)</h1>\r\n\r\n<p><img alt=\"صورة الكاميرا\" src=\"camera_image.jpg\" /></p>\r\n\r\n<p>تعد كاميرا فيديو باناسونيك HC V785 من أحدث الطرز المتقدمة التي تقدمها باناسونيك. تتميز هذه الكاميرا باللون الأسود الأنيق والتصميم المريح، مما يجعلها سهلة الاستخدام وتناسب جميع المستخدمين.</p>\r\n\r\n<p>تأتي الكاميرا مزودة بعدسة عالية الجودة قادرة على تصوير فيديو عالي الدقة بدقة Full HD. كما تحتوي على مستشعر MOS حجمه 1/2.3 بوصة وبفضل ذلك، فإنه يعطي صورًا واضحة وحادَّة حتى في ظروف الإضاءة المنخفضة.</p>\r\n\r\n<p>تحتوي الكاميرا على شاشة LCD قابلة للدوران بحجم 3 بوصات، مما يسهل عرض ومعاينة الصور والفيديوهات. كما تحتوي أيضًا على مثبِّت بصري للصورة (OIS)، مما يساعد في تقليل الاهتزازات والثبات أثناء التصوير.</p>\r\n\r\n<p>تأتي الكاميرا مع ذاكرة داخلية سعة 16 جيجابايت، بالإضافة إلى إمكانية توسيع التخزين باستخدام بطاقات الذاكرة SD/SDHC/SDXC. كما يمكن استخدامها لالتقاط صور ثابتة بجودة عالية بدقة 10 ميجابكسل.</p>\r\n\r\n<p>بفضل خصائصها المذهلة والأداء الرائع، فإن كاميرا فيديو باناسونيك HC V785 (أسود) هي اختيار رائع لأولئك الذين يبحثون عن جودة عالية في تصوير الفيديو والتصوير الثابت.</p>', 'كاميرا فيديو باناسونيك HC V785 (أسود) هي جهاز تصوير عالي الجودة يتمتع بتصميم أنيق وأداء متفوق. تحتوي الكاميرا على مستشعر MOS بدقة 20.4 ميغابكسل وزوم بصري قوي يصل إلى 50x، مما يسمح للمستخدم بالتقاط صور وفيديوهات رائعة عالية الدقة.', NULL, NULL, NULL, NULL),
(119, 47, 4, 'Beautiful fashion women purple dress', '<p>Beautiful Fashion Women Purple Dress</p>\r\n\r\n<h1>Beautiful Fashion Women Purple Dress</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This beautiful fashion women purple dress is a stunning piece that will make you stand out on any occasion. The vibrant shade of purple adds a touch of elegance and sophistication to your overall look.</p>\r\n\r\n<p>The dress features a flattering silhouette that accentuates your curves in all the right places. The fitted bodice with a sweetheart neckline enhances your bust while the flowing skirt gracefully drapes over your hips, creating a feminine and glamorous appearance.</p>\r\n\r\n<p>Made from high-quality fabric, this dress feels luxurious against your skin and ensures comfort throughout the day or night. The exquisite craftsmanship and attention to detail are evident in every stitch, making it a truly exceptional piece.</p>\r\n\r\n<p>Whether you&#39;re attending a formal event, cocktail party, or wedding, this purple dress is guaranteed to make heads turn. Pair it with statement accessories and heels for a complete, polished look that exudes confidence and style.</p>\r\n\r\n<p>Don&#39;t miss out on this beautiful fashion women purple dress. Embrace your inner goddess and make a lasting impression with this timeless and captivating piece.</p>', 'This stunning women\'s dress boasts an enchanting shade of purple that is sure to capture attention. With its elegant design and flawless fit, this fashion-forward piece exudes both sophistication and femininity. Perfect for any special occasion, it will make you feel like a true fashionista while turning heads wherever you go.', NULL, '\"Stunning Fashion Women Purple Dress | Elegant and Trendy Attire\"', 'ning Fashion Women Purple Dress | Elegant and Trendy Attire\"', 'beautiful dress, fashion women, purple dress, elegant attire, trendy dress'),
(120, 47, 5, 'أزياء جميلة فستان بنفسجي نسائي', NULL, 'فستان جميل باللون البنفسجي للنساء يعد خيارًا مثاليًا للمناسبات الرسمية والأحداث الخاصة. مصنوع من أجود الأقمشة ذات التصميم المميز، وهو مثير وأنيق في آن واحد. ستضفي هذه الأزياء جاذبية رائعة على إطلالتكِ وستلفت أنظار الجميع.', NULL, NULL, NULL, NULL),
(121, 48, 4, 'Pretty yellow head women dress', '<p>Pretty Yellow Head Women Dress</p>\r\n\r\n<h1>Pretty Yellow Head Women Dress</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Introducing our pretty yellow head women dress! This stunning piece is a must-have for any fashion-forward individual looking to make a statement.</p>\r\n\r\n<p>The dress features a vibrant shade of yellow that exudes positivity and radiance. Its head-turning design will surely make you stand out in any event or occasion.</p>\r\n\r\n<p>Made from high-quality materials, this dress offers both comfort and style. The fabric is soft against the skin, allowing you to move freely while maintaining an elegant silhouette.</p>\r\n\r\n<p>The dress has a flattering fit with its tailored waistline and flowing skirt. It accentuates your curves in all the right places, making you feel confident and beautiful.</p>\r\n\r\n<p>Whether you&#39;re attending a wedding, a cocktail party, or a special date night, this pretty yellow head women dress is the perfect choice. Pair it with your favorite accessories and heels to complete the look.</p>\r\n\r\n<p>Don&#39;t miss out on this fashion-forward piece that combines style and sophistication. Embrace your inner fashionista and make heads turn with our pretty yellow head women dress!</p>', 'This pretty yellow head-turning dress exudes elegance and charm. The vibrant yellow color instantly brightens the mood, while the flattering form-fitting silhouette accentuates feminine curves. Perfect for special occasions or a night out, this dress is sure to make you feel confident and effortlessly stylish.', NULL, '\"Stunning Yellow Head Women\'s Dress | Shop Now at [Brand Name]\"', 'ning Yellow Head Women\'s Dress | Shop Now at [Brand Name]\"', 'yellow head women\'s dress, pretty dress, elegant attire, stylish clothing, fashion-forward outfit'),
(122, 48, 5, 'فستان نسائي أصفر جميل الرأس', '<p>فستان نسائي أصفر جميل الرأس هو قطعة أنيقة وجذابة تضفي لمسة من البهجة والأنوثة على أي امرأة. يتميز بلونه الزاهي وتصميمه المدهش، كما يعكس روحًا مشرقة وجريئة في نفس الوقت. مناسب للعديد من المناسبات، يضفي هذا الفستان جاذبية فورية على المرتديته.</p>', 'فستان نسائي أصفر جميل الرأس هو قطعة أنيقة وجذابة تضفي لمسة من البهجة والأنوثة على أي امرأة. يتميز بلونه الزاهي وتصميمه المدهش، كما يعكس روحًا مشرقة وجريئة في نفس الوقت. مناسب للعديد من المناسبات، يضفي هذا الفستان جاذبية فورية على المرتديته.', NULL, NULL, NULL, NULL),
(229, 49, 4, 'Pretty red women dress', '<p>Pretty Red Women Dress</p>\r\n\r\n<h1>Pretty Red Women Dress</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This pretty red women dress is an absolute stunner that will make you stand out at any occasion. The vibrant shade of red exudes confidence and elegance, making it a perfect choice for special events or parties.</p>\r\n\r\n<p>The dress features a flattering silhouette that accentuates your curves in all the right places. It has a fitted bodice with a sweetheart neckline, creating a feminine and romantic look. The waistline is adorned with intricate lace detailing, adding a touch of sophistication to the overall design.</p>\r\n\r\n<p>Made from high-quality fabric, this dress offers both comfort and style. The soft and breathable material ensures you can move freely and feel comfortable throughout the day or night. The knee-length hemline adds a playful and flirty element to the dress.</p>\r\n\r\n<p>Pair this beautiful red dress with some heels and minimal accessories to let it be the star of your outfit. Whether you&#39;re attending a wedding, cocktail party, or any other special occasion, this pretty red women dress will make you feel confident and glamorous.</p>', 'This stunning red women\'s dress is an absolute showstopper. The vibrant shade exudes confidence and femininity, while the flattering silhouette hugs curves in all the right places. The intricate detailing and subtle sheen add a touch of elegance, making it perfect for any special occasion or night out on the town.', NULL, '\"Stunning Pretty Red Women Dress for a Striking Fashion Statement\"', 'ning Pretty Red Women Dress for a Striking Fashion Statement\"', 'pretty red women dress, stunning dress, elegant fashion, vibrant red dress, special occasion attire, glamorous outfit'),
(230, 49, 5, 'فستان نسائي أحمر جميل', '<p>وصف فستان نسائي أحمر جميل</p>\r\n\r\n<h1>فستان نسائي أحمر جميل</h1>\r\n\r\n<p>هذا الفستان النسائي الأحمر هو قطعة ملابس رائعة وجذابة تضفي لمسة من الأناقة والجاذبية على إطلالتك. يتميز بتصميمه المثير والجذاب الذي يبرز جمال المرأة ويبرز أنوثتها.</p>\r\n\r\n<p>صُنع هذا الفستان من خامات عالية الجودة لضمان راحتك وثبات شكله على المدى الطويل. يتكون من قماش ناعم وخفيف الوزن، مع تفاصيل دقيقة مثل التطريزات أو التصاميم المطبوعة التي تضفي له لمسة فريدة.</p>\r\n\r\n<p>إن لونه الأحمر هو لون مشرق وجذاب يلفت الأنظار، كما أنه يعكس الثقة والشجاعة. يمكن ارتداء هذا الفستان في المناسبات الخاصة مثل الحفلات، حفلات الزفاف أو المناسبات الرسمية، حيث سيضفي لمسة من التألق والأناقة على إطلالتك.</p>\r\n\r\n<p>إذا كنت تبحثين عن فستان نسائي يجمع بين الرقي والأناقة، فإن هذا الفستان الأحمر هو خيارك المثالي. احصلي على إطلالة ساحرة ولا تُضاهى بهذه القطعة المدهشة.</p>', 'فستان نسائي أحمر جميل هو قطعة أنيقة وجذابة تضفي لمسة من الأنوثة على إطلالتك. مصنوع من خامة عالية الجودة بتصميم فريد وألوان زاهية، يبرز جمالك ويجذب الأنظار في المناسبات الخاصة والحفلات. يضفي شعورًا بالثقة والجاذبية على ارتدائه', NULL, NULL, NULL, NULL),
(125, 50, 4, 'Women Maxi Purple, White Dress', '<p>Women Maxi Purple, White Dress</p>\r\n\r\n<h1>Women Maxi Purple, White Dress</h1>\r\n\r\n<p>This stunning women&#39;s maxi dress features a beautiful combination of purple and white colors, creating an elegant and eye-catching look. Made from high-quality fabric, it offers both comfort and style.</p>\r\n\r\n<p>The dress showcases a flattering silhouette with a fitted bodice that accentuates the curves and a flowy skirt that gracefully drapes down to the ankles. The empire waistline adds definition to the figure, creating a feminine and sophisticated appeal.</p>\r\n\r\n<p>Perfect for various occasions such as weddings, parties, or formal events, this dress is designed to make you stand out in any crowd. The vibrant purple hue combined with the delicate white patterns creates a striking contrast that exudes charm and elegance.</p>\r\n\r\n<p>With its adjustable spaghetti straps and elastic back panel, this maxi dress ensures a comfortable fit for different body types. It also features a concealed zipper closure at the back for easy wearing.</p>\r\n\r\n<p>Elevate your wardrobe with this Women Maxi Purple, White Dress and be ready to make a fashion statement wherever you go!</p>', 'This enchanting women\'s maxi dress showcases the perfect blend of elegance and boldness. Vibrant shades of purple and white combine to create a stunning color contrast, while the flowing silhouette adds grace and femininity. Perfect for any special occasion, this dress is sure to turn heads wherever you go.', NULL, '\"Elegant Women Maxi Purple and White Dress - Stylish and Comfortable\"', 'ant Women Maxi Purple and White Dress - Stylish and Comfortable\"', 'women maxi dress, purple and white dress, elegant dress, stylish dress, comfortable dress'),
(126, 50, 5, 'رومان ماكسي بنفسجي ، فستان أبيض', '<p>وصف فستان رومان ماكسي بنفسجي، أبيض</p>\r\n\r\n<h1>وصف فستان رومان ماكسي بنفسجي، أبيض</h1>\r\n\r\n<p>رومان ماكسي هو نمط من الفساتين الأنثوية والأنيقة التي تعتبر مناسبة للعديد من المناسبات. يتميز هذا الفستان بتصميمه البسيط والأنابيب الرقيقة التي تغطي الكتف والظهر.</p>\r\n\r\n<p>هذا الفستان مصنوع من قماش عالي الجودة بلون أبيض نقي، مما يضفي علية لمعة خاصة وجاذبية. يحتوى على طول ماكسي، حتى يصل إلى الأرض، وهذا يعطية طابعًا أنثوىً رائعًا.</p>\r\n\r\n<p>اللون البنفسجى المختار لهذا الفستان يضفى علية جرأة وروحًا شابة. كما أن لديه قَصَّة تنساب بشكل جميل على الجسم، مما يبرز أنوثة وجمال صاحبته. يتميز الفستان بخصر مرتفع وقَصَّة واسعة من الأسفل، مما يضفي حرية الحركة والراحة عند ارتدائه.</p>\r\n\r\n<p>إذا كنت تبحثين عن فستان لافت للأنظار وأنيق في المناسبات المختلفة، فإن هذا الرومان ماكسي باللون البنفسجي والأبيض هو خيار رائع. سواء كان ذلك لحضور حفل زفاف أو مناسبة رسمية، سيلائم هذا الفستان أذواقك ويرفع من إطلالتك.</p>', '\"رومان ماكسي بنفسجي، فستان أبيض هو قطعة أنيقة ومثيرة تناسب المناسبات الخاصة. يتميز بتصميمه الملفت والألوان الجذابة التي تُضفي جاذبية فريدة على من يرتديه. مثالي لإطلالة محتشمة وأنثوية في آن واحد.\"\r\n\r\nTranslation: \"Roman maxi benfaji, white dress is an elegant and glamorous piece suitable for special occasions. It stands out with its captivating design and attractive colors that add a unique charm to the wearer. Perfect for a modest yet feminine look.\"', NULL, '\"رومان ماكسي بنفسجي، فستان أبيض - تصميم رائع وأنيق\"', 'مان ماكسي بنفسجي، فستان أبيض - تصميم رائع وأنيق\"', '\"رومان ماكسي، فستان أبيض، لون بنفسجي، تصميم رائع، أناقة، مناسبات خاصة، حفلات\"'),
(127, 51, 4, 'Women Black Fancy Dress', '<p>Women Black Fancy Dress</p>\r\n\r\n<h1>Women Black Fancy Dress</h1>\r\n\r\n<p>A black fancy dress for women is the epitome of elegance and sophistication. This stunning attire is perfect for formal occasions, parties, or any event where you want to make a statement. The dress features a flattering silhouette that accentuates the feminine figure, making every woman feel confident and beautiful.</p>\r\n\r\n<p>The black color adds a touch of mystery and allure to the ensemble, making it suitable for both day and evening events. Whether you&#39;re attending a cocktail party or a gala dinner, this dress will ensure all eyes are on you.</p>\r\n\r\n<p>The design of this fancy dress incorporates intricate details such as lace embellishments, sequins, or beadwork that add a luxurious touch. The fabric used is of high quality, ensuring comfort and durability throughout the night. It may include features like a sweetheart neckline, off-the-shoulder sleeves, or an elegant backless design to enhance its visual appeal.</p>\r\n\r\n<p>Pair this black fancy dress with statement accessories such as sparkling earrings, a clutch purse, and high heels to complete your glamorous look. With its timeless elegance and versatility, this dress will become a staple in your wardrobe for years to come.</p>', 'This women\'s black fancy dress is the epitome of elegance and style. Designed to flatter any figure, it features a sleek black fabric that hugs the curves perfectly. With exquisite details and a stunning silhouette, this dress is ideal for formal occasions or special events where you want to make an unforgettable impression.', NULL, '\"Shop Women\'s Black Fancy Dresses Online | Trendy and Elegant Attire\"', 'Women\'s Black Fancy Dresses Online | Trendy and Elegant Attire\"', 'women\'s black fancy dress, trendy attire, elegant dresses, party dresses, special occasion outfits, fashionable clothing, stylish attire'),
(128, 51, 5, 'فستان تنكري أسود روماني', '<p>وصف فستان تنكري أسود روماني</p>\r\n\r\n<h1>فستان تنكري أسود روماني</h1>\r\n\r\n<p>فستان تنكري أسود روماني هو قطعة ملابس مثالية لأي حدث خاص يتطلب الزي المحدد. يتميز هذا الفستان بتصميمه الأنثوي والأنيق الذي يجعل المرتدي يشعر بالتألق والجاذبية.</p>\r\n\r\n<p>صُنع هذا الفستان من خامة عالية الجودة، حيث تضمن جودة التصنيع والمظهر الرائع. يتألف من قطعتَيْن رئيسِيَّتَيْن: فستان طويل وحزام للخصر. صُمِّم بقَصَّةٍ ضِبْطِيةٍ مُلاصِقةٍ للجسد، مما يبرز جمال المحتدي به.</p>\r\n\r\n<p>إضافة إلى ذلك، فإن التفاصيل والزخارف في هذا الفستان تضفي لمسة أصالة وتميز عليه. يحتوي الفستان على زخارف مطرزة باللون الذهبي على الصدر والأكمام، ما يضفي لمسة فاخرة وملكية.</p>\r\n\r\n<p>قد تظهر هذه القطعة المدهشة في حفلات الزفاف أو المناسبات الرسمية أو حتى في حفلات التنكر. ستجذب انتباه الجميع وستشعر بالثقة والأناقة عند ارتدائها.</p>\r\n\r\n<p>لا تُضَيِّعْ فُرْصَةَ امْتِلاَكِ هذا الفستان التنكري الروماني الأسود لإطلالةٍ ساحرةٍ ولافتة في أي مناسبة خاصة!</p>', 'فستان تنكري أسود روماني هو قطعة ملابس أنيقة ومثيرة للروح التاريخية القديمة للإمبراطورية الرومانية. يتميز بتصميمه الأنيق والأنثوي، مع حزام يزيد من روعته. يعتبر هذا الفستان اختيارًا مثاليًا لحفلات الأزياء أو حفلات التنكر المميزة.', NULL, NULL, NULL, NULL),
(131, 52, 4, 'Tradworld HX750 Drone 2.6 Ghz 6 C Without Camera for Kids Drone', '<p>Tradworld HX750 Drone</p>\r\n\r\n<h1>Tradworld HX750 Drone 2.6 Ghz 6 Channel Remote Control Quadcopter Without Camera for Kids Drone</h1>\r\n\r\n<p>The Tradworld HX750 Drone is a high-quality remote control quadcopter designed specifically for kids. With its easy-to-use controls and durable construction, it provides hours of fun and entertainment for children of all ages.</p>\r\n\r\n<p>This drone operates on a 2.6 GHz frequency, allowing for stable and reliable control even in crowded areas. The 6-channel remote control ensures precise maneuverability, enabling kids to perform various aerial stunts and tricks with ease.</p>\r\n\r\n<p>While this particular model does not come with a camera, it offers a lightweight design that enhances flight performance. It is perfect for beginners who want to learn the basics of flying without the added complexity of capturing images or videos.</p>\r\n\r\n<p>The Tradworld HX750 Drone features built-in LED lights that make it visible during both daytime and nighttime flights. This adds an extra level of excitement as kids can enjoy flying the drone even after sunset.</p>\r\n\r\n<p>Safety is a top priority when it comes to kids&#39; toys, and this drone meets all necessary safety standards. It has propeller guards to protect against accidental collisions and a low-battery alarm that alerts users when it&#39;s time to land the drone and recharge its battery.</p>\r\n\r\n<p>In conclusion, the Tradworld HX750 Drone is an excellent choice for young aspiring pilots who want to experience the thrill of flying their own quadcopter. Its user-friendly controls, durability, and safety features make it an ideal toy for kids to explore the world of drones.DRON</p>', 'The Tradworld HX750 Drone is a 2.6 GHz 6-channel remote control quadcopter designed specifically for kids. This drone is camera-free, making it ideal for beginners and young children to enjoy flying without the complexity of capturing images or videos. With easy-to-use controls, it provides a fun and safe drone experience for kids to explore the world of aviation.', NULL, 'Tradworld HX750 Drone 2.6 GHz 6 Channel Remote Control Quadcopter for Kids - Camera-less', 'orld HX750 Drone 2.6 GHz 6 Channel Remote Control Quadcopter for Kids - Camera-less', 'Tradworld HX750 Drone, 2.6 GHz, 6 Channel Remote Control Quadcopter, Kids Drone, Camera-less Drone'),
(132, 52, 5, 'Tradworld HX750 Drone 2.6 جيجا هرتز 6 قنوات تحكم عن بعد كوادكوبتر بدون كاميرا للأطفال بدون طيار', '<p>وصف لطائرة بدون طيار Tradworld HX750 Drone</p>\r\n\r\n<h1>وصف لطائرة بدون طيار Tradworld HX750 Drone</h1>\r\n\r\n<p>تعتبر طائرة بدون طيار Tradworld HX750 Drone مناسبة تمامًا للأطفال الذين يهتمون بتجربة الطيران والتحكم عن بُعد. تأتي هذه الطائرة بدون كاميرا، مما يجعلها خيارًا رائعًا للأطفال الصغار الذين يستكشفون عالم التحكم عن بُعد ولديهم شغف في تجربة القيادة.</p>\r\n\r\n<p>تحظى طائرة Tradworld HX750 Drone بقدرات مدهشة، حيث تعمل على تر frequent جيجا هيرتز 2.6، مما يضمن استقبال إشارات قوية وثابتة. كما تأتي مزودة بست قنوات للتحكم عن بُعد، مما يسهل التحكم في الحركة والتوجيه بسلاسة ودقة عالية.</p>\r\n\r\n<p>تصميم هذه الطائرة المصغرة يجعلها مثالية للأطفال، حيث يمكنهم التحكم بها بسهولة وبثقة. تأتي الطائرة بشكل كوادكوبتر، مع أربع شفرات تضمن استقرارًا فائقًا أثناء الطيران. كما تحتوي على مصابيح LED لإضافة لمسة جذابة أثناء الطيران في الظروف المظلمة.</p>\r\n\r\n<p>إن طائرة Tradworld HX750 Drone هي لعبة مناسبة للأطفال فوق سن 8 سنوات، حيث تساعدهم على تطوير مهارات التحكم والتنسيق. إنها أداة رائعة للاستخدام في الهواء الطلق، سواء في المتنزهات أو الشوارع أو حديقة المنزل.</p>', 'تعتبر طائرة الدرون Tradworld HX750 بدون كاميرا مناسبة للأطفال، حيث تأتي مع جهاز تحكم عن بعد يعمل على تردد 2.6 جيجا هرتز و6 قنوات. تضمن هذه الطائرة المصغرة سلامة الأطفال وتوفر لهم تجربة رائعة في التحليق بشكل مستقر وسهولة التحكم في الارتفاع والحركة.', NULL, '\"ترادوورلد HX750 درون 2.6 جيجا هرتز 6 قنوات تحكم عن بعد كوادكوبتر بدون كاميرا للأطفال بدون طيار\"', 'ادوورلد HX750 درون 2.6 جيجا هرتز 6 قنوات تحكم عن بعد كوادكوبتر بدون كاميرا للأطفال بدون طيار\"', '\"HX750 درون، ترادورلد، كوادكوبتر، طائرة بدون طيار، تحكم عن بُعد، أطفال، جيل هيرتز\"'),
(133, 53, 4, 'NIKHLIX RVR INTERPRICE MODELl E88 Drone', '<p>NIKHLIX RVR INTERPRICE MODELl E88 Drone</p>\r\n\r\n<h1>NIKHLIX RVR INTERPRICE MODELl E88 Drone</h1>\r\n\r\n<p>The NIKHLIX RVR INTERPRICE MODELl E88 Drone is a cutting-edge unmanned aerial vehicle (UAV) that combines advanced technology with exceptional performance. Designed for both professional and recreational use, this drone offers an unparalleled flying experience.</p>\r\n\r\n<p>The E88 Drone features a sleek and compact design, making it highly portable and easy to carry. Its durable construction ensures resistance against impact and allows for stable flights even in challenging weather conditions. Equipped with powerful brushless motors, this drone can reach impressive speeds and maintain stability during flight.</p>\r\n\r\n<p>One of the standout features of the NIKHLIX RVR INTERPRICE MODELl E88 Drone is its high-definition camera. With a resolution of 4K, it captures stunning aerial footage and crystal-clear photos. The camera also supports real-time transmission, allowing users to view the live feed on their smartphones or tablets through a dedicated app.</p>\r\n\r\n<p>This drone offers various intelligent flight modes such as Follow Me mode, Waypoint mode, and Gesture Control mode. These features enable the drone to autonomously track subjects, fly along pre-set routes, and respond to hand gestures for intuitive control.</p>\r\n\r\n<p>The NIKHLIX RVR INTERPRICE MODELl E88 Drone is equipped with advanced safety mechanisms including GPS positioning, altitude hold, automatic return home function, and emergency stop feature. These ensure a safe flying experience while preventing accidents or loss of the drone.</p>\r\n\r\n<p>Overall, the NIKHLIX RVR INTERPRICE MODELl E88 Drone provides a perfect balance between performance, functionality, and affordability. Whether you are an aerial photography enthusiast or simply enjoy flying drones, this model is sure to deliver an exceptional experience.</p>', 'The NIKHLIX RVR INTERPRICE MODEL E88 Drone is a compact and versatile drone that packs a punch with its advanced features. With impressive stability, high-definition camera capabilities, and an easy-to-operate remote control, this drone allows users to capture stunning aerial footage with ease. Perfect for both beginners and professionals alike.', NULL, 'NIKHLIX RVR INTERPRICE MODEL E88 Drone - High-Performance Quadcopter for Aerial Photography and FPV Racing', 'IX RVR INTERPRICE MODEL E88 Drone - High-Performance Quadcopter for Aerial Photography and FPV Racing', 'NIKHLIX RVR INTERPRICE MODEL E88 Drone, quadcopter, aerial photography, FPV racing, 4K camera, GPS positioning, long flight time, high-performance drone'),
(134, 53, 5, 'NIKHLIX RVR INTERPRICE MODELl E88 الطائرة بدون طيار', '<p>وصف طائرة بدون طيار NIKHLIX RVR INTERPRICE MODELl E88</p>\r\n\r\n<h1>وصف طائرة بدون طيار NIKHLIX RVR INTERPRICE MODELl E88</h1>\r\n\r\n<p>طائرة بدون طيار NIKHLIX RVR INTERPRICE MODELl E88 هي نموذج متقدم من الطائرات بدون طيار المستخدمة في العديد من التطبيقات. تتميز هذه الطائرة بأحدث التقنيات والمزايا التي تساعدها على أداء مهامها بكفاءة عالية.</p>\r\n\r\n<p>تتميز الطائرة NIKHLIX RVR INTERPRICE MODELl E88 بتصميمها المبتكر والأنيق، حيث يتضمن جسمًا خفيفًا مصنوعًا من مواد عالية الجودة لضمان قوة وصلابة الهيكل. كما يحتوي على أجنحة معززة تساعدها على الطيران بثبات وتحمل الظروف الجوية المختلفة.</p>\r\n\r\n<p>تعمل طائرة NIKHLIX RVR INTERPRICE MODELl E88 بنظام تحكم متقدم يستخدم تقنيات الذكاء الاصطناعي والتعلم الآلي. يسهل هذا النظام التحكم في حركة الطائرة والإبقاء على استقرارها أثناء التحليق. كما يوفر نظام الملاحة GPS دقة عالية في تحديد موقع الطائرة والتوجيه.</p>\r\n\r\n<p>تأتي طائرة NIKHLIX RVR INTERPRICE MODELl E88 مزودة بكاميرات عالية الدقة وأنظمة رصد لاسلكية، مما يسهل استخدامها في التصوير الجوي وعمليات المراقبة. يُعَد هذا النموذج مناسبًا للاستخدامات التجارية والعسكرية، فضلاً عن استخدامه في مجالات أخرى مثل المسح الجغرافي وإنقاذ المحتجزين.</p>\r\n\r\n<p>بفضل قدرتها على الطيران لمسافات طويلة والبقاء في الجو لفترات طويلة، تعد طائرة NIKHLIX RVR INTERPRICE MODELl E88 خيارًا مثاليًا للمهام التي تتطلب تغطية واسعة ومراقبة دقيقة. إنها أداة حديثة وموثوقة للاستخدام في مجالات متنوعة.</p>', 'نيكليكس طراز E88 هو طائرة بدون طيار متعددة الأغراض تستخدم في الأعمال التجارية والصناعية. تحظى بشعبية في قطاعات مثل الفحص والمراقبة، وصناعة الزراعة، والتصوير الجوي. تتميز بالقدرة على التحليق لفترات طويلة وإجراءات سهلة للطيران، مما يجعلها اختيارًا مثاليًا للاستخدام المهني.', NULL, NULL, NULL, NULL),
(231, 54, 4, 'Mksrstore DJI Mini 3 Pro with DJI RC Remote (Smart Controller with Display) Drone', '<p>Mksrstore DJI Mini 3 Pro with DJI RC Remote</p>\r\n\r\n<h1>Mksrstore DJI Mini 3 Pro with DJI RC Remote (Smart Controller with Display) Drone</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Mksrstore DJI Mini 3 Pro with DJI RC Remote is a high-performance drone designed for enthusiasts and professionals alike. It combines advanced technology, portability, and ease of use to deliver an exceptional aerial photography experience.</p>\r\n\r\n<p>This drone features a compact and lightweight design, making it incredibly portable and easy to carry around. Despite its small size, the Mini 3 Pro is packed with powerful features that allow you to capture stunning images and videos from the sky.</p>\r\n\r\n<p>Equipped with a high-resolution camera, the Mini 3 Pro can capture photos up to XX megapixels and record videos in XXK resolution. The camera is mounted on a three-axis gimbal, ensuring stable footage even in windy conditions or during fast movements.</p>\r\n\r\n<p>The included DJI RC Remote (Smart Controller with Display) provides intuitive control over the drone. Its built-in display allows you to view live footage from the drone&#39;s camera in real-time, providing a seamless flying experience without the need for additional devices.</p>\r\n\r\n<p>With intelligent flight modes such as Follow Me, Waypoints, and Point of Interest, you can easily create professional-looking shots without any piloting skills. The Mini 3 Pro also supports automated flight paths using GPS technology for precise and accurate flying.</p>\r\n\r\n<p>Overall, the Mksrstore DJI Mini 3 Pro with DJI RC Remote is a versatile and reliable drone that delivers exceptional performance and stunning aerial imagery. Whether you&#39;re a beginner or an experienced pilot, this drone is sure to elevate your photography and videography skills to new heights.e</p>', 'The Mksrstore DJI Mini 3 Pro with DJI RC Remote is a compact and powerful drone equipped with advanced features. The smart controller with a built-in display allows for easy navigation and live streaming. With its improved performance and portability, this drone is perfect for capturing stunning aerial shots and videos.', NULL, NULL, NULL, NULL),
(232, 54, 5, 'Mksrstore DJI Mini 3 Pro مع جهاز تحكم عن بعد DJI RC (وحدة تحكم ذكية مع شاشة عرض) بدون طيار', '<p>وصف DJI Mini 3 Pro مع جهاز تحكم عن بعد</p>\r\n\r\n<h1>وصف DJI Mini 3 Pro مع جهاز تحكم عن بعد</h1>\r\n\r\n<p>يأتي DJI Mini 3 Pro مع جهاز تحكم عن بُعد لتجربة طيران لا مثيل لها. يتميز هذا الطائرة بدون طيار الصغير والقابل للطي بأداء استثنائي ومرونة في التحكم، مما يجعله مناسبًا للمبتدئين والمحترفين على حد سواء.</p>\r\n\r\n<p>جهاز التحكم عن بُعد DJI RC هو وحدة تحكم ذكية تأتي مزودة بشاشة عرض، والتي تسهل رؤية الصور المباشرة من الطائرة دون الحاجة إلى استخدام هاتف ذكي أو جهاز لوحي. يتضمن جهاز التحكم أزرار تحكم مريحة وعصا تحكم دقيقة للتحرك بسلاسة في الهواء والتحكم في الطائرة بدقة عالية.</p>\r\n\r\n<p>يضمن نظام GPS المدمج في DJI Mini 3 Pro استقرارًا فائقًا أثناء الطيران، مع القدرة على تحديد المواقع بدقة وتسجيل طريق الطيران. يتميز هذا الطائرة بدون طيار بكاميرا عالية الدقة تبلغ 12 ميجابكسل، والتي تلتقط صورًا وفيديوهات رائعة من الأعلى.</p>\r\n\r\n<p>بفضل حجمه المدمج ووزنه الخفيف، يُعتبر DJI Mini 3 Pro سهل التنقل والتخزين. كما يأتي مع حافظة مصممة خصيصًا لحماية الطائرة أثناء التنقل.</p>', '\"متجر إمكس ستور يقدم لكم طائرة دي جي آي ميني 3 برو مع وحدة تحكم عن بعد دي جي آي آرسي (وحدة تحكم ذكية مزودة بشاشة عرض). استمتع بالطيران بلا حاجة للطيار واستخدام أحدث التقنيات في هذه الطائرة المصغرة. اقتنها الآن واستمتع بأسلوب طيران فريد.\"', NULL, 'اشتري DJI Mini 3 Pro مع جهاز تحكم عن بُعد DJI RC من متجر MKSRstore', 'e: DJI Mini 3 Pro مع جهاز تحكم عن بعد DJI RC (وحدة تحكم ذكية مع شاشة عرض) بدون طيار\r\n\r\nMeta Title: اشتري DJI Mini 3 Pro مع جهاز تحكم عن بُعد DJI RC من متجر MKSRstore', 'MKSRstore، DJI Mini 3 Pro، جهاز تحكم عن بُعد، DJI RC، وحدة تحكم ذكية، شاشة عرض، بدون طيار'),
(137, 55, 4, 'bAt Rockerz 510 Super Extra Bass Bluetooth Headset  (Raging Red, On the Ear)', '<p>bAt Rockerz 510 Super Extra Bass Bluetooth Headset</p>\r\n\r\n<h1>bAt Rockerz 510 Super Extra Bass Bluetooth Headset</h1>\r\n\r\n<p>The bAt Rockerz 510 Super Extra Bass Bluetooth Headset in Raging Red color is an on-ear wireless headphone that delivers a powerful audio experience with its superior sound quality and deep bass. Designed for music enthusiasts and gamers, this headset offers a comfortable fit and convenient wireless connectivity.</p>\r\n\r\n<p>Featuring advanced Bluetooth technology, the bAt Rockerz 510 allows you to connect effortlessly to your smartphone or any other compatible device. With a range of up to 10 meters, you can enjoy your favorite music or take calls without being restricted by wires. The headset also comes with a built-in microphone, enabling hands-free calling.</p>\r\n\r\n<p>The stylish design of the bAt Rockerz 510 makes it stand out from the crowd. The vibrant Raging Red color adds a bold touch to your style statement. The adjustable headband and cushioned ear cups ensure a comfortable fit even during extended listening sessions.</p>\r\n\r\n<p>Equipped with super extra bass drivers, this headset delivers immersive audio with rich lows and clear highs. Whether you are listening to music, watching movies, or playing games, the bAt Rockerz 510 enhances your audio experience by providing deep and powerful sound.</p>\r\n\r\n<p>The bAt Rockerz 510 Super Extra Bass Bluetooth Headset is perfect for those who seek both style and performance in their headphones. With its wireless convenience, comfortable design, and impressive sound quality, it is an ideal choice for anyone looking for an affordable yet high-quality audio accessory.hea</p>', 'The bAt Rockerz 510 Super Extra Bass Bluetooth Headset in Raging Red is a sleek and stylish on-ear headphone that provides an immersive audio experience. With its powerful bass and wireless connectivity, you can enjoy your favorite music or make hands-free calls with ease. Perfect for music enthusiasts on the go.', NULL, '\"bAt Rockerz 510 Super Extra Bass Bluetooth Headset - Raging Red, On the Ear\"', 'Rockerz 510 Super Extra Bass Bluetooth Headset - Raging Red, On the Ear\"', '\"bAt Rockerz 510, Super Extra Bass, Bluetooth Headset, Raging Red, On-ear headphones, wireless connectivity, powerful audio, deep bass, stylish design\"'),
(138, 55, 5, 'سماعة رأس بلوتوث روكيرز 510 سوبر إكسترا باس (أحمر داكن ، على الأذن)', '<p>وصف سماعة رأس بلوتوث روكيرز 510 سوبر إكسترا باس</p>\r\n\r\n<h1>سماعة رأس بلوتوث روكيرز 510 سوبر إكسترا باس (أحمر داكن ، على الأذن)</h1>\r\n\r\n<p>تعتبر سماعة الرأس بلوتوث روكيرز 510 سوبر إكسترا باس مناسبة لجميع محبي الموسيقى والصوت الجودة العالية. تُعد هذه السماعة مثالية للاستخدام في المنزل أو أثناء التنقل.</p>\r\n\r\n<p>تتميز سماعة الرأس بلوتوث روكيرز 510 بجودة صوت استثنائية وإضافة خاصية الباس الإضافي القادر على تحسين تجربة استماعك للمقطوعات المفضلة لديك. يُشغَّل نظام إدارة جودة صارم جودة صارم لضمان توفير صوت نقي وغني بالتفاصيل.</p>\r\n\r\n<p>تأتي سماعة الرأس بلوتوث روكيرز 510 بتصميم أنيق وأحمر داكن جذاب يضفي لمسة من الأناقة على مظهرك. كما تتميز بشكلها المريح وخفة وزنها، مما يجعلها مثالية للاستخدام الطويل دون أي ازعاج.</p>\r\n\r\n<p>بفضل تقنية البلوتوث، يُسهِّل استخدام سماعة الرأس ربطها بأجهزة التشغيل المختلفة مثل الهواتف الذكية والأجهزة اللوحية والحواسب المحمولة. كما تحتوي على زر التحكم في المكالمات وإدارة المسارات الموسيقية، مع إعادة شحن سريعة لضمان استخدام طويل لفترات طويلة.</p>\r\n\r\n<p>بشكل عام، فإن سماعة رأس بلوتوث روكيرز 510 سوبر إكسترا باس هي خيار ممتاز للأشخاص الذين يبحثون عن تجربة استماع مريحة وجودة صوت مذهلة. احصل على هذه السماعة الآن واستمتع بالموسيقى المفضلة لديك في أي وقت وأي مكان.</p>', 'سماعة رأس بلوتوث روكيرز 510 سوبر إكسترا باس (أحمر داكن ، على الأذن) هي سماعة عالية الجودة تتميز بتقنية البلوتوث لاسلكيًا وصوت Extra Bass مذهل. تصميمها الأنيق يُفضل وضعها فوق الأذن بشكل مريح ، وتجعل التجربة الموسيقية أكثر إثارة ونقاء.', NULL, NULL, NULL, NULL),
(139, 56, 4, 'Lenovo Yoga Slim 7 Carbon Intel Core i7 12th Gen - (16 GB/1 TB SSD/Windows 11 Home)', '<p>Lenovo Yoga Slim 7 Carbon</p>\r\n\r\n<h1>Lenovo Yoga Slim 7 Carbon Intel Core i7 12th Gen - (16 GB/1 TB SSD/Windows 11 Home)</h1>\r\n\r\n<p>The Lenovo Yoga Slim 7 Carbon is a high-performance laptop powered by the latest Intel Core i7 12th generation processor. With its sleek and lightweight design, it offers portability without compromising on power and performance.</p>\r\n\r\n<p>This model comes with a generous 16 GB of RAM, allowing for smooth multitasking and efficient handling of demanding applications. The large 1 TB SSD storage ensures ample space for storing files, documents, multimedia, and more.</p>\r\n\r\n<p>Equipped with Windows 11 Home operating system, the Lenovo Yoga Slim 7 Carbon provides a user-friendly interface and access to various productivity tools and applications. It offers enhanced security features to protect your data and privacy.</p>\r\n\r\n<p>The laptop features a vibrant display with a high resolution, providing crisp visuals and immersive viewing experience. Its touchscreen capability adds convenience and versatility to interact with the device.</p>\r\n\r\n<p>In terms of connectivity options, it includes USB ports, HDMI port, Wi-Fi, Bluetooth, and more for seamless connectivity with peripherals and other devices. The battery life is impressive, allowing for extended usage without frequent recharging.</p>\r\n\r\n<p>Overall, the Lenovo Yoga Slim 7 Carbon is an excellent choice for individuals who require a powerful yet portable laptop that can handle intensive tasks while offering an enjoyable user experience.</p>', 'The Lenovo Yoga Slim 7 Carbon is a powerful and lightweight laptop with an Intel Core i7 12th Gen processor, ideal for both work and entertainment. With its 16 GB RAM and 1 TB SSD storage, it offers lightning-fast performance and ample space for your files. Running on Windows 11 Home, it provides a smooth and user-friendly experience.', NULL, 'Lenovo Yoga Slim 7 Carbon Intel Core i7 12th Gen - (16 GB/1 TB SSD/Windows 11 Home) | Lightweight and Powerful Laptop', 'o Yoga Slim 7 Carbon Intel Core i7 12th Gen - (16 GB/1 TB SSD/Windows 11 Home) | Lightweight and Powerful Laptop', 'Lenovo Yoga Slim 7 Carbon, Intel Core i7, 12th Gen processor, lightweight laptop, powerful performance, 16 GB RAM, 1 TB SSD storage, Windows 11 Home'),
(140, 56, 5, 'Lenovo Yoga Slim 7 Carbon Intel Core i7 12th Gen - (16 جيجا بايت / 1 تيرابايت SSD / Windows 11 Home)', '<p>وصف لينوفو يوجا سليم 7 كاربون إنتل كور i7 الجيل الثاني عشر - (16 جيجابايت / 1 تيرابايت SSD / ويندوز 11 هوم)</p>\r\n\r\n<h1>وصف لينوفو يوجا سليم 7 كاربون إنتل كور i7 الجيل الثاني عشر - (16 جيجابايت / 1 تيرابايت SSD / ويندوز 11 هوم)</h1>\r\n\r\n<p>لابتوب Lenovo Yoga Slim 7 Carbon هو جهاز قوى وعصرى يأتى بإمكانات مذهلة. يحتوى على معالج Intel Core i7 من الجيل الثانى عشر، مما يضمن أداءً سريعًا وسلاسة في التعامل مع المهام المختلفة. سعة ذاكرة الوصول العشوائية (RAM) تبلغ 16 جيجابايت، مما يسمح بالقدرة على تشغيل التطبيقات والبرامج بسلاسة دون أى تأخير.</p>\r\n\r\n<p>القرص الصلب لهذا الجهاز يأتي بسعة تخزينية تبلغ 1 تيرابايت SSD، مما يوفر مساحة كافية لتخزين الملفات والبرامج بشكل آمن وسرعة نقل عالية. يضمن نظام التشغيل Windows 11 Home التوافق الكامل مع أحدث التطبيقات والبرامج، ويوفر واجهة سهلة الاستخدام ومرونة في إدارة المهام.</p>\r\n\r\n<p>تصميم Lenovo Yoga Slim 7 Carbon خفيف الوزن وأنيق، مع شاشة عالية الدقة بحجم مناسب لتوفير تجربة مشاهدة رائعة. يحتوى على منافذ USB-C و HDMI لإمكانية توصيل أجهزة إضافية بسهولة. كما يتميز اللابتوب ببطارية قوية تدوم طويلًا، مما يسمح بالعمل لفترات طويلة دون حاجة لإعادة الشحن.</p>\r\n\r\n<p>بشكل عام، Lenovo Yoga Slim 7 Carbon Intel Core i7 12th Gen هو خيار رائع لأولئك الذين يبحثون عن جهاز محمول قوي ومتعدد الاستخدامات، سواء للعمل أو الترفيه.</p>', 'لابتوب لينوفو يوجا سليم 7 كربون، بمعالج إنتل كور i7 الجيل الثاني عشر، وذاكرة وصول عشوائية بسعة 16 جيجا بايت ومساحة تخزين SSD تصل إلى تيرابايت. يعمل بنظام التشغيل ويندوز 11 هوم، مقاسه رقيق وخفيف مع شاشة عالية الدقة.', NULL, NULL, NULL, NULL),
(141, 57, 4, 'ASUS Vivobook 15 Core i3 11th Gen - (8 GB/512 GB SSD/Windows 11 Home)', '<p>ASUS Vivobook 15 Core i3 11th Gen</p>\r\n\r\n<h1>ASUS Vivobook 15 Core i3 11th Gen</h1>\r\n\r\n<p>The ASUS Vivobook 15 Core i3 11th Gen is a powerful and efficient laptop that offers a seamless computing experience. It is equipped with an Intel Core i3 processor from the latest 11th generation, ensuring smooth multitasking and improved performance.</p>\r\n\r\n<p>The laptop comes with a generous amount of memory, featuring 8 GB RAM, which allows for effortless multitasking and faster data processing. With a spacious storage capacity of 512 GB SSD, you can store all your important files, documents, and multimedia content without worrying about running out of space.</p>\r\n\r\n<p>The ASUS Vivobook boasts a sleek and stylish design with its slim bezel NanoEdge display, providing an immersive viewing experience. The Full HD resolution ensures crisp and vibrant visuals while watching movies or working on creative projects.</p>\r\n\r\n<p>This laptop runs on Windows 11 Home operating system, offering a user-friendly interface and access to various productivity tools. It also includes features like Cortana voice assistant and Microsoft Edge browser for enhanced convenience.</p>\r\n\r\n<p>In terms of connectivity options, the ASUS Vivobook offers multiple ports including USB Type-C, USB Type-A, HDMI, and SD card reader. It also supports Wi-Fi and Bluetooth connectivity for seamless wireless communication.</p>\r\n\r\n<p>Whether you&#39;re a student or a professional, the ASUS Vivobook provides the perfect balance between performance and portability. Its lightweight design makes it easy to carry around, while its powerful hardware ensures efficient performance for all your computing needs.</p>', 'The ASUS Vivobook 15 is a powerful and sleek laptop featuring an 11th Gen Intel Core i3 processor, 8GB RAM, and a 512GB SSD storage. With Windows 11 Home pre-installed, it offers seamless performance for daily tasks and multitasking. Its immersive display and ergonomic design make it perfect for both work and entertainment.', NULL, '\"ASUS Vivobook 15 Core i3 11th Gen - (8 GB/512 GB SSD/Windows 11 Home) | Powerful and Stylish Laptop\"', 'Vivobook 15 Core i3 11th Gen - (8 GB/512 GB SSD/Windows 11 Home) | Powerful and Stylish Laptop\"', 'ASUS Vivobook, Core i3 laptop, 11th Gen Intel processor, 8 GB RAM, 512 GB SSD, Windows 11 Home, powerful laptop, stylish design'),
(142, 57, 5, 'ASUS Vivobook 15 Core i3 11th Gen - (8 جيجا بايت / 512 جيجا بايت SSD / Windows 11 Home)', '<p>وصف ASUS Vivobook 15 Core i3 11th Gen</p>\r\n\r\n<h1>وصف ASUS Vivobook 15 Core i3 الجيل الحادي عشر</h1>\r\n\r\n<p>ASUS Vivobook 15 Core i3 الجيل الحادي عشر هو جهاز كمبيوتر محمول متعدد الاستخدامات يقدم أداءً قويًا وسلاسة في التشغيل. يأتي الجهاز بمعالج Intel Core i3 من الجيل الحادي عشر، مما يضمن سرعة وكفاءة في تنفيذ المهام المختلفة.</p>\r\n\r\n<p>يتميز ASUS Vivobook 15 بشاشة بحجم 15.6 بوصة تعرض صورًا واضحة وحادة بدقة Full HD. إلى جانب ذلك، يأتي مزودًا بذاكرة عشوائية سعتها 8 جيجابايت، مما يسهل تنفيذ المهام المتعددة دون أية تأخيرات.</p>\r\n\r\n<p>بالإضافة إلى ذلك، يحتوي ASUS Vivobook 15 على قرص تخزين SSD بسعة 512 جيجابايت، الذي يوفر مساحة تخزين كبيرة للملفات والبرامج والألعاب. كما أنه يساعد في زيادة سرعة التشغيل وتحميل البيانات.</p>\r\n\r\n<p>تأتي هذه الحاسوب المحمول بنظام التشغيل Windows 11 Home المثبت مسبقًا، مما يوفر أحدث التحديثات والأداء الأمثل للبرامج والتطبيقات.</p>\r\n\r\n<p>ASUS Vivobook 15 Core i3 الجيل الحادي عشر هو اختيار مثالي لأولئك الذين يبحثون عن حاسوب محمول قوي وفعال في أداء المهام المكتبية والترفية. سواء كنت تقوم بإجراء أعمالك، أو تستخدمه للدراسة، أو حتى للاستمتاع بألعابك المفضلة، فإن هذا الجهاز سيرضي احتياجاتك بشكل رائع.</p>', 'حاسوب محمول ASUS Vivobook 15 Core i3 الجيل الحادي عشر - (ذاكرة وصول عشوائية 8 جيجا بايت / سعة تخزين 512 جيجا بايت بتقنية SSD / نظام تشغيل Windows 11 Home). يأتي بمعالج Core i3 الحديث لتوفير أداء سلس وسرعة في التشغيل، مع شاشة كبيرة مقاس 15 انش ونظام تشغيل Windows 11 المحدث.', NULL, NULL, NULL, NULL),
(145, 59, 4, 'Men Slim Fit Solid Casual Shirt', '<p>Men Slim Fit Solid Casual Shirt</p>\r\n\r\n<h1>Men Slim Fit Solid Casual Shirt</h1>\r\n\r\n<p>The Men Slim Fit Solid Casual Shirt is a stylish and trendy clothing item designed for men who prefer a sleek and modern look. This shirt is tailored to provide a slim fit, enhancing the wearer&#39;s physique and giving a polished appearance.</p>\r\n\r\n<p>The shirt is made from high-quality fabric that ensures comfort and durability. Its solid color design adds versatility, making it suitable for various occasions, including casual outings, parties, or even semi-formal events.</p>\r\n\r\n<p>The slim fit of this shirt accentuates the natural shape of the body without being too tight or restrictive. It creates a streamlined silhouette that complements different body types. The shirt features long sleeves with buttoned cuffs, providing a classic and sophisticated touch.</p>\r\n\r\n<p>With its timeless design and solid color options, this casual shirt can be easily paired with jeans or chinos for a relaxed yet fashionable ensemble. It can also be dressed up by pairing it with dress pants or blazers for more formal occasions.</p>\r\n\r\n<p>In summary, the Men Slim Fit Solid Casual Shirt offers both style and comfort in one package. It is an essential addition to any man&#39;s wardrobe, allowing him to effortlessly exude confidence and class in various settings.</p>', 'This men\'s slim fit solid casual shirt is a must-have addition to any modern man\'s wardrobe. Made with high-quality materials, it offers a sleek and stylish look that can be easily dressed up or down. Perfect for both casual and formal occasions, this shirt exudes confidence and sophistication.', NULL, '\"Men Slim Fit Solid Casual Shirt - Classic Style for a Polished Look\"', 'Slim Fit Solid Casual Shirt - Classic Style for a Polished Look\"', 'men slim fit shirt, solid casual shirt, classic style, polished look, comfortable fabric, versatile outfit choice'),
(146, 59, 5, 'قميص كاجوال سادة للرجال ذو قصة ضيقة', '<p>وصف القميص الكاجوال السادة للرجال ذو قصة ضيقة</p>\r\n\r\n<h1>وصف القميص الكاجوال السادة للرجال ذو قصة ضيقة</h1>\r\n\r\n<p>هذا القميص هو قطعة مثالية للرجال الذين يبحثون عن إطلالة كاجوال أنيقة وعصرية. يتميز بتصميمه البسيط والأنيق، حيث يأتي بلون سادة يتناسب مع أغلب الملابس والإكسسوارات.</p>\r\n\r\n<p>هذا القميص مُصنع من خامات عالية الجودة، مما يضمن تحقيق راحة فائقة أثناء ارتدائه. تتكوّن التفاصيل من نسيج ناعم وخفيف يشعر بانتعاش على جلدك، وهذا يُضفي شعورًا منعشًا طول فترة ارتداءه.</p>\r\n\r\n<p>إضافة إلى ذلك، فإن هذا القميص مُصمم بقصة ضيقة تبرز جسدك بشكل متناسق وجذاب. يعطي الأكمام الطويلة لهذا القميص مظهرًا أنيقًا وعصريًا، في حين يضفي الياقة المستديرة لمسة من التفرد والأناقة.</p>\r\n\r\n<p>بغض النظر عن المناسبة، ستجد هذا القميص مناسبًا للارتداء في أوقات مختلفة. يُعتبر قطعة أساسية في خزانتك، حيث يمكنك تنسيقه مع بنطال جينز لإطلالة كاجوال رائعة، أو مع سروال قماش وحذاء رسمي لإطلالة أكثر تألّقًا في المناسبات الخاصة.</p>\r\n\r\n<p>لا تضِفْ هذه الإضافة المثالية إلى مجموعتك من الملابس فحسب، بل احصل على قطعتك الآن وارتديها بثقة وأناقة.</p>', 'قميص كاجوال سادة للرجال ذو قصة ضيقة هو قميص أنيق وعصري، مُصمم لإضفاء إطلالة راقية وجذابة. يتميز بتفاصيله البسيطة وتناسقه الفائق، وهو مثالي للرجال الذين يبحثون عن الأناقة في الملابس الكاجوال.', NULL, NULL, NULL, NULL),
(234, 60, 5, 'قميص أبيض رسمي للرجال مع سروال رمادي', '<p>وصف قميص أبيض رسمي للرجال مع سروال رمادي</p>\r\n\r\n<h1>وصف قميص أبيض رسمي للرجال مع سروال رمادي</h1>\r\n\r\n<p>قميص الرجال الأبيض الرسمي هو قطعة أساسية في خزانة الملابس الرجالية. يتميز بتصميمه الكلاسيكي وأناقته التي تناسب المناسبات الرسمية والأحداث الخاصة.</p>\r\n\r\n<p>هذا القميص مصنوع من نسيج عالي الجودة يوفر شعورًا بالراحة طوال اليوم. يتكون من قطن ناعم وخفيف يتناسب مع جميع فصول السنة.</p>\r\n\r\n<p>تتمتع هذه القطعة بقَصَّةٍ مستقيمة تلائم جسدك بشكل مثالي، كما تحافظ على شكلها المستقيم والمناسب على مدار الاستخدام المتكرر وعمليات الغسيل.</p>\r\n\r\n<p>يُعَدّ هذا القميص مناسبًا للارتداء مع سروال رمادي. يتكون السروال من نسيج قوي ومتين، يضفي لمسة أناقة إلى المظهر العام. كما أن لونه الرمادي يتناسب تمامًا مع لون القميص الأبيض، مكملاً بشكل جميل التجانس في المظهر.</p>\r\n\r\n<p>إذا كُنتَ تبحث عن زِى رسمي يبرز أناقتك وأنت تحافظ في الوقت ذاته على شكل مهذب، فإن هذا القميص الأبيض الرسمي بالسروال الرمادي هو خيارك المثالي. احصل على هذه التجربة المدهشة ولاحظ كيف ستزداد ثقتك وجاذبِّيةُ شخصِّك.</p>', 'قميص أبيض رسمي للرجال مع سروال رمادي: تأتي هذه المجموعة الفاخرة من ملابس الرجال بقميص أبيض أنيق ورسمي بتصميمات فريدة، يتناسب تمامًا مع سروال رمادي مصنوع من قماش عالي الجودة. هذه الملابس الأنيقة ستكون خيارًا مثاليًا لأية مناسبة رسمية.', NULL, NULL, NULL, NULL);
INSERT INTO `product_description` (`id`, `product_id`, `language_id`, `name`, `description`, `short_description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(233, 60, 4, 'Men Formal White Shirt With Gray pant', '<p>Men Formal White Shirt</p>\r\n\r\n<h1>Men Formal White Shirt</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A men&#39;s formal white shirt is an essential piece of clothing for any gentleman&#39;s wardrobe. Made from high-quality, breathable fabric, this shirt offers a crisp and elegant look that is perfect for formal occasions, business meetings, or professional settings.</p>\r\n\r\n<p>The shirt features a classic design with a pointed collar and long sleeves. It is tailored to provide a comfortable and flattering fit, ensuring you look sharp and sophisticated throughout the day. The white color adds a touch of sophistication and versatility, making it easy to pair with various suits, ties, or accessories.</p>\r\n\r\n<p>The fabric used in this shirt is carefully selected to ensure maximum comfort and durability. It allows air circulation to keep you cool even during warmer weather while maintaining its shape and structure after multiple wears and washes.</p>\r\n\r\n<p>Whether you&#39;re attending a wedding, an important business meeting, or simply want to elevate your everyday office attire, this men&#39;s formal white shirt will never fail to impress. Its timeless design makes it suitable for any occasion where a smart and polished appearance is required.</p>\r\n\r\n<p>Invest in this reliable wardrobe staple that exudes confidence and professionalism. Combine it with well-tailored trousers or a suit jacket to complete your sophisticated ensemble.Men Formal White Shirt With Gray Pant</p>\r\n\r\n<h1>Men Formal White Shirt With Gray Pant</h1>\r\n\r\n<p>A men&#39;s formal white shirt with gray pants is a classic and sophisticated outfit choice for various formal occasions. This ensemble exudes elegance, professionalism, and style.</p>\r\n\r\n<h2>White Shirt</h2>\r\n\r\n<p>The white shirt is a staple in every man&#39;s wardrobe. It represents cleanliness, purity, and simplicity. Made from high-quality cotton or linen fabric, this formal shirt offers comfort and breathability. It features a pointed collar, long sleeves with buttoned cuffs, and a button-down front closure. The tailored fit enhances the wearer&#39;s silhouette, providing a polished look.</p>\r\n\r\n<h2>Gray Pants</h2>\r\n\r\n<p>The gray pants perfectly complement the white shirt, creating a balanced and sophisticated appearance. These trousers are typically made of wool or blended fabrics to ensure durability and comfort. The neutral gray color adds versatility to the outfit, allowing it to be paired with various colored shirts or jackets for different occasions.</p>\r\n\r\n<h2>Styling Options</h2>\r\n\r\n<p>This combination can be further enhanced by adding accessories such as a matching gray blazer or suit jacket for more formal events. A dark-colored tie can add an extra touch of refinement. Completing the look with black leather shoes will provide a smart finish.</p>\r\n\r\n<p>Whether attending business meetings, weddings, or other formal gatherings, this men&#39;s formal white shirt with gray pants ensemble is an excellent choice that ensures you look sharp and sophisticated while maintaining a professional demeanor.3</p>', 'This men\'s formal outfit features a crisp white shirt, exuding elegance and sophistication. Paired with tailored gray pants, it creates a polished and timeless look suitable for any formal occasion. The perfect combination of classic style and modern simplicity.', NULL, '\"Classic Men\'s Formal White Shirt - Timeless Elegance for Every Occasion\"', 'sic Men\'s Formal White Shirt - Timeless Elegance for Every Occasion\"', 'men\'s formal white shirt, classic white shirt, elegant dress shirt, refined men\'s fashion, business attire, wedding attire'),
(167, 61, 4, 'Men purple plain fancy shirt', '<p>Men&#39;s Purple Plain Fancy Shirt</p>\r\n\r\n<h1>Men&#39;s Purple Plain Fancy Shirt</h1>\r\n\r\n<p>This men&#39;s purple plain fancy shirt is a stylish and versatile addition to any wardrobe. Made from high-quality fabric, it offers both comfort and durability. The shirt features a classic design with a modern twist, making it suitable for various occasions.</p>\r\n\r\n<p>The vibrant shade of purple adds an element of sophistication and uniqueness to your outfit. Whether you&#39;re attending a formal event or simply want to stand out from the crowd, this shirt will surely make a statement. The plain pattern allows for easy pairing with different bottoms, such as trousers or jeans.</p>\r\n\r\n<p>The attention to detail in this shirt is evident through its fine craftsmanship. It has a tailored fit that accentuates the wearer&#39;s physique, providing a sleek and polished look. The button-down collar adds a touch of elegance, while the long sleeves can be rolled up for a more casual appearance.</p>\r\n\r\n<p>With its comfortable feel and fashionable design, this men&#39;s purple plain fancy shirt is perfect for both professional settings and social gatherings. It can be dressed up with a suit jacket or dressed down with chinos for a smart-casual ensemble. Whatever the occasion, this shirt guarantees style and confidence.</p>', 'This men\'s purple plain fancy shirt exudes elegance and style. Made from high-quality fabric, it features a classic collar and a comfortable fit. The rich color adds a touch of sophistication to any outfit. Perfect for formal occasions or a night out, this shirt is a must-have in every fashion-conscious man\'s wardrobe.', NULL, '\"Shop Stylish Men\'s Purple Plain Fancy Shirt - Trendy Fashionwear\"', 'Stylish Men\'s Purple Plain Fancy Shirt - Trendy Fashionwear\"', 'men\'s shirt, purple shirt, plain fancy shirt, stylish fashionwear, trendy shirt'),
(168, 61, 5, 'هذا هو القميص الهوى الأرجواني عادي', '<p>وصف قميص الهوى الأرجواني العادي</p>\r\n\r\n<h1>وصف قميص الهوى الأرجواني العادي</h1>\r\n\r\n<p>قميص الهوى الأرجواني هو قطعة ملابس عصرية وجذابة للغاية. يتميز باللون الأرجواني المشرق والذي يضفي جمالًا وحيوية على أي إطلالة. إنه قميص عادي بتصميم بسيط وعصري يناسب جميع الأذواق.</p>\r\n\r\n<p>تتكون هذه التصميم من نسيج عالي الجودة يضفي راحة فائقة على من يرتديه. كما أنه مثالي للاستخدام في فصل الصيف، حيث يساعد في تهوية جسدك وإبقائك منتعشًا طيلة النهار.</p>\r\n\r\n<p>إضافة إلى ذلك، فإن هذا القمیص مُزود بأزرار أمامیة لسھولة ارتداءھ وخلعھ. ويتميز بقَصة مريحة ومناسبة للجسم، ما يجعله قطعة أنيقة وعملية في الوقت نفسه.</p>\r\n\r\n<p>سواء كنت تخطط للذهاب إلى العمل أو التجول في المدينة أو حضور مناسبة خاصة، فإن هذا القمیص سیكون اختیارًا مثاليًا. يمكنك تنسيقه مع بنطال جینز أو شورت لإطلالة عفوية وعصرية، أو مع سروال رسمي لإطلالة أكثر رقيًا وأناقة.</p>\r\n\r\n<p>لا تفوت فرصة اقتناء هذا القمیص الأرجواني العادي لإضافته إلى خزانتك. سيرافقك في العديد من المناسبات وستشعر بالثقة والأناقة على حد سواء.</p>', 'قميص هوى أرجواني عادي وأنيق. يتميز بتصميمه البسيط ولونه الرائع، ما يجعله مناسبًا لأي مناسبة. مصنوع من خامات عالية الجودة تضمن راحة قصوى ومتانة طويلة الأمد. إضافة مثالية إلى خزانة ملابسك لإطلالة متألقة وأنيقة في كلّ الأوقات.', NULL, NULL, NULL, NULL),
(235, 62, 4, 'Fancy blue Shirt and pant', '<p>Fancy Blue Shirt and Pant</p>\r\n\r\n<h1>Fancy Blue Shirt and Pant</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>$49.99</p>\r\n\r\n<h2>Description:</h2>\r\n\r\n<p>Add a touch of elegance to your wardrobe with this fancy blue shirt and pant set. Made from high-quality materials, this ensemble offers both style and comfort. The shirt features a classic collar, full button-down front, and long sleeves with buttoned cuffs. It has a slim fit design that accentuates your physique while providing freedom of movement.</p>\r\n\r\n<h2>Care Instructions:</h2>\r\n\r\n<p>To maintain the quality and color of this outfit, we recommend washing it in cold water with similar colors. Avoid using bleach or harsh detergents. Hang dry or tumble dry on low heat for best results.</p>\r\n\r\n<h2>Size Guide:</h2>\r\n\r\n<p>Please refer to our size chart below to find the perfect fit for you:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Shipping Information:</h2>\r\n\r\n<p>We offer free shipping on all orders within the country. International shipping rates may vary depending on the destination.</p>', 'This stunning ensemble features a fancy blue shirt and pant combination that exudes sophistication and style. The elegant design is accentuated by the vibrant blue hue, creating a visually striking look suitable for any occasion. Crafted with utmost care, this outfit will make you stand out from the crowd in the most fashionable way.', NULL, '\"Stylish Fancy Blue Shirt and Pant Set for Men | Trendy Clothing Collection\"', 'ish Fancy Blue Shirt and Pant Set for Men | Trendy Clothing Collection\"', 'fancy blue shirt, blue pant, men\'s fashion, stylish clothing, trendy outfit, fashion statement'),
(236, 62, 5, 'قميص وسروال أزرق فاخر', '<p>قميص وسروال أزرق فاخر</p>\r\n\r\n<h1>قميص وسروال أزرق فاخر</h1>\r\n\r\n<p>هذا القميص والسروال الأزرق الفاخر هو قطعة ملابس رائعة للأشخاص الذين يبحثون عن المظهر الأنيق والجودة العالية. تم تصميم هذه المجموعة بعناية لتلبية احتياجاتك من حيث الأناقة والراحة.</p>\r\n\r\n<p>تتميز قطعة القميص بلونها الأزرق الجذاب، وهو لون يضفي جمالًا وانتعاشًا على مظهرك. يتم صُنع هذا القميص من خامات فائقة الجودة تضمن لك المتانة والشعور بالرفاهية على مدار الارتداء. كما أن التفصيل المُحكَم في التصميم يضفي لِباسًا مثاليًا ومظهرًا أنيقًا.</p>\r\n\r\n<p>أما السروال، فيتميز بقَصَّته العصرية ولونه المتناسق مع القميص. يوفر لك هذا السروال الراحة التامة وحرية الحركة بفضل استخدام خامات عالية الجودة تضمن لك المرونة والانسيابية. كما يُضفي تصميمه الأنيق جاذبية إلى مظهرك.</p>\r\n\r\n<p>هذه المجموعة من قميص وسروال أزرق فاخر مناسبة للعديد من المناسبات، سواء كانت رسمية أو غير رسمية، حيث يُضفي طابعًا أنيقًا وجذابًا على إطلالتك. احصل على هذه القطعة الفخمة وأضف لِباسًا رائعًا إلى خزانتك.</p>', 'قميص وسروال أزرق فاخر هو طقم ملابس رجالي يتألف من قميص بلون أزرق جميل وسروال بتصميم أنيق. مصنوع من خامات عالية الجودة لضمان الراحة والأناقة. مثالي للحفلات والمناسبات الخاصة، يضفي طابعًا راقيًا على إطلالتك.', NULL, NULL, NULL, NULL),
(153, 63, 4, 'Men Slim Fit Checkered Cut Away Collar Casual Shirt', '<p>Men Slim Fit Checkered Cut Away Collar Casual Shirt</p>\r\n\r\n<h1>Men Slim Fit Checkered Cut Away Collar Casual Shirt</h1>\r\n\r\n<p>The Men Slim Fit Checkered Cut Away Collar Casual Shirt is a stylish and trendy shirt designed for fashion-forward men. Made with high-quality fabric, this shirt offers both comfort and style, making it perfect for casual occasions or even semi-formal events.</p>\r\n\r\n<p>The slim fit design of this shirt ensures a flattering and modern silhouette, enhancing your overall appearance. The checkered pattern adds a touch of sophistication and elegance to the shirt, making it suitable for various occasions. Whether you&#39;re going out with friends or attending a casual office meeting, this shirt will make you stand out from the crowd.</p>\r\n\r\n<p>The cut away collar of this shirt adds a contemporary twist to the classic button-down collar style. It gives a more open and relaxed look while maintaining professionalism. The collar can be easily paired with ties or left open for a more laid-back vibe.</p>\r\n\r\n<p>With its versatile design, this casual shirt can be paired with jeans, chinos, or dress pants depending on the occasion and personal style. It is available in different sizes to ensure the perfect fit for every man.</p>\r\n\r\n<p>Elevate your wardrobe with the Men Slim Fit Checkered Cut Away Collar Casual Shirt and make a statement wherever you go!5</p>', 'This men\'s slim fit checkered cut away collar casual shirt is a trendy and fashionable choice for any occasion. Made with high-quality fabric, the shirt offers a sleek and modern look. With its comfortable fit and stylish design, it adds a touch of sophistication to any outfit while keeping you effortlessly stylish.', NULL, '\"Men\'s Slim Fit Checkered Cut Away Collar Casual Shirt - Stylish and Comfortable\"', 's Slim Fit Checkered Cut Away Collar Casual Shirt - Stylish and Comfortable\"', 'men\'s clothing, slim fit shirt, checkered pattern, cut away collar, casual wear, stylish shirts, comfortable shirts'),
(154, 63, 5, 'قميص رجالي ذو قصة ضيقة وياقة مربعة', '<p>قميص رجالي ذو قصة ضيقة وياقة مربعة هو اختيار مثالي للرجل العصري. مصنوع من أجود الأقمشة، يتميز بتفاصيله الأنيقة والعصرية. يضفي هذا القميص لمسة من التميز والأناقة على إطلالتك دون التخلي عن الراحة والأناقة.</p>', 'قميص رجالي ذو قصة ضيقة وياقة مربعة هو اختيار مثالي للرجل العصري. مصنوع من أجود الأقمشة، يتميز بتفاصيله الأنيقة والعصرية. يضفي هذا القميص لمسة من التميز والأناقة على إطلالتك دون التخلي عن الراحة والأناقة.', NULL, NULL, NULL, NULL),
(263, 64, 10, 'Puma  Training & Gym Shoes For -estonia', '<p>Puma &nbsp;Training &amp; Gym Shoes For -estonia</p>', 'Puma  Training & Gym Shoes For -estonia', NULL, 'Puma  Training & Gym Shoes For -estonia -metatitle', 'Puma  Training & Gym Shoes For -estonia -metatitle', 'Puma  Training & Gym Shoes For -estonia -metatitle'),
(262, 64, 4, 'Puma  Training & Gym Shoes For', '<p>White Puma Shoes</p>\r\n\r\n<h1>White Puma Shoes</h1>\r\n\r\n<p>The White Puma Shoes are a stylish and trendy choice for both men and women. Made with high-quality materials, these shoes offer comfort, durability, and a fashionable look that can elevate any outfit.</p>\r\n\r\n<p>The white color of these shoes adds a touch of elegance and sophistication to your overall appearance. Whether you&#39;re going for a casual or sporty look, these shoes are versatile enough to complement various styles. The clean white design also makes them easy to pair with different clothing options.</p>\r\n\r\n<p>Puma is known for its commitment to quality and innovation, and these shoes are no exception. They feature a cushioned insole that provides excellent support and comfort throughout the day. The rubber outsole offers good traction, ensuring stability on different surfaces.</p>\r\n\r\n<p>These shoes are not only stylish but also practical. They have a lace-up closure system that allows you to adjust the fit according to your preference. The breathable upper material keeps your feet cool and dry even during intense activities.</p>\r\n\r\n<p>Whether you&#39;re hitting the gym, going for a run, or simply running errands, the White Puma Shoes are an excellent choice. With their sleek design, superior comfort, and reliable performance, they will surely become your go-to footwear option.</p>', 'The classic white Puma shoes exude timeless style and versatility. Crafted with high-quality materials, these sleek sneakers provide both comfort and durability. The clean white color effortlessly complements any outfit, making them the perfect choice for every occasion. Elevate your wardrobe with these iconic footwear staples.', NULL, '\"Shop Stylish White Puma Shoes for Men and Women at Competitive Prices\"', 'Stylish White Puma Shoes for Men and Women at Competitive Prices\"', 'white puma shoes, stylish sneakers, men\'s white shoes, women\'s white shoes, trendy footwear, comfortable athletic shoes'),
(157, 65, 4, 'Dwane Running Shoes For Men', '<p>Dwane Running Shoes For Men</p>\r\n\r\n<h1>Dwane Running Shoes For Men</h1>\r\n\r\n<p>The Dwane Running Shoes for Men are designed to provide exceptional comfort, support, and performance during your running sessions. These shoes are specifically crafted for men who are passionate about running and strive to achieve their best performance on the track or road.</p>\r\n\r\n<p>Featuring a sleek and modern design, these running shoes combine style with functionality. The upper part of the shoe is made from high-quality breathable material that allows air circulation to keep your feet cool and dry throughout your run. The lightweight construction ensures minimal weight on your feet, allowing you to move effortlessly.</p>\r\n\r\n<p>The cushioned insole provides excellent shock absorption, reducing the impact on your joints and preventing discomfort or injury. The durable outsole offers superior traction on various surfaces, providing stability and grip even in wet conditions.</p>\r\n\r\n<p>With a lace-up closure system, these shoes can be easily adjusted to fit your feet securely. The padded collar and tongue add extra comfort, while the reinforced toe cap enhances durability.</p>\r\n\r\n<p>Whether you&#39;re a professional athlete or an occasional runner, the Dwane Running Shoes for Men will become your go-to choice for all your running needs. Experience the perfect blend of style, comfort, and performance with these outstanding running shoes.0</p>', 'The Dwane Running Shoes for Men offer the perfect combination of comfort and style. With their lightweight design and cushioned soles, these shoes are ideal for long-distance running or everyday workouts. Made with durable materials, they provide excellent support and stability. Stay ahead of the game with these sleek and functional running shoes.', NULL, '\"Dwane Running Shoes for Men - Lightweight and Durable Footwear for Active Performance\"', 'e Running Shoes for Men - Lightweight and Durable Footwear for Active Performance\"', '\"running shoes for men, men\'s athletic footwear, lightweight running shoes, durable sports shoes, performance running sneakers, breathable trainers, comfortable jogging shoes\"'),
(158, 65, 5, 'دوان حذاء الجري للرجال', '<p>وصف حذاء الجري للرجال</p>\r\n\r\n<h1>دوان حذاء الجري للرجال</h1>\r\n\r\n<p>حذاء الجري للرجال من دوان هو حذاء مصمم خصيصًا لتلبية احتياجات راكضي الطرق والمسارات المختلفة. يعد هذا الحذاء مثاليًا للأشخاص الذين يهتمون باللياقة البدنية ويرغبون في تعزيز أدائهم أثناء ممارسة رياضة الجري.</p>\r\n\r\n<p>تتميز هذه الأحذية بتصميم عصري وأنيق، مع تفاصيل جودة عالية تضمن راحة قدمك أثناء التحرك. تستخدم شبكة علوية مسامية تسمح بتهوية جيدة للقدم وتقليل التعرق المفرط. كما يحتوي على نعل داخلي مبطّن يوفر تبطينًا إضافيًا ودعمًا للقوس القدم لتقليل التعب والإجهاد أثناء الجري.</p>\r\n\r\n<p>تم تصميم نعل الحذاء بتقنية متقدمة لامتصاص الصدمات، حيث يساعد على تخفيف ضغط الأرض وحماية المفاصل من التأثيرات الضارة. كما يوفر نعل مطاطي قوي ثباتًا وثباتًا أثناء الجري على مختلف الأسطح.</p>\r\n\r\n<p>هذا الحذاء متوفر بعدة أحجام وألوان مختلفة، مما يسمح لك باختيار الزوج المناسب وفقًا لذوقك. سواء كنت تستخدمه للجري في المدينة أو في المسارات خارج المدينة، فإن حذاء دوان سيرافقك في رحلتك نحو صحة أفضل وأداء رائع في رياضة الجري.</p>', 'حذاء الجري للرجال من دوان هو اختيار ممتاز لعشاق الرياضة ومحبي الركض. يتميز بتقنية متطورة لامتصاص الصدمات ودعم فائق للقدم، مما يوفر تجربة رائعة ومريحة أثناء التدريب. بالإضافة إلى ذلك، فإن تصميمه المزخرف يضفي جاذبية إلى مظهرك العام أثناء ارتدائه.', NULL, NULL, NULL, NULL),
(237, 66, 4, 'Hustle V2 Sneakers For Men  (Blue)', '<p>Hustle V2 Sneakers For Men (Blue)</p>\r\n\r\n<h1>Hustle V2 Sneakers For Men (Blue)</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Hustle V2 Sneakers for Men in Blue are the perfect combination of style and comfort. These sneakers are designed to elevate your fashion game while providing maximum comfort for your feet.</p>\r\n\r\n<p>Featuring a sleek blue colorway, these sneakers are crafted with high-quality materials to ensure durability and long-lasting performance. The upper is made from a breathable mesh fabric that allows air circulation, keeping your feet cool and dry even during intense activities.</p>\r\n\r\n<p>The lightweight design of these sneakers makes them ideal for everyday wear or athletic activities. The cushioned insole provides excellent support and shock absorption, reducing the impact on your joints and preventing discomfort or fatigue.</p>\r\n\r\n<p>The Hustle V2 Sneakers also feature a non-slip rubber outsole that offers superior traction on various surfaces, ensuring stability and preventing slips or falls. Whether you&#39;re running errands, hitting the gym, or going out with friends, these sneakers will keep you looking stylish without compromising on functionality.</p>\r\n\r\n<p>With their trendy design and exceptional performance, the Hustle V2 Sneakers for Men in Blue are a must-have addition to any sneaker collection. Upgrade your footwear game today!e</p>', 'Introducing the Hustle V2 Sneakers for Men in a sleek blue hue. These stylish kicks are designed to provide maximum comfort and support while keeping you at the forefront of fashion. With their trendy design and durable construction, they are perfect for those who live life on the go.', NULL, '\"Hustle V2 Sneakers For Men (Blue) - Stylish and Comfortable Footwear for Active Men\"', 'le V2 Sneakers For Men (Blue) - Stylish and Comfortable Footwear for Active Men\"', '\"Hustle V2, sneakers, men\'s shoes, blue sneakers, stylish footwear, comfortable shoes, active men\'s footwear\"'),
(238, 66, 5, 'حذاء رياضي هاسل V2 للرجال (أزرق)', '<p>وصف حذاء رياضي هاسل V2 للرجال (أزرق)</p>\r\n\r\n<h1>حذاء رياضي هاسل V2 للرجال (أزرق)</h1>\r\n\r\n<p><img alt=\"حذاء رياضي هاسل V2\" src=\"حذاء-هاسل-V2.jpg\" /></p>\r\n\r\n<p>تعد ماركة هاسل واحدة من أبرز العلامات التجارية في عالم الأحذية الرياضية، وتقدم حذاء رياضي هاسل V2 للرجال بتصميمه المبتكر وجودته العالية.</p>\r\n\r\n<p>صُنع الحذاء من مواد عالية الجودة تضمن المتانة والراحة أثناء ممارسة التمارين الرياضية. يتميز بجزء علوي مصنوع من النسيج المتين باللون الأزرق، مع تفاصيل جذابة تعطيه شكلاً عصريًا.</p>\r\n\r\n<p>وفِّر لقدمك دعمًا ممتازًا وثباتًا مع نعله المصمم بتقنية متقدمة توفر الامتصاص الصدمات والثبات على الأرض. كما يحتوي على نظام إغلاق برباط للحفاظ على ثبات الحذاء أثناء الحركة.</p>\r\n\r\n<p>يعد حذاء هاسل V2 مناسبًا لجميع أنواع التمارين الرياضية، سواء كانت رياضة المشي أو التدريب في صالة الألعاب الرياضية. كما يُعَدُّ خيارًا رائعًا للاستخدام اليومي بفضل تصميمه الأنيق والجودة التي يتمتع بها.</p>\r\n\r\n<p>لا تفوِّت فرصة اقتناء حذاء رياضي هاسل V2 للرجال (أزرق) وانطلق في مغامراتك الرياضية بثقة وأناقة.</p>', 'حذاء رياضي هاسل V2 للرجال (أزرق) هو حذاء عصري ومريح للنشاطات الرياضية. يتميز بتصميمه الجذاب باللون الأزرق، وبطانته المبطنة التي توفر راحة قدم مثالية. يعد هذا الحذاء اختيارًا مثاليًا لأولئك الذين يبحثون عن أداء ممتاز وأسلوب رائع في آن واحد.', NULL, NULL, NULL, NULL),
(163, 67, 4, 'Appple Smart  Watch', '<p>Apple Smart Watch</p>\r\n\r\n<h1>Apple Smart Watch</h1>\r\n\r\n<p>The Apple Smart Watch is a revolutionary wearable device that combines the functionality of a traditional watch with the power and convenience of a smartphone. Designed and developed by Apple Inc., this smartwatch offers a wide range of features and capabilities to enhance your daily life.</p>\r\n\r\n<p>With its sleek and stylish design, the Apple Smart Watch is not only a timepiece but also a personal assistant on your wrist. It allows you to receive notifications, make calls, send messages, track your fitness activities, monitor your heart rate, and much more.</p>\r\n\r\n<p>The watch&#39;s Retina display provides crisp and clear visuals, making it easy to read texts or view images. Its touchscreen interface is intuitive and responsive, allowing for smooth navigation through various apps and functions.</p>\r\n\r\n<p>One of the standout features of the Apple Smart Watch is its ability to integrate seamlessly with other Apple devices. You can use it to control music playback on your iPhone or stream content from your Apple TV. It also supports Siri voice commands for hands-free operation.</p>\r\n\r\n<p>In addition, the watch comes with various health and fitness tracking features such as an accelerometer, gyroscope, and GPS. It can monitor your steps taken, calories burned, distance traveled, as well as provide insights into your sleep patterns.</p>\r\n\r\n<p>Overall, the Apple Smart Watch is not just a fashion statement but also a powerful companion that keeps you connected and informed throughout the day. Whether you&#39;re managing appointments or staying active, this smartwatch offers convenience and functionality in one elegant package.</p>', 'The Apple Smart Watch is a sleek and stylish wearable device that not only tells you the time but also tracks your health and fitness activities. It allows you to make calls, send messages, and even play music directly from your wrist. Stay connected and make the most of your day with this innovative accessory.', NULL, '\"Apple Smart Watch - Stay Connected and Stylish\"', 'e Smart Watch - Stay Connected and Stylish\"', '\"Apple Smart Watch, smartwatch, technology, fashion, connectivity, fitness tracking, personalized notifications\"'),
(164, 67, 5, 'تطبيق ساعة ذكية', '<p>تطبيق ساعة ذكية</p>\r\n\r\n<h1>تطبيق ساعة ذكية</h1>\r\n\r\n<p>تطبيق ساعة ذكية هو تطبيق متنقل يهدف إلى تحسين وتسهيل حياة المستخدم من خلال الاتصال بجهاز الساعة الذكية. يوفر التطبيق مجموعة من المميزات والوظائف التي تجعل استخدام الساعة الذكية أكثر فائدة وراحة.</p>\r\n\r\n<h2>مميزات التطبيق:</h2>\r\n\r\n<ul>\r\n	<li>إشعارات متقدمة: يتلقى المستخدم إشعارات فورية على الساعة الذكية للرسائل والمكالمات والأحداث المهمة، مثل المواعيد والتذكيرات، مما يسهل على المستخدم البقاء على اطلاع دون الحاجة إلى استخدام هاتفه.</li>\r\n	<li>مراقبة الصحة واللياقة البدنية: يتمكن المستخدم من تتبع نشاطه البدني، مثل عدد الخطوات والسعرات الحرارية المحروقة وضغط الدم ومعدل ضربات القلب، كما يوفر تطبيق ساعة ذكية إشعارات لتذكير المستخدم بأهمية ممارسة التمارين والحفاظ على لياقته.</li>\r\n	<li>إدارة الوقت: يحتوي التطبيق على مؤقت وساعة منبه تساعد المستخدم في إدارة وتنظيم أوقاته بشكل فعّال.</li>\r\n	<li>تخصيص: يسمح التطبيق للمستخدم بتخصيص شكل وواجهة ساعته الذكية حسب احتياجاته وذوقه الشخصي.</li>\r\n</ul>\r\n\r\n<p>إذا كنت ترغب في جعل استخدام ساعتك الذكية أكثر فائدة وسلاسة، فإن تطبيق ساعة ذكية هو الحل المثالي لك. قم بتنزيل التطبيق الآن واستمتع بالتجربة الفريدة والمميزة للساعة الذكية.</p>', 'تطبيق ساعة ذكية هو تطبيق مصمم للتحكم والتفاعل مع الساعات الذكية. يوفر العديد من المزايا مثل استقبال التنبيهات والإشعارات، قياس نشاطك البدني ومراقبة صحتك، التحكم في الموسيقى والتطبيقات، وغيرها. يجعل حياتك أكثر راحة وفعالية بفضل تقنية الساعة الذكية', NULL, NULL, NULL, NULL),
(165, 68, 4, 'Samsung White Smart Watch', '<p>Samsung White Smart Watch</p>\r\n\r\n<h1>Samsung White Smart Watch</h1>\r\n\r\n<p>The Samsung White Smart Watch is a sleek and stylish wearable device that combines functionality with fashion. This smartwatch offers a range of features and capabilities to enhance your daily life.</p>\r\n\r\n<p>With its white color scheme, the Samsung White Smart Watch stands out as a fashionable accessory that can complement any outfit or style. The watch face is made from durable materials, ensuring long-lasting use and resistance to wear and tear.</p>\r\n\r\n<p>Equipped with advanced technology, this smartwatch allows you to receive notifications from your smartphone directly on your wrist. You can stay connected without constantly checking your phone, whether it&#39;s receiving calls, messages, or social media updates.</p>\r\n\r\n<p>In addition to its connectivity features, the Samsung White Smart Watch also offers health and fitness tracking capabilities. It can monitor your heart rate, track your steps and calories burned, and even provide guided breathing exercises for stress relief.</p>\r\n\r\n<p>The touch screen display provides an intuitive user interface for easy navigation through various apps and functions. You can customize the watch face to suit your personal preferences and choose from a variety of pre-installed watch faces or download additional ones from the app store.</p>\r\n\r\n<p>With its long battery life, you can enjoy using the Samsung White Smart Watch throughout the day without worrying about frequent recharging. It is also water-resistant, allowing you to wear it during workouts or outdoor activities without concerns about damage.</p>\r\n\r\n<p>Overall, the Samsung White Smart Watch offers a blend of style and functionality that makes it an excellent choice for anyone looking for a versatile smartwatch experience.</p>', 'The Samsung White Smart Watch is a sleek and stylish accessory that offers ultimate convenience and connectivity. With its vibrant touchscreen display, it allows you to make calls, send messages, track your fitness activities, and seamlessly integrate with your smartphone for a truly smart and efficient lifestyle.', NULL, 'Samsung White Smart Watch | Stylish and Functional Wearable Tech', 'ng White Smart Watch | Stylish and Functional Wearable Tech', 'Samsung White Smart Watch, wearable tech, fitness tracking, notifications, customizable watch faces'),
(166, 68, 5, 'ساعة سامسونج البيضاء الذكية', '<p>وصف ساعة سامسونج البيضاء الذكية</p>\r\n\r\n<h1>ساعة سامسونج البيضاء الذكية</h1>\r\n\r\n<p>تُعد ساعة سامسونج البيضاء الذكية من أحدث التقنيات المتطورة في عالم الأجهزة المحمولة. تأتي هذه الساعة بتصميم أنيق وأنبوب مراقبة دائري يعزز جمالها وأناقتها. توفر للمستخدم إمكانية رصد وإدارة صحته ولياقته بشكل شامل.</p>\r\n\r\n<p>تحتوي ساعة سامسونج البيضاء على مجموعة كبيرة من المزايا والخصائص التقنية، مثل:</p>\r\n\r\n<ul>\r\n	<li>شاشة AMOLED عالية الدقة تعرض المعلومات بشكل واضح وحاد.</li>\r\n	<li>إمكانية قياس معدل ضربات القلب لرصد نشاطات اللياقة البدنية.</li>\r\n	<li>مقاومة للماء والغبار، مما يسمح بارتدائها أثناء ممارسة الرياضة أو تحت الأحوال الجوية المتعرجة.</li>\r\n	<li>إشعارات ذكية للرسائل والمكالمات والتطبيقات، مع إمكانية التحكم فيها من المعصم.</li>\r\n	<li>تطبيقات مخصصة لتتبع النشاط البدني وإدارة النوم والتغذية، للحفاظ على نظام حياة صحي.</li>\r\n</ul>\r\n\r\n<p>بفضل هذه المزايا، تُعد ساعة سامسونج البيضاء الذكية رفيقًا مثاليًا لأولئك الذين يهتمون بصحتهم ويرغبون في تحسين نمط حياتهم. فهي توفر جميع المعلومات والأدوات التي يحتاجها المستخدم للحفاظ على صحة جسده وروحه.</p>', 'ساعة سامسونج البيضاء الذكية هي ساعة ذكية عصرية تتميز بتصميم أنيق باللون الأبيض. توفر للمستخدم مجموعة واسعة من المميزات مثل مراقبة نشاط اللياقة البدنية وإشعارات المكالمات والرسائل، إلى جانب إمكانية تخصيص وتغيير شكلها بحسب اختيار المستخدم.', NULL, NULL, NULL, NULL),
(241, 5, 4, 'Men Regular Fit Solid Formal Shirt', '<p>Men Regular Fit Solid Formal Shirt</p>\r\n\r\n<h1>Men Regular Fit Solid Formal Shirt</h1>\r\n\r\n<p>The Men Regular Fit Solid Formal Shirt is a classic and timeless piece that every man should have in his wardrobe. This formal shirt is designed to provide a comfortable fit while maintaining a professional and polished look.</p>\r\n\r\n<p>The shirt is made from high-quality fabric that ensures durability and longevity. The solid color adds sophistication and versatility, making it suitable for various formal occasions such as business meetings, interviews, weddings, or any other special event where a dress code is required.</p>\r\n\r\n<p>The regular fit of this shirt allows for ease of movement without compromising on style. It features long sleeves with buttoned cuffs, a pointed collar, and a full button-down front. The shirt also has a chest pocket which adds functionality and convenience.</p>\r\n\r\n<p>Whether paired with dress pants or tailored trousers, this formal shirt effortlessly elevates any outfit. It can be worn alone or layered under a blazer or suit jacket for an even more refined look.</p>\r\n\r\n<p>Care instructions: Machine washable for easy maintenance. Iron on low heat if needed.</p>\r\n\r\n<p>Add the Men Regular Fit Solid Formal Shirt to your collection today and experience the perfect combination of comfort, style, and professionalism.</p>', 'This men\'s regular fit solid formal shirt is a versatile addition to any wardrobe. Made from high-quality fabric, it offers a comfortable and stylish fit. With its classic design and solid color, it can be easily paired with dress pants or jeans for a polished and professional look.', NULL, 'Men Regular Fit Solid Formal Shirt - Classic Style for Sophisticated Professionals', NULL, 'men\'s formal shirt, regular fit shirt, solid color shirt, professional attire, classic style'),
(256, 58, 4, 'DELL Core i3 11th Gen - (8 GB/256 GB SSD/32 GB EMMC Storage/Ubuntu)', '<p>DELL Core i3 11th Gen - (8 GB/256 GB SSD/32 GB EMMC Storage/Ubuntu)</p>\r\n\r\n<h1>DELL Core i3 11th Gen - (8 GB/256 GB SSD/32 GB EMMC Storage/Ubuntu)</h1>\r\n\r\n<p>The DELL Core i3 11th Gen is a powerful laptop that combines efficient performance with reliable storage options. It features an Intel Core i3 11th generation processor, which provides fast and responsive computing for everyday tasks. With its 8 GB RAM, this laptop ensures smooth multitasking and allows you to run multiple applications simultaneously without any lag or slowdown. This laptop comes with a dual storage system, including a 256 GB SSD and a 32 GB EMMC storage. The SSD offers faster boot-up times and quick access to your files, while the EMMC storage provides additional space for storing documents, media files, and other data. Running on Ubuntu operating system, this laptop offers a user-friendly interface and a wide range of software compatibility. Ubuntu is known for its stability, security, and ease of use, making it an ideal choice for both beginners and experienced users. The DELL Core i3 11th Gen also features a sleek design with a compact form factor, making it easy to carry around. Its high-definition display delivers vibrant visuals with sharp details and accurate colors. Overall, the DELL Core i3 11th Gen is a versatile laptop that offers reliable performance, ample storage options, and an intuitive operating system. Whether you need it for work or entertainment purposes, this laptop can handle your daily computing needs efficiently.</p>', 'The DELL Core i3 11th Gen laptop offers seamless performance and efficiency with its powerful Intel Core i3 processor. It comes with ample storage options of 8 GB RAM, 256 GB SSD, and 32 GB EMMC Storage for faster boot-up times and smooth multitasking. Pre-installed with Ubuntu for enhanced security and user-friendly interface.', NULL, 'DELL Core i3 11th Gen - (8 GB/256 GB SSD/32 GB EMMC Storage/Ubuntu) | Fast Performance & Efficient Storage', 'Core i3 11th Gen - (8 GB/256 GB SSD/32 GB EMMC Storage/Ubuntu) | Fast Performance & Efficient Storage', 'DELL Core i3 11th Gen, laptop, 8 GB RAM, 256 GB SSD, 32 GB EMMC storage, Ubuntu operating system, fast performance, efficient storage'),
(257, 58, 5, 'DELL Core i3 11th Gen - (8 GB / 256 GB SSD / 32 GB EMMC Storage / Ubuntu)', '<p>وصف لابتوب DELL Core i3 الجيل الحادي عشر</p>\r\n\r\n<h1>وصف لابتوب DELL Core i3 الجيل الحادي عشر</h1>\r\n\r\n<p>لابتوب DELL Core i3 الجيل الحادي عشر هو جهاز كمبيوتر محمول قوي ومتعدد الاستخدامات يناسب احتياجاتك اليومية والأعمال المكتبية. يأتي هذا اللابتوب بمعالج Intel Core i3 من الجيل الحادي عشر، مما يضمن أداءً سلسًا وسرعة استجابة فائقة.</p>\r\n\r\n<p>هذا اللابتوب مزود بذاكرة وصول عشوائي سعة 8 جيجابايت، مما يسهّل تشغيل التطبيقات المختلفة والعديد من المهام في نفس الوقت بكفاءة. كما أنه يحتوي على ذاكرة داخلية SSD سعة 256 جيجابايت لتخزين البيانات والملفات بشكل آمن وسرعة نقل عالية.</p>\r\n\r\n<p>بالإضافة إلى ذلك، يحتوي هذا اللابتوب على تخزين EMMC سعة 32 جيجابايت، مما يسهّل حفظ المستندات والصور والفيديوهات الخاصة بك. يأتي مع نظام التشغيل Ubuntu المثبت مسبقًا، مما يوفر لك أداءً قويًا وأمانًا في استخدام البرامج والأدوات المختلفة.</p>\r\n\r\n<p>شاشة هذا اللابتوب بحجم (حجم الشاشة) إنش تعرض صورًا وألوانًا حادة، مما يُسهِّل عليك استعراض المحتوى بطريقة رائعة. كما أنه مزود بمنافذ USB و HDMI لتوصيل الأجهزة الإضافية بسهولة.</p>\r\n\r\n<p>بفضل تصميمه المحمول وخفة وزنه، يُعَدُّ هذا اللابتوب رفيقًا مثاليًا للعمل والدراسة أثناء التنقل. يوفر بطارية طويلة الأمد تصل إلى (عدد ساعات البطارية) ساعة من الاستخدام المتواصل، مما يضمن لك عمر بطارية طويل وتجربة استخدام مريحة.</p>', 'ديل كور i3 الجيل الحادي عشر - (8 جيجابايت / 256 جيجابايت SSD / 32 جيجابايت EMMC تخزين / أوبونتو)\r\nالكمبيوتر المحمول من ديل يأتي بمعالج Core i3 من الجيل الحادي عشر، وذاكرة وصول عشوائي بسعة 8 جيجابايت، وسعة تخزين SSD بسعة 256 جيجابايت و32 جيجابايت EMMC. يدعم نظام التشغيل أوبونتو، مثالي للأعمال المكتبية والاستخدام العام.', NULL, NULL, NULL, NULL),
(252, 69, 5, 'test', '<p>test</p>', 'testtest', NULL, NULL, NULL, NULL),
(253, 69, 7, 'test', '<p>test</p>', 'test', NULL, NULL, NULL, NULL),
(254, 69, 8, 'test', '<p>test</p>', 'test', NULL, NULL, NULL, NULL),
(255, 69, 9, 'test', '<p>test</p>', 'test', NULL, NULL, NULL, NULL),
(259, 70, 5, 'testee', '<p>testee</p>', 'testee', NULL, NULL, NULL, NULL),
(271, 71, 5, 'Product Tax - arabic', '<p>Product Tax - arabic</p>', 'Product Tax - arabic', NULL, NULL, NULL, NULL),
(270, 71, 4, 'Product Tax', '<p>Product Tax</p>', 'Product Tax', NULL, 'Product Tax', 'Product Tax', 'Product Tax');

-- --------------------------------------------------------

--
-- Table structure for table `product_discount`
--

DROP TABLE IF EXISTS `product_discount`;
CREATE TABLE IF NOT EXISTS `product_discount` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `sort_order_discount` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_filter`
--

DROP TABLE IF EXISTS `product_filter`;
CREATE TABLE IF NOT EXISTS `product_filter` (
  `product_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order_image` int(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image`, `sort_order_image`) VALUES
(1, 1, '1687953836david-svihovec-HM-Y497t5CU-unsplash-removebg-preview.png', 1),
(2, 4, '1687963375image 14.png', 1),
(3, 4, '1687963375image 13.png', 2),
(4, 5, '168796400217-dress-shirt-png-image 1 (1).png', NULL),
(5, 6, '1687964260image 14.png', 1),
(6, 6, '1687964260valerie-elash-gsKdPcIyeGg-unsplash-removebg-preview.png', 2),
(11, 9, '168797984132767-2-axe-spray-transparent-background 1 (1).png', 1),
(9, 8, '168797966327-running-shoes-png-image 1.png', 1),
(10, 8, '1687979663image 15.png', 2),
(12, 10, '1687980037image 13.png', 1),
(13, 10, '1687980037valerie-elash-gsKdPcIyeGg-unsplash-removebg-preview.png', 2),
(14, 14, '1687981308Product_05.png', 1),
(15, 15, '1687981497image 22.png', 1),
(16, 15, '1687981497image 24.png', 2),
(17, 15, '1687981497image 25.png', 3),
(18, 16, '1688031363image 20.png', 1),
(19, 16, '1688031363image 27.png', 2),
(20, 17, '1688031671image 19.png', 1),
(21, 17, '1688031671image 22.png', 2),
(22, 18, '1688032101image 25.png', 1),
(23, 18, '1688032101image 26.png', 2),
(24, 18, '1688032101image 27.png', 3),
(25, 20, '1688033137artem-riasnianskyi-lYnGCjTCRj4-unsplash-removebg-preview.png', 1),
(26, 21, '1688033573hardik-sharma-CrPAvN29Nhs-unsplash-removebg-preview.png', 1),
(27, 21, '16880335731671512121lRuUIAq3hICthU8C.jpeg', 2),
(28, 22, '1688034061travel.png', 1),
(29, 23, '1688036076pexels-luis-zambrano-16438724-removebg-preview.png', NULL),
(30, 26, '168803666932-running-shoes-png-image 1 (1).png', 1),
(31, 31, '1688040442image 25.png', 1),
(32, 31, '1688040442image 24.png', 2),
(33, 31, '1688040442image 23 (1).png', 3),
(34, 34, '168826361011542954_12608-removebg-preview.png', 1),
(35, 34, '16882636106208024_3215461-removebg-preview.png', 2),
(36, 35, '16882639131386068_OYHKDO0-removebg-preview.png', 2),
(37, 35, '16882639131162384_ORH9DV0-removebg-preview.png', 1),
(38, 35, '1688263913francesco-de-tommaso-1bBCtUAUMFI-unsplash-removebg-preview.png', 3),
(39, 36, '16882641401162384_ORH9DV0-removebg-preview.png', 1),
(40, 36, '1688264140smartphone-balancing-with-pink-background-removebg-preview.png', 2),
(41, 37, '16882645521386068_OYHKDO0-removebg-preview.png', 1),
(42, 37, '1688264552smartphone-balancing-with-pink-background-removebg-preview.png', 2),
(43, 37, '16882645526208024_3215461-removebg-preview.png', 3),
(44, 37, '168826455311542954_12608-removebg-preview.png', 1),
(45, 38, '1688264810white-baby-clothes-pink-background-copy-space-removebg-preview.png', 1),
(46, 39, '1688264972interior-kids-room-decoration-with-clothes-removebg-preview.png', 1),
(47, 41, '1688265499beautiful-men-fashion-with-leather-messenger-bag-removebg-preview.png', 1),
(48, 42, '16882668661162308_ORH7W20-removebg-preview.png', 1),
(49, 43, '1688267049Product_24.jpg', 1),
(50, 44, '1688267364photo-camera-balancing-with-yellow-background-removebg-preview.png', 1),
(51, 44, '16882673643947903_13130-removebg-preview.png', 2),
(52, 45, '1688267715camera-equipment-capturing-single-macro-object-generative-ai-removebg-preview.png', 1),
(53, 45, '1688267715photo-camera-balancing-with-yellow-background-removebg-preview.png', 2),
(54, 46, '1688267882camera-equipment-capturing-single-macro-object-generative-ai-removebg-preview.png', 1),
(55, 46, '16882678823947903_13130-removebg-preview.png', 2),
(56, 47, '1688268068fashion-woman-with-clothes-removebg-preview.png', 1),
(57, 47, '1688268068valerie-elash-gsKdPcIyeGg-unsplash-removebg-preview.png', 2),
(58, 48, '1688268280valerie-elash-gsKdPcIyeGg-unsplash-removebg-preview.png', 1),
(59, 48, '1688268280image 14.png', 2),
(60, 48, '1688268280beautiful-fashion-woman-purple-long-dress-hairstyle-with-pigtails-design-poses-studio-removebg-preview.png', 3),
(61, 49, '1688269603pretty-red-head-woman-yellow-dress-posing-yellow-summer-mood-removebg-preview.png', 1),
(62, 49, '1688269603fashion-woman-with-clothes-removebg-preview.png', 2),
(63, 50, '1688269726beautiful-fashion-woman-purple-long-dress-hairstyle-with-pigtails-design-poses-studio-removebg-preview.png', 1),
(64, 50, '1688269726image 14.png', 2),
(65, 51, '1688269902fashion-woman-with-clothes-removebg-preview.png', 1),
(66, 51, '1688269902beautiful-fashion-woman-purple-long-dress-hairstyle-with-pigtails-design-poses-studio-removebg-preview.png', 2),
(67, 52, '16882702103888755_11872-removebg-preview.png', 1),
(68, 53, '1688270433flying-drone-silver-joystick-it__1_-removebg-preview.png', 1),
(69, 54, '16882706041353722_172509-OW8YYF-93__1_-removebg-preview.png', 1),
(70, 55, '168827081832767-2-axe-spray-transparent-background 1 (1).png', 1),
(71, 56, '16882711631191276_OSXDCD0-removebg-preview.png', 1),
(72, 56, '1688271163laptop-wooden-table-removebg-preview.png', 2),
(73, 57, '1688271377joshua-aragon-FGXqbqbGt5o-unsplash-removebg-preview-removebg-preview.png', 1),
(74, 57, '1688271377laptop-wooden-table-removebg-preview.png', 2),
(75, 58, '16882716161191276_OSXDCD0-removebg-preview.png', 1),
(76, 58, '16882716161162367_ORH91S0-removebg-preview.png', 2),
(77, 59, '1688271843portrait-handsome-confident-model-sexy-stylish-man-dressed-shirt-jeans-fashion-hipster-male-posing-near-blue-wall-studio-sunglasses-removebg-preview.png', 1),
(78, 59, '168827184317-dress-shirt-png-image 1 (1).png', 2),
(79, 59, '168827184317-dress-shirt-png-image 1.png', 3),
(80, 60, '1688272047portrait-handsome-smiling-model-sexy-stylish-man-dressed-shirt-trousers-fashion-hipster-male-posing-near-blue-wall-studio-isolated-removebg-preview.png', 1),
(81, 60, '1688272047young-spanish-man-with-tattoos-posing-street-removebg-preview.png', 2),
(82, 61, '1688272217handsome-man-wearing-sunglasses-standing-grey-wall-removebg-preview.png', 2),
(83, 61, '1688272217portrait-handsome-smiling-model-sexy-stylish-man-dressed-shirt-trousers-fashion-hipster-male-posing-near-blue-wall-studio-isolated-removebg-preview.png', 1),
(84, 62, '168827241117-dress-shirt-png-image 1 (1).png', 1),
(85, 62, '1688272411young-spanish-man-with-tattoos-posing-street-removebg-preview.png', 2),
(86, 63, '1688272855handsome-man-wearing-sunglasses-standing-grey-wall-removebg-preview.png', NULL),
(87, 64, '168827832232-running-shoes-png-image 1 (1).png', 1),
(88, 64, '1688278322one-black-sneaker-shoe-isolated-white-removebg-preview.png', 2),
(89, 65, '16882784744430978_3191-removebg-preview.png', 1),
(90, 65, '1688278474pair-trainers-removebg-preview.png', 2),
(91, 66, '16882786564430978_3191-removebg-preview.png', 1),
(92, 67, '16882788843888756_11873-removebg-preview.png', 1),
(93, 67, '168827888427-running-shoes-png-image 1 (1).png', 2),
(94, 67, '1688278884kisspng-apple-watch-series-2-apple-watch-series-3-apple-wa-smart-apple-watch-sports-watch-band-5a8687ca23b730.4356046615187660261463.jpg', 3),
(95, 68, '1688279036Product_09.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

DROP TABLE IF EXISTS `product_options`;
CREATE TABLE IF NOT EXISTS `product_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`id`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Checkbox', 1, '2023-05-20 04:18:01', '2023-05-20 04:18:37', NULL),
(2, 'Color', 1, '2023-05-20 04:18:17', '2023-06-21 06:59:22', NULL),
(3, 'Select', 1, '2023-05-20 04:20:36', '2023-05-20 04:20:36', NULL),
(4, 'Checkbox', 1, '2023-07-24 10:08:05', '2023-07-24 10:08:05', NULL),
(5, 'Radio', 1, '2023-07-24 13:08:03', '2023-07-24 13:08:03', NULL),
(6, 'Select', 1, '2023-08-01 08:55:54', '2023-08-01 08:55:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_option_description`
--

DROP TABLE IF EXISTS `product_option_description`;
CREATE TABLE IF NOT EXISTS `product_option_description` (
  `language_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `language_id` (`language_id`,`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_option_description`
--

INSERT INTO `product_option_description` (`language_id`, `option_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 1, 'بحجم', '2023-05-20 04:20:53', '2023-05-20 04:20:53', NULL),
(5, 2, 'اللون', '2023-06-21 06:59:22', '2023-06-21 06:59:22', NULL),
(4, 3, 'Storage', '2023-05-20 04:20:37', '2023-05-20 04:20:37', NULL),
(5, 3, 'تخزين', '2023-05-20 04:20:37', '2023-05-20 04:20:37', NULL),
(4, 1, 'Size', '2023-05-20 04:20:53', '2023-05-20 04:20:53', NULL),
(4, 2, 'Color', '2023-06-21 06:59:22', '2023-06-21 06:59:22', NULL),
(4, 4, 'Resolution', '2023-07-24 10:08:05', '2023-07-24 10:08:05', NULL),
(5, 4, 'Resolution', '2023-07-24 10:08:05', '2023-07-24 10:08:05', NULL),
(10, 5, 'Screen', '2023-08-01 08:55:28', '2023-08-01 08:55:28', NULL),
(4, 5, 'Screen', '2023-08-01 08:55:28', '2023-08-01 08:55:28', NULL),
(4, 6, 'Typee', '2023-08-01 08:55:54', '2023-08-01 08:55:54', NULL),
(10, 6, 'typee', '2023-08-01 08:55:54', '2023-08-01 08:55:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_option_values`
--

DROP TABLE IF EXISTS `product_option_values`;
CREATE TABLE IF NOT EXISTS `product_option_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_option_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_related`
--

DROP TABLE IF EXISTS `product_related`;
CREATE TABLE IF NOT EXISTS `product_related` (
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_related`
--

INSERT INTO `product_related` (`product_id`, `related_id`) VALUES
(5, 3),
(9, 2),
(10, 6),
(13, 11),
(16, 15),
(17, 15),
(17, 16),
(18, 15),
(18, 16),
(18, 17),
(21, 20),
(24, 4),
(25, 23),
(26, 8),
(26, 11),
(28, 22),
(31, 15),
(31, 16),
(31, 17),
(31, 18),
(33, 21),
(34, 21),
(34, 33),
(35, 1),
(35, 33),
(35, 34),
(36, 21),
(36, 33),
(36, 34),
(36, 35),
(37, 33),
(37, 34),
(37, 35),
(37, 36),
(38, 4),
(39, 4),
(39, 38),
(40, 4),
(40, 38),
(40, 39),
(42, 22),
(43, 22),
(43, 41),
(43, 42),
(44, 32),
(45, 32),
(45, 44),
(46, 32),
(46, 44),
(46, 45),
(47, 6),
(47, 10),
(47, 24),
(48, 6),
(48, 10),
(48, 47),
(49, 6),
(49, 10),
(49, 24),
(49, 38),
(49, 47),
(49, 48),
(50, 6),
(50, 10),
(50, 24),
(50, 38),
(50, 39),
(50, 47),
(50, 48),
(50, 49),
(51, 6),
(51, 24),
(51, 39),
(51, 47),
(51, 48),
(51, 49),
(51, 50),
(53, 52),
(54, 52),
(54, 53),
(55, 2),
(55, 9),
(56, 43),
(57, 43),
(57, 56),
(58, 56),
(58, 57),
(59, 3),
(59, 5),
(59, 23),
(59, 25),
(60, 5),
(60, 39),
(60, 59),
(61, 5),
(61, 23),
(61, 25),
(61, 59),
(62, 3),
(62, 23),
(62, 25),
(62, 59),
(62, 60),
(63, 3),
(63, 5),
(63, 23),
(63, 59),
(63, 61),
(63, 62),
(64, 4),
(64, 8),
(65, 26),
(65, 64),
(66, 26),
(66, 64),
(66, 65),
(67, 1),
(68, 67);

-- --------------------------------------------------------

--
-- Table structure for table `product_related_attributes`
--

DROP TABLE IF EXISTS `product_related_attributes`;
CREATE TABLE IF NOT EXISTS `product_related_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_related_attributes`
--

INSERT INTO `product_related_attributes` (`id`, `product_id`, `attribute_id`, `text`) VALUES
(7, 20, 3, 'SSD'),
(8, 20, 5, '500 GB'),
(9, 20, 6, '500 GB SSD'),
(10, 20, 1, '2.5 Ghz'),
(11, 20, 2, 'Corei9'),
(12, 20, 7, 'Window 11'),
(13, 20, 8, 'RGB'),
(14, 20, 9, 'LED'),
(15, 20, 15, 'LAPTOP-HP-15spdoko'),
(16, 21, 3, 'Dual Memory'),
(17, 21, 4, 'Micro'),
(18, 21, 5, '256 GB'),
(19, 21, 6, '128 GB'),
(20, 21, 1, '1.5 Ghz'),
(21, 21, 2, 'Octa - core'),
(22, 21, 9, 'Curve'),
(23, 21, 13, 'Dual'),
(24, 21, 12, 'Yes'),
(25, 21, 16, 'Charger,Mobile'),
(26, 1, 12, 'No'),
(27, 1, 11, '5 x 5'),
(28, 1, 15, 'SMART 512'),
(56, 37, 5, '512 GB'),
(57, 37, 6, '128 GB'),
(58, 37, 7, 'Android 12'),
(59, 37, 11, '5.6 inch'),
(60, 37, 12, 'Yes'),
(61, 37, 10, 'Wide'),
(62, 56, 7, 'Window 11'),
(63, 56, 6, '256 GB'),
(64, 56, 2, 'Core i9'),
(65, 56, 11, '21 Inch'),
(66, 56, 12, 'No'),
(67, 56, 15, '18as63'),
(68, 57, 6, '256 GB'),
(69, 57, 5, '5 TB'),
(70, 57, 7, 'Window 11'),
(71, 57, 11, '17 Inch'),
(72, 57, 14, 'Black'),
(73, 57, 12, 'No'),
(74, 57, 15, 'asr34ds'),
(84, 67, 12, 'Yes'),
(85, 67, 6, '16 GB'),
(86, 67, 14, 'Black'),
(87, 36, 3, 'dual'),
(88, 36, 6, '128 GB'),
(89, 36, 11, '5.6 Inch'),
(90, 36, 12, 'Yes'),
(91, 33, 4, 'Yes'),
(92, 33, 5, '512 GB'),
(93, 33, 6, '128 GB'),
(94, 33, 11, '5.6 inch'),
(95, 33, 12, 'Yes'),
(96, 34, 5, '512 GB'),
(97, 34, 7, 'Ioss 16'),
(98, 34, 11, '6.5 inch'),
(99, 34, 13, 'Dual'),
(100, 34, 16, 'Mobile'),
(101, 35, 3, 'single'),
(102, 35, 5, '1024 GB'),
(103, 35, 1, '5'),
(104, 35, 7, 'android 33'),
(105, 35, 10, 'wide'),
(106, 35, 14, 'black'),
(107, 35, 12, 'yess'),
(108, 35, 6, '50 GB'),
(133, 58, 6, '256 GB'),
(134, 58, 7, 'Window 11'),
(135, 58, 2, 'Core i9'),
(136, 58, 12, 'No'),
(137, 58, 15, 'sae23234sa'),
(138, 58, 5, '10 TB');

-- --------------------------------------------------------

--
-- Table structure for table `product_special`
--

DROP TABLE IF EXISTS `product_special`;
CREATE TABLE IF NOT EXISTS `product_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_special`
--

INSERT INTO `product_special` (`id`, `product_id`, `price`, `start_date`, `end_date`) VALUES
(1, 3, '75.0000', '2023-06-25', '2024-01-31'),
(4, 9, '49.0000', '2023-06-25', '2024-02-29'),
(3, 8, '59.0000', '2023-06-25', '2024-03-31'),
(5, 10, '30.0000', '2023-06-25', '2024-03-31'),
(6, 14, '25.0000', '2023-06-25', '2024-05-01'),
(8, 61, '15.0000', '2023-07-01', '2024-05-22'),
(9, 36, '130.0000', '2023-07-01', '2024-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(64) NOT NULL,
  `text` text,
  `rating` decimal(2,1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `product_id`, `customer_id`, `author`, `text`, `rating`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 68, 1, 'admin', 'Super duperSuper duperSuper duperSuper duperSuper duperSuper duperSuper duperSuper duperSuper duperSuper duper', '5.0', 1, '2023-08-20 11:03:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(9, 'Super Admin', 'web', '2021-07-15 01:27:06', '2021-07-15 01:27:06'),
(10, 'Demo', 'web', '2023-07-19 12:37:46', '2023-07-19 12:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 6),
(2, 1),
(2, 7),
(2, 8),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 6),
(6, 7),
(6, 8),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(10, 7),
(10, 8),
(11, 1),
(11, 6),
(12, 1),
(15, 1),
(15, 2),
(15, 6),
(17, 1),
(19, 1),
(19, 2),
(19, 7),
(19, 8),
(20, 6),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(25, 6),
(26, 1),
(26, 6),
(26, 7),
(26, 8),
(27, 1),
(27, 6),
(28, 1),
(28, 6),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(75, 2),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(79, 2),
(80, 1),
(81, 1),
(82, 1),
(3, 12),
(5, 12),
(7, 12),
(30, 12),
(32, 12),
(36, 12),
(40, 12),
(11, 12),
(19, 12),
(25, 12),
(27, 12),
(42, 12),
(44, 12),
(46, 12),
(47, 12),
(87, 12),
(53, 12),
(21, 12),
(23, 12),
(57, 12),
(59, 12),
(61, 12),
(63, 12),
(65, 12),
(69, 12),
(75, 12),
(77, 12),
(79, 12),
(81, 12),
(90, 12),
(91, 12),
(94, 12),
(112, 12),
(1, 13),
(105, 13),
(104, 13),
(113, 13),
(1, 10),
(25, 10),
(26, 10),
(27, 10),
(42, 10),
(43, 10),
(44, 10),
(47, 10),
(48, 10),
(21, 10),
(22, 10),
(23, 10),
(126, 10),
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(30, 9),
(31, 9),
(32, 9),
(33, 9),
(34, 9),
(35, 9),
(36, 9),
(37, 9),
(38, 9),
(39, 9),
(40, 9),
(41, 9),
(9, 9),
(10, 9),
(11, 9),
(12, 9),
(86, 9),
(15, 9),
(17, 9),
(29, 9),
(19, 9),
(25, 9),
(26, 9),
(27, 9),
(28, 9),
(42, 9),
(43, 9),
(44, 9),
(45, 9),
(146, 9),
(46, 9),
(145, 9),
(47, 9),
(48, 9),
(87, 9),
(50, 9),
(51, 9),
(52, 9),
(53, 9),
(54, 9),
(21, 9),
(22, 9),
(23, 9),
(24, 9),
(55, 9),
(56, 9),
(57, 9),
(58, 9),
(98, 9),
(129, 9),
(59, 9),
(60, 9),
(61, 9),
(62, 9),
(63, 9),
(64, 9),
(65, 9),
(66, 9),
(67, 9),
(68, 9),
(69, 9),
(114, 9),
(115, 9),
(131, 9),
(116, 9),
(117, 9),
(118, 9),
(124, 9),
(132, 9),
(71, 9),
(72, 9),
(73, 9),
(74, 9),
(130, 9),
(75, 9),
(76, 9),
(77, 9),
(78, 9),
(79, 9),
(80, 9),
(81, 9),
(82, 9),
(88, 9),
(89, 9),
(90, 9),
(92, 9),
(93, 9),
(91, 9),
(95, 9),
(96, 9),
(94, 9),
(97, 9),
(101, 9),
(102, 9),
(100, 9),
(103, 9),
(120, 9),
(121, 9),
(119, 9),
(122, 9),
(105, 9),
(104, 9),
(106, 9),
(107, 9),
(110, 9),
(111, 9),
(113, 9),
(123, 9),
(112, 9),
(126, 9),
(127, 9),
(125, 9),
(128, 9),
(134, 9),
(136, 9),
(133, 9),
(135, 9),
(138, 9),
(139, 9),
(137, 9),
(140, 9),
(142, 9),
(143, 9),
(141, 9),
(144, 9);

-- --------------------------------------------------------

--
-- Table structure for table `seo_url`
--

DROP TABLE IF EXISTS `seo_url`;
CREATE TABLE IF NOT EXISTS `seo_url` (
  `seo_url_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=900 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `store_id`, `key`, `value`, `serialized`) VALUES
(837, 1, 'config_meta_tag_keywords', 'otrixcommerce,ecommerce', NULL),
(838, 1, 'config_fb_url', 'https://www.facebook.com/', NULL),
(839, 1, 'config_linkedin_url', 'https://www.linkedin.com/', NULL),
(840, 1, 'config_twitter_url', 'https://twitter.com/login?lang=en', NULL),
(842, 1, 'config_youtube_url', 'https://www.youtube.com/channel/UCiWzLziMAOk-oB0pig8TkEg/', NULL),
(843, 1, 'config_mail_engine', 'smtp', NULL),
(841, 1, 'config_insta_url', 'https://www.instagram.com/', NULL),
(845, 1, 'config_smtp_username', 'otrixapp@gmail.in', NULL),
(844, 1, 'config_smtp_hostname', 'smtp.googlemail.ddd', NULL),
(846, 1, 'config_smtp_password', 'abcdabcdefgefg', NULL),
(848, 1, 'config_smtp_timeout', '25', NULL),
(847, 1, 'config_smtp_port', '25', NULL),
(849, 1, 'config_store_image', '1691815628logootrix.png', NULL),
(851, 1, 'config_alert_mail', 'Register,Orders', NULL),
(850, 1, 'config_icon_image', '168941197910.png', NULL),
(883, 1, 'config_currency', '$', NULL),
(882, 1, 'config_fax', '380001', NULL),
(881, 1, 'config_telephone', '09898989898', NULL),
(880, 1, 'config_email', 'otrixapp@gmail.in', NULL),
(879, 1, 'config_geocode', '54654', NULL),
(877, 1, 'config_store_owner', 'Otrix Admin', NULL),
(878, 1, 'config_address', 'Building Number 121\r\nGround floor, Office 2 Otrixweb\r\nCommercial, Otrixcity', NULL),
(876, 1, 'config_store_name', 'Otrixcommerce Website', NULL),
(836, 1, 'config_meta_tag_description', 'OtrixCommerce is your go-to destination for all your online shopping needs. Our ecommerce website offers an extensive collection of high-quality products at competitive prices, ranging from fashion and beauty to electronics and home essentials.\r\n        Our user-friendly interface and fast-loading pages provide a seamless shopping experience for customers. We have optimized our website for search engines to ensure that our products are easily discoverable by potential customers.\r\n        We prioritize customer satisfaction and have a dedicated customer support team available to assist you with any inquiries or concerns. With a secure payment gateway and fast shipping, we strive to make online shopping stress-free and convenient.\r\n        At OtrixCommerce, we are committed to providing you with the best online shopping experience possible. Browse our extensive collection today and discover something new!', NULL),
(835, 1, 'config_meta_title', 'Otrixcommerce Website', NULL),
(834, 1, 'config_web_bg', '#626ABB', NULL),
(833, 1, 'config_currency', '$', NULL),
(832, 1, 'config_fax', '380001', NULL),
(831, 1, 'config_telephone', '09898989898', NULL),
(830, 1, 'config_email', 'otrixapp@gmail.in', NULL),
(829, 1, 'config_geocode', '54654', NULL),
(828, 1, 'config_address', 'Building Number 121\r\nGround floor, Office 2 Otrixweb\r\nCommercial, Otrixcity', NULL),
(827, 1, 'config_store_owner', 'Otrix Admin', NULL),
(826, 1, 'config_store_name', 'Otrixcommerce Website', NULL),
(884, 1, 'config_encryption', 'tls', NULL),
(885, 1, 'config_from', 'otrix@mail.in', NULL),
(886, 1, 'config_from_name', 'dasd', NULL),
(887, 1, 'config_signup_discount_status', '1', NULL),
(888, 1, 'config_signup_discount', '15', NULL),
(889, 1, 'config_signup_discount_text', '{\"4\":\"Sign Up  And  _DISCOUNT_  special discount on your first order\",\"5\":\"\\u0627\\u0634\\u062a\\u0631\\u0643 \\u0648 _DISCOUNT_ \\u062e\\u0635\\u0645 \\u062e\\u0627\\u0635 \\u0639\\u0644\\u0649 \\u0637\\u0644\\u0628\\u0643 \\u0627\\u0644\\u0623\\u0648\\u0644\",\"11\":\"Sign Up  And  _DISCOUNT_  special discount on your first order\"}', NULL),
(890, 1, 'config_layout', 'otrixlayout', NULL),
(891, 1, 'config_twilio_sid', 'AC03edc552fb', NULL),
(892, 1, 'config_twilio_token', '721bd6d11442ced', NULL),
(893, 1, 'config_twilio_from', '+17622', NULL),
(894, 1, 'config_alert_sms', 'Register,Orders', NULL),
(895, 1, 'config_registerSMSContent', 'Thank you for register on otrixcommerce', NULL),
(896, 1, 'config_talk_to_expert', '{\"4\":\"Hello\",\"5\":\"\\u0645\\u0631\\u062d\\u0628\\u064b\\u0627\",\"11\":\"Hello EST\"}', NULL),
(897, 1, 'config_talk_to_expert_mobile', '+9198256', NULL),
(898, 1, 'config_social_status', '1', NULL),
(899, 1, 'config_accept_terms_before_order', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shipping_charge` decimal(15,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `shipping_charge`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Free  (10 - 15 Days)', '0.00', 1, '2022-03-16 04:29:45', '2022-03-16 04:29:45', NULL),
(2, 'Fast Shipping', '10.00', 1, '2022-03-16 04:30:09', '2022-03-16 04:30:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `state_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4725 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `country_id`, `name`, `created_at`, `updated_at`, `deleted_at`, `state_code`, `country_code`) VALUES
(195, 14, 'Australian Capital Territory', '2023-08-14 14:52:24', NULL, NULL, 'ACT', 'AU'),
(196, 14, 'New South Wales', '2023-08-14 14:52:24', NULL, NULL, 'NSW', 'AU'),
(197, 14, 'Northern Territory', '2023-08-14 14:52:24', NULL, NULL, 'NT', 'AU'),
(198, 14, 'Queensland', '2023-08-14 14:52:24', NULL, NULL, 'QLD', 'AU'),
(199, 14, 'South Australia', '2023-08-14 14:52:24', NULL, NULL, 'SA', 'AU'),
(200, 14, 'Tasmania', '2023-08-14 14:52:24', NULL, NULL, 'TAS', 'AU'),
(201, 14, 'Victoria', '2023-08-14 14:52:24', NULL, NULL, 'VIC', 'AU'),
(202, 14, 'Western Australia', '2023-08-14 14:52:24', NULL, NULL, 'WA', 'AU'),
(334, 19, 'Bagerhat District', '2023-08-14 14:52:24', NULL, NULL, '05', 'BD'),
(335, 19, 'Bahadia', '2023-08-14 14:52:24', NULL, NULL, '33', 'BD'),
(336, 19, 'Bandarban District', '2023-08-14 14:52:24', NULL, NULL, '01', 'BD'),
(337, 19, 'Barguna District', '2023-08-14 14:52:24', NULL, NULL, '02', 'BD'),
(338, 19, 'Barisal District', '2023-08-14 14:52:24', NULL, NULL, '06', 'BD'),
(339, 19, 'Barisal Division', '2023-08-14 14:52:24', NULL, NULL, 'A', 'BD'),
(340, 19, 'Bhola District', '2023-08-14 14:52:24', NULL, NULL, '07', 'BD'),
(341, 19, 'Bogra District', '2023-08-14 14:52:24', NULL, NULL, '03', 'BD'),
(342, 19, 'Brahmanbaria District', '2023-08-14 14:52:24', NULL, NULL, '04', 'BD'),
(343, 19, 'Chandpur District', '2023-08-14 14:52:24', NULL, NULL, '09', 'BD'),
(344, 19, 'Chapai Nawabganj District', '2023-08-14 14:52:24', NULL, NULL, '45', 'BD'),
(345, 19, 'Chittagong District', '2023-08-14 14:52:24', NULL, NULL, '10', 'BD'),
(346, 19, 'Chittagong Division', '2023-08-14 14:52:24', NULL, NULL, 'B', 'BD'),
(347, 19, 'Chuadanga District', '2023-08-14 14:52:24', NULL, NULL, '12', 'BD'),
(348, 19, 'Comilla District', '2023-08-14 14:52:24', NULL, NULL, '08', 'BD'),
(349, 19, 'Cox\'s Bazar District', '2023-08-14 14:52:24', NULL, NULL, '11', 'BD'),
(350, 19, 'Dhaka District', '2023-08-14 14:52:24', NULL, NULL, '13', 'BD'),
(351, 19, 'Dhaka Division', '2023-08-14 14:52:24', NULL, NULL, 'C', 'BD'),
(352, 19, 'Dinajpur District', '2023-08-14 14:52:24', NULL, NULL, '14', 'BD'),
(353, 19, 'Faridpur District', '2023-08-14 14:52:24', NULL, NULL, '15', 'BD'),
(354, 19, 'Feni District', '2023-08-14 14:52:24', NULL, NULL, '16', 'BD'),
(355, 19, 'Gaibandha District', '2023-08-14 14:52:24', NULL, NULL, '19', 'BD'),
(356, 19, 'Gazipur District', '2023-08-14 14:52:24', NULL, NULL, '18', 'BD'),
(357, 19, 'Gopalganj District', '2023-08-14 14:52:24', NULL, NULL, '17', 'BD'),
(358, 19, 'Habiganj District', '2023-08-14 14:52:24', NULL, NULL, '20', 'BD'),
(359, 19, 'Jamalpur District', '2023-08-14 14:52:24', NULL, NULL, '21', 'BD'),
(360, 19, 'Jessore District', '2023-08-14 14:52:24', NULL, NULL, '22', 'BD'),
(361, 19, 'Jhalokati District', '2023-08-14 14:52:24', NULL, NULL, '25', 'BD'),
(362, 19, 'Jhenaidah District', '2023-08-14 14:52:24', NULL, NULL, '23', 'BD'),
(363, 19, 'Joypurhat District', '2023-08-14 14:52:24', NULL, NULL, '24', 'BD'),
(364, 19, 'Khagrachari District', '2023-08-14 14:52:24', NULL, NULL, '29', 'BD'),
(365, 19, 'Khulna District', '2023-08-14 14:52:24', NULL, NULL, '27', 'BD'),
(366, 19, 'Khulna Division', '2023-08-14 14:52:24', NULL, NULL, 'D', 'BD'),
(367, 19, 'Kishoreganj District', '2023-08-14 14:52:24', NULL, NULL, '26', 'BD'),
(368, 19, 'Kurigram District', '2023-08-14 14:52:24', NULL, NULL, '28', 'BD'),
(369, 19, 'Kushtia District', '2023-08-14 14:52:24', NULL, NULL, '30', 'BD'),
(370, 19, 'Lakshmipur District', '2023-08-14 14:52:24', NULL, NULL, '31', 'BD'),
(371, 19, 'Lalmonirhat District', '2023-08-14 14:52:24', NULL, NULL, '32', 'BD'),
(372, 19, 'Madaripur District', '2023-08-14 14:52:24', NULL, NULL, '36', 'BD'),
(373, 19, 'Meherpur District', '2023-08-14 14:52:24', NULL, NULL, '39', 'BD'),
(374, 19, 'Moulvibazar District', '2023-08-14 14:52:24', NULL, NULL, '38', 'BD'),
(375, 19, 'Munshiganj District', '2023-08-14 14:52:24', NULL, NULL, '35', 'BD'),
(376, 19, 'Mymensingh District', '2023-08-14 14:52:24', NULL, NULL, '34', 'BD'),
(377, 19, 'Mymensingh Division', '2023-08-14 14:52:24', NULL, NULL, 'H', 'BD'),
(378, 19, 'Naogaon District', '2023-08-14 14:52:24', NULL, NULL, '48', 'BD'),
(379, 19, 'Narail District', '2023-08-14 14:52:24', NULL, NULL, '43', 'BD'),
(380, 19, 'Narayanganj District', '2023-08-14 14:52:24', NULL, NULL, '40', 'BD'),
(381, 19, 'Natore District', '2023-08-14 14:52:24', NULL, NULL, '44', 'BD'),
(382, 19, 'Netrokona District', '2023-08-14 14:52:24', NULL, NULL, '41', 'BD'),
(383, 19, 'Nilphamari District', '2023-08-14 14:52:24', NULL, NULL, '46', 'BD'),
(384, 19, 'Noakhali District', '2023-08-14 14:52:24', NULL, NULL, '47', 'BD'),
(385, 19, 'Pabna District', '2023-08-14 14:52:24', NULL, NULL, '49', 'BD'),
(386, 19, 'Panchagarh District', '2023-08-14 14:52:24', NULL, NULL, '52', 'BD'),
(387, 19, 'Patuakhali District', '2023-08-14 14:52:24', NULL, NULL, '51', 'BD'),
(388, 19, 'Pirojpur District', '2023-08-14 14:52:24', NULL, NULL, '50', 'BD'),
(389, 19, 'Rajbari District', '2023-08-14 14:52:24', NULL, NULL, '53', 'BD'),
(390, 19, 'Rajshahi District', '2023-08-14 14:52:24', NULL, NULL, '54', 'BD'),
(391, 19, 'Rajshahi Division', '2023-08-14 14:52:24', NULL, NULL, 'E', 'BD'),
(392, 19, 'Rangamati Hill District', '2023-08-14 14:52:24', NULL, NULL, '56', 'BD'),
(393, 19, 'Rangpur District', '2023-08-14 14:52:24', NULL, NULL, '55', 'BD'),
(394, 19, 'Rangpur Division', '2023-08-14 14:52:24', NULL, NULL, 'F', 'BD'),
(395, 19, 'Satkhira District', '2023-08-14 14:52:24', NULL, NULL, '58', 'BD'),
(396, 19, 'Shariatpur District', '2023-08-14 14:52:24', NULL, NULL, '62', 'BD'),
(397, 19, 'Sherpur District', '2023-08-14 14:52:24', NULL, NULL, '57', 'BD'),
(398, 19, 'Sirajganj District', '2023-08-14 14:52:24', NULL, NULL, '59', 'BD'),
(399, 19, 'Sunamganj District', '2023-08-14 14:52:24', NULL, NULL, '61', 'BD'),
(400, 19, 'Sylhet District', '2023-08-14 14:52:24', NULL, NULL, '60', 'BD'),
(401, 19, 'Sylhet Division', '2023-08-14 14:52:24', NULL, NULL, 'G', 'BD'),
(402, 19, 'Tangail District', '2023-08-14 14:52:24', NULL, NULL, '63', 'BD'),
(403, 19, 'Thakurgaon District', '2023-08-14 14:52:24', NULL, NULL, '64', 'BD'),
(682, 40, 'Alberta', '2023-08-14 14:52:24', NULL, NULL, 'AB', 'CA'),
(683, 40, 'British Columbia', '2023-08-14 14:52:24', NULL, NULL, 'BC', 'CA'),
(684, 40, 'Manitoba', '2023-08-14 14:52:24', NULL, NULL, 'MB', 'CA'),
(685, 40, 'New Brunswick', '2023-08-14 14:52:24', NULL, NULL, 'NB', 'CA'),
(686, 40, 'Newfoundland and Labrador', '2023-08-14 14:52:24', NULL, NULL, 'NL', 'CA'),
(687, 40, 'Northwest Territories', '2023-08-14 14:52:24', NULL, NULL, 'NT', 'CA'),
(688, 40, 'Nova Scotia', '2023-08-14 14:52:24', NULL, NULL, 'NS', 'CA'),
(689, 40, 'Nunavut', '2023-08-14 14:52:24', NULL, NULL, 'NU', 'CA'),
(690, 40, 'Ontario', '2023-08-14 14:52:24', NULL, NULL, 'ON', 'CA'),
(691, 40, 'Prince Edward Island', '2023-08-14 14:52:24', NULL, NULL, 'PE', 'CA'),
(692, 40, 'Quebec', '2023-08-14 14:52:24', NULL, NULL, 'QC', 'CA'),
(693, 40, 'Saskatchewan', '2023-08-14 14:52:24', NULL, NULL, 'SK', 'CA'),
(694, 40, 'Yukon', '2023-08-14 14:52:24', NULL, NULL, 'YT', 'CA'),
(1598, 103, 'Andaman and Nicobar Islands', '2023-08-14 14:52:24', NULL, NULL, 'AN', 'IN'),
(1599, 103, 'Andhra Pradesh', '2023-08-14 14:52:24', NULL, NULL, 'AP', 'IN'),
(1600, 103, 'Arunachal Pradesh', '2023-08-14 14:52:24', NULL, NULL, 'AR', 'IN'),
(1601, 103, 'Assam', '2023-08-14 14:52:24', NULL, NULL, 'AS', 'IN'),
(1602, 103, 'Bihar', '2023-08-14 14:52:24', NULL, NULL, 'BR', 'IN'),
(1603, 103, 'Chandigarh', '2023-08-14 14:52:24', NULL, NULL, 'CH', 'IN'),
(1604, 103, 'Chhattisgarh', '2023-08-14 14:52:24', NULL, NULL, 'CT', 'IN'),
(1605, 103, 'Dadra and Nagar Haveli', '2023-08-14 14:52:24', NULL, NULL, 'DN', 'IN'),
(1606, 103, 'Daman and Diu', '2023-08-14 14:52:24', NULL, NULL, 'DD', 'IN'),
(1607, 103, 'Delhi', '2023-08-14 14:52:24', NULL, NULL, 'DL', 'IN'),
(1608, 103, 'Goa', '2023-08-14 14:52:24', NULL, NULL, 'GA', 'IN'),
(1609, 103, 'Gujarat', '2023-08-14 14:52:24', NULL, NULL, 'GJ', 'IN'),
(1610, 103, 'Haryana', '2023-08-14 14:52:24', NULL, NULL, 'HR', 'IN'),
(1611, 103, 'Himachal Pradesh', '2023-08-14 14:52:24', NULL, NULL, 'HP', 'IN'),
(1612, 103, 'Jammu and Kashmir', '2023-08-14 14:52:24', NULL, NULL, 'JK', 'IN'),
(1613, 103, 'Jharkhand', '2023-08-14 14:52:24', NULL, NULL, 'JH', 'IN'),
(1614, 103, 'Karnataka', '2023-08-14 14:52:24', NULL, NULL, 'KA', 'IN'),
(1615, 103, 'Kerala', '2023-08-14 14:52:24', NULL, NULL, 'KL', 'IN'),
(1616, 103, 'Ladakh', '2023-08-14 14:52:24', NULL, NULL, 'LA', 'IN'),
(1617, 103, 'Lakshadweep', '2023-08-14 14:52:24', NULL, NULL, 'LD', 'IN'),
(1618, 103, 'Madhya Pradesh', '2023-08-14 14:52:24', NULL, NULL, 'MP', 'IN'),
(1619, 103, 'Maharashtra', '2023-08-14 14:52:24', NULL, NULL, 'MH', 'IN'),
(1620, 103, 'Manipur', '2023-08-14 14:52:24', NULL, NULL, 'MN', 'IN'),
(1621, 103, 'Meghalaya', '2023-08-14 14:52:24', NULL, NULL, 'ML', 'IN'),
(1622, 103, 'Mizoram', '2023-08-14 14:52:24', NULL, NULL, 'MZ', 'IN'),
(1623, 103, 'Nagaland', '2023-08-14 14:52:24', NULL, NULL, 'NL', 'IN'),
(1624, 103, 'Odisha', '2023-08-14 14:52:24', NULL, NULL, 'OR', 'IN'),
(1625, 103, 'Puducherry', '2023-08-14 14:52:24', NULL, NULL, 'PY', 'IN'),
(1626, 103, 'Punjab', '2023-08-14 14:52:24', NULL, NULL, 'PB', 'IN'),
(1627, 103, 'Rajasthan', '2023-08-14 14:52:24', NULL, NULL, 'RJ', 'IN'),
(1628, 103, 'Sikkim', '2023-08-14 14:52:24', NULL, NULL, 'SK', 'IN'),
(1629, 103, 'Tamil Nadu', '2023-08-14 14:52:24', NULL, NULL, 'TN', 'IN'),
(1630, 103, 'Telangana', '2023-08-14 14:52:24', NULL, NULL, 'TG', 'IN'),
(1631, 103, 'Tripura', '2023-08-14 14:52:24', NULL, NULL, 'TR', 'IN'),
(1632, 103, 'Uttar Pradesh', '2023-08-14 14:52:24', NULL, NULL, 'UP', 'IN'),
(1633, 103, 'Uttarakhand', '2023-08-14 14:52:24', NULL, NULL, 'UT', 'IN'),
(1634, 103, 'West Bengal', '2023-08-14 14:52:24', NULL, NULL, 'WB', 'IN'),
(2065, 121, 'Al Ahmadi Governorate', '2023-08-14 14:52:24', NULL, NULL, 'AH', 'KW'),
(2066, 121, 'Al Farwaniyah Governorate', '2023-08-14 14:52:24', NULL, NULL, 'FA', 'KW'),
(2067, 121, 'Al Jahra Governorate', '2023-08-14 14:52:24', NULL, NULL, 'JA', 'KW'),
(2068, 121, 'Capital Governorate', '2023-08-14 14:52:24', NULL, NULL, 'KU', 'KW'),
(2069, 121, 'Hawalli Governorate', '2023-08-14 14:52:24', NULL, NULL, 'HA', 'KW'),
(2070, 121, 'Mubarak Al-Kabeer Governorate', '2023-08-14 14:52:24', NULL, NULL, 'MU', 'KW'),
(3440, 197, '\'Asir Region', '2023-08-14 14:52:24', NULL, NULL, '14', 'SA'),
(3441, 197, 'Al Bahah Region', '2023-08-14 14:52:24', NULL, NULL, '11', 'SA'),
(3442, 197, 'Al Jawf Region', '2023-08-14 14:52:24', NULL, NULL, '12', 'SA'),
(3443, 197, 'Al Madinah Region', '2023-08-14 14:52:24', NULL, NULL, '03', 'SA'),
(3444, 197, 'Al-Qassim Region', '2023-08-14 14:52:24', NULL, NULL, '05', 'SA'),
(3445, 197, 'Eastern Province', '2023-08-14 14:52:24', NULL, NULL, '04', 'SA'),
(3446, 197, 'Ha\'il Region', '2023-08-14 14:52:24', NULL, NULL, '06', 'SA'),
(3447, 197, 'Jizan Region', '2023-08-14 14:52:24', NULL, NULL, '09', 'SA'),
(3448, 197, 'Makkah Region', '2023-08-14 14:52:24', NULL, NULL, '02', 'SA'),
(3449, 197, 'Najran Region', '2023-08-14 14:52:24', NULL, NULL, '10', 'SA'),
(3450, 197, 'Northern Borders Region', '2023-08-14 14:52:24', NULL, NULL, '08', 'SA'),
(3451, 197, 'Riyadh Region', '2023-08-14 14:52:24', NULL, NULL, '01', 'SA'),
(3452, 197, 'Tabuk Region', '2023-08-14 14:52:24', NULL, NULL, '07', 'SA'),
(4160, 231, 'Adana Province', '2023-08-14 14:52:24', NULL, NULL, '01', 'TR'),
(4161, 231, 'Adıyaman Province', '2023-08-14 14:52:24', NULL, NULL, '02', 'TR'),
(4162, 231, 'Afyonkarahisar Province', '2023-08-14 14:52:24', NULL, NULL, '03', 'TR'),
(4163, 231, 'Ağrı Province', '2023-08-14 14:52:24', NULL, NULL, '04', 'TR'),
(4164, 231, 'Aksaray Province', '2023-08-14 14:52:24', NULL, NULL, '68', 'TR'),
(4165, 231, 'Amasya Province', '2023-08-14 14:52:24', NULL, NULL, '05', 'TR'),
(4166, 231, 'Ankara Province', '2023-08-14 14:52:24', NULL, NULL, '06', 'TR'),
(4167, 231, 'Antalya Province', '2023-08-14 14:52:24', NULL, NULL, '07', 'TR'),
(4168, 231, 'Ardahan Province', '2023-08-14 14:52:24', NULL, NULL, '75', 'TR'),
(4169, 231, 'Artvin Province', '2023-08-14 14:52:24', NULL, NULL, '08', 'TR'),
(4170, 231, 'Aydın Province', '2023-08-14 14:52:24', NULL, NULL, '09', 'TR'),
(4171, 231, 'Balıkesir Province', '2023-08-14 14:52:24', NULL, NULL, '10', 'TR'),
(4172, 231, 'Bartın Province', '2023-08-14 14:52:24', NULL, NULL, '74', 'TR'),
(4173, 231, 'Batman Province', '2023-08-14 14:52:24', NULL, NULL, '72', 'TR'),
(4174, 231, 'Bayburt Province', '2023-08-14 14:52:24', NULL, NULL, '69', 'TR'),
(4175, 231, 'Bilecik Province', '2023-08-14 14:52:24', NULL, NULL, '11', 'TR'),
(4176, 231, 'Bingöl Province', '2023-08-14 14:52:24', NULL, NULL, '12', 'TR'),
(4177, 231, 'Bitlis Province', '2023-08-14 14:52:24', NULL, NULL, '13', 'TR'),
(4178, 231, 'Bolu Province', '2023-08-14 14:52:24', NULL, NULL, '14', 'TR'),
(4179, 231, 'Burdur Province', '2023-08-14 14:52:24', NULL, NULL, '15', 'TR'),
(4180, 231, 'Bursa Province', '2023-08-14 14:52:24', NULL, NULL, '16', 'TR'),
(4181, 231, 'Çanakkale Province', '2023-08-14 14:52:24', NULL, NULL, '17', 'TR'),
(4182, 231, 'Çankırı Province', '2023-08-14 14:52:24', NULL, NULL, '18', 'TR'),
(4183, 231, 'Çorum Province', '2023-08-14 14:52:24', NULL, NULL, '19', 'TR'),
(4184, 231, 'Denizli Province', '2023-08-14 14:52:24', NULL, NULL, '20', 'TR'),
(4185, 231, 'Diyarbakır Province', '2023-08-14 14:52:24', NULL, NULL, '21', 'TR'),
(4186, 231, 'Düzce Province', '2023-08-14 14:52:24', NULL, NULL, '81', 'TR'),
(4187, 231, 'Edirne Province', '2023-08-14 14:52:24', NULL, NULL, '22', 'TR'),
(4188, 231, 'Elazığ Province', '2023-08-14 14:52:24', NULL, NULL, '23', 'TR'),
(4189, 231, 'Erzincan Province', '2023-08-14 14:52:24', NULL, NULL, '24', 'TR'),
(4190, 231, 'Erzurum Province', '2023-08-14 14:52:24', NULL, NULL, '25', 'TR'),
(4191, 231, 'Eskişehir Province', '2023-08-14 14:52:24', NULL, NULL, '26', 'TR'),
(4192, 231, 'Gaziantep Province', '2023-08-14 14:52:24', NULL, NULL, '27', 'TR'),
(4193, 231, 'Giresun Province', '2023-08-14 14:52:24', NULL, NULL, '28', 'TR'),
(4194, 231, 'Gümüşhane Province', '2023-08-14 14:52:24', NULL, NULL, '29', 'TR'),
(4195, 231, 'Hakkâri Province', '2023-08-14 14:52:24', NULL, NULL, '30', 'TR'),
(4196, 231, 'Hatay Province', '2023-08-14 14:52:24', NULL, NULL, '31', 'TR'),
(4197, 231, 'Iğdır Province', '2023-08-14 14:52:24', NULL, NULL, '76', 'TR'),
(4198, 231, 'Isparta Province', '2023-08-14 14:52:24', NULL, NULL, '32', 'TR'),
(4199, 231, 'Istanbul Province', '2023-08-14 14:52:24', NULL, NULL, '34', 'TR'),
(4200, 231, 'İzmir Province', '2023-08-14 14:52:24', NULL, NULL, '35', 'TR'),
(4201, 231, 'Kahramanmaraş Province', '2023-08-14 14:52:24', NULL, NULL, '46', 'TR'),
(4202, 231, 'Karabük Province', '2023-08-14 14:52:24', NULL, NULL, '78', 'TR'),
(4203, 231, 'Karaman Province', '2023-08-14 14:52:24', NULL, NULL, '70', 'TR'),
(4204, 231, 'Kars Province', '2023-08-14 14:52:24', NULL, NULL, '36', 'TR'),
(4205, 231, 'Kastamonu Province', '2023-08-14 14:52:24', NULL, NULL, '37', 'TR'),
(4206, 231, 'Kayseri Province', '2023-08-14 14:52:24', NULL, NULL, '38', 'TR'),
(4207, 231, 'Kilis Province', '2023-08-14 14:52:24', NULL, NULL, '79', 'TR'),
(4208, 231, 'Kırıkkale Province', '2023-08-14 14:52:24', NULL, NULL, '71', 'TR'),
(4209, 231, 'Kırklareli Province', '2023-08-14 14:52:24', NULL, NULL, '39', 'TR'),
(4210, 231, 'Kırşehir Province', '2023-08-14 14:52:24', NULL, NULL, '40', 'TR'),
(4211, 231, 'Kocaeli Province', '2023-08-14 14:52:24', NULL, NULL, '41', 'TR'),
(4212, 231, 'Konya Province', '2023-08-14 14:52:24', NULL, NULL, '42', 'TR'),
(4213, 231, 'Kütahya Province', '2023-08-14 14:52:24', NULL, NULL, '43', 'TR'),
(4214, 231, 'Malatya Province', '2023-08-14 14:52:24', NULL, NULL, '44', 'TR'),
(4215, 231, 'Manisa Province', '2023-08-14 14:52:24', NULL, NULL, '45', 'TR'),
(4216, 231, 'Mardin Province', '2023-08-14 14:52:24', NULL, NULL, '47', 'TR'),
(4217, 231, 'Mersin Province', '2023-08-14 14:52:24', NULL, NULL, '33', 'TR'),
(4218, 231, 'Muğla Province', '2023-08-14 14:52:24', NULL, NULL, '48', 'TR'),
(4219, 231, 'Muş Province', '2023-08-14 14:52:24', NULL, NULL, '49', 'TR'),
(4220, 231, 'Nevşehir Province', '2023-08-14 14:52:24', NULL, NULL, '50', 'TR'),
(4221, 231, 'Niğde Province', '2023-08-14 14:52:24', NULL, NULL, '51', 'TR'),
(4222, 231, 'Ordu Province', '2023-08-14 14:52:24', NULL, NULL, '52', 'TR'),
(4223, 231, 'Osmaniye Province', '2023-08-14 14:52:24', NULL, NULL, '80', 'TR'),
(4224, 231, 'Rize Province', '2023-08-14 14:52:24', NULL, NULL, '53', 'TR'),
(4225, 231, 'Sakarya Province', '2023-08-14 14:52:24', NULL, NULL, '54', 'TR'),
(4226, 231, 'Samsun Province', '2023-08-14 14:52:24', NULL, NULL, '55', 'TR'),
(4227, 231, 'Şanlıurfa Province', '2023-08-14 14:52:24', NULL, NULL, '63', 'TR'),
(4228, 231, 'Siirt Province', '2023-08-14 14:52:24', NULL, NULL, '56', 'TR'),
(4229, 231, 'Sinop Province', '2023-08-14 14:52:24', NULL, NULL, '57', 'TR'),
(4230, 231, 'Sivas Province', '2023-08-14 14:52:24', NULL, NULL, '58', 'TR'),
(4231, 231, 'Şırnak Province', '2023-08-14 14:52:24', NULL, NULL, '73', 'TR'),
(4232, 231, 'Tekirdağ Province', '2023-08-14 14:52:24', NULL, NULL, '59', 'TR'),
(4233, 231, 'Tokat Province', '2023-08-14 14:52:24', NULL, NULL, '60', 'TR'),
(4234, 231, 'Trabzon Province', '2023-08-14 14:52:24', NULL, NULL, '61', 'TR'),
(4235, 231, 'Tunceli Province', '2023-08-14 14:52:24', NULL, NULL, '62', 'TR'),
(4236, 231, 'Uşak Province', '2023-08-14 14:52:24', NULL, NULL, '64', 'TR'),
(4237, 231, 'Van Province', '2023-08-14 14:52:24', NULL, NULL, '65', 'TR'),
(4238, 231, 'Yalova Province', '2023-08-14 14:52:24', NULL, NULL, '77', 'TR'),
(4239, 231, 'Yozgat Province', '2023-08-14 14:52:24', NULL, NULL, '66', 'TR'),
(4240, 231, 'Zonguldak Province', '2023-08-14 14:52:24', NULL, NULL, '67', 'TR'),
(4405, 237, 'Abu Dhabi Emirate', '2023-08-14 14:52:24', NULL, NULL, 'AZ', 'AE'),
(4406, 237, 'Ajman Emirate', '2023-08-14 14:52:24', NULL, NULL, 'AJ', 'AE'),
(4407, 237, 'Dubai', '2023-08-14 14:52:24', NULL, NULL, 'DU', 'AE'),
(4408, 237, 'Fujairah', '2023-08-14 14:52:24', NULL, NULL, 'FU', 'AE'),
(4409, 237, 'Ras al-Khaimah', '2023-08-14 14:52:24', NULL, NULL, 'RK', 'AE'),
(4410, 237, 'Sharjah Emirate', '2023-08-14 14:52:24', NULL, NULL, 'SH', 'AE'),
(4411, 237, 'Umm al-Quwain', '2023-08-14 14:52:24', NULL, NULL, 'UQ', 'AE'),
(4412, 238, 'Aberdeen', '2023-08-14 14:52:24', NULL, NULL, 'ABE', 'GB'),
(4413, 238, 'Aberdeenshire', '2023-08-14 14:52:24', NULL, NULL, 'ABD', 'GB'),
(4414, 238, 'Angus', '2023-08-14 14:52:24', NULL, NULL, 'ANS', 'GB'),
(4415, 238, 'Antrim', '2023-08-14 14:52:24', NULL, NULL, 'ANT', 'GB'),
(4416, 238, 'Antrim and Newtownabbey', '2023-08-14 14:52:24', NULL, NULL, 'ANN', 'GB'),
(4417, 238, 'Ards', '2023-08-14 14:52:24', NULL, NULL, 'ARD', 'GB'),
(4418, 238, 'Ards and North Down', '2023-08-14 14:52:24', NULL, NULL, 'AND', 'GB'),
(4419, 238, 'Argyll and Bute', '2023-08-14 14:52:24', NULL, NULL, 'AGB', 'GB'),
(4420, 238, 'Armagh City and District Council', '2023-08-14 14:52:24', NULL, NULL, 'ARM', 'GB'),
(4421, 238, 'Armagh, Banbridge and Craigavon', '2023-08-14 14:52:24', NULL, NULL, 'ABC', 'GB'),
(4422, 238, 'Ascension Island', '2023-08-14 14:52:24', NULL, NULL, 'SH-AC', 'GB'),
(4423, 238, 'Ballymena Borough', '2023-08-14 14:52:24', NULL, NULL, 'BLA', 'GB'),
(4424, 238, 'Ballymoney', '2023-08-14 14:52:24', NULL, NULL, 'BLY', 'GB'),
(4425, 238, 'Banbridge', '2023-08-14 14:52:24', NULL, NULL, 'BNB', 'GB'),
(4426, 238, 'Barnsley', '2023-08-14 14:52:24', NULL, NULL, 'BNS', 'GB'),
(4427, 238, 'Bath and North East Somerset', '2023-08-14 14:52:24', NULL, NULL, 'BAS', 'GB'),
(4428, 238, 'Bedford', '2023-08-14 14:52:24', NULL, NULL, 'BDF', 'GB'),
(4429, 238, 'Belfast district', '2023-08-14 14:52:24', NULL, NULL, 'BFS', 'GB'),
(4430, 238, 'Birmingham', '2023-08-14 14:52:24', NULL, NULL, 'BIR', 'GB'),
(4431, 238, 'Blackburn with Darwen', '2023-08-14 14:52:24', NULL, NULL, 'BBD', 'GB'),
(4432, 238, 'Blackpool', '2023-08-14 14:52:24', NULL, NULL, 'BPL', 'GB'),
(4433, 238, 'Blaenau Gwent County Borough', '2023-08-14 14:52:24', NULL, NULL, 'BGW', 'GB'),
(4434, 238, 'Bolton', '2023-08-14 14:52:24', NULL, NULL, 'BOL', 'GB'),
(4435, 238, 'Bournemouth', '2023-08-14 14:52:24', NULL, NULL, 'BMH', 'GB'),
(4436, 238, 'Bracknell Forest', '2023-08-14 14:52:24', NULL, NULL, 'BRC', 'GB'),
(4437, 238, 'Bradford', '2023-08-14 14:52:24', NULL, NULL, 'BRD', 'GB'),
(4438, 238, 'Bridgend County Borough', '2023-08-14 14:52:24', NULL, NULL, 'BGE', 'GB'),
(4439, 238, 'Brighton and Hove', '2023-08-14 14:52:24', NULL, NULL, 'BNH', 'GB'),
(4440, 238, 'Buckinghamshire', '2023-08-14 14:52:24', NULL, NULL, 'BKM', 'GB'),
(4441, 238, 'Bury', '2023-08-14 14:52:24', NULL, NULL, 'BUR', 'GB'),
(4442, 238, 'Caerphilly County Borough', '2023-08-14 14:52:24', NULL, NULL, 'CAY', 'GB'),
(4443, 238, 'Calderdale', '2023-08-14 14:52:24', NULL, NULL, 'CLD', 'GB'),
(4444, 238, 'Cambridgeshire', '2023-08-14 14:52:24', NULL, NULL, 'CAM', 'GB'),
(4445, 238, 'Carmarthenshire', '2023-08-14 14:52:24', NULL, NULL, 'CMN', 'GB'),
(4446, 238, 'Carrickfergus Borough Council', '2023-08-14 14:52:24', NULL, NULL, 'CKF', 'GB'),
(4447, 238, 'Castlereagh', '2023-08-14 14:52:24', NULL, NULL, 'CSR', 'GB'),
(4448, 238, 'Causeway Coast and Glens', '2023-08-14 14:52:24', NULL, NULL, 'CCG', 'GB'),
(4449, 238, 'Central Bedfordshire', '2023-08-14 14:52:24', NULL, NULL, 'CBF', 'GB'),
(4450, 238, 'Ceredigion', '2023-08-14 14:52:24', NULL, NULL, 'CGN', 'GB'),
(4451, 238, 'Cheshire East', '2023-08-14 14:52:24', NULL, NULL, 'CHE', 'GB'),
(4452, 238, 'Cheshire West and Chester', '2023-08-14 14:52:24', NULL, NULL, 'CHW', 'GB'),
(4453, 238, 'City and County of Cardiff', '2023-08-14 14:52:24', NULL, NULL, 'CRF', 'GB'),
(4454, 238, 'City and County of Swansea', '2023-08-14 14:52:24', NULL, NULL, 'SWA', 'GB'),
(4455, 238, 'City of Bristol', '2023-08-14 14:52:24', NULL, NULL, 'BST', 'GB'),
(4456, 238, 'City of Derby', '2023-08-14 14:52:24', NULL, NULL, 'DER', 'GB'),
(4457, 238, 'City of Kingston upon Hull', '2023-08-14 14:52:24', NULL, NULL, 'KHL', 'GB'),
(4458, 238, 'City of Leicester', '2023-08-14 14:52:24', NULL, NULL, 'LCE', 'GB'),
(4459, 238, 'City of London', '2023-08-14 14:52:24', NULL, NULL, 'LND', 'GB'),
(4460, 238, 'City of Nottingham', '2023-08-14 14:52:24', NULL, NULL, 'NGM', 'GB'),
(4461, 238, 'City of Peterborough', '2023-08-14 14:52:24', NULL, NULL, 'PTE', 'GB'),
(4462, 238, 'City of Plymouth', '2023-08-14 14:52:24', NULL, NULL, 'PLY', 'GB'),
(4463, 238, 'City of Portsmouth', '2023-08-14 14:52:24', NULL, NULL, 'POR', 'GB'),
(4464, 238, 'City of Southampton', '2023-08-14 14:52:24', NULL, NULL, 'STH', 'GB'),
(4465, 238, 'City of Stoke-on-Trent', '2023-08-14 14:52:24', NULL, NULL, 'STE', 'GB'),
(4466, 238, 'City of Sunderland', '2023-08-14 14:52:24', NULL, NULL, 'SND', 'GB'),
(4467, 238, 'City of Westminster', '2023-08-14 14:52:24', NULL, NULL, 'WSM', 'GB'),
(4468, 238, 'City of Wolverhampton', '2023-08-14 14:52:24', NULL, NULL, 'WLV', 'GB'),
(4469, 238, 'City of York', '2023-08-14 14:52:24', NULL, NULL, 'YOR', 'GB'),
(4470, 238, 'Clackmannanshire', '2023-08-14 14:52:24', NULL, NULL, 'CLK', 'GB'),
(4471, 238, 'Coleraine Borough Council', '2023-08-14 14:52:24', NULL, NULL, 'CLR', 'GB'),
(4472, 238, 'Conwy County Borough', '2023-08-14 14:52:24', NULL, NULL, 'CWY', 'GB'),
(4473, 238, 'Cookstown District Council', '2023-08-14 14:52:24', NULL, NULL, 'CKT', 'GB'),
(4474, 238, 'Cornwall', '2023-08-14 14:52:24', NULL, NULL, 'CON', 'GB'),
(4475, 238, 'County Durham', '2023-08-14 14:52:24', NULL, NULL, 'DUR', 'GB'),
(4476, 238, 'Coventry', '2023-08-14 14:52:24', NULL, NULL, 'COV', 'GB'),
(4477, 238, 'Craigavon Borough Council', '2023-08-14 14:52:24', NULL, NULL, 'CGV', 'GB'),
(4478, 238, 'Cumbria', '2023-08-14 14:52:24', NULL, NULL, 'CMA', 'GB'),
(4479, 238, 'Darlington', '2023-08-14 14:52:24', NULL, NULL, 'DAL', 'GB'),
(4480, 238, 'Denbighshire', '2023-08-14 14:52:24', NULL, NULL, 'DEN', 'GB'),
(4481, 238, 'Derbyshire', '2023-08-14 14:52:24', NULL, NULL, 'DBY', 'GB'),
(4482, 238, 'Derry City and Strabane', '2023-08-14 14:52:24', NULL, NULL, 'DRS', 'GB'),
(4483, 238, 'Derry City Council', '2023-08-14 14:52:24', NULL, NULL, 'DRY', 'GB'),
(4484, 238, 'Devon', '2023-08-14 14:52:24', NULL, NULL, 'DEV', 'GB'),
(4485, 238, 'Doncaster', '2023-08-14 14:52:24', NULL, NULL, 'DNC', 'GB'),
(4486, 238, 'Dorset', '2023-08-14 14:52:24', NULL, NULL, 'DOR', 'GB'),
(4487, 238, 'Down District Council', '2023-08-14 14:52:24', NULL, NULL, 'DOW', 'GB'),
(4488, 238, 'Dudley', '2023-08-14 14:52:24', NULL, NULL, 'DUD', 'GB'),
(4489, 238, 'Dumfries and Galloway', '2023-08-14 14:52:24', NULL, NULL, 'DGY', 'GB'),
(4490, 238, 'Dundee', '2023-08-14 14:52:24', NULL, NULL, 'DND', 'GB'),
(4491, 238, 'Dungannon and South Tyrone Borough Council', '2023-08-14 14:52:24', NULL, NULL, 'DGN', 'GB'),
(4492, 238, 'East Ayrshire', '2023-08-14 14:52:24', NULL, NULL, 'EAY', 'GB'),
(4493, 238, 'East Dunbartonshire', '2023-08-14 14:52:24', NULL, NULL, 'EDU', 'GB'),
(4494, 238, 'East Lothian', '2023-08-14 14:52:24', NULL, NULL, 'ELN', 'GB'),
(4495, 238, 'East Renfrewshire', '2023-08-14 14:52:24', NULL, NULL, 'ERW', 'GB'),
(4496, 238, 'East Riding of Yorkshire', '2023-08-14 14:52:24', NULL, NULL, 'ERY', 'GB'),
(4497, 238, 'East Sussex', '2023-08-14 14:52:24', NULL, NULL, 'ESX', 'GB'),
(4498, 238, 'Edinburgh', '2023-08-14 14:52:24', NULL, NULL, 'EDH', 'GB'),
(4499, 238, 'England', '2023-08-14 14:52:24', NULL, NULL, 'ENG', 'GB'),
(4500, 238, 'Essex', '2023-08-14 14:52:24', NULL, NULL, 'ESS', 'GB'),
(4501, 238, 'Falkirk', '2023-08-14 14:52:24', NULL, NULL, 'FAL', 'GB'),
(4502, 238, 'Fermanagh and Omagh', '2023-08-14 14:52:24', NULL, NULL, 'FMO', 'GB'),
(4503, 238, 'Fermanagh District Council', '2023-08-14 14:52:24', NULL, NULL, 'FER', 'GB'),
(4504, 238, 'Fife', '2023-08-14 14:52:24', NULL, NULL, 'FIF', 'GB'),
(4505, 238, 'Flintshire', '2023-08-14 14:52:24', NULL, NULL, 'FLN', 'GB'),
(4506, 238, 'Gateshead', '2023-08-14 14:52:24', NULL, NULL, 'GAT', 'GB'),
(4507, 238, 'Glasgow', '2023-08-14 14:52:24', NULL, NULL, 'GLG', 'GB'),
(4508, 238, 'Gloucestershire', '2023-08-14 14:52:24', NULL, NULL, 'GLS', 'GB'),
(4509, 238, 'Gwynedd', '2023-08-14 14:52:24', NULL, NULL, 'GWN', 'GB'),
(4510, 238, 'Halton', '2023-08-14 14:52:24', NULL, NULL, 'HAL', 'GB'),
(4511, 238, 'Hampshire', '2023-08-14 14:52:24', NULL, NULL, 'HAM', 'GB'),
(4512, 238, 'Hartlepool', '2023-08-14 14:52:24', NULL, NULL, 'HPL', 'GB'),
(4513, 238, 'Herefordshire', '2023-08-14 14:52:24', NULL, NULL, 'HEF', 'GB'),
(4514, 238, 'Hertfordshire', '2023-08-14 14:52:24', NULL, NULL, 'HRT', 'GB'),
(4515, 238, 'Highland', '2023-08-14 14:52:24', NULL, NULL, 'HLD', 'GB'),
(4516, 238, 'Inverclyde', '2023-08-14 14:52:24', NULL, NULL, 'IVC', 'GB'),
(4517, 238, 'Isle of Wight', '2023-08-14 14:52:24', NULL, NULL, 'IOW', 'GB'),
(4518, 238, 'Isles of Scilly', '2023-08-14 14:52:24', NULL, NULL, 'IOS', 'GB'),
(4519, 238, 'Kent', '2023-08-14 14:52:24', NULL, NULL, 'KEN', 'GB'),
(4520, 238, 'Kirklees', '2023-08-14 14:52:24', NULL, NULL, 'KIR', 'GB'),
(4521, 238, 'Knowsley', '2023-08-14 14:52:24', NULL, NULL, 'KWL', 'GB'),
(4522, 238, 'Lancashire', '2023-08-14 14:52:24', NULL, NULL, 'LAN', 'GB'),
(4523, 238, 'Larne Borough Council', '2023-08-14 14:52:24', NULL, NULL, 'LRN', 'GB'),
(4524, 238, 'Leeds', '2023-08-14 14:52:24', NULL, NULL, 'LDS', 'GB'),
(4525, 238, 'Leicestershire', '2023-08-14 14:52:24', NULL, NULL, 'LEC', 'GB'),
(4526, 238, 'Limavady Borough Council', '2023-08-14 14:52:24', NULL, NULL, 'LMV', 'GB'),
(4527, 238, 'Lincolnshire', '2023-08-14 14:52:24', NULL, NULL, 'LIN', 'GB'),
(4528, 238, 'Lisburn and Castlereagh', '2023-08-14 14:52:24', NULL, NULL, 'LBC', 'GB'),
(4529, 238, 'Lisburn City Council', '2023-08-14 14:52:24', NULL, NULL, 'LSB', 'GB'),
(4530, 238, 'Liverpool', '2023-08-14 14:52:24', NULL, NULL, 'LIV', 'GB'),
(4531, 238, 'London Borough of Barking and Dagenham', '2023-08-14 14:52:24', NULL, NULL, 'BDG', 'GB'),
(4532, 238, 'London Borough of Barnet', '2023-08-14 14:52:24', NULL, NULL, 'BNE', 'GB'),
(4533, 238, 'London Borough of Bexley', '2023-08-14 14:52:24', NULL, NULL, 'BEX', 'GB'),
(4534, 238, 'London Borough of Brent', '2023-08-14 14:52:24', NULL, NULL, 'BEN', 'GB'),
(4535, 238, 'London Borough of Bromley', '2023-08-14 14:52:24', NULL, NULL, 'BRY', 'GB'),
(4536, 238, 'London Borough of Camden', '2023-08-14 14:52:24', NULL, NULL, 'CMD', 'GB'),
(4537, 238, 'London Borough of Croydon', '2023-08-14 14:52:24', NULL, NULL, 'CRY', 'GB'),
(4538, 238, 'London Borough of Ealing', '2023-08-14 14:52:24', NULL, NULL, 'EAL', 'GB'),
(4539, 238, 'London Borough of Enfield', '2023-08-14 14:52:24', NULL, NULL, 'ENF', 'GB'),
(4540, 238, 'London Borough of Hackney', '2023-08-14 14:52:24', NULL, NULL, 'HCK', 'GB'),
(4541, 238, 'London Borough of Hammersmith and Fulham', '2023-08-14 14:52:24', NULL, NULL, 'HMF', 'GB'),
(4542, 238, 'London Borough of Haringey', '2023-08-14 14:52:24', NULL, NULL, 'HRY', 'GB'),
(4543, 238, 'London Borough of Harrow', '2023-08-14 14:52:24', NULL, NULL, 'HRW', 'GB'),
(4544, 238, 'London Borough of Havering', '2023-08-14 14:52:24', NULL, NULL, 'HAV', 'GB'),
(4545, 238, 'London Borough of Hillingdon', '2023-08-14 14:52:24', NULL, NULL, 'HIL', 'GB'),
(4546, 238, 'London Borough of Hounslow', '2023-08-14 14:52:24', NULL, NULL, 'HNS', 'GB'),
(4547, 238, 'London Borough of Islington', '2023-08-14 14:52:24', NULL, NULL, 'ISL', 'GB'),
(4548, 238, 'London Borough of Lambeth', '2023-08-14 14:52:24', NULL, NULL, 'LBH', 'GB'),
(4549, 238, 'London Borough of Lewisham', '2023-08-14 14:52:24', NULL, NULL, 'LEW', 'GB'),
(4550, 238, 'London Borough of Merton', '2023-08-14 14:52:24', NULL, NULL, 'MRT', 'GB'),
(4551, 238, 'London Borough of Newham', '2023-08-14 14:52:24', NULL, NULL, 'NWM', 'GB'),
(4552, 238, 'London Borough of Redbridge', '2023-08-14 14:52:24', NULL, NULL, 'RDB', 'GB'),
(4553, 238, 'London Borough of Richmond upon Thames', '2023-08-14 14:52:24', NULL, NULL, 'RIC', 'GB'),
(4554, 238, 'London Borough of Southwark', '2023-08-14 14:52:24', NULL, NULL, 'SWK', 'GB'),
(4555, 238, 'London Borough of Sutton', '2023-08-14 14:52:24', NULL, NULL, 'STN', 'GB'),
(4556, 238, 'London Borough of Tower Hamlets', '2023-08-14 14:52:24', NULL, NULL, 'TWH', 'GB'),
(4557, 238, 'London Borough of Waltham Forest', '2023-08-14 14:52:24', NULL, NULL, 'WFT', 'GB'),
(4558, 238, 'London Borough of Wandsworth', '2023-08-14 14:52:24', NULL, NULL, 'WND', 'GB'),
(4559, 238, 'Magherafelt District Council', '2023-08-14 14:52:24', NULL, NULL, 'MFT', 'GB'),
(4560, 238, 'Manchester', '2023-08-14 14:52:24', NULL, NULL, 'MAN', 'GB'),
(4561, 238, 'Medway', '2023-08-14 14:52:24', NULL, NULL, 'MDW', 'GB'),
(4562, 238, 'Merthyr Tydfil County Borough', '2023-08-14 14:52:24', NULL, NULL, 'MTY', 'GB'),
(4563, 238, 'Metropolitan Borough of Wigan', '2023-08-14 14:52:24', NULL, NULL, 'WGN', 'GB'),
(4564, 238, 'Mid and East Antrim', '2023-08-14 14:52:24', NULL, NULL, 'MEA', 'GB'),
(4565, 238, 'Mid Ulster', '2023-08-14 14:52:24', NULL, NULL, 'MUL', 'GB'),
(4566, 238, 'Middlesbrough', '2023-08-14 14:52:24', NULL, NULL, 'MDB', 'GB'),
(4567, 238, 'Midlothian', '2023-08-14 14:52:24', NULL, NULL, 'MLN', 'GB'),
(4568, 238, 'Milton Keynes', '2023-08-14 14:52:24', NULL, NULL, 'MIK', 'GB'),
(4569, 238, 'Monmouthshire', '2023-08-14 14:52:24', NULL, NULL, 'MON', 'GB'),
(4570, 238, 'Moray', '2023-08-14 14:52:24', NULL, NULL, 'MRY', 'GB'),
(4571, 238, 'Moyle District Council', '2023-08-14 14:52:24', NULL, NULL, 'MYL', 'GB'),
(4572, 238, 'Neath Port Talbot County Borough', '2023-08-14 14:52:24', NULL, NULL, 'NTL', 'GB'),
(4573, 238, 'Newcastle upon Tyne', '2023-08-14 14:52:24', NULL, NULL, 'NET', 'GB'),
(4574, 238, 'Newport', '2023-08-14 14:52:24', NULL, NULL, 'NWP', 'GB'),
(4575, 238, 'Newry and Mourne District Council', '2023-08-14 14:52:24', NULL, NULL, 'NYM', 'GB'),
(4576, 238, 'Newry, Mourne and Down', '2023-08-14 14:52:24', NULL, NULL, 'NMD', 'GB'),
(4577, 238, 'Newtownabbey Borough Council', '2023-08-14 14:52:24', NULL, NULL, 'NTA', 'GB'),
(4578, 238, 'Norfolk', '2023-08-14 14:52:24', NULL, NULL, 'NFK', 'GB'),
(4579, 238, 'North Ayrshire', '2023-08-14 14:52:24', NULL, NULL, 'NAY', 'GB'),
(4580, 238, 'North Down Borough Council', '2023-08-14 14:52:24', NULL, NULL, 'NDN', 'GB'),
(4581, 238, 'North East Lincolnshire', '2023-08-14 14:52:24', NULL, NULL, 'NEL', 'GB'),
(4582, 238, 'North Lanarkshire', '2023-08-14 14:52:24', NULL, NULL, 'NLK', 'GB'),
(4583, 238, 'North Lincolnshire', '2023-08-14 14:52:24', NULL, NULL, 'NLN', 'GB'),
(4584, 238, 'North Somerset', '2023-08-14 14:52:24', NULL, NULL, 'NSM', 'GB'),
(4585, 238, 'North Tyneside', '2023-08-14 14:52:24', NULL, NULL, 'NTY', 'GB'),
(4586, 238, 'North Yorkshire', '2023-08-14 14:52:24', NULL, NULL, 'NYK', 'GB'),
(4587, 238, 'Northamptonshire', '2023-08-14 14:52:24', NULL, NULL, 'NTH', 'GB'),
(4588, 238, 'Northern Ireland', '2023-08-14 14:52:24', NULL, NULL, 'NIR', 'GB'),
(4589, 238, 'Northumberland', '2023-08-14 14:52:24', NULL, NULL, 'NBL', 'GB'),
(4590, 238, 'Nottinghamshire', '2023-08-14 14:52:24', NULL, NULL, 'NTT', 'GB'),
(4591, 238, 'Oldham', '2023-08-14 14:52:24', NULL, NULL, 'OLD', 'GB'),
(4592, 238, 'Omagh District Council', '2023-08-14 14:52:24', NULL, NULL, 'OMH', 'GB'),
(4593, 238, 'Orkney Islands', '2023-08-14 14:52:24', NULL, NULL, 'ORK', 'GB'),
(4594, 238, 'Outer Hebrides', '2023-08-14 14:52:24', NULL, NULL, 'ELS', 'GB'),
(4595, 238, 'Oxfordshire', '2023-08-14 14:52:24', NULL, NULL, 'OXF', 'GB'),
(4596, 238, 'Pembrokeshire', '2023-08-14 14:52:24', NULL, NULL, 'PEM', 'GB'),
(4597, 238, 'Perth and Kinross', '2023-08-14 14:52:24', NULL, NULL, 'PKN', 'GB'),
(4598, 238, 'Poole', '2023-08-14 14:52:24', NULL, NULL, 'POL', 'GB'),
(4599, 238, 'Powys', '2023-08-14 14:52:24', NULL, NULL, 'POW', 'GB'),
(4600, 238, 'Reading', '2023-08-14 14:52:24', NULL, NULL, 'RDG', 'GB'),
(4601, 238, 'Redcar and Cleveland', '2023-08-14 14:52:24', NULL, NULL, 'RCC', 'GB'),
(4602, 238, 'Renfrewshire', '2023-08-14 14:52:24', NULL, NULL, 'RFW', 'GB'),
(4603, 238, 'Rhondda Cynon Taf', '2023-08-14 14:52:24', NULL, NULL, 'RCT', 'GB'),
(4604, 238, 'Rochdale', '2023-08-14 14:52:24', NULL, NULL, 'RCH', 'GB'),
(4605, 238, 'Rotherham', '2023-08-14 14:52:24', NULL, NULL, 'ROT', 'GB'),
(4606, 238, 'Royal Borough of Greenwich', '2023-08-14 14:52:24', NULL, NULL, 'GRE', 'GB'),
(4607, 238, 'Royal Borough of Kensington and Chelsea', '2023-08-14 14:52:24', NULL, NULL, 'KEC', 'GB'),
(4608, 238, 'Royal Borough of Kingston upon Thames', '2023-08-14 14:52:24', NULL, NULL, 'KTT', 'GB'),
(4609, 238, 'Rutland', '2023-08-14 14:52:24', NULL, NULL, 'RUT', 'GB'),
(4610, 238, 'Saint Helena', '2023-08-14 14:52:24', NULL, NULL, 'SH-HL', 'GB'),
(4611, 238, 'Salford', '2023-08-14 14:52:24', NULL, NULL, 'SLF', 'GB'),
(4612, 238, 'Sandwell', '2023-08-14 14:52:24', NULL, NULL, 'SAW', 'GB'),
(4613, 238, 'Scotland', '2023-08-14 14:52:24', NULL, NULL, 'SCT', 'GB'),
(4614, 238, 'Scottish Borders', '2023-08-14 14:52:24', NULL, NULL, 'SCB', 'GB'),
(4615, 238, 'Sefton', '2023-08-14 14:52:24', NULL, NULL, 'SFT', 'GB'),
(4616, 238, 'Sheffield', '2023-08-14 14:52:24', NULL, NULL, 'SHF', 'GB'),
(4617, 238, 'Shetland Islands', '2023-08-14 14:52:24', NULL, NULL, 'ZET', 'GB'),
(4618, 238, 'Shropshire', '2023-08-14 14:52:24', NULL, NULL, 'SHR', 'GB'),
(4619, 238, 'Slough', '2023-08-14 14:52:24', NULL, NULL, 'SLG', 'GB'),
(4620, 238, 'Solihull', '2023-08-14 14:52:24', NULL, NULL, 'SOL', 'GB'),
(4621, 238, 'Somerset', '2023-08-14 14:52:24', NULL, NULL, 'SOM', 'GB'),
(4622, 238, 'South Ayrshire', '2023-08-14 14:52:24', NULL, NULL, 'SAY', 'GB'),
(4623, 238, 'South Gloucestershire', '2023-08-14 14:52:24', NULL, NULL, 'SGC', 'GB'),
(4624, 238, 'South Lanarkshire', '2023-08-14 14:52:24', NULL, NULL, 'SLK', 'GB'),
(4625, 238, 'South Tyneside', '2023-08-14 14:52:24', NULL, NULL, 'STY', 'GB'),
(4626, 238, 'Southend-on-Sea', '2023-08-14 14:52:24', NULL, NULL, 'SOS', 'GB'),
(4627, 238, 'St Helens', '2023-08-14 14:52:24', NULL, NULL, 'SHN', 'GB'),
(4628, 238, 'Staffordshire', '2023-08-14 14:52:24', NULL, NULL, 'STS', 'GB'),
(4629, 238, 'Stirling', '2023-08-14 14:52:24', NULL, NULL, 'STG', 'GB'),
(4630, 238, 'Stockport', '2023-08-14 14:52:24', NULL, NULL, 'SKP', 'GB'),
(4631, 238, 'Stockton-on-Tees', '2023-08-14 14:52:24', NULL, NULL, 'STT', 'GB'),
(4632, 238, 'Strabane District Council', '2023-08-14 14:52:24', NULL, NULL, 'STB', 'GB'),
(4633, 238, 'Suffolk', '2023-08-14 14:52:24', NULL, NULL, 'SFK', 'GB'),
(4634, 238, 'Surrey', '2023-08-14 14:52:24', NULL, NULL, 'SRY', 'GB'),
(4635, 238, 'Swindon', '2023-08-14 14:52:24', NULL, NULL, 'SWD', 'GB'),
(4636, 238, 'Tameside', '2023-08-14 14:52:24', NULL, NULL, 'TAM', 'GB'),
(4637, 238, 'Telford and Wrekin', '2023-08-14 14:52:24', NULL, NULL, 'TFW', 'GB'),
(4638, 238, 'Thurrock', '2023-08-14 14:52:24', NULL, NULL, 'THR', 'GB'),
(4639, 238, 'Torbay', '2023-08-14 14:52:24', NULL, NULL, 'TOB', 'GB'),
(4640, 238, 'Torfaen', '2023-08-14 14:52:24', NULL, NULL, 'TOF', 'GB'),
(4641, 238, 'Trafford', '2023-08-14 14:52:24', NULL, NULL, 'TRF', 'GB'),
(4642, 238, 'United Kingdom', '2023-08-14 14:52:24', NULL, NULL, 'UKM', 'GB'),
(4643, 238, 'Vale of Glamorgan', '2023-08-14 14:52:24', NULL, NULL, 'VGL', 'GB'),
(4644, 238, 'Wakefield', '2023-08-14 14:52:24', NULL, NULL, 'WKF', 'GB'),
(4645, 238, 'Wales', '2023-08-14 14:52:24', NULL, NULL, 'WLS', 'GB'),
(4646, 238, 'Walsall', '2023-08-14 14:52:24', NULL, NULL, 'WLL', 'GB'),
(4647, 238, 'Warrington', '2023-08-14 14:52:24', NULL, NULL, 'WRT', 'GB'),
(4648, 238, 'Warwickshire', '2023-08-14 14:52:24', NULL, NULL, 'WAR', 'GB'),
(4649, 238, 'West Berkshire', '2023-08-14 14:52:24', NULL, NULL, 'WBK', 'GB'),
(4650, 238, 'West Dunbartonshire', '2023-08-14 14:52:24', NULL, NULL, 'WDU', 'GB'),
(4651, 238, 'West Lothian', '2023-08-14 14:52:24', NULL, NULL, 'WLN', 'GB'),
(4652, 238, 'West Sussex', '2023-08-14 14:52:24', NULL, NULL, 'WSX', 'GB'),
(4653, 238, 'Wiltshire', '2023-08-14 14:52:24', NULL, NULL, 'WIL', 'GB'),
(4654, 238, 'Windsor and Maidenhead', '2023-08-14 14:52:24', NULL, NULL, 'WNM', 'GB'),
(4655, 238, 'Wirral', '2023-08-14 14:52:24', NULL, NULL, 'WRL', 'GB'),
(4656, 238, 'Wokingham', '2023-08-14 14:52:24', NULL, NULL, 'WOK', 'GB'),
(4657, 238, 'Worcestershire', '2023-08-14 14:52:24', NULL, NULL, 'WOR', 'GB'),
(4658, 238, 'Wrexham County Borough', '2023-08-14 14:52:24', NULL, NULL, 'WRX', 'GB'),
(4659, 239, 'Alabama', '2023-08-14 14:52:24', NULL, NULL, 'AL', 'US'),
(4660, 239, 'Alaska', '2023-08-14 14:52:24', NULL, NULL, 'AK', 'US'),
(4661, 239, 'American Samoa', '2023-08-14 14:52:24', NULL, NULL, 'AS', 'US'),
(4662, 239, 'Arizona', '2023-08-14 14:52:24', NULL, NULL, 'AZ', 'US'),
(4663, 239, 'Arkansas', '2023-08-14 14:52:24', NULL, NULL, 'AR', 'US'),
(4664, 239, 'Baker Island', '2023-08-14 14:52:24', NULL, NULL, 'UM-81', 'US'),
(4665, 239, 'California', '2023-08-14 14:52:24', NULL, NULL, 'CA', 'US'),
(4666, 239, 'Colorado', '2023-08-14 14:52:24', NULL, NULL, 'CO', 'US'),
(4667, 239, 'Connecticut', '2023-08-14 14:52:24', NULL, NULL, 'CT', 'US'),
(4668, 239, 'Delaware', '2023-08-14 14:52:24', NULL, NULL, 'DE', 'US'),
(4669, 239, 'District of Columbia', '2023-08-14 14:52:24', NULL, NULL, 'DC', 'US'),
(4670, 239, 'Florida', '2023-08-14 14:52:24', NULL, NULL, 'FL', 'US'),
(4671, 239, 'Georgia', '2023-08-14 14:52:24', NULL, NULL, 'GA', 'US'),
(4672, 239, 'Guam', '2023-08-14 14:52:24', NULL, NULL, 'GU', 'US'),
(4673, 239, 'Hawaii', '2023-08-14 14:52:24', NULL, NULL, 'HI', 'US'),
(4674, 239, 'Howland Island', '2023-08-14 14:52:24', NULL, NULL, 'UM-84', 'US'),
(4675, 239, 'Idaho', '2023-08-14 14:52:24', NULL, NULL, 'ID', 'US'),
(4676, 239, 'Illinois', '2023-08-14 14:52:24', NULL, NULL, 'IL', 'US'),
(4677, 239, 'Indiana', '2023-08-14 14:52:24', NULL, NULL, 'IN', 'US'),
(4678, 239, 'Iowa', '2023-08-14 14:52:24', NULL, NULL, 'IA', 'US'),
(4679, 239, 'Jarvis Island', '2023-08-14 14:52:24', NULL, NULL, 'UM-86', 'US'),
(4680, 239, 'Johnston Atoll', '2023-08-14 14:52:24', NULL, NULL, 'UM-67', 'US'),
(4681, 239, 'Kansas', '2023-08-14 14:52:24', NULL, NULL, 'KS', 'US'),
(4682, 239, 'Kentucky', '2023-08-14 14:52:24', NULL, NULL, 'KY', 'US'),
(4683, 239, 'Kingman Reef', '2023-08-14 14:52:24', NULL, NULL, 'UM-89', 'US'),
(4684, 239, 'Louisiana', '2023-08-14 14:52:24', NULL, NULL, 'LA', 'US'),
(4685, 239, 'Maine', '2023-08-14 14:52:24', NULL, NULL, 'ME', 'US'),
(4686, 239, 'Maryland', '2023-08-14 14:52:24', NULL, NULL, 'MD', 'US'),
(4687, 239, 'Massachusetts', '2023-08-14 14:52:24', NULL, NULL, 'MA', 'US'),
(4688, 239, 'Michigan', '2023-08-14 14:52:24', NULL, NULL, 'MI', 'US'),
(4689, 239, 'Midway Atoll', '2023-08-14 14:52:24', NULL, NULL, 'UM-71', 'US'),
(4690, 239, 'Minnesota', '2023-08-14 14:52:24', NULL, NULL, 'MN', 'US'),
(4691, 239, 'Mississippi', '2023-08-14 14:52:24', NULL, NULL, 'MS', 'US'),
(4692, 239, 'Missouri', '2023-08-14 14:52:24', NULL, NULL, 'MO', 'US'),
(4693, 239, 'Montana', '2023-08-14 14:52:24', NULL, NULL, 'MT', 'US'),
(4694, 239, 'Navassa Island', '2023-08-14 14:52:24', NULL, NULL, 'UM-76', 'US'),
(4695, 239, 'Nebraska', '2023-08-14 14:52:24', NULL, NULL, 'NE', 'US'),
(4696, 239, 'Nevada', '2023-08-14 14:52:24', NULL, NULL, 'NV', 'US'),
(4697, 239, 'New Hampshire', '2023-08-14 14:52:24', NULL, NULL, 'NH', 'US'),
(4698, 239, 'New Jersey', '2023-08-14 14:52:24', NULL, NULL, 'NJ', 'US'),
(4699, 239, 'New Mexico', '2023-08-14 14:52:24', NULL, NULL, 'NM', 'US'),
(4700, 239, 'New York', '2023-08-14 14:52:24', NULL, NULL, 'NY', 'US'),
(4701, 239, 'North Carolina', '2023-08-14 14:52:24', NULL, NULL, 'NC', 'US'),
(4702, 239, 'North Dakota', '2023-08-14 14:52:24', NULL, NULL, 'ND', 'US'),
(4703, 239, 'Northern Mariana Islands', '2023-08-14 14:52:24', NULL, NULL, 'MP', 'US'),
(4704, 239, 'Ohio', '2023-08-14 14:52:24', NULL, NULL, 'OH', 'US'),
(4705, 239, 'Oklahoma', '2023-08-14 14:52:24', NULL, NULL, 'OK', 'US'),
(4706, 239, 'Oregon', '2023-08-14 14:52:24', NULL, NULL, 'OR', 'US'),
(4707, 239, 'Palmyra Atoll', '2023-08-14 14:52:24', NULL, NULL, 'UM-95', 'US'),
(4708, 239, 'Pennsylvania', '2023-08-14 14:52:24', NULL, NULL, 'PA', 'US'),
(4709, 239, 'Puerto Rico', '2023-08-14 14:52:24', NULL, NULL, 'PR', 'US'),
(4710, 239, 'Rhode Island', '2023-08-14 14:52:24', NULL, NULL, 'RI', 'US'),
(4711, 239, 'South Carolina', '2023-08-14 14:52:24', NULL, NULL, 'SC', 'US'),
(4712, 239, 'South Dakota', '2023-08-14 14:52:24', NULL, NULL, 'SD', 'US'),
(4713, 239, 'Tennessee', '2023-08-14 14:52:24', NULL, NULL, 'TN', 'US'),
(4714, 239, 'Texas', '2023-08-14 14:52:24', NULL, NULL, 'TX', 'US'),
(4715, 239, 'United States Minor Outlying Islands', '2023-08-14 14:52:24', NULL, NULL, 'UM', 'US'),
(4716, 239, 'United States Virgin Islands', '2023-08-14 14:52:24', NULL, NULL, 'VI', 'US'),
(4717, 239, 'Utah', '2023-08-14 14:52:24', NULL, NULL, 'UT', 'US'),
(4718, 239, 'Vermont', '2023-08-14 14:52:24', NULL, NULL, 'VT', 'US'),
(4719, 239, 'Virginia', '2023-08-14 14:52:24', NULL, NULL, 'VA', 'US'),
(4720, 239, 'Wake Island', '2023-08-14 14:52:24', NULL, NULL, 'UM-79', 'US'),
(4721, 239, 'Washington', '2023-08-14 14:52:24', NULL, NULL, 'WA', 'US'),
(4722, 239, 'West Virginia', '2023-08-14 14:52:24', NULL, NULL, 'WV', 'US'),
(4723, 239, 'Wisconsin', '2023-08-14 14:52:24', NULL, NULL, 'WI', 'US'),
(4724, 239, 'Wyoming', '2023-08-14 14:52:24', NULL, NULL, 'WY', 'US');

-- --------------------------------------------------------

--
-- Table structure for table `stock_status`
--

DROP TABLE IF EXISTS `stock_status`;
CREATE TABLE IF NOT EXISTS `stock_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_status`
--

INSERT INTO `stock_status` (`id`, `language_id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Pending', 1, '2021-08-01 02:17:33', '2021-08-01 02:17:33', NULL),
(2, NULL, 'success', 1, '2022-04-12 06:49:36', '2022-04-12 06:49:43', '2022-04-12 06:49:43'),
(3, NULL, 'asd', 1, '2022-04-12 06:53:02', '2022-04-12 06:53:06', '2022-04-12 06:53:06'),
(4, NULL, 'sad', 1, '2022-04-12 07:17:33', '2022-04-12 07:17:36', '2022-04-12 07:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `store_product_option`
--

DROP TABLE IF EXISTS `store_product_option`;
CREATE TABLE IF NOT EXISTS `store_product_option` (
  `product_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `price` decimal(15,2) DEFAULT '0.00',
  `color_code` varchar(25) DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`product_option_id`),
  KEY `product_id` (`product_id`,`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax_class`
--

DROP TABLE IF EXISTS `tax_class`;
CREATE TABLE IF NOT EXISTS `tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tax_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_class`
--

INSERT INTO `tax_class` (`tax_class_id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Taxable Goods', 'Taxable Goods', '2023-08-13 09:23:41', '2023-08-13 09:23:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tax_rate`
--

DROP TABLE IF EXISTS `tax_rate`;
CREATE TABLE IF NOT EXISTS `tax_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `rate` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `type` tinyint(1) NOT NULL COMMENT '1=percentage,2=fixed',
  `status` tinyint(1) NOT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zone_id` (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_rate`
--

INSERT INTO `tax_rate` (`id`, `name`, `rate`, `type`, `status`, `zone_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Vat (20%)', '20.0000', 1, 1, 4, '2023-08-11 18:46:58', '2023-08-13 07:37:14', '2023-08-13 07:37:14'),
(6, 'VAT (20%)', '20.0000', 1, 1, 11, '2023-08-13 07:37:34', '2023-08-18 07:50:52', NULL),
(7, 'Vat (10%)', '10.0000', 1, 1, 10, '2023-08-13 09:35:31', '2023-08-14 06:40:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tax_rule`
--

DROP TABLE IF EXISTS `tax_rule`;
CREATE TABLE IF NOT EXISTS `tax_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_class_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tax_class_id` (`tax_class_id`,`tax_rate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_rule`
--

INSERT INTO `tax_rule` (`id`, `tax_class_id`, `tax_rate_id`) VALUES
(13, 5, 6),
(14, 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `opening_amount` int(11) NOT NULL DEFAULT '0',
  `current_amount` int(11) NOT NULL DEFAULT '0',
  `opening_date` date DEFAULT NULL,
  `daily_amount` int(11) DEFAULT NULL,
  `amount_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_sms_date` date DEFAULT NULL,
  `village_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `loan_only` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=632 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `mobile`, `is_admin`, `opening_amount`, `current_amount`, `opening_date`, `daily_amount`, `amount_type`, `last_sms_date`, `village_name`, `status`, `loan_only`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin man', 'adminman@mail.com', NULL, '$2y$10$jIZScj4J7WfZtgXosBfSzu5zVxGLiJChh1qLCQJlBiS12tk1909QO', '8vdAlg4g2nD14JzEmFlH0sZHKquaox6toxl0Q8dZIUFdUac9l3QzyYsUgpI0', '9898252599', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2023-08-18 08:04:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weight_class`
--

DROP TABLE IF EXISTS `weight_class`;
CREATE TABLE IF NOT EXISTS `weight_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `unit` varchar(4) NOT NULL,
  `value` decimal(15,8) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weight_class`
--

INSERT INTO `weight_class` (`id`, `name`, `unit`, `value`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'asd', '34', '34.00000000', 1, '2021-08-01 02:17:16', '2021-08-01 02:17:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
